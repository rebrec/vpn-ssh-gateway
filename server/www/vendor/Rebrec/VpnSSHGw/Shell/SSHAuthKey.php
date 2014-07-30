<?php
namespace Rebrec\VpnSSHGw\Shell;

use Rebrec\VpnSSHGw\Config\Configuration as Configuration;


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
    private function getPermitOpenRule()
    {
        $res ="";
    	if (empty($this->arrTunnels)) {  // if arrtunnels is empty generate no-port-forwarding rule
            echo "\n\nNO PORT FORWARDING !\n";
            $res = ",no-port-forwarding";
    	} else { // loop through each tunnel to generate permitopen="ip:port" data
            if (is_array($this->arrTunnels)) {
                foreach ($this->arrTunnels as $arrTunnel) {
                    $res = $res . ',permitopen="' . $arrTunnel['tunnelIP'] . ":" . $arrTunnel['tunnelPort'] . '"';
                }
            } else {
                $res = $res . ',permitopen="' . $this->arrTunnels . '"';
            }
        }
        return $res;
    }
    
    public function AddToFile($strUser, $strFilePath)
    {
        $strTemporaryFile = Configuration::PROJECT_ROOT . Configuration::TEMPORARY_ROOT_DIRECTORY . $strUser . "-authkey";
        file_put_contents($strTemporaryFile, $this->GetAuthKeyString());
        $cmd = 'sudo mv ' . $strTemporaryFile . " ". $strFilePath;
        echo "Running Command : " . $cmd;
        $res = passthru($cmd);
        //chmod($strFilePath, Configuration::AUTHORIZEDKEYS_OCTAL_MASK);
        $cmd = 'sudo chmod ' . Configuration::AUTHORIZEDKEYS_MASK . " " . $strFilePath;
        echo "Running Command : " . $cmd;
        $res = passthru($cmd); 
        $cmd = 'sudo chown ' .  $strUser . ".users " . $strFilePath;
        echo "Running Command : " . $cmd;
        $res = passthru($cmd);
    }
    public function GetAuthKeyString()
    {
    	$returnValue = $this->strRestrictions . $this->getPermitOpenRule() . " " . $this->strPubKey;
        return $returnValue;
    }

}