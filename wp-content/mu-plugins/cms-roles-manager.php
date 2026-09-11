<?php
/**
 * Plugin Name: CMS Roles & Capabilities Manager
 * Description: Quản lý phân quyền 3 vai trò cms_read, cms_write, cms_admin theo chuẩn đề thi CMS WordPress Buổi 1.
 * Author: Bùi Nguyên Minh Quân (MSSV: 24211TT1178)
 * Version: 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Đăng ký và cập nhật 3 vai trò theo rubric:
 * - cms_read: chỉ có quyền read
 * - cms_write: có quyền read, write (thêm xóa sửa nội dung, đăng bài, tải media)
 * - cms_admin: có toàn quyền quản trị nội dung + cài plugin, cài theme
 */
function cms_buoi_1_register_custom_roles() {
	// 1. Role: cms_read (read only)
	$read_caps = array(
		'read' => true,
	);
	
	if ( null === get_role( 'cms_read' ) ) {
		add_role( 'cms_read', __( 'CMS Read', 'cms-domain' ), $read_caps );
	} else {
		$role = get_role( 'cms_read' );
		foreach ( $read_caps as $cap => $grant ) {
			$role->add_cap( $cap, $grant );
		}
	}

	// 2. Role: cms_write (read + write: thêm, sửa, xóa bài viết, upload media)
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

	if ( null === get_role( 'cms_write' ) ) {
		add_role( 'cms_write', __( 'CMS Write', 'cms-domain' ), $write_caps );
	} else {
		$role = get_role( 'cms_write' );
		foreach ( $write_caps as $cap => $grant ) {
			$role->add_cap( $cap, $grant );
		}
	}

	// 3. Role: cms_admin (cài plugin, cài theme + toàn quyền quản trị nội dung)
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
		// Cài plugin:
		'install_plugins'        => true,
		'activate_plugins'       => true,
		'update_plugins'         => true,
		'delete_plugins'         => true,
		'edit_plugins'           => true,
		// Cài theme:
		'install_themes'         => true,
		'switch_themes'          => true,
		'edit_theme_options'     => true,
		'update_themes'          => true,
		'delete_themes'          => true,
		'edit_themes'            => true,
		'customize'              => true,
	);

	if ( null === get_role( 'cms_admin' ) ) {
		add_role( 'cms_admin', __( 'CMS Admin', 'cms-domain' ), $admin_caps );
	} else {
		$role = get_role( 'cms_admin' );
		foreach ( $admin_caps as $cap => $grant ) {
			$role->add_cap( $cap, $grant );
		}
	}
}
add_action( 'init', 'cms_buoi_1_register_custom_roles' );

/**
 * Hiển thị mô tả vai trò rõ ràng trong trang quản trị Users
 */
function cms_buoi_1_customize_roles_display( $roles ) {
	if ( isset( $roles['cms_read'] ) ) {
		$roles['cms_read']['name'] = 'CMS Read (Chỉ đọc nội dung)';
	}
	if ( isset( $roles['cms_write'] ) ) {
		$roles['cms_write']['name'] = 'CMS Write (Đọc & Viết nội dung)';
	}
	if ( isset( $roles['cms_admin'] ) ) {
		$roles['cms_admin']['name'] = 'CMS Admin (Cài plugin & Cài theme)';
	}
	return $roles;
}
add_filter( 'editable_roles', 'cms_buoi_1_customize_roles_display' );
