@ECHO OFF
REM Comment/uncomment to debug
SET DEBUG=y 

SET AUTOIT_DIR=%~dp0\tools\autoit_install
SET SEVENZIP_DIR=%~dp0\tools\7zip
SET SEVENZIPSFX_DIR=%~dp0\tools\7zipsfx

SET AUTOIT_SOURCE=%~dp0\..\src
SET THIRD_PARTY=%~dp0\..\thirdparty

SET BUILD_TMP=%~dp0\tmp
REM Name of the Client, will be included inside the archive and run from the sfx stub
SET BUILD_TMP_CLIENT=%BUILD_TMP%\setup.exe
SET BUILD_TMP_ARCHIVE=%BUILD_TMP%\archive.7z
REM Third party tools to be included into the archive
SET BUILD_TMP_THIRDPARTY=%THIRD_PARTY%\putty.exe %THIRD_PARTY%\vncviewer.exe

SET SFX_CONFIG=%AUTOIT_SOURCE%\config.txt
SET SFX_STUBS=%SEVENZIPSFX_DIR%\3rdParty\Modules

SET SFX_STUB=%SFX_STUBS%\7zsd_All.sfx

SET SFX_EXE_NAME=%BUILD_TMP%\launcher.exe
