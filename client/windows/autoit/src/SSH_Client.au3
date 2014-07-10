#cs ----------------------------------------------------------------------------

 AutoIt Version: 3.3.8.1
 Author:         Francois Laplaud



#ce ----------------------------------------------------------------------------
#include <File.au3>

#include <Array.au3>
#include "JSON.au3"
#include <MsgBoxConstants.au3>

Const $strRegAddTemplate = @ScriptDir & "\registry_add_template.reg"
Const $strRegDelTemplate = @ScriptDir & "\registry_del_template.reg"
Const $strWINTITLE = "temporary_session_for_vpn-ssh-gateway"
Const $strPatternHostname = "###HOSTNAME"
Const $strPatternUsername = "###USERNAME"
Const $strPatternPort = "###PORTSSH"
Const $strPatternSession = "###SESSION"
Const $strPatternPortForwarding = "###PORTWORWARDING"
Const $strPatternPubKey = "###PUBKEY"

Global $jsonURL = "http://192.168.103.210/index.php"
Global $localPortMin = 10000
Global $localPortMax = 65534
Global $localUsedPorts = ""
Global $strHost, $strSSHPort, $strSession, $strUsername, $strPassword, $strPubKey, $strPortForwarding ; Will be generated from getConfig
Global $arrTunnels[1] ; Will be generated from getConfig

Func Main()
	if getConfig() Then
		KillWindowName($strWINTITLE)
		genPuttyConfig($strHost, $strSSHPort, $strSession, $strUsername, $strPubKey)
		addSSHRegFile($strSession)
		startSSHTunnel($strSession)
		MsgBox(0,"","Tunnel Established, Forwarded List : " & $strPortForwarding,60)
		Sleep(3000)

		delSSHRegFile($strSession)
	EndIf
EndFunc




Func startSSHTunnel($strSession)
	Run(@ScriptDir & "\putty.exe -load " & $strSession,"",@SW_MAXIMIZE)
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
	For $arrTunnel in $arrTunnels
		$strPortForwarding = genTunnelSetting($arrTunnel) & "," & $strPortForwarding
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

Func GetConfig()
	Local $strPrivateKey
	; when ppk will be transmitted over JSON, comment above
	;$strPrivateKey = "PuTTY-User-Key-File-2: ssh-rsa" & @LF & "Encryption: none" & @LF & "Comment: imported-openssh-key" & @LF & "Public-Lines: 6" & @LF & "AAAAB3NzaC1yc2EAAAADAQABAAABAQDD4zc+koxn60UwzQk38zF0QWy89Q2vqeNM" & @LF & "4XY6f9b35ZCfgYeLgXFXr5J+AvMWRJkb4LEiBPad2tMuLRiNjM2XGIUhDUhGnLz4" & @LF & "CIvg1LYWzkGTnHvh0c3IDmT41PvXV25xcBKtV4nxDNyynOGJ+1UZZzISrWG/OV/E" & @LF & "Wul7z2FYhnzunKkM1n7lqN7Jfl0ccQTqE3rHIphCCUSMgDwIBmkOxhcujAq41J5B" & @LF & "zCr795Hh9lQTbanT1HSdrrNf8oEmLcMZkMuzx3eBgYjh/GtO/uVDfLoBz+K51QOk" & @LF & "dcdVAfYzsk/CSWOOedijntXsPZqtc3Y6a0LYpV2mX4d8cybPUdQF" & @LF & "Private-Lines: 14" & @LF & "AAABADaExptjrjA+CsPKTQaFaP4yN1Ff4q9BWUHMfltJuUrFWbsLEe6B2EnPU7Y+" & @LF & "m+lWrkZUAvi06O6GOMBhTLQYvB+Rc3v/dl4wwWdG+adZjFRMk3PB2bi/68YCO5gF" & @LF & "rxIAA30O9CPKeVndeo87mooMqWKolgccule+YCkGJHWRAkbgql/q6UxqBJXnGVZI" & @LF & "lx00FQpEhiTVrvfL1zV6+e4RG/wWYjr1Z79Vbvy3nRTZCh8LYhf0LbLiFddhy+e6" & @LF & "VIN49zcCK7tulzFlBd72oVrRVWIlC9xC6coLfA5g/6QqXch/ohhznDjMURIuQpoW" & @LF & "80IJeePrIFGgIG7gidSwfQzSgAEAAACBAPHLeQWIwUw0AXmrREsIAeruTbLzyJXR" & @LF & "S9yIOvZbfUnJzIFZ9XeVrMJtJ2ilTnwn2C/X8wOIWpwSZ7UqLspudKPsHYPYpX1M" & @LF & "kBOFsMQS5iK6h2RnlcDcJc+HcZa4cHLLtYNyyco02xn+WSvBn0Inr2MkvejRgy2U" & @LF & "kdEeQthgpJmBAAAAgQDPZU+F/t8Qj85BOZilwolX/E/hS1NxojdbbDY8HY9Ez37/" & @LF & "lHsj6bUho5i4SG1dsqFE+LJC8IgYaULnnsWQH7r+KtkxbvlLf4z6PrPYZLRgzU2d" & @LF & "cZlC608BctcUsYlm2MDqg0rC8cC9Ub6i3QLDECQ+disL7RQC8lnw57MzhdAUhQAA" & @LF & "AIEAzsUPXAs290NSQ5cQ9jhAUbPNUlbIoHLhyQOGjWad9iqMdMcKTFRrLZ65LvoC" & @LF & "6vMeb5gP9X0hOgEEMwrhfZdXby5/2kDytV2Ye/HzXP0JNtK+kREVx0Oamn20/ASo" & @LF & "jKLRIZfBdhkYsT+Hj43KF3IgIDqnLOXQOJcAFV73jW423Qk=" & @LF & "Private-MAC: 398f98fcaeee87d6352e2ffa63e37a444f7aa965" & @LF
	$oHTTP = ObjCreate("winhttp.winhttprequest.5.1")
	$oHTTP.Open("GET", $jsonURL, False)
	$oHTTP.Send()
	$jsonData = $oHTTP.ResponseText
	$oStatusCode = $oHTTP.Status
	;$jsonData = FileRead("D:\TMP\vpn-ssh-gateawy\client\windows\autoit\src\json_data.txt")
	$jsonConfig = _JSONDecode($jsonData)
	For $i = 0 to UBound($jsonConfig)-1
		switch $jsonConfig[$i][0]
			Case 'host'
				$strHost = $jsonConfig[$i][1]
				ConsoleWrite('@@ Debug(' & @ScriptLineNumber & ') : $strHost = ' & $strHost & @CRLF & '>Error code: ' & @error & @CRLF) ;### Debug Console
			Case 'port'
				$strSSHPort = $jsonConfig[$i][1]
				ConsoleWrite('@@ Debug(' & @ScriptLineNumber & ') : $strSSHPort = ' & $strSSHPort & @CRLF & '>Error code: ' & @error & @CRLF) ;### Debug Console
			Case 'session'
				$strSession = $jsonConfig[$i][1]
				ConsoleWrite('@@ Debug(' & @ScriptLineNumber & ') : $strSession = ' & $strSession & @CRLF & '>Error code: ' & @error & @CRLF) ;### Debug Console
			Case 'user'
				$strUsername = $jsonConfig[$i][1]
				ConsoleWrite('@@ Debug(' & @ScriptLineNumber & ') : $strUsername = ' & $strUsername & @CRLF & '>Error code: ' & @error & @CRLF) ;### Debug Console
			Case 'private_key'
				$strPrivateKey = $jsonConfig[$i][1]
				ConsoleWrite('@@ Debug(' & @ScriptLineNumber & ') : $strPrivateKey = ' & $strPrivateKey & @CRLF & '>Error code: ' & @error & @CRLF) ;### Debug Console
				ConsoleWrite($strPrivateKey)


			Case 'tunnels'
				$arrTunnels =  $jsonConfig[$i][1]
				ExitLoop
			;Case Else
		EndSwitch
	Next

	ConsoleWrite ("ppk : " & $strPrivateKey)
	$strPubKey = @ScriptDir & "\user.ppk"
	$file = FileOpen($strPubKey,2)
	FileWrite($file, $strPrivateKey)
	FileClose($file)

	if BitAND($oStatusCode = 200,  $strSession <> "") Then
		return True
	Else
		return False
	EndIf

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

Func KillWindowName($strWinTitle)
	While WinExists( $strWinTitle )
		ProcessClose(WinGetProcess( $strWinTitle ))
		Sleep(100)
	WEnd
EndFunc

Func genTunnelSetting($strIPPort)
	Local $lPort

	; Generate random port number
	while 1
		$lPort = Random($localPortMin, $localPortMax, 1)
		ConsoleWrite('@@ Debug(' & @ScriptLineNumber & ') : lPort  = ' & $lPort  & @CRLF & '>Error code: ' & @error & @CRLF) ;### Debug Console
		If StringInStr($localUsedPorts, $lPort) = 0 Then ; If the lPort Randomly generated have previously been choosen we discard this choice
			; check if port is Available for listening
			if CheckLocalPortAvailable($lPort) then ExitLoop
		EndIf
	WEnd
		; Generate Tunnel String and save lPort so that it wont be usable again
	$localUsedPorts = $localUsedPorts & ";" & $lPort
	return "L" & $lPort & "=" & $strIPPort
EndFunc
Main()

