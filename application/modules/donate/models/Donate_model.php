<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require './vendor/autoload.php';

//API Container
use \PayPal\Rest\ApiContext;
use \PayPal\Auth\OAuthTokenCredential;
use \PayPal\Api\PaymentExecution;

//API Functions
use \PayPal\Api\Item;
use \PayPal\Api\Payer;
use \PayPal\Api\Amount;
use \PayPal\Api\Payment;
use \PayPal\Api\Details;
use \PayPal\Api\ItemList;
use \PayPal\Api\Transaction;
use \PayPal\Api\RedirectUrls;
use \PayPal\Exception\PayPalConnectionException;

class Donate_model extends CI_Model 
{
    /**
     * Donate_model constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function getApi()
    {
        $api = new ApiContext(
          new OAuthTokenCredential($this->config->item('paypal_userid'), $this->config->item('paypal_secretpass'))
        );

        $api->setConfig([
            'mode' => $this->config->item('paypal_mode'),
            'http.ConnectionTimeOut' => 30,
            'log.LogEnabled' => false,
            'log.FileName' => 'paypal_logs',
            'log.LogLevel' => 'FINE',
            'validation.level' => 'log'
        ]);

        return $api;
    }

    public function getSpecifyDonate($id)
    {
        return $this->db->select('*')->where('id', $id)->get('donate');
    }

    public function getDonations()
    {
        return $this->db->select('*')->get('donate');
    }

    public function getCurrentDP()
    {
        $qq = $this->db->select('dp')->where('id', $this->session->userdata('wow_sess_id'))->get('users');

        if ($qq->num_rows())
            return $qq->row('dp');
        else
            return '0';
    }

    public function getDonate($id)
    {
        $item = new Item();
        $payer = new Payer();
        $amount = new Amount();
        $details = new Details();
        $payment = new Payment();
        $itemList = new ItemList();
        $transaction = new Transaction();
        $redirectUrls = new RedirectUrls();

        $setTax = $this->getSpecifyDonate($id)->row('tax');
        $setPrice = $this->getSpecifyDonate($id)->row('price');
        $setTotal = ($setTax + $setPrice);

        //Payer
        $payer->setPaymentMethod('paypal');

        //item
        $item->setName('Donation')
        ->setCurrency($this->config->item('paypal_currency'))
        ->setQuantity(1)
        ->setPrice($setPrice);

        //item list
        $itemList->setItems([$item]);

        //details
        $details->setShipping('0.00')
        ->setTax($setTax)
        ->setSubtotal($setPrice);
        
        $amount->setCurrency($this->config->item('paypal_currency'))
        ->setTotal($setTotal)
        ->setDetails($details);

        //transaction
        $transaction->setAmount($amount)
        ->setItemList($itemList)
        ->setDescription('Donation')
        ->setInvoiceNumber(uniqid());

        //payment
        $payment->setIntent('sale')
        ->setPayer($payer)
        ->setTransactions([$transaction]);

        //redirect urls
        $redirectUrls->setReturnUrl(base_url($this->lang->lang().'/donate/check/'.$id))
        ->setCancelUrl(base_url($this->lang->lang().'/donate/canceled'));

        $payment->setIntent('sale')
        ->setPayer($payer)
        ->setRedirectUrls($redirectUrls)
        ->setTransactions([$transaction]);

        try {
            $payment->create($this->getApi());

            $hash = md5($payment->getId());

            //prepare and execute
            $dataInsert = array(
                'user_id' => $this->session->userdata('wow_sess_id'),
                'payment_id' => $payment->getId(),
                'hash' => $hash,
                'total' => $payment->transactions[0]->amount->total,
                'points' => $this->getSpecifyDonate($id)->row('points'),
                'create_time' => $payment->create_time,
                'status' => '0'
            );

            $this->db->insert('donate_logs', $dataInsert);
        } catch (PayPalConnectionException $e) {
            echo $e->getData();
            die();
        }

           foreach ($payment->getLinks() as $key => $link) {
               if ($link->getRel() == 'approval_url') {
                   $redirectUrl = $link->getHref();
               }
           }

           header('Location: '.$redirectUrl);
    }

    public function completeTransaction($donate, $id)
    {
        $qq = $this->db->select('status')->where('payment_id', $id)->get('donate_logs')->row('status');

        if($qq == '1')
        {
            $this->session->set_flashdata('donation_status','error');
            redirect(base_url($this->lang->lang().'/donate'));
        }
        else
        {
            //transaction status
            $data = array('status' => '1');
            $this->db->where('payment_id', $id)->update('donate_logs', $data);

            //update account
            $obtained_points = $this->getSpecifyDonate($donate)->row('points');
            $total = ($this->getCurrentDP() + $obtained_points);

            $this->db->set('dp', $total)->where('id', $this->session->userdata('wow_sess_id'))->update('users');

            $this->session->set_flashdata('donation_status','success');
            redirect(base_url($this->lang->lang().'/donate'));
        }
    }
}
