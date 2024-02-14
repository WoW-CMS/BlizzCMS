<?php
/**
 * BlizzCMS
 *
 * @author WoW-CMS
 * @copyright Copyright (c) 2019 - 2023, WoW-CMS (https://wow-cms.com)
 * @license https://opensource.org/licenses/MIT MIT License
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class License_hook
{
    protected $apiURL = 'https://web-strapi.779pbk.easypanel.host/clientes';

    private $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
    }

    /**
     * Purge logs on the defined date
     */
    public function check()
    {
        $isValidLicense = false;
        $allowedDomain = base_url();

        $allowedDomain = str_replace('http://', '', $allowedDomain);
        $allowedDomain = rtrim($allowedDomain, '/');

        if (!$this->CI->session->flashdata('license_error_message')) {
            $curl = curl_init($this->apiURL);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($curl);
            $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            if ($httpCode == 200) {
                // Analizar la respuesta JSON
                $responseData = json_decode($response, true);

                $licenseFound = false;

                for ($i = 0; $i < count($responseData); $i++) {
                    $data = $responseData[$i];
                    if ($data['url'] == $allowedDomain) {
                        if (isset($data['licenseKey'])) {
                            $knownLicenseKey = $this->CI->config->item('cms_licenseKey');
                            if ($data['licenseKey'] === $knownLicenseKey) {
                                $licenseFound = true;
                                break;
                            }
                        }
                    }
                }

                if ($licenseFound) {
                    $isValidLicense = true;
                } else {
                    $this->CI->session->set_flashdata('license_error_message', 'No valid license found for this domain.');
                }
            } else {
                $this->CI->session->set_flashdata('license_error_message', 'Error while fetching license information from the API.');
            }
        }

        return $isValidLicense;
    }
}
