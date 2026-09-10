# Báo Cáo Phân Quyền Và So Sánh 5 Vai Trò Trong WordPress (Lab 1)

**Họ và tên:** Bùi Nguyên Minh Quân  
**MSSV:** 24211TT1178  
**Đề tài:** Lab 1 - Cài đặt, Quản trị Nội dung và Phân quyền Người dùng CMS WordPress  

---

## 1. Danh sách 5 tài khoản người dùng đã tạo

| STT | Tên đăng nhập (Username) | Mật khẩu (Password) | Vai trò (Role) | Email | Trạng thái đăng nhập thử |
| :--- | :--- | :--- | :--- | :--- | :--- |
| 1 | **user1** | `User@123456` | **Administrator** (Quản trị viên) | user1_admin@example.com | Thành công (Toàn quyền) |
| 2 | **user2** | `User@123456` | **Editor** (Biên tập viên) | user2_editor@example.com | Thành công (Quản lý nội dung) |
| 3 | **user3** | `User@123456` | **Author** (Tác giả) | user3_author@example.com | Thành công (Đăng bài cá nhân) |
| 4 | **user4** | `User@123456` | **Contributor** (Cộng tác viên) | user4_contributor@example.com | Thành công (Soạn bài, chờ duyệt) |
| 5 | **user5** | `User@123456` | **Subscriber** (Thành viên/Độc giả) | user5_subscriber@example.com | Thành công (Chỉ xem/sửa profile) |

---

## 2. Bảng ma trận so sánh chi tiết quyền hạn 5 vai trò

| Nhóm chức năng | Quyền hạn cụ thể | Administrator | Editor | Author | Contributor | Subscriber |
| :--- | :--- | :---: | :---: | :---: | :---: | :---: |
| **Bài viết (Posts)** | Viết bài mới | Cho phép | Cho phép | Cho phép | Cho phép | Không |
| | Xuất bản bài viết trực tiếp (Publish) | Cho phép | Cho phép | Cho phép | Không (Chờ duyệt) | Không |
| | Sửa/Xóa bài viết của chính mình | Cho phép | Cho phép | Cho phép | Cho phép | Không |
| | Sửa/Xóa bài viết của người khác | Cho phép | Cho phép | Không | Không | Không |
| | Quản lý Chuyên mục (Categories) & Thẻ (Tags) | Cho phép | Cho phép | Không | Không | Không |
| **Trang (Pages)** | Tạo, sửa, xóa và xuất bản Trang tĩnh | Cho phép | Cho phép | Không | Không | Không |
| **Đa phương tiện (Media)** | Tải lên hình ảnh, video, tài liệu | Cho phép | Cho phép | Cho phép | Không | Không |
| **Bình luận (Comments)** | Kiểm duyệt, sửa, xóa, duyệt bình luận | Cho phép | Cho phép | Không | Không | Không |
| **Giao diện (Appearance)** | Cài đặt theme, chỉnh sửa widget, menu | Cho phép | Không | Không | Không | Không |
| **Tiện ích (Plugins)** | Cài đặt, kích hoạt, gỡ bỏ plugin | Cho phép | Không | Không | Không | Không |
| **Người dùng (Users)** | Thêm, sửa quyền, xóa tài khoản user | Cho phép | Không | Không | Không | Không |
| | Chỉnh sửa trang cá nhân (Profile) của mình | Cho phép | Cho phép | Cho phép | Cho phép | Cho phép |
| **Cài đặt (Settings)** | Tùy biến Tổng quan, Đọc, Viết, Permalinks | Cho phép | Không | Không | Không | Không |
| **Công cụ (Tools)** | Import, Export, Kiểm tra sức khỏe trang | Cho phép | Không | Không | Không | Không |

---

## 3. Ghi nhận và so sánh chi tiết từng vai trò

### 1. Administrator (Quản trị viên - `user1`)
- **Được phép:** Có quyền hạn tối cao trên toàn bộ website: cài đặt theme, plugin, quản lý người dùng, chỉnh sửa cấu hình hệ thống (Settings), quản lý toàn bộ bài viết, trang và bình luận.
- **Không được phép:** Không bị giới hạn bất kỳ chức năng nào.

### 2. Editor (Biên tập viên - `user2`)
- **Được phép:** Toàn quyền kiểm soát và quản lý các nội dung của trang web: viết, sửa, xuất bản và xóa bài viết/trang tĩnh (kể cả của tác giả khác); quản lý chuyên mục, thẻ và duyệt bình luận; tải file media lên thư viện.
- **Không được phép:** Không can thiệp vào cấu hình website (Settings), không cài/sửa theme, plugin, không xem và không quản lý danh sách tài khoản người dùng khác.

### 3. Author (Tác giả - `user3`)
- **Được phép:** Viết, chỉnh sửa, tải ảnh/media và xuất bản trực tiếp các bài viết của chính mình; xóa bài viết đã xuất bản của mình.
- **Không được phép:** Không được sửa hay xóa bài viết của người khác; không được tạo/sửa Trang tĩnh (Pages); không quản lý được danh mục (Categories); không có quyền duyệt bình luận; không can thiệp hệ thống.

### 4. Contributor (Cộng tác viên - `user4`)
- **Được phép:** Viết và chỉnh sửa bài viết của chính mình, sau đó gửi bài ở trạng thái chờ duyệt (**Submit for Review**).
- **Không được phép:** Không được tự ý xuất bản bài viết lên website; không có quyền tải file ảnh/media lên thư viện; không được xóa bài viết khi đã được duyệt và xuất bản; không can thiệp bài viết của người khác.

### 5. Subscriber (Người đăng ký / Độc giả - `user5`)
- **Được phép:** Đăng nhập vào hệ thống, xem và chỉnh sửa thông tin cá nhân (Profile) như mật khẩu, tên hiển thị; xem các nội dung dành riêng cho thành viên đã đăng nhập.
- **Không được phép:** Hoàn toàn không có quyền tạo bài viết, không tải media, không sửa nội dung hay truy cập các trang quản trị khác. Menu Admin Dashboard chỉ hiển thị mục duy nhất là **Profile**.
