@ECHO OFF
REM ****************************************
REM  Build Script by Francois Laplaud
REM ****************************************
REM - Create an sfx from this which run autoit client
call %~dp0\_config.cmd
copy /b %SFX_STUB% + %SFX_CONFIG% + %BUILD_TMP_ARCHIVE% %SFX_EXE_NAME%
 
IF DEFINED DEBUG pause
