<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * PayPal Currency
 *
 * Check the available currencies in:
 * https://developer.paypal.com/docs/classic/api/currency_codes/
 *
*/
$config['paypal_currency'] = 'USD';

/**
 *
 * PayPal Mode
 *
 * Options Available:
 *
 * sandbox = Testing the code end-to-end
 * live    = Ready for production
 *
*/
$config['paypal_mode'] = 'sandbox';

/**
 *
 * PayPal Client ID
 *
 * Check your client id in:
 * https://developer.paypal.com/developer/applications
 *
*/
$config['paypal_userid'] = 'AeEKmkcWH_NGf5Uxkoos5ESv3fffSBnlC1b-BJTAUF2vP02Klwa_IXXzUKqtP1tGZHF_gCRPjNjyBo7V';

/**
 *
 * PayPal Secret Password
 *
 * Check your secret password in:
 * https://developer.paypal.com/developer/applications
 *
*/
$config['paypal_secretpass'] = 'EEaly2bYOVTbv1hsMPesPESGF-fFyFm_HMWij_0mFiiRAEibc-SdSeqCMPFlF0ziuzsZXNcBXxecsn2V';

/**
 *
 * PayPal Currency Symbol
 *
 * Write the symbol of currency used in paypal
 *
*/
$config['paypal_currency_symbol'] = '$';
