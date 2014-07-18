<?php
$con = new Mongo();
$db= $con->bdTest;
$tickets = $db->tickets;


$query = array('auth_key' => '123458');




$ticket = $tickets->findOne($query);
// for debugging
//echo '<pre>'; print_r($ticket); echo '</pre>';

$jsonData['host'] = $ticket['ssh_host_ip'];
$jsonData['port'] = $ticket['ssh_host_port'];
$jsonData['session'] = $ticket['temporary_session_for_vpn-ssh-gateway'];
$jsonData['user'] = $ticket['user'];
$jsonData['private_key'] = $ticket['ppk_key'];
//$jsonData['private_key'] = file_get_contents('/home/administrtateur/projet/vpn-ssh-gateway/server/www/user.ppk');
$jsonData['tunnels'] = $ticket['tunnels'];

echo json_encode($jsonData);//

?>
