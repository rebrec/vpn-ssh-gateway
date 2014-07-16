<?php

include 'class.SSHKeyPair.php';
include 'class.SSHAuthKey.php';
include 'class.UserProfile.php';

$session = "a25z2d6zssssssssaze";
$k = new SSHKeyPair($session);

$a = new SSHAuthKey($k->GetPubKey(), "");
echo "\n";
echo " " . $a->GetAuthKeyString();
//$a->AddToFile("/home/administrtateur/test.test");


$u = new UserProfile("usr" . $session);
$u->AddAuthKey($a);
