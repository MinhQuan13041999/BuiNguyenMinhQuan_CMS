# BÁO CÁO KẾT QUẢ THỰC HIỆN LAB 1 - CMS WORDPRESS

- **Họ và tên sinh viên:** Bùi Nguyên Minh Quân
- **Mã số sinh viên (MSSV):** 24211TT1178
- **Lớp / Khóa:** Công nghệ Thông tin
- **Tên Repository GitHub:** [BuiNguyenMinhQuan_CMS](https://github.com/MinhQuan13041999/BuiNguyenMinhQuan_CMS)
- **Cơ sở dữ liệu (Database):** `wordpress_buinguyenminhquan`
- **Môi trường chạy:** WampServer (Apache 2.4.65, PHP 8.2 / 8.4, MySQL 8.4.7)

---

## 1. Tổng hợp các bước đã hoàn thành

| Bước | Nội dung công việc | Trạng thái | Ghi chú |
| :---: | :--- | :---: | :--- |
| **1** | Tạo Repository mới trên GitHub `BuiNguyenMinhQuan_CMS` | Đã hoàn thành | Khởi tạo repo với README và LICENSE |
| **2** | Dùng Git/SmartGit clone về máy, kiểm tra kết nối | Đã hoàn thành | Kiểm tra kết nối và cấu hình thành công |
| **3** | Tải và giải nén mã nguồn WordPress vào thư mục web | Đã hoàn thành | Đặt source trong `c:\wamp64\www\BuiNguyenMinhQuan_CMS.git` |
| **4** | Tạo database `wordpress_buinguyenminhquan` | Đã hoàn thành | UTF8MB4 Unicode Collation |
| **5** | Cài đặt WordPress, tạo tài khoản quản trị đầu tiên | Đã hoàn thành | Tạo user `admin` thành công |
| **6** | Tạo 5 danh mục (category) tiếng Việt có ý nghĩa | Đã hoàn thành | 5 danh mục chuẩn mực kèm mô tả chi tiết |
| **7** | Tạo 10 bài viết phân bổ vào 5 danh mục (mỗi bài $\ge$ 2 ảnh minh họa) | Đã hoàn thành | 10 bài viết phong phú, văn minh, đủ 2 ảnh nội dung |
| **8** | Tạo 5 tài khoản đăng nhập (user1 - user5) | Đã hoàn thành | Đặt mật khẩu đồng nhất `User@123456` |
| **9** | Phân theo 5 vai trò (Administrator, Editor, Author, Contributor, Subscriber) & so sánh quyền hạn | Đã hoàn thành | Kiểm tra đăng nhập thử và lập bảng so sánh chi tiết |
| **10**| Thêm đầy đủ: tiêu đề, chuyên mục, thẻ (tag), ảnh đại diện (Featured Image), đoạn trích (Excerpt ~100 ký tự) | Đã hoàn thành | 100% bài viết đạt chuẩn yêu cầu |
| **11**| Settings > General: tùy chỉnh Site Title, Tagline, Timezone Việt Nam (UTC+7), định dạng ngày/giờ kiểu Việt Nam | Đã hoàn thành | Site Title: `Bùi Nguyên Minh Quân - CMS`, Timezone: `Asia/Ho_Chi_Minh` |
| **12**| Export toàn bộ database vào thư mục `db/` | Đã hoàn thành | File `db/wordpress_buinguyenminhquan.sql` |
| **13**| Tạo branch `lab1` từ `main` | Đã hoàn thành | Nhánh `lab1` độc lập chứa toàn bộ source và nội dung |
| **14**| Commit chia nhỏ có message rõ ràng | Đã hoàn thành | `init wordpress source`, `add 5 categories and 10 posts`, `add 5 user accounts` |
| **15**| Commit file export database (`db/wordpress_hoten.sql`) | Đã hoàn thành | File export được commit lên branch `lab1` |
| **16**| Kiểm tra chạy đúng trên trình duyệt, merge branch `lab1` vào `main` | Đã hoàn thành | Hoạt động trơn tru trên trình duyệt và merge thành công |
| **17**| Gắn tag `v1.0.0` trên `main` đánh dấu hoàn thành Lab 1 | Đã hoàn thành | Tag `v1.0.0` đã được tạo và đẩy lên GitHub |

---

## 2. Chi tiết 5 Danh mục (Categories)

1. **Công Nghệ** (Slug: `cong-nghe`): Cập nhật tin tức, sản phẩm và xu hướng công nghệ mới nhất trong và ngoài nước.
2. **Lập Trình Web** (Slug: `lap-trinh-web`): Kiến thức, hướng dẫn thực hành và kỹ năng phát triển ứng dụng web hiện đại.
3. **Đời Sống Số** (Slug: `doi-song-so`): Ứng dụng chuyển đổi số và công nghệ thông tin vào đời sống và công việc hàng ngày.
4. **Khoa Học & Đổi Mới** (Slug: `khoa-hoc-doi-moi`): Khám phá vũ trụ, nghiên cứu khoa học và những đột phá công nghệ tương lai.
5. **Thủ Thuật Tin Học** (Slug: `thu-thuat-tin-hoc`): Tổng hợp mẹo hay, thủ thuật máy tính, phím tắt và kỹ năng sử dụng phần mềm hiệu quả.

---

## 3. Chi tiết 10 Bài viết (Posts)

| STT | Tiêu đề bài viết | Danh mục | Thẻ (Tags) | Độ dài Excerpt | Số ảnh minh họa |
| :---: | :--- | :--- | :--- | :---: | :---: |
| 1 | Trí Tuệ Nhân Tạo AI Đang Thay Đổi Cách Chúng Ta Làm Việc Như Thế Nào? | Công Nghệ | Trí Tuệ Nhân Tạo, AI, Công Nghệ Tương Lai | 103 ký tự | 1 Featured + 2 Content |
| 2 | Xu Hướng Thiết Bị Smarthome Tiện Nghi Trong Ngôi Nhà Hiện Đại | Công Nghệ | Smarthome, Nhà Thông Minh, IoT | 104 ký tự | 1 Featured + 2 Content |
| 3 | Lộ Trình Tự Học Lập Trình Web Từ Cơ Bản Đến Nâng Cao Cho Người Mới | Lập Trình Web | Lập Trình Web, HTML CSS, JavaScript | 100 ký tự | 1 Featured + 2 Content |
| 4 | Tại Sao WordPress Vẫn Là Hệ Quản Trị Nội Dung CMS Số Một Thế Giới? | Lập Trình Web | WordPress, CMS, Quản Trị Web | 102 ký tự | 1 Featured + 2 Content |
| 5 | Bảo Vệ Dữ Liệu Cá Nhân Và An Toàn Thông Tin Trong Kỷ Nguyên Số | Đời Sống Số | Bảo Mật, An Toàn Số, Dữ Liệu Cá Nhân | 104 ký tự | 1 Featured + 2 Content |
| 6 | Thanh Toán Không Tiền Mặt: Thói Quen Tiêu Dùng Mới Của Giới Trẻ | Đời Sống Số | Thanh Toán Số, Fintech, Ví Điện Tử | 100 ký tự | 1 Featured + 2 Content |
| 7 | Khám Phá Kính Viễn Vọng Không Gian James Webb Và Bí Ẩn Vũ Trụ | Khoa Học & Đổi Mới | Thiên Văn Học, James Webb, Vũ Trụ | 105 ký tự | 1 Featured + 2 Content |
| 8 | Năng Lượng Tái Tạo: Trụ Cột Cho Chiến Lược Phát Triển Xanh Bền Vững | Khoa Học & Đổi Mới | Năng Lượng Xanh, Phát Triển Bền Vững, Môi Trường | 99 ký tự | 1 Featured + 2 Content |
| 9 | 10 Phím Tắt Tiện Dụng Trên Windows 11 Giúp Tăng Năng Suất Làm Việc | Thủ Thuật Tin Học | Windows 11, Phím Tắt, Mẹo Tin Học | 103 ký tự | 1 Featured + 2 Content |
| 10 | Cách Tối Ưu Hóa Tốc Độ Máy Tính Windows Chạy Nhanh Như Lúc Mới Mua | Thủ Thuật Tin Học | Tối Ưu Máy Tính, Thủ Thuật Windows, Tăng Tốc PC | 99 ký tự | 1 Featured + 2 Content |

---

## 4. Bảng tài khoản & So sánh 5 vai trò người dùng trong WordPress

### Danh sách tài khoản
- **user1** (Role: `administrator`, Password: `User@123456`) - Toàn quyền quản trị
- **user2** (Role: `editor`, Password: `User@123456`) - Quản lý mọi bài viết và trang
- **user3** (Role: `author`, Password: `User@123456`) - Viết và xuất bản bài viết của mình
- **user4** (Role: `contributor`, Password: `User@123456`) - Viết bài nhưng phải gửi chờ duyệt
- **user5** (Role: `subscriber`, Password: `User@123456`) - Chỉ xem và quản lý hồ sơ cá nhân

### Ma trận quyền hạn
| Vai trò | Viết bài mới | Đăng bài trực tiếp | Sửa bài người khác | Quản lý Chuyên mục | Quản lý Trang | Tải ảnh/Media | Quản lý Theme/Plugin | Quản lý User/Settings |
| :--- | :---: | :---: | :---: | :---: | :---: | :---: | :---: | :---: |
| **Administrator** | Có | Có | Có | Có | Có | Có | Có | Có |
| **Editor** | Có | Có | Có | Có | Có | Có | Không | Không |
| **Author** | Có | Có | Không | Không | Không | Có | Không | Không |
| **Contributor** | Có | Không (Chờ duyệt) | Không | Không | Không | Không | Không | Không |
| **Subscriber** | Không | Không | Không | Không | Không | Không | Không | Không |

---

## 5. Cấu hình Cài đặt Chung (Settings > General)

- **Tên trang web (Site Title):** Bùi Nguyên Minh Quân - CMS
- **Khẩu hiệu (Tagline):** Hệ thống Quản trị Nội dung - Lab 1 WordPress
- **Múi giờ (Timezone):** `Asia/Ho_Chi_Minh` (UTC+7)
- **Định dạng ngày:** `d/m/Y` (Ví dụ: 10/09/2026)
- **Định dạng giờ:** `H:i` (Ví dụ: 22:15)
- **URL truy cập:** `http://localhost/BuiNguyenMinhQuan_CMS.git/` hoặc `http://localhost/wordpress/`
