<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require './vendor/autoload.php';

// API Container
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\PaymentExecution;

// API Functions
use PayPal\Api\Item;
use PayPal\Api\Payer;
use PayPal\Api\Amount;
use PayPal\Api\Payment;
use PayPal\Api\Details;
use PayPal\Api\ItemList;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Exception\PayPalConnectionException;

class Donate_model extends CI_Model 
{
    /**
     * Donate_model constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return object
     */
    public function getApi()
    {
        $api = new ApiContext(
          new OAuthTokenCredential(config_item('paypal_userid'), config_item('paypal_secretpass'))
        );

        $api->setConfig([
            'mode'                   => config_item('paypal_mode'),
            'http.ConnectionTimeOut' => 30,
            'log.LogEnabled'         => false,
            'log.FileName'           => 'paypal_logs',
            'log.LogLevel'           => 'FINE',
            'validation.level'       => 'log'
        ]);

        return $api;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getPackage($id)
    {
        return $this->db->where('id', $id)
            ->get('donate')
            ->row();
    }

    /**
     * @param int $paymentid
     * @return mixed
     */
    public function getPaymentLog($paymentid)
    {
        return $this->db->where('payment_id', $paymentid)
            ->get('donate_logs')
            ->row();
    }

    /**
     * @return mixed
     */
    public function getDonations()
    {
        return $this->db->get('donate');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getDonate($id)
    {
        $package = $this->getPackage($id);

        if (empty($package)) {
            $this->session->set_flashdata('donation_status','error');
            redirect(site_url('donate'));
        }

        $item = new Item();
        $payer = new Payer();
        $amount = new Amount();
        $details = new Details();
        $payment = new Payment();
        $itemList = new ItemList();
        $transaction = new Transaction();
        $redirectUrls = new RedirectUrls();

        $setTotal = $package->tax + $package->price;

        // Payer
        $payer->setPaymentMethod('paypal');

        // Item
        $item->setName('Donation')
            ->setCurrency(config_item('paypal_currency'))
            ->setQuantity(1)
            ->setPrice($package->price);

        // Item list
        $itemList->setItems([$item]);

        // Details
        $details->setTax($package->tax)
            ->setSubtotal($package->price);

        $amount->setCurrency(config_item('paypal_currency'))
            ->setTotal($setTotal)
            ->setDetails($details);

        // Transaction
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription('Donation')
            ->setInvoiceNumber(uniqid());

        // Payment
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions([$transaction]);

        // Redirect urls
        $redirectUrls->setReturnUrl(site_url('donate/check/' . $id))
            ->setCancelUrl(site_url('donate/canceled'));

        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions([$transaction]);

        try {
            $payment->create($this->getApi());
        } catch (PayPalConnectionException $e) {
            show_error($e->getData());
        }

        $approvalUrl = $payment->getApprovalLink();

        $this->db->insert('donate_logs', [
            'user_id'     => $this->session->userdata('wow_sess_id'),
            'payment_id'  => $payment->getId(),
            'hash'        => md5($payment->getId()),
            'total'       => $payment->transactions[0]->amount->total,
            'points'      => $package->points,
            'create_time' => $payment->create_time,
            'status'      => '0'
        ]);

        header('Location: '. $approvalUrl);
    }

    /**
     * @param int $donate
     * @param string $paymentid
     * @return void
     */
    public function completeTransaction($donate, $paymentid)
    {
        $log = $this->getPaymentLog($paymentid);

        if (empty($log)) {
            $this->session->set_flashdata('donation_status','error');
            redirect(site_url('donate'));
        }

        if ($log->status == '1') {
            $this->session->set_flashdata('donation_status','error');
            redirect(site_url('donate'));
        }

        // transaction status
        $this->db->where('payment_id', $paymentid)
            ->update('donate_logs', ['status' => '1']);

        $total = $this->wowgeneral->getCharDPTotal($log->user_id) + (int) $log->points;

        // update account
        $this->db->set('dp', $total)
            ->where('id', $log->user_id)
            ->update('users');

        $this->session->set_flashdata('donation_status','success');
        redirect(site_url('donate'));
    }
}
