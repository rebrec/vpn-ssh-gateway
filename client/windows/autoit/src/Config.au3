#include-once
Const $APPNAME = "VPNSSHGateway"
Const $TUN_NAME = 1
Const $TUN_PROTO = 2
Const $TUN_IP = 3
Const $TUN_PORT = 4
Const $TUN_LPORT = 5
Const $CTRL_ID = 6

Global $strPuttySessionName = "session-" & $APPNAME
Global $jsonURL = "http://192.168.103.210/get_config.php"
Global $localPortMin = 10000
Global $localPortMax = 65534
Global $tunnelWaitTime = 3000 ; time to wait for putty tunnel to establish before giving control back to main loop
Global $SSH_WINDOW_SHOW_FLAG = @SW_HIDE ; can be either @SW_HIDE , @SW_MINIMIZE , @SW_MAXIMIZE
Global $btnQuit
Global $GUI



