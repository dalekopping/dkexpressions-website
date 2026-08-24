<?php
/**
 * DK Visual Page Studio.
 *
 * Shows the real saved frontend inside wp-admin and lets authorised editors
 * update visible copy and media without rebuilding the approved PHP layouts.
 *
 * @package DK_Expressions_V4_Fixes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Determine whether a Page is controlled by one of the locked DK templates.
 */
function dkxv4_visual_page_supported( $post_id ) {
	$post_id = absint( $post_id );
	return $post_id && 'page' === get_post_type( $post_id );
}

/**
 * Locked bespoke layouts use the visual studio instead of an empty Gutenberg
 * canvas. Ordinary WordPress pages keep their native block editor.
 */
function dkxv4_page_uses_locked_layout( $post_id ) {
	$page_key = dkxv4_page_content_key( absint( $post_id ) );
	$manifest = dkxv4_page_content_manifest();
	return isset( $manifest[ $page_key ] ) || 'legacy' === $page_key;
}

function dkxv4_locked_page_block_editor( $use_block_editor, $post ) {
	if ( $post instanceof WP_Post && 'page' === $post->post_type && dkxv4_page_uses_locked_layout( $post->ID ) ) {
		return false;
	}
	return $use_block_editor;
}
add_filter( 'use_block_editor_for_post', 'dkxv4_locked_page_block_editor', 20, 2 );

/**
 * Put the visual editor beside the normal Edit link in the Pages list.
 */
function dkxv4_visual_page_row_action( $actions, $post ) {
	if ( $post instanceof WP_Post && 'page' === $post->post_type && current_user_can( 'edit_post', $post->ID ) ) {
		$actions['dkx_visual_edit'] = '<a href="' . esc_url( dkxv4_visual_editor_url( $post->ID ) ) . '">DK Visual Editor</a>';
	}
	return $actions;
}
add_filter( 'page_row_actions', 'dkxv4_visual_page_row_action', 20, 2 );

/**
 * Direct visual-edit shortcut while viewing a Page on the frontend.
 */
function dkxv4_visual_admin_bar_link( $admin_bar ) {
	if ( is_admin() || ! is_singular( 'page' ) ) {
		return;
	}
	$post_id = get_queried_object_id();
	if ( ! $post_id || ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	$admin_bar->add_node(
		array(
			'id'    => 'dkx-visual-editor',
			'title' => 'DK Visual Editor',
			'href'  => dkxv4_visual_editor_url( $post_id ),
		)
	);
}
add_action( 'admin_bar_menu', 'dkxv4_visual_admin_bar_link', 90 );

/**
 * URL for the full-screen editor inside wp-admin.
 */
function dkxv4_visual_editor_url( $post_id ) {
	return add_query_arg(
		array(
			'page' => 'dkx-visual-page-editor',
			'post' => absint( $post_id ),
		),
		admin_url( 'admin.php' )
	);
}

/**
 * Signed URL for the exact frontend canvas shown inside the editor.
 */
function dkxv4_visual_canvas_url( $post_id ) {
	$post_id = absint( $post_id );
	$args = array(
		'dkx_visual_canvas' => $post_id,
		'dkx_visual_nonce'  => wp_create_nonce( 'dkxv4_visual_canvas_' . $post_id ),
		'dkx_refresh'       => time(),
	);
	if ( 'publish' !== get_post_status( $post_id ) ) {
		$preview_url = get_preview_post_link( $post_id, $args );
		if ( $preview_url ) {
			return $preview_url;
		}
	}
	return add_query_arg( $args, get_permalink( $post_id ) );
}

/**
 * Verify a request for the private editing canvas.
 */
function dkxv4_is_visual_canvas_request( $post_id = 0 ) {
	if ( empty( $_GET['dkx_visual_canvas'] ) || empty( $_GET['dkx_visual_nonce'] ) ) {
		return false;
	}
	$request_id = absint( wp_unslash( $_GET['dkx_visual_canvas'] ) );
	$post_id    = absint( $post_id ?: get_queried_object_id() );
	$nonce      = sanitize_text_field( wp_unslash( $_GET['dkx_visual_nonce'] ) );
	return $request_id && $request_id === $post_id && is_user_logged_in() && current_user_can( 'edit_post', $request_id ) && wp_verify_nonce( $nonce, 'dkxv4_visual_canvas_' . $request_id );
}

/**
 * Current page-level visual overrides.
 */
function dkxv4_visual_overrides( $post_id ) {
	$overrides = get_post_meta( absint( $post_id ), '_dkx_visual_overrides', true );
	return is_array( $overrides ) ? array_values( $overrides ) : array();
}

/**
 * Register the hidden wp-admin studio screen.
 */
function dkxv4_register_visual_editor_page() {
	global $dkxv4_visual_editor_hook;
	$dkxv4_visual_editor_hook = add_submenu_page(
		null,
		'DK Visual Page Studio',
		'DK Visual Page Studio',
		'edit_pages',
		'dkx-visual-page-editor',
		'dkxv4_render_visual_editor_page'
	);
}
add_action( 'admin_menu', 'dkxv4_register_visual_editor_page', 40 );

/**
 * Render source-management shortcuts for content that comes from WordPress
 * records rather than from a static Page template.
 */
function dkxv4_visual_source_links( $page_key ) {
	$links = array();
	if ( in_array( $page_key, array( 'home', 'our-work', 'about' ), true ) ) {
		$links[] = array( 'Media Library', admin_url( 'upload.php' ) );
	}
	if ( in_array( $page_key, array( 'insights', 'our-work' ), true ) ) {
		$links[] = array( 'Posts', admin_url( 'edit.php' ) );
		$links[] = array( 'Press Categories', admin_url( 'edit-tags.php?taxonomy=category' ) );
	}
	if ( 'giveaways' === $page_key && post_type_exists( 'dkx_giveaway' ) ) {
		$links[] = array( 'Giveaways', admin_url( 'edit.php?post_type=dkx_giveaway' ) );
	}
	$clients_type = function_exists( 'dkxv4_clients_post_type' ) ? dkxv4_clients_post_type() : '';
	if ( 'home' === $page_key && $clients_type ) {
		$links[] = array( 'Clients & Brands', admin_url( 'edit.php?post_type=' . $clients_type ) );
	}
	return $links;
}

/**
 * Full visual editing screen.
 */
function dkxv4_render_visual_editor_page() {
	$post_id = isset( $_GET['post'] ) ? absint( wp_unslash( $_GET['post'] ) ) : 0;
	if ( ! dkxv4_visual_page_supported( $post_id ) || ! current_user_can( 'edit_post', $post_id ) ) {
		wp_die( esc_html__( 'You are not allowed to edit this DK page.', 'dk-expressions-v4-fixes' ), 403 );
	}
	$post       = get_post( $post_id );
	$page_key   = dkxv4_page_content_key( $post_id );
	$manifest   = dkxv4_page_content_manifest();
	$page_label = $manifest[ $page_key ]['label'] ?? get_the_title( $post_id );
	?>
	<div class="wrap dkx-vps" data-dkx-visual-studio>
		<header class="dkx-vps__header">
			<div>
				<span>DK / VISUAL PAGE STUDIO</span>
				<h1><?php echo esc_html( $page_label ); ?></h1>
				<p>The canvas is the real saved frontend. Click or tap visible text, images and videos to edit them on desktop, tablet or mobile.</p>
			</div>
			<div class="dkx-vps__header-actions">
				<a class="button" href="<?php echo esc_url( get_edit_post_link( $post_id, 'raw' ) ); ?>">Standard page settings</a>
				<a class="button" href="<?php echo esc_url( get_permalink( $post_id ) ); ?>" target="_blank" rel="noopener">Open live page ↗</a>
				<button type="button" class="button button-primary" data-dkx-save>Save frontend changes</button>
			</div>
		</header>

		<div class="dkx-vps__workspace">
			<section class="dkx-vps__preview">
				<nav class="dkx-vps__viewport" aria-label="Preview size">
					<button type="button" class="is-active" data-dkx-viewport="desktop">Desktop</button>
					<button type="button" data-dkx-viewport="tablet">Tablet</button>
					<button type="button" data-dkx-viewport="mobile">Mobile</button>
					<button type="button" data-dkx-refresh>Refresh canvas</button>
				</nav>
				<div class="dkx-vps__frame-shell is-desktop" data-dkx-frame-shell>
					<iframe id="dkx-visual-canvas" src="<?php echo esc_url( dkxv4_visual_canvas_url( $post_id ) ); ?>" title="<?php echo esc_attr( $page_label . ' frontend editing canvas' ); ?>"></iframe>
				</div>
			</section>

			<aside class="dkx-vps__inspector">
				<section class="dkx-vps__status" data-dkx-status data-state="ready">
					<strong>Ready to edit</strong>
					<span>Choose something on the page canvas.</span>
				</section>

				<section class="dkx-vps__selection" data-dkx-selection hidden>
					<div class="dkx-vps__selection-heading">
						<span>SELECTED ELEMENT</span>
						<button type="button" data-dkx-close-selection aria-label="Close element editor">Close</button>
					</div>
					<h2 data-dkx-selection-label>Page element</h2>
					<p data-dkx-selection-help>Edit text directly on the canvas.</p>
					<div class="dkx-vps__text-editor" data-dkx-text-editor hidden>
						<label for="dkx-vps-text-value">Edit selected text</label>
						<textarea id="dkx-vps-text-value" data-dkx-text-value rows="3" autocapitalize="sentences" enterkeyhint="done"></textarea>
						<button type="button" class="button button-primary" data-dkx-apply-text>Apply text to canvas</button>
					</div>
					<div class="dkx-vps__selection-actions">
						<button type="button" class="button button-primary" data-dkx-replace-media hidden>Choose replacement media</button>
						<button type="button" class="button dkx-vps__add-media" data-dkx-add-media>Add image or video here</button>
						<button type="button" class="button dkx-vps__remove-media" data-dkx-remove-insert hidden>Remove added media</button>
						<button type="button" class="button" data-dkx-reset-selection>Restore this element</button>
						<button type="button" class="button button-primary dkx-vps__mobile-save" data-dkx-save>Save page changes</button>
					</div>
				</section>

				<section class="dkx-vps__instructions">
					<h2>How this editor works</h2>
					<ol>
						<li>Click or tap a headline, paragraph, button label or other visible text.</li>
						<li>Edit in the selected-text panel. Desktop also supports typing directly on the canvas.</li>
						<li>Click or tap photography or video to replace it through WordPress Media.</li>
						<li>Check desktop, tablet and mobile, then save.</li>
					</ol>
					<p>The DK colour system, typography, spacing, animation and responsive structure remain locked.</p>
				</section>

				<?php $source_links = dkxv4_visual_source_links( $page_key ); if ( $source_links ) : ?>
				<section class="dkx-vps__sources">
					<h2>Dynamic source records</h2>
					<p>These collections are visible on the canvas and also retain their native WordPress management screens.</p>
					<div><?php foreach ( $source_links as $source_link ) : ?><a href="<?php echo esc_url( $source_link[1] ); ?>"><?php echo esc_html( $source_link[0] ); ?> <span>→</span></a><?php endforeach; ?></div>
				</section>
				<?php endif; ?>
			</aside>
		</div>
	</div>
	<?php
}

/**
 * Load the visual studio and frontend-canvas assets.
 */
function dkxv4_visual_studio_admin_assets( $hook ) {
	global $dkxv4_visual_editor_hook;
	if ( $hook !== $dkxv4_visual_editor_hook ) {
		return;
	}
	$post_id = isset( $_GET['post'] ) ? absint( wp_unslash( $_GET['post'] ) ) : 0;
	if ( ! dkxv4_visual_page_supported( $post_id ) || ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	wp_enqueue_media();
	wp_enqueue_style( 'dkx-visual-page-studio', get_stylesheet_directory_uri() . '/assets/css/dk-visual-page-studio-v126.css', array(), '1.28.0' );
	wp_enqueue_script( 'dkx-visual-page-studio', get_stylesheet_directory_uri() . '/assets/dk-visual-page-studio-v126.js', array( 'jquery' ), '1.28.0', true );
	wp_localize_script(
		'dkx-visual-page-studio',
		'DKXVisualStudio',
		array(
			'ajaxUrl'      => admin_url( 'admin-ajax.php' ),
			'postId'       => $post_id,
			'nonce'        => wp_create_nonce( 'dkxv4_visual_editor_' . $post_id ),
			'canvasUrl'    => dkxv4_visual_canvas_url( $post_id ),
			'overrides'    => dkxv4_visual_overrides( $post_id ),
			'globalLogoId' => absint( get_option( 'dkxv4_visual_logo_id', 0 ) ),
		)
	);
}
add_action( 'admin_enqueue_scripts', 'dkxv4_visual_studio_admin_assets', 20 );

/**
 * Load saved visual overrides on the public page and enable selection only in
 * a signed visual-canvas request.
 */
function dkxv4_visual_canvas_assets() {
	if ( ! is_singular( 'page' ) ) {
		return;
	}
	$post_id = get_queried_object_id();
	if ( ! dkxv4_visual_page_supported( $post_id ) ) {
		return;
	}
	$is_editor = dkxv4_is_visual_canvas_request( $post_id );
	$overrides = dkxv4_visual_overrides( $post_id );
	if ( ! $is_editor && ! $overrides ) {
		return;
	}
	wp_enqueue_style( 'dkx-visual-inserts', get_stylesheet_directory_uri() . '/assets/css/dk-visual-inserts-v128.css', array(), '1.28.0' );
	wp_enqueue_script( 'dkx-visual-canvas', get_stylesheet_directory_uri() . '/assets/dk-visual-canvas-v126.js', array(), '1.28.0', true );
	wp_add_inline_script(
		'dkx-visual-canvas',
		'window.DKXVisualCanvas=' . wp_json_encode(
			array(
				'editor'    => $is_editor,
				'postId'    => $post_id,
				'overrides' => $overrides,
			)
		) . ';',
		'before'
	);
	if ( $is_editor ) {
		wp_enqueue_style( 'dkx-visual-canvas', get_stylesheet_directory_uri() . '/assets/css/dk-visual-canvas-v126.css', array(), '1.28.0' );
		nocache_headers();
	}
}
add_action( 'wp_enqueue_scripts', 'dkxv4_visual_canvas_assets', 1400 );

/**
 * Editor-only body marker.
 */
function dkxv4_visual_canvas_body_class( $classes ) {
	if ( is_singular( 'page' ) && dkxv4_is_visual_canvas_request() ) {
		$classes[] = 'dkx-visual-canvas-active';
	}
	return $classes;
}
add_filter( 'body_class', 'dkxv4_visual_canvas_body_class' );

/**
 * Apply a globally selected WordPress logo while retaining the approved
 * white-logo fallback from the parent theme.
 */
function dkxv4_visual_logo_override( $url ) {
	$logo_id = absint( get_option( 'dkxv4_visual_logo_id', 0 ) );
	$logo    = $logo_id ? wp_get_attachment_image_url( $logo_id, 'full' ) : '';
	return $logo ?: $url;
}
add_filter( 'dkx_logo_url', 'dkxv4_visual_logo_override', 20 );

/**
 * Validate the selector path stored by the visual canvas.
 */
function dkxv4_visual_sanitize_path( $path ) {
	$path = substr( trim( (string) $path ), 0, 1000 );
	return preg_match( '/^[A-Za-z0-9_#.:>+~*()\-\[\]="\'\s]+$/', $path ) ? $path : '';
}

/**
 * Save mapped page-copy fields plus visual-only text/media replacements.
 */
function dkxv4_save_visual_editor() {
	$post_id = isset( $_POST['postId'] ) ? absint( wp_unslash( $_POST['postId'] ) ) : 0;
	check_ajax_referer( 'dkxv4_visual_editor_' . $post_id, 'nonce' );
	if ( ! dkxv4_visual_page_supported( $post_id ) || ! current_user_can( 'edit_post', $post_id ) ) {
		wp_send_json_error( array( 'message' => 'You are not allowed to edit this page.' ), 403 );
	}

	$field_edits = isset( $_POST['fieldEdits'] ) ? json_decode( wp_unslash( $_POST['fieldEdits'] ), true ) : array();
	if ( is_array( $field_edits ) ) {
		foreach ( array_slice( $field_edits, 0, 500 ) as $edit ) {
			$source_id = absint( $edit['postId'] ?? $post_id );
			$key       = sanitize_key( $edit['key'] ?? '' );
			if ( ! $source_id || ! $key || ! current_user_can( 'edit_post', $source_id ) ) {
				continue;
			}
			$allowed = dkxv4_page_content_fields( dkxv4_page_content_key( $source_id ) );
			if ( ! isset( $allowed[ $key ] ) ) {
				continue;
			}
			$value = sanitize_textarea_field( (string) ( $edit['value'] ?? '' ) );
			update_post_meta( $source_id, '_dkx_page_' . $key, $value );
		}
	}

	$raw_overrides = isset( $_POST['overrides'] ) ? json_decode( wp_unslash( $_POST['overrides'] ), true ) : array();
	$overrides     = array();
	if ( is_array( $raw_overrides ) ) {
		foreach ( array_slice( $raw_overrides, 0, 500 ) as $override ) {
		$type = sanitize_key( $override['type'] ?? '' );
		if ( ! in_array( $type, array( 'text', 'media', 'insert' ), true ) ) {
			continue;
		}
		if ( 'insert' === $type ) {
			$id          = sanitize_key( $override['id'] ?? '' );
			$anchor_path = dkxv4_visual_sanitize_path( $override['anchorPath'] ?? '' );
			$url         = esc_url_raw( (string) ( $override['url'] ?? '' ) );
			$mime        = sanitize_mime_type( (string) ( $override['mime'] ?? '' ) );
			if ( ! $id || ! $anchor_path || ! $url || ( 0 !== strpos( $mime, 'image/' ) && 0 !== strpos( $mime, 'video/' ) ) ) {
				continue;
			}
			$overrides[] = array(
				'type'         => 'insert',
				'id'           => substr( $id, 0, 80 ),
				'anchorPath'   => $anchor_path,
				'position'     => 'after',
				'attachmentId' => absint( $override['attachmentId'] ?? 0 ),
				'url'          => $url,
				'mime'         => $mime,
				'alt'          => sanitize_text_field( (string) ( $override['alt'] ?? '' ) ),
			);
			continue;
		}
		$path = dkxv4_visual_sanitize_path( $override['path'] ?? '' );
		if ( ! $path ) {
			continue;
		}
		$clean = array( 'type' => $type, 'path' => $path );
			if ( 'text' === $type ) {
				$clean['originalValue'] = sanitize_textarea_field( (string) ( $override['originalValue'] ?? '' ) );
				$clean['value'] = wp_kses_post( (string) ( $override['value'] ?? '' ) );
			} else {
				$clean['attachmentId'] = absint( $override['attachmentId'] ?? 0 );
				$clean['originalUrl']  = esc_url_raw( (string) ( $override['originalUrl'] ?? '' ) );
				$clean['url']          = esc_url_raw( (string) ( $override['url'] ?? '' ) );
				$clean['mime']         = sanitize_mime_type( (string) ( $override['mime'] ?? '' ) );
				$clean['alt']          = sanitize_text_field( (string) ( $override['alt'] ?? '' ) );
				if ( ! $clean['url'] ) {
					continue;
				}
			}
			$overrides[] = $clean;
		}
	}
	if ( $overrides ) {
		update_post_meta( $post_id, '_dkx_visual_overrides', $overrides );
	} else {
		delete_post_meta( $post_id, '_dkx_visual_overrides' );
	}

	if ( isset( $_POST['globalLogoId'] ) ) {
		$logo_id = absint( wp_unslash( $_POST['globalLogoId'] ) );
		if ( ! $logo_id || wp_attachment_is_image( $logo_id ) ) {
			update_option( 'dkxv4_visual_logo_id', $logo_id, false );
		}
	}

	wp_send_json_success(
		array(
			'message'   => 'Frontend changes saved.',
			'canvasUrl' => dkxv4_visual_canvas_url( $post_id ),
		)
	);
}
add_action( 'wp_ajax_dkxv4_save_visual_editor', 'dkxv4_save_visual_editor' );
