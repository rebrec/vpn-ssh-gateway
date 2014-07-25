<?php

include_once 'class.SSHKeyPair.php';
include_once 'class.SSHAuthKey.php';
include_once 'class.UserProfile.php';
include_once 'class.Tool.php';
include_once 'config.php';

print_r(array_keys($_GET));

$session = $_GET['s'];
$con = new Mongo();
$db= $con->bdTest;
$ticket = $db->tickets->findone( array('auth_key' => $session) );

print_r(array_keys($ticket));


$username = $ticket['user'];
echo "Trying to remove profile of username $username ...</br>";
$u = new UserProfile($username);
$u->DelUserProfile();
echo "Trying to remove session $session ...</br>";
$db->tickets->remove( array('auth_key' => $session) );
 
