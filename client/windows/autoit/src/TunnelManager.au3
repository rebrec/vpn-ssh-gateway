#include-once
#include "JSON.au3"
#include "SSHConfigGenerator.au3"


Func startSSHTunnel($strSession, $WinStatus, $verbose = 0)
	genPuttyConfig(getStrHost(), getStrSSHPort(), getStrSession(), getStrUsername(), getStrPubKey())
	addSSHRegFile($strSession)
	Run(@ScriptDir & "\putty.exe -load " & $strSession,"",$WinStatus)
	Sleep($tunnelWaitTime)
	delSSHRegFile($strSession)
	delConfigFiles($strSession)
	;MsgBox(0,"","Tunnel Established, Forwarded List : " & getStrPortForwarding(),5)
EndFunc


Func KillWindowName($strWinTitle)
	While WinExists( $strWinTitle )
		ProcessClose(WinGetProcess( $strWinTitle ))
		Sleep(100)
	WEnd
EndFunc


