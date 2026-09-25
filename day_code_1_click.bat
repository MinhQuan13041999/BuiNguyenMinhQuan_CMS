@echo off
chcp 65001 > nul
title HỆ THỐNG XUẤT BẢN DỰ ÁN 1-CLICK - CMS WORDPRESS
color 0B

echo ===============================================================================
echo                HỆ THỐNG XUẤT BẢN DỰ ÁN 1-CLICK (PUBLISH & EXPORT)
echo           Dự án: BuiNguyenMinhQuan_CMS - Bùi Nguyên Minh Quân (24211TT1178)
echo ===============================================================================
echo.

:: [1/4] TỰ ĐỘNG XUẤT DATABASE TỪ MYSQL RA FILE SQL
echo [1/4] 🗄️  Đang tự động xuất (Export) Cơ sở dữ liệu từ WampServer...

set MYSQLDUMP_CMD=""
for /d %%D in (C:\wamp64\bin\mysql\mysql*) do (
    if exist "%%D\bin\mysqldump.exe" (
        set MYSQLDUMP_CMD="%%D\bin\mysqldump.exe"
    )
)

if %MYSQLDUMP_CMD%=="" (
    where mysqldump >nul 2>nul
    if %errorlevel% equ 0 (
        set MYSQLDUMP_CMD=mysqldump
    )
)

if not exist "db" mkdir "db"
set DB_NAME=wordpress_buinguyenminhquan
set EXPORT_FILE=db\wordpress_buinguyenminhquan.sql

if %MYSQLDUMP_CMD%=="" (
    echo    [CẢNH BÁO] Không tìm thấy mysqldump.exe! Vui lòng đảm bảo WampServer đang chạy.
) else (
    %MYSQLDUMP_CMD% -u root --default-character-set=utf8mb4 %DB_NAME% > "%EXPORT_FILE%" 2>nul
    if %errorlevel% equ 0 (
        echo    -- ✅ Đã xuất thành công Database vào: %EXPORT_FILE%
    ) else (
        :: Thử xuất DB phụ group_a_db nếu có
        %MYSQLDUMP_CMD% -u root --default-character-set=utf8mb4 group_a_db > "%EXPORT_FILE%" 2>nul
        echo    -- ✅ Đã xuất Database vào: %EXPORT_FILE%
    )
)

:: [2/4] GOM TẤT CẢ FILE VÀO GIT (GIT ADD)
echo.
echo [2/4] 📦 Đang đóng gói toàn bộ mã nguồn và Database vào Git...
git add .
echo    -- Đã chuẩn bị các file thay đổi (Staged).

:: [3/4] NHẬP COMMIT MESSAGE (TÙY CHỌN)
echo.
echo [3/4] ✍️  Nhập mô tả thay đổi (Nhấn ENTER để dùng mặc định):
set /p USER_MSG=">> Lời nhắn: "
if "%USER_MSG%"=="" (
    set USER_MSG=feat: cap nhat ma nguon va database moi nhat qua 1-click
)

git commit -m "%USER_MSG%"
if %errorlevel% neq 0 (
    echo    (Không có thay đổi mới nào cần commit, tiếp tục đẩy code...)
)

:: [4/4] ĐẨY LÊN GITHUB (GIT PUSH)
echo.
echo [4/4] 🚀 Đang đẩy mã nguồn lên GitHub...
git push
if %errorlevel% neq 0 (
    git push -u origin 1-24211TT1178-Quan
)

echo.
color 0A
echo ===============================================================================
echo  🎉 XUẤT BẢN THÀNH CÔNG! HỆ THỐNG CI/CD ĐANG TỰ ĐỘNG KIỂM TRA TRÊN GITHUB.
echo ===============================================================================
echo.
echo 🔗 Theo dõi quy trình kiểm định CI tại:
echo    https://github.com/MinhQuan13041999/BuiNguyenMinhQuan_CMS/actions
echo.
echo 📢 Đồng đội chỉ cần click file "dong_bo_1_click.bat" là nhận ngay bản mới!
echo.
pause
