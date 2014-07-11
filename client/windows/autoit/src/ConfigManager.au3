#include-once
#include "JSON.au3"

Local $strHost, $strSSHPort, $strSession, $strUsername, $strPassword, $strPubKey, $strPortForwarding ; Will be generated from getConfig
Local $arrTunnels[1] ; Will be generated from getConfig

Func GetConfig($jsonURL)
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
			Case 'port'
				$strSSHPort = $jsonConfig[$i][1]
			Case 'session'
				$strSession = $jsonConfig[$i][1]
			Case 'user'
				$strUsername = $jsonConfig[$i][1]
			Case 'private_key'
				$strPrivateKey = $jsonConfig[$i][1]
			Case 'tunnels'
				$arrTunnels =  $jsonConfig[$i][1]
				ExitLoop
			;Case Else
		EndSwitch
	Next
	$strPubKey = @ScriptDir & "\user.ppk"
	$file = FileOpen($strPubKey,2)
	FileWrite($file, $strPrivateKey)
	FileClose($file)

	If BitAND($oStatusCode = 200,  $strSession <> "") Then
		return True
	Else
		return False
	EndIf

EndFunc

Func getStrHost()
	return $strHost
EndFunc
Func getStrSSHPort()
	return $strSSHPort
EndFunc
Func getStrSession()
	return $strSession
EndFunc
Func getStrUsername()
	return $strUsername
EndFunc
Func getStrPassword()
	return $strPassword
EndFunc
Func getStrPubKey()
	return $strPubKey
EndFunc
Func getStrPortForwarding()
	return $strPortForwarding
EndFunc
Func getArrTunnels()
	return $arrTunnels
EndFunc
