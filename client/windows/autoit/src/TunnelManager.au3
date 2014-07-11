#include-once
#include "JSON.au3"
#include "SSHConfigGenerator.au3"

Const $strWINTITLE = "temporary_session_for_vpn-ssh-gateway"



Func startSSHTunnel($strSession, $WinStatus, $verbose = 0)
	genPuttyConfig(getStrHost(), getStrSSHPort(), getStrSession(), getStrUsername(), getStrPubKey())
	addSSHRegFile($strSession)
	Run(@ScriptDir & "\putty.exe -load " & $strSession,"",$WinStatus)
	Sleep($tunnelWaitTime)
	delSSHRegFile($strSession)
	delConfigFiles($strSession)
	If $verbose <> 0 Then MsgBox(0,"","Tunnel Established, Forwarded List : " & getStrPortForwarding(),60)
EndFunc


Func KillWindowName($strWinTitle)
	While WinExists( $strWinTitle )
		ProcessClose(WinGetProcess( $strWinTitle ))
		Sleep(100)
	WEnd
EndFunc


