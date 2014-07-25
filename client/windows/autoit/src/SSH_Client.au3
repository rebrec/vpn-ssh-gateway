#cs ----------------------------------------------------------------------------

 AutoIt Version: 3.3.8.1
 Author:         Francois Laplaud



#ce ----------------------------------------------------------------------------

#include "Config.au3"
#include "TunnelManager.au3"
#include "ConfigManager.au3"


#include <MsgBoxConstants.au3>




Func Main()
	if getConfig($jsonURL) Then
		KillWindowName($strWINTITLE)
		startSSHTunnel($strSession, $SSH_WINDOW_SHOW_FLAG, 1)

	Else
		MsgBox(0,$APPNAME, "Error While trying to retrieve configuration data from WebService")
	EndIf
EndFunc



Main()

