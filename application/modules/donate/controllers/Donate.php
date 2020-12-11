<?php
/**
 * BlizzCMS
 *
 * @author  WoW-CMS
 * @copyright  Copyright (c) 2017 - 2020, WoW-CMS.
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://wow-cms.com
 */
defined('BASEPATH') OR exit('No direct script access allowed');

use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;

class Donate extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();

		mod_located('donate', true);

		if (! $this->website->isLogged())
		{
			redirect(site_url('login'));
		}

		$this->load->model('donate_model');
		$this->load->config('donate');
	}

	public function index()
	{
		$this->template->title(config_item('app_name'), lang('tab_donate'));

		$this->template->build('index');
	}

	public function check($id)
	{
		$execute = new PaymentExecution();

		$paymentId = $this->input->get('paymentId');
		$payerId   = $this->input->get('PayerID');
		$payment   = Payment::get($paymentId, $this->donate_model->getApi());

		$execute->setPayerId($payerId);

		try
		{
			$result = $payment->execute($execute, $this->donate_model->getApi());
		}
		catch (\Exception $e)
		{
			die($e);
		}

		$this->donate_model->completeTransaction($id, $paymentId);
	}

	public function canceled()
	{
		$this->session->set_flashdata('donation_status','canceled');
		redirect(base_url('donate'));
	}
}
