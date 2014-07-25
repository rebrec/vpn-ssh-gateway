@ECHO OFF
REM ****************************************
REM  Build Script by Francois Laplaud
REM ****************************************
REM - Clean previous build data
REM - Compile latest autoit source code
REM - Compress thirdparty tools and autoit client
REM - Create an sfx from this which run autoit client

call %~dp0\clean_all.cmd

call %~dp0\build_client.cmd

call %~dp0\compress_3rdparty.cmd

call %~dp0\create_sfx.cmd