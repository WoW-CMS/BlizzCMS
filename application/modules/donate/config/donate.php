<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| PayPal Currency
|--------------------------------------------------------------------------
|
| Check the available currencies in:
| https://developer.paypal.com/docs/classic/api/currency_codes/
|
*/
$config['currencyType'] = 'USD';

/*
|--------------------------------------------------------------------------
| PayPal Mode
|--------------------------------------------------------------------------
|
| Options Available:
|
| sandbox = Testing the code end-to-end
| live    = Ready for production
|
*/
$config['ppMode'] = 'sandbox';

/*
|--------------------------------------------------------------------------
| PayPal Client ID
|--------------------------------------------------------------------------
|
| Check your client id in:
| https://developer.paypal.com/developer/applications
|
*/
$config['userID'] = 'AeEKmkcWH_NGf5Uxkoos5ESv3fffSBnlC1b-BJTAUF2vP02Klwa_IXXzUKqtP1tGZHF_gCRPjNjyBo7V';

/*
|--------------------------------------------------------------------------
| PayPal Secret Password
|--------------------------------------------------------------------------
|
| Check your secret password in:
| https://developer.paypal.com/developer/applications
|
*/
$config['secretPass'] = 'EEaly2bYOVTbv1hsMPesPESGF-fFyFm_HMWij_0mFiiRAEibc-SdSeqCMPFlF0ziuzsZXNcBXxecsn2V';

/*
|--------------------------------------------------------------------------
| Currency Symbol
|--------------------------------------------------------------------------
|
| Write the symbol of currency used in paypal
|
*/
$config['currencySymbol'] = '$';