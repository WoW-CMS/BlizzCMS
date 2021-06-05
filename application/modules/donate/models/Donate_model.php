<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
    public function getApi()
    {
        $api = new ApiContext(
          new OAuthTokenCredential(config_item('paypal_userid'), config_item('paypal_secretpass'))
        );

        $api->setConfig([
            'mode' => config_item('paypal_mode'),
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
        return $this->db->where('id', $id)->get('donate');
    }

    public function getDonations()
    {
        return $this->db->get('donate');
    }

    public function getCurrentDP()
    {
        $qq = $this->db->select('dp')->where('id', $this->session->userdata('id'))->get('users');

        if ($qq->num_rows())
            return $qq->row('dp');
        else
            return '0';
    }

    public function getDonate($id)
    {
        $total = $this->getSpecifyDonate($id)->row('price');

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(site_url('donate/check/'.$id))
        ->setCancelUrl(site_url('donate/canceled'));

        $amount = new Amount();
        $amount->setCurrency(config_item('paypal_currency'))
        ->setTotal($total);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
        ->setDescription('Donation')
        ->setInvoiceNumber(uniqid());

        $payment = new Payment();
        $payment->setIntent('sale')
        ->setPayer($payer)
        ->setRedirectUrls($redirectUrls)
        ->setTransactions([$transaction]);

        try
        {
            // Prepare and execute
            $payment->create($this->getApi());

            $hash = md5($payment->getId());

            $this->db->insert('donate_logs', [
                'user_id'     => $this->session->userdata('id'),
                'payment_id'  => $payment->getId(),
                'hash'        => $hash,
                'total'       => $payment->transactions[0]->amount->total,
                'points'      => $this->getSpecifyDonate($id)->row('points'),
                'create_time' => $payment->create_time,
                'status'      => 0
            ]);
        }
        catch (PayPalConnectionException $e)
        {
            echo $e->getData();
            die();
        }

        foreach ($payment->getLinks() as $key => $link)
        {
            if ($link->getRel() == 'approval_url')
            {
                $redirectUrl = $link->getHref();
            }
        }

        header('Location: '.$redirectUrl);
    }

    public function completeTransaction($donate, $id)
    {
        $query = $this->db->where('payment_id', $id)->get('donate_logs')->row('status');

        if ($query == 1)
        {
            $this->session->set_flashdata('error', lang('donate_error'));
            redirect(site_url('donate'));
        }
        else
        {
            // Transaction status
            $this->db->set('status', 1)->where('payment_id', $id)->update('donate_logs');

            // Update account
            $obtained_points = $this->getSpecifyDonate($donate)->row('points');
            $total = ($this->getCurrentDP() + $obtained_points);

            $this->db->set('dp', $total)->where('id', $this->session->userdata('id'))->update('users');

            $this->session->set_flashdata('success', lang('donate_success'));
            redirect(site_url('donate'));
        }
    }
}
