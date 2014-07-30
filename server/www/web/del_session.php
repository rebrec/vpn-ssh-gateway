<?php
require_once __DIR__.'/../vendor/autoload.php'; 

use Rebrec\VpnSSHGw\Shell\UserProfile as UserProfile;

$session = $_GET['s'];
$con = new Mongo();
$db= $con->bdTest;
$ticket = $db->tickets->findone( array('auth_key' => $session) );

print_r(array_keys($ticket));


$username = $ticket['user'];
echo "Trying to remove profile of username $username ...</br>";
$u = new UserProfile($username);
echo "Trying to remove profile of username $username ...</br>";
echo "Profile directory : " . $u->GetProfilePath();
$u->DelUserProfile();
echo "Trying to remove session $session ...</br>";
$db->tickets->remove( array('auth_key' => $session) );
  
