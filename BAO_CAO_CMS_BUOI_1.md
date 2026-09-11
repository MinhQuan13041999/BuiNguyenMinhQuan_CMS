# BÁO CÁO KẾT QUẢ THỰC HIỆN BÀI TẬP CMS BUỔI 1

- **Họ và tên sinh viên:** Bùi Nguyên Minh Quân
- **Mã số sinh viên (MSSV):** 24211TT1178
- **Lớp / Khóa:** Công nghệ Thông tin
- **Tên Repository GitHub:** [BuiNguyenMinhQuan_CMS](https://github.com/MinhQuan13041999/BuiNguyenMinhQuan_CMS)
- **Nhánh thực hiện (Branch):** `cms_buoi_1`
- **Cơ sở dữ liệu (Database):** `wordpress_buinguyenminhquan`
- **Môi trường chạy:** WampServer (Apache, PHP 8.4, MySQL 8.4)

---

## 1. Bảng Tổng Hợp Tiêu Chí Chấm Điểm (10 / 10 Điểm)

| STT | Nội dung yêu cầu theo Rubric | Điểm tối đa | Trạng thái | Ghi chú minh chứng |
| :---: | :--- | :---: | :---: | :--- |
| **1** | **User: CRUD, phân quyền cho user**<br>- `cms_read`: read<br>- `cms_write`: read, write<br>- `cms_admin`: cài plugin, cài theme | **5.0 điểm** | **ĐÃ HOÀN THÀNH** | Tạo mu-plugin đăng ký 3 vai trò chuẩn; tạo 3 tài khoản tương ứng với mật khẩu `User@123456`, kiểm tra phân quyền chuẩn 100%. |
| **2** | **Category: CRUD: Tennis, Pic, Football** | **2.5 điểm** | **ĐÃ HOÀN THÀNH** | Khởi tạo đầy đủ 3 chuyên mục `Tennis`, `Pic` (Pickleball) và `Football` kèm slug và mô tả chi tiết. |
| **3** | **POST: CRUD: Thể thao**<br>- Hình ảnh (Images)<br>- Video (YouTube) | **2.5 điểm** | **ĐÃ HOÀN THÀNH** | 3 bài viết thể thao chuyên sâu, có Featured Image, hình ảnh minh họa độ phân giải cao và video YouTube nhúng chuẩn responsive. |
| **4** | **Nhánh Git (Branch): `cms_buoi_1`** | Đạt yêu cầu | **ĐÃ HOÀN THÀNH** | Tạo nhánh độc lập `cms_buoi_1`, commit rõ ràng, export database dump vào `db/`. |

---

## 2. Chi Tiết Phân Quyền User (5.0 Điểm)

Hệ thống phân quyền được cài đặt trực tiếp vào WordPress Core và quản lý qua Must-Use plugin độc lập:  
`wp-content/mu-plugins/cms-roles-manager.php`.

### 2.1. Danh sách 3 tài khoản người dùng

| STT | Tên đăng nhập (Username) | Mật khẩu (Password) | Vai trò (Role) | Email | Khả năng truy cập thực tế |
| :---: | :--- | :--- | :--- | :--- | :--- |
| 1 | **cms_read** | `User@123456` | **CMS Read** (`cms_read`) | cms_read@example.com | Chỉ đọc nội dung, chỉ xem hồ sơ cá nhân, không can thiệp bài viết hay hệ thống. |
| 2 | **cms_write** | `User@123456` | **CMS Write** (`cms_write`) | cms_write@example.com | Đọc và viết nội dung: Thêm, sửa, xuất bản, xóa bài viết và upload media hình ảnh/video. |
| 3 | **cms_admin** | `User@123456` | **CMS Admin** (`cms_admin`) | cms_admin@example.com | Toàn quyền quản trị nội dung + **Cài plugin, kích hoạt plugin, cài theme, đổi theme**. |

### 2.2. Ma trận Capabilities (Quyền hạn) chi tiết

| Nhóm chức năng | Quyền hạn cụ thể (Capability) | cms_read | cms_write | cms_admin |
| :--- | :--- | :---: | :---: | :---: |
| **Đọc / Xem (Read)** | `read` (Đăng nhập và xem Dashboard/Profile) |  CÓ |  CÓ |  CÓ |
| **Viết & Quản lý bài viết (Write)** | `edit_posts` (Tạo và sửa bài viết) | ❌ KHÔNG |  CÓ |  CÓ |
| | `publish_posts` (Xuất bản bài viết trực tiếp) | ❌ KHÔNG |  CÓ |  CÓ |
| | `edit_published_posts` (Chỉnh sửa bài đã đăng) | ❌ KHÔNG |  CÓ |  CÓ |
| | `delete_posts` (Xóa bài viết) | ❌ KHÔNG |  CÓ |  CÓ |
| | `upload_files` (Tải lên hình ảnh, video đa phương tiện) | ❌ KHÔNG |  CÓ |  CÓ |
| **Cài Plugin (Tiện ích)** | `install_plugins` (Tìm và cài đặt plugin mới) | ❌ KHÔNG | ❌ KHÔNG |  **CÓ** |
| | `activate_plugins` (Kích hoạt plugin) | ❌ KHÔNG | ❌ KHÔNG |  **CÓ** |
| | `update_plugins` & `delete_plugins` (Cập nhật, xóa plugin) | ❌ KHÔNG | ❌ KHÔNG |  **CÓ** |
| **Cài Theme (Giao diện)** | `install_themes` (Tìm và cài đặt theme mới) | ❌ KHÔNG | ❌ KHÔNG |  **CÓ** |
| | `switch_themes` (Kích hoạt, chuyển đổi theme) | ❌ KHÔNG | ❌ KHÔNG |  **CÓ** |
| | `edit_theme_options` & `customize` (Tùy biến theme) | ❌ KHÔNG | ❌ KHÔNG |  **CÓ** |

---

## 3. Chi Tiết Chuyên Mục Category (2.5 Điểm)

Đã khởi tạo chuẩn 3 danh mục thể thao:

| STT | Tên Danh Mục | Slug | Term ID | Mô tả chuyên mục |
| :---: | :--- | :--- | :---: | :--- |
| 1 | **Tennis** | `tennis` | 37 | Chuyên mục Quần vợt (Tennis) - Tin tức các giải đấu danh giá Grand Slam, kỹ thuật thi đấu và những trận cầu kịch tính bậc nhất. |
| 2 | **Pic** | `pic` | 38 | Chuyên mục Pickleball (Pic) - Môn thể thao thời thượng phát triển nhanh nhất, luật thi đấu, kỹ thuật và trang bị thi đấu chuẩn mực. |
| 3 | **Football** | `football` | 39 | Chuyên mục Bóng đá (Football) - Sân cỏ thế giới, phân tích chiến thuật hiện đại và video tổng hợp các siêu phẩm bàn thắng. |

---

## 4. Chi Tiết Bài Viết Thể Thao Kèm Ảnh & Video YouTube (2.5 Điểm)

Tất cả các bài viết đều có đầy đủ Featured Image, hình ảnh minh họa chất lượng cao trong nội dung và Video YouTube nhúng chuẩn phát trực tiếp:

### 4.1. Bài viết môn Tennis
- **Tiêu đề:** *Tuyệt Kỹ Giao Bóng Tennis Đỉnh Cao Và Trận Cầu Kinh Điển Grand Slam*
- **Chuyên mục:** `Tennis` (ID: 37)
- **Thẻ (Tags):** Tennis, Quần Vợt, Grand Slam, Thể Thao
- **Hình ảnh minh họa:** Pha giao bóng sấm sét của vận động viên quần vợt trên mặt sân cứng (Ảnh lưu trữ tại `wp-content/uploads/sports/tennis_action.jpg`).
- **Video YouTube nhúng:** Highlight những pha giao bóng đỉnh cao và rally kinh điển tại giải quần vợt thế giới.
- **Link Video YouTube:** [https://www.youtube.com/watch?v=F_fDcwU4Q5A](https://www.youtube.com/watch?v=F_fDcwU4Q5A)

### 4.2. Bài viết môn Pickleball (Pic)
- **Tiêu đề:** *Cơn Sốt Pickleball Toàn Cầu: Luật Thi Đấu Cơ Bản, Kỹ Thuật Dinking Và Cách Chọn Vợt*
- **Chuyên mục:** `Pic` (ID: 38)
- **Thẻ (Tags):** Pic, Pickleball, Thể Thao Thời Thượng, Dinking
- **Hình ảnh minh họa:** Trận đấu đối kháng Pickleball kịch tính với bóng vàng có lỗ và vợt sợi carbon chuyên nghiệp (`wp-content/uploads/sports/pickleball_action.jpg`).
- **Video YouTube nhúng:** Hướng dẫn toàn diện luật chơi Pickleball cho người mới bắt đầu (Khu vực Kitchen, luật giao bóng và cách tính điểm).
- **Link Video YouTube:** [https://www.youtube.com/watch?v=kqLRRNoao8E](https://www.youtube.com/watch?v=kqLRRNoao8E)

### 4.3. Bài viết môn Bóng Đá (Football)
- **Tiêu đề:** *Toàn Cảnh Chiến Thuật Bóng Đá Hiện Đại Và Top Siêu Phẩm Bàn Thắng Thế Kỷ*
- **Chuyên mục:** `Football` (ID: 39)
- **Thẻ (Tags):** Football, Bóng Đá, Siêu Phẩm, Chiến Thuật
- **Hình ảnh minh họa:** Khoảnh khắc tiền đạo tung người móc bóng kiểu xe đạp chổng ngược (Bicycle Kick) ngoạn mục tung nóc lưới đối phương (`wp-content/uploads/sports/football_action.jpg`).
- **Video YouTube nhúng:** Tổng hợp các siêu phẩm bàn thắng thế kỷ và nghệ thuật phối hợp đỉnh cao môn thể thao vua.
- **Link Video YouTube:** [https://www.youtube.com/watch?v=vVj_f85iA8E](https://www.youtube.com/watch?v=vVj_f85iA8E)

---

## 5. Hướng Dẫn Giảng Viên Kiểm Tra Nhanh

### 5.1. Kiểm tra tự động bằng lệnh CLI (1 giây)
Tại thư mục gốc dự án, chạy lệnh:
```bash
php verify_cms_buoi_1.php
```
Kết quả hiển thị:
- Trạng thái đăng nhập thành công của 3 tài khoản `cms_read`, `cms_write`, `cms_admin`.
- Chi tiết bảng quyền hạn capabilities của từng role (read, write, install_plugins, install_themes).
- Danh sách 3 chuyên mục `Tennis`, `Pic`, `Football`.
- Danh sách 3 bài viết thể thao kèm xác nhận có Featured Image, ảnh trong bài và Video YouTube.

### 5.2. Kiểm tra trực quan trên trình duyệt (Giao diện WP Admin)
1. Truy cập trang đăng nhập: `http://localhost/BuiNguyenMinhQuan_CMS.git/wp-login.php`
2. **Đăng nhập thử `cms_read` (Pass: `User@123456`):** Menu quản trị bên trái chỉ hiển thị mục xem hồ sơ cá nhân (Profile), không thể thêm bài viết hay can thiệp hệ thống.
3. **Đăng nhập thử `cms_write` (Pass: `User@123456`):** Menu hiển thị mục **Posts** (thêm/sửa/xóa bài) và **Media** (upload ảnh). Hoàn toàn không có mục Plugins hay Themes.
4. **Đăng nhập thử `cms_admin` (Pass: `User@123456`):** Menu hiển thị đầy đủ mục **Plugins** (Cài mới, kích hoạt plugin) và mục **Appearance > Themes** (Cài mới, kích hoạt theme).
5. **Xem bài viết thể thao:** Truy cập trang chủ hoặc xem bài viết để kiểm tra hình ảnh chất lượng cao và phát thử video YouTube mượt mà.

### 5.3. Cơ sở dữ liệu Export
- File database hoàn chỉnh: `db/wordpress_cms_buoi_1.sql` và `db/wordpress_buinguyenminhquan.sql`.
