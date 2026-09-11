<?php
/**
 * Setup data for CMS Buổi 1:
 * - Roles: cms_read, cms_write, cms_admin
 * - Users: cms_read, cms_write, cms_admin
 * - Categories: Tennis, Pic, Football
 * - Posts: 3 Sports posts with images & YouTube videos
 */

// Define CLI mode
if ( php_sapi_name() !== 'cli' ) {
	die( 'This script can only be run from the command line.' );
}

require_once __DIR__ . '/wp-load.php';
require_once ABSPATH . 'wp-admin/includes/image.php';
require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/media.php';

echo "=== BẮT ĐẦU THIẾT LẬP DỮ LIỆU CMS BUỔI 1 ===" . PHP_EOL;

// 1. Đăng ký / Xác nhận 3 vai trò (Roles)
echo "\n--- 1. Cấu hình Roles & Capabilities ---" . PHP_EOL;
$roles = wp_roles();

// cms_read
$read_caps = array(
	'read' => true,
);
if ( ! isset( $roles->roles['cms_read'] ) ) {
	add_role( 'cms_read', 'CMS Read', $read_caps );
	echo "[OK] Đã tạo mới role: cms_read" . PHP_EOL;
} else {
	$roles->roles['cms_read']['capabilities'] = $read_caps;
	echo "[OK] Đã cập nhật role: cms_read" . PHP_EOL;
}

// cms_write
$write_caps = array(
	'read'                   => true,
	'edit_posts'             => true,
	'edit_others_posts'      => true,
	'edit_published_posts'   => true,
	'publish_posts'          => true,
	'delete_posts'           => true,
	'delete_others_posts'    => true,
	'delete_published_posts' => true,
	'read_private_posts'     => true,
	'upload_files'           => true,
	'manage_categories'      => true,
);
if ( ! isset( $roles->roles['cms_write'] ) ) {
	add_role( 'cms_write', 'CMS Write', $write_caps );
	echo "[OK] Đã tạo mới role: cms_write" . PHP_EOL;
} else {
	$roles->roles['cms_write']['capabilities'] = $write_caps;
	echo "[OK] Đã cập nhật role: cms_write" . PHP_EOL;
}

// cms_admin
$admin_caps = array(
	'read'                   => true,
	'edit_posts'             => true,
	'edit_others_posts'      => true,
	'edit_published_posts'   => true,
	'publish_posts'          => true,
	'delete_posts'           => true,
	'delete_others_posts'    => true,
	'delete_published_posts' => true,
	'edit_pages'             => true,
	'edit_others_pages'      => true,
	'edit_published_pages'   => true,
	'publish_pages'          => true,
	'delete_pages'           => true,
	'delete_others_pages'    => true,
	'delete_published_pages' => true,
	'manage_categories'      => true,
	'moderate_comments'      => true,
	'upload_files'           => true,
	'unfiltered_html'        => true,
	'manage_options'         => true,
	// Quyền cài plugin
	'install_plugins'        => true,
	'activate_plugins'       => true,
	'update_plugins'         => true,
	'delete_plugins'         => true,
	'edit_plugins'           => true,
	// Quyền cài theme
	'install_themes'         => true,
	'switch_themes'          => true,
	'edit_theme_options'     => true,
	'update_themes'          => true,
	'delete_themes'          => true,
	'edit_themes'            => true,
	'customize'              => true,
);
if ( ! isset( $roles->roles['cms_admin'] ) ) {
	add_role( 'cms_admin', 'CMS Admin', $admin_caps );
	echo "[OK] Đã tạo mới role: cms_admin" . PHP_EOL;
} else {
	$roles->roles['cms_admin']['capabilities'] = $admin_caps;
	echo "[OK] Đã cập nhật role: cms_admin" . PHP_EOL;
}

// 2. Tạo 3 tài khoản user: cms_read, cms_write, cms_admin
echo "\n--- 2. Tạo tài khoản User ---" . PHP_EOL;
$users_to_create = array(
	array(
		'username' => 'cms_read',
		'password' => 'User@123456',
		'email'    => 'cms_read@example.com',
		'role'     => 'cms_read',
		'display'  => 'CMS Read User',
	),
	array(
		'username' => 'cms_write',
		'password' => 'User@123456',
		'email'    => 'cms_write@example.com',
		'role'     => 'cms_write',
		'display'  => 'CMS Write User',
	),
	array(
		'username' => 'cms_admin',
		'password' => 'User@123456',
		'email'    => 'cms_admin@example.com',
		'role'     => 'cms_admin',
		'display'  => 'CMS Admin User',
	),
);

foreach ( $users_to_create as $u ) {
	$existing_user = get_user_by( 'login', $u['username'] );
	if ( ! $existing_user ) {
		$user_id = wp_create_user( $u['username'], $u['password'], $u['email'] );
		if ( ! is_wp_error( $user_id ) ) {
			wp_update_user( array(
				'ID'           => $user_id,
				'display_name' => $u['display'],
				'role'         => $u['role'],
			) );
			echo "[OK] Đã tạo user {$u['username']} (Role: {$u['role']})" . PHP_EOL;
		} else {
			echo "[LỖI] Tạo user {$u['username']}: " . $user_id->get_error_message() . PHP_EOL;
		}
	} else {
		wp_set_password( $u['password'], $existing_user->ID );
		$existing_user->set_role( $u['role'] );
		wp_update_user( array(
			'ID'           => $existing_user->ID,
			'display_name' => $u['display'],
			'user_email'   => $u['email'],
		) );
		echo "[OK] Đã cập nhật user {$u['username']} (Role: {$u['role']})" . PHP_EOL;
	}
}

// 3. Tạo 3 chuyên mục (Category): Tennis, Pic, Football
echo "\n--- 3. Khởi tạo 3 Category (Tennis, Pic, Football) ---" . PHP_EOL;
$categories_to_create = array(
	array(
		'name'        => 'Tennis',
		'slug'        => 'tennis',
		'description' => 'Chuyên mục Quần vợt (Tennis) - Tin tức các giải đấu danh giá, kỹ thuật thi đấu và những trận cầu kịch tính bậc nhất.',
	),
	array(
		'name'        => 'Pic',
		'slug'        => 'pic',
		'description' => 'Chuyên mục Pickleball (Pic) - Môn thể thao thời thượng phát triển nhanh nhất, luật thi đấu, kỹ thuật và trang bị thi đấu chuẩn mực.',
	),
	array(
		'name'        => 'Football',
		'slug'        => 'football',
		'description' => 'Chuyên mục Bóng đá (Football) - Sân cỏ thế giới, phân tích chiến thuật hiện đại và video tổng hợp các siêu phẩm bàn thắng.',
	),
);

$cat_ids = array();
foreach ( $categories_to_create as $cat ) {
	$term = get_term_by( 'slug', $cat['slug'], 'category' );
	if ( ! $term ) {
		$result = wp_insert_term(
			$cat['name'],
			'category',
			array(
				'slug'        => $cat['slug'],
				'description' => $cat['description'],
			)
		);
		if ( ! is_wp_error( $result ) ) {
			$cat_ids[ $cat['slug'] ] = $result['term_id'];
			echo "[OK] Đã tạo Category: {$cat['name']} (ID: {$result['term_id']}, Slug: {$cat['slug']})" . PHP_EOL;
		} else {
			echo "[LỖI] Tạo Category {$cat['name']}: " . $result->get_error_message() . PHP_EOL;
		}
	} else {
		wp_update_term(
			$term->term_id,
			'category',
			array(
				'name'        => $cat['name'],
				'description' => $cat['description'],
			)
		);
		$cat_ids[ $cat['slug'] ] = $term->term_id;
		echo "[OK] Đã cập nhật Category: {$cat['name']} (ID: {$term->term_id})" . PHP_EOL;
	}
}

// 4. Đăng ký hình ảnh vào Media Library
echo "\n--- 4. Đăng ký Media Uploads ---" . PHP_EOL;
$upload_dir = wp_upload_dir();
$image_files = array(
	'tennis'     => array(
		'file'  => $upload_dir['basedir'] . '/sports/tennis_action.jpg',
		'url'   => $upload_dir['baseurl'] . '/sports/tennis_action.jpg',
		'title' => 'Tennis Championship Match Action',
	),
	'pickleball' => array(
		'file'  => $upload_dir['basedir'] . '/sports/pickleball_action.jpg',
		'url'   => $upload_dir['baseurl'] . '/sports/pickleball_action.jpg',
		'title' => 'Dynamic Pickleball Match Action',
	),
	'football'   => array(
		'file'  => $upload_dir['basedir'] . '/sports/football_action.jpg',
		'url'   => $upload_dir['baseurl'] . '/sports/football_action.jpg',
		'title' => 'Soccer Striker Bicycle Kick Goal Action',
	),
);

$attachment_ids = array();
foreach ( $image_files as $key => $img ) {
	if ( file_exists( $img['file'] ) ) {
		// Kiểm tra xem attachment đã tồn tại chưa
		$existing = get_posts( array(
			'post_type'      => 'attachment',
			'meta_key'       => '_wp_attached_file',
			'meta_value'     => 'sports/' . basename( $img['file'] ),
			'posts_per_page' => 1,
		) );

		if ( ! empty( $existing ) ) {
			$attach_id = $existing[0]->ID;
			echo "[OK] Attachment đã tồn tại: {$img['title']} (ID: {$attach_id})" . PHP_EOL;
		} else {
			$attachment = array(
				'guid'           => $img['url'],
				'post_mime_type' => 'image/jpeg',
				'post_title'     => $img['title'],
				'post_content'   => '',
				'post_status'    => 'inherit',
			);
			$attach_id = wp_insert_attachment( $attachment, $img['file'] );
			$attach_data = wp_generate_attachment_metadata( $attach_id, $img['file'] );
			wp_update_attachment_metadata( $attach_id, $attach_data );
			update_post_meta( $attach_id, '_wp_attached_file', 'sports/' . basename( $img['file'] ) );
			echo "[OK] Đã đăng ký Media mới: {$img['title']} (ID: {$attach_id})" . PHP_EOL;
		}
		$attachment_ids[ $key ] = $attach_id;
	} else {
		echo "[CẢNH BÁO] Không tìm thấy file: {$img['file']}" . PHP_EOL;
	}
}

// 5. Tạo 3 bài viết thể thao có Hình ảnh và Video YouTube
echo "\n--- 5. Khởi tạo 3 Post Thể Thao (Kèm Hình ảnh và Video YouTube) ---" . PHP_EOL;

$admin_user = get_user_by( 'login', 'admin' );
$author_id = $admin_user ? $admin_user->ID : 1;

$sports_posts = array(
	array(
		'slug'             => 'tuyet-ky-giao-bong-tennis-dinh-cao',
		'title'            => 'Tuyệt Kỹ Giao Bóng Tennis Đỉnh Cao Và Trận Cầu Kinh Điển Grand Slam',
		'category_slug'    => 'tennis',
		'tags'             => array( 'Tennis', 'Quần Vợt', 'Grand Slam', 'Thể Thao' ),
		'featured_img_key' => 'tennis',
		'img_url'          => $image_files['tennis']['url'],
		'youtube_url'      => 'https://www.youtube.com/watch?v=F_fDcwU4Q5A',
		'youtube_embed'    => 'https://www.youtube.com/embed/F_fDcwU4Q5A',
		'excerpt'          => 'Khám phá bí quyết giao bóng sấm sét chuẩn xác trong bộ môn Tennis đỉnh cao và chiêm ngưỡng lại những pha bóng ngoạn mục nhất.',
		'content'          => <<<EOD
<!-- wp:paragraph -->
<p class="lead">Giao bóng (Serve) là một trong những vũ khí quan trọng bậc nhất giúp các tay vợt giành thế chủ động ngay từ điểm số đầu tiên trên mặt sân banh nỉ chuyên nghiệp. Để sở hữu một cú giao bóng uy lực, vận động viên cần kết hợp nhịp nhàng giữa lực cổ tay, đà bật nhảy và điểm tiếp xúc bóng chính xác ở tầm cao tối đa.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">1. Nghệ thuật kiểm soát độ xoáy và tốc độ bóng</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Trong quần vợt hiện đại, một cú giao bóng Flat (thẳng) có thể vượt qua mốc vận tốc 220 km/h. Tuy nhiên, các biến thể Kick Serve (xoáy cống) và Slice Serve (xoáy ngang) mới chính là vũ khí hiểm hóc khiến đối thủ bị đẩy ra ngoài biên sân hoặc lỡ nhịp trả bóng.</p>
<!-- /wp:paragraph -->

<!-- wp:image {"sizeSlug":"large","linkDestination":"none"} -->
<figure class="wp-block-image size-large">
<img src="{IMG_URL}" alt="Hình ảnh pha giao bóng Tennis đỉnh cao" style="width:100%; border-radius:8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); margin: 15px 0;"/>
<figcaption style="text-align:center; font-style:italic; color:#666;">Hình ảnh: Vận động viên thực hiện cú giao bóng bật nhảy đầy uy lực trên sân cứng (Hard Court).</figcaption>
</figure>
<!-- /wp:image -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">2. Video thực tế: Highlight những pha giao bóng đỉnh cao thế giới (YouTube)</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Hãy cùng theo dõi những pha giao bóng ace và các loạt rally đẳng cấp nhất trong video dưới đây:</p>
<!-- /wp:paragraph -->

<!-- wp:embed {"url":"https://www.youtube.com/watch?v=F_fDcwU4Q5A","type":"video","providerNameSlug":"youtube","responsive":true,"className":"wp-embed-aspect-16-9 wp-has-aspect-ratio"} -->
<figure class="wp-block-embed is-type-video is-provider-youtube wp-block-embed-youtube wp-embed-aspect-16-9 wp-has-aspect-ratio">
<div class="wp-block-embed__wrapper" style="position:relative; padding-bottom:56.25%; height:0; overflow:hidden; border-radius:8px; box-shadow:0 4px 15px rgba(0,0,0,0.2);">
<iframe src="https://www.youtube.com/embed/F_fDcwU4Q5A" title="Tennis Highlights Match Action" style="position:absolute; top:0; left:0; width:100%; height:100%; border:0;" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
</div>
<figcaption style="text-align:center; font-style:italic; color:#666; margin-top:8px;">Video YouTube: Top những pha bóng kinh điển và kỹ thuật giao bóng xuất sắc nhất thế giới.</figcaption>
</figure>
<!-- /wp:embed -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">3. Tóm tắt kỹ thuật then chốt</h2>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li>Tung bóng ở vị trí 12h - 1h hơi chếch về phía trước vạch cuối sân.</li>
<li>Gập gối tạo thế lò xo đẩy toàn bộ trọng tâm cơ thể lên không trung.</li>
<li>Quay vai đồng bộ và vung vợt với độ mở mặt vợt tối ưu để tạo lực xoáy xoắn bóng.</li>
</ul>
<!-- /wp:list -->
EOD
	),
	array(
		'slug'             => 'cam-nang-pickleball-luat-choi-va-ky-thuat-dinking',
		'title'            => 'Cơn Sốt Pickleball Toàn Cầu: Luật Thi Đấu Cơ Bản, Kỹ Thuật Dinking Và Cách Chọn Vợt',
		'category_slug'    => 'pic',
		'tags'             => array( 'Pic', 'Pickleball', 'Thể Thao Thời Thượng', 'Dinking' ),
		'featured_img_key' => 'pickleball',
		'img_url'          => $image_files['pickleball']['url'],
		'youtube_url'      => 'https://www.youtube.com/watch?v=kqLRRNoao8E',
		'youtube_embed'    => 'https://www.youtube.com/embed/kqLRRNoao8E',
		'excerpt'          => 'Tìm hiểu toàn diện về môn thể thao hot nhất hiện nay Pickleball (Pic): luật khu vực Kitchen, kỹ thuật dinking thả nhỏ và video hướng dẫn trực quan.',
		'content'          => <<<EOD
<!-- wp:paragraph -->
<p class="lead">Pickleball (thường được viết tắt là Pic) đang là bộ môn thể thao có tốc độ tăng trưởng nhanh nhất trên thế giới. Nhờ sự kết hợp tinh tế giữa quần vợt, bóng bàn và cầu lông, Pickleball mang lại trải nghiệm thi đấu cuốn hút, vừa rèn luyện phản xạ nhanh vừa phù hợp với nhiều lứa tuổi.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">1. Quy tắc vùng Non-Volley Zone (The Kitchen)</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Một trong những điểm đặc trưng nhất của Pickleball là vùng "Kitchen" (khu vực 2.13m tính từ lưới). Người chơi không được đứng trong vùng này để đập bóng trên không (volley), trừ khi bóng đã nảy một nhịp trên mặt sân. Kỹ thuật "Dinking" - đánh bóng nhẹ nhàng rơi sát lưới vào vùng Kitchen của đối phương - chính là chìa khóa chiến thuật tạo nên sự kịch tính.</p>
<!-- /wp:paragraph -->

<!-- wp:image {"sizeSlug":"large","linkDestination":"none"} -->
<figure class="wp-block-image size-large">
<img src="{IMG_URL}" alt="Hình ảnh trận đấu Pickleball sôi động" style="width:100%; border-radius:8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); margin: 15px 0;"/>
<figcaption style="text-align:center; font-style:italic; color:#666;">Hình ảnh: Pha cứu bóng chuẩn xác bằng vợt Pickleball carbon chuyên dụng trên sân thi đấu.</figcaption>
</figure>
<!-- /wp:image -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">2. Video hướng dẫn: Luật chơi Pickleball cơ bản cho người mới bắt đầu (YouTube)</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Hãy cùng xem video hướng dẫn cụ thể luật chơi, cách tính điểm và kỹ năng di chuyển trong môn Pickleball:</p>
<!-- /wp:paragraph -->

<!-- wp:embed {"url":"https://www.youtube.com/watch?v=kqLRRNoao8E","type":"video","providerNameSlug":"youtube","responsive":true,"className":"wp-embed-aspect-16-9 wp-has-aspect-ratio"} -->
<figure class="wp-block-embed is-type-video is-provider-youtube wp-block-embed-youtube wp-embed-aspect-16-9 wp-has-aspect-ratio">
<div class="wp-block-embed__wrapper" style="position:relative; padding-bottom:56.25%; height:0; overflow:hidden; border-radius:8px; box-shadow:0 4px 15px rgba(0,0,0,0.2);">
<iframe src="https://www.youtube.com/embed/kqLRRNoao8E" title="Pickleball Rules and Beginners Guide" style="position:absolute; top:0; left:0; width:100%; height:100%; border:0;" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
</div>
<figcaption style="text-align:center; font-style:italic; color:#666; margin-top:8px;">Video YouTube: Hướng dẫn luật chơi Pickleball dễ hiểu và trực quan nhất.</figcaption>
</figure>
<!-- /wp:embed -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">3. Lời khuyên chọn trang thiết bị thi đấu</h2>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li><strong>Vợt (Paddle):</strong> Chọn vợt mặt sợi carbon (Raw Carbon Fiber) có lõi tổ ong polymer 16mm để tăng khả năng kiểm soát bóng.</li>
<li><strong>Bóng:</strong> Sử dụng bóng ngoài trời (Outdoor Ball với 40 lỗ nhỏ) có độ đầm và chống gió tốt.</li>
<li><strong>Giày chuyên dụng:</strong> Chọn giày đế court shoes có độ bám sân cao, hỗ trợ chuyển hướng đột ngột để chống chấn thương lật cổ chân.</li>
</ul>
<!-- /wp:list -->
EOD
	),
	array(
		'slug'             => 'chien-thuat-bong-da-hien-dai-va-sieu-pham-kinh-dien',
		'title'            => 'Toàn Cảnh Chiến Thuật Bóng Đá Hiện Đại Và Top Siêu Phẩm Bàn Thắng Thế Kỷ',
		'category_slug'    => 'football',
		'tags'             => array( 'Football', 'Bóng Đá', 'Siêu Phẩm', 'Chiến Thuật' ),
		'featured_img_key' => 'football',
		'img_url'          => $image_files['football']['url'],
		'youtube_url'      => 'https://www.youtube.com/watch?v=vVj_f85iA8E',
		'youtube_embed'    => 'https://www.youtube.com/embed/vVj_f85iA8E',
		'excerpt'          => 'Phân tích chiều sâu chiến thuật pressing tầm cao và chuyển đổi trạng thái trong bóng đá thế giới, kèm video tổng hợp những bàn thắng ngoạn mục.',
		'content'          => <<<EOD
<!-- wp:paragraph -->
<p class="lead">Bóng đá thế giới trong thập kỷ qua chứng kiến cuộc cách mạng chiến thuật sâu rộng, từ lối đá Tiki-taka kiểm soát tuyệt đối đến triết lý Gegenpressing phản áp lực tốc độ cao và nghệ thuật đảo cánh tấn công chớp nhoáng.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">1. Cuộc chiến không gian và vai trò của các vị trí lai (Hybrid Roles)</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Bóng đá hiện đại không còn đóng khung vị trí truyền thống. Các hậu vệ biên bó trong (Inverted Full-backs) di chuyển vào giữa sân để áp đảo quân số tuyến giữa, trong khi các tiền đạo cánh (Inside Forwards) liên tục bó sát vòng cấm để đón đường căng ngang hoặc thực hiện cú sút trái phá.</p>
<!-- /wp:paragraph -->

<!-- wp:image {"sizeSlug":"large","linkDestination":"none"} -->
<figure class="wp-block-image size-large">
<img src="{IMG_URL}" alt="Hình ảnh cú tung người móc bóng siêu phẩm trong trận đấu bóng đá" style="width:100%; border-radius:8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); margin: 15px 0;"/>
<figcaption style="text-align:center; font-style:italic; color:#666;">Hình ảnh: Khoảnh khắc tiền đạo thực hiện cú ngả người móc bóng (Bicycle Kick) ngoạn mục tung lưới đối phương.</figcaption>
</figure>
<!-- /wp:image -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">2. Video thực tế: Tổng hợp những siêu phẩm bàn thắng đẹp mắt nhất (YouTube)</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Cùng chiêm ngưỡng lại những khoảnh khắc bùng nổ cảm xúc của môn thể thao vua qua video YouTube tổng hợp dưới đây:</p>
<!-- /wp:paragraph -->

<!-- wp:embed {"url":"https://www.youtube.com/watch?v=vVj_f85iA8E","type":"video","providerNameSlug":"youtube","responsive":true,"className":"wp-embed-aspect-16-9 wp-has-aspect-ratio"} -->
<figure class="wp-block-embed is-type-video is-provider-youtube wp-block-embed-youtube wp-embed-aspect-16-9 wp-has-aspect-ratio">
<div class="wp-block-embed__wrapper" style="position:relative; padding-bottom:56.25%; height:0; overflow:hidden; border-radius:8px; box-shadow:0 4px 15px rgba(0,0,0,0.2);">
<iframe src="https://www.youtube.com/embed/vVj_f85iA8E" title="Legendary Football Goals and Highlights" style="position:absolute; top:0; left:0; width:100%; height:100%; border:0;" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
</div>
<figcaption style="text-align:center; font-style:italic; color:#666; margin-top:8px;">Video YouTube: Top bàn thắng thế kỷ và các pha phối hợp mẫu mực trên đấu trường thế giới.</figcaption>
</figure>
<!-- /wp:embed -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">3. Các yếu tố định hình trận đấu hiện đại</h2>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li><strong>Khả năng chuyển trạng thái (Transitions):</strong> Thời gian từ khi cướp lại bóng đến khi đưa bóng vào 1/3 sân đối phương chỉ trong vòng 5-7 giây.</li>
<li><strong>Phân tích dữ liệu & xG (Expected Goals):</strong> Tối ưu hóa các điểm dứt điểm có xác suất thành bàn cao nhất.</li>
<li><strong>Thể lực và cường độ chạy bền bỉ:</strong> Mỗi cầu thủ trung bình di chuyển từ 10km đến 12km mỗi trận với cường độ bứt tốc không ngừng.</li>
</ul>
<!-- /wp:list -->
EOD
	),
);

foreach ( $sports_posts as $post_data ) {
	$content = str_replace( '{IMG_URL}', $post_data['img_url'], $post_data['content'] );
	$cat_id = $cat_ids[ $post_data['category_slug'] ] ?? null;

	$existing_post = get_page_by_path( $post_data['slug'], OBJECT, 'post' );
	$post_arr = array(
		'post_title'    => $post_data['title'],
		'post_name'     => $post_data['slug'],
		'post_content'  => $content,
		'post_excerpt'  => $post_data['excerpt'],
		'post_status'   => 'publish',
		'post_author'   => $author_id,
		'post_type'     => 'post',
		'tags_input'    => $post_data['tags'],
		'post_category' => $cat_id ? array( $cat_id ) : array(),
	);

	if ( $existing_post ) {
		$post_arr['ID'] = $existing_post->ID;
		$pid = wp_update_post( $post_arr );
		echo "[OK] Đã cập nhật bài viết: {$post_data['title']} (ID: {$pid})" . PHP_EOL;
	} else {
		$pid = wp_insert_post( $post_arr );
		echo "[OK] Đã tạo bài viết mới: {$post_data['title']} (ID: {$pid})" . PHP_EOL;
	}

	// Đặt Featured Image (Ảnh đại diện)
	if ( $pid && ! is_wp_error( $pid ) && isset( $attachment_ids[ $post_data['featured_img_key'] ] ) ) {
		set_post_thumbnail( $pid, $attachment_ids[ $post_data['featured_img_key'] ] );
		echo "     -> Đã gán Featured Image ID: {$attachment_ids[ $post_data['featured_img_key'] ]}" . PHP_EOL;
	}
}

echo "\n=== HOÀN TẤT THIẾT LẬP DỮ LIỆU THÀNH CÔNG ===" . PHP_EOL;
