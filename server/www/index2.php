<?php
$con = new Mongo();
$db= $con->bdTest;
$tickets = $db->tickets;

$session = "666655554444333";

$query = array('auth_key' => $session);




$ticket = $tickets->findOne($query);
// for debugging
//echo '<pre>'; print_r($ticket); echo '</pre>';

if ($ticket['auth_key'] === null)
{
	$jsonData['msg'] = 'Invalid Session!';
}
else 
{
	$jsonData['msg'] = 'ok';
}
$jsonData['host'] = $ticket['ssh_host_ip'];
$jsonData['port'] = $ticket['ssh_host_port'];
$jsonData['session'] = $ticket['temporary_session_for_vpn-ssh-gateway'];
$jsonData['user'] = $ticket['user'];
$jsonData['private_key'] = $ticket['ppk_key'];
$jsonData['tunnels'] = $ticket['tunnels'];



//$jsonData['private_key'] = file_get_contents('/home/administrtateur/projet/vpn-ssh-gateway/server/www/user.ppk');

echo json_encode($jsonData);//

?>
