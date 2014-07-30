<?php
namespace Rebrec\VpnSSHGw\Shell;

use Rebrec\VpnSSHGw\Config\Configuration as Configuration;

//use Config\Configuration;

error_reporting(E_ALL);

class UserProfile
{
    private $strUsername = null;
    private $strProfilePath = null;

    public function __construct($strUsername)
    {
    	if ($strUsername == '') {
            die("Empty Username !");
        }
	$this->strUsername = $strUsername;
	$this->strProfilePath = Configuration::PROFILE_HOME_DIRECTORY . "/" . $this->strUsername;
	if (!($this->UserExists())) {
            $this->AddUser();
	} else {
            echo "Profile already exist, mapping to it.";	
	}
    }

    public function GetProfilePath()
    {
        return $this->strProfilePath;
    }

    public function AddUser()
    {
        $cmd = 'sudo ' . Configuration::PROJECT_ROOT . Configuration::BASH_ADDUSER_SCRIPT . " " . $this->strUsername;
        echo "Running command : $cmd\n";
        $res = passthru($cmd);
        echo "User Created into : " . $this->strProfilePath;
    }
    public function DelUserProfile()
    {
        // Kill Running processes owned by username
        $cmd = "sudo " . Configuration::PROJECT_ROOT . Configuration::BASH_KILLPROCESSES . " " . $this->strUsername;
        echo "Running Command : " . $cmd;
        $res = passthru($cmd);
        // Delete User
        $cmd = 'sudo deluser ' . $this->strUsername;
        echo "Running Command : " . $cmd;
        $res = passthru($cmd);
        // Remove Profile Directory
        $cmd = 'sudo rm -rf ' . $this->GetProfilePath();
        echo "Running Command : " . $cmd;
        $res = passthru($cmd);
    }    
    public function AddAuthKey($authKey)
    {
        $authKey->AddToFile($this->strUsername, $this->strProfilePath . '/' . Configuration::SSH_DIRECTORY . "/" . Configuration::AUTHORIZEDKEYS_FILENAME);
    }
    public function UserExists() // return true if user already created (used to be able to map to a userprofile object to remove it from system/filesystem)
    {
        if (is_dir($this->strProfilePath)) {
            return true;
        } else {
            return false;
        }
    }
}