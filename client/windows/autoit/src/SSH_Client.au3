#cs ----------------------------------------------------------------------------

 AutoIt Version: 3.3.8.1
 Author:         Francois Laplaud

 Script Function:
	Template AutoIt script.

#ce ----------------------------------------------------------------------------

; Script Start - Add your code below here
MsgBox(0,"", "Temp folder is : " & @ScriptDir)
; trying to launch vnc
Run(@ScriptDir & "\vncviewer.exe")

;trying to launch putty

Func genPuttyConfig($host, $port)
   
EndFunc