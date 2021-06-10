<?php
/**
 * BlizzCMS
 *
 * @author  WoW-CMS
 * @copyright  Copyright (c) 2017 - 2021, WoW-CMS.
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://wow-cms.com
 */
defined('BASEPATH') OR exit('No direct script access allowed');

$lang['donate'] = 'Donate';
$lang['view_log'] = 'View log';

$lang['mode'] = 'Mode';
$lang['client_id'] = 'Client ID';
$lang['secret'] = 'Secret';
$lang['currency'] = 'Currency';
$lang['payment_id'] = 'Payment ID';
$lang['amount'] = 'Amount';
$lang['rewarded'] = 'Rewarded';
$lang['reference_id'] = 'Reference ID';
$lang['order_id'] = 'Order ID';
$lang['gateway'] = 'Gateway';
$lang['points'] = 'Points';
$lang['minimal_amount'] = 'Minimal amount';
$lang['virtual_currency'] = 'Virtual currency';
$lang['currency_exchange'] = 'Currency exchange rate';
$lang['manual_payment'] = 'Manual payment';

$lang['sandbox'] = 'Sandbox';
$lang['production'] = 'Production';
$lang['declined'] = 'Declined';
$lang['completed'] = 'Completed';
$lang['pending'] = 'Pending';

$lang['select_mode'] = 'Select a mode';
$lang['select_currency'] = 'Select a currency';
$lang['select_gateway'] = 'Select a gateway';

$lang['enable_paypal_donation'] = 'Enable donation by PayPal?';

$lang['donation_statistics'] = 'Donation statistics';
$lang['latest_donations'] = 'Latest donations';
$lang['create_manual_payment'] = 'Create manual payment';
$lang['update_payment'] = 'Update payment';

$lang['paypal_contribution'] = 'You can contribute to our server by donating through the paypal method and you will receive donation points that you can use in our store, etc.';
$lang['paypal_exchange_rate'] = 'Each <b>%1$d %2$s</b> = <b>%3$d</b> DP';

/**
 * Alerts
*/
$lang['donation_order_notfound'] = 'Donation order could not be found';
$lang['donation_process_error'] = 'Donation has not yet been fully processed. Please contact our support team for more details';
$lang['donation_already_rewarded'] = 'Donation order has already received the corresponding reward';

$lang['donation_order_canceled'] = 'Donation order <b>%1$s</b> has been canceled. If you feel this is and error, please contact our support team';
$lang['donation_order_completed'] = 'Donation order <b>%1$s</b> has been completed. If your points are not visible yet please contact our support team';
$lang['manual_donation_success'] = 'A manual donation has been added successfully';
$lang['update_payment_error'] = 'Selected payment log cannot be updated as it has been canceled/completed';