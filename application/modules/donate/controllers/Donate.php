<?php defined('BASEPATH') OR exit('No direct script access allowed');

require './vendor/autoload.php';

use \PayPal\Api\Payment;
use \PayPal\Api\PaymentExecution;

class Donate extends MX_Controller
{
    function __construct()
    {
        //Call the constructor of MX_Controller
        parent::__construct();

        if(!ini_get('date.timezone'))
           date_default_timezone_set($this->config->item('timezone'));

        if(!$this->m_data->isLogged())
            redirect(base_url(),'refresh');

        if(!$this->m_permissions->getMaintenance())
            redirect(base_url(),'refresh');

        if (!$this->m_modules->getDonationStatus())
            redirect(base_url(),'refresh');

        if (!$this->m_permissions->getMyPermissions('Permission_Donate'))
            redirect(base_url(),'refresh');

        $this->load->config('donate');
        $this->load->model('donate_model');
    }
    
    public function index()
    {
        $data = array(
            'pagetitle' => $this->lang->line('nav_donate'),
        );

        $this->load->view('header', $data);
        $this->load->view('index', $data);
        $this->load->view('footer');
    }

    public function complete($id)
    {
        $execute = new PaymentExecution();

        $paymentId = $_GET['paymentId'];
        $payerId = $_GET['PayerID'];
        $payment = Payment::get($paymentId, $this->donate_model->getApi());

        $execute->setPayerId($payerId);
        try {
            $result = $payment->execute($execute, $this->donate_model->getApi());
        } catch (Exception $e) {
            die($e);
        }
        $this->donate_model->completeTransaction($id, $_GET['paymentId']);
    }

    public function cancelled()
    {
        redirect(base_url('donate'),'refresh');
    }
}