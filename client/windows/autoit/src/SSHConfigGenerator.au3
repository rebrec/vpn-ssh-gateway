#include-once
#include "ConfigManager.au3"
#include <File.au3>
#include "Config.au3"
Const $strRegAddTemplate = @ScriptDir & "\registry_add_template.reg"
Const $strRegDelTemplate = @ScriptDir & "\registry_del_template.reg"
Const $strPatternHostname = "###HOSTNAME"
Const $strPatternUsername = "###USERNAME"
Const $strPatternPort = "###PORTSSH"
Const $strPatternSession = "###SESSION"
Const $strPatternPortForwarding = "###PORTWORWARDING"
Const $strPatternPubKey = "###PUBKEY"

Local $localUsedPorts = ""

Func delConfigFiles($strSession)
	FileDelete(getAddRegConfigName($strSession))
	FileDelete(getDelRegConfigName($strSession))
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

Func genPuttyConfig($strHost, $strSSHPort, $strSession, $strUsername, $strPubKey)
	Local $strRegAddFilename = getAddRegConfigName($strSession)
	Local $strRegDelFilename = getDelRegConfigName($strSession)
	For $i = 0 to UBound($arrTunnels)-1
		$arrTunnel = $arrTunnels[$i]
		; get local port available
		$lPort = GetLocalPortAvailable()
		; store it inside array
		_ArrayAdd($arrTunnels[$i],"lport|" & $lPort)
;			return "L" & $lPort & "=" & $strIPPort
		; generate putty tunnel setting
		$strPortForwarding = "L" & $lPort & "=" & $arrTunnel[$TUN_IP][1] & ":" & $arrTunnel[$TUN_PORT][1]  & "," & $strPortForwarding
	Next
	FileCopy($strRegAddTemplate, $strRegAddFilename ,1)
	_ReplacestringInFile($strRegAddFilename, $strPatternHostname, $strHost, 0, 1)
	_ReplacestringInFile($strRegAddFilename, $strPatternUsername, $strUsername, 0, 1)
	_ReplacestringInFile($strRegAddFilename, $strPatternPort, intToRegistryDWORD(int($strSSHPort)), 0, 1)
	_ReplacestringInFile($strRegAddFilename, $strPatternSession, $strSession, 0, 1)
	_ReplacestringInFile($strRegAddFilename, $strPatternPortForwarding, $strPortForwarding, 0, 1)
	_ReplacestringInFile($strRegAddFilename, $strPatternPubKey, pathToRegistryString($strPubKey), 0, 1)
	FileCopy($strRegDelTemplate, $strRegDelFilename ,1)
	_ReplacestringInFile($strRegDelFilename, $strPatternSession, $strSession, 0, 1)
EndFunc

Func pathToRegistryString($str)
	return StringReplace($str,"\","\\", 0)
EndFunc
Func intToRegistryDWORD($intNumber)
	Local $strDword
	$strDword = "dword:0"
	if IsInt($intNumber) Then
		$strDword = $strDword & hex($intNumber)
	EndIf
	Return $strDword
EndFunc

Func GetLocalPortAvailable()
	Local $lPort

	; Generate random port number
	while 1
		$lPort = Random($localPortMin, $localPortMax, 1)
		If StringInStr($localUsedPorts, $lPort) = 0 Then ; If the lPort Randomly generated have previously been choosen we discard this choice
			; check if port is Available for listening
			if CheckLocalPortAvailable($lPort) then ExitLoop
		EndIf
	WEnd
	return $lPort
EndFunc

Func CheckLocalPortAvailable($intPort)
	OnAutoItExitRegister("OnAutoItExit")
	TCPStartup()
	Local $sIPAddress = "0.0.0.0"

    Local $iListenSocket = TCPListen($sIPAddress, $intPort, 5)
    ; If an error occurred display the error code and return False.
    If @error Then
        ; Someone is probably already listening on this IP Address and Port (script already running?).
        Local $iError = @error
        MsgBox(BitOR($MB_SYSTEMMODAL, $MB_ICONHAND), "VPN SSH Gateway", "Could not listen to port " & $intPort & ", Error code: " & $iError, 2)
		TCPCloseSocket($iListenSocket)
		TCPShutdown() ; Close the TCP service.
        Return False
    Else
        TCPCloseSocket($iListenSocket)
		TCPShutdown() ; Close the TCP service.
		Return True
    EndIf

EndFunc

Func OnAutoItExit()
    TCPShutdown() ; Close the TCP service.
EndFunc   ;==>OnAutoItExit
