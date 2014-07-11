#include-once

Const $APPNAME = "VPNSSHGateway"
Global $jsonURL = "http://192.168.103.210/index.php"
Global $localPortMin = 10000
Global $localPortMax = 65534
Global $tunnelWaitTime = 3000 ; time to wait for putty tunnel to establish before giving control back to main loop
