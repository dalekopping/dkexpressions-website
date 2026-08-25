<?php
/**
 * Plugin Name: DK Expressions SEO Foundations
 * Description: Launch-critical title tags, meta descriptions, canonical URLs and structured data.
 * Version: 1.0.0
 * Author: DK Expressions
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

function dkx_launch_seo_map() {
	return array(
		'landing' => array('title'=>'Event Photography & Brand Storytelling | DK Expressions','description'=>'Premium event photography, brand content and storytelling in Johannesburg since 2013. Fixed packages from R6,500. Start your project today.','canonical'=>home_url('/')),
		'solutions' => array('title'=>'Brand Content, Event Coverage & Retainers | DK Expressions','description'=>'Strategy, photography, film and ongoing brand retainers. Clear packages, fixed scopes, no hourly surprises. Johannesburg & beyond.','canonical'=>home_url('/solutions/')),
		'industries' => array('title'=>'Industries We Serve | Entertainment, Hospitality, Property & More','description'=>'DK Expressions works across live events, music, hospitality, real estate, corporate and web & AI. One obsession: attention.','canonical'=>home_url('/industries/')),
		'our-work' => array('title'=>'Time Vault – 13 Years of Captured Moments | DK Expressions','description'=>'Real photography and film from concerts, festivals, theatre and brands since 2013. Not stock. Not mock-ups. See the work.','canonical'=>home_url('/our-work/')),
		'rates' => array('title'=>'2026 Rate Card – Clear Packages, Fixed Scopes | DK Expressions','description'=>'Event Domination from R6,500. Brand Retainers from R15,000/month. Download the full 2026 rate card. No hourly surprises.','canonical'=>home_url('/rates/')),
		'about' => array('title'=>'About DK Expressions – Time Travellers Since 2013','description'=>'Not a media company. A time machine. Founded in Johannesburg in 2013. Meet the team and the standard behind the work.','canonical'=>home_url('/about/')),
		'contact' => array('title'=>'Start a Project | DK Expressions Johannesburg','description'=>'Tell us what you’re working on. We respond within one business day. No automated replies. Just a clear brief and a direct conversation.','canonical'=>home_url('/contact/')),
		'insights' => array('title'=>'Insights – News, Reviews & Stories | DK Expressions','description'=>'Entertainment news, interviews, reviews, event coverage and industry notes from the rooms we are in.','canonical'=>home_url('/insights/')),
	);
}
function dkx_launch_page_key() {
	if ( is_front_page() || is_page('home') ) return 'landing';
	foreach ( array('solutions','industries','our-work','rates','about','contact','insights') as $slug ) if ( is_page($slug) ) return $slug;
	return '';
}
function dkx_launch_current_seo() {
	$key=dkx_launch_page_key(); $map=dkx_launch_seo_map(); return ($key && isset($map[$key])) ? $map[$key] : array();
}
add_filter('pre_get_document_title',function($title){$seo=dkx_launch_current_seo();return !empty($seo['title'])?$seo['title']:$title;},99);
add_filter('wpseo_title',function($title){$seo=dkx_launch_current_seo();return !empty($seo['title'])?$seo['title']:$title;},99);
add_filter('wpseo_metadesc',function($value){$seo=dkx_launch_current_seo();return !empty($seo['description'])?$seo['description']:$value;},99);
add_filter('wpseo_canonical',function($value){$seo=dkx_launch_current_seo();return !empty($seo['canonical'])?$seo['canonical']:$value;},99);
add_filter('rank_math/frontend/title',function($title){$seo=dkx_launch_current_seo();return !empty($seo['title'])?$seo['title']:$title;},99);
add_filter('rank_math/frontend/description',function($value){$seo=dkx_launch_current_seo();return !empty($seo['description'])?$seo['description']:$value;},99);
add_filter('rank_math/frontend/canonical',function($value){$seo=dkx_launch_current_seo();return !empty($seo['canonical'])?$seo['canonical']:$value;},99);
add_action('wp_head',function(){
	$seo=dkx_launch_current_seo(); if(empty($seo)) return;
	if(!defined('WPSEO_VERSION')&&!defined('RANK_MATH_VERSION')){
		echo "\n<meta name=\"description\" content=\"".esc_attr($seo['description'])."\">\n<link rel=\"canonical\" href=\"".esc_url($seo['canonical'])."\">\n";
	}
},2);

add_action('wp_head',function(){
	if(is_admin()) return;
	$site=home_url('/'); $id=trailingslashit($site).'#organization'; $logo=function_exists('dkx_logo_url')?dkx_logo_url():'';
	$graph=array(array(
		'@type'=>array('Organization','LocalBusiness'),'@id'=>$id,'name'=>'DK Expressions','url'=>$site,'logo'=>$logo,'image'=>$logo,
		'description'=>'Premium culture, content, event photography and brand storytelling company founded in Johannesburg in 2013.','foundingDate'=>'2013-02',
		'email'=>'dale@dkexpressions.co.za','telephone'=>'+27 72 246 0451',
		'address'=>array('@type'=>'PostalAddress','addressLocality'=>'Johannesburg','addressRegion'=>'Gauteng','addressCountry'=>'ZA'),
		'areaServed'=>array(array('@type'=>'Country','name'=>'South Africa'),array('@type'=>'City','name'=>'Johannesburg'))
	));
	if(is_page(array('solutions','rates'))){
		foreach(array(
			array('Event Domination','Event photography, live content and brand storytelling with fixed project scopes.','6500','Event Coverage'),
			array('Brand Retainer','Ongoing photography, film, editorial and brand content retainers with defined monthly scopes.','15000','Brand Content Retainer')
		) as $service){
			$graph[]=array('@type'=>'Service','name'=>$service[0],'description'=>$service[1],'provider'=>array('@id'=>$id),'serviceType'=>$service[3],'areaServed'=>'South Africa','offers'=>array('@type'=>'Offer','priceCurrency'=>'ZAR','price'=>$service[2],'url'=>is_page('rates')?home_url('/rates/'):home_url('/solutions/'),'availability'=>'https://schema.org/InStock'));
		}
	}
	if(is_page('our-work')){
		$graph[]=array('@type'=>'Review','name'=>'Big Concerts / The Publicity Workshop recommendation','author'=>array('@type'=>'Organization','name'=>'Big Concerts / The Publicity Workshop'),'itemReviewed'=>array('@id'=>$id),'reviewBody'=>'Committed, passionate and dedicated to his craft.');
		$graph[]=array('@type'=>'Review','name'=>'One-Eyed Jack recommendation','author'=>array('@type'=>'Organization','name'=>'One-Eyed Jack'),'itemReviewed'=>array('@id'=>$id),'reviewBody'=>'I highly recommend associating any brand with DK Expressions.');
	}
	echo "\n<script type=\"application/ld+json\">".wp_json_encode(array('@context'=>'https://schema.org','@graph'=>$graph),JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE)."</script>\n";
},25);

add_filter('wpseo_robots',function($robots){if(is_page('home')&&!is_front_page()) return 'noindex, follow';return $robots;},99);
