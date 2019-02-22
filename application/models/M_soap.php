<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_soap extends CI_Model {

    public function connect($soapUser, $soapPass, $soapHost, $soapPort, $soap_uri)
    {
        $this->client = new SoapClient(NULL, array(
            "location"      => "http://".$soapHost.":".$soapPort."/",
            "uri"           => "urn:". $soap_uri ."",
            "style"         => SOAP_RPC,
            "login"         => $soapUser,
            "password"      => $soapPass,
            "trace"         => 1,
            "exceptions"    => 0
            )
        );

        if (is_soap_fault($this->client))
        {
            return 'Soap not found';
        }
        return $this->client;
    }

    public function commandSoap($command, $soapUser, $soapPass, $soapHost, $soapPort, $soap_uri)
    {
        $client = $this->connect($soapUser, $soapPass, $soapHost, $soapPort, $soap_uri);
        return $client->executeCommand(new SoapParam($command, "command"));
    }
}
