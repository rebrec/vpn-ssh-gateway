<?php
include_once 'config.php';

class Tool
{

	public static function GenerateSessionId()
	{
		return bin2hex(openssl_random_pseudo_bytes(Configuration::TOOL_SESSION_CAR_NUMBER));
	}


	
}
