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
		msgBox(0,"Content", "strHost : " & getStrHost())
		KillWindowName($strWINTITLE)
		startSSHTunnel($strSession, @SW_MAXIMIZE, 1)

	Else
		MsgBox(0,$APPNAME, "Error While trying to retrieve configuration data from WebService")
	EndIf
EndFunc



Main()

