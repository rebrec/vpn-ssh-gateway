<?php
class Configuration
{
	const PROJECT_ROOT					= '/home/administrtateur/projet/vpn-ssh-gateway/';
	const TEMPORARY_ROOT_DIRECTORY 		= 'server/tmp/temporarykey';
	const HOME_DIRECTORY 				= "/home/";
	const AUTHORIZEDKEYS_RESTRICTIONS 	= "command='watch \"echo This account can only be used for VPN-SSH-GW!\"',no-agent-forwarding,no-user-rc,no-x11-forwarding";
	const AUTHORIZEDKEYS_OCTAL_MASK		= 0600;
	const AUTHORIZEDKEYS_FILENAME		= "authorized_keys";
	const SSH_DIRECTORY					= ".ssh";
	const PROFILE_SKEL_DIRECTORY		= "server/bash/skel";
	const BASH_ADDUSER_CONFIGURATION	= "server/bash/adduser.conf"; 
}

