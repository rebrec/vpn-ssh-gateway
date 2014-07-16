<?php

include 'class.SSHKeyPair.php';
include 'class.SSHAuthKey.php';

$k = new SSHKeyPair("a25z2d6z98d987qs1f15dq123fe6qs5d6zq654zgz65gd65h4");

$a = new SSHAuthKey($k->GetPubKey(), array("10.10.1.3:21","192.168.1.1:33"));
echo "\n";
echo " " . $a->GetAuthKeyString();
