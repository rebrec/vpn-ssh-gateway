<?php
namespace Rebrec\VpnSSHGw;

use Rebrec\VpnSSHGw\Config\Configuration as Configuration;

class Tools
{
	public static function GenerateSessionId()
	{
		return bin2hex(openssl_random_pseudo_bytes(Configuration::TOOL_SESSION_CAR_NUMBER));
	}
}
