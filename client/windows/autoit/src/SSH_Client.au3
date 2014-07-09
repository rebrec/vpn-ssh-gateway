#cs ----------------------------------------------------------------------------

 AutoIt Version: 3.3.8.1
 Author:         Francois Laplaud



#ce ----------------------------------------------------------------------------
#include <File.au3>

$strRegAddTemplate = @ScriptDir & "\registry_add_template.reg"
$strRegDelTemplate = @ScriptDir & "\registry_del_template.reg"

$strPatternHostname = "###HOSTNAME"
$strPatternUsername = "###USERNAME"
$strPatternPort = "###PORT"
$strPatternSession = "###SESSION"
$strPatternPortForwarding = "###PortForwardings"
$debug=1

Global $strHost, $strPort, $strSession, $strUsername, $strPassword

getConfig()
genPuttyConfig($strHost, $strPort, $strSession, $strUsername)
addSSHRegFile($strSession)
startSSHTunnel($strSession, $strPassword)
delSSHRegFile($strSession)


Func startSSHTunnel($strSession, $strPassword)
	Run(@ScriptDir & "\putty.exe -load " & $strSession & " -pw " & $strPassword,"",@SW_MINIMIZE)
	if $debug = 1 then ConsoleWrite('@@ Debug(' & @ScriptLineNumber & ') : @ScriptDir & "\putty.exe -load " & $strSession & " -pw " & $strPassword = ' & @ScriptDir & "\putty.exe -load " & $strSession & " -pw " & $strPassword & @CRLF & '>Error code: ' & @error & @CRLF) ;### Debug Console
	Sleep(3000)
EndFunc

Func addSSHRegFile($strSession)
	RunWait("regedit.exe /s " & chr(34)  & getAddRegConfigName($strSession) & chr(34),"",@SW_HIDE)
EndFunc
Func delSSHRegFile($strSession)
	RunWait("regedit.exe /s " & getDelRegConfigName($strSession),"",@SW_HIDE)
EndFunc

Func getAddRegConfigName($strSession)
	return @ScriptDir & "\" & $strSession & "-add.reg"
EndFunc
Func getDelRegConfigName($strSession)
	return @ScriptDir & "\" & $strSession & "-del.reg"
EndFunc

Func genPuttyConfig($strHost, $strPort, $strSession, $strUsername, $strPortForwarding = "")
   Local $strRegAddFilename = getAddRegConfigName($strSession)
   Local $strRegDelFilename = getDelRegConfigName($strSession)
   FileCopy($strRegAddTemplate, $strRegAddFilename ,1)
   _ReplacestringInFile($strRegAddFilename, $strPatternHostname, $strHost, 0, 1)
   _ReplacestringInFile($strRegAddFilename, $strPatternUsername, $strUsername, 0, 1)
   _ReplacestringInFile($strRegAddFilename, $strPatternPort, $strPort, 0, 1)
   _ReplacestringInFile($strRegAddFilename, $strPatternSession, $strSession, 0, 1)
   _ReplacestringInFile($strRegAddFilename, $strPatternPortForwarding, $strPortForwarding, 0, 1)
   FileCopy($strRegDelTemplate, $strRegDelFilename ,1)
   _ReplacestringInFile($strRegDelFilename, $strPatternSession, $strSession, 0, 1)
EndFunc

Func intToRegistryDWORD($intNumber)
	Local $strDword
	$strDword = "dword:0"
	if IsInt($intNumber) Then
		$strDword = $strDword & hex($intNumber)
	EndIf
	Return $strDword
EndFunc

Func GetConfig()
	$strHost = "192.168.103.210"
	$strPort = 22
	$strSession = "temporary_session_for_vpn-ssh-gateway"
	$strUsername = "tunneltest"
	$strPassword = "tunneltest"
EndFunc