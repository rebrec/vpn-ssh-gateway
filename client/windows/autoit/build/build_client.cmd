@ECHO OFF

REM ****************************************
REM  Build Script by Francois Laplaud
REM ****************************************
REM - Compile latest autoit source code
call %~dp0\_config.cmd
@ECHO Building Client.exe 
"%AUTOIT_DIR%\aut2exe\aut2exe.exe" /in "%AUTOIT_SOURCE%\ssh_client.au3" /out "%BUILD_TMP_CLIENT%"
IF DEFINED DEBUG pause
