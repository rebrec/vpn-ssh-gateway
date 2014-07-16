<?php
include_once 'config.php';
include_once "class.SSHAuthKey.php";
error_reporting(E_ALL);
class UserProfile
{
    private $strUsername = null;
    private $strProfilePath = null;
    private $sshProfile = null;

    public function __construct($strUsername)
    {
		$this->strUsername = $strUsername;
		$this->strProfilePath = Configuration::HOME_DIRECTORY . $this->strUsername;
		$this->AddUser();
	}

    public function GetProfilePath()
    {
        return $this->strProfilePath;
    }

	public function AddUser()
	{
		$cmd = 'adduser --conf ' . Configuration::PROJECT_ROOT . Configuration::BASH_ADDUSER_CONFIGURATION . ' --skel ' . Configuration::PROJECT_ROOT . Configuration::PROFILE_SKEL_DIRECTORY. ' --disabled-password --gecos "automatically generated user ' . $this->strUsername . '" ' .  $this->strUsername;
		echo "---------------\n";
		echo "---------------\n";
		echo "Running command : $cmd\n";
		echo "---------------\n";
		echo $cmd;
		$res = passthru($cmd);
		echo "User Created into : " . $this->strProfilePath;
	}
	public function DelUser()
	{
		$cmd = 'deluser --remove-all-files ' . $this->strUsername;
		$res = passthru($cmd);
	}
    public function AddAuthKey($authKey)
    {
		$authKey->AddToFile($this->strProfilePath . "/" . Configuration::PROJECT_ROOT . Configuration::SSH_DIRECTORY . "/" . Configuration::AUTHORIZEDKEYS_FILENAME);
    }

} /* end of class UserProfile */

?>