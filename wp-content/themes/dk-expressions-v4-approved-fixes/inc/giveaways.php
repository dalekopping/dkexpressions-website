<?php
/**
 * Native DK Expressions giveaways and competitions manager.
 *
 * @package DK_Expressions_V4_Fixes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function dkxv4_register_giveaways() {
	register_post_type(
		'dkx_giveaway',
		array(
			'labels' => array(
				'name'          => 'DKX Giveaways',
				'singular_name' => 'Giveaway',
				'add_new_item'  => 'Add New Giveaway',
				'edit_item'     => 'Edit Giveaway',
				'new_item'      => 'New Giveaway',
				'view_item'     => 'View Giveaway',
				'search_items'  => 'Search Giveaways',
			),
			'public'       => true,
			'show_ui'      => true,
			'show_in_rest' => true,
			'menu_icon'    => 'dashicons-tickets-alt',
			'menu_position'=> 24,
			'has_archive'  => false,
			'rewrite'      => array( 'slug' => 'giveaway', 'with_front' => false ),
			'supports'     => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'page-attributes' ),
		)
	);
	register_post_type(
		'dkx_entry',
		array(
			'labels'       => array( 'name' => 'Competition Entries', 'singular_name' => 'Competition Entry' ),
			'public'       => false,
			'show_ui'      => true,
			'show_in_menu' => 'edit.php?post_type=dkx_giveaway',
			'supports'     => array( 'title' ),
			'capabilities' => array( 'create_posts' => 'do_not_allow' ),
			'map_meta_cap' => true,
		)
	);
}
add_action( 'init', 'dkxv4_register_giveaways', 5 );

function dkxv4_giveaway_meta_boxes() {
	add_meta_box( 'dkx-giveaway-details', 'Giveaway Details', 'dkxv4_giveaway_details_box', 'dkx_giveaway', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'dkxv4_giveaway_meta_boxes' );

function dkxv4_giveaway_setup_menu() {
	add_submenu_page(
		'edit.php?post_type=dkx_giveaway',
		'Competition Setup',
		'Competition Setup',
		'edit_posts',
		'dkx-competition-setup',
		'dkxv4_giveaway_setup_page'
	);
}
add_action( 'admin_menu', 'dkxv4_giveaway_setup_menu' );

function dkxv4_giveaway_setup_page() {
	$post_id = isset( $_GET['giveaway_id'] ) ? absint( $_GET['giveaway_id'] ) : 0;
	echo '<div class="wrap"><h1>DK Expressions Competition Setup</h1><p>Manage the dates, prize allocation and branded entry mechanics for each giveaway.</p>';
	if ( isset( $_GET['updated'] ) ) {
		echo '<div class="notice notice-success is-dismissible"><p>Competition setup saved successfully.</p></div>';
	}
	if ( ! $post_id ) {
		$competitions = get_posts( array( 'post_type' => 'dkx_giveaway', 'post_status' => array( 'publish', 'draft', 'pending', 'future' ), 'numberposts' => -1, 'orderby' => 'date', 'order' => 'DESC' ) );
		if ( ! $competitions ) { echo '<p>No competitions have been created yet.</p></div>'; return; }
		echo '<table class="widefat striped"><thead><tr><th>Competition</th><th>Status</th><th>Setup</th></tr></thead><tbody>';
		foreach ( $competitions as $competition ) {
			$url = add_query_arg( array( 'post_type' => 'dkx_giveaway', 'page' => 'dkx-competition-setup', 'giveaway_id' => $competition->ID ), admin_url( 'edit.php' ) );
			echo '<tr><td><strong>' . esc_html( $competition->post_title ) . '</strong></td><td>' . esc_html( ucfirst( $competition->post_status ) ) . '</td><td><a class="button button-primary" href="' . esc_url( $url ) . '">Edit dates & mechanics</a></td></tr>';
		}
		echo '</tbody></table></div>'; return;
	}
	$post = get_post( $post_id );
	if ( ! $post || 'dkx_giveaway' !== $post->post_type || ! current_user_can( 'edit_post', $post_id ) ) { wp_die( 'You cannot edit this competition.' ); }
	echo '<p><a href="' . esc_url( get_edit_post_link( $post_id ) ) . '">← Edit competition title, description and image</a></p><h2>' . esc_html( $post->post_title ) . '</h2>';
	echo '<form method="post" action="' . esc_url( admin_url( 'admin-post.php' ) ) . '"><input type="hidden" name="action" value="dkx_save_competition_setup"><input type="hidden" name="post_id" value="' . esc_attr( $post_id ) . '">';
	dkxv4_giveaway_details_box( $post );
	submit_button( 'Save competition setup' );
	echo '</form></div>';
}

function dkxv4_save_competition_setup() {
	$post_id = absint( $_POST['post_id'] ?? 0 );
	if ( ! $post_id || ! current_user_can( 'edit_post', $post_id ) || ! isset( $_POST['dkxv4_giveaway_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['dkxv4_giveaway_nonce'] ) ), 'dkxv4_save_giveaway' ) ) { wp_die( 'The competition setup request could not be verified.' ); }
	dkxv4_save_giveaway( $post_id );
	$url = add_query_arg( array( 'post_type' => 'dkx_giveaway', 'page' => 'dkx-competition-setup', 'giveaway_id' => $post_id, 'updated' => 1 ), admin_url( 'edit.php' ) );
	wp_safe_redirect( $url ); exit;
}
add_action( 'admin_post_dkx_save_competition_setup', 'dkxv4_save_competition_setup' );

function dkxv4_giveaway_row_actions( $actions, $post ) {
	if ( 'dkx_giveaway' === $post->post_type ) {
		$url = add_query_arg( array( 'post_type' => 'dkx_giveaway', 'page' => 'dkx-competition-setup', 'giveaway_id' => $post->ID ), admin_url( 'edit.php' ) );
		$actions['dkx_setup'] = '<a href="' . esc_url( $url ) . '"><strong>Competition Setup</strong></a>';
	}
	return $actions;
}
add_filter( 'post_row_actions', 'dkxv4_giveaway_row_actions', 10, 2 );

function dkxv4_giveaway_editor_setup_notice() {
	$screen = get_current_screen();
	if ( ! $screen || 'dkx_giveaway' !== $screen->post_type || 'post' !== $screen->base ) { return; }
	$post_id = isset( $_GET['post'] ) ? absint( $_GET['post'] ) : 0;
	if ( ! $post_id ) { return; }
	$url = add_query_arg( array( 'post_type' => 'dkx_giveaway', 'page' => 'dkx-competition-setup', 'giveaway_id' => $post_id ), admin_url( 'edit.php' ) );
	echo '<div class="notice notice-info"><p><strong>Competition dates, prize quantities and entry mechanics are managed separately.</strong> <a class="button button-primary" href="' . esc_url( $url ) . '">Open Competition Setup</a></p></div>';
}
add_action( 'admin_notices', 'dkxv4_giveaway_editor_setup_notice' );

function dkxv4_giveaway_details_box( $post ) {
	wp_nonce_field( 'dkxv4_save_giveaway', 'dkxv4_giveaway_nonce' );
	$fields = array(
		'_dkx_prize'          => array( 'Prize', 'text', 'Example: 6 Comic Con Africa 2026 tickets' ),
		'_dkx_quantity'       => array( 'Number of items to give away', 'number', 'The total number of tickets, products or prizes available.' ),
		'_dkx_sponsor'        => array( 'Sponsor / partner', 'text', '' ),
		'_dkx_start'          => array( 'Start date and time', 'datetime-local', 'The competition opens automatically at this time.' ),
		'_dkx_end'            => array( 'End date and time', 'datetime-local', 'The competition closes automatically at this time.' ),
		'_dkx_winners'        => array( 'Number of winners', 'number', '' ),
		'_dkx_eligibility'    => array( 'Eligibility', 'text', 'Example: South African residents aged 18+' ),
		'_dkx_entry_url'      => array( 'External entry URL (optional)', 'url', '' ),
		'_dkx_entry_label'    => array( 'Entry button label', 'text', 'Enter now' ),
		'_dkx_form_shortcode' => array( 'WPForms shortcode (optional)', 'text', 'Example: [wpforms id="123"]' ),
		'_dkx_email_subject'   => array( 'Confirmation email subject', 'text', 'Default: Your entry has been received — {competition}' ),
		'_dkx_email_message'   => array( 'Confirmation email introduction', 'textarea', 'Optional introductory message. The competition details and entry reference are added automatically.' ),
		'_dkx_winner_notice'  => array( 'Winner announcement', 'textarea', 'Add winner names or announcement details after the competition closes.' ),
	);
	echo '<style>.dkx-giveaway-fields{display:grid;grid-template-columns:1fr 1fr;gap:16px}.dkx-giveaway-field{display:flex;flex-direction:column;gap:6px}.dkx-giveaway-field.wide{grid-column:1/-1}.dkx-giveaway-field input,.dkx-giveaway-field textarea{width:100%}.dkx-giveaway-field textarea{min-height:90px}.dkx-giveaway-note{color:#646970;font-size:12px}@media(max-width:782px){.dkx-giveaway-fields{grid-template-columns:1fr}.dkx-giveaway-field.wide{grid-column:auto}}</style>';
	echo '<div class="dkx-giveaway-fields">';
	foreach ( $fields as $key => $field ) {
		$value = get_post_meta( $post->ID, $key, true );
		if ( '_dkx_entry_label' === $key && ! $value ) {
			$value = 'Enter now';
		}
		$wide = in_array( $field[1], array( 'textarea' ), true ) || '_dkx_form_shortcode' === $key;
		echo '<div class="dkx-giveaway-field' . ( $wide ? ' wide' : '' ) . '"><label for="' . esc_attr( $key ) . '"><strong>' . esc_html( $field[0] ) . '</strong></label>';
		if ( 'textarea' === $field[1] ) {
			echo '<textarea id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '">' . esc_textarea( $value ) . '</textarea>';
		} else {
			echo '<input id="' . esc_attr( $key ) . '" type="' . esc_attr( $field[1] ) . '" name="' . esc_attr( $key ) . '" value="' . esc_attr( $value ) . '">';
		}
		if ( $field[2] ) {
			echo '<span class="dkx-giveaway-note">' . esc_html( $field[2] ) . '</span>';
		}
		echo '</div>';
	}
	$featured = (bool) get_post_meta( $post->ID, '_dkx_featured', true );
	echo '<div class="dkx-giveaway-field wide"><label><input type="checkbox" name="_dkx_featured" value="1" ' . checked( $featured, true, false ) . '> <strong>Feature this competition</strong></label><span class="dkx-giveaway-note">Featured open competitions appear first and receive a larger card.</span></div>';
	echo '</div>';
	dkxv4_giveaway_mechanics_box( $post );
}

function dkxv4_mechanics_catalogue() {
	return array(
		'facebook'   => array( 'Visit / follow DK Expressions on Facebook', 'url' ),
		'instagram'  => array( 'Visit / follow DK Expressions on Instagram', 'url' ),
		'tiktok'     => array( 'Visit / follow DK Expressions on TikTok', 'url' ),
		'x'          => array( 'Visit / follow DK Expressions on X', 'url' ),
		'youtube'    => array( 'Visit / subscribe on YouTube', 'url' ),
		'share'      => array( 'Share this competition', 'share' ),
		'newsletter' => array( 'Join the DK Expressions newsletter', 'check' ),
		'question'   => array( 'Answer the competition question', 'question' ),
	);
}

function dkxv4_giveaway_mechanics_box( $post ) {
	$enabled = (array) get_post_meta( $post->ID, '_dkx_mechanics', true );
	$urls    = (array) get_post_meta( $post->ID, '_dkx_mechanic_urls', true );
	$points  = (array) get_post_meta( $post->ID, '_dkx_mechanic_points', true );
	$question = get_post_meta( $post->ID, '_dkx_competition_question', true );
	echo '<hr style="margin:26px 0"><h2 style="margin:0 0 6px">DK Entry Mechanics</h2><p class="dkx-giveaway-note">Choose the actions entrants must complete. Each selected action becomes part of the branded entry portal. Points create extra entries in the draw.</p>';
	echo '<table class="widefat striped" style="margin-top:14px"><thead><tr><th>Use</th><th>Entry action</th><th>Destination URL</th><th>Entries</th></tr></thead><tbody>';
	foreach ( dkxv4_mechanics_catalogue() as $key => $mechanic ) {
		echo '<tr><td><input type="checkbox" name="_dkx_mechanics[]" value="' . esc_attr( $key ) . '" ' . checked( in_array( $key, $enabled, true ), true, false ) . '></td><td><strong>' . esc_html( $mechanic[0] ) . '</strong></td><td>';
		if ( 'url' === $mechanic[1] ) {
			echo '<input type="url" name="_dkx_mechanic_urls[' . esc_attr( $key ) . ']" value="' . esc_attr( $urls[ $key ] ?? '' ) . '" placeholder="https://" style="width:100%">';
		} elseif ( 'question' === $mechanic[1] ) {
			echo '<input type="text" name="_dkx_competition_question" value="' . esc_attr( $question ) . '" placeholder="Type your competition question" style="width:100%">';
		} else {
			echo '<span class="dkx-giveaway-note">Built in</span>';
		}
		echo '</td><td><input type="number" min="1" max="100" name="_dkx_mechanic_points[' . esc_attr( $key ) . ']" value="' . esc_attr( $points[ $key ] ?? 1 ) . '" style="width:70px"></td></tr>';
	}
	echo '</tbody></table><p class="dkx-giveaway-note">The native entry form always requests the entrant’s name, email address and consent. Entries are stored privately under <strong>DKX Giveaways → Competition Entries</strong>.</p>';
}

function dkxv4_save_giveaway( $post_id ) {
	if ( ! isset( $_POST['dkxv4_giveaway_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['dkxv4_giveaway_nonce'] ) ), 'dkxv4_save_giveaway' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	$text_fields = array( '_dkx_prize', '_dkx_quantity', '_dkx_sponsor', '_dkx_start', '_dkx_end', '_dkx_winners', '_dkx_eligibility', '_dkx_entry_label', '_dkx_form_shortcode', '_dkx_competition_question', '_dkx_email_subject' );
	foreach ( $text_fields as $key ) {
		if ( isset( $_POST[ $key ] ) ) {
			update_post_meta( $post_id, $key, sanitize_text_field( wp_unslash( $_POST[ $key ] ) ) );
		}
	}
	if ( isset( $_POST['_dkx_entry_url'] ) ) {
		update_post_meta( $post_id, '_dkx_entry_url', esc_url_raw( wp_unslash( $_POST['_dkx_entry_url'] ) ) );
	}
	if ( isset( $_POST['_dkx_winner_notice'] ) ) {
		update_post_meta( $post_id, '_dkx_winner_notice', sanitize_textarea_field( wp_unslash( $_POST['_dkx_winner_notice'] ) ) );
	}
	if ( isset( $_POST['_dkx_email_message'] ) ) {
		update_post_meta( $post_id, '_dkx_email_message', sanitize_textarea_field( wp_unslash( $_POST['_dkx_email_message'] ) ) );
	}
	update_post_meta( $post_id, '_dkx_featured', isset( $_POST['_dkx_featured'] ) ? '1' : '0' );
	$catalogue = dkxv4_mechanics_catalogue();
	$mechanics = isset( $_POST['_dkx_mechanics'] ) ? array_values( array_intersect( array_keys( $catalogue ), array_map( 'sanitize_key', (array) wp_unslash( $_POST['_dkx_mechanics'] ) ) ) ) : array();
	$raw_urls  = isset( $_POST['_dkx_mechanic_urls'] ) ? (array) wp_unslash( $_POST['_dkx_mechanic_urls'] ) : array();
	$raw_points= isset( $_POST['_dkx_mechanic_points'] ) ? (array) wp_unslash( $_POST['_dkx_mechanic_points'] ) : array();
	$urls = $points = array();
	foreach ( $catalogue as $key => $unused ) {
		if ( isset( $raw_urls[ $key ] ) ) { $urls[ $key ] = esc_url_raw( $raw_urls[ $key ] ); }
		$points[ $key ] = max( 1, min( 100, absint( $raw_points[ $key ] ?? 1 ) ) );
	}
	update_post_meta( $post_id, '_dkx_mechanics', $mechanics );
	update_post_meta( $post_id, '_dkx_mechanic_urls', $urls );
	update_post_meta( $post_id, '_dkx_mechanic_points', $points );
}
add_action( 'save_post_dkx_giveaway', 'dkxv4_save_giveaway' );

function dkxv4_giveaway_timestamp( $value ) {
	if ( ! $value ) {
		return 0;
	}
	$date = date_create_immutable( $value, wp_timezone() );
	return $date ? $date->getTimestamp() : 0;
}

function dkxv4_giveaway_status( $post_id ) {
	$now   = current_datetime()->getTimestamp();
	$start = dkxv4_giveaway_timestamp( get_post_meta( $post_id, '_dkx_start', true ) );
	$end   = dkxv4_giveaway_timestamp( get_post_meta( $post_id, '_dkx_end', true ) );
	if ( $end && $now > $end ) {
		return 'closed';
	}
	if ( $start && $now < $start ) {
		return 'upcoming';
	}
	return 'open';
}

function dkxv4_giveaway_card( $post_id, $featured = false ) {
	$status      = dkxv4_giveaway_status( $post_id );
	$prize       = get_post_meta( $post_id, '_dkx_prize', true );
	$end         = dkxv4_giveaway_timestamp( get_post_meta( $post_id, '_dkx_end', true ) );
	$status_text = array( 'open' => 'Open now', 'upcoming' => 'Coming soon', 'closed' => 'Closed' );
	?>
	<article class="dk-giveaway-card status-<?php echo esc_attr( $status ); ?><?php echo $featured ? ' is-featured' : ''; ?>">
		<a href="<?php echo esc_url( get_permalink( $post_id ) ); ?>">
			<div class="dk-giveaway-image"><?php echo get_the_post_thumbnail( $post_id, 'dkx-feature' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span class="dk-giveaway-status"><?php echo esc_html( $status_text[ $status ] ); ?></span></div>
			<div class="dk-giveaway-card-content">
				<?php if ( $prize ) : ?><p class="dk-giveaway-prize"><?php echo esc_html( $prize ); ?></p><?php endif; ?>
				<h3><?php echo esc_html( get_the_title( $post_id ) ); ?></h3>
				<?php if ( 'open' === $status && $end ) : ?><div class="dk-countdown" data-countdown="<?php echo esc_attr( wp_date( 'c', $end, wp_timezone() ) ); ?>"><span>Calculating time remaining…</span></div><?php endif; ?>
				<span class="dk-giveaway-link"><?php echo 'closed' === $status ? 'View competition' : 'View & enter'; ?> →</span>
			</div>
		</a>
	</article>
	<?php
}

function dkxv4_create_giveaway_page_and_draft() {
	if ( '1.10.0' === get_option( 'dkxv4_giveaways_version' ) ) {
		return;
	}
	if ( ! get_page_by_path( 'giveaways' ) ) {
		wp_insert_post(
			array(
				'post_title'  => 'Giveaways',
				'post_name'   => 'giveaways',
				'post_status' => 'publish',
				'post_type'   => 'page',
			)
		);
	}
	$existing = get_page_by_path( 'comic-con-africa-2026-ticket-giveaway', OBJECT, 'dkx_giveaway' );
	if ( ! $existing ) {
		$draft_id = wp_insert_post(
			array(
				'post_title'   => 'Comic Con Africa 2026 Ticket Giveaway',
				'post_name'    => 'comic-con-africa-2026-ticket-giveaway',
				'post_status'  => 'draft',
				'post_type'    => 'dkx_giveaway',
				'post_excerpt' => 'Win tickets to experience Comic Con Africa 2026 with DK Expressions.',
				'post_content' => "Add the full competition description, entry steps and official rules here before publishing.\n\nPlease confirm the event date, competition closing date, winner allocation and eligibility requirements.",
			)
		);
		if ( $draft_id && ! is_wp_error( $draft_id ) ) {
			update_post_meta( $draft_id, '_dkx_prize', '6 Comic Con Africa 2026 tickets' );
			update_post_meta( $draft_id, '_dkx_quantity', '6' );
			update_post_meta( $draft_id, '_dkx_mechanics', array( 'facebook', 'instagram', 'share', 'newsletter', 'question' ) );
			update_post_meta( $draft_id, '_dkx_mechanic_points', array( 'facebook' => 1, 'instagram' => 1, 'share' => 2, 'newsletter' => 1, 'question' => 1 ) );
			update_post_meta( $draft_id, '_dkx_competition_question', 'What are you most excited to experience at Comic Con Africa 2026?' );
			update_post_meta( $draft_id, '_dkx_entry_label', 'Enter now' );
			update_post_meta( $draft_id, '_dkx_email_subject', 'Your entry has been received — {competition}' );
			update_post_meta( $draft_id, '_dkx_featured', '1' );
		}
	}
	if ( $existing ) {
		if ( ! get_post_meta( $existing->ID, '_dkx_quantity', true ) ) { update_post_meta( $existing->ID, '_dkx_quantity', '6' ); }
		if ( ! get_post_meta( $existing->ID, '_dkx_mechanics', true ) ) {
			update_post_meta( $existing->ID, '_dkx_mechanics', array( 'facebook', 'instagram', 'share', 'newsletter', 'question' ) );
			update_post_meta( $existing->ID, '_dkx_mechanic_points', array( 'facebook' => 1, 'instagram' => 1, 'share' => 2, 'newsletter' => 1, 'question' => 1 ) );
			update_post_meta( $existing->ID, '_dkx_competition_question', 'What are you most excited to experience at Comic Con Africa 2026?' );
		}
	}
	update_option( 'dkxv4_giveaways_version', '1.10.0' );
	flush_rewrite_rules( false );
}
add_action( 'admin_init', 'dkxv4_create_giveaway_page_and_draft', 30 );

function dkxv4_giveaway_columns( $columns ) {
	return array(
		'cb'       => $columns['cb'],
		'title'    => 'Competition',
		'prize'    => 'Prize',
		'status'   => 'Status',
		'closing'  => 'Closing date',
		'date'     => $columns['date'],
	);
}
add_filter( 'manage_dkx_giveaway_posts_columns', 'dkxv4_giveaway_columns' );

function dkxv4_giveaway_column_content( $column, $post_id ) {
	if ( 'prize' === $column ) {
		echo esc_html( get_post_meta( $post_id, '_dkx_prize', true ) );
	} elseif ( 'status' === $column ) {
		echo esc_html( ucfirst( dkxv4_giveaway_status( $post_id ) ) );
	} elseif ( 'closing' === $column ) {
		$end = dkxv4_giveaway_timestamp( get_post_meta( $post_id, '_dkx_end', true ) );
		echo $end ? esc_html( wp_date( 'j F Y, H:i', $end, wp_timezone() ) ) : '—';
	}
}
add_action( 'manage_dkx_giveaway_posts_custom_column', 'dkxv4_giveaway_column_content', 10, 2 );

function dkxv4_render_native_entry_form( $post_id ) {
	$mechanics = (array) get_post_meta( $post_id, '_dkx_mechanics', true );
	if ( ! $mechanics ) { return; }
	$catalogue = dkxv4_mechanics_catalogue();
	$urls      = (array) get_post_meta( $post_id, '_dkx_mechanic_urls', true );
	$points    = (array) get_post_meta( $post_id, '_dkx_mechanic_points', true );
	$question  = get_post_meta( $post_id, '_dkx_competition_question', true );
	$notice    = isset( $_GET['entry'] ) ? sanitize_key( wp_unslash( $_GET['entry'] ) ) : '';
	if ( 'success' === $notice ) { echo '<div class="dk-entry-notice success"><strong>Entry received.</strong> Good luck, Time Traveller.</div>'; return; }
	if ( 'duplicate' === $notice ) { echo '<div class="dk-entry-notice"><strong>You have already entered this competition with that email address.</strong></div>'; }
	if ( 'error' === $notice ) { echo '<div class="dk-entry-notice"><strong>Please complete all required entry details.</strong></div>'; }
	?>
	<form class="dk-native-entry" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
		<input type="hidden" name="action" value="dkx_submit_entry"><input type="hidden" name="giveaway_id" value="<?php echo esc_attr( $post_id ); ?>"><?php wp_nonce_field( 'dkx_entry_' . $post_id, 'dkx_entry_nonce' ); ?>
		<p class="dk-entry-honey" aria-hidden="true"><label>Leave this empty <input type="text" name="website" tabindex="-1" autocomplete="off"></label></p>
		<div class="dk-entry-person"><label>Your name *<input type="text" name="entrant_name" required autocomplete="name"></label><label>Email address *<input type="email" name="entrant_email" required autocomplete="email"></label><label>Contact number *<input type="tel" name="entrant_phone" required autocomplete="tel" inputmode="tel"></label><label>City *<input type="text" name="entrant_city" required autocomplete="address-level2"></label></div>
		<h3>Complete your entry actions</h3><div class="dk-entry-actions">
		<?php foreach ( $mechanics as $key ) : if ( ! isset( $catalogue[ $key ] ) ) { continue; } $label = $catalogue[ $key ][0]; ?>
			<div class="dk-entry-action"><label><input type="checkbox" name="completed_actions[]" value="<?php echo esc_attr( $key ); ?>" required><span><strong><?php echo esc_html( $label ); ?></strong><small>+<?php echo esc_html( $points[ $key ] ?? 1 ); ?> <?php echo 1 === (int) ( $points[ $key ] ?? 1 ) ? 'entry' : 'entries'; ?></small></span></label>
			<?php if ( ! empty( $urls[ $key ] ) ) : ?><a href="<?php echo esc_url( $urls[ $key ] ); ?>" target="_blank" rel="noopener noreferrer">Open action ↗</a><?php elseif ( 'share' === $key ) : ?><button type="button" class="dk-share-competition" data-share-url="<?php echo esc_url( get_permalink( $post_id ) ); ?>">Share ↗</button><?php endif; ?>
			<?php if ( 'question' === $key && $question ) : ?><label class="dk-entry-answer"><?php echo esc_html( $question ); ?> *<textarea name="competition_answer" required></textarea></label><?php endif; ?>
			</div>
		<?php endforeach; ?>
		</div>
		<label class="dk-entry-consent"><input type="checkbox" name="entry_consent" value="1" required> I confirm that my information is accurate and I agree to the competition rules and DK Expressions Privacy Policy. *</label>
		<button class="dk-button" type="submit">Submit my entry ↗</button><p class="dk-entry-privacy">Your information is used to administer this competition and contact verified winners. It is not displayed publicly.</p>
	</form>
	<?php
}

function dkxv4_submit_entry() {
	$post_id = absint( $_POST['giveaway_id'] ?? 0 );
	$return  = $post_id ? get_permalink( $post_id ) : home_url( '/giveaways/' );
	if ( ! $post_id || 'dkx_giveaway' !== get_post_type( $post_id ) || 'open' !== dkxv4_giveaway_status( $post_id ) || ! isset( $_POST['dkx_entry_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['dkx_entry_nonce'] ) ), 'dkx_entry_' . $post_id ) || ! empty( $_POST['website'] ) ) {
		wp_safe_redirect( add_query_arg( 'entry', 'error', $return ) ); exit;
	}
	$name    = sanitize_text_field( wp_unslash( $_POST['entrant_name'] ?? '' ) );
	$email   = sanitize_email( wp_unslash( $_POST['entrant_email'] ?? '' ) );
	$phone   = sanitize_text_field( wp_unslash( $_POST['entrant_phone'] ?? '' ) );
	$city    = sanitize_text_field( wp_unslash( $_POST['entrant_city'] ?? '' ) );
	$allowed = (array) get_post_meta( $post_id, '_dkx_mechanics', true );
	$done    = array_values( array_intersect( $allowed, array_map( 'sanitize_key', (array) wp_unslash( $_POST['completed_actions'] ?? array() ) ) ) );
	if ( ! $name || ! is_email( $email ) || ! $phone || ! $city || ! isset( $_POST['entry_consent'] ) || count( $done ) !== count( $allowed ) ) {
		wp_safe_redirect( add_query_arg( 'entry', 'error', $return ) ); exit;
	}
	$duplicate = get_posts( array( 'post_type' => 'dkx_entry', 'post_status' => 'private', 'numberposts' => 1, 'fields' => 'ids', 'meta_query' => array( array( 'key' => '_dkx_giveaway_id', 'value' => $post_id ), array( 'key' => '_dkx_entry_email_hash', 'value' => hash( 'sha256', strtolower( $email ) ) ) ) ) );
	if ( $duplicate ) { wp_safe_redirect( add_query_arg( 'entry', 'duplicate', $return ) ); exit; }
	$points_map = (array) get_post_meta( $post_id, '_dkx_mechanic_points', true );
	$total = 0; foreach ( $done as $key ) { $total += max( 1, absint( $points_map[ $key ] ?? 1 ) ); }
	$entry_id = wp_insert_post( array( 'post_type' => 'dkx_entry', 'post_status' => 'private', 'post_title' => $name . ' — ' . get_the_title( $post_id ) ) );
	if ( $entry_id && ! is_wp_error( $entry_id ) ) {
		$reference = 'DKX-' . $post_id . '-' . $entry_id;
		update_post_meta( $entry_id, '_dkx_giveaway_id', $post_id ); update_post_meta( $entry_id, '_dkx_entry_name', $name ); update_post_meta( $entry_id, '_dkx_entry_email', $email ); update_post_meta( $entry_id, '_dkx_entry_phone', $phone ); update_post_meta( $entry_id, '_dkx_entry_city', $city ); update_post_meta( $entry_id, '_dkx_entry_email_hash', hash( 'sha256', strtolower( $email ) ) ); update_post_meta( $entry_id, '_dkx_entry_actions', $done ); update_post_meta( $entry_id, '_dkx_entry_points', $total ); update_post_meta( $entry_id, '_dkx_entry_answer', sanitize_textarea_field( wp_unslash( $_POST['competition_answer'] ?? '' ) ) ); update_post_meta( $entry_id, '_dkx_entry_reference', $reference );
		dkxv4_send_entry_confirmation( $entry_id );
		wp_safe_redirect( add_query_arg( 'entry', 'success', $return ) ); exit;
	}
	wp_safe_redirect( add_query_arg( 'entry', 'error', $return ) ); exit;
}
add_action( 'admin_post_nopriv_dkx_submit_entry', 'dkxv4_submit_entry' );
add_action( 'admin_post_dkx_submit_entry', 'dkxv4_submit_entry' );

function dkxv4_send_entry_confirmation( $entry_id ) {
	$giveaway_id = (int) get_post_meta( $entry_id, '_dkx_giveaway_id', true );
	$email       = sanitize_email( get_post_meta( $entry_id, '_dkx_entry_email', true ) );
	$name        = get_post_meta( $entry_id, '_dkx_entry_name', true );
	$points      = (int) get_post_meta( $entry_id, '_dkx_entry_points', true );
	$reference   = get_post_meta( $entry_id, '_dkx_entry_reference', true );
	$competition = get_the_title( $giveaway_id );
	if ( ! $giveaway_id || ! is_email( $email ) || ! $competition ) { return false; }
	$subject_template = get_post_meta( $giveaway_id, '_dkx_email_subject', true ) ?: 'Your entry has been received — {competition}';
	$subject = str_replace( '{competition}', $competition, $subject_template );
	$intro   = get_post_meta( $giveaway_id, '_dkx_email_message', true ) ?: 'Your entry has successfully travelled through the DK Expressions portal.';
	$end     = dkxv4_giveaway_timestamp( get_post_meta( $giveaway_id, '_dkx_end', true ) );
	$logo    = function_exists( 'dkx_logo_url' ) ? dkx_logo_url() : '';
	$details = '<p style="margin:0 0 8px"><strong>Competition:</strong> ' . esc_html( $competition ) . '</p><p style="margin:0 0 8px"><strong>Entry reference:</strong> ' . esc_html( $reference ) . '</p><p style="margin:0 0 8px"><strong>Entries earned:</strong> ' . esc_html( $points ) . '</p>';
	if ( $end ) { $details .= '<p style="margin:0"><strong>Competition closes:</strong> ' . esc_html( wp_date( 'j F Y, H:i', $end, wp_timezone() ) ) . '</p>'; }
	$message = '<!doctype html><html><body style="margin:0;background:#02060b;color:#dceaf5;font-family:Arial,sans-serif"><div style="max-width:640px;margin:auto;padding:38px 24px"><div style="padding:34px;border:1px solid #168fe0;background:#061522">';
	if ( $logo ) { $message .= '<p style="margin:0 0 28px"><img src="' . esc_url( $logo ) . '" alt="DK Expressions" style="max-width:150px;height:auto"></p>'; }
	$message .= '<p style="margin:0 0 10px;color:#39b2ff;font-size:12px;font-weight:bold;letter-spacing:2px;text-transform:uppercase">Entry confirmed</p><h1 style="margin:0 0 22px;color:#fff;font-size:30px;line-height:1.1">You’re in, ' . esc_html( $name ) . '.</h1><p style="margin:0 0 25px;color:#b9c8d5;line-height:1.7">' . nl2br( esc_html( $intro ) ) . '</p><div style="padding:22px;background:#0a2a42;border-left:3px solid #39b2ff">' . $details . '</div><p style="margin:26px 0 0;color:#90a2b2;font-size:12px;line-height:1.6">Please retain this email for your records. Entry confirmation does not guarantee a prize. Winners remain subject to eligibility checks and the published competition terms.</p><p style="margin:28px 0 0;color:#39b2ff;font-weight:bold">Freezing Time and Space with the Time Travellers™</p></div></div></body></html>';
	add_filter( 'wp_mail_from_name', 'dkxv4_confirmation_mail_from_name' );
	$sent = wp_mail( $email, sanitize_text_field( $subject ), $message, array( 'Content-Type: text/html; charset=UTF-8' ) );
	remove_filter( 'wp_mail_from_name', 'dkxv4_confirmation_mail_from_name' );
	update_post_meta( $entry_id, '_dkx_confirmation_email', $sent ? 'sent' : 'failed' );
	return $sent;
}

function dkxv4_confirmation_mail_from_name() {
	return 'DK Expressions';
}

function dkxv4_entry_columns( $columns ) {
	return array( 'cb' => $columns['cb'], 'title' => 'Entrant', 'competition' => 'Competition', 'contact' => 'Contact details', 'points' => 'Entries', 'date' => $columns['date'] );
}
add_filter( 'manage_dkx_entry_posts_columns', 'dkxv4_entry_columns' );

function dkxv4_entry_column_content( $column, $post_id ) {
	if ( 'competition' === $column ) { echo esc_html( get_the_title( (int) get_post_meta( $post_id, '_dkx_giveaway_id', true ) ) ); }
	if ( 'contact' === $column ) { echo esc_html( get_post_meta( $post_id, '_dkx_entry_email', true ) ) . '<br>' . esc_html( get_post_meta( $post_id, '_dkx_entry_phone', true ) ) . '<br>' . esc_html( get_post_meta( $post_id, '_dkx_entry_city', true ) ); }
	if ( 'points' === $column ) { echo esc_html( get_post_meta( $post_id, '_dkx_entry_points', true ) ); }
}
add_action( 'manage_dkx_entry_posts_custom_column', 'dkxv4_entry_column_content', 10, 2 );

function dkxv4_entry_details_box_register() {
	add_meta_box( 'dkx-entry-details', 'Entry Details', 'dkxv4_entry_details_box', 'dkx_entry', 'normal', 'high' );
}
add_action( 'add_meta_boxes_dkx_entry', 'dkxv4_entry_details_box_register' );

function dkxv4_entry_details_box( $post ) {
	$rows = array(
		'Competition' => get_the_title( (int) get_post_meta( $post->ID, '_dkx_giveaway_id', true ) ),
		'Name'        => get_post_meta( $post->ID, '_dkx_entry_name', true ),
		'Email'       => get_post_meta( $post->ID, '_dkx_entry_email', true ),
		'Contact'     => get_post_meta( $post->ID, '_dkx_entry_phone', true ),
		'City'        => get_post_meta( $post->ID, '_dkx_entry_city', true ),
		'Entries'     => get_post_meta( $post->ID, '_dkx_entry_points', true ),
		'Reference'   => get_post_meta( $post->ID, '_dkx_entry_reference', true ),
		'Confirmation email' => ucfirst( get_post_meta( $post->ID, '_dkx_confirmation_email', true ) ),
		'Answer'      => get_post_meta( $post->ID, '_dkx_entry_answer', true ),
	);
	echo '<table class="widefat striped"><tbody>';
	foreach ( $rows as $label => $value ) { echo '<tr><th style="width:150px">' . esc_html( $label ) . '</th><td>' . nl2br( esc_html( $value ?: '—' ) ) . '</td></tr>'; }
	echo '</tbody></table><p><em>Competition entries are private and must not be published.</em></p>';
}
