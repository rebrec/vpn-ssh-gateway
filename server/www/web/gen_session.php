<?php
require_once __DIR__.'/../vendor/autoload.php'; 

use Rebrec\VpnSSHGw\Config\Configuration as Configuration;

$session = Rebrec\VpnSSHGw\Tools::GenerateSessionId();
$username = "usr-$session"; 
$arrTunnels = array(
    array('name' => "Swrt-Coulaines-CTA-1",
        'proto'=> "telnet",
        'tunnelIP' => "10.172.1.21",
        'tunnelPort' => "23"
    ), array('name' => "Swrt-Coulaines-Srv-1",
        'proto'=> "ssh",
        'tunnelIP' => "10.172.1.20",
        'tunnelPort' => "22"
    ), array('name' => "srv-dc03",
        'proto'=> "rdp",
        'tunnelIP' => "192.168.100.53",
        'tunnelPort' => "3389"
    ), array('name' => "jesais plus",
        'proto'=> "rdp",
        'tunnelIP' => "192.168.100.9",
        'tunnelPort' => "23"
    ), array('name' => "Apollon"
        , 'proto'=> "rdp",
        'tunnelIP' => "10.172.1.60",
        'tunnelPort' => "3389"
    )
);

$u = new Rebrec\VpnSSHGw\Shell\UserProfile($username);
$k = new Rebrec\VpnSSHGw\Shell\SSHKeyPair($session);
$a = new Rebrec\VpnSSHGw\Shell\SSHAuthKey($k->GetPubKey(), $arrTunnels);
$u->AddAuthKey($a);

$con = new Mongo();
$db= $con->bdTest;

$ticket['auth_key'] = $session;
$ticket['allowed_time'] = '1000';
$ticket['revoke_date'] = '';
$ticket['client_ip'] = '';
$ticket['ssh_host_ip'] = Configuration::VPN_SSH_SERVER_HOST;
$ticket['ssh_host_port'] = Configuration::VPN_SSH_SERVER_PORT;
$ticket['tunnels'] = $arrTunnels;
$ticket['session'] = "vpnsshgw"; // better to use a static session so that Windows Client can kill previously unshut tunnels   . "-$session";
$ticket['user'] = $username;
$ticket['public_key'] = $k->GetPubKey();
$ticket['private_key'] = $k->GetPrivKey();
$ticket['ppk_key'] = $k->GetPPKKey();
  
$db->tickets->insert($ticket);

echo 'A New Tocken have been, generated for testint purpose.<br/>';
echo '<br/><a href="save_myip.php?s=' . $session . '" target="_blank">Click Here</a> to access to the register IP page...';
echo '<br/><a href="del_session.php?s=' . $session . '" target="_blank">Click Here</a> to Remove this Session...';
