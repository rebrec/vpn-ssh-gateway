<?php

$ip = '192.168.103.210';
$port = '22';
$session = 'temporary_session_for_vpn-ssh-gatewayjson';
$user = 'tunneltest';
$tunnels = array("10.172.1.21:23", "10.172.1.20:23", "192.168.100.53:3389", "192.168.100.9:3389", "192.168.100.4:3389", "10.172.1.60:3389");

$private_key = 'PuTTY-User-Key-File-2: ssh-rsa
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

$jsonData['host'] = $ip;
$jsonData['port'] = $port;
$jsonData['session'] = $session;
$jsonData['user'] = $user;
//$jsonData['tunnels'] = $tunnels;
$jsonData['private_key'] = $private_key;
$jsonData['tunnels'] = $tunnels;



echo json_encode($jsonData);

/*
$json_data = '{
  "host": "192.168.103.210",
  "port": 22,
  "session": "temporary_session_for_vpn-ssh-gatewayjson",
  "user": "tunneltest",
  "tunnels": [
    "10.172.1.21:23",
    "10.172.1.20:23",
    "192.168.100.4:3389"
  ],
  "private_key":"PuTTY-User-Key-File-2: ssh-rsa
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
"
}'
*/


?>

