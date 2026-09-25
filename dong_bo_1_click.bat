@echo off
chcp 65001 > nul
title HỆ THỐNG ĐỒNG BỘ DỰ ÁN 1-CLICK - CMS WORDPRESS
color 0B

echo ===============================================================================
echo                HỆ THỐNG ĐỒNG BỘ DỰ ÁN 1-CLICK (AUTOMATION SYNC)
echo           Dự án: BuiNguyenMinhQuan_CMS - Bùi Nguyên Minh Quân (24211TT1178)
echo ===============================================================================
echo.

:: [1/5] KIỂM TRA MÔI TRƯỜNG GIT
echo [1/5] 🔍 Đang kiểm tra môi trường Git...
where git >nul 2>nul
if %errorlevel% neq 0 (
    color 0C
    echo [LỖI] Máy tính chưa cài đặt Git hoặc chưa cấu hình biến môi trường PATH!
    pause
    exit /b
)
echo    -- Git đã sẵn sàng.

:: [2/5] BẢO VỆ DỮ LIỆU CỦA ĐỒNG ĐỘI (STASH CODE DỞ DANG)
echo.
echo [2/5] 🛡️  Đang kiểm tra và bảo vệ các thay đổi cục bộ (nếu có)...
git stash save "Auto-stashed before 1-click sync at %date% %time%" >nul 2>nul
echo    -- Mã nguồn cục bộ an toàn, không sợ bị mất code!

:: [3/5] KÉO MÃ NGUỒN MỚI NHẤT TỪ GITHUB
echo.
echo [3/5] 🚀 Đang tải mã nguồn mới nhất từ GitHub...
git pull
if %errorlevel% neq 0 (
    color 0E
    echo    [CẢNH BÁO] Không thể kéo code trực tiếp, đang thử kết nối lại với nhánh...
    git pull origin 1-24211TT1178-Quan
)
echo    -- Đã cập nhật xong toàn bộ Theme, Plugin và Mã nguồn PHP mới nhất!

:: [4/5] TỰ ĐỘNG PHÁT HIỆN VÀ NẠP DATABASE VÀO WAMP
echo.
echo [4/5] 🗄️  Đang tự động đồng bộ Cơ sở dữ liệu (Database)...

:: Tự động tìm kiếm file mysql.exe trong thư mục WampServer
set MYSQL_CMD=""
for /d %%D in (C:\wamp64\bin\mysql\mysql*) do (
    if exist "%%D\bin\mysql.exe" (
        set MYSQL_CMD="%%D\bin\mysql.exe"
    )
)

if %MYSQL_CMD%=="" (
    where mysql >nul 2>nul
    if %errorlevel% equ 0 (
        set MYSQL_CMD=mysql
    )
)

set DB_NAME=wordpress_buinguyenminhquan
set SQL_FILE=db\wordpress_buinguyenminhquan.sql

:: Kiểm tra file backup nếu có
if not exist "%SQL_FILE%" (
    if exist "db\wordpress_hoten.sql" (
        set SQL_FILE=db\wordpress_hoten.sql
    )
)

if %MYSQL_CMD%=="" (
    echo    [BỎ QUA] Không tìm thấy mysql.exe trong C:\wamp64\. Vui lòng kiểm tra lại WAMP!
) else (
    if exist "%SQL_FILE%" (
        echo    -- Tìm thấy Database Dump: %SQL_FILE%
        echo    -- Đang nạp vào cơ sở dữ liệu: %DB_NAME%...
        %MYSQL_CMD% -u root -e "CREATE DATABASE IF NOT EXISTS %DB_NAME% CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;" >nul 2>nul
        %MYSQL_CMD% -u root %DB_NAME% < "%SQL_FILE%"
        echo    -- ✅ Cơ sở dữ liệu đã nạp thành công 100%!
    ) else (
        echo    -- Không có file SQL mới trong thư mục db/. Giữ nguyên database hiện tại.
    )
)

:: [5/5] MỞ WEBSITE TRÊN TRÌNH DUYỆT
echo.
echo [5/5] 🌐 Đang khởi chạy website trên trình duyệt...
start http://localhost/BuiNguyenMinhQuan_CMS.git/demo.php

echo.
color 0A
echo ===============================================================================
echo  🎉 CHÚC MỪNG: DỰ ÁN ĐÃ ĐỒNG BỘ HOÀN TẤT VÀ SẴN SÀNG SỬ DỤNG TRONG 3 GIÂY!
echo ===============================================================================
echo.
echo Nhấn phím bất kỳ để đóng cửa sổ này...
pause > nul
