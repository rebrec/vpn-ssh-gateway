#include-once
#include "Config.au3"


Func Launch($tunName, $tunProto, $tunIP, $tunPORT, $tunLPORT)
	Switch $tunProto
		Case "telnet"
			$strCmd = @ScriptDir & "\" & "putty.exe -telnet " & "127.0.0.1 " & $tunLPORT
		Case "ssh"
			$strCmd = @ScriptDir & "\" & "putty.exe -ssh " & "127.0.0.1 " & $tunLPORT

		Case "vnc"
			$strCmd = @ScriptDir & "\" & "vncviewer.exe " & "127.0.0.1:" & $tunLPORT

		Case "rdp"
			$strCmd = EnvGet("WINDIR") & "\system32\mstsc.exe /v " & "127.0.0.1:" & $tunLPORT

		Case Else
			MsgBox(0, $APPNAME,"Application inconnue : " & $tunProto)
			Exit
	EndSwitch
	ConsoleWrite("Running command : " & $strCmd & @CRLF)
	Run($strCmd)
EndFunc

