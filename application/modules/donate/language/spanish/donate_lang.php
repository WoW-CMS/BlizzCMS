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
$lang['view_log'] = 'Ver registro';

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
$lang['order_notfound'] = 'La orden no ha sido posible encontrarla';
$lang['order_process_error'] = 'La orden aún no ha sido procesada por completo. Por favor, póngase en contacto con nuestro equipo de soporte para obtener más detalles';
$lang['order_already_rewarded'] = 'La orden ya ha sido procesada y se ha entregado la recompensa correspondiente';

$lang['order_canceled'] = 'La orden <b>%1$s</b> ha sido cancelada. Si cree que esto es un error, comuníquese con nuestro equipo de soporte';
$lang['order_completed'] = 'La orden <b>%1$s</b> se ha completado. Si sus puntos aún no son visibles, comuníquese con nuestro equipo de soporte';
$lang['manual_payment_created'] = 'El pago manual ha sido creado';
$lang['payment_updated'] = 'Los datos del pago se han actualizado';
$lang['update_payment_error'] = "El pago no se puede actualizar porque se marcó como cancelado/completado";