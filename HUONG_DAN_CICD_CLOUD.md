# HƯỚNG DẪN TRIỂN KHAI CI/CD THỰC THỤ TRÊN CLOUD SERVER
**Dự án:** WordPress CMS - Bùi Nguyên Minh Quân (24211TT1178)  
**Công nghệ:** GitHub Actions + PHP 8.2 + Cloud Hosting (FTP/SFTP)

---

## 1. Cơ Chế Hoạt Động (Architecture)

```
[Developer Máy Cá Nhân] 
       │ 
       ▼ (git push)
[GitHub Repository] 
       │ 
       ▼ (Webhook kích hoạt GitHub Actions Runner - Ubuntu)
┌────────────────────────────────────────────────────────┐
│ 1. CI (Continuous Integration):                        │
│    - Khởi tạo môi trường PHP 8.2                       │
│    - Chạy PHP Lint (php -l) kiểm tra 100% cú pháp      │
│    - Nếu có lỗi cú pháp ➔ Dừng lại ngay, không deploy  │
├────────────────────────────────────────────────────────┤
│ 2. CD (Continuous Deployment):                         │
│    - Đọc GitHub Secrets (Server, User, Pass)           │
│    - Tự động đồng bộ các file thay đổi lên Hosting     │
│    - Bảo vệ an toàn: Không đè wp-config.php và DB      │
└────────────────────────────────────────────────────────┘
       │ 
       ▼ (FTP/SFTP Deploy)
[Cloud Hosting / Web Server Online] (Ví dụ: InfinityFree, Hostinger, VPS)
       │ 
       ▼ (Truy cập bằng Trình duyệt)
[Giảng Viên / Thành Viên Nhóm]: Xem ngay tại URL công khai, KHÔNG CẦN kéo code!
```

---

## 2. Các Bước Cài Đặt Thực Tế Trong 3 Phút

### Bước 1: Chuẩn Bị Hosting Online Miễn Phí (Nếu Chưa Có)
Bạn có thể dùng bất kỳ hosting nào có FTP (ví dụ **InfinityFree** miễn phí 100%):
1. Truy cập [infinityfree.com](https://www.infinityfree.com/) và đăng ký tài khoản miễn phí.
2. Tạo 1 website mới $\rightarrow$ Bạn sẽ nhận được:
   - **Tên miền miễn phí** (Ví dụ: `http://minhquan-cms.infinityfreeapp.com`)
   - **FTP Details:**
     - **FTP Hostname:** (Ví dụ: `ftpupload.net`)
     - **FTP Username:** (Ví dụ: `if0_38123456`)
     - **FTP Password:** Mật khẩu tài khoản hosting
     - **FTP Directory:** `htdocs/`

### Bước 2: Cài Đặt GitHub Secrets (Bảo Mật Tuyệt Đối)
1. Mở trình duyệt vào kho GitHub: `https://github.com/MinhQuan13041999/BuiNguyenMinhQuan_CMS`
2. Chọn **Settings** (tab bánh răng) $\rightarrow$ Cột trái chọn **Secrets and variables** $\rightarrow$ **Actions**.
3. Bấm nút xanh **New repository secret** để thêm 4 biến sau:

| Tên Secret | Ý nghĩa | Giá trị mẫu |
| :--- | :--- | :--- |
| `FTP_SERVER` | Địa chỉ máy chủ FTP | `ftpupload.net` (hoặc IP của hosting) |
| `FTP_USERNAME` | Tên đăng nhập FTP | `if0_38123456` |
| `FTP_PASSWORD` | Mật khẩu FTP | `Mật khẩu của bạn` |
| `FTP_SERVER_DIR` | Thư mục web trên hosting | `htdocs/` |

---

## 3. Kịch Bản Trình Diễn Live Demo (Để Đạt Điểm Tuyệt Đối)

Khi thuyết trình trước lớp hoặc giảng viên:

1. **Cho xem hiện trạng:**
   - Mở link web online trên máy tính hoặc điện thoại:  
     `http://<domain-cua-ban>/cicd-status.php`  
   - Hiện tại đang ghi: `v1.1.0 - Production`.

2. **Thực hiện thay đổi tại Local:**
   - Mở file `cicd-status.php` trên VS Code.
   - Sửa dòng số 8 thành:
     ```php
     $app_version = "v1.2.0 - LIVE CI/CD DEMO SUCCESS!";
     ```
3. **Commit & Push bằng Git:**
   - Mở Terminal chạy:
     ```bash
     git add .
     git commit -m "demo: live update version to v1.2.0 via CI/CD"
     git push origin 1-24211TT1178-Quan
     ```

4. **Trình chiếu màn hình GitHub Actions:**
   - Vào tab **Actions** trên GitHub.
   - Chỉ cho mọi người thấy:
     - Job **CI (Syntax Lint)** đang chạy kiểm tra code.
     - Job **CD (Deploy)** tự động đóng gói và đẩy qua Cloud Hosting.
     - Cả 2 job chuyển sang màu xanh lá (**Passed**).

5. **Kiểm tra kết quả trực tiếp:**
   - F5 lại trang `http://<domain-cua-ban>/cicd-status.php` trên điện thoại/trình duyệt.
   - Dòng chữ `v1.2.0 - LIVE CI/CD DEMO SUCCESS!` hiện lên ngay tức khắc!
   - **Kết luận:** *Không cần ai phải kéo code về máy cá nhân, hệ thống CI/CD đã tự động build, test và phát hành trực tiếp lên Cloud.*
