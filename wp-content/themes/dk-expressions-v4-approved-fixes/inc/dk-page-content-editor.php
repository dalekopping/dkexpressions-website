<?php
/**
 * Backend editing layer for the locked DK Expressions page experiences.
 *
 * The approved pages are intentionally built from bespoke PHP templates rather
 * than the Gutenberg canvas. This file exposes their copy in the Page editor
 * and applies saved overrides without changing the locked frontend structure.
 *
 * @package DK_Expressions_V4_Fixes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Normalise a field definition.
 */
function dkxv4_pce_field( $label, $default, $args = array() ) {
	return array_merge(
		array(
			'label'   => $label,
			'default' => (string) $default,
			'type'    => 'textarea',
			'rows'    => 3,
		),
		$args
	);
}

/**
 * Approved package data shared by the Solutions and Industries editors.
 */
function dkxv4_pce_package_defaults() {
	return array(
		'Event Domination' => array(
			'tagline' => 'Turn the event into something people wish they attended.',
			'packages' => array(
				'Spark' => array( 'R6,500', '/ event', 'Entry coverage to get a brand in the door', array( 'Up to 4 hours on site', '1 creator', '40 edited photos', '2 short-form reels', 'Next-day delivery' ) ),
				'Signature' => array( 'R32,000', '/ event', 'The core package most events should buy', array( 'Up to 8 hours', 'Photo + video', 'Live posting during the event', '5 reels + 80 edited photos', 'Same-day teaser edit', 'Post-event recap reel' ) ),
				'Takeover' => array( 'R95,000', '', 'Multi-day or flagship productions', array( 'Crew of 2–4 creators', 'Real-time social management', 'Daily reels + stories', 'Creator/influencer coordination', 'Full post-event campaign + report' ) ),
			),
		),
		'Always On' => array(
			'tagline' => 'Your brand should not disappear between campaigns.',
			'packages' => array(
				'Essential' => array( 'R15,000', '/ month', 'Consistent presence for one brand', array( '1 content shoot per month', '12 edited posts', '4 reels', 'Monthly content calendar', 'Basic monthly report' ) ),
				'Premium' => array( 'R35,000', '/ month', 'Full content and growth partner', array( '2 shoots per month', '20 posts + 8 reels', 'Full social media management', 'Content strategy + calendar', 'Paid ad creative', 'Monthly performance report' ) ),
				'Elite' => array( 'R60,000', '/ month', 'Own the category online', array( 'Weekly shoots + content drops', 'Unlimited posts within scope', 'Full social + community management', 'Monthly event coverage', 'Paid ad management', 'Dedicated strategy sessions' ) ),
			),
		),
		'Become the Name' => array(
			'tagline' => 'People cannot hire, book or invest in someone they never see.',
			'packages' => array(
				'Starter' => array( 'R18,000', '/ month', 'Show up consistently and look the part', array( '1 shoot per month', '12 personal-brand posts', '4 short-form videos', 'Instagram + TikTok content' ) ),
				'Growth' => array( 'R40,000', '/ month', 'Build real authority and reach', array( '2 shoots per month', '20 posts + 8 videos', 'Personal-brand strategy', 'Full content management', 'Interview/talking-head series', 'Monthly review + reporting' ) ),
				'Authority' => array( 'R75,000', '/ month', 'Become the name in your field', array( 'Weekly content production', 'Media + PR positioning', 'Podcast/video show production', 'Full multi-platform management', 'Ghostwriting + thought leadership', 'Quarterly brand strategy sessions' ) ),
			),
		),
		'Own the Attention' => array(
			'tagline' => 'Turn DK Expressions publishing authority into sustained brand visibility.',
			'packages' => array(
				'Feature' => array( 'R1,500', '/ placement', 'A focused sponsored editorial feature', array( '1 dedicated editorial listing', '1 social amplification post', 'Live for 12 months' ) ),
				'Spotlight' => array( 'R6,000', '/ campaign', 'Sustained presence over a season', array( '8 editorial listings', 'Social amplification on each', 'Instagram + Facebook + X coverage', 'Campaign-window placement' ) ),
				'Headline' => array( 'R12,500', '/ campaign', 'Dominant ongoing exposure', array( '16 editorial listings', 'Full social amplification per post', 'Priority placement + tagging', 'Optional event-coverage tie-in' ) ),
			),
		),
	);
}

/**
 * Complete editor manifest. Defaults mirror the approved frontend copy.
 */
function dkxv4_page_content_manifest() {
	$manifest = array(
		'landing' => array(
			'label' => 'Landing Page',
			'sections' => array(
				'hero' => array(
					'label' => '01 / Hero',
					'fields' => array(
						'landing_hero_kicker' => dkxv4_pce_field( 'Kicker', dkxv4_content( 'home_hero_kicker' ), array( 'type' => 'text' ) ),
						'landing_hero_title_1' => dkxv4_pce_field( 'Headline — first line', dkxv4_content( 'home_hero_title_1' ) ),
						'landing_hero_title_2' => dkxv4_pce_field( 'Headline — accent line', dkxv4_content( 'home_hero_title_2' ) ),
						'landing_hero_tagline' => dkxv4_pce_field( 'Registered tagline', dkxv4_registered_phrase( dkxv4_content( 'home_hero_tagline' ) ) ),
						'landing_hero_sub' => dkxv4_pce_field( 'Supporting line', 'Premium culture, content and brand storytelling since 2013.' ),
						'landing_hero_jump' => dkxv4_pce_field( 'Jump link label', 'Choose Your Experience', array( 'type' => 'text' ) ),
					),
				),
				'proof' => array(
					'label' => '02 / Proof + Booking Strip',
					'fields' => array(
						'landing_stat_visits' => dkxv4_pce_field( 'Visits', '1.10M+', array( 'type' => 'text' ) ),
						'landing_stat_pages' => dkxv4_pce_field( 'Pages viewed', '2.47M+', array( 'type' => 'text' ) ),
						'landing_trust' => dkxv4_pce_field( 'Trusted-by line', 'Trusted by Big Concerts, Comic Con Africa, Showtime Management, TPW' ),
					),
				),
				'doors' => array(
					'label' => '03 / Three Doors',
					'fields' => array(
						'landing_doors_heading' => dkxv4_pce_field( 'Section heading', 'Three doors. One DK universe.' ),
						'landing_doors_intro' => dkxv4_pce_field( 'Section introduction', 'Enter through the pathway that matches what you need today. Every door is powered by the same creativity, credibility and execution.' ),
						'landing_agency_title' => dkxv4_pce_field( 'Agency title', 'Build a brand people remember.' ),
						'landing_agency_copy' => dkxv4_pce_field( 'Agency copy', 'Strategy, campaigns, photography, film, SEO and digital experiences engineered for growth.' ),
						'landing_agency_note' => dkxv4_pce_field( 'Agency starting note', 'Services from R6,500', array( 'type' => 'text' ) ),
						'landing_media_title' => dkxv4_pce_field( 'Media title', 'Discover culture as it happens.' ),
						'landing_media_copy' => dkxv4_pce_field( 'Media copy', 'Entertainment news, interviews, reviews, events and the stories shaping South Africa.' ),
						'landing_vault_title' => dkxv4_pce_field( 'Time Vault title', 'See where we have travelled.' ),
						'landing_vault_copy' => dkxv4_pce_field( 'Time Vault copy', 'Photography, motion, recommendations and 13 years of documented work frozen in time.' ),
					),
				),
				'packages' => array(
					'label' => '04 / Core Packages',
					'fields' => array(
						'landing_packages_heading' => dkxv4_pce_field( 'Section heading', 'Choose the level of attention.' ),
						'landing_packages_intro' => dkxv4_pce_field( 'Section introduction', 'Clear starting points for media exposure, event domination and ongoing brand growth.' ),
						'landing_spotlight_price' => dkxv4_pce_field( 'Spotlight price', 'R6,000', array( 'type' => 'text' ) ),
						'landing_signature_price' => dkxv4_pce_field( 'Signature price', 'R32,000', array( 'type' => 'text' ) ),
						'landing_premium_price' => dkxv4_pce_field( 'Premium price', 'R35,000', array( 'type' => 'text' ) ),
					),
				),
				'process' => array(
					'label' => '05 / How We Work',
					'fields' => array(
						'landing_process_heading' => dkxv4_pce_field( 'Section heading', 'One connected creative system.' ),
						'landing_discover' => dkxv4_pce_field( 'Discover', 'We define the objective, audience, opportunity and the story worth telling.' ),
						'landing_design' => dkxv4_pce_field( 'Design', 'We shape the concept, campaign, content plan and conversion path.' ),
						'landing_create' => dkxv4_pce_field( 'Create', 'Photography, film, editorial and digital assets are produced as one system.' ),
						'landing_amplify' => dkxv4_pce_field( 'Amplify', 'Publishing, social distribution and reporting extend the impact beyond launch day.' ),
					),
				),
				'conversion' => array(
					'label' => '06 / Proof + Final Conversion',
					'fields' => array(
						'landing_quote_one' => dkxv4_pce_field( 'Big Concerts recommendation', '“Committed, passionate and dedicated to his craft.”' ),
						'landing_quote_two' => dkxv4_pce_field( 'One-Eyed Jack recommendation', '“I highly recommend associating any brand with DK Expressions.”' ),
						'landing_final_heading' => dkxv4_pce_field( 'Final heading', 'Make something people cannot ignore.' ),
						'landing_final_copy' => dkxv4_pce_field( 'Final copy', 'Tell us what you are launching, promoting or transforming. We will build the right combination of story, strategy and execution.' ),
						'landing_email' => dkxv4_pce_field( 'Email', 'advertise@dkexpressions.co.za', array( 'type' => 'email' ) ),
						'landing_phone' => dkxv4_pce_field( 'Phone display', '+27 72 246 0451', array( 'type' => 'text' ) ),
					),
				),
			),
		),
		'home' => array(
			'label' => 'Home Page / Editorial Command',
			'managed' => array(
				'Client logo strip' => 'Clients & Brands — edit each logo, title and display order there.',
				'Selected Work images' => 'Media Library — edit the title/caption and the “Show in Our Work” setting.',
				'Site Stats values' => 'DK Experience → Content → Site Metrics.',
			),
			'sections' => array(
				'hero' => array( 'label' => '01 / Hero', 'fields' => array(
					'home_hero_heading' => dkxv4_pce_field( 'Hero headline', 'We capture what others miss and turn it into work that moves people and brands.' ),
					'home_hero_copy' => dkxv4_pce_field( 'Hero introduction', 'Photography. Motion. Strategy. For events, hospitality, real estate and executive brands that refuse to look ordinary.' ),
					'home_hero_frame' => dkxv4_pce_field( 'Hero image caption', 'Documenting the people, places and moments that shaped the journey.' ),
				) ),
				'proof' => array( 'label' => '02 / Proof + Analytics', 'fields' => array(
					'home_stat_visits' => dkxv4_pce_field( 'Visits', '1.10M+', array( 'type' => 'text' ) ),
					'home_stat_pages' => dkxv4_pce_field( 'Pages viewed', '2.47M+', array( 'type' => 'text' ) ),
					'home_stat_hits' => dkxv4_pce_field( 'Hits', '6.13M+', array( 'type' => 'text' ) ),
					'home_proof_trust' => dkxv4_pce_field( 'Proof line', 'promoters, brands and artists since 2013' ),
					'home_analytics_heading' => dkxv4_pce_field( 'Analytics heading', 'Independent Server Analytics.' ),
					'home_analytics_period' => dkxv4_pce_field( 'Analytics period', 'September 2025–August 2026', array( 'type' => 'text' ) ),
					'home_live_visits' => dkxv4_pce_field( 'August visits', '97,603', array( 'type' => 'text' ) ),
				) ),
				'doors' => array( 'label' => '03 / Three Doors', 'fields' => array(
					'home_doors_heading' => dkxv4_pce_field( 'Section heading', 'Choose your path.' ),
					'home_agency_title' => dkxv4_pce_field( 'Agency title', 'For brands and events that need more than content.' ),
					'home_agency_copy' => dkxv4_pce_field( 'Agency copy', 'Strategy, photography, motion and ongoing partnership.' ),
					'home_media_title' => dkxv4_pce_field( 'Media title', 'Stories, culture and the work we publish.' ),
					'home_media_copy' => dkxv4_pce_field( 'Media copy', 'Entertainment, people, experiences and the stories shaping South Africa.' ),
					'home_vault_title' => dkxv4_pce_field( 'Time Vault title', 'See where we have travelled.' ),
					'home_vault_copy' => dkxv4_pce_field( 'Time Vault copy', 'Photography, motion and moments frozen across more than a decade.' ),
				) ),
				'work' => array( 'label' => '04 / Selected Work', 'fields' => array(
					'home_work_heading' => dkxv4_pce_field( 'Section heading', 'From the Time Vault.' ),
					'home_work_sub' => dkxv4_pce_field( 'Supporting line', 'Not stock. Not mock-ups. Not promises.' ),
				) ),
				'offers' => array( 'label' => '05 / Core Offers', 'fields' => array(
					'home_offers_heading' => dkxv4_pce_field( 'Section heading', 'How most clients work with us.' ),
					'home_event_price' => dkxv4_pce_field( 'Signature event price', 'R32,000', array( 'type' => 'text' ) ),
					'home_retainer_price' => dkxv4_pce_field( 'Core retainer price', 'R35,000', array( 'type' => 'text' ) ),
					'home_rate_note' => dkxv4_pce_field( 'Commercial note', 'All prices exclude VAT. 50% deposit.' ),
				) ),
				'conversion' => array( 'label' => '06 / Recommendations + Final Conversion', 'fields' => array(
					'home_quote_one' => dkxv4_pce_field( 'Big Concerts recommendation', 'Committed, passionate and dedicated to his craft.' ),
					'home_quote_two' => dkxv4_pce_field( 'One-Eyed Jack recommendation', 'Professional, reliable and a pleasure to work with on every project.' ),
					'home_final_heading' => dkxv4_pce_field( 'Final heading', 'Ready when you are.' ),
					'home_final_copy' => dkxv4_pce_field( 'Final copy', 'Tell us about the project, the event, or the brand. We respond within one business day.' ),
				) ),
			),
		),
		'solutions' => array(
			'label' => 'Solutions / Package Vault',
			'sections' => array(
				'hero' => array( 'label' => '01 / Hero + Analytics', 'fields' => array(
					'solutions_hero_heading' => dkxv4_pce_field( 'Hero heading', 'Choose the level of attention.' ),
					'solutions_hero_copy' => dkxv4_pce_field( 'Hero copy', 'Four focused solution systems. Twelve clear starting points. Built to make the moment, the brand and the name impossible to ignore.' ),
					'solutions_analytics_heading' => dkxv4_pce_field( 'Analytics heading', 'Independent Server Analytics.' ),
					'solutions_analytics_period' => dkxv4_pce_field( 'Analytics period', 'September 2025–August 2026', array( 'type' => 'text' ) ),
					'solutions_live_visits' => dkxv4_pce_field( 'August visits', '97,603', array( 'type' => 'text' ) ),
				) ),
			),
		),
		'our-work' => array(
			'label' => 'Our Work / The Vault',
			'managed' => array(
				'Gallery images and videos' => 'Media Library — edit the media title/caption and the “Show in Our Work” setting.',
				'Published stories' => 'Posts — edit the story itself under Posts.',
			),
			'sections' => array(
				'field-notes' => array( 'label' => '01 / Field Notes', 'fields' => array(
					'work_field_kicker' => dkxv4_pce_field( 'Kicker', 'Field Notes / South Africa & beyond' ),
					'work_field_heading' => dkxv4_pce_field( 'Hero heading', 'We went where the story lived.' ),
					'work_field_copy' => dkxv4_pce_field( 'Hero copy', 'A documentary trail through culture, music, performance and the human moments outside the official programme.' ),
					'work_wall_heading' => dkxv4_pce_field( 'Recovered prints heading', 'A wall of places we stood.' ),
				) ),
				'archive' => array( 'label' => '02 / Living Archive', 'fields' => array(
					'work_archive_kicker' => dkxv4_pce_field( 'Kicker', 'Living Archive / Time engine online' ),
					'work_archive_heading' => dkxv4_pce_field( 'Hero heading', 'Every frame is a portal.' ),
					'work_archive_copy' => dkxv4_pce_field( 'Hero copy', 'Thirteen years of culture, performance and motion—stored as living proof that we were there.' ),
					'work_memory_heading' => dkxv4_pce_field( 'Memory stream heading', 'Drag through documented time.' ),
					'work_motion_heading' => dkxv4_pce_field( 'Projection chamber heading', 'Memory in motion.' ),
				) ),
				'proof' => array( 'label' => '03 / Recommendations + Closing', 'fields' => array(
					'work_margin_heading' => dkxv4_pce_field( 'Recommendations heading', 'The names in the margins.' ),
					'work_quote_one' => dkxv4_pce_field( 'Big Concerts recommendation', '“Committed, passionate and dedicated to his craft.”' ),
					'work_quote_two' => dkxv4_pce_field( 'One-Eyed Jack recommendation', '“I highly recommend associating any brand with DK Expressions.”' ),
					'work_quote_three' => dkxv4_pce_field( 'VWV Massive recommendation', '“The photography and social media services had been outstanding.”' ),
					'work_final_heading' => dkxv4_pce_field( 'Final heading', 'Keep moving. Keep looking.' ),
					'work_final_copy' => dkxv4_pce_field( 'Final copy', 'New stories, recovered frames and work from the field.' ),
				) ),
			),
		),
		'industries' => array(
			'label' => 'Industries / Infinity Switchboard',
			'sections' => array(
				'hero' => array( 'label' => '01 / Hero + Publishing System', 'fields' => array(
					'industries_hero_heading' => dkxv4_pce_field( 'Hero heading', 'Different industries. One signal.' ),
					'industries_hero_copy' => dkxv4_pce_field( 'Hero copy', 'One obsession: attention. We start with the audience and the objective — not a generic marketing template.' ),
					'industries_channels_heading' => dkxv4_pce_field( 'Channels heading', 'Choose a channel. Build a stronger signal.' ),
					'industries_social_copy' => dkxv4_pce_field( 'Social Media Management copy', 'Strategy, content calendars, platform-native publishing, community management, paid amplification and performance reporting—managed as one continuous brand signal.' ),
					'industries_publishing_copy' => dkxv4_pce_field( 'Online Publishing copy', 'Editorial features, announcements, interviews, reviews and SEO-led stories published through the DK Expressions platform and built to remain discoverable beyond launch day.' ),
				) ),
			),
		),
		'insights' => array(
			'label' => 'Insights / Timecode Stream',
			'managed' => array(
				'Sticky slider' => 'Posts — mark or unmark a post as Sticky. Sticky posts always appear first.',
				'Category streams' => 'Posts → Categories — only children of the Press parent are displayed.',
				'Story cards' => 'Posts — edit the title, excerpt, featured image, date and assigned Press child category.',
			),
			'sections' => array(
				'hero' => array( 'label' => '01 / Hero', 'fields' => array(
					'insights_kicker' => dkxv4_pce_field( 'Kicker', dkxv4_content( 'insights_hero_kicker' ) ),
					'insights_title_1' => dkxv4_pce_field( 'Headline — first part', dkxv4_content( 'insights_hero_title_1' ) ),
					'insights_title_2' => dkxv4_pce_field( 'Headline — accent part', dkxv4_content( 'insights_hero_title_2' ) ),
					'insights_intro' => dkxv4_pce_field( 'Hero introduction', dkxv4_content( 'insights_hero_text' ) ),
				) ),
				'analytics' => array( 'label' => '02 / Analytics', 'fields' => array(
					'insights_analytics_heading' => dkxv4_pce_field( 'Heading', 'Independent Server Analytics.' ),
					'insights_analytics_period' => dkxv4_pce_field( 'Period', 'September 2025–August 2026', array( 'type' => 'text' ) ),
					'insights_live_visits' => dkxv4_pce_field( 'August visits', '97,603', array( 'type' => 'text' ) ),
				) ),
				'streams' => array( 'label' => '03 / Sticky + Category Streams', 'fields' => array(
					'insights_sticky_heading' => dkxv4_pce_field( 'Sticky section heading', 'Pinned to the signal.' ),
					'insights_sticky_copy' => dkxv4_pce_field( 'Sticky section copy', 'The stories currently held at the top of the DK Expressions editorial universe.' ),
					'insights_stream_heading' => dkxv4_pce_field( 'Category section heading', 'Every signal. One clear channel.' ),
					'insights_stream_copy' => dkxv4_pce_field( 'Category section copy', 'Four recent stories per category. Every post appears once, even when it carries multiple tags or categories.' ),
				) ),
			),
		),
		'about' => array(
			'label' => 'About Page',
			'sections' => array(
				'hero' => array( 'label' => '01 / Hero + Origin', 'fields' => array(
					'about_hero_heading' => dkxv4_pce_field( 'Hero heading', 'Not a media company. A time machine.' ),
					'about_hero_sub' => dkxv4_pce_field( 'Hero supporting line', 'DK Expressions began in Johannesburg in February 2013 with one camera, determination, and the belief that moments matter.' ),
					'about_hero_opening' => dkxv4_pce_field( 'Hero opening', 'Our Time Travellers capture culture as it happens and build stories that keep moving long after the lights go down.' ),
					'about_lead' => dkxv4_pce_field( 'Origin lead', 'Stories that move people. Experiences they will never forget.' ),
					'about_origin_heading' => dkxv4_pce_field( 'Origin heading', 'Born in Johannesburg. Built for everywhere.' ),
					'about_origin_one' => dkxv4_pce_field( 'Origin paragraph 1', 'DK Expressions started when founder Dale Kopping began capturing one experience at a time. What began as a single camera and a clear standard grew into an independent media, creative and brand-storytelling company.' ),
					'about_origin_two' => dkxv4_pce_field( 'Origin paragraph 2', 'Our Time Travellers move through entertainment, culture, events, hospitality, lifestyle, technology, real estate and beyond — preserving the emotion of each moment and turning it into work that continues travelling.' ),
					'about_origin_three' => dkxv4_pce_field( 'Origin paragraph 3', 'We combine photography, film, editorial, digital strategy and emerging technology into one connected creative experience.' ),
					'about_origin_four' => dkxv4_pce_field( 'Origin paragraph 4', 'We do not simply document what happened. We preserve what it felt like — and help brands turn that connection into legacy.' ),
				) ),
				'beliefs' => array( 'label' => '02 / Beliefs + How We Work', 'fields' => array(
					'about_belief_intro' => dkxv4_pce_field( 'Beliefs introduction', 'The tools have changed. The standard has not. These are the principles that keep every project honest, sharp and useful.' ),
					'about_belief_1' => dkxv4_pce_field( 'Belief 1', 'Coverage is not the same as content.' ),
					'about_belief_2' => dkxv4_pce_field( 'Belief 2', 'Pretty pictures that do nothing for the brand are a waste of everyone’s time.' ),
					'about_belief_3' => dkxv4_pce_field( 'Belief 3', 'Consistency beats occasional brilliance.' ),
					'about_belief_4' => dkxv4_pce_field( 'Belief 4', 'The best work usually happens when the client trusts us enough to get out of the way.' ),
					'about_belief_5' => dkxv4_pce_field( 'Belief 5', 'Fixed scopes and clear packages protect both sides.' ),
					'about_idea_1' => dkxv4_pce_field( 'Idea 1 — Inspired', 'Work that sparks emotion, ideas and action.' ),
					'about_idea_2' => dkxv4_pce_field( 'Idea 2 — Time Travellers', 'Creators who preserve the moments others might miss.' ),
					'about_idea_3' => dkxv4_pce_field( 'Idea 3 — Legacy Builders', 'Leadership focused on value that lives beyond the campaign.' ),
					'about_idea_4' => dkxv4_pce_field( 'Idea 4 — Inspire. Preserve. Build.', 'The idea behind every story, partnership and experience.' ),
					'about_how_intro' => dkxv4_pce_field( 'How we work introduction', 'Most clients begin with a single event or project. Many stay for retainers once they experience the difference.' ),
					'about_direct_copy' => dkxv4_pce_field( 'Direct communication copy', 'We prefer direct communication, defined deliverables and no hourly surprises.' ),
					'about_discipline_copy' => dkxv4_pce_field( 'Connected discipline copy', 'We work across multiple industries, but we apply the same discipline everywhere: start with the audience and the objective, then execute at a level that still holds up when the moment has passed.' ),
				) ),
				'team' => array( 'label' => '03 / Meet the Time Travellers', 'fields' => array(
					'about_team_intro' => dkxv4_pce_field( 'Team introduction', 'Different disciplines. Different personalities. One shared instinct: if something matters, capture it properly.' ),
					'about_dale_name' => dkxv4_pce_field( 'Dale — name', 'Dale Kopping', array( 'type' => 'text' ) ),
					'about_dale_role' => dkxv4_pce_field( 'Dale — role', 'Founder / Editor / International Photographer' ),
					'about_dale_bio' => dkxv4_pce_field( 'Dale — biography', 'Founder of DK Expressions. Photographer, publisher, strategist and professional collector of moments that should not disappear.', array( 'rows' => 4 ) ),
					'about_estelle_name' => dkxv4_pce_field( 'Estelle — name', 'Estelle Janse van Rensburg', array( 'type' => 'text' ) ),
					'about_estelle_role' => dkxv4_pce_field( 'Estelle — role', '2IC / Photojournalist / Content Creator / Client Liaison' ),
					'about_estelle_bio' => dkxv4_pce_field( 'Estelle — biography', 'Part of DK Expressions since 2014. Her first assignment was the Monster Motocross Nationals, where she captured more than 4,000 images in one weekend — and roughly 2,500 of them were strong enough to use. Hundreds of events and thousands of listings later, she remains one of the minds behind the machine.', array( 'rows' => 5 ) ),
					'about_craig_name' => dkxv4_pce_field( 'Craig — name', 'Craig Muscat', array( 'type' => 'text' ) ),
					'about_craig_role' => dkxv4_pce_field( 'Craig — role', 'Photojournalist / Content Creator / Mad Scientist' ),
					'about_craig_bio' => dkxv4_pce_field( 'Craig — biography', 'Joined the Time Travellers in 2023. First assignment: Sexpo. Then ULTRA, Comic Con, Calabash and more. Equal parts photojournalist, creator and mad scientist — with ideas that occasionally sound questionable for five seconds before turning out to be annoyingly good.', array( 'rows' => 5 ) ),
					'about_lucky_name' => dkxv4_pce_field( 'Lucky — name', 'Lucky Mthabela', array( 'type' => 'text' ) ),
					'about_lucky_role' => dkxv4_pce_field( 'Lucky — role', 'Photojournalist / PRETTIPIKTURES / Time Traveller' ),
					'about_lucky_bio' => dkxv4_pce_field( 'Lucky — biography', 'Joined the journey around 2015 after a chance meeting at an event in Marshalltown. What began with learning event photography became a full-time photographic career and PRETTIPIKTURES. Years of stages, artists and events later, the relationship is far closer to brotherhood than business.', array( 'rows' => 5 ) ),
				) ),
				'vault-join' => array( 'label' => '04 / Time Vault + Recruitment + Closing', 'fields' => array(
					'about_vault_copy' => dkxv4_pce_field( 'Time Vault copy', 'Everything we have shot over the years lives in the Time Vault. It is not a highlight reel designed to impress. It is a working archive of what we actually do when the lights go down and the pressure is on.' ),
					'about_join_heading' => dkxv4_pce_field( 'Recruitment heading', 'Think you belong in the timeline?' ),
					'about_join_copy' => dkxv4_pce_field( 'Recruitment copy', 'We are always interested in photographers, filmmakers, writers, creators, editors, strategists and wonderfully strange people who see the world differently.' ),
					'about_join_prompt' => dkxv4_pce_field( 'Recruitment prompt', 'Send us your portfolio — or tell us why you should be part of the team.' ),
					'about_final_heading' => dkxv4_pce_field( 'Final heading', 'We are still here. Still shooting. Still holding the same standard.' ),
				) ),
			),
		),
		'contact' => array(
			'label' => 'Contact / Start a Project',
			'sections' => array(
				'hero' => array( 'label' => '01 / Hero + Direct Contact', 'fields' => array(
					'contact_hero_heading' => dkxv4_pce_field( 'Hero heading', 'Tell us what you’re working on.' ),
					'contact_response' => dkxv4_pce_field( 'Response promise', 'We’ll respond within one business day.' ),
					'contact_direct_line' => dkxv4_pce_field( 'Direct conversation line', 'One clear brief. One direct conversation.' ),
					'contact_email_display' => dkxv4_pce_field( 'Email', dkxv4_content( 'contact_email' ), array( 'type' => 'email' ) ),
					'contact_phone_display' => dkxv4_pce_field( 'Phone display', '+27 72 246 0451', array( 'type' => 'text' ) ),
				) ),
				'brief' => array( 'label' => '02 / Brief Introduction', 'fields' => array(
					'contact_brief_heading' => dkxv4_pce_field( 'Section heading', 'Enough detail to find the signal.' ),
					'contact_brief_intro' => dkxv4_pce_field( 'Section introduction', 'Tell us what is happening, what needs to move and what success should look like. We will build the next conversation around that.' ),
					'contact_step_one' => dkxv4_pce_field( 'Step 1 helper', 'The project, event or brand challenge.' ),
					'contact_step_two' => dkxv4_pce_field( 'Step 2 helper', 'A date, launch window or “Flexible”.' ),
					'contact_step_three' => dkxv4_pce_field( 'Step 3 helper', 'Within one business day.' ),
				) ),
				'form' => array( 'label' => '03 / Form Labels + Microcopy', 'fields' => array(
					'contact_name_label' => dkxv4_pce_field( 'Name label', 'Full name', array( 'type' => 'text' ) ),
					'contact_name_help' => dkxv4_pce_field( 'Name helper', 'Your name', array( 'type' => 'text' ) ),
					'contact_email_label' => dkxv4_pce_field( 'Email label', 'Email address', array( 'type' => 'text' ) ),
					'contact_email_help' => dkxv4_pce_field( 'Email helper', 'We’ll reply here', array( 'type' => 'text' ) ),
					'contact_phone_label' => dkxv4_pce_field( 'Phone label', 'Phone', array( 'type' => 'text' ) ),
					'contact_phone_help' => dkxv4_pce_field( 'Phone helper', 'Prefer a call? Add your number', array( 'type' => 'text' ) ),
					'contact_company_label' => dkxv4_pce_field( 'Company label', 'Company or brand name', array( 'type' => 'text' ) ),
					'contact_company_help' => dkxv4_pce_field( 'Company helper', 'Optional but helpful', array( 'type' => 'text' ) ),
					'contact_project_label' => dkxv4_pce_field( 'Project type label', 'What do you need?', array( 'type' => 'text' ) ),
					'contact_timeline_label' => dkxv4_pce_field( 'Timeline label', 'When is it happening?', array( 'type' => 'text' ) ),
					'contact_budget_label' => dkxv4_pce_field( 'Budget label', 'Budget range', array( 'type' => 'text' ) ),
					'contact_referral_label' => dkxv4_pce_field( 'Referral label', 'How did you hear about us?', array( 'type' => 'text' ) ),
					'contact_message_label' => dkxv4_pce_field( 'Message label', 'Tell us more', array( 'type' => 'text' ) ),
					'contact_message_help' => dkxv4_pce_field( 'Message helper', 'Brief overview, location, goals, or anything we should know' ),
					'contact_submit' => dkxv4_pce_field( 'Submit button', 'Send Brief', array( 'type' => 'text' ) ),
					'contact_privacy' => dkxv4_pce_field( 'Privacy note', 'Your information is only used to respond to this enquiry.' ),
				) ),
				'success' => array( 'label' => '04 / Success State', 'fields' => array(
					'contact_success_heading' => dkxv4_pce_field( 'Success heading', 'Brief received.' ),
					'contact_success_copy' => dkxv4_pce_field( 'Success copy', 'Thank you. We’ve got it and will come back to you within one business day.' ),
				) ),
			),
		),
		'rates' => array(
			'label' => '2026 Rate Card',
			'sections' => array(
				'hero' => array( 'label' => '01 / Hero', 'fields' => array(
					'rates_hero_heading' => dkxv4_pce_field( 'Hero heading', 'Clear packages. Fixed scopes. No hourly surprises.' ),
					'rates_hero_copy' => dkxv4_pce_field( 'Hero copy', 'These are the rates we work with most often. Every package has a defined scope so you know exactly what you’re getting.' ),
					'rates_download_note' => dkxv4_pce_field( 'Download note', 'One-page overview · Updated 2026 · Excludes VAT' ),
					'rates_download_success' => dkxv4_pce_field( 'Download confirmation', 'Rate card downloaded. Ready when you are.' ),
				) ),
				'summary' => array( 'label' => '02 / Package Summary', 'fields' => array(
					'rates_summary_heading' => dkxv4_pce_field( 'Section heading', 'Choose the level of attention.' ),
					'rates_summary_copy' => dkxv4_pce_field( 'Section copy', 'A fast overview before you download. Custom combinations are available when the brief needs something different.' ),
					'rates_event_entry' => dkxv4_pce_field( 'Event Entry price', 'R6,500', array( 'type' => 'text' ) ),
					'rates_event_signature' => dkxv4_pce_field( 'Event Signature price', 'R32,000', array( 'type' => 'text' ) ),
					'rates_event_premium' => dkxv4_pce_field( 'Event Premium price', 'R95,000', array( 'type' => 'text' ) ),
					'rates_retainer_entry' => dkxv4_pce_field( 'Retainer Entry price', 'R15,000', array( 'type' => 'text' ) ),
					'rates_retainer_core' => dkxv4_pce_field( 'Retainer Core price', 'R35,000', array( 'type' => 'text' ) ),
					'rates_retainer_premium' => dkxv4_pce_field( 'Retainer Premium price', 'R60,000', array( 'type' => 'text' ) ),
				) ),
				'notes' => array( 'label' => '03 / Other Services + Commercial Notes', 'fields' => array(
					'rates_other_heading' => dkxv4_pce_field( 'Other services heading', 'Not every brief belongs in a box.' ),
					'rates_other_copy' => dkxv4_pce_field( 'Other services copy', 'Executive branding, hospitality content, real estate storytelling, campaign support and motion.' ),
					'rates_deposit_copy' => dkxv4_pce_field( 'Deposit note', 'Required to confirm the booking.' ),
					'rates_balance_copy' => dkxv4_pce_field( 'Balance note', 'Due on delivery or as agreed.' ),
					'rates_vat_copy' => dkxv4_pce_field( 'VAT note', 'All listed prices exclude VAT.' ),
					'rates_travel_copy' => dkxv4_pce_field( 'Travel note', 'Outside Johannesburg quoted separately.' ),
					'rates_custom_copy' => dkxv4_pce_field( 'Custom scope note', 'Available when the brief needs another scale.' ),
				) ),
				'final' => array( 'label' => '04 / Final Download', 'fields' => array(
					'rates_final_heading' => dkxv4_pce_field( 'Final heading', 'Your next project starts with clarity.' ),
					'rates_final_copy' => dkxv4_pce_field( 'Final copy', 'Download the one-page overview now. No form. No email gate. No waiting.' ),
				) ),
			),
		),
		'giveaways' => array(
			'label' => 'Giveaways / Competitions',
			'managed' => array(
				'Competition cards' => 'Giveaways — edit each competition, dates, prize, rules, image and status there.',
			),
			'sections' => array(
				'page-copy' => array( 'label' => '01 / Page Copy', 'fields' => array(
					'giveaways_kicker' => dkxv4_pce_field( 'Hero kicker', dkxv4_content( 'giveaways_kicker' ) ),
					'giveaways_title_1' => dkxv4_pce_field( 'Hero title — first part', dkxv4_content( 'giveaways_title_1' ) ),
					'giveaways_title_2' => dkxv4_pce_field( 'Hero title — accent part', dkxv4_content( 'giveaways_title_2' ) ),
					'giveaways_intro' => dkxv4_pce_field( 'Hero introduction', dkxv4_content( 'giveaways_intro' ) ),
					'giveaways_open' => dkxv4_pce_field( 'Open competitions heading', dkxv4_content( 'giveaways_open_heading' ) ),
					'giveaways_upcoming' => dkxv4_pce_field( 'Upcoming heading', dkxv4_content( 'giveaways_upcoming_heading' ) ),
					'giveaways_closed' => dkxv4_pce_field( 'Archive heading', dkxv4_content( 'giveaways_closed_heading' ) ),
					'giveaways_disclaimer' => dkxv4_pce_field( 'Disclaimer', dkxv4_content( 'giveaways_disclaimer' ), array( 'rows' => 4 ) ),
				) ),
			),
		),
	);

	$package_defaults = dkxv4_pce_package_defaults();
	foreach ( $package_defaults as $family_name => $family ) {
		$family_key = sanitize_key( $family_name );
		$fields = array(
			'solutions_' . $family_key . '_tagline' => dkxv4_pce_field( $family_name . ' tagline', $family['tagline'] ),
		);
		foreach ( $family['packages'] as $package_name => $package ) {
			$package_key = sanitize_key( $package_name );
			$prefix = 'solutions_' . $family_key . '_' . $package_key . '_';
			$fields[ $prefix . 'name' ] = dkxv4_pce_field( $package_name . ' — name', $package_name, array( 'type' => 'text' ) );
			$fields[ $prefix . 'price' ] = dkxv4_pce_field( $package_name . ' — price', $package[0], array( 'type' => 'text' ) );
			$fields[ $prefix . 'description' ] = dkxv4_pce_field( $package_name . ' — description', $package[2] );
			foreach ( $package[3] as $feature_index => $feature ) {
				$fields[ $prefix . 'feature_' . ( $feature_index + 1 ) ] = dkxv4_pce_field(
					$package_name . ' — feature ' . ( $feature_index + 1 ),
					$feature,
					array( 'type' => 'text', 'numeric_markup' => true )
				);
			}
		}
		$manifest['solutions']['sections'][ $family_key ] = array(
			'label' => sprintf( 'Package Family / %s', $family_name ),
			'fields' => $fields,
		);
	}

	$industries = array(
		array( 'Entertainment & Live Events', 'This is where DK Expressions was forged.', 'Concerts, festivals, comedy, theatre, exhibitions, international tours and cultural experiences. We understand the difference between simply announcing an event and making people feel that they cannot afford to miss it.', array( 'Event promotion', 'Artist features', 'Photography', 'Reviews', 'Social Media Management', 'Online Publishing', 'Competitions', 'Interviews', 'SEO' ) ),
		array( 'Music', 'From emerging performers to global stages.', 'Music has been part of the DK Expressions DNA since the beginning. Our journey has crossed paths with John Legend, Carlos Santana, Bruce Springsteen, Justin Bieber, Michael Bublé, One Direction, Foo Fighters, UB40 and many more.', array( 'Live coverage', 'Artist storytelling', 'Photography', 'Tour announcements', 'Social Media Management', 'Online Publishing' ) ),
		array( 'Film, Theatre & Performing Arts', 'Extend the experience beyond the venue.', 'From premieres and productions to reviews and interviews, we create content that communicates the emotion and spectacle of live performance and screen entertainment.', array( 'Reviews', 'Premieres', 'Production coverage', 'Interviews' ) ),
		array( 'Technology & Gaming', 'Specifications tell. Stories explain why it matters.', 'Technology launches, product experiences, reviews, gaming coverage and digital storytelling that translates technical products into human experiences.', array( 'Launches', 'Reviews', 'Product storytelling', 'Gaming' ) ),
		array( 'Lifestyle & Hospitality', 'Sell the feeling, not only the features.', 'Photography, editorial and digital campaigns for hospitality, travel, lifestyle and experience-driven businesses.', array( 'Photography', 'Editorial', 'Experiences', 'Digital campaigns', 'Social Media Management', 'Online Publishing' ) ),
		array( 'Property & Real Estate', 'Turn property into opportunity.', 'Visual storytelling, digital advertising, copywriting, social content and campaign strategy that transform properties into compelling opportunities.', array( 'Property photography', 'Listing content', 'Social campaigns', 'Digital advertising' ) ),
		array( 'Corporate & B2B', 'Corporate communication does not have to feel corporate.', 'We translate complex propositions into clear, engaging stories through executive positioning, events, content, photography and digital campaigns.', array( 'Executive positioning', 'Events', 'Content', 'Photography', 'Digital campaigns', 'Social Media Management', 'Online Publishing' ) ),
		array( 'Web & AI', 'Infrastructure that compounds.', 'We design and build websites, digital platforms and practical AI systems that reduce friction, increase output and give brands a measurable edge. No buzzwords. Just tools that perform.', array( 'Website design & development', 'AI-assisted content systems', 'Workflow automation', 'Custom GPTs & agents', 'Platform architecture', 'Online Publishing systems', 'Performance & conversion optimisation' ) ),
	);
	foreach ( $industries as $industry_index => $industry ) {
		$key = 'industry_' . ( $industry_index + 1 );
		$manifest['industries']['sections'][ $key ] = array(
			'label' => sprintf( '%02d / %s', $industry_index + 1, $industry[0] ),
			'fields' => array(
				$key . '_name' => dkxv4_pce_field( 'Industry name', $industry[0], array( 'type' => 'text' ) ),
				$key . '_signal' => dkxv4_pce_field( 'Signal statement', $industry[1] ),
				$key . '_copy' => dkxv4_pce_field( 'Industry description', $industry[2], array( 'rows' => 4 ) ),
				$key . '_services' => dkxv4_pce_field( 'Services — one per line', implode( "\n", $industry[3] ), array( 'type' => 'list', 'rows' => max( 5, count( $industry[3] ) ) ) ),
			),
		);
	}

	$booking_fields = array(
		'booking_label' => dkxv4_pce_field( 'Booking label', 'Currently booking', array( 'type' => 'text' ) ),
		'booking_period' => dkxv4_pce_field( 'Booking period', 'Q3 & Q4', array( 'type' => 'text' ) ),
		'booking_only' => dkxv4_pce_field( 'Scarcity prefix', 'Only', array( 'type' => 'text' ) ),
		'booking_count' => dkxv4_pce_field( 'Retainer slots available', '5', array( 'type' => 'text' ) ),
		'booking_slots' => dkxv4_pce_field( 'Scarcity description', 'retainer slots left for', array( 'type' => 'text' ) ),
		'booking_months' => dkxv4_pce_field( 'Booking months', 'September–October', array( 'type' => 'text' ) ),
	);
	foreach ( array( 'landing', 'home', 'solutions' ) as $booking_page ) {
		$manifest[ $booking_page ]['sections']['booking'] = array(
			'label' => 'Current Booking Availability',
			'fields' => $booking_fields,
		);
	}

	$manifest['industries']['managed'] = array(
		'Package Vault' => 'The package names, rates and features are controlled on the Solutions Page and are mirrored here automatically.',
	);

	return $manifest;
}

/**
 * Resolve the manifest key for a Page in wp-admin or on the frontend.
 */
function dkxv4_page_content_key( $post_id = 0 ) {
	$post_id = absint( $post_id ?: get_queried_object_id() );
	if ( $post_id && $post_id === absint( get_option( 'page_on_front' ) ) ) {
		return 'landing';
	}
	$slug = $post_id ? get_post_field( 'post_name', $post_id ) : '';
	if ( 'competitions' === $slug ) {
		return 'giveaways';
	}
	return sanitize_key( $slug );
}

/**
 * Flatten the sections for save and rendering operations.
 */
function dkxv4_page_content_fields( $page_key ) {
	$manifest = dkxv4_page_content_manifest();
	$fields = array();
	foreach ( $manifest[ $page_key ]['sections'] ?? array() as $section ) {
		$fields = array_merge( $fields, $section['fields'] ?? array() );
	}
	return $fields;
}

/**
 * Add the backend editor only to pages controlled by a DK template.
 */
function dkxv4_page_content_meta_box() {
	global $post;
	if ( ! $post || 'page' !== $post->post_type ) {
		return;
	}
	$manifest = dkxv4_page_content_manifest();
	if ( isset( $manifest[ dkxv4_page_content_key( $post->ID ) ] ) ) {
		add_meta_box( 'dkx-page-content', 'DK Page Content — Live Frontend Copy', 'dkxv4_render_page_content_meta_box', 'page', 'normal', 'high' );
	}
}
add_action( 'add_meta_boxes_page', 'dkxv4_page_content_meta_box' );

/**
 * Render the visible, populated Page editing workspace.
 */
function dkxv4_render_page_content_meta_box( $post ) {
	$manifest = dkxv4_page_content_manifest();
	$page_key = dkxv4_page_content_key( $post->ID );
	$page = $manifest[ $page_key ] ?? array();
	wp_nonce_field( 'dkxv4_page_content', 'dkxv4_page_content_nonce' );
	?>
	<div class="dkx-pce" data-dkx-page-content-editor>
		<header class="dkx-pce__hero">
			<div><span>DK / BACKEND EDITOR</span><h2><?php echo esc_html( $page['label'] ?? 'Page Content' ); ?></h2></div>
			<p>Everything below controls the words on the live custom frontend. The approved DK layout, typography, colour and motion system stay locked.</p>
		</header>
		<?php if ( ! empty( $page['managed'] ) ) : ?>
		<section class="dkx-pce__managed">
			<h3>Dynamic content managed elsewhere</h3>
			<div><?php foreach ( $page['managed'] as $label => $instruction ) : ?><p><strong><?php echo esc_html( $label ); ?></strong><span><?php echo esc_html( $instruction ); ?></span></p><?php endforeach; ?></div>
		</section>
		<?php endif; ?>
		<div class="dkx-pce__tools"><button type="button" class="button" data-dkx-expand>Expand all sections</button><button type="button" class="button" data-dkx-collapse>Collapse all</button><span>Save with the normal <strong>Update</strong> button.</span></div>
		<div class="dkx-pce__sections">
		<?php $section_index = 0; foreach ( $page['sections'] ?? array() as $section ) : $section_index++; ?>
			<details class="dkx-pce__section" <?php echo 1 === $section_index ? 'open' : ''; ?>>
				<summary><span><?php echo esc_html( str_pad( (string) $section_index, 2, '0', STR_PAD_LEFT ) ); ?></span><strong><?php echo esc_html( $section['label'] ?? 'Section' ); ?></strong><i>+</i></summary>
				<div class="dkx-pce__fields">
				<?php foreach ( $section['fields'] ?? array() as $key => $field ) :
					$meta_key = '_dkx_page_' . $key;
					$value = metadata_exists( 'post', $post->ID, $meta_key ) ? get_post_meta( $post->ID, $meta_key, true ) : $field['default'];
					$type = in_array( $field['type'], array( 'text', 'email', 'url' ), true ) ? $field['type'] : 'textarea';
				?>
					<label class="dkx-pce__field">
						<span><?php echo esc_html( $field['label'] ); ?></span>
						<?php if ( 'textarea' === $type ) : ?>
						<textarea rows="<?php echo esc_attr( (string) $field['rows'] ); ?>" name="dkx_page_fields[<?php echo esc_attr( $key ); ?>]" data-default="<?php echo esc_attr( $field['default'] ); ?>"><?php echo esc_textarea( $value ); ?></textarea>
						<?php else : ?>
						<input type="<?php echo esc_attr( $type ); ?>" name="dkx_page_fields[<?php echo esc_attr( $key ); ?>]" value="<?php echo esc_attr( $value ); ?>" data-default="<?php echo esc_attr( $field['default'] ); ?>">
						<?php endif; ?>
						<small><button type="button" class="button-link" data-dkx-reset>Restore approved text</button></small>
					</label>
				<?php endforeach; ?>
				</div>
			</details>
		<?php endforeach; ?>
		</div>
	</div>
	<?php
}

/**
 * Save only fields present in the manifest for this Page.
 */
function dkxv4_save_page_content_meta( $post_id ) {
	if ( ! isset( $_POST['dkxv4_page_content_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['dkxv4_page_content_nonce'] ) ), 'dkxv4_page_content' ) ) {
		return;
	}
	if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || wp_is_post_revision( $post_id ) || ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	$allowed = dkxv4_page_content_fields( dkxv4_page_content_key( $post_id ) );
	$posted = isset( $_POST['dkx_page_fields'] ) ? (array) wp_unslash( $_POST['dkx_page_fields'] ) : array();
	foreach ( $allowed as $key => $field ) {
		if ( ! array_key_exists( $key, $posted ) ) {
			continue;
		}
		$value = ( 'url' === $field['type'] ) ? esc_url_raw( $posted[ $key ] ) : sanitize_textarea_field( $posted[ $key ] );
		update_post_meta( $post_id, '_dkx_page_' . $key, $value );
	}
}
add_action( 'save_post_page', 'dkxv4_save_page_content_meta' );

/**
 * Mark numbers in package feature copy while preserving the approved styling.
 */
function dkxv4_pce_numeric_markup( $value ) {
	return preg_replace( '/(?<![A-Za-z])([0-9]+(?:[.,][0-9]+)?)(?![A-Za-z])/', '<strong>$1</strong>', esc_html( $value ) );
}

/**
 * Render a line-based service list in the structure expected by Industries.
 */
function dkxv4_pce_list_markup( $value ) {
	$items = array_filter( array_map( 'trim', preg_split( '/\r\n|\r|\n/', (string) $value ) ) );
	$html = '<ul class="dkxip-services">';
	foreach ( $items as $item ) {
		$html .= '<li>' . esc_html( $item ) . '</li>';
	}
	return $html . '</ul>';
}

/**
 * Compare visible text without allowing template markup to hide a match.
 */
function dkxv4_pce_normalize_text( $value ) {
	$value = html_entity_decode( wp_strip_all_tags( (string) $value ), ENT_QUOTES | ENT_HTML5, 'UTF-8' );
	$value = preg_replace( '/\s+/u', ' ', $value );
	return trim( $value );
}

/**
 * Reflow edited heading copy through the original line/accent structure.
 */
function dkxv4_pce_preserve_inline_markup( $original, $value ) {
	if ( false === strpos( $original, '<' ) ) {
		return esc_html( $value );
	}
	$templates = preg_split( '/<br\s*\/?\s*>/i', (string) $original );
	$provided = preg_split( '/\r\n|\r|\n/', (string) $value );
	if ( count( $provided ) === count( $templates ) ) {
		$lines = $provided;
	} else {
		$words = preg_split( '/\s+/u', trim( (string) $value ) );
		$counts = array_map(
			static function ( $line ) {
				return max( 1, count( preg_split( '/\s+/u', dkxv4_pce_normalize_text( $line ) ) ) );
			},
			$templates
		);
		$total = max( 1, array_sum( $counts ) );
		$lines = array();
		$offset = 0;
		foreach ( $counts as $index => $count ) {
			$take = ( count( $counts ) - 1 === $index ) ? count( $words ) - $offset : max( 1, (int) round( count( $words ) * ( $count / $total ) ) );
			$lines[] = implode( ' ', array_slice( $words, $offset, $take ) );
			$offset += $take;
		}
	}

	$rendered = array();
	foreach ( $templates as $index => $template ) {
		$line = $lines[ $index ] ?? '';
		if ( preg_match( '/^\s*<(em|strong|b)[^>]*>.*<\/\1>\s*$/is', $template, $wrapper ) ) {
			$rendered[] = '<' . $wrapper[1] . '>' . esc_html( $line ) . '</' . $wrapper[1] . '>';
			continue;
		}
		if ( preg_match( '/^(.*)<(em|strong|b)[^>]*>(.*)<\/\2>(.*)$/is', $template, $parts ) ) {
			$before_count = count( preg_split( '/\s+/u', dkxv4_pce_normalize_text( $parts[1] ) ) );
			$line_words = preg_split( '/\s+/u', trim( $line ) );
			$before_count = min( max( 0, $before_count ), count( $line_words ) );
			$before = implode( ' ', array_slice( $line_words, 0, $before_count ) );
			$accent = implode( ' ', array_slice( $line_words, $before_count ) );
			$rendered[] = esc_html( $before ) . ( $before && $accent ? ' ' : '' ) . '<' . $parts[2] . '>' . esc_html( $accent ) . '</' . $parts[2] . '>';
			continue;
		}
		$rendered[] = esc_html( $line );
	}
	return implode( '<br>', $rendered );
}

/**
 * Replace copy that is split by <br>, <em> or <strong> while retaining style.
 */
function dkxv4_pce_replace_element_text( $content, $default, $value ) {
	$tags = 'h1|h2|h3|h4|h5|h6|p|blockquote|a|span|strong|b|small|li|footer';
	return preg_replace_callback(
		'#<(' . $tags . ')(\s[^>]*)?>(.*?)</\1>#is',
		static function ( $match ) use ( $default, $value ) {
			if ( dkxv4_pce_normalize_text( $match[3] ) !== dkxv4_pce_normalize_text( $default ) ) {
				return $match[0];
			}
			return '<' . $match[1] . ( $match[2] ?? '' ) . '>' . dkxv4_pce_preserve_inline_markup( $match[3], $value ) . '</' . $match[1] . '>';
		},
		$content
	);
}

/**
 * Replace approved defaults only inside the page's main content element.
 */
function dkxv4_apply_page_content_overrides( $html ) {
	$page_id = get_queried_object_id();
	$page_key = dkxv4_page_content_key( $page_id );
	$fields = dkxv4_page_content_fields( $page_key );
	if ( ! $fields ) {
		return $html;
	}
	$main_start = strpos( $html, '<main' );
	$main_end = strrpos( $html, '</main>' );
	if ( false === $main_start || false === $main_end || $main_end <= $main_start ) {
		$main_start = 0;
		$main_end = strlen( $html );
		$main_close_length = 0;
	} else {
		$main_close_length = strlen( '</main>' );
	}
	$main_end += $main_close_length;
	$before = substr( $html, 0, $main_start );
	$content = substr( $html, $main_start, $main_end - $main_start );
	$after = substr( $html, $main_end );

	$sources = array( array( $page_id, $fields ) );
	if ( 'industries' === $page_key ) {
		$solutions_page = get_page_by_path( 'solutions' );
		if ( $solutions_page ) {
			$sources[] = array( $solutions_page->ID, dkxv4_page_content_fields( 'solutions' ) );
		}
	}
	foreach ( $sources as $source ) {
	$source_page_id = absint( $source[0] );
	foreach ( $source[1] as $key => $field ) {
		$meta_key = '_dkx_page_' . $key;
		if ( ! metadata_exists( 'post', $source_page_id, $meta_key ) ) {
			continue;
		}
		$value = (string) get_post_meta( $source_page_id, $meta_key, true );
		$default = (string) $field['default'];
		if ( $value === $default ) {
			continue;
		}

		if ( 'list' === $field['type'] ) {
			$target = dkxv4_pce_list_markup( $default );
			$replacement = dkxv4_pce_list_markup( $value );
			$content = str_replace( $target, $replacement, $content );
			continue;
		}

		if ( ! empty( $field['numeric_markup'] ) ) {
			$target = dkxv4_pce_numeric_markup( $default );
			$replacement = dkxv4_pce_numeric_markup( $value );
			$content = str_replace( $target, $replacement, $content );
			continue;
		}

		$content = dkxv4_pce_replace_element_text( $content, $default, $value );

		$replacement = esc_html( $value );
		$targets = array_unique(
			array(
				$default,
				esc_html( $default ),
				str_replace( "\n", '<br>', esc_html( $default ) ),
				str_replace( "\n", "<br>\n", esc_html( $default ) ),
			)
		);
		foreach ( $targets as $target ) {
			if ( '' !== $target && false !== strpos( $content, $target ) ) {
				$content = str_replace( $target, $replacement, $content );
			}
		}
	}
	}
	return $before . $content . $after;
}

/**
 * Buffer only custom Page templates on public requests.
 */
function dkxv4_begin_page_content_buffer() {
	if ( is_admin() || wp_doing_ajax() || is_feed() || ! is_singular( 'page' ) ) {
		return;
	}
	if ( dkxv4_page_content_fields( dkxv4_page_content_key() ) ) {
		ob_start( 'dkxv4_apply_page_content_overrides' );
	}
}
add_action( 'template_redirect', 'dkxv4_begin_page_content_buffer', 0 );

/**
 * Page editor presentation and small interaction helpers.
 */
function dkxv4_page_content_admin_assets( $hook ) {
	if ( ! in_array( $hook, array( 'post.php', 'post-new.php' ), true ) ) {
		return;
	}
	$screen = get_current_screen();
	if ( ! $screen || 'page' !== $screen->post_type ) {
		return;
	}
	$css = '.dkx-pce{--blue:#32b5ff;--gold:#ffc044;--purple:#9b70ff;--red:#ff4454;background:#06121c;color:#eaf5ff;margin:-6px -12px -12px;padding:24px;font-family:Inter,Arial,sans-serif}.dkx-pce__hero{display:grid;grid-template-columns:minmax(0,1fr) minmax(280px,.7fr);gap:32px;padding:26px;border:1px solid #1d4d6b;background:linear-gradient(135deg,#081b2a,#070c13)}.dkx-pce__hero span{color:var(--blue);font-size:11px;font-weight:900;letter-spacing:.2em}.dkx-pce__hero h2{color:#fff;font-size:28px;line-height:1;margin:10px 0 0;text-transform:uppercase}.dkx-pce__hero p{color:#a9bdca;font-size:14px;line-height:1.7;margin:0}.dkx-pce__managed{border:1px solid #715a23;background:#171307;padding:20px 24px;margin-top:18px}.dkx-pce__managed h3{color:var(--gold);font-size:13px;letter-spacing:.12em;text-transform:uppercase}.dkx-pce__managed div{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:12px}.dkx-pce__managed p{margin:0;padding:12px;background:#0b1118}.dkx-pce__managed strong,.dkx-pce__managed span{display:block}.dkx-pce__managed strong{color:#fff}.dkx-pce__managed span{color:#9eb2c0;margin-top:5px;line-height:1.5}.dkx-pce__tools{display:flex;align-items:center;gap:10px;margin:20px 0}.dkx-pce__tools span{color:#9eb2c0;margin-left:auto}.dkx-pce__section{border:1px solid #183d54;margin:0 0 12px;background:#071018}.dkx-pce__section summary{align-items:center;cursor:pointer;display:grid;grid-template-columns:44px 1fr 30px;gap:12px;padding:18px 20px;list-style:none}.dkx-pce__section summary::-webkit-details-marker{display:none}.dkx-pce__section summary>span{color:var(--blue);font-weight:900}.dkx-pce__section summary>strong{color:#fff;font-size:14px;letter-spacing:.08em;text-transform:uppercase}.dkx-pce__section summary>i{color:var(--gold);font-size:24px;font-style:normal}.dkx-pce__section[open] summary>i{transform:rotate(45deg)}.dkx-pce__fields{border-top:1px solid #183d54;display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:18px;padding:22px}.dkx-pce__field{display:flex;flex-direction:column;gap:7px}.dkx-pce__field>span{color:#dceaf4;font-size:12px;font-weight:800;letter-spacing:.04em}.dkx-pce__field input,.dkx-pce__field textarea{background:#03090e!important;border:1px solid #31576e!important;border-radius:0!important;color:#fff!important;font-family:inherit!important;font-size:14px!important;line-height:1.55!important;padding:12px!important;width:100%}.dkx-pce__field input:focus,.dkx-pce__field textarea:focus{border-color:var(--blue)!important;box-shadow:0 0 0 1px var(--blue)!important}.dkx-pce__field small{text-align:right}.dkx-pce__field .button-link{color:var(--gold)}@media(max-width:782px){.dkx-pce{padding:14px}.dkx-pce__hero{grid-template-columns:1fr;padding:20px}.dkx-pce__fields{grid-template-columns:1fr;padding:16px}.dkx-pce__tools{align-items:flex-start;flex-wrap:wrap}.dkx-pce__tools span{margin-left:0;width:100%}}';
	wp_register_style( 'dkx-page-content-editor', false, array(), '1.25.0' );
	wp_enqueue_style( 'dkx-page-content-editor' );
	wp_add_inline_style( 'dkx-page-content-editor', $css );
	$js = "document.addEventListener('click',function(e){var root=e.target.closest('[data-dkx-page-content-editor]');if(!root)return;if(e.target.matches('[data-dkx-expand]'))root.querySelectorAll('details').forEach(function(d){d.open=true});if(e.target.matches('[data-dkx-collapse]'))root.querySelectorAll('details').forEach(function(d){d.open=false});if(e.target.matches('[data-dkx-reset]')){var field=e.target.closest('label').querySelector('[data-default]');field.value=field.dataset.default;field.dispatchEvent(new Event('change',{bubbles:true}));}});";
	wp_add_inline_script( 'jquery-core', $js, 'after' );
}
add_action( 'admin_enqueue_scripts', 'dkxv4_page_content_admin_assets' );
