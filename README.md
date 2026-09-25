# HỆ THỐNG CMS WORDPRESS & QUY TRÌNH CI/CD TỰ ĐỘNG HÓA 1-CLICK

[![CI/CD Pipeline](https://github.com/MinhQuan13041999/BuiNguyenMinhQuan_CMS/actions/workflows/ci-cd.yml/badge.svg)](https://github.com/MinhQuan13041999/BuiNguyenMinhQuan_CMS/actions)
![PHP Version](https://img.shields.io/badge/PHP-8.2%20%7C%208.4-777BB4?logo=php)
![WordPress](https://img.shields.io/badge/WordPress-6.x-21759B?logo=wordpress)
![MySQL](https://img.shields.io/badge/MySQL-8.4-4479A1?logo=mysql)
![Automation](https://img.shields.io/badge/Automation-1--Click%20Sync-10b981)

- **Họ và tên sinh viên:** Bùi Nguyên Minh Quân
- **Mã số sinh viên:** 24211TT1178
- **Kho lưu trữ:** [BuiNguyenMinhQuan_CMS](https://github.com/MinhQuan13041999/BuiNguyenMinhQuan_CMS)
- **Môi trường cục bộ:** WampServer (Apache 2.4, PHP 8.2 / 8.4, MySQL 8.4)

---

## 🚀 Luồng Tự Động Hóa 2 Chiều (Two-Way 1-Click CI/CD)

```
[BẠN A: Người phát triển]
       │
       ▼ Click đúp `day_code_1_click.bat`
  1. Tự động xuất Database hiện tại vào db/
  2. Tự động git commit & git push lên GitHub
       │
       ▼
[GITHUB CLOUD: CI Pipeline Tự Động]
  1. Máy ảo Ubuntu khởi động môi trường PHP
  2. Tự động quét và kiểm tra lỗi cú pháp (Syntax Lint)
  3. Kiểm tra tính toàn vẹn của Database và cấu trúc dự án
  4. Xuất huy hiệu "Passed - Code Sạch 100%"
       │
       ▼
[BẠN B: Đồng đội nhận code]
       │
       ▼ Click đúp `dong_bo_1_click.bat`
  1. Tự động bảo vệ code đang viết dở (git stash)
  2. Tự động kéo mã nguồn mới nhất (git pull)
  3. Tự động tìm MySQL và nạp Database mới vào WampServer
  4. Tự động kích hoạt trình duyệt mở website ngay lập tức!
```

---

## 🛠️ Hướng Dẫn Sử Dụng Nhanh

### 1. Dành cho Người Phát Triển (Đẩy Code & Database)
Khi bạn vừa hoàn thành một chức năng mới hoặc thêm bài viết/giao diện:
- Click đúp vào file **[`day_code_1_click.bat`](file:///c:/wamp64/www/BuiNguyenMinhQuan_CMS.git/day_code_1_click.bat)**.
- Hệ thống sẽ tự động xuất Database MySQL ra file `.sql`, commit và đẩy lên GitHub.
- Theo dõi tiến trình kiểm định tự động tại tab **Actions** trên GitHub.

### 2. Dành cho Thành Viên Nhóm (Kéo Bản Mới Về Máy)
Khi muốn cập nhật phiên bản mới nhất từ nhóm:
- Click đúp vào file **[`dong_bo_1_click.bat`](file:///c:/wamp64/www/BuiNguyenMinhQuan_CMS.git/dong_bo_1_click.bat)**.
- Toàn bộ mã nguồn và cơ sở dữ liệu sẽ được tự động cập nhật vào WampServer của bạn trong vòng **3 giây**.
- Trình duyệt sẽ tự động mở trang web để bạn kiểm tra ngay.

### 3. Kiểm Tra Trạng Thái Trực Tuyến
- Truy cập vào trang: `http://localhost/BuiNguyenMinhQuan_CMS.git/cicd-status.php` để xem phiên bản hiện tại, môi trường chạy và trạng thái CI/CD.