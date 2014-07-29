<?php
namespace Rebrec\VpnSSHGw;

use Config\Configuration;


class Tools
{
	public static function GenerateSessionId()
	{
		return bin2hex(openssl_random_pseudo_bytes(Configuration::TOOL_SESSION_CAR_NUMBER));
	}
}
