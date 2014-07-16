<?php
include_once 'config.php';

error_reporting(E_ALL);

class SSHAuthKey
{
    private $strPubKey = null;
    private $strRestrictions = null;
    private $arrTunnels = null;

    public function __construct($strPubKey, $arrTunnels)
    {
		$this->strPubKey = $strPubKey;
		$this->arrTunnels = $arrTunnels;
		$this->strRestrictions = Configuration::AUTHORIZEDKEYS_RESTRICTIONS;
    }
    public function GetPermitOpenRule()
    {
		$res ="";
    	if (empty($this->arrTunnels))  // if arrtunnels is empty generate no-port-forwarding rule
    	{
    		$res = ",no-port-forwarding";
    	}
		else { // loop through each tunnel to generate permitopen="xxxxxxxx" data
			foreach ($this->arrTunnels as $strTunnel)
			{
				$res = $res . ',permitopen="' . $strTunnel . '"';
			}
		}
		return $res;
        
    }

    public function GetAuthKeyString()
    {
    	$returnValue = $this->strRestrictions . $this->GetPermitOpenRule() . " " . $this->strPubKey;
        return $returnValue;
    }

} /* end of class SSHAuthKey */
