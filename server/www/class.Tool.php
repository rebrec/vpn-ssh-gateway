<?php
include_once 'config.php';

class Tool
{

	public static function generateSessionId()
	{
		return bin2hex(openssl_random_pseudo_bytes(Configuration::TOOL_SESSION_CAR_NUMBER));
	}

	public static function generateUniqueToken($number) // from http://stackoverflow.com/questions/19233442/php-generate-random-alphanumeric-string-that-is-unique-to-values-in-phpmyadmin
	{
	    $arr = array('a', 'b', 'c', 'd', 'e', 'f',
	                 'g', 'h', 'i', 'j', 'k', 'l',
	                 'm', 'n', 'o', 'p', 'r', 's',
	                 't', 'u', 'v', 'x', 'y', 'z',
	                 'A', 'B', 'C', 'D', 'E', 'F',
	                 'G', 'H', 'I', 'J', 'K', 'L',
	                 'M', 'N', 'O', 'P', 'R', 'S',
	                 'T', 'U', 'V', 'X', 'Y', 'Z',
	                 '1', '2', '3', '4', '5', '6',
	                 '7', '8', '9', '0');
	    $token = "";
	    for ($i = 0; $i < $number; $i++) {
	        $index = rand(0, count($arr) - 1);
	        $token .= $arr[$index];
	    }
	
	    if (isToken($token)) {
	        return generateUniqueToken($number);
	    } else {
	        return $token;
	    }
	}
	
}
