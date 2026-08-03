<?php
/**
 * DK Experience content control centre.
 *
 * @package DK_Expressions_V4_Fixes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function dkxv4_content_defaults() {
	$defaults = array(
		'organisation_name' => 'DK Expressions',
		'founder_name'      => 'Dale Kopping',
		'founding_year'     => '2013',
		'tagline'           => 'Freezing Time and Space with the Time Travellers™',
		'contact_email'     => 'dale@dkexpressions.co.za',
		'contact_phone'     => '+27 72 246 0451',
		'contact_location'  => 'Johannesburg · South Africa · Worldwide',
		'address_locality'  => 'Johannesburg',
		'address_region'    => 'Gauteng',
		'address_country'   => 'ZA',
		'copyright_text'    => 'DK Expressions. All moments reserved.',
		'header_cta_label'  => 'Start your project',
		'header_cta_url'    => '/contact/',
		'footer_tagline'    => 'Freezing Time and Space with the Time Travellers™',
		'footer_insights_label' => 'Insights',
		'footer_insights_url'   => '/insights/',
		'footer_contact_label'  => 'Contact',
		'footer_contact_url'    => '/contact/',
		'footer_privacy_label'  => 'Privacy',
		'footer_privacy_url'    => '/privacy-policy/',
		'footer_back_label'     => 'Back to the Future',
		'facebook_url'      => '',
		'instagram_url'     => '',
		'x_url'             => '',
		'youtube_url'       => '',
		'tiktok_url'        => '',
		'linkedin_url'      => '',
		'highlight_locations' => '',

		'home_hero_kicker'  => 'DK Expressions presents',
		'home_hero_title_1' => 'Freezing Time',
		'home_hero_title_2' => 'and Space',
		'home_hero_tagline' => 'with the Time Travellers',
		'home_enter_label'  => 'Enter the experience',
		'home_page_kicker'  => 'DK Expressions',
		'home_page_title_1' => 'Stories that move people.',
		'home_page_title_2' => 'Experiences they never forget.',
		'home_page_intro'   => 'Photography. Film. Digital. Events. Strategy. One connected creative experience.',
		'home_page_primary_label'   => 'Start your project',
		'home_page_primary_url'     => '/contact/',
		'home_page_secondary_label' => 'Explore our work',
		'home_page_secondary_url'   => '/our-work/',

		'home_services_kicker' => 'What we do',
		'home_services_title_1' => 'Every story. Every platform.',
		'home_services_title_2' => 'One standard: excellence.',
		'home_services_intro'   => 'One connected creative partner—from the first idea to the final result.',
		'home_work_kicker'      => 'Selected work',
		'home_work_title_1'     => 'Proof lives in',
		'home_work_title_2'     => 'the experience.',
		'home_work_intro'       => 'Powerful projects. Real moments. Stories designed to keep moving.',
		'home_clients_kicker'   => 'Trusted by',
		'home_clients_title_1'  => 'Clients & brands',
		'home_clients_title_2'  => 'we have travelled with.',
		'home_clients_intro'    => 'A selection of organisations, productions and partners whose stories have formed part of the DK Expressions journey.',
		'home_clients_count'    => '12',
		'home_about_kicker'     => 'Since 2013',
		'home_about_title_1'    => 'Not a media company.',
		'home_about_title_2'    => 'A time machine.',
		'home_about_text_1'     => 'DK Expressions began with one camera and a belief that moments matter. Today, our Time Travellers capture culture as it happens and build stories that keep moving long after the lights go down.',
		'home_about_text_2'     => 'We help entertainment, hospitality, lifestyle and ambitious brands turn attention into connection—and connection into legacy.',
		'home_about_button'     => 'Discover our story',
		'home_insights_kicker'  => 'Latest insights',
		'home_insights_title_1' => 'Culture, captured',
		'home_insights_title_2' => 'in real time.',
		'home_insights_intro'   => 'Entertainment, music, technology and the experiences shaping South African culture.',
		'home_posts_count'      => '4',
		'archive_posts_count'   => '10',
		'related_posts_count'   => '3',
		'related_heading'       => 'Related Stories',
		'previous_story_label'  => 'Previous story',
		'next_story_label'      => 'Next story',
		'giveaways_kicker'      => 'Win with DK Expressions',
		'giveaways_title_1'     => 'Big moments.',
		'giveaways_title_2'     => 'Unforgettable prizes.',
		'giveaways_intro'       => 'Discover the latest DK Expressions competitions, experiences and ticket giveaways. Enter while the portal is open.',
		'giveaways_open_heading'     => 'Open competitions',
		'giveaways_upcoming_heading' => 'Coming soon',
		'giveaways_closed_heading'   => 'Past competitions',
		'giveaways_disclaimer'       => 'Competitions are subject to their individual rules, eligibility requirements and closing dates. No correspondence will be entered into after winners are selected.',
		'home_cta_kicker'       => 'Your next chapter',
		'home_cta_title_1'      => 'Ready to freeze',
		'home_cta_title_2'      => 'a moment in time?',
		'home_cta_text'         => 'Tell us what you’re building. We’ll show you how far the story can travel.',
		'home_cta_button'       => 'Start your project',

		'about_lead'       => 'Stories that move people. Experiences they will never forget.',
		'about_heading_1'  => 'Born in Johannesburg.',
		'about_heading_2'  => 'Built for everywhere.',
		'about_paragraph_1' => 'DK Expressions began in February 2013 with one camera and a belief that moments matter. What started as founder Dale Kopping capturing one experience at a time grew into an independent media, creative and brand-storytelling company.',
		'about_paragraph_2' => 'Our Time Travellers move through entertainment, culture, events, hospitality, lifestyle and technology—preserving the emotion of each moment and transforming it into stories that continue travelling.',
		'about_paragraph_3' => 'We combine photography, film, editorial, digital strategy and emerging technology into one connected creative experience.',
		'about_paragraph_4' => 'We do not simply document what happened. We preserve what it felt like—and help brands turn that connection into legacy.',

		'contact_intro_heading_1' => 'Start with',
		'contact_intro_heading_2' => 'the story.',
		'contact_intro_text'      => 'Share the essentials and we will respond within one business day to arrange a focused discovery conversation.',
		'contact_kicker'          => 'Let’s create',
		'contact_heading'         => 'Something unforgettable.',
		'contact_services'        => 'Photography, film, events, brand storytelling, digital growth, websites and intelligent solutions.',
		'contact_button'          => 'Send project brief',
		'contact_success_note'    => 'We will respond within one business day.',
		'contact_project_types'   => "Event storytelling\nBrand content retainer\nPhotography\nFilm and video\nDigital growth\nWebsite or AI solution\nSomething extraordinary",
	);

	$navigation = array(
		array( 'Home', '/home/' ),
		array( 'Solutions', '/solutions/' ),
		array( 'Our Work', '/our-work/' ),
		array( 'Industries', '/industries/' ),
		array( 'Insights', '/insights/' ),
		array( 'About', '/about/' ),
		array( 'Legacy', '/legacy/' ),
		array( 'Contact', '/contact/' ),
		array( 'Giveaways', '/giveaways/' ),
	);
	foreach ( $navigation as $index => $item ) {
		$n = $index + 1;
		$defaults[ "nav_{$n}_label" ] = $item[0];
		$defaults[ "nav_{$n}_url" ]   = $item[1];
	}

	$metrics = array(
		array( '13+', 'Years of storytelling' ),
		array( '2,500+', 'Projects delivered' ),
		array( 'Millions', 'Audience reached' ),
		array( '3,000+', 'Articles published' ),
		array( '40+', 'Cities covered' ),
		array( '100+', 'Brands worked with' ),
	);
	foreach ( $metrics as $index => $metric ) {
		$n = $index + 1;
		$defaults[ "metric_{$n}_value" ] = $metric[0];
		$defaults[ "metric_{$n}_label" ] = $metric[1];
	}

	$services = array(
		array( '01', 'Brand Storytelling', 'Strategy, campaigns and stories engineered to move people.', '✦' ),
		array( '02', 'Event Experiences', 'From the pit to the boardroom—coverage that keeps the moment alive.', '◉' ),
		array( '03', 'Digital Growth', 'Search, social and paid media that turn attention into momentum.', '↗' ),
		array( '04', 'Creative Production', 'Photography, film and content built to travel across every screen.', '◎' ),
		array( '05', 'Web & AI Solutions', 'Future-ready digital experiences and intelligent automation.', '⌬' ),
		array( '06', 'SEO & Analytics', 'Search visibility, performance intelligence and measurable growth.', '◌' ),
		array( '07', 'Photography', 'Powerful imagery for people, brands, events and defining moments.', '□' ),
		array( '08', 'Videography', 'Cinematic stories and short-form films for every screen.', '▷' ),
	);
	foreach ( $services as $index => $service ) {
		$n = $index + 1;
		$defaults[ "service_{$n}_number" ]      = $service[0];
		$defaults[ "service_{$n}_title" ]       = $service[1];
		$defaults[ "service_{$n}_description" ] = $service[2];
		$defaults[ "service_{$n}_icon" ]        = $service[3];
		$defaults[ "service_{$n}_url" ]         = '/solutions/';
	}

	$work = array(
		array( 'Event Storytelling', 'Ultra South Africa', '#a21bff' ),
		array( 'Automotive', 'BYD South Africa', '#91b9d6' ),
		array( 'Entertainment', 'Comic Con Africa', '#00d8ff' ),
	);
	foreach ( $work as $index => $item ) {
		$n = $index + 1;
		$defaults[ "work_{$n}_category" ] = $item[0];
		$defaults[ "work_{$n}_title" ]    = $item[1];
		$defaults[ "work_{$n}_colour" ]   = $item[2];
		$defaults[ "work_{$n}_url" ]      = '/our-work/';
	}

	$values = array(
		array( '01', 'Inspired', 'Work that sparks emotion, ideas and action.' ),
		array( '02', 'Time Travellers', 'Creators who preserve the moments others might miss.' ),
		array( '03', 'Legacy Builders', 'Leadership focused on value that lives beyond the campaign.' ),
		array( '04', 'Inspire. Preserve. Build.', 'The idea behind every story, partnership and experience.' ),
	);
	foreach ( $values as $index => $item ) {
		$n = $index + 1;
		$defaults[ "value_{$n}_number" ]      = $item[0];
		$defaults[ "value_{$n}_title" ]       = $item[1];
		$defaults[ "value_{$n}_description" ] = $item[2];
	}

	$page_heroes = array(
		'solutions'  => array( 'Connected creative capability', 'Every Story.', 'Every Platform.', 'Strategy, production, media and technology brought together by one team—with one standard: excellence.' ),
		'our_work'   => array( 'Selected missions', 'Powerful Projects.', 'Real Impact.', 'A living portfolio of experiences captured, campaigns delivered and cultural moments preserved.' ),
		'industries' => array( 'Where we make an impact', 'Local Insight.', 'Global Imagination.', 'Sector understanding meets multidisciplinary creativity across industries built on attention, trust and experience.' ),
		'insights'   => array( 'The editorial archive', 'Culture, Captured.', 'In Real Time.', 'Entertainment, music, technology, events and the stories shaping South African culture.' ),
		'about'      => array( 'Since February 2013', 'One Camera.', 'A World of Stories.', 'DK Expressions began in Johannesburg with determination, imagination and the belief that moments matter.' ),
		'legacy'     => array( 'Built beyond the moment', 'Preserving Moments.', 'Building Legacies.', 'The legacy of DK Expressions is measured in the moments preserved, the people inspired and the opportunities created.' ),
		'contact'    => array( 'Start your project', 'Your Next Chapter.', 'Starts Here.', 'Tell us what you are building, launching or celebrating. We will show you how far the story can travel.' ),
	);
	foreach ( $page_heroes as $slug => $hero ) {
		$defaults[ "{$slug}_hero_kicker" ]  = $hero[0];
		$defaults[ "{$slug}_hero_title_1" ] = $hero[1];
		$defaults[ "{$slug}_hero_title_2" ] = $hero[2];
		$defaults[ "{$slug}_hero_text" ]    = $hero[3];
	}

	return $defaults;
}

function dkxv4_content( $key ) {
	$saved    = get_option( 'dkxv4_content', array() );
	$defaults = dkxv4_content_defaults();
	return array_key_exists( $key, $saved ) ? $saved[ $key ] : ( $defaults[ $key ] ?? '' );
}

function dkxv4_content_url( $key ) {
	$url = dkxv4_content( $key );
	if ( str_starts_with( $url, '/' ) ) {
		return home_url( $url );
	}
	return $url;
}

function dkxv4_sanitize_content( $input ) {
	$defaults  = dkxv4_content_defaults();
	$sanitized = array();
	foreach ( $defaults as $key => $default ) {
		if ( ! isset( $input[ $key ] ) ) {
			$sanitized[ $key ] = $default;
			continue;
		}
		$value = $input[ $key ];
		if ( str_ends_with( $key, '_url' ) ) {
			$sanitized[ $key ] = '/' === substr( $value, 0, 1 ) ? sanitize_text_field( $value ) : esc_url_raw( $value );
		} elseif ( str_contains( $key, 'email' ) ) {
			$sanitized[ $key ] = sanitize_email( $value );
		} elseif ( str_contains( $key, 'paragraph' ) || str_contains( $key, '_text' ) || str_contains( $key, 'description' ) || str_contains( $key, 'intro' ) || str_contains( $key, 'services' ) || str_contains( $key, 'project_types' ) || 'highlight_locations' === $key ) {
			$sanitized[ $key ] = sanitize_textarea_field( $value );
		} elseif ( str_contains( $key, 'colour' ) ) {
			$sanitized[ $key ] = sanitize_hex_color( $value ) ?: $default;
		} else {
			$sanitized[ $key ] = sanitize_text_field( $value );
		}
	}
	return $sanitized;
}

function dkxv4_register_content_settings() {
	register_setting(
		'dkxv4_content_group',
		'dkxv4_content',
		array(
			'type'              => 'array',
			'sanitize_callback' => 'dkxv4_sanitize_content',
			'default'           => dkxv4_content_defaults(),
		)
	);
}
add_action( 'admin_init', 'dkxv4_register_content_settings' );

function dkxv4_content_menu() {
	add_menu_page(
		'DK Experience',
		'DK Experience',
		'manage_options',
		'dkx-experience',
		'dkxv4_render_content_page',
		'dashicons-visibility',
		3
	);
}
add_action( 'admin_menu', 'dkxv4_content_menu', 30 );

/**
 * Remove obsolete dashboard entries using the same visible DK Experience
 * title. The new control centre is always retained.
 */
function dkxv4_remove_duplicate_experience_menu() {
	global $menu;
	if ( ! is_array( $menu ) ) {
		return;
	}
	foreach ( $menu as $position => $item ) {
		$label = isset( $item[0] ) ? trim( wp_strip_all_tags( $item[0] ) ) : '';
		$slug  = $item[2] ?? '';
		$is_obsolete = false !== stripos( $label, 'DKX Experience' );
		$is_duplicate = 'DK Experience' === $label && 'dkx-experience' !== $slug;
		if ( $is_obsolete || $is_duplicate ) {
			remove_menu_page( $slug );
			unset( $menu[ $position ] );
		}
	}
}
add_action( 'admin_menu', 'dkxv4_remove_duplicate_experience_menu', PHP_INT_MAX );
add_action( 'admin_head', 'dkxv4_remove_duplicate_experience_menu' );

/**
 * Locate the existing DKX Clients & Brands post type without depending on the
 * plugin's internal slug.
 */
function dkxv4_clients_post_type() {
	$candidates = array( 'dkx_client', 'dkx_clients', 'dkx_brand', 'dkx_brands', 'client', 'clients' );
	foreach ( $candidates as $candidate ) {
		if ( post_type_exists( $candidate ) ) {
			return $candidate;
		}
	}
	foreach ( get_post_types( array( 'show_ui' => true ), 'objects' ) as $post_type => $object ) {
		$labels = strtolower( implode( ' ', array_filter( array( $object->label ?? '', $object->labels->menu_name ?? '', $object->labels->name ?? '' ) ) ) );
		if ( str_contains( $labels, 'clients' ) && str_contains( $labels, 'brands' ) ) {
			return $post_type;
		}
	}
	return '';
}

/**
 * One-time v1.5 content architecture migration:
 * - creates a dedicated Landing page for the root domain;
 * - keeps Home available at /home/;
 * - updates the Home navigation link from / to /home/.
 */
function dkxv4_migrate_separate_landing_and_home() {
	if ( '1.5.0' === get_option( 'dkxv4_architecture_version' ) ) {
		return;
	}

	$landing = get_page_by_path( 'landing' );
	if ( ! $landing ) {
		$landing_id = wp_insert_post(
			array(
				'post_title'   => 'Landing',
				'post_name'    => 'landing',
				'post_status'  => 'publish',
				'post_type'    => 'page',
				'post_content' => '',
			)
		);
	} else {
		$landing_id = (int) $landing->ID;
	}

	$home = get_page_by_path( 'home' );
	if ( ! $home ) {
		wp_insert_post(
			array(
				'post_title'   => 'Home',
				'post_name'    => 'home',
				'post_status'  => 'publish',
				'post_type'    => 'page',
				'post_content' => '',
			)
		);
	}

	if ( $landing_id && ! is_wp_error( $landing_id ) ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', (int) $landing_id );
	}

	$content = get_option( 'dkxv4_content', array() );
	if ( empty( $content['nav_1_url'] ) || '/' === $content['nav_1_url'] ) {
		$content['nav_1_url'] = '/home/';
		update_option( 'dkxv4_content', $content );
	}

	update_option( 'dkxv4_architecture_version', '1.5.0' );
	flush_rewrite_rules( false );
}
add_action( 'admin_init', 'dkxv4_migrate_separate_landing_and_home', 20 );

function dkxv4_admin_assets( $hook ) {
	if ( 'toplevel_page_dkx-experience' !== $hook ) {
		return;
	}
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'wp-color-picker' );
	wp_add_inline_script( 'wp-color-picker', 'jQuery(function($){$(".dkx-colour").wpColorPicker();});' );
	$css = '
		.dkx-admin{max-width:1180px;margin:24px 22px 60px 0}
		.dkx-admin-hero{padding:28px 32px;background:linear-gradient(135deg,#03101f,#075991);color:#fff;border-left:4px solid #25aaff}
		.dkx-admin-hero h1{margin:0 0 8px;color:#fff;font-size:28px}.dkx-admin-hero p{margin:0;color:#c7def0}
		.dkx-admin details{margin-top:14px;background:#fff;border:1px solid #ccd5df;box-shadow:0 2px 8px rgba(0,0,0,.04)}
		.dkx-admin summary{padding:17px 20px;color:#03101f;font-size:15px;font-weight:700;cursor:pointer}
		.dkx-fields{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:18px;padding:6px 20px 24px}
		.dkx-field{display:flex;flex-direction:column;gap:7px}.dkx-field.wide{grid-column:1/-1}
		.dkx-field label{font-weight:650}.dkx-field input,.dkx-field textarea{width:100%;max-width:none}
		.dkx-field textarea{min-height:90px}.dkx-help{color:#596773;font-size:12px}
		.dkx-save{position:sticky;bottom:0;z-index:2;margin-top:18px;padding:14px 20px;background:rgba(240,246,251,.96);border:1px solid #ccd5df}
		@media(max-width:782px){.dkx-admin{margin-right:10px}.dkx-fields{grid-template-columns:1fr}.dkx-field.wide{grid-column:auto}}
	';
	wp_add_inline_style( 'wp-color-picker', $css );
}
add_action( 'admin_enqueue_scripts', 'dkxv4_admin_assets' );

function dkxv4_field( $key, $label, $type = 'text', $wide = false, $help = '' ) {
	$value = dkxv4_content( $key );
	$class = $wide ? 'dkx-field wide' : 'dkx-field';
	echo '<div class="' . esc_attr( $class ) . '"><label for="dkx-' . esc_attr( $key ) . '">' . esc_html( $label ) . '</label>';
	if ( 'textarea' === $type ) {
		echo '<textarea id="dkx-' . esc_attr( $key ) . '" name="dkxv4_content[' . esc_attr( $key ) . ']">' . esc_textarea( $value ) . '</textarea>';
	} else {
		$extra = 'color' === $type ? ' class="dkx-colour"' : '';
		$input_type = in_array( $type, array( 'url', 'email', 'number' ), true ) ? $type : 'text';
		echo '<input' . $extra . ' id="dkx-' . esc_attr( $key ) . '" type="' . esc_attr( $input_type ) . '" name="dkxv4_content[' . esc_attr( $key ) . ']" value="' . esc_attr( $value ) . '">';
	}
	if ( $help ) {
		echo '<span class="dkx-help">' . esc_html( $help ) . '</span>';
	}
	echo '</div>';
}

function dkxv4_render_content_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	?>
	<div class="wrap dkx-admin">
		<div class="dkx-admin-hero"><h1>DK Experience</h1><p>The single control centre for DK Expressions website content. Save once, then clear the website cache to see changes.</p></div>
		<?php settings_errors(); ?>
		<form method="post" action="options.php">
			<?php settings_fields( 'dkxv4_content_group' ); ?>

			<details open><summary>Global identity, contact and footer</summary><div class="dkx-fields">
				<?php
				dkxv4_field( 'organisation_name', 'Organisation name' );
				dkxv4_field( 'founder_name', 'Founder name' );
				dkxv4_field( 'founding_year', 'Founding year' );
				dkxv4_field( 'tagline', 'Official slogan', 'text', true );
				dkxv4_field( 'contact_email', 'Contact email', 'email' );
				dkxv4_field( 'contact_phone', 'Contact phone' );
				dkxv4_field( 'contact_location', 'Displayed location', 'text', true );
				dkxv4_field( 'address_locality', 'Schema locality' );
				dkxv4_field( 'address_region', 'Schema region' );
				dkxv4_field( 'address_country', 'Schema country code' );
				dkxv4_field( 'header_cta_label', 'Header button label' );
				dkxv4_field( 'header_cta_url', 'Header button URL' );
				dkxv4_field( 'footer_tagline', 'Footer slogan', 'text', true );
				dkxv4_field( 'copyright_text', 'Copyright wording', 'text', true );
				dkxv4_field( 'footer_insights_label', 'Footer Insights label' );
				dkxv4_field( 'footer_insights_url', 'Footer Insights URL' );
				dkxv4_field( 'footer_contact_label', 'Footer Contact label' );
				dkxv4_field( 'footer_contact_url', 'Footer Contact URL' );
				dkxv4_field( 'footer_privacy_label', 'Footer Privacy label' );
				dkxv4_field( 'footer_privacy_url', 'Footer Privacy URL' );
				dkxv4_field( 'footer_back_label', 'Back-to-top label' );
				?>
			</div></details>

			<details><summary>Main navigation</summary><div class="dkx-fields">
				<?php
				for ( $i = 1; $i <= 8; $i++ ) {
					dkxv4_field( "nav_{$i}_label", "Menu item {$i} label" );
					dkxv4_field( "nav_{$i}_url", "Menu item {$i} URL" );
				}
				?>
			</div></details>

			<details><summary>Social-media links</summary><div class="dkx-fields">
				<?php
				foreach ( array( 'facebook' => 'Facebook', 'instagram' => 'Instagram', 'x' => 'X / Twitter', 'youtube' => 'YouTube', 'tiktok' => 'TikTok', 'linkedin' => 'LinkedIn' ) as $key => $label ) {
					dkxv4_field( "{$key}_url", "{$label} URL", 'url' );
				}
				?>
			</div></details>

			<details><summary>Landing page and Home-page opening</summary><div class="dkx-fields">
				<?php
				dkxv4_field( 'home_hero_kicker', 'Landing: hero kicker' );
				dkxv4_field( 'home_enter_label', 'Landing: Enter button label' );
				dkxv4_field( 'home_hero_title_1', 'Landing: title – line 1' );
				dkxv4_field( 'home_hero_title_2', 'Landing: title – blue line' );
				dkxv4_field( 'home_hero_tagline', 'Landing: trademark line', 'text', true );
				dkxv4_field( 'home_page_kicker', 'Home: opening kicker' );
				dkxv4_field( 'home_page_intro', 'Home: opening introduction', 'textarea' );
				dkxv4_field( 'home_page_title_1', 'Home: title – line 1' );
				dkxv4_field( 'home_page_title_2', 'Home: title – blue line' );
				dkxv4_field( 'home_page_primary_label', 'Home: primary button label' );
				dkxv4_field( 'home_page_primary_url', 'Home: primary button URL' );
				dkxv4_field( 'home_page_secondary_label', 'Home: secondary button label' );
				dkxv4_field( 'home_page_secondary_url', 'Home: secondary button URL' );
				for ( $i = 1; $i <= 6; $i++ ) {
					dkxv4_field( "metric_{$i}_value", "Statistic {$i} value" );
					dkxv4_field( "metric_{$i}_label", "Statistic {$i} label" );
				}
				?>
			</div></details>

			<details><summary>Homepage services section</summary><div class="dkx-fields">
				<?php
				dkxv4_field( 'home_services_kicker', 'Section kicker' );
				dkxv4_field( 'home_services_intro', 'Section introduction', 'textarea' );
				dkxv4_field( 'home_services_title_1', 'Heading – line 1' );
				dkxv4_field( 'home_services_title_2', 'Heading – blue line' );
				for ( $i = 1; $i <= 8; $i++ ) {
					dkxv4_field( "service_{$i}_number", "Service {$i} number" );
					dkxv4_field( "service_{$i}_icon", "Service {$i} icon/symbol" );
					dkxv4_field( "service_{$i}_title", "Service {$i} title" );
					dkxv4_field( "service_{$i}_url", "Service {$i} URL" );
					dkxv4_field( "service_{$i}_description", "Service {$i} description", 'textarea', true );
				}
				?>
			</div></details>

			<details><summary>Homepage selected work</summary><div class="dkx-fields">
				<?php
				dkxv4_field( 'home_work_kicker', 'Section kicker' );
				dkxv4_field( 'home_work_intro', 'Section introduction', 'textarea' );
				dkxv4_field( 'home_work_title_1', 'Heading – line 1' );
				dkxv4_field( 'home_work_title_2', 'Heading – blue line' );
				for ( $i = 1; $i <= 3; $i++ ) {
					dkxv4_field( "work_{$i}_category", "Work card {$i} category" );
					dkxv4_field( "work_{$i}_title", "Work card {$i} title" );
					dkxv4_field( "work_{$i}_colour", "Work card {$i} colour", 'color' );
					dkxv4_field( "work_{$i}_url", "Work card {$i} URL" );
				}
				?>
			</div></details>

			<details><summary>Home-page Clients & Brands logo wall</summary><div class="dkx-fields">
				<?php
				dkxv4_field( 'home_clients_kicker', 'Section kicker' );
				dkxv4_field( 'home_clients_count', 'Maximum logos displayed', 'number', false, 'Add and edit logos under DKX Clients & Brands. Use each client’s Featured Image for its logo.' );
				dkxv4_field( 'home_clients_title_1', 'Heading – line 1' );
				dkxv4_field( 'home_clients_title_2', 'Heading – blue line' );
				dkxv4_field( 'home_clients_intro', 'Section introduction', 'textarea', true );
				?>
			</div></details>

			<details><summary>Homepage About, Insights and closing call to action</summary><div class="dkx-fields">
				<?php
				foreach ( array(
					'home_about_kicker' => 'About kicker', 'home_about_title_1' => 'About heading – line 1', 'home_about_title_2' => 'About heading – blue line',
					'home_about_text_1' => 'About paragraph 1', 'home_about_text_2' => 'About paragraph 2', 'home_about_button' => 'About button',
					'home_insights_kicker' => 'Insights kicker', 'home_insights_title_1' => 'Insights heading – line 1', 'home_insights_title_2' => 'Insights heading – blue line',
					'home_insights_intro' => 'Insights introduction', 'home_cta_kicker' => 'Closing CTA kicker', 'home_cta_title_1' => 'Closing CTA heading – line 1',
					'home_cta_title_2' => 'Closing CTA heading – blue line', 'home_cta_text' => 'Closing CTA paragraph', 'home_cta_button' => 'Closing CTA button',
				) as $key => $label ) {
					$is_long = str_contains( $key, '_text_' ) || str_contains( $key, 'intro' ) || 'home_cta_text' === $key;
					dkxv4_field( $key, $label, $is_long ? 'textarea' : 'text', $is_long );
				}
				dkxv4_field( 'home_posts_count', 'Number of latest articles', 'number' );
				?>
			</div></details>

			<details><summary>Article archive and Related Stories</summary><div class="dkx-fields">
				<?php
				dkxv4_field( 'archive_posts_count', 'Articles shown per archive page', 'number', false, 'Recommended: 10. Featured/sticky stories appear first, followed by the newest articles without duplication.' );
				dkxv4_field( 'related_posts_count', 'Related stories shown after each article', 'number' );
				dkxv4_field( 'related_heading', 'Related-stories heading' );
				dkxv4_field( 'previous_story_label', 'Previous-story label' );
				dkxv4_field( 'next_story_label', 'Next-story label' );
				?>
			</div></details>

			<details><summary>Automatic neon and red text highlighting</summary><div class="dkx-fields">
				<?php
				dkxv4_field( 'highlight_locations', 'Additional cities, towns or locations (one per line)', 'textarea', true, 'Numbers, dates, countries and major South African locations are recognised automatically. Add any additional local or international place names here.' );
				?>
			</div></details>

			<details><summary>Giveaways & Competitions page</summary><div class="dkx-fields">
				<?php
				dkxv4_field( 'giveaways_kicker', 'Page kicker' );
				dkxv4_field( 'giveaways_title_1', 'Page title – line 1' );
				dkxv4_field( 'giveaways_title_2', 'Page title – blue line' );
				dkxv4_field( 'giveaways_intro', 'Page introduction', 'textarea', true );
				dkxv4_field( 'giveaways_open_heading', 'Open section heading' );
				dkxv4_field( 'giveaways_upcoming_heading', 'Upcoming section heading' );
				dkxv4_field( 'giveaways_closed_heading', 'Past section heading' );
				dkxv4_field( 'giveaways_disclaimer', 'Competition disclaimer', 'textarea', true );
				?>
			</div></details>

			<details><summary>Core-page hero headings</summary><div class="dkx-fields">
				<?php
				foreach ( array( 'solutions' => 'Solutions', 'our_work' => 'Our Work', 'industries' => 'Industries', 'insights' => 'Insights', 'about' => 'About', 'legacy' => 'Legacy', 'contact' => 'Contact' ) as $slug => $label ) {
					echo '<h3 class="wide">' . esc_html( $label ) . '</h3>';
					dkxv4_field( "{$slug}_hero_kicker", "{$label}: kicker" );
					dkxv4_field( "{$slug}_hero_title_1", "{$label}: title line 1" );
					dkxv4_field( "{$slug}_hero_title_2", "{$label}: blue title line" );
					dkxv4_field( "{$slug}_hero_text", "{$label}: description", 'textarea' );
				}
				?>
			</div></details>

			<details><summary>About page content and values</summary><div class="dkx-fields">
				<?php
				dkxv4_field( 'about_lead', 'Opening statement', 'textarea', true );
				dkxv4_field( 'about_heading_1', 'Main heading – line 1' );
				dkxv4_field( 'about_heading_2', 'Main heading – line 2' );
				for ( $i = 1; $i <= 4; $i++ ) {
					dkxv4_field( "about_paragraph_{$i}", "About paragraph {$i}", 'textarea', true );
				}
				for ( $i = 1; $i <= 4; $i++ ) {
					dkxv4_field( "value_{$i}_number", "Value card {$i} number" );
					dkxv4_field( "value_{$i}_title", "Value card {$i} title" );
					dkxv4_field( "value_{$i}_description", "Value card {$i} description", 'textarea', true );
				}
				?>
			</div></details>

			<details><summary>Contact page and enquiry form</summary><div class="dkx-fields">
				<?php
				dkxv4_field( 'contact_intro_heading_1', 'Introduction heading – line 1' );
				dkxv4_field( 'contact_intro_heading_2', 'Introduction heading – line 2' );
				dkxv4_field( 'contact_intro_text', 'Introduction paragraph', 'textarea', true );
				dkxv4_field( 'contact_kicker', 'Contact-panel kicker' );
				dkxv4_field( 'contact_heading', 'Contact-panel heading' );
				dkxv4_field( 'contact_services', 'Services summary', 'textarea', true );
				dkxv4_field( 'contact_button', 'Submit button label' );
				dkxv4_field( 'contact_success_note', 'Response-time note' );
				dkxv4_field( 'contact_project_types', 'Project-type choices (one per line)', 'textarea', true );
				?>
			</div></details>

			<div class="dkx-save"><?php submit_button( 'Save DK Experience', 'primary', 'submit', false ); ?></div>
		</form>
	</div>
	<?php
}
