@echo off
chcp 65001 > nul
echo =======================================================
echo   ĐANG CẤU HÌNH FILE HOSTS VÀ RESTART APACHE (WAMP)
echo =======================================================
echo.

:: Kiem tra quyen Administrator
net session >nul 2>&1
if %errorlevel% neq 0 (
    echo [CANH BAO] Ban chua chay bang quyen Administrator!
    echo Vui long click chuot phai vao file nay va chon:
    echo   "Run as administrator" (Chay voi quyen Quan tri vien)
    echo.
    pause
    exit /b 1
)

set HOSTS_FILE=%SystemRoot%\System32\drivers\etc\hosts

:: Kiem tra neu wordpress.local da ton tai trong hosts chua
findstr /i /c:"wordpress.local" "%HOSTS_FILE%" >nul 2>&1
if %errorlevel% neq 0 (
    echo [1/3] Dang them wordpress.local vao file hosts...
    echo.>>"%HOSTS_FILE%"
    echo 127.0.0.1 wordpress.local>>"%HOSTS_FILE%"
    echo 127.0.0.1 www.wordpress.local>>"%HOSTS_FILE%"
    echo [OK] Da them thanh cong!
) else (
    echo [1/3] File hosts da co san wordpress.local.
)

:: Xoa cache DNS cua Windows
echo.
echo [2/3] Dang lam moi DNS Cache (ipconfig /flushdns)...
ipconfig /flushdns

:: Khoi dong lai Apache cua WampServer
echo.
echo [3/3] Dang khoi dong lai dich vu Apache (wampapache64)...
net stop wampapache64
net start wampapache64

echo.
echo =======================================================
echo   HOAN TAT CAU HINH!
echo   Ban co the mo trinh duyet va truy cap:
echo   http://wordpress.local
echo =======================================================
echo.
pause
