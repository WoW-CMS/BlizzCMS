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

$lang['donate'] = 'Donar';
$lang['donate_panel'] = 'Panel de Donaciones';
$lang['view_log'] = 'View log';

$lang['mode'] = 'Modo';
$lang['client_id'] = 'ID Cliente';
$lang['secret'] = 'Secreto';
$lang['currency'] = 'Moneda';
$lang['payment_id'] = 'ID Pago';
$lang['amount'] = 'Cantidad';
$lang['rewarded'] = 'Recompensado';
$lang['reference_id'] = 'ID Referencia';
$lang['order_id'] = 'ID Orden';
$lang['gateway'] = 'Gateway';
$lang['points'] = 'Puntos';
$lang['minimal_amount'] = 'Cantidad mínima';
$lang['virtual_currency'] = 'Moneda virtual';
$lang['currency_exchange'] = 'Tasa de cambio de moneda';
$lang['manual_payment'] = 'Pago manual';

$lang['sandbox'] = 'Sandbox';
$lang['production'] = 'Producción';
$lang['declined'] = 'Rechazada';
$lang['completed'] = 'Terminada';
$lang['pending'] = 'Pendiente';

$lang['select_mode'] = 'Seleccionar un modo';
$lang['select_currency'] = 'Seleccionar una moneda';
$lang['select_gateway'] = 'Select a gateway';

$lang['enable_paypal_donation'] = '¿Habilitar la donación por PayPal?';

$lang['donation_statistics'] = 'Estadísticas de donaciones';
$lang['latest_donations'] = 'Últimas donaciones';
$lang['create_manual_payment'] = 'Crear pago manual';
$lang['update_payment'] = 'Actualizar pago';

$lang['paypal_contribution'] = 'Puedes contribuir a nuestro servidor donando a través del método paypal y recibirás puntos de donación que podrás utilizar en nuestra tienda, etc.';
$lang['paypal_exchange_rate'] = 'Cada <b>%1$d %2$s</b> = <b>%3$d</b> DP';

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