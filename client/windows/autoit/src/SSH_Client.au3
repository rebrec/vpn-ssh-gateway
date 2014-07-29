#cs ----------------------------------------------------------------------------

 AutoIt Version: 3.3.8.1
 Author:         Francois Laplaud



#ce ----------------------------------------------------------------------------

#include "Config.au3"
#include "TunnelManager.au3"
#include "ConfigManager.au3"
#include "AppLauncher.au3"


#include <MsgBoxConstants.au3>
#include <GUIConstantsEx.au3>
#include <ButtonConstants.au3>

#include <WindowsConstants.au3>



Func Main()
	if getConfig($jsonURL) Then
		KillWindowName($strSession)
  		startSSHTunnel($strSession, $SSH_WINDOW_SHOW_FLAG, 1)
	Else
		MsgBox(0,$APPNAME, "Error While trying to retrieve configuration data from WebService")
		Exit
	EndIf
	GenGui()
	ProcessGuiEvents() ; main loop
EndFunc

Func GenGui()
	$GUI = GUICreate($APPNAME, 200, 50+Ubound($arrTunnels)*25 , 300, 200)

	For $line = 0 to UBound($arrTunnels)-1 ; For each Tunnel
		$arrTunnel = $arrTunnels[$line]
		$ctrlID = GUICtrlCreateButton($arrTunnel[$TUN_NAME][1], 10, $line * 25, 180, 24)
		_ArrayAdd($arrTunnels[$line],"ctrlid|" & $ctrlID)
	Next
	$btnQuit = GUICtrlCreateButton("&Quitter", 10, ($line + 1) * 25, 180, 25)
	GUISetState(@SW_SHOW)
EndFunc

Func ProcessGuiEvents()
	While 1
		$nMsg = GUIGetMsg()
		Switch $nMsg
			Case $GUI_EVENT_CLOSE
				Terminate()

			Case $btnQuit
				Terminate()
			Case Else
				For $arrTunnel in $arrTunnels
					$ctrlID = $arrTunnel[$CTRL_ID][1]
					if $ctrlID = $nMsg Then
						$tunName = $arrTunnel[$TUN_NAME][1]
						$tunProto = $arrTunnel[$TUN_PROTO][1]
						$tunIP = $arrTunnel[$TUN_IP][1]
						$tunPORT = $arrTunnel[$TUN_PORT][1]
						$tunLPORT = $arrTunnel[$TUN_LPORT][1]
						Launch($tunName, $tunProto, $tunIP, $tunPORT, $tunLPORT)
						;ConsoleWrite($tunName & " : " & $tunLPORT & " ==> " & $tunIP & ":" & $tunPORT  & @CRLF)
					EndIf
				Next
		EndSwitch
	WEnd
EndFunc

Func Terminate()
	KillWindowName($strSession)
	Exit
EndFunc

Main()

