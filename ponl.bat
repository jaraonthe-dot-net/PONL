@REM php on line loader for windows
@echo off

set ponlpath=%~dp0
set ponlbasename=ponl.php
set ponlfile=%ponlpath%%ponlbasename%

REM Concats all arguments to pass them to php
set args=
:argactionstart
if -%1-==-- goto argactionend
set args=%args% %1
shift
goto argactionstart
:argactionend

php "%ponlfile%"%args%
set args=