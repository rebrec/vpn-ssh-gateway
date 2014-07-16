<?php

$con = new Mongo();
$db= $con->bdTest;


$ticket['auth_key'] = '123458';
$ticket['allowed_time'] = '1000';
$ticket['revoke_date'] = '';
$ticket['client_ip'] = '192.168.103.15';
$ticket['ssh_host_ip'] = '192.168.103.210';
$ticket['ssh_host_port'] = '22';
$ticket['tunnels'] = array("10.172.1.21:23", "10.172.1.20:23", "192.168.100.53:3389", "192.168.100.9:3389", "192.168.100.4:3389", "10.172.1.60:3389");
$ticket['user'] = 'tunneltest';
$ticket['public_key'] = 'ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABAQDD4zc+koxn60UwzQk38zF0QWy89Q2vqeNM4XY6f9b35ZCfgYeLgXFXr5J+AvMWRJkb4LEiBPad2tMuLRiNjM2XGIUhDUhGnLz4CIvg1LYWzkGTnHvh0c3IDmT41PvXV25xcBKtV4nxDNyynOGJ+1UZZzISrWG/OV/EWul7z2FYhnzunKkM1n7lqN7Jfl0ccQTqE3rHIphCCUSMgDwIBmkOxhcujAq41J5BzCr795Hh9lQTbanT1HSdrrNf8oEmLcMZkMuzx3eBgYjh/GtO/uVDfLoBz+K51QOkdcdVAfYzsk/CSWOOedijntXsPZqtc3Y6a0LYpV2mX4d8cybPUdQF Generated for vpn-ssh-gateway';
$ticket['private_key'] = 'PuTTY-User-Key-File-2: ssh-rsa
Encryption: none
Comment: imported-openssh-key
Public-Lines: 6
AAAAB3NzaC1yc2EAAAADAQABAAABAQDD4zc+koxn60UwzQk38zF0QWy89Q2vqeNM
4XY6f9b35ZCfgYeLgXFXr5J+AvMWRJkb4LEiBPad2tMuLRiNjM2XGIUhDUhGnLz4
CIvg1LYWzkGTnHvh0c3IDmT41PvXV25xcBKtV4nxDNyynOGJ+1UZZzISrWG/OV/E
Wul7z2FYhnzunKkM1n7lqN7Jfl0ccQTqE3rHIphCCUSMgDwIBmkOxhcujAq41J5B
zCr795Hh9lQTbanT1HSdrrNf8oEmLcMZkMuzx3eBgYjh/GtO/uVDfLoBz+K51QOk
dcdVAfYzsk/CSWOOedijntXsPZqtc3Y6a0LYpV2mX4d8cybPUdQF
Private-Lines: 14
AAABADaExptjrjA+CsPKTQaFaP4yN1Ff4q9BWUHMfltJuUrFWbsLEe6B2EnPU7Y+
m+lWrkZUAvi06O6GOMBhTLQYvB+Rc3v/dl4wwWdG+adZjFRMk3PB2bi/68YCO5gF
rxIAA30O9CPKeVndeo87mooMqWKolgccule+YCkGJHWRAkbgql/q6UxqBJXnGVZI
lx00FQpEhiTVrvfL1zV6+e4RG/wWYjr1Z79Vbvy3nRTZCh8LYhf0LbLiFddhy+e6
VIN49zcCK7tulzFlBd72oVrRVWIlC9xC6coLfA5g/6QqXch/ohhznDjMURIuQpoW
80IJeePrIFGgIG7gidSwfQzSgAEAAACBAPHLeQWIwUw0AXmrREsIAeruTbLzyJXR
S9yIOvZbfUnJzIFZ9XeVrMJtJ2ilTnwn2C/X8wOIWpwSZ7UqLspudKPsHYPYpX1M
kBOFsMQS5iK6h2RnlcDcJc+HcZa4cHLLtYNyyco02xn+WSvBn0Inr2MkvejRgy2U
kdEeQthgpJmBAAAAgQDPZU+F/t8Qj85BOZilwolX/E/hS1NxojdbbDY8HY9Ez37/
lHsj6bUho5i4SG1dsqFE+LJC8IgYaULnnsWQH7r+KtkxbvlLf4z6PrPYZLRgzU2d
cZlC608BctcUsYlm2MDqg0rC8cC9Ub6i3QLDECQ+disL7RQC8lnw57MzhdAUhQAA
AIEAzsUPXAs290NSQ5cQ9jhAUbPNUlbIoHLhyQOGjWad9iqMdMcKTFRrLZ65LvoC
6vMeb5gP9X0hOgEEMwrhfZdXby5/2kDytV2Ye/HzXP0JNtK+kREVx0Oamn20/ASo
jKLRIZfBdhkYsT+Hj43KF3IgIDqnLOXQOJcAFV73jW423Qk=
Private-MAC: 398f98fcaeee87d6352e2ffa63e37a444f7aa965
';


 
/*	array("titre" => 'MongoDB exemple', 
             "" => 'Ceci est un test darticle pour tester MongoDB', 
             "date" =>  '2009-03-03', 
             "auteur" => 'DJo',
             "comments" => array(
                  array("texte" => 'Super article !!', 
                    "date" => '2009-03-04',
                    "auteur" => 'Toto'),
                 array("texte" => 'Je confirme, le NoSQL çdéire !', 
                    "date" => '2009-03-04',
                    "auteur" => 'Novaway')
             )
        );
*/
$db->tickets->insert($ticket);

?>
