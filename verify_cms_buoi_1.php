<?php
require_once __DIR__ . '/wp-load.php';

echo "--- 1. KIỂM TRA ĐĂNG NHẬP 3 USER ---" . PHP_EOL;
$users = array( 'cms_read', 'cms_write', 'cms_admin' );
foreach ( $users as $u ) {
	$auth = wp_authenticate( $u, 'User@123456' );
	if ( ! is_wp_error( $auth ) ) {
		echo "User '{$u}' đăng nhập: THÀNH CÔNG (Roles: " . implode( ', ', $auth->roles ) . ")" . PHP_EOL;
	} else {
		echo "User '{$u}' đăng nhập: THẤT BẠI (" . $auth->get_error_message() . ")" . PHP_EOL;
	}
}

echo PHP_EOL . "--- 2. KIỂM TRA QUYỀN HẠN CỦA 3 ROLES ---" . PHP_EOL;
$roles = wp_roles();
foreach ( array( 'cms_read', 'cms_write', 'cms_admin' ) as $r ) {
	$caps = $roles->roles[ $r ]['capabilities'] ?? array();
	echo "Role [{$r}]:" . PHP_EOL;
	echo "   - read:            " . ( ! empty( $caps['read'] ) ? 'CÓ' : 'KHÔNG' ) . PHP_EOL;
	echo "   - edit_posts:      " . ( ! empty( $caps['edit_posts'] ) ? 'CÓ' : 'KHÔNG' ) . PHP_EOL;
	echo "   - delete_posts:    " . ( ! empty( $caps['delete_posts'] ) ? 'CÓ' : 'KHÔNG' ) . PHP_EOL;
	echo "   - upload_files:    " . ( ! empty( $caps['upload_files'] ) ? 'CÓ' : 'KHÔNG' ) . PHP_EOL;
	echo "   - install_plugins: " . ( ! empty( $caps['install_plugins'] ) ? 'CÓ' : 'KHÔNG' ) . PHP_EOL;
	echo "   - activate_plugins:" . ( ! empty( $caps['activate_plugins'] ) ? 'CÓ' : 'KHÔNG' ) . PHP_EOL;
	echo "   - install_themes:  " . ( ! empty( $caps['install_themes'] ) ? 'CÓ' : 'KHÔNG' ) . PHP_EOL;
	echo "   - switch_themes:   " . ( ! empty( $caps['switch_themes'] ) ? 'CÓ' : 'KHÔNG' ) . PHP_EOL;
}

echo PHP_EOL . "--- 3. KIỂM TRA 3 CATEGORIES (Tennis, Pic, Football) ---" . PHP_EOL;
foreach ( array( 'tennis', 'pic', 'football' ) as $slug ) {
	$cat = get_term_by( 'slug', $slug, 'category' );
	if ( $cat ) {
		echo "Category: '{$cat->name}' | Slug: '{$cat->slug}' | ID: {$cat->term_id} | Số bài viết: {$cat->count}" . PHP_EOL;
	} else {
		echo "Category '{$slug}' KHÔNG TÌM THẤY!" . PHP_EOL;
	}
}

echo PHP_EOL . "--- 4. KIỂM TRA BÀI VIẾT THỂ THAO, HÌNH ẢNH & YOUTUBE VIDEO ---" . PHP_EOL;
$posts = get_posts( array(
	'post_type'      => 'post',
	'posts_per_page' => 3,
	'orderby'        => 'date',
	'order'          => 'DESC',
) );

foreach ( $posts as $p ) {
	$cats = wp_get_post_categories( $p->ID, array( 'fields' => 'names' ) );
	$thumb = get_the_post_thumbnail_url( $p->ID );
	$has_yt = ( strpos( $p->post_content, 'youtube.com' ) !== false || strpos( $p->post_content, 'youtu.be' ) !== false );
	$has_img = ( strpos( $p->post_content, '<img' ) !== false );
	echo "Bài viết ID {$p->ID}: '{$p->post_title}'" . PHP_EOL;
	echo "   - Chuyên mục: " . implode( ', ', $cats ) . PHP_EOL;
	echo "   - Featured Image: " . ( $thumb ? "CÓ ({$thumb})" : 'KHÔNG' ) . PHP_EOL;
	echo "   - Ảnh trong bài: " . ( $has_img ? 'CÓ' : 'KHÔNG' ) . PHP_EOL;
	echo "   - Video YouTube: " . ( $has_yt ? 'CÓ' : 'KHÔNG' ) . PHP_EOL;
}
