<?php

include_once 'class.UserProfile.php';

$session = $_GET['s'];
if(getenv('REMOTE_ADDR'))
{
	$ipaddress = getenv('REMOTE_ADDR');
}
else
{
	die("REMOTE_ADDR not defined!");
}
$con = new Mongo();
$db= $con->bdTest;
$ticket = $db->tickets->findone( array('auth_key' => $session, 'client_ip'=> '') );
if ($ticket === null) die("Wrong Session or IP aldready recorded!");
$query = array('auth_key'=> $session);
$ticket['client_ip']=$ipaddress ;
$db->tickets->update($query,$ticket);

echo "Saving Allowing IP $ipaddress  for session $session ...</br>";
  
// Function to get the client IP address
    
