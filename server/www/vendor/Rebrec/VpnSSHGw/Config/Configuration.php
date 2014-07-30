<?php
namespace Rebrec\VpnSSHGw\Config;

class Configuration
{
	const TOOL_SESSION_CAR_NUMBER		= 10; // the session_key will be twice this length
	
	const PROJECT_ROOT					= '/home/administrtateur/projet/vpn-ssh-gateway/';
	const TEMPORARY_ROOT_DIRECTORY 		= 'server/tmp/temporarykey';
	
	const AUTHORIZEDKEYS_RESTRICTIONS 	= "command=\"watch echo This account can only be used for VPN-SSH-GW!\",no-agent-forwarding,no-user-rc,no-x11-forwarding";
	const AUTHORIZEDKEYS_MASK			= "600";
	const AUTHORIZEDKEYS_FILENAME		= "authorized_keys";
	const SSH_DIRECTORY					= ".ssh";
	
	const PROFILE_HOME_DIRECTORY 		= "/home";
	const PROFILE_SKEL_DIRECTORY		= "server/bash/skel";
	const BASH_ADDUSER_CONFIGURATION	= "server/bash/adduser.conf"; 
	const BASH_ADDUSER_SCRIPT			= "server/bash/adduser.sh"; 
	const BASH_KILLPROCESSES			= "server/bash/kill_userprocesses.sh";
	
	const VPN_SSH_SERVER_HOST			= "192.168.103.210";
	const VPN_SSH_SERVER_PORT			= "22";
}

