@ECHO OFF

REM ****************************************
REM  Build Script by Francois Laplaud
REM ****************************************
REM - Compress thirdparty tools and autoit client
call %~dp0\_config.cmd
@ECHO ON
if exist %BUILD_TMP_ARCHIVE% del %BUILD_TMP_ARCHIVE%
%SEVENZIP_DIR%\7za.exe a %BUILD_TMP_ARCHIVE% %BUILD_TMP_CLIENT% %BUILD_TMP_THIRDPARTY%

IF DEFINED DEBUG pause