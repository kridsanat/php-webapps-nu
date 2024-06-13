@echo off
setlocal

set /p username=Please enter the username: 

for /f "tokens=*" %%i in ('net user "%username%" /domain ^| findstr /i "User name Full Name Account expires Password last set Password expires Password changeable"') do (
    echo %%i
)

endlocal
pause
