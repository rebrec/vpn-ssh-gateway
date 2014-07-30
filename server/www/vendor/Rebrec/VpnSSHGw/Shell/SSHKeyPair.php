<?php
namespace Rebrec\VpnSSHGw\Shell;

use Rebrec\VpnSSHGw\Config\Configuration as Configuration;


error_reporting(E_ALL);


class SSHKeyPair
{
    private $strPubKey = null;
    private $strPrivKey = null;
	private $strPuttyPPK = null;
    private $strType = null;
    private $strSession = null;
	private $intSize = null;
	private $strTemporaryKey = null; 
	
    public function __construct( $strSession,  $intSize = 2048, $strType = 'rsa')
    {
    	$this->strTemporaryKey = Configuration::PROJECT_ROOT . Configuration::TEMPORARY_ROOT_DIRECTORY; 
		$this->strSession = $strSession;
		$this->intSize = $intSize;
		$this->strType = $strType;
		$this->GenKeyPair();
    }
    public function GetPubKey()
    {
        return $this->strPubKey;
    }

    public function GetPrivKey()
    {
    	return $this->strPrivKey;
    }
	private function CleanUpTemporaryFiles()
	{
		passthru('rm ' . $this->GetTemporaryKeyFilename() . '*' );
	}

	private function GetTemporaryKeyFilename()
	{
		if (ctype_alnum($this->strSession))
		{
			return $this->strTemporaryKey . '-' . $this->strSession;
		}
		else die("Wrong Session ID!"); 
		
	}

    private function GenKeyPair()
	{
		$cmd = 'echo "y" | /usr/bin/ssh-keygen -t ' . $this->strType . ' -C "Generated for vpn-ssh-gw" -b ' . $this->intSize . ' -f ' . $this->GetTemporaryKeyFilename() . ' -P ""';
		echo "running command : " . $cmd;
		$res = passthru($cmd);
		$this->strPubKey = file_get_contents($this->GetTemporaryKeyFilename() . ".pub");
		$this->strPrivKey = file_get_contents($this->GetTemporaryKeyFilename());
		$cmd = '/usr/bin/puttygen ' . $this->GetTemporaryKeyFilename() . ' -o ' . $this->GetTemporaryKeyFilename() . '.ppk' ;
		echo "running command : " . $cmd;
		$res = passthru($cmd);
		$this->strPuttyPPK = file_get_contents($this->GetTemporaryKeyFilename() . '.ppk');
		$this->CleanUpTemporaryFiles();
		/*echo 'Private Key : ' . $this->strPrivKey;
		echo 'Public Key : ' . $this->strPubKey;
		echo 'PuTTY Key : ' .$this->strPuttyPPK;
		*/ 
	}
    public function GetPPKKey()
    {
		return $this->strPuttyPPK;
    }

}