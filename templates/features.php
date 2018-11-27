<?php
use AMPforWP\AMPVendor\AMP_DOM_Utils;
use AMPforWP\AMPVendor\AMP_Content;
/* This file will contain all the Extra FEATURES.
0.9. AMP Design Manager Files
	1. Add Home REL canonical
	2. Custom Design
	3. Custom Style files
	4. Custom Header files
		4.1 Custom Meta-Author files
		4.2 Custom Meta-Taxonomy files
		4.5 Added hook to add more layout.
	5. Customize with Width of the site
	6. Add required Javascripts for extra AMP features
		6.1 Adding Analytics Scripts
	7. Footer for AMP Pages
	8. Add Main tag as a Wrapper ( removed in 0.8.9 )
	9. Advertisement code
	10. Analytics Area
		10.1  Analytics Support added for Google Analytics
		10.2  Analytics Support added for segment.com
		10.3  Analytics Support added for Piwik
		10.4  Analytics Support added for quantcast
		10.5  Analytics Support added for comscore
		10.6  Analytics Support added for Effective Measure
		10.7  Analytics Support added for StatCounter
		10.8  Analytics Support added for Histats Analytics
		10.9  Analytics Support added for Yandex Metrika
		10.10 Analytics Support added for Chartbeat Analytics
		10.11 Analytics Support added for Alexa Metrics
	11. Strip unwanted codes and tags from the_content
	12. Add Logo URL in the structured metadata
	13. Add Custom Placeholder Image for Structured Data.
	14. Adds a meta box to the post editing screen for AMP on-off on specific pages.
	15. Disable New Relic's extra script that its adds in AMP pages.
	16. Remove Unwanted Scripts
	17. Archives Canonical in AMP version
	18. Custom Canonical for Homepage
	19. Remove Canonical tags
	20. Remove the default Google font for performance ( removed in 0.8.9 )
	21. Remove Schema data from All In One Schema.org Rich Snippets Plugin
	22. Removing author links from comments Issue #180
	23. The analytics tag appears more than once in the document. This will soon be an error
	24. Seperate Sticky Single Social Icons
	25. Yoast meta Support
	26. Extending Title Tagand De-Hooking the Standard one from AMP
    27. Fixing the defer tag issue [Finally!]
    28. Properly removes AMP if turned off from Post panel
    29. Remove analytics code if Already added by Glue or Yoast SEO
    30. TagDiv menu issue removed
    31. removing scripts added by cleantalk
    32. various lazy loading plugins Support
    33. Google tag manager support added
    34. social share boost compatibility Ticket #387
	35. Disqus Comments Support
	36. remove photon support in AMP
	37. compatibility with wp-html-compression
	38. #529 editable archives
  	39. #560 Header and Footer Editable html enabled script area
  	40. Meta Robots
  	41. Rewrite URL only on save #511
	42. registeing AMP sidebars
	43. custom actions for widgets output
	44. auto adding /amp for the menu
	45. search,frontpage,homepage structured data
	46. search search search everywhere #615
	47. social js properly adding when required
	48. Remove all unwanted scripts on search pages
	49. Properly adding ad Script the AMP way
	50. Properly adding noditification Scritps the AMP way
	51. Adding Digg Digg compatibility with AMP
	52. Adding a generalized sanitizer function for purifiying normal html to amp-html
	53. Removed AMP-WooCommerce Code and added it in AMP-WooCommerce #929
	54. Change the default values of post meta for AMP pages.
	55. Call Now Button Feature added
	56. Multi Translation Feature #540
	57. Adding Updated date at in the Content
	58. YouTube Shortcode compatablity with AMP #557
	59. Comment Button URL
	60. Remove Category Layout modification code added by TagDiv #842 and #796
	61. Add Gist Support
	62. Adding Meta viewport via hook instead of direct #878
	63. Frontpage Comments #682 
	64. PageBuilder  
	65. Remove Filters code added through Class by other plugins
	66. Make AMP compatible with Squirrly SEO
	69. Post Pagination #834 #857
	70. Hide AMP by specific Categories #872
	71. Alt tag for thumbnails #1013 and For Post ID in Body tag #1006
	72. Blacklist Sanitizer Added back #1024
	73. View AMP Site below View Site In Dashboard #1076
	74. Featured Image check from Custom Fields 
	75. Dev Mode in AMP
	76. Body Class for AMP pages
	77. AMP Blog Details
	78. Saved Custom Post Types for AMP in Options for Structured Data
	79. Favicon for AMP
	80. Mobile Preview styling
	81. Duplicate Featured Image Support
	82. Grab Featured Image from The Content
	83. Advance Analytics(Google Analytics)
	84. Inline Related Posts
	85. Caption for Gallery Images
	86. minify the content of pages
	87. Post Thumbnail
	88. Author Details
	89. Facebook Pixel
	90. Set Header last modified information
	91. Comment Author Gravatar URL
	92. View AMP in Admin Bar
	93. added AMP url purifire for amphtml
	94. OneSignal Push Notifications
	95. Modify menu link attributes for SiteNavigationElement Schema Markup #1229 #1345
	96. ampforwp_is_front_page() ampforwp_is_home() and ampforwp_is_blog is created
	97. Change the format of the post date on Loops #1384 
	98. Create Dynamic url of amp according to the permalink structure #1318
	99. Merriweather Font Management
	100. Flags compatibility in Menu
	101. Function for Logo attributes 
*/
// AMP Components	
// AMP LOGO
add_amp_theme_support('AMP-logo');
// AMP Loop
add_amp_theme_support('AMP-loop');
// GDPR
add_amp_theme_support('AMP-gdpr');
// Adding AMP-related things to the main theme
	global $redux_builder_amp;


	// 0.9. AMP Design Manager Files
	require AMPFORWP_PLUGIN_DIR  .'templates/design-manager.php';
	// Custom AMP Content
	require AMPFORWP_PLUGIN_DIR  .'templates/custom-amp-content.php';
	// Custom AMPFORWP Sanitizers
 	require AMPFORWP_PLUGIN_DIR  .'templates/custom-sanitizer.php';
	// Custom Frontpage items
 	require AMPFORWP_PLUGIN_DIR  .'templates/frontpage-elements.php';
 	require AMPFORWP_PLUGIN_DIR . '/classes/class-ampforwp-youtube-embed.php' ;
 	// Custom Post Types
 	require AMPFORWP_PLUGIN_DIR  .'templates/ampforwp-custom-post-type.php';
 	
 	// Load aq resizer only in AMP mode
 	add_action('pre_amp_render_post','ampforwp_include_aqresizer');
 	function ampforwp_include_aqresizer(){
 		//Removed Jetpack Mobile theme option #2584
 		remove_action('option_stylesheet', 'jetpack_mobile_stylesheet');
 		require AMPFORWP_PLUGIN_DIR  .'includes/vendor/aq_resizer.php';
 	}
 	
 	// TODO: Update this function 
 	function ampforwp_include_customizer_files(){
 		global $redux_builder_amp;
 		$amp_plugin_data;
		$amp_plugin_activation_check; 

		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		$amp_plugin_activation_check = is_plugin_active( 'amp/amp.php' );
		if ( isset ($redux_builder_amp['amp-design-selector']) && 4 != $redux_builder_amp['amp-design-selector'] ) {
			return require AMPFORWP_PLUGIN_DIR  .'templates/customizer/customizer.php' ;
			/*if ( $amp_plugin_activation_check ) {
				$amp_plugin_data = get_plugin_data( AMPFORWP_MAIN_PLUGIN_DIR. 'amp/amp.php' );
		 		if ( $amp_plugin_data['Version'] > '0.4.2' ) {
		 			//return require AMPFORWP_PLUGIN_DIR  .'templates/customizer/customizer-new.php' ;
		 		} else {
		 			return require AMPFORWP_PLUGIN_DIR  .'templates/customizer/customizer.php' ;
		 		}
			} else {
			}*/
		}
 	} 
 	ampforwp_include_customizer_files();
//0.

define('AMPFORWP_COMMENTS_PER_PAGE',  ampforwp_define_comments_number() );
	// Define number of comments
	function ampforwp_define_comments_number(){
		global $redux_builder_amp;
		$number_of_comments = '';
		if(isset($redux_builder_amp['ampforwp-number-of-comments'])){
			$number_of_comments = $redux_builder_amp['ampforwp-number-of-comments'];
		}
		return $number_of_comments;
	}
	
	// 1. Add Home REL canonical
	// Add AMP rel-canonical for home and archive pages

	add_action('amp_init','ampforwp_allow_homepage');
	function ampforwp_allow_homepage() {
		add_action( 'wp', 'ampforwp_add_endpoint_actions' );
	}


	function ampforwp_add_endpoint_actions() {

		$ampforwp_is_amp_endpoint = ampforwp_is_amp_endpoint();

		if ( $ampforwp_is_amp_endpoint ) {
			AMPforWP\AMPVendor\amp_prepare_render();
		} else {
			add_action( 'wp_head', 'ampforwp_home_archive_rel_canonical', 1 );
		}

		$cpage_var = get_query_var('cpage');

		if ( $cpage_var >= 1) : 
			remove_action( 'wp_head', 'ampforwp_home_archive_rel_canonical', 1 );
		endif;			
	}

	function ampforwp_amphtml_generator(){
		global $redux_builder_amp;
		global $wp, $post;
		$post_id = '';
		$endpoint_check = false;
		$endpoint_check = $redux_builder_amp['amp-core-end-point'];
	    if( is_attachment() ) {
        return;
	    }
	    if( is_home() && is_front_page() && !$redux_builder_amp['ampforwp-homepage-on-off-support'] ) {
        return;
	    }
	    if( is_front_page() && ! $redux_builder_amp['ampforwp-homepage-on-off-support'] ) {
        return;
	    }
	    if ( is_archive() && !$redux_builder_amp['ampforwp-archive-support'] ) {
				return;
			}
		// #1192 Password Protected posts exclusion
		if(post_password_required( $post )){
				return;
			}
		// #2018 404 exclusion
		if(is_404()){
			return;
		}
		// #1443 AMP should be skip on the check out page  
		if(class_exists( 'WooCommerce' )){
		      if(function_exists('is_checkout') && is_checkout()){
		        return;
		      }
		    }
		// no-amphtml for search
		    if(is_search()){
		    	return;
		    }
		// #872 no-amphtml if selected as hide from settings
		if ( is_category_amp_disabled() ) {
			return;
		}
      	if ( is_page() && ! $redux_builder_amp['amp-on-off-for-all-pages'] && ! is_home() && ! is_front_page() ) {
			return;
		}
		if ( is_home() && ! ampforwp_is_blog() && !$redux_builder_amp['ampforwp-homepage-on-off-support'] ) {
			return;
		}

		if ( ampforwp_is_blog() && ! $redux_builder_amp['amp-on-off-for-all-pages'] ) {
			return;
		}
			$query_arg_array = $wp->query_vars;
			if( in_array( "cpage" , $query_arg_array ) ) {
				if( is_front_page() &&  $wp->query_vars['cpage'] >= '2' ) {
				 return;
			 }
			 if( is_singular() &&  $wp->query_vars['cpage'] >= '2' ) {
				 return;
			 }
			}

	    if ( is_home() || is_front_page() || is_archive() ){
	        global $wp;
	        $current_archive_url = home_url( $wp->request );
	        $amp_url = trailingslashit($current_archive_url);
	    } else {
	      $amp_url = AMPforWP\AMPVendor\amp_get_permalink( get_queried_object_id() );
	    }
        global $post;
        if ( is_singular() ) {
        	$post_id = get_the_ID();
        	
        }
        if ( ampforwp_is_blog() ) {
        	$post_id = ampforwp_get_blog_details('id');
        }

        $amp_metas = json_decode(get_post_meta( $post_id,'ampforwp-post-metas',true), true );
        $ampforwp_amp_post_on_off_meta = $amp_metas['ampforwp-amp-on-off'];

        if ( ( is_singular() || ampforwp_is_blog() ) && $ampforwp_amp_post_on_off_meta === 'hide-amp' ) {
          //dont Echo anything
        } else {
			$supported_types = ampforwp_get_all_post_types();

			$supported_types = apply_filters('get_amp_supported_post_types',$supported_types);

			$type = get_post_type();
			if(is_home() || is_front_page()){
		      if(isset($redux_builder_amp['ampforwp-homepage-on-off-support']) 
		          && $redux_builder_amp['ampforwp-homepage-on-off-support'] == 1 
		          && isset($redux_builder_amp['amp-on-off-for-all-posts']) 
		          && $redux_builder_amp['amp-on-off-for-all-posts'] == 0 
		          && isset($redux_builder_amp['amp-on-off-for-all-pages']) 
		          && $redux_builder_amp['amp-on-off-for-all-pages'] == 0 ){

                  $supported_types['post'] = 'post';
      			}
		    }
			$supported_amp_post_types = in_array( $type , $supported_types );

			$query_arg_array = $wp->query_vars;
			if( array_key_exists( 'paged' , $query_arg_array ) ) {
				if ( (is_home() || is_archive()) && $wp->query_vars['paged'] >= '2' ) {
					$new_url 		=  home_url('/');
					$category_path 	= $wp->request;
					if ( null != $category_path && true != $endpoint_check) {
						$explode_path  	= explode("/",$category_path);
						$inserted 		= array(AMPFORWP_AMP_QUERY_VAR);
						array_splice( $explode_path, -2, 0, $inserted );
						$impode_url = implode('/', $explode_path);
						$amp_url = $new_url . $impode_url ;
					}
				}
				if( is_search() && $wp->query_vars['paged'] >= '2' ) {
					$current_search_url =trailingslashit(get_home_url()) . $wp->request .'/'."?amp=1&s=".get_search_query();
				}
			}
			
			if(function_exists('ampforwp_page_cpt_same_slug') && !ampforwp_page_cpt_same_slug()){
				$amp_url = user_trailingslashit($amp_url);	
			}

			if( is_search() ) {
				$current_search_url =trailingslashit(get_home_url())."?amp=1&s=".get_search_query();
				$amp_url = untrailingslashit($current_search_url);
			}

			$amp_url = ampforwp_url_purifier($amp_url);

			include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
			if( get_option('permalink_structure') && is_plugin_active( 'sitepress-multilingual-cms/sitepress.php' )){
				global $sitepress_settings, $wp;
				if($sitepress_settings[ 'language_negotiation_type' ] == 3){
				  	if( is_singular() ){
						$wpml_url =get_permalink( get_queried_object_id() );
						$explode_url = explode('/', $wpml_url);
						$append_amp = 'amp';
						array_splice( $explode_url, 5, 0, $append_amp );
						$impode_url = implode('/', $explode_url);
						$amp_url = untrailingslashit($impode_url);
				    }
				    if ( is_home()  || is_archive() ){
				        global $wp;
				        $current_archive_url = home_url( $wp->request );
						$explode_path  	= explode("/",$current_archive_url);
						$inserted 		= array(AMPFORWP_AMP_QUERY_VAR);
						$query_arg_array = $wp->query_vars;
						if( array_key_exists( 'paged' , $query_arg_array ) ) {
							array_splice( $explode_path, -3, 0, $inserted );
						}
						else{
							array_splice( $explode_path, -1, 0, $inserted );
						}
						$impode_url = implode('/', $explode_path);
						$amp_url = $impode_url;
				    }
				}
			}

	        $amp_url = apply_filters('ampforwp_modify_rel_canonical',$amp_url);

	        if( $supported_amp_post_types) {					
				return $amp_url;
			}
		}
		return;
	}
		

	function ampforwp_home_archive_rel_canonical() {

		$amp_url = "";

		$amp_url = ampforwp_amphtml_generator();

		if ( $amp_url ) {
			printf('<link rel="amphtml" href="%s" />', esc_url($amp_url));
			printf('<meta name="generator" content="AMP for WP" />', esc_url($amp_url));
		}

	} //end of ampforwp_home_archive_rel_canonical()


	// Remove default wordpress rel canonical
	add_filter('amp_frontend_show_canonical','ampforwp_remove_default_canonical');
	if (! function_exists('ampforwp_remove_default_canonical') ) {
		function ampforwp_remove_default_canonical() {
			return false;
		}
	}

	// 2. Custom Design

	// Add Homepage AMP file code
	add_filter( 'amp_post_template_file', 'ampforwp_custom_template', 10, 3 );
	function ampforwp_custom_template( $file, $type, $post ) {
        global $redux_builder_amp;
	   	// Custom Homepage and Archive file
		$slug = array();
		$current_url_in_pieces = array();
		$ampforwp_custom_post_page  =  ampforwp_custom_post_page();
		        
    	if ( 'single' === $type ) {
	        // Homepage and FrontPage
	        if ( is_home() || ( true == $redux_builder_amp['ampforwp-amp-takeover'] && is_front_page() ) ) {

	        	$file = AMPFORWP_PLUGIN_DIR . '/templates/design-manager/design-'. ampforwp_design_selector() .'/index.php';
			}
            if ( ampforwp_is_blog() ) {
			 	$file = AMPFORWP_PLUGIN_DIR . '/templates/design-manager/design-'. ampforwp_design_selector() .'/index.php';
            }
        
          if ( ampforwp_is_front_page() || ( true == $redux_builder_amp['ampforwp-amp-takeover'] && is_front_page() && $redux_builder_amp['amp-frontpage-select-option']) ) {
		            $file = AMPFORWP_PLUGIN_DIR . '/templates/design-manager/design-'. ampforwp_design_selector() .'/frontpage.php';
	         }

	        // Archive Pages
	        if ( is_archive() && $redux_builder_amp['ampforwp-archive-support'] && 'single' === $type )  {

	            $file = AMPFORWP_PLUGIN_DIR . '/templates/design-manager/design-'. ampforwp_design_selector() .'/archive.php';
	        }
			// Search pages
	      	if ( is_search() )  {
	            $file = AMPFORWP_PLUGIN_DIR . '/templates/design-manager/design-'. ampforwp_design_selector() .'/search.php';
	        }
	        // 404 Pages #2042        	
	        if ( is_404() && 'single' === $type )  {
	        	add_filter('ampforwp_modify_rel_url','ampforwp_404_canonical');
	            $file = AMPFORWP_PLUGIN_DIR . '/templates/design-manager/design-'. ampforwp_design_selector() .'/404.php';
	        }
		}

		// Custom Single file
	    /*if ( is_single() || is_page() ) {

			if('single' === $type ) {
			 	$file = AMPFORWP_PLUGIN_DIR . '/templates/design-manager/design-'. ampforwp_design_selector() .'/single.php';
		 	}
		}*/
		// Polylang compatibility
		// For Frontpage
		if ( 'single' === $type && ampforwp_polylang_front_page() && true == $redux_builder_amp['amp-frontpage-select-option'] ) {
			$file = AMPFORWP_PLUGIN_DIR . '/templates/design-manager/design-'. ampforwp_design_selector() .'/frontpage.php';
		}
	    return $file;
	}

	// 3. Custom Style files
	//add_filter( 'amp_post_template_file', 'ampforwp_set_custom_style', 10, 3 );
	function ampforwp_set_custom_style( $file, $type, $post ) {
		if ( 'style' === $type ) {
			$file = '';
		}
		return $file;
	}
add_filter('amp_post_template_dir','ampforwp_new_dir');
function ampforwp_new_dir( $dir ) {
		global $redux_builder_amp;
		if ( 1 == $redux_builder_amp['amp-design-selector'] || 2 == $redux_builder_amp['amp-design-selector'] || 3 == $redux_builder_amp['amp-design-selector'] ) {
			$dir = AMPFORWP_PLUGIN_DIR . '/templates/design-manager/design-'. ampforwp_design_selector();
		}
		else {
			$dir = AMPFORWP_CUSTOM_THEME;
		}
		return $dir;
}

	//3.5
	add_filter( 'amp_post_template_file', 'ampforwp_empty_filter', 10, 3 );
	function ampforwp_empty_filter( $file, $type, $post ) {
		if ( 'empty-filter' === $type ) {
			$file = AMPFORWP_PLUGIN_DIR . '/templates/design-manager/empty-filter.php';
		}
		return $file;
	}

	// 4. Custom Header files
	add_filter( 'amp_post_template_file', 'ampforwp_custom_header', 10, 3 );
	function ampforwp_custom_header( $file, $type, $post ) {
		if ( 'header-bar' === $type ) {
			$file = AMPFORWP_PLUGIN_DIR . '/templates/design-manager/design-'. ampforwp_design_selector() .'/header-bar.php';
		}
		return $file;
	}

	// 4.1 Custom Meta-Author files
	add_filter( 'amp_post_template_file', 'ampforwp_set_custom_meta_author', 10, 3 );
	function ampforwp_set_custom_meta_author( $file, $type, $post ) {
		if ( 'meta-author' === $type ) {
			$file = AMPFORWP_PLUGIN_DIR . '/templates/design-manager/empty-filter.php';
		}
		return $file;
	}
	// 4.2 Custom Meta-Taxonomy files
	add_filter( 'amp_post_template_file', 'ampforwp_set_custom_meta_taxonomy', 10, 3 );
	function ampforwp_set_custom_meta_taxonomy( $file, $type, $post ) {
		if ( 'meta-taxonomy' === $type ) {
			$file = AMPFORWP_PLUGIN_DIR . 'templates/design-manager/empty-filter.php';
		}
		return $file;
	}

	// 4.5 Added hook to add more layout.
	do_action('ampforwp_after_features_include');


	// 5.  Customize with Width of the site
	add_filter( 'amp_content_max_width', 'ampforwp_change_content_width' );
	function ampforwp_change_content_width( $content_max_width ) {
		return 1000;
	}
 
	// 6. Add required Javascripts for extra AMP features
		// Code updated and added the JS proper way #336 
	add_filter('amp_post_template_data','ampforwp_add_amp_social_share_script', 20);
	function ampforwp_add_amp_social_share_script( $data ){
		global $redux_builder_amp;
		$social_check = $social_check_page = false;
		if ( is_page() && isset($redux_builder_amp['ampforwp-page-social']) && $redux_builder_amp['ampforwp-page-social'] )	{
			$social_check_page = true;
		}		
		if ( '4' === $redux_builder_amp['amp-design-selector'] ) {
			$social_check = true;
		}
		if ( '4' !== $redux_builder_amp['amp-design-selector'] && defined('AMPFORWP_DM_SOCIAL_CHECK') && 'true' === AMPFORWP_DM_SOCIAL_CHECK ) {
			$social_check = true;
		}
		if( $redux_builder_amp['enable-single-social-icons'] == true || defined('AMPFORWP_DM_SOCIAL_CHECK') && AMPFORWP_DM_SOCIAL_CHECK === 'true' )  {
				if( (is_singular() || $social_check_page ) &&  is_socialshare_or_socialsticky_enabled_in_ampforwp() ) {
					if ( empty( $data['amp_component_scripts']['amp-social-share'] ) ) {
						$data['amp_component_scripts']['amp-social-share'] = 'https://cdn.ampproject.org/v0/amp-social-share-0.1.js';
					}
				}
			}

		// Facebook Like Script
		if( true == $redux_builder_amp['ampforwp-facebook-like-button'] && (is_single() || $social_check_page ) && $social_check && (! checkAMPforPageBuilderStatus( get_the_ID() ) ) ){
			if(empty($data['amp_component_scripts']['amp-facebook-like'])){
				$data['amp_component_scripts']['amp-facebook-like'] = 'https://cdn.ampproject.org/v0/amp-facebook-like-0.1.js';
			}
		}
		return $data;
	}	


	// 6.1 Adding Analytics Scripts
	// Moved to analytics-functions.php

	add_filter( 'amp_post_template_data', 'ampforwp_add_amp_related_scripts', 20 );
	function ampforwp_add_amp_related_scripts( $data ) {
		global $redux_builder_amp;
		// Adding Sidebar Script
		if ( isset($redux_builder_amp['ampforwp-amp-menu']) && $redux_builder_amp['ampforwp-amp-menu'] && 4 != $redux_builder_amp['amp-design-selector'] ) { 
			if ( empty( $data['amp_component_scripts']['amp-sidebar'] ) ) {
				$data['amp_component_scripts']['amp-sidebar'] = 'https://cdn.ampproject.org/v0/amp-sidebar-0.1.js';
			}
		}
		return $data;
	}

	// 7. Footer for AMP Pages
	//add_filter( 'amp_post_template_file', 'ampforwp_custom_footer', 10, 3 );
	function ampforwp_custom_footer( $file, $type, $post ) {
		if ( 'footer' === $type ) {
			if ( 1 == $redux_builder_amp['amp-design-selector'] || 2 == $redux_builder_amp['amp-design-selector'] || 3 == $redux_builder_amp['amp-design-selector'] ) {
				$file = AMPFORWP_PLUGIN_DIR . '/templates/design-manager/design-'. ampforwp_design_selector() .'/footer.php';
			}
		else {
			$file = AMPFORWP_CUSTOM_THEME .'/footer.php';
		}
			//$file = AMPFORWP_PLUGIN_DIR . '/templates/design-manager/design-'. ampforwp_design_selector() .'/footer.php';
		}
		return $file;
	}

	// 8. Add Main tag as a Wrapper
	// Removed this code after moving to design manager

	// 9. Advertisement code
		// moved to ads-functions.php

	// 10. Analytics Area
		// Moved to analytics-functions.php
	// 11. Strip unwanted codes and tags from the_content
		add_action( 'pre_amp_render_post','ampforwp_strip_invalid_content');
		function ampforwp_strip_invalid_content() {
			add_filter( 'the_content', 'ampforwp_the_content_filter', 2 );
		}
		function ampforwp_the_content_filter( $content ) {
				 $content = preg_replace('/property=[^>]*/', '', $content);
				 $content = preg_replace('/vocab=[^>]*/', '', $content);
				//  $content = preg_replace('/type=[^>]*/', '', $content);
				 $content = preg_replace('/(<[^>]+) value=[^>]*/', '$1', $content);
				//  $content = preg_replace('/date=[^>]*/', '', $content);
				 $content = preg_replace('/noshade=[^>]*/', '', $content);
				 $content = preg_replace('/contenteditable=[^>]*/', '', $content);
				//  $content = preg_replace('/time=[^>]*/', '', $content);
				 $content = preg_replace('/non-refundable=[^>]*/', '', $content);
				 $content = preg_replace('/security=[^>]*/', '', $content);
				 $content = preg_replace('/deposit=[^>]*/', '', $content);
				 $content = preg_replace('/for=[^>]*/', '', $content);
				 $content = preg_replace('/nowrap="nowrap"/', '', $content);
				 $content = preg_replace('#<comments-count.*?>(.*?)</comments-count>#i', '', $content);
				 /*$content = preg_replace('#<time.*?>(.*?)</time>#i', '', $content);*/
				 $content = preg_replace('#<badge.*?>(.*?)</badge>#i', '', $content);
				 $content = preg_replace('#<plusone.*?>(.*?)</plusone>#i', '', $content);
				 $content = preg_replace('#<col.*?>#i', '', $content);
				 $content = preg_replace('#<table.*?>#i', '<table width="100%">', $content);
				 /* Removed So Inline style can work
				 $content = preg_replace('#<style scoped.*?>(.*?)</style>#i', '', $content); */
				 $content = preg_replace('/href="javascript:void*/', ' ', $content);
				 // Convert the Wistia embed into URL to build amp-wistia-player and remove unnecesarry wistia code
				 $content = preg_replace('/<script src="(https?).*(\/\/fast|support)(\.wistia\.com\/)(embed\/medias\/)([0-9|\w]+)(.*?)<\/script>/', "$1:$2$3$4$5\n", $content);
				 $content = preg_replace('/<div class="wistia_responsive_padding" (.*?)>/', "", $content);
				 $content = preg_replace('/<div class="wistia_responsive_wrapper" (.*?)>/', "", $content);
				 $content = preg_replace('/<div class="wistia_embed (.*?)>/', "", $content);
				 $content = preg_replace('/<div class="wistia_swatch" (.*?)>/', "", $content);
				 $content = preg_replace('/<img(.*?)src="https:\/\/fast.wistia.com\/embed\/(.*?)"(.*?)\/>/', "", $content);
				 
				 $content = preg_replace('/<script[^>]*>.*?<\/script>/i', '', $content);
				 //for removing attributes within html tags
				 $content = preg_replace('/(<[^>]+) onclick=".*?"/', '$1', $content);
				 /* Removed So Inline style can work
				 $content = preg_replace('/(<[^>]+) style=".*?"/', '$1', $content);
				 */
				 $content = preg_replace('/(<[^>]+) rel="(.*?) noopener(.*?)"/', '$1 rel="$2$3"', $content);
				 $content = preg_replace('/<div(.*?) rel=".*?"(.*?)/', '<div $1', $content);
				 // Remove alt attribute from the div tag #2093 
				 $content = preg_replace('/<div(.*?) alt=".*?"(.*?)/', '<div $1', $content);
				 $content = preg_replace('/(<[^>]+) ref=".*?"/', '$1', $content);
				 /*$content = preg_replace('/(<[^>]+) date=".*?"/', '$1', $content);
				 $content = preg_replace('/(<[^>]+) time=".*?"/', '$1', $content);
				 $content = preg_replace('/(<[^>]+) date/', '$1', $content);*/
				 $content = preg_replace('/(<[^>]+) imap=".*?"/', '$1', $content);
				 $content = preg_replace('/(<[^>]+) spellcheck/', '$1', $content);
				 $content = preg_replace('/<font(.*?)>(.*?)<\/font>/', '$2', $content);

				 //removing scripts and rel="nofollow" from Body and from divs
				 //issue #268
				 //$content = str_replace(' rel="nofollow"',"",$content);
				 $content = preg_replace('/<script[^>]*>.*?<\/script>/i', '', $content);
				/// simpy add more elements to simply strip tag but not the content as so
				/// Array ("p","font");
				$tags_to_strip = Array("thrive_headline","type","place","state","city" );
				$tags_to_strip = apply_filters('ampforwp_strip_bad_tags', $tags_to_strip);
				foreach ($tags_to_strip as $tag)
				{
				   $content = preg_replace("/<\\/?" . $tag . "(.|\\s)*?>/",'',$content);
				}
				// regex on steroids from here on
				 // issue #420
				 $content = preg_replace("/<div\s(class=.*?)(href=((".'"|'."'".')(.*?)("|'."'".')))\s(width=("|'."'".')(.*?)("|'."'"."))>(.*)<\/div>/i", '<div $1>$11</div>', $content);
				 $content = preg_replace('/<like\s(.*?)>(.*)<\/like>/i', '', $content);
				 $content = preg_replace('/<g:plusone\s(.*?)>(.*)<\/g:plusone>/i', '', $content);
				 $content = preg_replace('/imageanchor="1"/i', '', $content);
				 $content = preg_replace('/<plusone\s(.*?)>(.*?)<\/plusone>/', '', $content);
				 $content = preg_replace('/xml:lang=[^>]*/', '', $content);

				//				 $content = preg_replace('/<img*/', '<amp-img', $content); // Fallback for plugins
				// Removing the type attribute from the <ul> (Improved after 0.9.63)
				 $content = preg_replace('/<ul(.*?)\btype=".*?"(.*?)/','<ul $1',$content);
				
				 // Proper sanitizing the <ul> tag for itemtype and itemscope #1210
				 //$content = preg_replace('/<ul(.*?)(\w+=".*?")(.*?)(\btype=".*?")(.*?)(\w+=".*?")/','<ul $2 $6',$content);
				 //$content = preg_replace('/<ul(.*?)\btype=".*?"/','<ul $1',$content);


				 //Convert the Twitter embed into url for better sanitization #1010
				  $content = preg_replace('/<blockquote.+?(?=class="twitter-.*?")class="twitter-.*?".+?(https:\/\/twitter\.com\/\w+\/\w+\/.*?)".+?(?=<\/blockquote>)<\/blockquote>/s', "$1", $content);
				  // Convert the Soundcloud embed into URL to build amp-soundcloud
				  $content = preg_replace('/<iframe .*(https?).*(\/\/api\.soundcloud\.com\/tracks\/)([0-9]+)(.*)<\/iframe>/', "$1:$2$3", $content);

				  // for readability attibute in div tag
				  $content = preg_replace('/readability=[^>]*/', '', $content);
				  // removing color from span tag
				  $content = preg_replace('/<span(.*?)(color=".*?")(.*?)>/', '<span$1$3>', $content);
				  // removing sl-processed attribute
				  $content = preg_replace('/(<[^>]+) sl-processed=".*?"/', '$1', $content);
				  // ga-on
				  $content = preg_replace('/(<[^>]+) ga-on=".*?"/', '$1', $content);
				  // ga-event-category
				  $content = preg_replace('/(<[^>]+) ga-event-category=".*?"/', '$1', $content);
				   // aria-current
				  $content = preg_replace('/(<[^>]+) aria-current=".*?"/', '$1', $content);
				  // Gallery Break fix 
				  $content = preg_replace('/\[gallery(.*?)\]/', '</p>[gallery$1]</p>', $content);
				  // value attribute from anchor tag #2262
				  $content = preg_replace('/<a(.*?)(value=".*?")(.*?)>/', '<a$1$3>', $content);

				return $content;
		}


	// 11.1 Strip unwanted codes and tags from wp_footer for better compatibility with Plugins
		if ( ! is_customize_preview() && ! ampforwp_is_non_amp("non_amp_check_convert") ) {
			add_action( 'pre_amp_render_post','ampforwp_strip_invalid_content_footer');
		}
		function ampforwp_strip_invalid_content_footer() {
			add_filter( 'wp_footer', 'ampforwp_the_content_filter_footer', 1 );
		}
		function ampforwp_the_content_filter_footer( $content ) {
            remove_all_actions('wp_footer');
				return $content;
		}

	// 11.5 Strip unwanted codes the_content of Frontpage
   // add_action( 'pre_amp_render_post','ampforwp_strip_invalid_content_frontpage');
        function ampforwp_strip_invalid_content_frontpage(){
            if ( is_front_page() || is_home() ) {
			add_filter( 'the_content', 'ampforwp_the_content_filter_frontpage', 20 );
            }
		}
		function ampforwp_the_content_filter_frontpage( $content ) {
				 $content = preg_replace('/<img*/', '<amp-img', $content); // Fallback for plugins
				return $content;
		}

		// 12. Add Logo URL in the structured metadata
	    // moved to structured-data-functions.php

	// 13. Add Custom Placeholder Image for Structured Data.
	// if there is no image in the post, then use this image to validate Structured Data.
	// moved to structured-data-functions.php

// 14. Adds a meta box to the post editing screen for AMP on-off on specific pages.
/**
 * Adds a meta box to the post editing screen for AMP on-off on specific pages
*/

function ampforwp_title_custom_meta() {
  global $redux_builder_amp;

    $post_types = ampforwp_get_all_post_types();

    $user_level = '';
    $user_level = current_user_can( 'manage_options' );

    if (  isset( $redux_builder_amp['amp-meta-permissions'] ) && $redux_builder_amp['amp-meta-permissions'] == 'all' ) {
    	$user_level = true;
    }

    if ( $post_types && $user_level ) { // If there are any custom public post types.

        foreach ( $post_types  as $post_type ) {

          if( $post_type == 'amp-cta' || $post_type == 'amp-optin' ) {
							continue;
          }
          // Posts
	      if( ( true == $redux_builder_amp['amp-on-off-for-all-posts'] || true == $redux_builder_amp['fb-instant-article-switch'] ) && $post_type == 'post' ) {
	        add_meta_box( 'ampforwp_title_meta', esc_html__( 'AMP Settings for Current Post','accelerated-mobile-pages' ), 'ampforwp_title_callback', 'post','side' );      
	      }
	      // Pages
          if( $redux_builder_amp['amp-on-off-for-all-pages'] && $post_type == 'page' ) {
              add_meta_box( 'ampforwp_title_meta', esc_html__( 'AMP Settings for Current Page' ,'accelerated-mobile-pages'), 'ampforwp_title_callback','page','side' );
          }
          // Custom Post Types
          if( $post_type !== 'page' && $post_type !== 'post' ) {
            add_meta_box( 'ampforwp_title_meta', esc_html__( 'AMP Settings for Current Post','accelerated-mobile-pages' ), 'ampforwp_title_callback', $post_type,'side' );          
          }
          
          }

        }
    }

add_action( 'add_meta_boxes', 'ampforwp_title_custom_meta' );

/**
 * Outputs the content of the meta box for AMP on-off on specific pages
 */
function ampforwp_title_callback( $post ) {
	global $redux_builder_amp;
	$ampforwp_stored_meta = array();
    wp_nonce_field( basename( __FILE__ ), 'ampforwp_title_nonce' );
    $ampforwp_stored_meta = json_decode(get_post_meta( $post->ID,'ampforwp-post-metas', true ), true);
    $ampforwp_stored_meta['ampforwp-amp-on-off'] = array($ampforwp_stored_meta['ampforwp-amp-on-off']);
    $ampforwp_stored_meta['ampforwp-redirection-on-off'] = array($ampforwp_stored_meta['ampforwp-redirection-on-off']);
    $ampforwp_stored_meta['ampforwp-ia-on-off'] = array($ampforwp_stored_meta['ampforwp-ia-on-off']);
    $preview_query_args = array();
	$preview_link = $list_of_posts = $skip_this_post = '';
	$preview_query_args = array(AMPFORWP_AMP_QUERY_VAR => 1);
	$preview_link = get_preview_post_link($post, $preview_query_args );
	// Exclude Posts for AMP
	if ( ! isset($ampforwp_stored_meta['ampforwp-amp-on-off'][0]) || $ampforwp_stored_meta['ampforwp-amp-on-off'][0] == 'hide-amp' ) {
		$exclude_post_value = get_option('ampforwp_exclude_post');
		if ( $exclude_post_value == null ) {
			$exclude_post_value[] = 0;
		}
		if ( $exclude_post_value ) {
			if ( ! in_array( $post->ID, $exclude_post_value ) ) {
				$exclude_post_value[] = $post->ID;
				update_option('ampforwp_exclude_post', $exclude_post_value);
			}
		}
	} else {
		$exclude_post_value = get_option('ampforwp_exclude_post');
		if ( $exclude_post_value == null ) {
			$exclude_post_value[] = 0;
		}
		if ( $exclude_post_value ) {
			if ( in_array( $post->ID, $exclude_post_value ) ) {
				$exclude_ids = array_diff($exclude_post_value, array($post->ID) );
				update_option('ampforwp_exclude_post', $exclude_ids);
			}
		}

	}
	// Exclude Instant Articles
	if ( ! isset($ampforwp_stored_meta['ampforwp-ia-on-off'][0]) || $ampforwp_stored_meta['ampforwp-ia-on-off'][0] == 'hide-ia') {
		$exclude_post_value = get_option('ampforwp_ia_exclude_post');
		if ( $exclude_post_value == null ) {
			$exclude_post_value[] = 0;
		}
		if ( $exclude_post_value ) {
			if ( ! in_array( $post->ID, $exclude_post_value ) ) {
				$exclude_post_value[] = $post->ID;
				update_option('ampforwp_ia_exclude_post', $exclude_post_value);
			}
		}
	} else {
		$exclude_post_value = get_option('ampforwp_ia_exclude_post');
		if ( $exclude_post_value == null ) {
			$exclude_post_value[] = 0;
		}
		if ( $exclude_post_value ) {
			if ( in_array( $post->ID, $exclude_post_value ) ) {
				$exclude_ids = array_diff($exclude_post_value, array($post->ID) );
				update_option('ampforwp_ia_exclude_post', $exclude_ids);
			}
		}

	}

	if ( empty( $ampforwp_stored_meta['ampforwp-amp-on-off'][0] ) && 'hide' == ampforwp_get_setting('amp-'.$post->post_type.'s-meta-default') ) {
		$ampforwp_stored_meta['ampforwp-amp-on-off'][0] = 'hide-amp';
	}

	$list_of_posts = ampforwp_posts_to_remove();
	if ( $list_of_posts && $post->post_type == 'post' ) {
		$ampforwp_stored_meta['ampforwp-amp-on-off'][0] = 'hide-amp';
	} 
	if ( ('post' == $post->post_type && true == ampforwp_get_setting('amp-on-off-for-all-posts')) || ('page' == $post->post_type && true == ampforwp_get_setting('amp-on-off-for-all-pages')) || ( 'post' !== $post->post_type && 'page' !== $post->post_type) ) { ?>
    <div>
    	<p><?php esc_html_e('Show/Hide AMP','accelerated-mobile-pages') ?></p>
        <div class="prfx-row-content">
            <label class="meta-radio-two" for="ampforwp-on-off-meta-radio-one">
                <input type="radio" name="ampforwp-amp-on-off" id="ampforwp-on-off-meta-radio-one" value="default"  checked="checked" <?php if ( isset ( $ampforwp_stored_meta['ampforwp-amp-on-off'] ) ) checked( $ampforwp_stored_meta['ampforwp-amp-on-off'][0], 'default' ); ?>>
                <?php _e( 'Show' )?>
            </label>
            <label class="meta-radio-two" for="ampforwp-on-off-meta-radio-two">
                <input type="radio" name="ampforwp-amp-on-off" id="ampforwp-on-off-meta-radio-two" value="hide-amp" <?php if ( isset ( $ampforwp_stored_meta['ampforwp-amp-on-off'] ) ) checked( $ampforwp_stored_meta['ampforwp-amp-on-off'][0], 'hide-amp' ); ?>>
                <?php _e( 'Hide' )?>
            </label>
             <?php
             if($post->post_status == 'publish') {
	             add_thickbox(); ?>
	             <div class="ampforwp-preview-button-container"> 
					<input alt="#TB_inline?height=1135&amp;width=718&amp;inlineId=ampforwp_preview" title="AMP Mobile Preview" class="thickbox ampforwp-preview-button preview button amp-preview-button" type="button" value="Preview AMP" />  
				 </div>
			<?php } ?>   
        </div>
    </div>
    <!-- AMP Preview --> 
    <div id="ampforwp_preview" style="display:none">
	 	<div id="ampforwp-preview-format">
	        <div class="row">
	            <div class="col-sm-12 margin-top-bottom text-center">
	            	<div class="ampforwp-preview-phone-frame-wrapper">
	                    <div class="ampforwp-preview-phone-frame">
	                        <div class="ampforwp-preview-container" id="amp-preview-iframe" data-src="<?php echo $preview_link; ?>">
	                        </div> 
	                    </div>
	                </div>
	            </div>
	        </div>
    	</div>
	</div>
	</br>
	<?php if ( true == ampforwp_get_setting('amp-mobile-redirection' ) ) { ?>
	<div>
    	<p><?php esc_html_e('Mobile Redirection','accelerated-mobile-pages') ?></p>
        <div class="prfx-row-content">
            <label for="meta-redirection-radio-one">
                <input type="radio" name="ampforwp-redirection-on-off" id="meta-redirection-radio-one" value="enable"  checked="checked" <?php if ( isset ( $ampforwp_stored_meta['ampforwp-redirection-on-off'] ) ) checked( $ampforwp_stored_meta['ampforwp-redirection-on-off'][0], 'enable' ); ?>>
                <?php esc_html_e( 'Enable' )?>
            </label>
            <label for="meta-redirection-radio-two">
                <input type="radio" name="ampforwp-redirection-on-off" id="meta-redirection-radio-two" value="disable" <?php if ( isset ( $ampforwp_stored_meta['ampforwp-redirection-on-off'] ) ) checked( $ampforwp_stored_meta['ampforwp-redirection-on-off'][0], 'disable' ); ?>>
                <?php esc_html_e( 'Disable' )?>
            </label>
        </div>
    </div>
	<?php  }
	}
	if( true == $redux_builder_amp['fb-instant-article-switch'] && $post->post_type == 'post' ) { ?>
    <div>
    	<p>Show Instant Article for Current Post?</p>
        <div class="prfx-row-content">
            <label class="meta-radio-two" for="ampforwp-ia-on-off-meta-radio-one">
                <input type="radio" name="ampforwp-ia-on-off" id="ampforwp-ia-on-off-meta-radio-one" value="default"  checked="checked" <?php if ( isset ( $ampforwp_stored_meta['ampforwp-ia-on-off'] ) ) checked( $ampforwp_stored_meta['ampforwp-ia-on-off'][0], 'default' ); ?>>
                <?php esc_html_e( 'Enable' )?>
            </label>
            <label class="meta-radio-two" for="ampforwp-ia-on-off-meta-radio-two">
                <input type="radio" name="ampforwp-ia-on-off" id="ampforwp-ia-on-off-meta-radio-two" value="hide-ia" <?php if ( isset ( $ampforwp_stored_meta['ampforwp-ia-on-off'] ) ) checked( $ampforwp_stored_meta['ampforwp-ia-on-off'][0], 'hide-ia' ); ?>>
                <?php esc_html_e( 'Disable' )?>
            </label> 
        </div>
    </div>
	<?php } ?>
 	<?php
	if ( get_option('page_on_front') == $post->ID && false == $redux_builder_amp['amp-frontpage-select-option'] ) {
		_e('<p class="afp"><b>Note: </b>  This is not your AMP FrontPage, you can <a class="" href="'.admin_url("admin.php?page=amp_options&tabid=opt-text-subsection#redux_builder_amp-amp-frontpage-select-option").'">set one from here</a></p>', 'accelerated-mobile-pages');
	}
	if ( true == $redux_builder_amp['amp-frontpage-select-option'] && $post->ID == $redux_builder_amp['amp-frontpage-select-option-pages'] ) {
		_e('<p>AMP FrontPage</p>', 'accelerated-mobile-pages');
	}
}

function ampforwp_meta_redirection_status(){
	global $post;
	$ampforwp_redirection_post_on_off_meta = '';
	$ampforwp_post_metas = array();

	if ( ! is_404() && ampforwp_is_search_has_results() ) {
		$ampforwp_post_metas = json_decode(get_post_meta( $post->ID,'ampforwp-post-metas', true ), true);
    	$ampforwp_redirection_post_on_off_meta = $ampforwp_post_metas['ampforwp-redirection-on-off'];
	}

	if ( empty( $ampforwp_redirection_post_on_off_meta ) ) {
		$ampforwp_redirection_post_on_off_meta = 'enable';
	}

	return $ampforwp_redirection_post_on_off_meta;

}

// Added the check to see if any search results exists
function ampforwp_is_search_has_results() {
    return 0 != $GLOBALS['wp_query']->found_posts;
}

/**
 * Saves the custom meta input for AMP on-off on specific pages
 */
function ampforwp_title_meta_save( $post_id ) {
	$ampforwp_amp_status = '';
	$amp_post_metas = array();
	$amp_post_metas = json_decode(get_post_meta( $post_id,'ampforwp-post-metas',true), true );
    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'ampforwp_title_nonce' ] ) && wp_verify_nonce( $_POST[ 'ampforwp_title_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
    $is_valid_nonce_ia = ( isset( $_POST[ 'ampforwp_ia_nonce' ] ) && wp_verify_nonce( $_POST[ 'ampforwp_ia_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce || !$is_valid_nonce_ia ) {
        return;
    }

    // Checks for radio buttons and saves if needed
    if( isset( $_POST[ 'ampforwp-amp-on-off' ] ) ) {
        $ampforwp_amp_status = sanitize_text_field( $_POST[ 'ampforwp-amp-on-off' ] );
        $amp_post_metas['ampforwp-amp-on-off'] = $ampforwp_amp_status;
        update_post_meta( $post_id, 'ampforwp-post-metas', json_encode($amp_post_metas) );
    }
    if( isset( $_POST[ 'ampforwp-ia-on-off' ] ) ) {
        $ampforwp_amp_status = sanitize_text_field( $_POST[ 'ampforwp-ia-on-off' ] );
        $amp_post_metas['ampforwp-ia-on-off'] = $ampforwp_amp_status;
        update_post_meta( $post_id, 'ampforwp-post-metas', json_encode($amp_post_metas) );
    }

     if( isset( $_POST[ 'ampforwp-redirection-on-off' ] ) ) {
        $ampforwp_redirection_status = sanitize_text_field( $_POST[ 'ampforwp-redirection-on-off' ] );
        $amp_post_metas['ampforwp-redirection-on-off'] = $ampforwp_redirection_status;
        update_post_meta( $post_id, 'ampforwp-post-metas', json_encode($amp_post_metas) );
    }

}
add_action( 'save_post', 'ampforwp_title_meta_save' );

add_filter('amp_frontend_show_canonical','ampforwp_hide_amp_for_specific_pages');
function ampforwp_hide_amp_for_specific_pages($input){
		global $post;
		$amp_metas = json_decode(get_post_meta($post->ID, 'ampforwp-post-metas', true), true);
		$ampforwp_amp_status = $amp_metas['ampforwp-amp-on-off'];
		if ( $ampforwp_amp_status == 'hide-amp' ) {
			$input = false;
		}
		return $input;
}

// 15. Disable New Relic's extra script that its adds in AMP pages.
add_action( 'amp_post_template_data', 'ampforwp_disable_new_relic_scripts' );
if ( ! function_exists('ampforwp_disable_new_relic_scripts') ) {
		function ampforwp_disable_new_relic_scripts( $data ) {
			if ( ! function_exists( 'newrelic_disable_autorum' ) ) {
				return $data;
			}
			if ( function_exists( 'ampforwp_is_amp_endpoint' ) && ampforwp_is_amp_endpoint() ) {
				newrelic_disable_autorum();
			}
			return $data;
		}
}

// 16. Remove Unwanted Scripts
if ( function_exists( 'ampforwp_is_amp_endpoint' ) && ampforwp_is_amp_endpoint() ) {
	add_action( 'wp_enqueue_scripts', 'ampforwp_remove_unwanted_scripts',20 );
}
function ampforwp_remove_unwanted_scripts() {
  wp_dequeue_script('jquery');
}
// Remove Print Scripts and styles
function ampforwp_remove_print_scripts() {
		if ( ampforwp_is_amp_endpoint() ) {

		    function ampforwp_remove_all_scripts() {
		        global $wp_scripts;
		        $wp_scripts->queue = array();
		    }
		    add_action('wp_print_scripts', 'ampforwp_remove_all_scripts', 100);
		    function ampforwp_remove_all_styles() {
		        global $wp_styles;
		        $wp_styles->queue = array();
		    }
		    add_action('wp_print_styles', 'ampforwp_remove_all_styles', 100);

				// Remove Print Emoji for Nextgen Gallery support
				remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
				remove_action( 'wp_print_styles', 'print_emoji_styles' );


		}
}
add_action( 'template_redirect', 'ampforwp_remove_print_scripts' );

// 17. Archives Canonical in AMP version
// function ampforwp_rel_canonical_archive() {
//
// 			//    $archivelink = esc_url( get_permalink( $id ) . AMPFORWP_AMP_QUERY_VAR . '/' );
//   		echo "<link rel='canonical' href='$current_archive_url' />\n";
// }
// add_action( 'amp_post_template_head', 'ampforwp_rel_canonical_archive' );

// 18. Custom Canonical for Homepage
// function ampforwp_rel_canonical() {
//     if ( !is_home() )
//     return;
// //    $link = esc_url( get_permalink( $id ) . AMPFORWP_AMP_QUERY_VAR . '/' );
//     $homelink = get_home_url();
//     echo "<link rel='canonical' href='$homelink' />\n";
// }
// add_action( 'amp_post_template_head', 'ampforwp_rel_canonical' );

// 18.5. Custom Canonical for Frontpage
// function ampforwp_rel_canonical_frontpage() {
//    if ( is_home() || is_front_page() )
//    return;
// //    $link = esc_url( get_permalink( $id ) . AMPFORWP_AMP_QUERY_VAR . '/' );
//    $homelink = get_home_url();
//    echo "<link rel='canonical' href='$homelink' />\n";
// }
// add_action( 'amp_post_template_head', 'ampforwp_rel_canonical_frontpage' );

// 19. Remove Canonical tags
function ampforwp_amp_remove_actions() {
    if ( is_home() || is_front_page() || is_archive() || is_search() ) {
        remove_action( 'amp_post_template_head', 'AMPforWP\\AMPVendor\\amp_post_template_add_canonical' );
    }
}
add_action( 'amp_post_template_head', 'ampforwp_amp_remove_actions', 9 );

// 20. Remove the default Google font for performance
// add_action( 'amp_post_template_head', function() {
//     remove_action( 'amp_post_template_head', 'amp_post_template_add_fonts' );
// }, 9 );

// 21. Remove Schema data from All In One Schema.org Rich Snippets Plugin 
add_action( 'pre_amp_render_post', 'ampforwp_remove_schema_data' );
function ampforwp_remove_schema_data() {
	remove_filter('the_content','display_rich_snippet');
    	// Ultimate Social Media PLUS Compatiblity Added
	remove_filter('the_content','sfsi_plus_beforaftereposts');
	remove_filter('the_content','sfsi_plus_beforeafterblogposts');
 

	// Thrive Content Builder
	$ampforwp_metas = json_decode(get_post_meta(get_the_ID(),'ampforwp-post-metas',true),true);
	$amp_custom_content_enable = $ampforwp_metas['ampforwp_custom_content_editor_checkbox'];
	if ($amp_custom_content_enable == 'yes') {
		remove_filter( 'the_content', 'tve_editor_content', 10 );
	}

	// Removed GTranslate Flags from AMP pages #819
	remove_filter('wp_nav_menu_items', 'gtranslate_menu_item', 10, 2);

	// Remove elements of WP Like Button plugin #841
	remove_filter('the_content', 'fb_like_button');
	remove_filter('the_excerpt', 'fb_like_button');

	// Compatibility issue with the rocket lazy load  #907
    remove_filter( 'the_content' , 'rocket_lazyload_images', PHP_INT_MAX );
    remove_filter( 'the_content', 'rocket_lazyload_iframes', PHP_INT_MAX );
	add_filter( 'do_rocket_lazyload', '__return_false' );

	// Remove Popups and other elements added by Slider-in Plugin
	define('WDSI_BOX_RENDERED', true, true);
	
	// Remove Filters added by third party plugin through class
	if ( function_exists('ampforwp_remove_filters_for_class')) {
		//Remove Disallowed 'like' tag from facebook Like button by Ultimate Facebook
		ampforwp_remove_filters_for_class( 'the_content', 'Wdfb_UniversalWorker', 'inject_facebook_button', 10 );
		//Compatibility with Sassy Social Share Plugin
		ampforwp_remove_filters_for_class( 'the_content', 'Sassy_Social_Share_Public', 'render_sharing', 10 );
		ampforwp_remove_filters_for_class( 'amp_post_template_head', 'Sassy_Social_Share_Public', 'frontend_scripts', 10 );
		ampforwp_remove_filters_for_class( 'amp_post_template_css', 'Sassy_Social_Share_Public', 'frontend_inline_style', 10 );
		ampforwp_remove_filters_for_class( 'amp_post_template_css', 'Sassy_Social_Share_Public', 'frontend_amp_css', 10 );
		//Removing the Monarch social share icons from AMP
		ampforwp_remove_filters_for_class( 'the_content', 'ET_Monarch', 'display_inline', 10 );
		ampforwp_remove_filters_for_class( 'the_content', 'ET_Monarch', 'display_media', 9999 );
		//Compatibility with wordpress twitter bootstrap #525
		ampforwp_remove_filters_for_class( 'the_content', 'ICWP_WPTB_CssProcessor_V1', 'run', 10 );
		//Perfect SEO url + Yoast SEO Compatibility #982
		ampforwp_remove_filters_for_class( 'wpseo_canonical', 'PSU', 'canonical', 10 );
		// SmartMag Compatibility 
		ampforwp_remove_filters_for_class( 'amp_post_template_dir', 'Bunyad_Theme_Amp', 'template_dir', 10 );
		ampforwp_remove_filters_for_class( 'amp_post_template_data', 'Bunyad_Theme_Amp', 'setup_data', 10 );
		// Remove Jannah Image Lazy Load #2224
		ampforwp_remove_filters_for_class( 'wp_get_attachment_image_attributes', 'TIELABS_FILTERS', 'lazyload_image_attributes', 8 );
		// Social Share by Supsystic Compatibility #1509
		ampforwp_remove_filters_for_class( 'the_content', 'SocialSharing_Projects_Handler', 'applyContentCallback', 10 );
		ampforwp_remove_filters_for_class( 'amp_post_template_head', 'SocialSharing_Projects_Handler', 'addedStylesForAMP', 10 );
		// Remove JPG, PNG Compression and Optimization Plugin Lazy Load #2322
		ampforwp_remove_filters_for_class( 'the_content', 'Wp_Image_compression', 'filter_images', 200 );
		// Remove Publisher theme menu in amp #2672
		ampforwp_remove_filters_for_class( 'wp_nav_menu_args', 'BF_Menus', 'walker_front', 10 );

		//SiteOrigin Page builder compatibilty with AMP Frontpage
		if ( ampforwp_is_front_page() ) {
				ampforwp_remove_filters_for_class( 'the_content', 'SiteOrigin_Panels', 'generate_post_content', 10 );
		}
		//SiteOrigin Page builder compatibilty
		//Neglect SOPB If Custom AMP Editor is checked
	      if ( $amp_custom_content_enable === 'yes') {
				ampforwp_remove_filters_for_class( 'the_content', 'SiteOrigin_Panels', 'generate_post_content', 10 );
				ampforwp_remove_filters_for_class( 'the_content', 'Elementor\Frontend', 'apply_builder_in_content', 9 );
			}
	}
	//Removing the WPTouch Pro social share links from AMP
		remove_filter( 'the_content', 'foundation_handle_share_links_bottom', 100 );
	//Removing the space added by the Google adsense #967
		remove_filter( 'the_content', 'ga_strikable_add_optimized_adsense_code');
	//Removing Social Media Share Buttons & Social Sharing Icons #1135
		remove_filter('the_content', 'sfsi_social_buttons_below');
	// Removing WordPress Social Share Buttons #1272
    	remove_filter ('the_content', 'FTGSB');
    // Jannah Theme Lazy Load Compatibility
    	remove_filter( 'wp_get_attachment_image_attributes', 'jannah_lazyload_image_attributes', 8, 3 );
    // Goodlife Theme Lazy Load Compatibility
    	remove_filter( 'post_thumbnail_html', 'thb_src_attribute', 10, 3 );
    // MediaAce lazy load compatibility
    	remove_filter( 'wp_get_attachment_image_attributes', 'mace_lazy_load_attachment', 10, 3);
		remove_filter( 'the_content', 'mace_lazy_load_content_image' );
	// SEO Post Content Links compatibility
	if ( class_exists('cl_core') ) {
		remove_action('the_content', array( 'cl_core', 'getPost' ) );
	}
	// Theia Post Slider compatibility
	if ( class_exists('TpsContent') ) {
		remove_action('the_post', 'TpsContent::the_post', 999999);
	}
	// Jarida Theme Compatibility #1842
	remove_filter( 'option_posts_per_page', 'tie_option_posts_per_page' );

	// IWappPress Compatibility #1876 #1864
	remove_action('loop_start', 'iWappPress_remove_post_date');

	// Facebook Button by BestWebSoft Compatibility #1740
	remove_filter( 'the_content', 'fcbkbttn_display_button' );

	// Simple Author Box Compatibility #2268
	remove_filter( 'the_content', 'wpsabox_author_box' );

	// Removing Voux theme's lazyloading #2263
	remove_filter( 'the_content', 'thb_lazy_images_filter', 200 );
	remove_filter( 'wp_get_attachment_image_attributes', 'thb_lazy_low_quality', 10, 3 );
}

// 22. Removing author links from comments Issue #180
if( ! function_exists( 'ampforwp_disable_comment_author_links' ) ) {
	function ampforwp_disable_comment_author_links( $author_link ){
		$ampforwp_is_amp_endpoint = ampforwp_is_amp_endpoint();
		if ( $ampforwp_is_amp_endpoint ) {
			return strip_tags( $author_link );
		} else {
			return $author_link;
		}
	}
	add_filter( 'get_comment_author_link', 'ampforwp_disable_comment_author_links' );
}

// 23. The analytics tag appears more than once in the document. This will soon be an error
remove_action( 'amp_post_template_head', 'quads_amp_add_amp_ad_js');

// 24. Seperate Sticky Single Social Icons
// TO DO: we can directly call social-icons.php instead of below code
add_action('amp_post_template_footer','ampforwp_sticky_social_icons');
function ampforwp_sticky_social_icons(){
	global $redux_builder_amp;
	// Social share in AMP 
	$amp_permalink = "";
	if ( ampforwp_get_setting('ampforwp-social-share-amp')  ) {
		$amp_permalink = ampforwp_url_controller(get_the_permalink());
	} else{
		$amp_permalink = get_the_permalink();
	}
/*	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	if( !is_plugin_active( 'amp-cta/amp-cta.php' ) )  {*/
		if( ($redux_builder_amp['enable-single-social-icons'] == true && is_single()) || (is_page() && true == $redux_builder_amp['ampforwp-page-sticky-social']))  { 
			$image = '';
			if ( ampforwp_has_post_thumbnail( ) ){
				$image = ampforwp_get_post_thumbnail( 'url', 'full' );
			}
			$permalink = '';
			if(ampforwp_get_setting('enable-single-twitter-share-link')){
			$permalink = wp_get_shortlink();
		}
		else
			$permalink = $amp_permalink;
			?>
			 <div class="sticky_social">
				<?php if($redux_builder_amp['enable-single-facebook-share'] == true)  { ?>
			    	<amp-social-share type="facebook"    data-param-app_id="<?php echo $redux_builder_amp['amp-facebook-app-id']; ?>" width="50" height="28"></amp-social-share>
			    	<a title="facebook share" class="s_fb" target="_blank" href="https://www.facebook.com/sharer.php?u=<?php echo $amp_permalink; ?>"></a>
			  	<?php } ?>
			  	<?php if($redux_builder_amp['enable-single-twitter-share'] == true)  {
	          $data_param_data = $redux_builder_amp['enable-single-twitter-share-handle'];?>
	          <amp-social-share type="twitter"
	                            width="50"
	                            height="28"
	                            data-param-url=""
                        		data-param-text="TITLE <?php echo $permalink.' '.ampforwp_translation( $redux_builder_amp['amp-translator-via-text'], 'via' ).' '.$data_param_data ?>"
	          ></amp-social-share>
			  	<?php } ?>
			  	<?php if($redux_builder_amp['enable-single-gplus-share'] == true)  { ?>
			    	<amp-social-share type="gplus"      width="50" height="28"></amp-social-share>
			  	<?php } ?>
			  	<?php if($redux_builder_amp['enable-single-email-share'] == true)  { ?>
			    	<amp-social-share type="email"      width="50" height="28"></amp-social-share>
			  	<?php } ?>
			  	<?php if($redux_builder_amp['enable-single-pinterest-share'] == true)  { ?>
			    	<amp-social-share type="pinterest"  width="50" height="28" data-param-media = "<?php echo esc_url($image); ?>"></amp-social-share>
			  	<?php } ?>
			  	<?php if($redux_builder_amp['enable-single-linkedin-share'] == true)  { ?>
			    	<amp-social-share type="linkedin" width="50" height="28"></amp-social-share>
			  	<?php } ?>
			  	<?php if($redux_builder_amp['enable-single-whatsapp-share'] == true)  { ?>
							<a title="whatsapp share" href="whatsapp://send?text=<?php echo $amp_permalink; ?>">
							<div class="amp-social-icon">
							    <amp-img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTYuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgd2lkdGg9IjUxMnB4IiBoZWlnaHQ9IjUxMnB4IiB2aWV3Qm94PSIwIDAgOTAgOTAiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDkwIDkwOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+CjxnPgoJPHBhdGggaWQ9IldoYXRzQXBwIiBkPSJNOTAsNDMuODQxYzAsMjQuMjEzLTE5Ljc3OSw0My44NDEtNDQuMTgyLDQzLjg0MWMtNy43NDcsMC0xNS4wMjUtMS45OC0yMS4zNTctNS40NTVMMCw5MGw3Ljk3NS0yMy41MjIgICBjLTQuMDIzLTYuNjA2LTYuMzQtMTQuMzU0LTYuMzQtMjIuNjM3QzEuNjM1LDE5LjYyOCwyMS40MTYsMCw0NS44MTgsMEM3MC4yMjMsMCw5MCwxOS42MjgsOTAsNDMuODQxeiBNNDUuODE4LDYuOTgyICAgYy0yMC40ODQsMC0zNy4xNDYsMTYuNTM1LTM3LjE0NiwzNi44NTljMCw4LjA2NSwyLjYyOSwxNS41MzQsNy4wNzYsMjEuNjFMMTEuMTA3LDc5LjE0bDE0LjI3NS00LjUzNyAgIGM1Ljg2NSwzLjg1MSwxMi44OTEsNi4wOTcsMjAuNDM3LDYuMDk3YzIwLjQ4MSwwLDM3LjE0Ni0xNi41MzMsMzcuMTQ2LTM2Ljg1N1M2Ni4zMDEsNi45ODIsNDUuODE4LDYuOTgyeiBNNjguMTI5LDUzLjkzOCAgIGMtMC4yNzMtMC40NDctMC45OTQtMC43MTctMi4wNzYtMS4yNTRjLTEuMDg0LTAuNTM3LTYuNDEtMy4xMzgtNy40LTMuNDk1Yy0wLjk5My0wLjM1OC0xLjcxNy0wLjUzOC0yLjQzOCwwLjUzNyAgIGMtMC43MjEsMS4wNzYtMi43OTcsMy40OTUtMy40Myw0LjIxMmMtMC42MzIsMC43MTktMS4yNjMsMC44MDktMi4zNDcsMC4yNzFjLTEuMDgyLTAuNTM3LTQuNTcxLTEuNjczLTguNzA4LTUuMzMzICAgYy0zLjIxOS0yLjg0OC01LjM5My02LjM2NC02LjAyNS03LjQ0MWMtMC42MzEtMS4wNzUtMC4wNjYtMS42NTYsMC40NzUtMi4xOTFjMC40ODgtMC40ODIsMS4wODQtMS4yNTUsMS42MjUtMS44ODIgICBjMC41NDMtMC42MjgsMC43MjMtMS4wNzUsMS4wODItMS43OTNjMC4zNjMtMC43MTcsMC4xODItMS4zNDQtMC4wOS0xLjg4M2MtMC4yNy0wLjUzNy0yLjQzOC01LjgyNS0zLjM0LTcuOTc3ICAgYy0wLjkwMi0yLjE1LTEuODAzLTEuNzkyLTIuNDM2LTEuNzkyYy0wLjYzMSwwLTEuMzU0LTAuMDktMi4wNzYtMC4wOWMtMC43MjIsMC0xLjg5NiwwLjI2OS0yLjg4OSwxLjM0NCAgIGMtMC45OTIsMS4wNzYtMy43ODksMy42NzYtMy43ODksOC45NjNjMCw1LjI4OCwzLjg3OSwxMC4zOTcsNC40MjIsMTEuMTEzYzAuNTQxLDAuNzE2LDcuNDksMTEuOTIsMTguNSwxNi4yMjMgICBDNTguMiw2NS43NzEsNTguMiw2NC4zMzYsNjAuMTg2LDY0LjE1NmMxLjk4NC0wLjE3OSw2LjQwNi0yLjU5OSw3LjMxMi01LjEwN0M2OC4zOTgsNTYuNTM3LDY4LjM5OCw1NC4zODYsNjguMTI5LDUzLjkzOHoiIGZpbGw9IiNGRkZGRkYiLz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K" width="50" height="20" />
							    </div>
								</a>
	        <?php } ?>
	        <?php if($redux_builder_amp['enable-single-line-share'] == true)  { ?>
			<a title="line share" href="http://line.me/R/msg/text/?<?php echo $amp_permalink; ?>">
				<div class="amp-social-icon custom-amp-socialsharing-line">
					<amp-img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTguMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDI5Ni41MjggMjk2LjUyOCIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgMjk2LjUyOCAyOTYuNTI4OyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjI0cHgiIGhlaWdodD0iMjRweCI+CjxnPgoJPHBhdGggZD0iTTI5NS44MzgsMTE1LjM0N2wwLjAwMy0wLjAwMWwtMC4wOTItMC43NmMtMC4wMDEtMC4wMTMtMC4wMDItMC4wMjMtMC4wMDQtMC4wMzZjLTAuMDAxLTAuMDExLTAuMDAyLTAuMDIxLTAuMDA0LTAuMDMyICAgbC0wLjM0NC0yLjg1OGMtMC4wNjktMC41NzQtMC4xNDgtMS4yMjgtMC4yMzgtMS45NzRsLTAuMDcyLTAuNTk0bC0wLjE0NywwLjAxOGMtMy42MTctMjAuNTcxLTEzLjU1My00MC4wOTMtMjguOTQyLTU2Ljc2MiAgIGMtMTUuMzE3LTE2LjU4OS0zNS4yMTctMjkuNjg3LTU3LjU0OC0zNy44NzhjLTE5LjEzMy03LjAxOC0zOS40MzQtMTAuNTc3LTYwLjMzNy0xMC41NzdjLTI4LjIyLDAtNTUuNjI3LDYuNjM3LTc5LjI1NywxOS4xOTMgICBDMjMuMjg5LDQ3LjI5Ny0zLjU4NSw5MS43OTksMC4zODcsMTM2LjQ2MWMyLjA1NiwyMy4xMTEsMTEuMTEsNDUuMTEsMjYuMTg0LDYzLjYyMWMxNC4xODgsMTcuNDIzLDMzLjM4MSwzMS40ODMsNTUuNTAzLDQwLjY2ICAgYzEzLjYwMiw1LjY0MiwyNy4wNTEsOC4zMDEsNDEuMjkxLDExLjExNmwxLjY2NywwLjMzYzMuOTIxLDAuNzc2LDQuOTc1LDEuODQyLDUuMjQ3LDIuMjY0YzAuNTAzLDAuNzg0LDAuMjQsMi4zMjksMC4wMzgsMy4xOCAgIGMtMC4xODYsMC43ODUtMC4zNzgsMS41NjgtMC41NywyLjM1MmMtMS41MjksNi4yMzUtMy4xMSwxMi42ODMtMS44NjgsMTkuNzkyYzEuNDI4LDguMTcyLDYuNTMxLDEyLjg1OSwxNC4wMDEsMTIuODYgICBjMC4wMDEsMCwwLjAwMSwwLDAuMDAyLDBjOC4wMzUsMCwxNy4xOC01LjM5LDIzLjIzMS04Ljk1NmwwLjgwOC0wLjQ3NWMxNC40MzYtOC40NzgsMjguMDM2LTE4LjA0MSwzOC4yNzEtMjUuNDI1ICAgYzIyLjM5Ny0xNi4xNTksNDcuNzgzLTM0LjQ3NSw2Ni44MTUtNTguMTdDMjkwLjE3MiwxNzUuNzQ1LDI5OS4yLDE0NS4wNzgsMjk1LjgzOCwxMTUuMzQ3eiBNOTIuMzQzLDE2MC41NjFINjYuNzYxICAgYy0zLjg2NiwwLTctMy4xMzQtNy03Vjk5Ljg2NWMwLTMuODY2LDMuMTM0LTcsNy03YzMuODY2LDAsNywzLjEzNCw3LDd2NDYuNjk2aDE4LjU4MWMzLjg2NiwwLDcsMy4xMzQsNyw3ICAgQzk5LjM0MywxNTcuNDI3LDk2LjIwOSwxNjAuNTYxLDkyLjM0MywxNjAuNTYxeiBNMTE5LjAzLDE1My4zNzFjMCwzLjg2Ni0zLjEzNCw3LTcsN2MtMy44NjYsMC03LTMuMTM0LTctN1Y5OS42NzUgICBjMC0zLjg2NiwzLjEzNC03LDctN2MzLjg2NiwwLDcsMy4xMzQsNyw3VjE1My4zNzF6IE0xODIuMzA0LDE1My4zNzFjMCwzLjAzMy0xLjk1Myw1LjcyMS00LjgzOCw2LjY1OCAgIGMtMC43MTIsMC4yMzEtMS40NDEsMC4zNDMtMi4xNjEsMC4zNDNjLTIuMTk5LDAtNC4zMjMtMS4wMzktNS42NjYtMi44ODhsLTI1LjIwNy0zNC43MTd2MzAuNjA1YzAsMy44NjYtMy4xMzQsNy03LDcgICBjLTMuODY2LDAtNy0zLjEzNC03LTd2LTUyLjE2YzAtMy4wMzMsMS45NTMtNS43MjEsNC44MzgtNi42NThjMi44ODYtMC45MzYsNi4wNDUsMC4wOSw3LjgyNywyLjU0NWwyNS4yMDcsMzQuNzE3Vjk5LjY3NSAgIGMwLTMuODY2LDMuMTM0LTcsNy03YzMuODY2LDAsNywzLjEzNCw3LDdWMTUzLjM3MXogTTIzMy4zMTEsMTU5LjI2OWgtMzQuNjQ1Yy0zLjg2NiwwLTctMy4xMzQtNy03di0yNi44NDdWOTguNTczICAgYzAtMy44NjYsMy4xMzQtNyw3LTdoMzMuNTdjMy44NjYsMCw3LDMuMTM0LDcsN3MtMy4xMzQsNy03LDdoLTI2LjU3djEyLjg0OWgyMS41NjJjMy44NjYsMCw3LDMuMTM0LDcsN2MwLDMuODY2LTMuMTM0LDctNyw3ICAgaC0yMS41NjJ2MTIuODQ3aDI3LjY0NWMzLjg2NiwwLDcsMy4xMzQsNyw3UzIzNy4xNzcsMTU5LjI2OSwyMzMuMzExLDE1OS4yNjl6IiBmaWxsPSIjRkZGRkZGIi8+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==" width="50" height="20" />
				</div>
			</a>
		<?php } ?>
		<?php if($redux_builder_amp['enable-single-vk-share'] == true)  { ?>
			<a title="vkontakte share" href="http://vk.com/share.php?url=<?php echo $amp_permalink; ?>">
				<div class="amp-social-icon amp-social-vk"> 
					<amp-img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCAzMDQuMzYgMzA0LjM2IiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCAzMDQuMzYgMzA0LjM2OyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjUxMnB4IiBoZWlnaHQ9IjUxMnB4Ij4KPGcgaWQ9IlhNTElEXzFfIj4KCTxwYXRoIGlkPSJYTUxJRF84MDdfIiBzdHlsZT0iZmlsbC1ydWxlOmV2ZW5vZGQ7Y2xpcC1ydWxlOmV2ZW5vZGQ7IiBkPSJNMjYxLjk0NSwxNzUuNTc2YzEwLjA5Niw5Ljg1NywyMC43NTIsMTkuMTMxLDI5LjgwNywyOS45ODIgICBjNCw0LjgyMiw3Ljc4Nyw5Ljc5OCwxMC42ODQsMTUuMzk0YzQuMTA1LDcuOTU1LDAuMzg3LDE2LjcwOS02Ljc0NiwxNy4xODRsLTQ0LjM0LTAuMDJjLTExLjQzNiwwLjk0OS0yMC41NTktMy42NTUtMjguMjMtMTEuNDc0ICAgYy02LjEzOS02LjI1My0xMS44MjQtMTIuOTA4LTE3LjcyNy0xOS4zNzJjLTIuNDItMi42NDItNC45NTMtNS4xMjgtNy45NzktNy4wOTNjLTYuMDUzLTMuOTI5LTExLjMwNy0yLjcyNi0xNC43NjYsMy41ODcgICBjLTMuNTIzLDYuNDIxLTQuMzIyLDEzLjUzMS00LjY2OCwyMC42ODdjLTAuNDc1LDEwLjQ0MS0zLjYzMSwxMy4xODYtMTQuMTE5LDEzLjY2NGMtMjIuNDE0LDEuMDU3LTQzLjY4Ni0yLjMzNC02My40NDctMTMuNjQxICAgYy0xNy40MjItOS45NjgtMzAuOTMyLTI0LjA0LTQyLjY5MS0zOS45NzFDMzQuODI4LDE1My40ODIsMTcuMjk1LDExOS4zOTUsMS41MzcsODQuMzUzQy0yLjAxLDc2LjQ1OCwwLjU4NCw3Mi4yMiw5LjI5NSw3Mi4wNyAgIGMxNC40NjUtMC4yODEsMjguOTI4LTAuMjYxLDQzLjQxLTAuMDJjNS44NzksMC4wODYsOS43NzEsMy40NTgsMTIuMDQxLDkuMDEyYzcuODI2LDE5LjI0MywxNy40MDIsMzcuNTUxLDI5LjQyMiw1NC41MjEgICBjMy4yMDEsNC41MTgsNi40NjUsOS4wMzYsMTEuMTEzLDEyLjIxNmM1LjE0MiwzLjUyMSw5LjA1NywyLjM1NCwxMS40NzYtMy4zNzRjMS41MzUtMy42MzIsMi4yMDctNy41NDQsMi41NTMtMTEuNDM0ICAgYzEuMTQ2LTEzLjM4MywxLjI5Ny0yNi43NDMtMC43MTMtNDAuMDc5Yy0xLjIzNC04LjMyMy01LjkyMi0xMy43MTEtMTQuMjI3LTE1LjI4NmMtNC4yMzgtMC44MDMtMy42MDctMi4zOC0xLjU1NS00Ljc5OSAgIGMzLjU2NC00LjE3Miw2LjkxNi02Ljc2OSwxMy41OTgtNi43NjloNTAuMTExYzcuODg5LDEuNTU3LDkuNjQxLDUuMTAxLDEwLjcyMSwxMy4wMzlsMC4wNDMsNTUuNjYzICAgYy0wLjA4NiwzLjA3MywxLjUzNSwxMi4xOTIsNy4wNywxNC4yMjZjNC40MywxLjQ0OCw3LjM1LTIuMDk2LDEwLjAwOC00LjkwNWMxMS45OTgtMTIuNzM0LDIwLjU2MS0yNy43ODMsMjguMjExLTQzLjM2NiAgIGMzLjM5NS02Ljg1Miw2LjMxNC0xMy45NjgsOS4xNDMtMjEuMDc4YzIuMDk2LTUuMjc2LDUuMzg1LTcuODcyLDExLjMyOC03Ljc1N2w0OC4yMjksMC4wNDNjMS40MywwLDIuODc3LDAuMDIxLDQuMjYyLDAuMjU4ICAgYzguMTI3LDEuMzg1LDEwLjM1NCw0Ljg4MSw3Ljg0NCwxMi44MTdjLTMuOTU1LDEyLjQ1MS0xMS42NSwyMi44MjctMTkuMTc0LDMzLjI1MWMtOC4wNDMsMTEuMTI5LTE2LjY0NSwyMS44NzctMjQuNjIxLDMzLjA3MiAgIEMyNTIuMjYsMTYxLjU0NCwyNTIuODQyLDE2Ni42OTcsMjYxLjk0NSwxNzUuNTc2TDI2MS45NDUsMTc1LjU3NnogTTI2MS45NDUsMTc1LjU3NiIgZmlsbD0iI0ZGRkZGRiIvPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo=" width="50" height="20" />
				</div>
			</a>
		<?php } ?>
		<?php if($redux_builder_amp['enable-single-odnoklassniki-share'] == true)  { ?>
			<a title="odnoklassniki share" href="https://ok.ru/dk?st.cmd=addShare&st._surl=<?php echo $amp_permalink; ?>" target="_blank">
				<div class="amp-social-icon amp-social-odnoklassniki"> 
					<amp-img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTYuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgd2lkdGg9IjY0cHgiIGhlaWdodD0iNjRweCIgdmlld0JveD0iMCAwIDk1LjQ4MSA5NS40ODEiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDk1LjQ4MSA5NS40ODE7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4KPGc+Cgk8Zz4KCQk8cGF0aCBkPSJNNDMuMDQxLDY3LjI1NGMtNy40MDItMC43NzItMTQuMDc2LTIuNTk1LTE5Ljc5LTcuMDY0Yy0wLjcwOS0wLjU1Ni0xLjQ0MS0xLjA5Mi0yLjA4OC0xLjcxMyAgICBjLTIuNTAxLTIuNDAyLTIuNzUzLTUuMTUzLTAuNzc0LTcuOTg4YzEuNjkzLTIuNDI2LDQuNTM1LTMuMDc1LDcuNDg5LTEuNjgyYzAuNTcyLDAuMjcsMS4xMTcsMC42MDcsMS42MzksMC45NjkgICAgYzEwLjY0OSw3LjMxNywyNS4yNzgsNy41MTksMzUuOTY3LDAuMzI5YzEuMDU5LTAuODEyLDIuMTkxLTEuNDc0LDMuNTAzLTEuODEyYzIuNTUxLTAuNjU1LDQuOTMsMC4yODIsNi4yOTksMi41MTQgICAgYzEuNTY0LDIuNTQ5LDEuNTQ0LDUuMDM3LTAuMzgzLDcuMDE2Yy0yLjk1NiwzLjAzNC02LjUxMSw1LjIyOS0xMC40NjEsNi43NjFjLTMuNzM1LDEuNDQ4LTcuODI2LDIuMTc3LTExLjg3NSwyLjY2MSAgICBjMC42MTEsMC42NjUsMC44OTksMC45OTIsMS4yODEsMS4zNzZjNS40OTgsNS41MjQsMTEuMDIsMTEuMDI1LDE2LjUsMTYuNTY2YzEuODY3LDEuODg4LDIuMjU3LDQuMjI5LDEuMjI5LDYuNDI1ICAgIGMtMS4xMjQsMi40LTMuNjQsMy45NzktNi4xMDcsMy44MWMtMS41NjMtMC4xMDgtMi43ODItMC44ODYtMy44NjUtMS45NzdjLTQuMTQ5LTQuMTc1LTguMzc2LTguMjczLTEyLjQ0MS0xMi41MjcgICAgYy0xLjE4My0xLjIzNy0xLjc1Mi0xLjAwMy0yLjc5NiwwLjA3MWMtNC4xNzQsNC4yOTctOC40MTYsOC41MjgtMTIuNjgzLDEyLjczNWMtMS45MTYsMS44ODktNC4xOTYsMi4yMjktNi40MTgsMS4xNSAgICBjLTIuMzYyLTEuMTQ1LTMuODY1LTMuNTU2LTMuNzQ5LTUuOTc5YzAuMDgtMS42MzksMC44ODYtMi44OTEsMi4wMTEtNC4wMTRjNS40NDEtNS40MzMsMTAuODY3LTEwLjg4LDE2LjI5NS0xNi4zMjIgICAgQzQyLjE4Myw2OC4xOTcsNDIuNTE4LDY3LjgxMyw0My4wNDEsNjcuMjU0eiIgZmlsbD0iI0ZGRkZGRiIvPgoJCTxwYXRoIGQ9Ik00Ny41NSw0OC4zMjljLTEzLjIwNS0wLjA0NS0yNC4wMzMtMTAuOTkyLTIzLjk1Ni0yNC4yMThDMjMuNjcsMTAuNzM5LDM0LjUwNS0wLjAzNyw0Ny44NCwwICAgIGMxMy4zNjIsMC4wMzYsMjQuMDg3LDEwLjk2NywyNC4wMiwyNC40NzhDNzEuNzkyLDM3LjY3Nyw2MC44ODksNDguMzc1LDQ3LjU1LDQ4LjMyOXogTTU5LjU1MSwyNC4xNDMgICAgYy0wLjAyMy02LjU2Ny01LjI1My0xMS43OTUtMTEuODA3LTExLjgwMWMtNi42MDktMC4wMDctMTEuODg2LDUuMzE2LTExLjgzNSwxMS45NDNjMC4wNDksNi41NDIsNS4zMjQsMTEuNzMzLDExLjg5NiwxMS43MDkgICAgQzU0LjM1NywzNS45NzEsNTkuNTczLDMwLjcwOSw1OS41NTEsMjQuMTQzeiIgZmlsbD0iI0ZGRkZGRiIvPgoJPC9nPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo=" width="50" height="20" />
				</div>
			</a>
		<?php } ?>
		<?php if ( true == $redux_builder_amp['enable-single-reddit-share'] ) { ?>
			<a title="reddit share" href="https://reddit.com/submit?url=<?php echo esc_url($amp_permalink); ?>&title=<?php echo esc_attr(get_the_title()); ?>" target="_blank">
				<div class="amp-social-icon amp-social-reddit"> 
					<amp-img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjAiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgNDQ5IDUxMiIgZmlsbD0iI2ZmZmZmZiIgPjxwYXRoIGQ9Ik00NDkgMjUxYzAgMjAtMTEgMzctMjcgNDUgMSA1IDEgOSAxIDE0IDAgNzYtODkgMTM4LTE5OSAxMzhTMjYgMzg3IDI2IDMxMWMwLTUgMC0xMCAxLTE1LTE2LTgtMjctMjUtMjctNDUgMC0yOCAyMy01MCA1MC01MCAxMyAwIDI0IDUgMzMgMTMgMzMtMjMgNzktMzkgMTI5LTQxaDJsMzEtMTAzIDkwIDE4YzgtMTQgMjItMjQgMzktMjRoMWMyNSAwIDQ0IDIwIDQ0IDQ1cy0xOSA0NS00NCA0NWgtMWMtMjMgMC00Mi0xNy00NC00MGwtNjctMTQtMjIgNzRjNDkgMyA5MyAxNyAxMjUgNDAgOS04IDIxLTEzIDM0LTEzIDI3IDAgNDkgMjIgNDkgNTB6TTM0IDI3MWM1LTE1IDE1LTI5IDI5LTQxLTQtMy05LTUtMTUtNS0xNCAwLTI1IDExLTI1IDI1IDAgOSA0IDE3IDExIDIxem0zMjQtMTYyYzAgOSA3IDE3IDE2IDE3czE3LTggMTctMTctOC0xNy0xNy0xNy0xNiA4LTE2IDE3ek0xMjcgMjg4YzAgMTggMTQgMzIgMzIgMzJzMzItMTQgMzItMzItMTQtMzEtMzItMzEtMzIgMTMtMzIgMzF6bTk3IDExMmM0OCAwIDc3LTI5IDc4LTMwbC0xMy0xMnMtMjUgMjQtNjUgMjRjLTQxIDAtNjQtMjQtNjQtMjRsLTEzIDEyYzEgMSAyOSAzMCA3NyAzMHptNjctODBjMTggMCAzMi0xNCAzMi0zMnMtMTQtMzEtMzItMzEtMzIgMTMtMzIgMzEgMTQgMzIgMzIgMzJ6bTEyNC00OGM3LTUgMTEtMTMgMTEtMjIgMC0xNC0xMS0yNS0yNS0yNS02IDAtMTEgMi0xNSA1IDE0IDEyIDI0IDI3IDI5IDQyeiI+PC9wYXRoPjwvc3ZnPg==" width="50" height="20" />
				</div>
			</a>
		<?php } ?>
		<?php if ( true == $redux_builder_amp['enable-single-tumblr-share'] ) { ?>
			<a title="tumblr share" href="https://www.tumblr.com/widgets/share/tool?canonicalUrl=<?php echo esc_url($amp_permalink); ?>&title=<?php echo esc_attr(get_the_title()); ?>&caption=<?php echo esc_attr(get_the_excerpt()); ?>" target="_blank">
				<div class="amp-social-icon amp-social-tumblr"> 
					<amp-img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjAiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgNjQgNjQiIGZpbGw9IiNmZmZmZmYiID48cGF0aCBkPSJNMzYuMDAyIDI4djE0LjYzNmMwIDMuNzE0LS4wNDggNS44NTMuMzQ2IDYuOTA2LjM5IDEuMDQ3IDEuMzcgMi4xMzQgMi40MzcgMi43NjMgMS40MTguODUgMy4wMzQgMS4yNzMgNC44NTcgMS4yNzMgMy4yNCAwIDUuMTU1LS40MjggOC4zNi0yLjUzNHY5LjYyYy0yLjczMiAxLjI4Ni01LjExOCAyLjAzOC03LjMzNCAyLjU2LTIuMjIuNTE0LTQuNjE2Ljc3NC03LjE5Ljc3NC0yLjkyOCAwLTQuNjU1LS4zNjgtNi45MDItMS4xMDMtMi4yNDctLjc0Mi00LjE2Ni0xLjgtNS43NS0zLjE2LTEuNTkyLTEuMzctMi42OS0yLjgyNC0zLjMwNC00LjM2M3MtLjkyLTMuNzc2LS45Mi02LjcwM1YyNi4yMjRoLTguNTl2LTkuMDYzYzIuNTE0LS44MTUgNS4zMjQtMS45ODcgNy4xMTItMy41MSAxLjc5Ny0xLjUyNyAzLjIzNS0zLjM1NiA0LjMyLTUuNDk2QzI0LjUzIDYuMDIyIDI1LjI3NiAzLjMgMjUuNjgzIDBoMTAuMzJ2MTZINTJ2MTJIMzYuMDA0eiI+PC9wYXRoPjwvc3ZnPg==" width="50" height="20" />
				</div>
			</a>
		<?php } ?>
		<?php if ( true == $redux_builder_amp['enable-single-telegram-share'] ) { ?>
			<a title="telegram share" href="https://telegram.me/share/url?url=<?php echo esc_url($amp_permalink); ?>&text=<?php echo esc_attr(get_the_title()); ?>" target="_blank">
				<div class="amp-social-icon amp-social-telegram"> 
					<amp-img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTguMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDQ1NS43MzEgNDU1LjczMSIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNDU1LjczMSA0NTUuNzMxOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjUxMnB4IiBoZWlnaHQ9IjUxMnB4Ij4KPGc+Cgk8cmVjdCB4PSIwIiB5PSIwIiBzdHlsZT0iZmlsbDojNjFBOERFOyIgd2lkdGg9IjQ1NS43MzEiIGhlaWdodD0iNDU1LjczMSIvPgoJPHBhdGggc3R5bGU9ImZpbGw6I0ZGRkZGRjsiIGQ9Ik0zNTguODQ0LDEwMC42TDU0LjA5MSwyMTkuMzU5Yy05Ljg3MSwzLjg0Ny05LjI3MywxOC4wMTIsMC44ODgsMjEuMDEybDc3LjQ0MSwyMi44NjhsMjguOTAxLDkxLjcwNiAgIGMzLjAxOSw5LjU3OSwxNS4xNTgsMTIuNDgzLDIyLjE4NSw1LjMwOGw0MC4wMzktNDAuODgybDc4LjU2LDU3LjY2NWM5LjYxNCw3LjA1NywyMy4zMDYsMS44MTQsMjUuNzQ3LTkuODU5bDUyLjAzMS0yNDguNzYgICBDMzgyLjQzMSwxMDYuMjMyLDM3MC40NDMsOTYuMDgsMzU4Ljg0NCwxMDAuNnogTTMyMC42MzYsMTU1LjgwNkwxNzkuMDgsMjgwLjk4NGMtMS40MTEsMS4yNDgtMi4zMDksMi45NzUtMi41MTksNC44NDcgICBsLTUuNDUsNDguNDQ4Yy0wLjE3OCwxLjU4LTIuMzg5LDEuNzg5LTIuODYxLDAuMjcxbC0yMi40MjMtNzIuMjUzYy0xLjAyNy0zLjMwOCwwLjMxMi02Ljg5MiwzLjI1NS04LjcxN2wxNjcuMTYzLTEwMy42NzYgICBDMzIwLjA4OSwxNDcuNTE4LDMyNC4wMjUsMTUyLjgxLDMyMC42MzYsMTU1LjgwNnoiLz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K" width="50" height="20" />
				</div>
			</a>
		<?php } ?>
		<?php if ( true == $redux_builder_amp['enable-single-digg-share'] ) { ?>
			<a title="digg share" href="http://digg.com/submit?url=<?php echo esc_url($amp_permalink); ?>&title=<?php echo esc_attr(get_the_title()); ?>" target="_blank">
				<div class="amp-social-icon amp-social-digg"> 
					<amp-img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjAiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgMjA0OCAxODk2LjA4MzMiIGZpbGw9IiNmZmZmZmYiID48cGF0aCBkPSJNMzI4IDI4MmgyMDR2OTgzSDBWNTY4aDMyOFYyODJ6bTAgODE5VjczMkgyMDV2MzY5aDEyM3ptMjg2LTUzM3Y2OTdoMjA1VjU2OEg2MTR6bTAtMjg2djIwNGgyMDVWMjgySDYxNHptMjg3IDI4Nmg1MzN2OTQySDkwMXYtMTYzaDMyOHYtODJIOTAxVjU2OHptMzI4IDUzM1Y3MzJoLTEyM3YzNjloMTIzem0yODctNTMzaDUzMnY5NDJoLTUzMnYtMTYzaDMyN3YtODJoLTMyN1Y1Njh6bTMyNyA1MzNWNzMyaC0xMjN2MzY5aDEyM3oiPjwvcGF0aD48L3N2Zz4=" width="50" height="20" />
				</div>
			</a>
		<?php } ?>
		<?php if ( true == $redux_builder_amp['enable-single-stumbleupon-share'] ) { ?>
			<a title="stumbleupon share" href="http://www.stumbleupon.com/submit?url=<?php echo esc_url($amp_permalink); ?>&title=<?php echo esc_attr(get_the_title()); ?>" target="_blank">
				<div class="amp-social-icon amp-social-stumbleupon"> 
					<amp-img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjAiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgNjcwLjIyMzMgNjAxLjA4NjkiIGZpbGw9IiNmZmZmZmYiID48cGF0aCBkPSJNMCA0MzcuMjQ3di05Mi42NzJoMTE0LjY4OHY5MS42NjRjMCA5LjU2NyAzLjQwOCAxNy44MjMgMTAuMjQgMjQuODNzMTUuMTg0IDEwLjQ5NyAyNS4wODggMTAuNDk3IDE4LjMzNi0zLjQyNCAyNS4zNDQtMTAuMjRjNy4wMDgtNi44NDggMTAuNDk2LTE1LjIgMTAuNDk2LTI1LjA4OFYyMTkuNjQ2YzAtMzkuOTM1IDE0Ljc1Mi03My45ODQgNDQuMjg4LTEwMi4xNDQgMjkuNTM2LTI4LjE2IDY0LjYwOC00Mi4yNCAxMDUuMjE2LTQyLjI0IDQwLjYwOCAwIDc1LjY4IDE0LjE2IDEwNS4yMTYgNDIuNDk2IDI5LjUyIDI4LjMzNSA0NC4zMDUgNjIuNjQgNDQuMzA1IDEwMi45MXY0Ny4xMDRsLTY4LjYyMyAyMC40OC00NS41Ny0yMS41MDN2LTQwLjk2YzAtOS45MDMtMy40MDctMTguMjU2LTEwLjI1NS0yNS4wODgtNi44MTYtNi44MzItMTUuMTgzLTEwLjI0LTI1LjA3Mi0xMC4yNC05LjkwMyAwLTE4LjMzNiAzLjQwOC0yNS4zNDQgMTAuMjRzLTEwLjQ5NiAxNS4xODUtMTAuNDk2IDI1LjA5djIxMy41MDNjMCA0MC45NzYtMTQuNjcyIDc1Ljg3Mi00NC4wMzIgMTA0LjcyLTI5LjM0NCAyOC44NDgtNjQuNTEyIDQzLjI0OC0xMDUuNDcyIDQzLjI0OC00MS4zMSAwLTc2LjY0LTE0LjU5Mi0xMDUuOTg0LTQzLjc3NkMxNC42ODggNTE0LjMwMy4wMDIgNDc4Ljg4LjAwMiA0MzcuMjQ3em0zNzAuNjg4IDEuNTM2di05My42OTVsNDUuNTY4IDIxLjUyIDY4LjYyNC0yMC40OTd2OTQuMjI2YzAgOS45MDMgMy40MDggMTguMzM2IDEwLjIyNCAyNS4zNDQgNi44NDcgNy4wMDcgMTUuMiAxMC40OTYgMjUuMDg3IDEwLjQ5NiA5LjkwNiAwIDE4LjI3NC0zLjUwNCAyNS4wOS0xMC40OTYgNi44MTYtNi45OTMgMTAuMjU1LTE1LjQ0IDEwLjI1NS0yNS4zNDR2LTk1Ljc0NGgxMTQuNjg4djkyLjY3MmMwIDQxLjI5NS0xNC41OSA3Ni42NC00My43NzYgMTA1Ljk4My0yOS4xODQgMjkuMzYtNjQuNDMyIDQ0LjAzMi0xMDUuNzI4IDQ0LjAzMnMtNzYuNjI1LTE0LjQ5Ny0xMDUuOTg1LTQzLjUyYy0yOS4zNi0yOS4wNC00NC4wNDgtNjQuMDE3LTQ0LjA0OC0xMDQuOTc4eiI+PC9wYXRoPjwvc3ZnPg==" width="50" height="20" />
				</div>
			</a>
		<?php } ?>
		<?php if ( true == $redux_builder_amp['enable-single-wechat-share'] ) { ?>
			<a title="wechat share" href="http://api.addthis.com/oexchange/0.8/forward/wechat/offer?url=<?php echo esc_url($amp_permalink); ?>" target="_blank">
				<div class="amp-social-icon amp-social-wechat"> 
					<amp-img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjAiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgMjA0OCAxODk2LjA4MzMiIGZpbGw9IiNmZmZmZmYiID48cGF0aCBkPSJNNTgwIDQ2MXEwLTQxLTI1LTY2dC02Ni0yNXEtNDMgMC03NiAyNS41VDM4MCA0NjFxMCAzOSAzMyA2NC41dDc2IDI1LjVxNDEgMCA2Ni0yNC41dDI1LTY1LjV6bTc0MyA1MDdxMC0yOC0yNS41LTUwdC02NS41LTIycS0yNyAwLTQ5LjUgMjIuNVQxMTYwIDk2OHEwIDI4IDIyLjUgNTAuNXQ0OS41IDIyLjVxNDAgMCA2NS41LTIydDI1LjUtNTF6bS0yMzYtNTA3cTAtNDEtMjQuNS02NlQ5OTcgMzcwcS00MyAwLTc2IDI1LjVUODg4IDQ2MXEwIDM5IDMzIDY0LjV0NzYgMjUuNXE0MSAwIDY1LjUtMjQuNVQxMDg3IDQ2MXptNjM1IDUwN3EwLTI4LTI2LTUwdC02NS0yMnEtMjcgMC00OS41IDIyLjVUMTU1OSA5NjhxMCAyOCAyMi41IDUwLjV0NDkuNSAyMi41cTM5IDAgNjUtMjJ0MjYtNTF6bS0yNjYtMzk3cS0zMS00LTcwLTQtMTY5IDAtMzExIDc3VDg1MS41IDg1Mi41IDc3MCAxMTQwcTAgNzggMjMgMTUyLTM1IDMtNjggMy0yNiAwLTUwLTEuNXQtNTUtNi41LTQ0LjUtNy01NC41LTEwLjUtNTAtMTAuNWwtMjUzIDEyNyA3Mi0yMThRMCA5NjUgMCA2NzhxMC0xNjkgOTcuNS0zMTF0MjY0LTIyMy41VDcyNSA2MnExNzYgMCAzMzIuNSA2NnQyNjIgMTgyLjVUMTQ1NiA1NzF6bTU5MiA1NjFxMCAxMTctNjguNSAyMjMuNVQxNzk0IDE1NDlsNTUgMTgxLTE5OS0xMDlxLTE1MCAzNy0yMTggMzctMTY5IDAtMzExLTcwLjVUODk3LjUgMTM5NiA4MTYgMTEzMnQ4MS41LTI2NFQxMTIxIDY3Ni41dDMxMS03MC41cTE2MSAwIDMwMyA3MC41dDIyNy41IDE5MlQyMDQ4IDExMzJ6Ij48L3BhdGg+PC9zdmc+" width="50" height="20" />
				</div>
			</a>
		<?php } ?>
		<?php if ( true == $redux_builder_amp['enable-single-viber-share'] ) { ?>
			<a title="viber share" href="viber://forward?text=<?php echo esc_url($amp_permalink); ?>" target="_blank">
				<div class="amp-social-icon amp-social-viber"> 
					<amp-img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjAiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgMTAyNiAxMjM0IiBmaWxsPSIjZmZmZmZmIiA+PHBhdGggZD0iTTkwNCA3OTRxLTY5IDYxLTIwMCA4Ny41VDQzNCA4OTdsLTE3NiAxMzJWODY0cS04Ny0yNy0xMzYtNzAtNTgtNTEtOTAtMTQ2LjV0LTMyLTE5NSAzMi0xOTUgOTAuNS0xNDcgMTY3LjUtNzlUNTEzIDR0MjIzIDI3LjUgMTY3LjUgNzkgOTAuNSAxNDcgMzIgMTk1LTMyIDE5NVQ5MDQgNzk0ek02MzkgNTQ5bDY1IDExcS04LTEyMC05Mi41LTIwNVQ0MDcgMjYybDExIDY1cTg2IDExIDE0OCA3M3Q3MyAxNDl6TTQyOSAzOTRsMTIgNzJxNDAgMjAgNTkgNTlsNzIgMTJxLTEyLTUzLTUxLTkxLjVUNDI5IDM5NHptLTEwNyA1OXYtNjRxMC0xNy0xMi41LTM0VDI4MyAzMzAuNXQtMjEtMS41bC00NiA0N3EtMzkgMzktMTEuNSAxMjEuNXQxMDUgMTYwIDE2MCAxMDVUNTkwIDc1MWw0Ny00N3E3LTYtLjUtMjAuNVQ2MTIgNjU3dC0zNC0xMmgtNjRsLTM3IDMycS00NC0xMi0xMDkuNS03Ny41VDI5MCA0ODl6bTY0LTMyMGwxMCA2NXExMDAgMiAxODUgNTIuNXQxMzUgMTM1VDc2OSA1NzBsNjUgMTFxMC05MS0zNS41LTE3NFQ3MDMgMjY0dC0xNDMtOTUuNVQzODYgMTMzeiI+PC9wYXRoPjwvc3ZnPg==" width="50" height="20" />
				</div>
			</a>
		<?php } ?>
		<?php if ( true == $redux_builder_amp['enable-single-hatena-bookmarks'] ) { ?>
			<a title="hatena share" href="http://b.hatena.ne.jp/entry/<?php echo esc_url($amp_permalink); ?>" target="_blank">
				<div class="amp-social-icon amp-social-hatena"> 
					<amp-img src="data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' width='512' height='512' viewBox='0 0 512 512'%3e%3cpath d='M 64 96 L 64 416 L 212 416 C 252 416 292 404 308 368 C 328 332 320 276 284 252 C 272 244 260 240 248 236 C 276 232 300 212 300 184 C 304 156 296 120 268 108 C 236 96 192 96 160 96 L 64 96 z M 364 96 L 364 308 L 444 308 L 444 96 L 364 96 z M 144 156 C 144 156 188 156 200 160 C 224 168 224 208 196 212 C 188 216 144 216 144 216 L 144 156 z M 144 280 C 144 280 188 280 208 284 C 232 288 240 312 228 332 C 220 348 204 348 188 348 L 144 348 L 144 280 z M 404 328 A 44 44 0 0 0 360 372 A 44 44 0 0 0 404 416 A 44 44 0 0 0 448 372 A 44 44 0 0 0 404 328 z' style='fill:%23ffffff'/%3e%3c/svg%3e" width="50" height="20" />
				</div>
			</a>
		<?php } ?>
		<?php if ( true == $redux_builder_amp['enable-single-pocket-share'] ) { ?>
			<a title="pocket share" href="https://getpocket.com/save?url=<?php echo esc_url($amp_permalink); ?>" target="_blank">
				<div class="amp-social-icon amp-social-pocket"> 
					<amp-img src="data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' width='2500' height='2251' viewBox='75.247 261.708 445.529 401.074'%3e%3cpath fill='%23EF4056' d='M114.219 261.708c-24.275 1.582-38.972 15.44-38.972 40.088v147.611c0 119.893 119.242 214.114 222.393 213.37 115.986-.837 223.137-98.779 223.137-213.37V301.796c0-24.741-15.626-38.693-40.088-40.088h-366.47zm93.943 120.079L297.64 466.8l89.571-85.013c40.088-16.835 57.574 28.927 41.111 42.321L311.685 535.443c-3.813 3.628-24.183 3.628-27.996 0L167.051 424.107c-15.72-14.789 4.743-61.295 41.111-42.32z'/%3e%3c/svg%3e" width="50" height="20" />
				</div>
			</a>
		<?php } ?>
	</div> 
	<?php }
		//}
}

//	25. Yoast meta Support
function ampforwp_custom_yoast_meta(){
	global $redux_builder_amp;
	if ($redux_builder_amp['ampforwp-seo-yoast-meta']) {
		if(! class_exists('YoastSEO_AMP') ) {
				if ( class_exists('WPSEO_Options')) {
					$options = WPSEO_Options::get_option( 'wpseo_social' );
					if ( $options['twitter'] === true ) {
						WPSEO_Twitter::get_instance();
					}
					if ( $options['opengraph'] === true ) {
						$GLOBALS['wpseo_og'] = new WPSEO_OpenGraph;
					}
					do_action( 'wpseo_opengraph' );
				}
		}//execute only if Glue is deactive
			if(isset($redux_builder_amp['ampforwp-seo-custom-additional-meta']) && $redux_builder_amp['ampforwp-seo-custom-additional-meta']){
				echo strip_tags($redux_builder_amp['ampforwp-seo-custom-additional-meta'], '<link><meta>' );
			}		
	} else {
		if(isset($redux_builder_amp['ampforwp-seo-custom-additional-meta']) && $redux_builder_amp['ampforwp-seo-custom-additional-meta']){
			echo strip_tags($redux_builder_amp['ampforwp-seo-custom-additional-meta'], '<link><meta>' );
		}
	}
}

function ampforwp_custom_yoast_meta_homepage(){
	global $redux_builder_amp;
	if ($redux_builder_amp['ampforwp-seo-yoast-meta']) {
		if(! class_exists('YoastSEO_AMP') ) {
				if ( class_exists('WPSEO_Options')) {
					if( method_exists('WPSEO_Options', 'get_option')){
						$options = WPSEO_Options::get_option( 'wpseo_social' );
						if ( $options['twitter'] === true ) {
							WPSEO_Twitter::get_instance();
						}
						if ( $options['opengraph'] === true ) {
							$GLOBALS['wpseo_og'] = new WPSEO_OpenGraph;
						}
					}
				}
				do_action( 'wpseo_opengraph' );

		}//execute only if Glue is deactive
		if(isset($redux_builder_amp['ampforwp-seo-custom-additional-meta']) && $redux_builder_amp['ampforwp-seo-custom-additional-meta']){
			echo strip_tags($redux_builder_amp['ampforwp-seo-custom-additional-meta'], '<link><meta>' );
		}
	}
}

function ampforwp_add_proper_post_meta(){
	$check_custom_front_page = get_option('show_on_front');
	if ( $check_custom_front_page == 'page' ) {
		add_action( 'amp_post_template_head', 'ampforwp_custom_yoast_meta_homepage' );
		if(is_home()){
			add_filter('wpseo_opengraph_title', 'ampforwp_custom_twitter_title_homepage');
			add_filter('wpseo_twitter_title', 'ampforwp_custom_twitter_title_homepage');
	

			add_filter('wpseo_opengraph_desc', 'ampforwp_custom_twitter_description_homepage');
			add_filter('wpseo_twitter_description', 'ampforwp_custom_twitter_description_homepage');

			add_filter('wpseo_opengraph_url', 'ampforwp_custom_og_url_homepage');
		

		// This is causing the 2nd debug issue reported in #740
		// add_filter('wpseo_twitter_image', 'ampforwp_custom_og_image_homepage');
		add_filter('wpseo_opengraph_image', 'ampforwp_custom_og_image_homepage');
	}
	} else {
		add_action( 'amp_post_template_head', 'ampforwp_custom_yoast_meta' );
	}
}
add_action('pre_amp_render_post','ampforwp_add_proper_post_meta');


function ampforwp_custom_twitter_title_homepage() {
	//Added the opengraph for frontpage in AMP #2454
		if(ampforwp_is_front_page()){
			$get_title = ampforwp_get_setting('amp-frontpage-select-option-pages');
			return get_the_title($get_title);

		}
		return  esc_attr( get_bloginfo( 'name' ) );
}
function ampforwp_custom_twitter_description_homepage() {
	if(ampforwp_is_front_page()){
			$get_excerpt = ampforwp_get_setting('amp-frontpage-select-option-pages');
			return wp_trim_words(get_post_field('post_content', $get_excerpt), 26);
			
		}
	
	return  esc_attr( get_bloginfo( 'description' ) );
}
function ampforwp_custom_og_url_homepage() {
	return esc_url( get_bloginfo( 'url' ) );
}
function ampforwp_custom_og_image_homepage() {
	if ( class_exists('WPSEO_Options') ) {
		$options = WPSEO_Options::get_option( 'wpseo_social' );
		return  $options['og_default_image'] ;
	}
}


/**
 * PR by Sybre Waaijer:
 * @link https://github.com/ahmedkaludi/accelerated-mobile-pages/pull/761
 *
 * @since version 0.9.48 :
 *   1. Removes unused code.
 *   2. Cleaned up code.
 *   3. Keeps legacy action in place.
 *   4. No longer replaces the title tag.
 *   5. Instead, filters the title tag.
 *   6. Therefore, it works with all SEO plugins.
 *   7. Removed direct Yoast SEO compat -- It's no longer needed.
 *   8. Removed unwanted spaces.
 *   9. Improved performance.
 *   10. Improved security.
 *   11. Added support for CPT and attachment pages.
 */
//26. Extending Title Tagand De-Hooking the Standard one from AMP
add_action( 'pre_amp_render_post', 'ampforwp_remove_title_tags');
function ampforwp_remove_title_tags() {
	return ampforwp_replace_title_tags();
}
function ampforwp_replace_title_tags() {

	add_filter( 'pre_get_document_title', 'ampforwp_add_custom_title_tag', 10 );
	add_filter( 'wp_title', 'ampforwp_add_custom_title_tag', 10, 3 );

	function ampforwp_add_custom_title_tag( $title = '', $sep = '', $seplocation = '' ) {
		global $redux_builder_amp, $post;
		$site_title = '';
		$genesis_title = '';
		if ( !$post ) {
			return;
		}
		$post_id = $post->ID;
		if ( ampforwp_is_front_page() ) {
				$post_id = ampforwp_get_frontpage_id();
		}

		//* We can filter this later if needed:
		$sep = ' | ';

		if ( is_singular() ) {
			$title = ! empty( $post->post_title ) ? $post->post_title : $title;
			$site_title = $title . $sep . get_option( 'blogname' );
		} elseif ( is_archive() && $redux_builder_amp['ampforwp-archive-support'] ) {
			$site_title = strip_tags( get_the_archive_title( '' ) . $sep . get_the_archive_description( '' ) );
		}

		if ( is_home() ) {
			// Custom frontpage
			$site_title = get_bloginfo( 'name' ) . $sep . get_option( 'blogdescription' );

			if ( ampforwp_is_front_page() ) {
				//WPML Static Front Page Support for title and description with Yoast #1143
				include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
				if ( is_plugin_active( 'sitepress-multilingual-cms/sitepress.php' ) ) {
				 	$ID = get_option( 'page_on_front' );
				}
				else {
					$ID = ampforwp_get_frontpage_id();
				}
				$site_title = get_the_title( $ID ) . $sep . get_option( 'blogname' );				
			}
			// Blog page 
			if ( ampforwp_is_blog() ) {
				$ID = ampforwp_get_blog_details('id');
				$site_title = get_the_title( $ID ) . $sep . get_option( 'blogname' );
			}
			// Custom Front Page Title From Yoast SEO #1163
			if ( class_exists('WPSEO_Meta_Columns') && (ampforwp_is_front_page() || ampforwp_is_blog()) ) {
			 	$ID = ampforwp_get_frontpage_id();
			 	if ( ampforwp_is_blog() ) {
			 		$ID = ampforwp_get_blog_details('id');
			 	}
			 	$fixed_title = WPSEO_Meta::get_value( 'title', $ID );
			 	if ( $fixed_title ) {
			 		$site_title = apply_filters( 'wpseo_title', wpseo_replace_vars( $fixed_title, get_post( $ID, ARRAY_A ) )  );
			 	}
			}
		}

		if ( is_search() ) {
			$site_title = $redux_builder_amp['amp-translator-search-text'] . ' ' . get_search_query();
		}
		//Genesis #1013
		if( function_exists('genesis_title') && 4 == ampforwp_get_setting('ampforwp-seo-selection') ){
			if(is_home() && is_front_page() && !$redux_builder_amp['amp-frontpage-select-option']){
				// Determine the doctitle.
			$genesis_title = genesis_get_seo_option( 'home_doctitle' ) ? genesis_get_seo_option( 'home_doctitle' ) : get_bloginfo( 'name' );

			// Append site description, if necessary.
			$genesis_title = genesis_get_seo_option( 'append_description_home' ) ? $genesis_title . " $sep " . get_bloginfo( 'description' ) : $genesis_title;
			}
			elseif ( is_home() && get_option( 'page_for_posts' ) && get_queried_object_id() ) 
			{ 
				$post_id = get_option( 'page_for_posts' );
				if ( null !== $post_id || is_singular() ) {
					if ( genesis_get_custom_field( '_genesis_title', $post_id ) ) {
						$genesis_title = genesis_get_custom_field( '_genesis_title', $post_id );
					}
				}
			}
			elseif( is_home() && get_option( 'page_on_front' ) && $redux_builder_amp['amp-frontpage-select-option'] ){
				$post_id = get_option('page_on_front');
					if ( null !== $post_id || is_singular() ) {
						if ( genesis_get_custom_field( '_genesis_title', $post_id ) ) {
							$genesis_title = genesis_get_custom_field( '_genesis_title', $post_id );
						}
					}
			}
			elseif ( is_archive() ) {
				if ( is_category() || is_tag() || is_tax() ) {
					$term       = get_queried_object();
					$title_meta = get_term_meta( $term->term_id, 'doctitle', true );
					$genesis_title      = ! empty( $title_meta ) ? $title_meta : $title;
				}

				if ( is_author() ) {
					$user_title = get_the_author_meta( 'doctitle', (int) get_query_var( 'author' ) );
					$genesis_title      = $user_title ? $user_title : $title;
				}

				if ( is_post_type_archive() && genesis_has_post_type_archive_support() ) {
					$genesis_title = genesis_get_cpt_option( 'doctitle' ) ? genesis_get_cpt_option( 'doctitle' ) : $title;
				}

			}
			else {
				//$genesis_title = genesis_default_title( $title );
				// genesis_default_title has been depreciated, let's do it with another method #2050
				$genesis_title = genesis_get_custom_field( '_genesis_title' );
			}
			if( $genesis_title ){
				$site_title = $genesis_title;
			}
		}
		// SEOPress
		elseif ( is_plugin_active('wp-seopress/seopress.php') && 3 == $redux_builder_amp['ampforwp-seo-selection'] ) {
			$seopress_title = $seopress_options = '';
			$seopress_options = get_option("seopress_titles_option_name");
			if ( get_post_meta($post_id,'_seopress_titles_title',true) ) {
				$seopress_title = get_post_meta($post_id,'_seopress_titles_title',true);
			}
			if ( ampforwp_is_home() || ampforwp_is_blog() ) {
				$seopress_titles_template_variables_array = array('%%sitetitle%%','%%tagline%%');
				$seopress_titles_template_replace_array = array( get_bloginfo('name'), get_bloginfo('description') );
				$seopress_title = $seopress_options['seopress_titles_home_site_title'];
				$seopress_title = str_replace($seopress_titles_template_variables_array, $seopress_titles_template_replace_array, $seopress_title);

			}
			if ( is_archive() ) {
				$seopress_title = get_term_meta(get_queried_object()->{'term_id'},'_seopress_titles_title',true);
			}
			if ( $seopress_title ) {
				$site_title = $seopress_title;
			}
		}
		return esc_html( convert_chars( wptexturize( trim( $site_title ) ) ) );
	}
}


add_action('amp_post_template_include_single','ampforwp_update_title_for_frontpage');
function ampforwp_update_title_for_frontpage() {
	$check_custom_front_page = get_option('show_on_front');

	if ( $check_custom_front_page == 'page' && is_home() ) {

		remove_action( 'amp_post_template_head', 'amp_post_template_add_title' );
		add_action('amp_post_template_head','ampforwp_frontpage_title_markup');

		add_filter('aioseop_title','ampforwp_aioseop_front_page_title');
	}
}
// Custom Frontpage title for ALL in one SEO.
function ampforwp_aioseop_front_page_title() {
	$sep = ' | ';
	return $site_title = get_bloginfo( 'name' ) . $sep . get_option( 'blogdescription' );
}

function ampforwp_frontpage_title_markup () { 
	$front_page_title = ampforwp_add_custom_title_tag();
	$front_page_title = apply_filters('ampforwp_frontpage_title_filter', $front_page_title); 
	?><title><?php echo esc_html( $front_page_title ); ?></title><?php
}

// 27. Clean the Defer issue
	// Moved to functions.php

// 28. Properly removes AMP if turned off from Post panel
add_filter( 'amp_skip_post', 'ampforwp_skip_amp_post', 10, 3 );
function ampforwp_skip_amp_post( $skip, $post_id, $post ) {
	$amp_metas = json_decode(get_post_meta( $post->ID , 'ampforwp-post-metas' , true ),true);
	$ampforwp_amp_post_on_off_meta = $amp_metas['ampforwp-amp-on-off'];
	if( $ampforwp_amp_post_on_off_meta === 'hide-amp' ) {
		$skip = true;
	}
    return $skip;
}

// 29. Remove analytics code if Already added by Glue or Yoast SEO (#370)
	add_action('init','remove_analytics_code_if_available',20);
	function remove_analytics_code_if_available(){
		if ( class_exists('WPSEO_Options') && class_exists('YoastSEO_AMP') ) {
			$yoast_glue_seo = get_option('wpseo_amp');

			if ( $yoast_glue_seo['analytics-extra'] ) {
				remove_action('amp_post_template_head','ampforwp_register_analytics_script', 20);
				remove_action('amp_post_template_footer','ampforwp_analytics',11);
			}

			if ( class_exists('Yoast_GA_Options') ) {
				$UA = Yoast_GA_Options::instance()->get_tracking_code();
				if ( $UA ) {
					remove_action('amp_post_template_head','ampforwp_register_analytics_script', 20);
					remove_action('amp_post_template_footer','ampforwp_analytics',11);
				}
			}
		}
	}

//30. TagDiv menu issue removed
	add_action('init','ampforwp_remove_tagdiv_mobile_menu');
	function ampforwp_remove_tagdiv_mobile_menu() {
		if( class_exists( 'Mobile_Detect' )) {
			remove_action('option_stylesheet', array('td_mobile_theme', 'mobile'));
		}
	}

//31. removing scripts added by cleantalk and 
 	//	#525 WordPress Twitter Bootstrap CSS
add_action('amp_init','ampforwp_remove_js_script_cleantalk');
function ampforwp_remove_js_script_cleantalk() {
	$current_url = '';
	$amp_check =  '';
  
	$current_url = $_SERVER['REQUEST_URI'];
	$current_url = explode('/', $current_url);
	$current_url = array_filter($current_url);
	$amp_check = in_array('amp', $current_url);
	if ( true === $amp_check ) {
		ampforwp_remove_filters_for_class( 'wp_loaded', 'ICWP_WPTB_CssProcessor', 'onWpLoaded', 0 );
	}

	remove_action('wp_loaded', 'ct_add_nocache_script', 1);

}

//32. various lazy loading plugins Support
add_filter( 'amp_init', 'ampforwp_lazy_loading_plugins_compatibility' );
function ampforwp_lazy_loading_plugins_compatibility() {

    // Disable HTTP protocol removing on script, link, img, srcset and form tags.
    remove_filter( 'rocket_buffer', '__rocket_protocol_rewrite', PHP_INT_MAX );
    remove_filter( 'wp_calculate_image_srcset', '__rocket_protocol_rewrite_srcset', PHP_INT_MAX );
    // Disable Concatenate Google Fonts
//    add_filter( 'get_rocket_option_minify_google_fonts', '__return_false', PHP_INT_MAX );
    // Disable CSS & JS magnification
//    add_filter( 'get_rocket_option_minify_js', '__return_false', PHP_INT_MAX );
//    add_filter( 'get_rocket_option_minify_css', '__return_false', PHP_INT_MAX );

    //Lazy Load XT
		global $lazyloadxt;
		remove_filter( 'the_content', array( $lazyloadxt, 'filter_html' ) );
		remove_filter( 'widget_text', array( $lazyloadxt, 'filter_html' ) );
		remove_filter( 'post_thumbnail_html', array( $lazyloadxt, 'filter_html' ) );
		remove_filter( 'get_avatar', array( $lazyloadxt, 'filter_html' ) );

    // Lazy Load
		add_filter( 'lazyload_is_enabled', '__return_false', PHP_INT_MAX );
}
//
// This Caused issue, Please see: https://github.com/ahmedkaludi/accelerated-mobile-pages/issues/713
//
//add_action('amp_init','ampforwp_cache_compatible_activator');
//function ampforwp_cache_compatible_activator(){
//    add_action('template_redirect','ampforwp_cache_plugin_compatible');
//}
//function ampforwp_cache_plugin_compatible(){
//    $ampforwp_is_amp_endpoint = ampforwp_is_amp_endpoint();
//    if ( ! $ampforwp_is_amp_endpoint ) {
//        return;
//    }
//    /**
//     * W3 total cache
//     */
//    add_filter( 'w3tc_minify_js_enable', array( $this, '_return_false' ) );
//    add_filter( 'w3tc_minify_css_enable', array( $this, '_return_false' ) );
//}

//Removing bj loading for amp
function ampforwp_remove_bj_load() {
 	if ( function_exists( 'ampforwp_is_amp_endpoint' ) && ampforwp_is_amp_endpoint() ) {
 		add_filter( 'bjll/enabled', '__return_false' );
 	}
}
add_action( 'bjll/compat', 'ampforwp_remove_bj_load' );

//Disable Crazy Lazy for AMP #751
function ampforwp_remove_crazy_lazy_support(){
	if( ampforwp_is_amp_endpoint() ){
		remove_action( 'wp', array( 'CrazyLazy', 'instance' ) );
	}
}
add_action('wp','ampforwp_remove_crazy_lazy_support',9);
//33. Google tag manager support added
// Remove any old scripts that have been loaded by other Plugins
add_action('init', 'amp_gtm_remove_analytics_code');
function amp_gtm_remove_analytics_code() {
  global $redux_builder_amp;
  if( isset($redux_builder_amp['amp-use-gtm-option']) && $redux_builder_amp['amp-use-gtm-option'] ) {

	  ///////////////////////////////////////////////////////////////////////////
  	// will add the scripts and analytics codes since #2340 version 0.9.97.5 //
	  ///////////////////////////////////////////////////////////////////////////

   //  remove_action('amp_post_template_footer','ampforwp_analytics',11);
  	// remove_action('amp_post_template_head','ampforwp_register_analytics_script', 20);
  	
  	//Add GTM Analytics code right after the body tag
  	add_action('ampforwp_body_beginning','AMPforWP\\AMPVendor\\amp_post_template_add_analytics_data',10);
  } else {
    remove_filter( 'amp_post_template_analytics', 'amp_gtm_add_gtm_support' );
  }

}
//Remove other analytics if GTM is enable
add_action('amp_post_template_footer','ampforwp_gtm_support', 9);
function ampforwp_gtm_support(){
  global $redux_builder_amp;
  	if( isset($redux_builder_amp['amp-use-gtm-option']) && $redux_builder_amp['amp-use-gtm-option'] ) {
		remove_action( 'amp_post_template_footer', 'amp_post_template_add_analytics_data' );
	}
}
// Create GTM support
add_filter( 'amp_post_template_analytics', 'amp_gtm_add_gtm_support' );
function amp_gtm_add_gtm_support( $analytics ) {
	global $redux_builder_amp;
	$get_gtm_id = $redux_builder_amp['amp-gtm-id'];
	$remove_spaces = str_replace(" ", "", $get_gtm_id); 

	if ( ! is_array( $analytics ) ) {
		$analytics = array();
	}
	$analytics['amp-gtm-googleanalytics'] = array(
		'type' => $redux_builder_amp['amp-gtm-analytics-type'],
		'attributes' => array(
			'data-credentials' 	=> 'include',
			'config'			=> 'https://www.googletagmanager.com/amp.json?id='. $remove_spaces .'&gtm.url=SOURCE_URL'
		),
		'config_data' => array(
			'vars' => array(
				'account' =>  $redux_builder_amp['amp-gtm-analytics-code'],
			),
			'triggers' => array(
				'trackPageview' => array(
					'on' => 'visible',
					'request' => 'pageview',
				),
			),
		),
	);
   if ( isset($redux_builder_amp['ampforwp-gtm-field-anonymizeIP']) && true == $redux_builder_amp['ampforwp-gtm-field-anonymizeIP'] ) {
		$analytics['amp-gtm-googleanalytics']['config_data']['vars']['anonymizeIP'] = 'true';
	}
	$gtm_fields = apply_filters('ampforwp_advance_gtm_analytics', $gtm_fields );
	if(ampforwp_get_setting('ampforwp-gtm-field-advance-switch')){
	$gtm_fields = preg_replace('!/\*.*?\*/!s', '', $gtm_fields); 
	$analytics['amp-gtm-googleanalytics']['config_data'] = json_decode($gtm_fields, true);
	}
	return $analytics;
}

add_filter('ampforwp_advance_gtm_analytics','ampforwp_add_advance_gtm_fields');
function ampforwp_add_advance_gtm_fields($gtm_fields){
	global $redux_builder_amp;
    $ampforwp_adv_gtm_fields = array();
	$ampforwp_adv_gtm_fields = $redux_builder_amp['ampforwp-gtm-field-advance'];
	if($ampforwp_adv_gtm_fields && ampforwp_get_setting('ampforwp-gtm-field-advance-switch')){
		return $ampforwp_adv_gtm_fields;
	}	

	return $gtm_fields;	
}


//34. social share boost compatibility Ticket #387
function social_sharing_removal_code() {
    remove_filter('the_content','ssb_in_content');
}
add_action('amp_init','social_sharing_removal_code', 9);


//35. Disqus Comments Support 
add_action('ampforwp_post_after_design_elements','ampforwp_add_disqus_support');
function ampforwp_add_disqus_support() {
	global $redux_builder_amp;
	$width = $height = 420;
	$layout = "";
	$layout = 'responsive';
	$display_comments_on = "";
	$display_comments_on = ampforwp_get_comments_status();
	if ( isset($redux_builder_amp['ampforwp-disqus-layout']) && 'fixed' == $redux_builder_amp['ampforwp-disqus-layout'] ) {
		$layout = 'fixed';
	
		if ( isset($redux_builder_amp['ampforwp-disqus-height']) && $redux_builder_amp['ampforwp-disqus-height'] ) {
			$height = $redux_builder_amp['ampforwp-disqus-height'];
		}
	}
	//if ( !comments_open() ){
	//	return;
	//}//931
	if ( $redux_builder_amp['ampforwp-disqus-comments-support'] && 4 != $redux_builder_amp['amp-design-selector'] && $display_comments_on ) {
		if( $redux_builder_amp['ampforwp-disqus-comments-name'] !== '' ) {
			global $post; $post_slug=$post->post_name;

			$disqus_script_host_url = "https://ampforwp.appspot.com/?api=". AMPFORWP_DISQUS_URL;

			if( $redux_builder_amp['ampforwp-disqus-host-position'] == 0 ) {
				$disqus_script_host_url = esc_url( $redux_builder_amp['ampforwp-disqus-host-file'] );
			}

			$disqus_url = $disqus_script_host_url.'?disqus_title='.$post_slug.'&url='.get_permalink().'&disqus_name='. esc_url( $redux_builder_amp['ampforwp-disqus-comments-name'] ) ."/embed.js"  ;
			?>
			<section class="amp-wp-content post-comments amp-wp-article-content amp-disqus-comments" id="comments">
				<amp-iframe
					height=<?php echo $height ?>
					width=<?php echo $width ?>
					layout="<?php echo $layout ?>"
					sandbox="allow-forms allow-modals allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts"
					frameborder="0"
					src="<?php echo $disqus_url ?>" >
					<div overflow tabindex="0" role="button" aria-label="Read more"><?php echo __('Disqus Comments Loading...','accelerated-mobile-pages') ?></div>
				</amp-iframe>
			</section>
		<?php
		}
	}
}

add_filter( 'amp_post_template_data', 'ampforwp_add_disqus_scripts' );
function ampforwp_add_disqus_scripts( $data ) {
	global $redux_builder_amp;
	if ( $redux_builder_amp['ampforwp-disqus-comments-support'] && is_singular() ) {
		if( $redux_builder_amp['ampforwp-disqus-comments-name'] !== '' ) {
			if ( empty( $data['amp_component_scripts']['amp-iframe'] ) ) {
				$data['amp_component_scripts']['amp-iframe'] = 'https://cdn.ampproject.org/v0/amp-iframe-0.1.js';
			}
		}
	}
	// remove direction attribute from the AMP HTMl #541
	unset( $data['html_tag_attributes']['dir'] );
	return $data;
}

// Facebook Comments Support #825

add_action('ampforwp_post_after_design_elements','ampforwp_facebook_comments_support');
function ampforwp_facebook_comments_support() {
	global $redux_builder_amp;
	if ( 4 != $redux_builder_amp['amp-design-selector'] ) {
		echo ampforwp_facebook_comments_markup();
	}
}
function ampforwp_facebook_comments_markup() {

	global $redux_builder_amp;
	$facebook_comments_markup = $lang = $locale = '';
	$lang = $redux_builder_amp['ampforwp-fb-comments-lang'];
	$locale = 'data-locale = "'.$lang.'"';
	$display_comments_on = "";
	$display_comments_on = ampforwp_get_comments_status();
	if ( $redux_builder_amp['ampforwp-facebook-comments-support'] && $display_comments_on ) { 

		$facebook_comments_markup = '<section class="amp-wp-content post-comments amp-wp-article-content amp-facebook-comments" id="comments">';
		$facebook_comments_markup .= '<amp-facebook-comments width=486 height=357
	    		layout="responsive" '.$locale.' data-numposts=';
		$facebook_comments_markup .= '"'. $redux_builder_amp['ampforwp-number-of-fb-no-of-comments']. '"';
	    if(ampforwp_get_data_consent()){		
	    	$facebook_comments_markup .= ' data-block-on-consent ';
	    }
		$facebook_comments_markup .= 'data-href="' . get_permalink() . '"';
	    $facebook_comments_markup .= '></amp-facebook-comments> </section>';

		return $facebook_comments_markup;
	}
}

add_filter( 'amp_post_template_data', 'ampforwp_add_fbcomments_scripts' );
function ampforwp_add_fbcomments_scripts( $data ) {

	global $redux_builder_amp;
	$facebook_comments_check = "";
	$facebook_comments_check = ampforwp_facebook_comments_markup();

	if ( $facebook_comments_check && $redux_builder_amp['ampforwp-facebook-comments-support'] && ( is_singular() || ampforwp_is_front_page() ) && ( ampforwp_design_selector() == 1 || ampforwp_design_selector() == 2 || ampforwp_design_selector() == 3 )) {
			if ( empty( $data['amp_component_scripts']['amp-facebook-comments'] ) ) {
				$data['amp_component_scripts']['amp-facebook-comments'] = 'https://cdn.ampproject.org/v0/amp-facebook-comments-0.1.js';
			}
		}
		return $data;
	}
//36. remove photon support in AMP
//add_action('amp_init','ampforwp_photon_remove');
//function ampforwp_photon_remove(){
//	if ( class_exists( 'Jetpack' ) ) {
//		add_filter( 'jetpack_photon_development_mode', 'ampforwp_diable_photon' );
//	}
//}
//
//function ampforwp_diable_photon() {
//	return true;
//}

//37. compatibility with wp-html-compression
function ampforwp_copat_wp_html_compression() {
	remove_action('template_redirect', 'wp_html_compression_start', -1);
	remove_action('get_header', 'wp_html_compression_start');
}
add_action('amp_init','ampforwp_copat_wp_html_compression');

//38. Extra Design Specific Features
add_action('pre_amp_render_post','ampforwp_add_extra_functions',12);
function ampforwp_add_extra_functions() {
	global $redux_builder_amp;
	if ( $redux_builder_amp['amp-design-selector'] == 3 ) {
		require AMPFORWP_PLUGIN_DIR . '/templates/design-manager/design-3/functions.php';
	}
}

//38. #529 editable archives
add_filter( 'get_the_archive_title', 'ampforwp_editable_archvies_title' );
function ampforwp_editable_archvies_title($title) {
	global $redux_builder_amp;
	$ampforwp_is_amp_endpoint = ampforwp_is_amp_endpoint();

	if ( $ampforwp_is_amp_endpoint){
	    if ( is_category() ) {
	            $title = single_cat_title( ampforwp_translation($redux_builder_amp['amp-translator-archive-cat-text'], 'Category (archive title)').' ', false );
	        } elseif ( is_tag() ) {
	            $title = single_tag_title( ampforwp_translation($redux_builder_amp['amp-translator-archive-tag-text'], 'Tag (archive title)').' ', false );
	        }
    }
    return $title;
}

//39. #560 Header and Footer Editable html enabled script area
add_action('amp_post_template_footer','ampforwp_footer_html_output',11);
function ampforwp_footer_html_output() {
  global $redux_builder_amp;
  if( $redux_builder_amp['amp-footer-text-area-for-html'] ) {
    echo $redux_builder_amp['amp-footer-text-area-for-html'] ;
  }
}

add_action('amp_post_template_head','ampforwp_header_html_output',11);
function ampforwp_header_html_output() {
  global $redux_builder_amp;
  if( $redux_builder_amp['amp-header-text-area-for-html'] ) {
    echo $redux_builder_amp['amp-header-text-area-for-html'] ;
  }
}


//40. Meta Robots
add_action('amp_post_template_head' , 'ampforwp_talking_to_robots');
function ampforwp_talking_to_robots() {

  global $redux_builder_amp;
  global $wp;
  $meta_content = "";
  $talk_to_robots=false;

  //author archives  index/noindex
  if( is_author() && !$redux_builder_amp['ampforwp-robots-archive-author-pages'] ) {
	$talk_to_robots = true;
  }

  //date archives index/noindex
  if( is_date() && !$redux_builder_amp['ampforwp-robots-archive-date-pages'] ) {
    $talk_to_robots = true;
  }

  //Search pages noindexing by default
  if( is_search() ) {
    $talk_to_robots = true;
  }

  //categorys index/noindex
  if( is_category()  && !$redux_builder_amp['ampforwp-robots-archive-category-pages'] ) {
    $talk_to_robots = true;
  }

  //categorys index/noindex
  if( is_tag() && !$redux_builder_amp['ampforwp-robots-archive-tag-pages'] ) {
    $talk_to_robots = true;
  }

  if( is_archive() || is_home() ) {
    if ( get_query_var( 'paged' ) ) {
          $paged = get_query_var('paged');
      } elseif ( get_query_var( 'page' ) ) {
          $paged = get_query_var('page');
      } else {
          $paged = 1;
      }
      //sitewide archives sub pages index/noindex  ie page 2 onwards
      if( $paged >= 2 && !$redux_builder_amp['ampforwp-robots-archive-sub-pages-sitewide'] ) {
      	$talk_to_robots = true;
      }
    }

	$query_array = $wp->query_vars;
	if( array_key_exists( 'page' , $query_array ) ) {
		$page = $wp->query_vars['page'];
		if ( $redux_builder_amp['amp-frontpage-select-option'] && $page >= '2') {
			$talk_to_robots = true;
		}
	}

  if( $talk_to_robots ) {
  	$meta_content = "noindex,noarchive";
  }
  // Genesis
  if ( function_exists('genesis_get_robots_meta_content') ) {
  	$meta_content = genesis_get_robots_meta_content();
  }
  // All in One SEO #1720
  if ( class_exists('All_in_One_SEO_Pack') ) {
  	$aios_class = $aios_meta = $aiosp_noindex = $aiosp_nofollow = '';
  	$noindex       = 'index';
	$nofollow      = 'follow';
  	
  	$aios_class = new All_in_One_SEO_Pack();

  	if (property_exists($aios_class,'get_page_number')) {
  		$page       = $aios_class->get_page_number();
	}
	if (property_exists($aios_class,'get_current_options')) {
		$opts = $aios_class->get_current_options( array(), 'aiosp' );
	}
	if (property_exists($aios_class,'get_robots_meta')) {
  		$aios_meta = $aios_class->get_robots_meta();
 	} 
  	if ( ( is_category() && ! empty( $aioseop_options['aiosp_category_noindex'] ) ) || ( ! is_category() && is_archive() && ! is_tag() && ! is_tax() || ( is_tag() && ! empty( $aioseop_options['aiosp_tags_noindex'] ) ) || ( is_search() && ! empty( $aioseop_options['aiosp_search_noindex'] ) )
		) ){
			$noindex = 'noindex';
		} elseif ( is_single() || is_page() || $aios_class->is_static_posts_page() || is_attachment() || is_category() || is_tag() || is_tax() || ( $page > 1 ) ) {
			$post_type = get_post_type();
			if ( ! empty( $opts ) ) {
				$aiosp_noindex  = htmlspecialchars( stripslashes( $opts['aiosp_noindex'] ) );
				$aiosp_nofollow = htmlspecialchars( stripslashes( $opts['aiosp_nofollow'] ) );
			}
			if ( $aiosp_noindex || $aiosp_nofollow || ! empty( $aioseop_options['aiosp_cpostnoindex'] )
				 || ! empty( $aioseop_options['aiosp_cpostnofollow'] ) || ! empty( $aioseop_options['aiosp_paginated_noindex'] ) || ! empty( $aioseop_options['aiosp_paginated_nofollow'] )
			) {
				if ( ( $aiosp_noindex == 'on' ) || ( ( ! empty( $aioseop_options['aiosp_paginated_noindex'] ) ) && $page > 1 ) ||
					 ( ( $aiosp_noindex == '' ) && ( ! empty( $aioseop_options['aiosp_cpostnoindex'] ) ) && in_array( $post_type, $aioseop_options['aiosp_cpostnoindex'] ) )
				) {
					$noindex = 'noindex';
				}
				if ( ( $aiosp_nofollow == 'on' ) || ( ( ! empty( $aioseop_options['aiosp_paginated_nofollow'] ) ) && $page > 1 ) ||
					 ( ( $aiosp_nofollow == '' ) && ( ! empty( $aioseop_options['aiosp_cpostnofollow'] ) ) && in_array( $post_type, $aioseop_options['aiosp_cpostnofollow'] ) )
				) {
					$nofollow = 'nofollow';
				}
			}
		}
		if ( is_singular() && property_exists($aios_class,'is_password_protected') && $aios_class->is_password_protected() && apply_filters( 'aiosp_noindex_password_posts', false ) ) {
			$noindex = 'noindex';
		}

		$robots_meta = $noindex . ',' . $nofollow;
		if ( $robots_meta == 'index,follow' ) {
			$robots_meta = '';
		}

	  	if ( !empty($robots_meta) ) {
	  		$meta_content = $robots_meta;
	  	}
  	}
  	// Meta Robots Tag From Yoast #1563
  	if ( class_exists('WPSEO_Frontend') && false == $redux_builder_amp['amp-inspection-tool']) {
		$class_instance = '';
	    $class_instance = WPSEO_Frontend::get_instance();
	    // robots() will return and print the meta robots tag
	    $class_instance->robots();
	    // Empty the above meta content to avoid duplicate meta robot tags
	    $meta_content = '';
	}
  $meta_content = apply_filters('ampforwp_robots_meta', $meta_content);
  if ( isset($redux_builder_amp['amp-inspection-tool']) && true == $redux_builder_amp['amp-inspection-tool'] ) {
  		$talk_to_robots = $meta_content = '';
  }
  if ( $meta_content ) {
  	if ( ( is_archive() && $talk_to_robots ) || is_singular() || is_home() ) {	
  		echo '<meta name="robots" content="' . esc_attr($meta_content) . '"/>';
  	}
  }

}

// 41. Rewrite URL only on save #511
function ampforwp_auto_flush_on_save($redux_builder_amp) {
	if ( $redux_builder_amp['amp-on-off-for-all-pages'] == 1 || $redux_builder_amp['ampforwp-archive-support'] == 1 || $redux_builder_amp['fb-instant-article-switch'] == 1 ) {
		global $wp_rewrite;
		$wp_rewrite->flush_rules();
	}
	$options = $new_options = array();
	if ( is_array($redux_builder_amp['hide-amp-categories']) && !is_array($redux_builder_amp['hide-amp-categories2'])) {
		$options = array_keys(array_filter($redux_builder_amp['hide-amp-categories'] ) );
		foreach ($options as $option ) {
			$new_options[] = $option;
		}
	    $redux_builder_amp['hide-amp-categories2'] = $new_options;
		$redux_builder_amp['hide-amp-categories'] = '';
	    update_option('redux_builder_amp',$redux_builder_amp);
	 }
}
add_action("redux/options/redux_builder_amp/saved",'ampforwp_auto_flush_on_save', 10, 1);

// 42. registeing AMP sidebars
add_action('init', 'ampforwp_add_widget_support');
function ampforwp_add_widget_support() {
	if (function_exists('register_sidebar')) {
		global $redux_builder_amp;

		register_sidebar(array(
			'name' => 'AMP Above Loop [HomePage]',
			'id'   => 'ampforwp-above-loop',
			'description'   => 'This Widget will be display on AMP HomePage Above the loop ',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>'
		));

		register_sidebar(array(
			'name' => 'AMP Below Loop [HomePage]',
			'id'   => 'ampforwp-below-loop',
			'description'   => 'This Widget will be display on AMP HomePage Below the loop',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>'
		));

		register_sidebar(array(
			'name' 			=> 'AMP Below the Header [Site Wide]',
			'id'   			=> 'ampforwp-below-header',
			'description'   => 'This Widget will be display after the header bar',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<h4><span>',
			'after_title'   => '</h4></span>'
		));

		register_sidebar(array(
			'name' 			=> 'AMP Above the Footer [Site Wide]',
			'id'   			=> 'ampforwp-above-footer',
			'description'   => 'This Widget display Above the Footer',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<h4><span>',
			'after_title'   => '</h4></span>'
		));

		if ( isset($redux_builder_amp['ampforwp-content-builder']) && $redux_builder_amp['ampforwp-content-builder'] ) {
    $desc = "<b>Update: <a target='_blank' href='https://ampforwp.com/tutorials/article/amp-page-builder-installation/'>Introducing PageBuilder 2.0</a></b><br />Drag and Drop the AMP Modules in this Widget Area and then assign this widget area to a page <a href=http://ampforwp.com/tutorials/page-builder>(Need Help?)</a>";
    $placeholder = 'PLACEHOLDER';
			register_sidebar(array(
				'name' 			=> 'Page Builder (AMP) [Legacy]',
				'id'   			=> 'layout-builder',
                'description' => $placeholder,
				'before_widget' => '',
				'after_widget'  => '',
				'before_title'  => '<h4>',
				'after_title'   => '</h4>' 
			));
            
        add_action( 'widgets_admin_page', function() use ( $desc, $placeholder ) {
            add_filter( 'esc_html', function( $safe_text, $text ) use ( $desc, $placeholder ) {

                if ( $text !== $placeholder )
                    return $safe_text;

                remove_filter( current_filter(), __FUNCTION__ );

                return $desc;
            }, 10, 2 );
        });
            
		}

	}
}

// 43. custom actions for widgets output
add_action( 'ampforwp_home_above_loop' , 'ampforwp_output_widget_content_above_loop' );
add_action( 'ampforwp_frontpage_above_loop' , 'ampforwp_output_widget_content_above_loop' );
function ampforwp_output_widget_content_above_loop() {
	$sanitized_sidebar = "";
	$sidebar_output = "";
	$sanitized_sidebar = ampforwp_sidebar_content_sanitizer('ampforwp-above-loop');	
    if ( $sanitized_sidebar) {
		$sidebar_output = $sanitized_sidebar->get_amp_content();
		$sidebar_output = apply_filters('ampforwp_modify_sidebars_content',do_shortcode($sidebar_output)); 
	}
      if ( $sidebar_output ) { ?>
	   	<div class="amp-wp-content widget-wrapper amp_widget_above_loop">
		  <?php echo do_shortcode($sidebar_output); ?>
		<div style="clear:both"></div>
	  	</div> 
	<?php }
}

add_action( 'ampforwp_home_below_loop' , 'ampforwp_output_widget_content_below_loop' );
add_action( 'ampforwp_frontpage_below_loop' , 'ampforwp_output_widget_content_below_loop' );
function ampforwp_output_widget_content_below_loop() {
    $sanitized_sidebar = "";
	$sidebar_output = "";
	$sanitized_sidebar = ampforwp_sidebar_content_sanitizer('ampforwp-below-loop');	
 if ( $sanitized_sidebar) {
		$sidebar_output = $sanitized_sidebar->get_amp_content();
		$sidebar_output = apply_filters('ampforwp_modify_sidebars_content',do_shortcode($sidebar_output)); 
	}
    if ( $sidebar_output ) { ?>
	   	<div class="amp-wp-content widget-wrapper">
		   	<div class="amp_widget_below_loop">
		  	<?php echo do_shortcode($sidebar_output); ?> </div>
	  	</div> 
	<?php } 
}

add_action( 'ampforwp_after_header' , 'ampforwp_output_widget_content_below_the_header' );
add_action('below_the_header_design_1','ampforwp_output_widget_content_below_the_header');
function ampforwp_output_widget_content_below_the_header() {
	 $sanitized_sidebar = "";
	 $sidebar_output = "";
	 $sanitized_sidebar = ampforwp_sidebar_content_sanitizer('ampforwp-below-header');
     if ( $sanitized_sidebar) {
		$sidebar_output = $sanitized_sidebar->get_amp_content(); 
		$sidebar_output = apply_filters('ampforwp_modify_sidebars_content',do_shortcode($sidebar_output));
	}
	if ( $sidebar_output ) { ?>
	   	<div class="amp-wp-content widget-wrapper">
		   	<div class="amp_widget_below_the_header">
		  	<?php echo do_shortcode($sidebar_output); ?> </div>
	  	</div> 
	<?php }
}

add_action( 'amp_post_template_above_footer' , 'ampforwp_output_widget_content_above_the_footer' );
function ampforwp_output_widget_content_above_the_footer() {
	$sanitized_sidebar = "";
	$sidebar_output = "";
	$sanitized_sidebar = ampforwp_sidebar_content_sanitizer('ampforwp-above-footer');
	if ( $sanitized_sidebar) {
		$sidebar_output = $sanitized_sidebar->get_amp_content();
		$sidebar_output = apply_filters('ampforwp_modify_sidebars_content',do_shortcode($sidebar_output));
	}
	if ( $sidebar_output ) { ?>
	   	<div class="amp-wp-content widget-wrapper">
			<div class="amp_widget_above_the_footer">
			<?php echo do_shortcode($sidebar_output); ?> </div>
		</div>
	<?php }
}
// Filter the sidebars content to make it work properly with carousels
add_filter('ampforwp_modify_sidebars_content','ampforwp_sidebars_carousel_content');
function ampforwp_sidebars_carousel_content($content){
	$content = str_replace(array(':openbrack:',':closebrack:'), array('[',']'), $content);
	return $content;
}
// Sidebar Content Sanitizer
function ampforwp_sidebar_content_sanitizer($sidebar){
  global $redux_builder_amp;
  $sanitized_sidebar     	= "";
  $non_sanitized_sidebar   	= "";
  $sidebar_data 			= array();  
  ob_start();
  dynamic_sidebar( $sidebar );
  $non_sanitized_sidebar = ob_get_contents();
  ob_end_clean();
  
  if ( $non_sanitized_sidebar ) {
	  $sanitized_sidebar = new AMPFORWP_Content( $non_sanitized_sidebar,
	    apply_filters( 'amp_content_embed_handlers', array(
	          'AMP_Twitter_Embed_Handler' => array(),
	          'AMP_YouTube_Embed_Handler' => array(),
	          'AMP_DailyMotion_Embed_Handler' => array(),
			  'AMP_Vimeo_Embed_Handler' => array(),
			  'AMP_SoundCloud_Embed_Handler' => array(),
	          'AMP_Instagram_Embed_Handler' => array(),
	          'AMP_Vine_Embed_Handler' => array(),
	          'AMP_Facebook_Embed_Handler' => array(),
	          'AMP_Pinterest_Embed_Handler' => array(),
	          'AMP_Gallery_Embed_Handler' => array(),
	    ) ),
	    apply_filters(  'amp_sidebar_sanitizers', array(
	           'AMP_Style_Sanitizer' => array(),
	           'AMP_Blacklist_Sanitizer' => array(),
	           'AMP_Img_Sanitizer' => array(),
	           'AMP_Video_Sanitizer' => array(),
	           'AMP_Audio_Sanitizer' => array(),
	           'AMP_Playbuzz_Sanitizer' => array(),
	           'AMP_Iframe_Sanitizer' => array(
	             'add_placeholder' => true,
	           ),
	    )  ), array('non-content'=>'non-content')
	  );
  }
  // Allow some blacklisted tags #1400
  add_filter('amp_blacklisted_tags','ampforwp_sidebar_blacklist_tags');
  if ( is_active_widget(false,false,'search') && $sanitized_sidebar) {
	add_filter('ampforwp_modify_sidebars_content','ampforwp_modified_search_sidebar');
  }
  return $sanitized_sidebar;
}

function ampforwp_modified_search_sidebar( $content ) {
	global $redux_builder_amp;
	$dom = '';
	$dom = AMP_DOM_Utils::get_dom_from_content($content);
	$nodes = $dom->getElementsByTagName( 'form' );
	$num_nodes = $nodes->length;
	if ( 0 !== $num_nodes ) {
		for ( $i = 0; $i < $nodes->length; ++$i ) {
			$element = $nodes->item( $i );
			if ( isset($redux_builder_amp['ampforwp-amp-takeover']) && !$redux_builder_amp['ampforwp-amp-takeover'] ) {
				$amp_query_variable = 'amp';
				$amp_query_variable_val = '1';
			}
			$input = $dom->createElement('input');
			$input->setAttribute('type', 'text');
			$input->setAttribute('placeholder', 'AMP');
			$input->setAttribute('value', $amp_query_variable_val);
			$input->setAttribute('name', $amp_query_variable);
			$input->setAttribute('class', 'hide');
			$input->setAttribute('id', 'ampforwp_search_query_item');
			$element->appendChild($input);
			if ( ! $element->hasAttribute('action-xhr') ){
				$action_url = $element->getAttribute('action');
				$action_url = preg_replace('#^http?:#', '', $action_url);
				$element->setAttribute('action', $action_url);
			}
			$element->setAttribute('target', '_top');
		}
	}
	$content = AMP_DOM_Utils::get_content_from_dom($dom);
	return $content;
}

function ampforwp_sidebar_blacklist_tags($tags) {
	$form  = array_search('form', $tags);
	$input = array_search('input', $tags);
	$label = array_search('label', $tags);
	$textarea = array_search('textarea', $tags);
	$select = array_search('select', $tags);
	$option = array_search('option', $tags);
	if ( $form ) {
		unset($tags[$form]);
	}
	if ( $input ) {
		unset($tags[$input]);
	}
	if ( $label ) {
		unset($tags[$label]);		
	}
	if ( $textarea ) { unset($tags[$textarea]); }
	if ( $select ) { unset($tags[$select]); }
	if ( $option ) { unset($tags[$option]); }
	return $tags;
}
// Sidebar Scripts	
add_filter( 'amp_post_template_data', 'ampforwp_add_sidebar_data' );
function ampforwp_add_sidebar_data( $data ) {
	$sanitized_data_above_loop 	 = '';
	$sanitized_data_below_loop 	 = '';
	$sanitized_data_below_header = '';
	$sanitized_data_above_footer = '';
	// Get the Data
	$sanitized_data_above_loop 	 = ampforwp_sidebar_content_sanitizer('ampforwp-above-loop');
	$sanitized_data_below_loop 	 = ampforwp_sidebar_content_sanitizer('ampforwp-below-loop');
	$sanitized_data_below_header = ampforwp_sidebar_content_sanitizer('ampforwp-below-header');
	$sanitized_data_above_footer = ampforwp_sidebar_content_sanitizer('ampforwp-above-footer');
	$sanitized_data_swift_sidebar = ampforwp_sidebar_content_sanitizer('swift-sidebar');
	$sanitized_data_swift_footer = ampforwp_sidebar_content_sanitizer('swift-footer-widget-area');

	if ( $sanitized_data_above_loop ) {
		// Add Scripts
		if ( $sanitized_data_above_loop->get_amp_scripts() ) {
			foreach ($sanitized_data_above_loop->get_amp_scripts() as $key => $value ) {
				if( empty( $data['amp_component_scripts'][$key] ) ){
					$data['amp_component_scripts'][$key]  = $value;
				}
			}
		}
		// Add Styles
		if ( $sanitized_data_above_loop->get_amp_styles() ) {
			foreach ($sanitized_data_above_loop->get_amp_styles() as $key => $value ) {
				if( empty( $data['post_amp_styles'][$key] ) ){
					$data['post_amp_styles'][$key]  = $value;
				}
			}
		}
	}
	if ( $sanitized_data_below_loop ) {
		// Add Scripts
		if ( $sanitized_data_below_loop->get_amp_scripts() ) {
			foreach ($sanitized_data_below_loop->get_amp_scripts() as $key => $value ) {
				if( empty( $data['amp_component_scripts'][$key] ) ){
					$data['amp_component_scripts'][$key]  = $value;
				}
			}
		}
		// Add Styles
		if ( $sanitized_data_below_loop->get_amp_styles() ) {
			foreach ($sanitized_data_below_loop->get_amp_styles() as $key => $value ) {
				if( empty( $data['post_amp_styles'][$key] ) ){
					$data['post_amp_styles'][$key]  = $value;
				}
			}
		}
	}
	if ( $sanitized_data_below_header ) {
		// Add Scripts
		if ( $sanitized_data_below_header->get_amp_scripts() ) {
			foreach ($sanitized_data_below_header->get_amp_scripts() as $key => $value ) {
				if( empty( $data['amp_component_scripts'][$key] ) ){
					$data['amp_component_scripts'][$key]  = $value;
				}
			}
		}
		// Add Styles
		if ( $sanitized_data_below_header->get_amp_styles() ) {
			foreach ($sanitized_data_below_header->get_amp_styles() as $key => $value ) {
				if( empty( $data['post_amp_styles'][$key] ) ){
					$data['post_amp_styles'][$key]  = $value;
				}
			}
		}
	}
	if ( $sanitized_data_above_footer ) {		
		// Add Scripts
		if ( $sanitized_data_above_footer->get_amp_scripts() ) {
			foreach ($sanitized_data_above_footer->get_amp_scripts() as $key => $value ) {
				if( empty( $data['amp_component_scripts'][$key] ) ){
					$data['amp_component_scripts'][$key]  = $value;
				}
			}
		}
		// Add Styles
		if ( $sanitized_data_above_footer->get_amp_styles() ) {
			foreach ($sanitized_data_above_footer->get_amp_styles() as $key => $value ) {
				if( empty( $data['post_amp_styles'][$key] ) ){
					$data['post_amp_styles'][$key]  = $value;
				}
			}
		}
	}
	if ( $sanitized_data_swift_sidebar ) {		
		// Add Scripts
		if ( $sanitized_data_swift_sidebar->get_amp_scripts() ) {
			foreach ($sanitized_data_swift_sidebar->get_amp_scripts() as $key => $value ) {
				if( empty( $data['amp_component_scripts'][$key] ) ){
					$data['amp_component_scripts'][$key]  = $value;
				}
			}
		}
		// Add Styles
		if ( $sanitized_data_swift_sidebar->get_amp_styles() ) {
			foreach ($sanitized_data_swift_sidebar->get_amp_styles() as $key => $value ) {
				if( empty( $data['post_amp_styles'][$key] ) ){
					$data['post_amp_styles'][$key]  = $value;
				}
			}
		}
	}
	if ( $sanitized_data_swift_footer ) {		
		// Add Scripts
		if ( $sanitized_data_swift_footer->get_amp_scripts() ) {
			foreach ($sanitized_data_swift_footer->get_amp_scripts() as $key => $value ) {
				if( empty( $data['amp_component_scripts'][$key] ) ){
					$data['amp_component_scripts'][$key]  = $value;
				}
			}
		}
		// Add Styles
		if ( $sanitized_data_swift_footer->get_amp_styles() ) {
			foreach ($sanitized_data_swift_footer->get_amp_styles() as $key => $value ) {
				if( empty( $data['post_amp_styles'][$key] ) ){
					$data['post_amp_styles'][$key]  = $value;
				}
			}
		}
	}
	return $data; 
}
// 44. auto adding /amp for the menu
add_action('amp_init','ampforwp_auto_add_amp_menu_link_insert');
function ampforwp_auto_add_amp_menu_link_insert() {
	add_action( 'wp', 'ampforwp_auto_add_amp_in_link_check' );
}

function ampforwp_auto_add_amp_in_link_check() {
	global $redux_builder_amp;
	$ampforwp_is_amp_endpoint = ampforwp_is_amp_endpoint();

	if ( $ampforwp_is_amp_endpoint && $redux_builder_amp['ampforwp-auto-amp-menu-link'] == 1 ) {
		add_filter( 'nav_menu_link_attributes', 'ampforwp_auto_add_amp_in_menu_link', 10, 3 );
	}
}

function ampforwp_auto_add_amp_in_menu_link( $atts, $item, $args ) {
	global $redux_builder_amp;
	
  if(isset($redux_builder_amp['amp-core-end-point']) && $redux_builder_amp['amp-core-end-point'] == 1){
	    $atts['href'] = user_trailingslashit(trailingslashit( $atts['href'] ) );
		$atts['href'] = add_query_arg(AMPFORWP_AMP_QUERY_VAR,'1', $atts['href']);
	}
  else{
     	$atts['href'] = user_trailingslashit(trailingslashit( $atts['href'] ) . AMPFORWP_AMP_QUERY_VAR);
    }

	return $atts;
}

// 45. searchpage, frontpage, homepage structured data
// moved to structured-data-functions.php

// 46. search search search everywhere #615
require 'search-functions.php';

// 47. social js properly adding when required
if( !function_exists( 'is_socialshare_or_socialsticky_enabled_in_ampforwp' ) ) {
	function is_socialshare_or_socialsticky_enabled_in_ampforwp() {
		global $redux_builder_amp;
		if(  $redux_builder_amp['enable-single-facebook-share'] ||
				 $redux_builder_amp['enable-single-twitter-share']  ||
				 $redux_builder_amp['enable-single-gplus-share']  ||
				 $redux_builder_amp['enable-single-email-share'] ||
				 $redux_builder_amp['enable-single-pinterest-share']  ||
				 $redux_builder_amp['enable-single-linkedin-share'] )  {
					return true;
				}
			return false;
	}
}

// 48. Remove all unwanted scripts on search pages
add_filter( 'amp_post_template_data', 'ampforwp_remove_scripts_search_page' );
function ampforwp_remove_scripts_search_page( $data ) {
	if( is_search() ) {
		// Remove all unwanted scripts on search pages
		unset( $data['amp_component_scripts']);
	}
	return $data;
}

// 49. Properly adding ad Script the AMP way
// Moved to ads-functions.php

// internal function for checing if social profiles have been set
if( !function_exists('ampforwp_checking_any_social_profiles') ) {
	function ampforwp_checking_any_social_profiles() {
		global $redux_builder_amp;
		if(
			$redux_builder_amp['enable-single-twittter-profile'] 	 ||
			$redux_builder_amp['enable-single-facebook-profile'] 	 ||
			$redux_builder_amp['enable-single-pintrest-profile'] 	 ||
			$redux_builder_amp['enable-single-google-plus-profile']	 ||
			$redux_builder_amp['enable-single-linkdin-profile'] 	 ||
			$redux_builder_amp['enable-single-youtube-profile'] 	 ||
			$redux_builder_amp['enable-single-instagram-profile'] 	 ||
			$redux_builder_amp['enable-single-VKontakte-profile'] 	 ||
			$redux_builder_amp['enable-single-reddit-profile'] 		 ||
			$redux_builder_amp['enable-single-snapchat-profile'] 	 ||
			$redux_builder_amp['enable-single-Tumblr-profile']
	 	) {
			return true;
		}
		return false;
	}
}

// 50. Properly adding noditification Scritps the AMP way
// Moved to notice-bar-functions.php

//51. Adding Digg Digg compatibility with AMP
function ampforwp_dd_exclude_from_amp() {
if(ampforwp_is_amp_endpoint()) {
    remove_filter('the_excerpt', 'dd_hook_wp_content');
    remove_filter('the_content', 'dd_hook_wp_content');
	}
}
add_action('template_redirect', 'ampforwp_dd_exclude_from_amp');

//52. Adding a generalized sanitizer function for purifiying normal html to amp-html
function ampforwp_content_sanitizer( $content ) {
	$amp_custom_post_content_input = $content;
	if ( !empty( $amp_custom_post_content_input ) ) {
		$amp_custom_content = new AMP_Content( $amp_custom_post_content_input,
				apply_filters( 'amp_content_embed_handlers', array(
						'AMP_Twitter_Embed_Handler' => array(),
						'AMP_YouTube_Embed_Handler' => array(),
						'AMP_Instagram_Embed_Handler' => array(),
						'AMP_Vine_Embed_Handler' => array(),
						'AMP_Facebook_Embed_Handler' => array(),
						'AMP_Gallery_Embed_Handler' => array(),
				) ),
				apply_filters(  'amp_content_sanitizers', array(
						 'AMP_Style_Sanitizer' => array(),
						 'AMP_Blacklist_Sanitizer' => array(),
						 'AMP_Img_Sanitizer' => array(),
						 'AMP_Video_Sanitizer' => array(),
						 'AMP_Audio_Sanitizer' => array(),
						 'AMP_Iframe_Sanitizer' => array(
							 'add_placeholder' => true,
						 ),
				)  )
		);

		if ( $amp_custom_content ) {
			global $data;
			$data['amp_component_scripts'] 	= $amp_custom_content->get_amp_scripts();
			$data['post_amp_styles'] 		= $amp_custom_content->get_amp_styles();
			return $amp_custom_content->get_amp_content();
		}
		return '';
	}
}


//53. Removed AMP-WooCommerce Code and added it in AMP-WooCommerce #929
// Adding the styling for AMP Woocommerce latest Products(AMP-WooCommerce Widgets)
add_action('amp_post_template_css','amp_latest_products_styling',PHP_INT_MAX);
function amp_latest_products_styling() { 
	if ( class_exists( 'woocommerce' ) ) { ?>
		.ampforwp_wc_shortcode{margin-top: 0;padding:0;display:inline-block;width: 100%;}
		.ampforwp_wc_shortcode li{position: relative;width:29%; font-size:12px; line-height: 1; float: left;list-style-type: none;margin:2%;}
		.ampforwp_wc_shortcode .onsale{position: absolute;top: 0;right: 0;background: #ddd;padding: 7px;font-size: 12px;}
		.single-post .ampforwp_wc_shortcode li amp-img{margin:0}
		.ampforwp-wc-title{margin: 8px 0px 10px 0px;font-size: 13px;}
		.ampforwp-wc-price{color:#444}
		.wc_widgettitle{text-align:center;margin-bottom: 0px;}
		.ampforwp-wc-price, .ampforwp_wc_star_rating{float:left;margin-right: 10px;}
	<?php }
}

// 54. Change the default values of post meta for Posts, Pages and CPTs
add_action('admin_head','ampforwp_change_default_amp_post_meta',12);
function ampforwp_change_default_amp_post_meta() {
	global $redux_builder_amp;
	$amp_post_metas = array();
	$amp_post_metas = json_decode(get_post_meta( get_the_ID(),'ampforwp-post-metas',true), true );
	$post_types = ampforwp_get_all_post_types();
	if ( $post_types ) {
		foreach ($post_types as $post_type ) {
			$post_check_meta	= get_option('ampforwp_default_'.$post_type.'s_to');
			$post_checker			= 'show';
			$post_control			= $redux_builder_amp['amp-'.$post_type.'s-meta-default'];
			$post_meta_to_update = 'default';

			if ( $post_control  === 'hide' ) {
				$post_checker				= 'hide';
				$post_meta_to_update 		= 'hide-amp';
			}
			// Check and Run only if the value has been changed, else return
			if ( get_option('ampforwp_default_'.$post_type.'s_to') !== $post_checker ) {
				// Get all the pages and update the post meta
				if( 'page' == $post_type ) {
				    $pages = get_pages(array());
				    foreach($pages as $page){
						$amp_post_metas['ampforwp-amp-on-off'] = $meta_value_to_upate;
						update_post_meta( $post_id, 'ampforwp-post-metas', json_encode($amp_post_metas) );
				        //update_post_meta($page->ID,'ampforwp-amp-on-off', $meta_value_to_upate);
				    }
				}
				// Get all the pages and update the post meta
				else {
					$posts = get_posts(array('post_type'=>$post_type));
					foreach($posts as $post){
						$amp_post_metas['ampforwp-amp-on-off'] = $meta_value_to_upate;
						update_post_meta( $post_id, 'ampforwp-post-metas', json_encode($amp_post_metas) );
					    //update_post_meta($post->ID,'ampforwp-amp-on-off', $post_meta_to_update);
					}
				}
				// Update the option as the process has been done and update an option
				update_option('ampforwp_default_'.$post_type.'s_to', $post_checker);
			}
		}
	}	
	return ;
}

// Adding the meta="description" from yoast or from the content
add_action('amp_post_template_head','ampforwp_meta_description');
function ampforwp_meta_description() {
	global $redux_builder_amp;
	if ( ! $redux_builder_amp['ampforwp-seo-meta-description'] ) {
		return;
	}
	$desc = "";
	$desc = ampforwp_generate_meta_desc();
	if ( $desc ) {
		echo '<meta name="description" content="'. esc_attr( convert_chars( stripslashes( $desc ) ) )  .'"/>';
	}
}
// All in One Seo Compatibility #1557
add_filter('aioseop_amp_description', '__return_false');

// 55. Call Now Button Feature added
add_action('ampforwp_call_button','ampforwp_call_button_html_output');
function ampforwp_call_button_html_output(){
	global $redux_builder_amp;
	if ( $redux_builder_amp['ampforwp-callnow-button'] ) { ?>
		<div class="callnow">
			<a href="tel:<?php echo $redux_builder_amp['enable-amp-call-numberfield']; ?>"></a>
		</div> <?php
  }
}

// 56. Multi Translation Feature #540
// Moved to functions.php

// 57. Adding Updated date at in the Content
add_action('ampforwp_after_post_content','ampforwp_add_modified_date');
function ampforwp_add_modified_date($post_object){
	global $redux_builder_amp;
	if ( is_single() && $redux_builder_amp['post-modified-date'] && ( ! checkAMPforPageBuilderStatus( get_the_ID() ) ) ) { ?>
		<div class="ampforwp-last-modified-date">
			<p> <?php
				if( $post_object->get( 'post_modified_timestamp' ) !== $post_object->get( 'post_publish_timestamp' ) ){
					echo esc_html(
						sprintf(
							_x( ampforwp_translation( $redux_builder_amp['amp-translator-modified-date-text'],'This article was last modified on ' ) . ' %s '  , '%s = human-readable time difference', 'accelerated-mobile-pages' ),
							date_i18n( get_option( 'date_format' ) , $post_object->get( 'post_modified_timestamp' ) )
						)
					);
			echo get_the_modified_time();	} ?>
			</p>
		</div> <?php
	}
}

// 58. YouTube Shortcode compatablity with AMP #557 #971

add_filter('amp_content_embed_handlers','ampforwp_youtube_shortcode_embedder');
function ampforwp_youtube_shortcode_embedder($data){
	 unset($data['AMP_YouTube_Embed_Handler']);
	 $data[ 'AMPforWP_YouTube_Embed_Handler' ] = array();
	return $data;
}
if ( ! function_exists( 'ampforwp_youtube_shortcode') ) {

	function ampforwp_youtube_shortcode( $params, $old_format_support = false ) {
		$str = '';
		$parsed_url = array();
		$youtube_url = 'https://www.youtube.com/watch?v=';
		if(isset( $params['id']) ){
			$parsed_url = parse_url( $params['id'] );
		}
		$server = 'www.youtube.com';

		if ( in_array( $server, $parsed_url ) === false ) {
			if(isset($params['id']) && $params['id']){
			$new_url  = $youtube_url .  $params['id'] ;
			$params['id'] = $new_url;
			}
		}
		if ( $old_format_support && isset( $params[0] ) ) {
			$str = ltrim( $params[0], '=' );
		} elseif ( is_array( $params ) ) {
			foreach ( array_keys( $params ) as $key ) {
			  if ( ! is_numeric( $key ) ) {
			    $str = $key . '=' . $params[ $key ];
			  }
			}
		}
	  return str_replace( array( '&amp;', '&#038;' ), '&', $str );
	}
}
// Add extra params in amp-youtube
add_filter('amp_youtube_params', 'ampforwp_youtube_modified_params');
if( ! function_exists(' ampforwp_youtube_modified_params ') ){
	function ampforwp_youtube_modified_params($amp_youtube){
		$check = '';
		$param = '';
		// Check for extra params
		$check = preg_match('/(.*?)&(.*)/', $amp_youtube['data-videoid']);
		if(1 === $check){
			// Grab the extra param
			$param = preg_replace('/(.*?)&(.*)/', '$2', $amp_youtube['data-videoid']);
			// Parse the string into variables
			parse_str($param, $query_args);
			// Check for rel param
			if(isset($query_args['rel'])){
				// Add the rel param in amp-youtube's data-param
				$amp_youtube['data-param-rel'] = $query_args['rel'];
			}
			// Remove that param from URL
			$amp_youtube['data-videoid'] = preg_replace('/&(.*)/', '', $amp_youtube['data-videoid']);
		}
		return $amp_youtube;
	}
}
// 59. Comment Button URL
function ampforwp_comment_button_url(){
	global $redux_builder_amp;
	$button_url = "";
	$ampforwp_nonamp = "";
	if($redux_builder_amp['amp-mobile-redirection']==1)
        $ampforwp_nonamp =  '?nonamp=1';
    else
      $ampforwp_nonamp = '';

  	if ( isset($redux_builder_amp['ampforwp-amp-takeover']) && $redux_builder_amp['ampforwp-amp-takeover'] ) {
  		$button_url = user_trailingslashit(get_the_permalink()).'#comments';
  	}
  	else{
  		$button_url = add_query_arg( array( 'nonamp' => '1' ), get_permalink() );

  		$button_url = $button_url. '#commentform';
  	}
  return esc_url( apply_filters( 'ampforwp_url_controller', $button_url ) );
}

// 60. Remove Category Layout modification code added by TagDiv #842 and #796
// #1683
add_action('pre_amp_render_post', 'ampforwp_remove_tagdiv_category_layout');
function ampforwp_remove_tagdiv_category_layout(){
	if ( function_exists( 'ampforwp_is_amp_endpoint' ) && ampforwp_is_amp_endpoint() ) {
		add_action('pre_get_posts','ampforwp_remove_support_tagdiv_cateroy_layout',9);
	}
}
function ampforwp_remove_support_tagdiv_cateroy_layout(){	
		remove_action('pre_get_posts', 'td_modify_main_query_for_category_page'); 	
}

// 61. Add Gist Support
add_shortcode('amp-gist', 'ampforwp_gist_shortcode_generator');
function ampforwp_gist_shortcode_generator($atts) {
   extract(shortcode_atts(array(
   	  'id'     =>'' ,
      'layout' => 'fixed-height',
      'height' => 200,      
   ), $atts));  
   if ( empty ( $height ) ) {
   		$height = '250';
   }
  	return '<amp-gist data-gistid='. $atts['id'] .' 
  		layout="fixed-height"
  		height="'. $height .'">
  		</amp-gist>';
}

// Code updated and added the JS proper way #336
add_filter('amp_post_template_data','ampforwp_add_amp_gist_script', 100);
function ampforwp_add_amp_gist_script( $data ){
	global $redux_builder_amp;
	$content = "";
    
	$content =   $data['post'];
    if( $content ){
        $content = $content->post_content;
        
        if( is_single() ) {
            if( has_shortcode( $content, 'amp-gist' ) ){ 
                if ( empty( $data['amp_component_scripts']['amp-gist'] ) ) {
                    $data['amp_component_scripts']['amp-gist'] = 'https://cdn.ampproject.org/v0/amp-gist-0.1.js';
                }
            }
        }
    }
		 
	return $data;
}


// 62. Adding Meta viewport via hook instead of direct #878 
add_action( 'amp_post_template_head','ampforwp_add_meta_viewport', 9);
function ampforwp_add_meta_viewport() {
	$output = '';
	$output = '<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
	';
	echo apply_filters('ampforwp_modify_meta_viewport_filter',$output);
	
}

// 63. Frontpage Comments #682 
function ampforwp_frontpage_comments() {
	global $redux_builder_amp;
	$data = get_option( 'ampforwp_design' );
	$enable_comments = false;
	$post_id = "";

	$post_id = ampforwp_get_frontpage_id();	

	if ($data['elements'] == '') {
	 	$data['elements'] = "meta_info:1,title:1,featured_image:1,content:1,meta_taxonomy:1,social_icons:1,comments:1,related_posts:1";
	}
	if( isset( $data['elements'] ) || ! empty( $data['elements'] ) ){
		$options = explode( ',', $data['elements'] );
	};
	if ($options): foreach ($options as $key=>$value) {
		switch ($value) {
			case 'comments:1':
				$enable_comments = true;
			break;
		}
	} endif;
	if ( $enable_comments ) { ?>
		<div class="ampforwp-comment-wrapper">
			<?php
			$comment_button_url = "";
			$postID = '';
			// Gather comments for a Front from post id
			$postID = ampforwp_get_frontpage_id();
			$comments = get_comments(array(
					'post_id' => $postID,
					'status' => 'approve' //Change this to the type of comments to be displayed
			));
			$comment_button_url = get_permalink( $post_id );
			$comment_button_url = apply_filters('ampforwp_frontpage_comments_url',$comment_button_url );
			if ( $comments ) { ?>
				<div class="amp-wp-content comments_list">
				    <h3><?php global $redux_builder_amp; echo ampforwp_translation($redux_builder_amp['amp-translator-view-comments-text'] , 'View Comments' )?></h3>
				    <ul>
				    <?php
						$page = (get_query_var('page')) ? get_query_var('page') : 1;
						$total_comments = get_comments( array(
							'orderby' 	=> 'post_date' ,
							'order' 	=> 'DESC',
							'post_id'	=> $postID,
							'status' 	=> 'approve',
							'parent'	=>0 )
						);
						$pages = ceil(count($total_comments)/AMPFORWP_COMMENTS_PER_PAGE);
					    $pagination_args = array(
							'base'         =>  @add_query_arg('page','%#%'),
							'format'       => '?page=%#%',
							'total'        => $pages,
							'current'      => $page,
							'show_all'     => False,
							'end_size'     => 1,
							'mid_size'     => 2,
							'prev_next'    => True,
							'prev_text'    => ampforwp_translation($redux_builder_amp['amp-translator-previous-text'], 'Previous'),
							'next_text'    => ampforwp_translation( $redux_builder_amp['amp-translator-next-text'], 'Next'),
							'type'         => 'plain'
						);

						// Display the list of comments
						function ampforwp_custom_translated_comment($comment, $args, $depth){
							$GLOBALS['comment'] = $comment;
							global $redux_builder_amp; ?>
							<li id="li-comment-<?php comment_ID() ?>"
							<?php comment_class(); ?> >
								<article id="comment-<?php comment_ID(); ?>" class="comment-body">
									<footer class="comment-meta">
										<div class="comment-author vcard">
											<?php
											printf(__('<b class="fn">%s</b> <span class="says">'.ampforwp_translation($redux_builder_amp['amp-translator-says-text'],'says').':</span>'), get_comment_author_link()) ?>
										</div>
										<!-- .comment-author -->
										<div class="comment-metadata">
											<a href="<?php echo untrailingslashit( htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ) ?>">
												<?php printf( ampforwp_translation( ('%1$s '. ampforwp_translation($redux_builder_amp['amp-translator-at-text'],'at').' %2$s'), '%1$s at %2$s') , get_comment_date(),  get_comment_time())?>
											</a>
											<?php edit_comment_link(  ampforwp_translation( $redux_builder_amp['amp-translator-Edit-text'], 'Edit' )  ) ?>
										</div>
										<!-- .comment-metadata -->
									</footer>
										<!-- .comment-meta -->
									<div class="comment-content">
				                        <?php
				                          // $pattern = "~[^a-zA-Z0-9_ !@#$%^&*();\\\/|<>\"'+.,:?=-]~";
				                          $emoji_content = get_comment_text();
				                          // $emoji_free_comments = preg_replace($pattern,'',$emoji_content);
				                          $emoji_content = wpautop( $emoji_content );
					                      $sanitizer = new AMPFORWP_Content( $emoji_content, array(), apply_filters( 'ampforwp_content_sanitizers', array( 'AMP_Img_Sanitizer' => array(),
					                      'AMP_Video_Sanitizer' => array() ) ) );
					                      $sanitized_comment_content = $sanitizer->get_amp_content();
					                      echo make_clickable( $sanitized_comment_content );
				                           ?>
									</div>
										<!-- .comment-content -->
								</article>
							 <!-- .comment-body -->
							</li>
						<!-- #comment-## -->
							<?php
						}// end of ampforwp_custom_translated_comment()
						wp_list_comments( array(
						  'per_page' 			=> AMPFORWP_COMMENTS_PER_PAGE, //Allow comment pagination
						  'page'              	=> $page,
						  'style' 				=> 'li',
						  'type'				=> 'comment',
						  'max_depth'   		=> 5,
						  'avatar_size'			=> 0,
							'callback'				=> 'ampforwp_custom_translated_comment',
						  'reverse_top_level' 	=> false //Show the latest comments at the top of the list
						), $comments);
						echo paginate_links( $pagination_args );?>
				    </ul>
				</div>
				<?php 
				
			} 
			if ( comments_open($postID) ) {
				$comment_button_url = add_query_arg( array( 'nonamp' => '1' ),  $comment_button_url );?>
				<div class="comment-button-wrapper">
				    <a href="<?php echo esc_url( $comment_button_url ) . '#commentform' ?>" rel="nofollow"><?php  echo ampforwp_translation( $redux_builder_amp['amp-translator-leave-a-comment-text'], 'Leave a Comment'  ); ?></a>
				</div><?php
				}?>
		</div> <?php
	} 
}


// 64. PageBuilder 
add_action('pre_amp_render_post','ampforwp_apply_layout_builder_on_pages',20);
function ampforwp_apply_layout_builder_on_pages($post_id) {
	global $redux_builder_amp;
	$sidebar_check = null;
	if ( ampforwp_is_front_page() ) {
		$post_id = ampforwp_get_frontpage_id();
	}

	if ( $redux_builder_amp['ampforwp-content-builder'] ) {
		if ( is_page() ) {
			$sidebar_check = get_post_meta( $post_id,'ampforwp_custom_sidebar_select',true); 
		}
		// Add Styling Builder Elements
		add_action('amp_post_template_css', 'ampforwp_pagebuilder_styling', 20);

		if ( 'layout-builder' == $sidebar_check ) {
			// Removed Titles for Pagebuilder elements
			remove_filter( 'ampforwp_design_elements', 'ampforwp_add_element_the_title' );
			remove_action('ampforwp_design_2_frontpage_title','ampforwp_design_2_frontpage_title');
			remove_action('ampforwp_design_2_frontpage_title','ampforwp_design_2_frontpage_title');
		}
	}	
}

function ampforwp_remove_post_elements($elements) {
	$elements =  array('empty-filter');
	return $elements ;
}

function ampforwp_pagebuilder_styling() { ?>
.amp_cb_module{font-size:14px;line-height:1.5;margin-top:30px;margin-bottom:10px;padding:0 20px;}
.amp_cb_module h4{margin:17px 0 6px 0;}
.amp_cb_module p{margin: 8px 0px 10px 0px;}
.amp_cb_blurb{text-align: center} 
.amp_cb_blurb amp-img{margin:0 auto;}
.flex-grid {display:flex;justify-content: space-between;}
.amp_module_title{text-align: center;font-size: 14px;margin-bottom: 12px;padding-bottom: 4px;text-transform: uppercase;letter-spacing: 1px;border-bottom: 1px solid #f1f1f1;}
.clmn {flex: 1;padding: 5px}
.amp_cb_btn{margin-top: 20px;text-align: center;margin-bottom: 30px;}
.amp_cb_btn a{background: #f92c8b;color: #fff;font-size: 14px;padding: 9px 20px;border-radius: 3px;box-shadow: 1px 1px 4px #ccc;margin:6px;}
.amp_cb_btn .m_btn{font-size: 16px; padding: 10px 20px;}
.amp_cb_btn .l_btn{font-size: 18px; padding: 15px 48px;font-weight:bold;}
@media (max-width: 430px) { .flex-grid {display: block;} }
<?php }


// Add the scripts and style in header
function ampforwp_generate_pagebuilder_data() {
  $sanitized_sidebar     	= "";
  $non_sanitized_sidebar   	= "";
  $sidebar_data 			= array();
    
  ob_start();
	  dynamic_sidebar( 'layout-builder' );
	  $non_sanitized_sidebar = ob_get_contents();
  ob_end_clean();

  $sanitized_sidebar = new AMPFORWP_Content( $non_sanitized_sidebar,
    apply_filters( 'amp_content_embed_handlers', array(
          'AMP_Twitter_Embed_Handler' => array(),
          'AMP_YouTube_Embed_Handler' => array(),
          'AMP_Instagram_Embed_Handler' => array(),
          'AMP_Vine_Embed_Handler' => array(),
          'AMP_Facebook_Embed_Handler' => array(),
          'AMP_Gallery_Embed_Handler' => array(),
    ) ),
    apply_filters(  'amp_content_sanitizers', array(
           'AMP_Style_Sanitizer' => array(),
           'AMP_Blacklist_Sanitizer' => array(),
           'AMP_Img_Sanitizer' => array(),
           'AMP_Video_Sanitizer' => array(),
           'AMP_Audio_Sanitizer' => array(),
           'AMP_Iframe_Sanitizer' => array(
             'add_placeholder' => true,
           ),
    )  )
  );

  $sidebar_data['content'] 	= $sanitized_sidebar->get_amp_content();
  $sidebar_data['script'] 	= $sanitized_sidebar->get_amp_scripts();
  $sidebar_data['style'] 	= $sanitized_sidebar->get_amp_styles();
  
  return $sidebar_data;
}

function ampforwp_builder_checker() {
	global $post, $redux_builder_amp;
	$pagebuilder_check 	= '';
	$post_id 			= '';
	$is_legacy_enabled 	= '';
	$is_legacy_enabled  = ampforwp_get_setting('ampforwp-content-builder');

	if ( $post ) {
		$post_id = $post->ID;
	}
	if ( ampforwp_is_front_page() ) {
		$post_id = ampforwp_get_frontpage_id();
	}
	if ( $post_id && $is_legacy_enabled ) {
		$pagebuilder_check = get_post_meta( $post_id,'ampforwp_custom_sidebar_select',true); 
	}
	if ( $pagebuilder_check === 'layout-builder' ) {
		return ampforwp_generate_pagebuilder_data(); 
	}
	return;
}

add_filter( 'amp_post_template_data', 'ampforwp_add_pagebuilder_data' );
function ampforwp_add_pagebuilder_data( $data ) {
	$sanitized_data = '';
	$sanitized_data = ampforwp_builder_checker();

	if ( $sanitized_data ) {
		$data[ 'post_amp_content' ] 		= $sanitized_data['content'];
		$data[ 'amp_component_scripts' ] 	= $sanitized_data['script'];
		$data[ 'post_amp_styles' ] 			= $sanitized_data['style'];
	}
	
	return $data; 
}

/**
 * 65. Remove Filters code added through Class by other plugins
 *
 * Allow to remove method for an hook when, it's a class method used and class don't have variable, but you know the class name :)
 * Code from https://github.com/herewithme/wp-filters-extras 
 */
function ampforwp_remove_filters_for_class( $hook_name = '', $class_name ='', $method_name = '', $priority = 0 ) {
	global $wp_filter;
	// Take only filters on right hook name and priority
	if ( !isset($wp_filter[$hook_name][$priority]) || !is_array($wp_filter[$hook_name][$priority]) )
		return false;
	// Loop on filters registered
	foreach( (array) $wp_filter[$hook_name][$priority] as $unique_id => $filter_array ) {
		// Test if filter is an array ! (always for class/method)
		if ( isset($filter_array['function']) && is_array($filter_array['function']) ) {
			// Test if object is a class, class and method is equal to param !
			if ( is_object($filter_array['function'][0]) && get_class($filter_array['function'][0]) && get_class($filter_array['function'][0]) == $class_name && $filter_array['function'][1] == $method_name ) {
			    // Test for WordPress >= 4.7 WP_Hook class (https://make.wordpress.org/core/2016/09/08/wp_hook-next-generation-actions-and-filters/)
			    if( is_a( $wp_filter[$hook_name], 'WP_Hook' ) ) {
			        unset( $wp_filter[$hook_name]->callbacks[$priority][$unique_id] );
			    }
			    else {
				    unset($wp_filter[$hook_name][$priority][$unique_id]);
			    }
			}
		}
	}
	return false;
}

// BuddyPress Compatibility
add_action('amp_init','ampforwp_allow_homepage_bp');
function ampforwp_allow_homepage_bp() {
	add_action( 'wp', 'ampforwp_remove_rel_on_bp' );
}
function ampforwp_remove_rel_on_bp(){	
		if(function_exists('bp_is_activity_component')||function_exists('bp_is_members_component')||function_exists('bp_is_groups_component'))
		{
			if(bp_is_activity_component()|| bp_is_members_component() || bp_is_groups_component()){
				remove_action( 'wp_head', 'amp_frontend_add_canonical');
				remove_action( 'wp_head', 'ampforwp_home_archive_rel_canonical', 1 ); 
			}
		}

}

// Removing AMP from WPForo Forums Pages #592

add_action('amp_init','remove_rel_amp_from_forum');
function remove_rel_amp_from_forum(){
	add_action('wp','ampforwp_remove_rel_on_forum');
}

function ampforwp_remove_rel_on_forum(){
	if(class_exists('wpForo')){
		Global $post, $wpdb,$wpforo;
		$foid = $post->ID;
		$fid = $wpforo->pageid;
		if($foid==$fid){
			remove_action( 'wp_head', 'amp_frontend_add_canonical');
			remove_action( 'wp_head', 'ampforwp_home_archive_rel_canonical', 1 );
		}
		
	}
}


// 66. Make AMP compatible with Squirrly SEO
add_action('pre_amp_render_post','ampforwp_remove_sq_seo');
function ampforwp_remove_sq_seo() {
	$ampforwp_sq_google_analytics =  '';
	$ampforwp_sq_amp_analytics    =  '';

	if ( class_exists( 'SQ_Tools' ) ) {
		$ampforwp_sq_google_analytics = SQ_Tools::$options['sq_google_analytics'];
		$ampforwp_sq_amp_analytics    = SQ_Tools::$options['sq_auto_amp'];
	} 

	if ( $ampforwp_sq_google_analytics && $ampforwp_sq_amp_analytics ) {
		remove_action('amp_post_template_head','ampforwp_register_analytics_script', 20);
	}
}

//67 View Non AMP
function ampforwp_view_nonamp(){
	global $redux_builder_amp, $post, $wp;
  	$ampforwp_backto_nonamp = '';
  	$nofollow 				= '';
  if ( is_home() && get_option( 'page_for_posts' ) && get_queried_object_id() ) {
  	$post_id = get_option('page_for_posts');
		if($redux_builder_amp['amp-mobile-redirection']==1)
        $ampforwp_backto_nonamp = trailingslashit(get_permalink( $post_id )).'?nonamp=1';
    else
      $ampforwp_backto_nonamp = user_trailingslashit(get_permalink( $post_id ));
}
  elseif ( is_home() ) {
    if($redux_builder_amp['amp-mobile-redirection']==1)
       $ampforwp_backto_nonamp = trailingslashit(home_url()).'?nonamp=1' ;
    else
       $ampforwp_backto_nonamp = user_trailingslashit(home_url()) ;
  }
  if ( is_single() ){
    if($redux_builder_amp['amp-mobile-redirection']==1)
      $ampforwp_backto_nonamp = trailingslashit(get_permalink( $post->ID )).'?nonamp=1' ;
    else
      $ampforwp_backto_nonamp = user_trailingslashit(get_permalink( $post->ID )) ;
  }
  if ( is_page() ){
    if($redux_builder_amp['amp-mobile-redirection']==1)
        $ampforwp_backto_nonamp = trailingslashit(get_permalink( $post->ID )).'?nonamp=1';
    else
      $ampforwp_backto_nonamp = user_trailingslashit(get_permalink( $post->ID ));
  }
  if( is_archive() || is_search() ) {

    $permalink_structure 	= '';
	$permalink_structure 	= get_option('permalink_structure');

    if($redux_builder_amp['amp-mobile-redirection']==1){
        $ampforwp_backto_nonamp = esc_url( untrailingslashit(home_url( $wp->request )).'?nonamp=1'  );
        $ampforwp_backto_nonamp = preg_replace('/\/amp\?nonamp=1/','/?nonamp=1',$ampforwp_backto_nonamp);
      }
    else{
        $ampforwp_backto_nonamp = untrailingslashit( home_url( $wp->request ) );
        $ampforwp_backto_nonamp = dirname($ampforwp_backto_nonamp);
        $ampforwp_backto_nonamp = user_trailingslashit($ampforwp_backto_nonamp);
        
        if('' == $permalink_structure){
        	$ampforwp_backto_nonamp = site_url('?'.$wp->query_string);
        	$ampforwp_backto_nonamp = remove_query_arg( 'amp', $ampforwp_backto_nonamp );
        }
      }
      if ( is_search() ) {
      	if ( ! empty( $permalink_structure ) ){
      		$ampforwp_backto_nonamp = add_query_arg('s', $wp->query_vars['s'], $ampforwp_backto_nonamp);
      	} 
      }
  }
  
   if( true == $redux_builder_amp['ampforwp-nofollow-view-nonamp'] ){
   		$nofollow = 'rel="nofollow"';
   }
   if ( isset($redux_builder_amp['ampforwp-amp-takeover']) && $redux_builder_amp['ampforwp-amp-takeover'] ) {
   	$ampforwp_backto_nonamp = '';
   }
        $amp_url = "";
  		$amp_url = $_SERVER['REQUEST_URI'];
		$amp_url = explode('/', $amp_url);
		$amp_url = array_flip($amp_url);
		unset($amp_url['amp']);
		$non_amp_url = "";
		$non_amp_url = array_flip($amp_url);
		$non_amp_url = implode('/', $non_amp_url);
		$page = "";
	  	$query_arg_array = $wp->query_vars;
	  	if( array_key_exists( "page" , $query_arg_array  ) ) {
		   $page = $wp->query_vars['page'];
	  	}
	  	if ( $page >= '2') { 
			$non_amp_url = trailingslashit( $non_amp_url  . '?page=' . $page);
		} 

		$non_amp_url =  user_trailingslashit( $non_amp_url );
		$non_amp_url =  add_query_arg('nonamp', '1', $non_amp_url );
   if ( $ampforwp_backto_nonamp ) { ?> <a class="view-non-amp" href="<?php echo  esc_url($non_amp_url); ?>" <?php echo esc_attr($nofollow); ?>><?php echo esc_html( $redux_builder_amp['amp-translator-non-amp-page-text'] ) ;apply_filters('ampforwp_modify_view_non_amp_link',$non_amp_url);?></a> <?php  }
 }

 //68. Facebook Instant Articles
add_action('init', 'fb_instant_article_feed_generator');
 
function fb_instant_article_feed_generator() {
	global $redux_builder_amp;
	if( isset($redux_builder_amp['fb-instant-article-switch']) && $redux_builder_amp['fb-instant-article-switch'] ) {	
		add_feed('instant_articles', 'fb_instant_article_feed_function');
		add_action( 'wp_head', 'ampforwp_fbia_meta_tags' );
	}
}

function fb_instant_article_feed_function() {
	add_filter('pre_option_rss_use_excerpt', '__return_zero');
	load_template( AMPFORWP_PLUGIN_DIR . '/feeds/instant-article-feed.php' );
}
if ( ! function_exists('ampforwp_fbia_meta_tags') ) {
	function ampforwp_fbia_meta_tags(){
		global $redux_builder_amp;
		$fb_page_id = '';
		$fb_page_id = ampforwp_get_setting('fb-instant-page-id');
		// Page ID meta Tag
		if( $fb_page_id ) { ?>		
			<meta property="fb:pages" content="<?php echo esc_attr( $fb_page_id ); ?>" />
		<?php }
		$post = get_post();
		// If there's no current post, return
		if ( ! $post ) {
			return;
		}
		$url = get_permalink();
		$url = add_query_arg( 'ia_markup', '1', $url );
		// ia markup meta tag
		if( isset($redux_builder_amp['fb-instant-crawler-ingestion']) && $redux_builder_amp['fb-instant-crawler-ingestion'] ) { ?>
			<meta property="ia:markup_url" content="<?php echo esc_url( $url ); ?>" />	
		<?php }
	}
}

// 69. Post Pagination #834 #857
function ampforwp_post_pagination( $args = '' ) {

	wp_reset_postdata();
	global $page, $numpages, $multipage, $more, $redux_builder_amp;
	if ( ampforwp_is_front_page() ) {
		$id = ampforwp_get_frontpage_id();
		$content_post = get_post($id);
		$content = $content_post->post_content;
		$checker = preg_match('/<!--nextpage-->/', $content);
		if ( 1 === $checker ) {
			$multipage = $more = 1;
			$ampforwp_new_content = explode('<!--nextpage-->', $content);
			$queried_var = get_query_var('paged');
			if ( $queried_var > 1 ) {
		      $page = $queried_var;
		    }
			$numpages = count($ampforwp_new_content);
		}	
	}
	$defaults = array(
		'before'           => '<div class="ampforwp_post_pagination" ><p>' . '<span>' .  ampforwp_translation($redux_builder_amp['amp-translator-page-text'], 'Page') . ':</span>',
		'after'            => '</p></div>',
		'link_before'      => '',
		'link_after'       => '',
		'next_or_number'   => 'number',
		'separator'        => ' ',
		'nextpagelink'     => ampforwp_translation($redux_builder_amp['amp-translator-next-text'], 'Next'),
		'previouspagelink' => ampforwp_translation($redux_builder_amp['amp-translator-previous-text'], 'Previous'),
		'pagelink'         => '%',
		'echo'             => 1
	);

	$params = wp_parse_args( $args, $defaults );

	/**
	 * Filters the arguments used in retrieving page links for paginated posts.
	 * @param array $params An array of arguments for page links for paginated posts.
	 */
	$r = apply_filters( 'ampforwp_post_pagination_args', $params );
	if ( isset($redux_builder_amp['ampforwp-pagination-select']) && 2 == $redux_builder_amp['ampforwp-pagination-select'] ) {
		$r['next_or_number'] = 'next';
		$r['before'] = '<div class="ampforwp_post_pagination" ><p>';
		$r['after'] = '</p></div>';
	}
	$output = '';
	if ( $multipage ) {
		if ( 'number' == $r['next_or_number'] ) {
			$output .= $r['before'];
			for ( $i = 1; $i <= $numpages; $i++ ) {
				$link = $r['link_before'] . str_replace( '%', '<span>'.$i.'</span>', $r['pagelink'] ) . $r['link_after'];
				if ( $i != $page || ! $more && 1 == $page ) {
					$link = ampforwp_post_paginated_link_generator( $i ) . $link . '</a>';
				}
				/**
				 * Filters the HTML output of individual page number links.
				 * @param string $link The page number HTML output.
				 * @param int    $i    Page number for paginated posts' page links.
				 */
				$link = apply_filters( 'ampforwp_post_pagination_link', $link, $i );

				// Use the custom links separator beginning with the second link.
				$output .= ( 1 === $i ) ? ' ' : $r['separator'];
				$output .= $link;
			}
			$output .= $r['after'];
		} elseif ( $more ) {
			$output .= $r['before'];
			$prev = $page - 1;
			if ( $prev > 0 ) {
				$link = ampforwp_post_paginated_link_generator( $prev ) . $r['link_before'] . $r['previouspagelink'] . $r['link_after'] . '</a>';
				$output .= apply_filters( 'ampforwp_post_pagination_link', $link, $prev );
			}
			$output .= $r['separator'];
			$text = $page . ' of ' . $numpages;
			$output .= apply_filters( 'ampforwp_post_pagination_page', $text, $page, $numpages);
			$next = $page + 1;
			if ( $next <= $numpages ) {
				$output .= $r['separator'];
				$link = ampforwp_post_paginated_link_generator( $next ) . $r['link_before'] . $r['nextpagelink'] . $r['link_after'] . '</a>';
				$output .= apply_filters( 'ampforwp_post_pagination_link', $link, $next );
			}
			$output .= $r['after'];
		}
	}

	/**
	 * Filters the HTML output of page links for paginated posts.
	 * @param string $output HTML output of paginated posts' page links.
	 * @param array  $args   An array of arguments.
	 */
	$html = apply_filters( 'ampforwp_post_pagination', $output, $args );
	if($redux_builder_amp['amp-pagination']) {
		if ( $r['echo'] ) {
			echo $html;
		}
		return $html;
	}	

}

/**
 * Helper function for ampforwp_post_pagination().
 * @access private
 *
 * @global WP_Rewrite $wp_rewrite
 *
 * @param int $i Page number.
 * @return string Link.
 */
function ampforwp_post_paginated_link_generator( $i ) {
	global $wp_rewrite;
	$post = get_post();
	if ( ampforwp_is_front_page() ) {
		$id = ampforwp_get_frontpage_id();
		$post = get_post($id);
	}
	$query_args = array();
	if ( 1 == $i ) {
		$url = get_permalink();
		if(ampforwp_is_front_page()){
			$url = get_home_url();
		}
	} else {
		if ( '' == get_option('permalink_structure') || in_array($post->post_status, array('draft', 'pending')) ) {
			$url = add_query_arg( 'page', $i, get_permalink() );
			if(ampforwp_is_front_page()){
				$url = add_query_arg( 'page', $i, get_home_url() );
			}
		}
		elseif ( ampforwp_is_front_page() )
			$url = trailingslashit(get_home_url()) . user_trailingslashit("$wp_rewrite->pagination_base/" . $i, 'single_paged');
		else
			$url = trailingslashit(get_permalink()) . user_trailingslashit($i, 'single_paged');
	}

	if ( is_preview() ) {

		if ( ( 'draft' !== $post->post_status ) && isset( $_GET['preview_id'], $_GET['preview_nonce'] ) ) {
			$query_args['preview_id'] = wp_unslash( $_GET['preview_id'] );
			$query_args['preview_nonce'] = wp_unslash( $_GET['preview_nonce'] );
		}

		$url = get_preview_post_link( $post, $query_args, $url );

	}
	$url = add_query_arg(AMPFORWP_AMP_QUERY_VAR,'1',$url);
	return '<a href="' . esc_url( $url ) . '">';
}
// Modify the content to make Pagination work on Pages and FrontPage #2253
add_filter('ampforwp_modify_the_content','ampforwp_post_paginated_content');
function ampforwp_post_paginated_content($content){
	if ( is_singular() || ampforwp_is_front_page() ){
		global $redux_builder_amp, $page, $multipage;
		$ampforwp_new_content = $ampforwp_the_content = $checker = '';
		$ampforwp_the_content = $content;
		$checker = preg_match('/<!--nextpage-->/', $ampforwp_the_content);
		if ( 1 === $checker && true == ampforwp_get_setting('amp-pagination') ) {
			$multipage = 1;		
			$ampforwp_new_content = explode('<!--nextpage-->', $ampforwp_the_content);
		    $queried_var = get_query_var('page');
		    if ( ampforwp_is_front_page() ) {
		    	$queried_var = get_query_var('paged');
		    }
		    if ( $queried_var > 1 ) {
		      $queried_var = $queried_var -1   ;
		    }
		    else {
		    	 $queried_var = 0;
		    }
		    return $ampforwp_new_content[$queried_var];
		}
		else {
			return $ampforwp_the_content;
		}
	}
	return $content;
}

add_filter('ampforwp_modify_rel_canonical','ampforwp_modify_rel_amphtml_paginated_post');
function ampforwp_modify_rel_amphtml_paginated_post($url) {
	if(is_single()){
			$post_paginated_page='';
			$post_paginated_page = get_query_var('page');
			$permalink_structure = '';
			$permalink_structure = get_option('permalink_structure');
			if($post_paginated_page){
				$url = get_permalink();
				if('' == $permalink_structure){
					$new_url = add_query_arg('page',$post_paginated_page,$url);
				}
				else{
					$new_url = trailingslashit($url).$post_paginated_page;
				}

				$new_url = add_query_arg(AMPFORWP_AMP_QUERY_VAR,'1',$new_url);
				return $new_url;
			}
		} 
	return $url;
}

add_action('amp_post_template_head','ampforwp_modify_rel_canonical_paginated_post',9);
function ampforwp_modify_rel_canonical_paginated_post(){
		if(is_single()){
			$post_paginated_page='';
			$post_paginated_page = get_query_var('page');
			if($post_paginated_page){
				remove_action( 'amp_post_template_head', 'AMPforWP\\AMPVendor\\amp_post_template_add_canonical' );
				add_action('amp_post_template_head','ampforwp_rel_canonical_paginated_post');
			}
		}
}
function ampforwp_rel_canonical_paginated_post(){
		$post_paginated_page='';
		$new_canonical_url = '';
		$permalink_structure = '';
		$permalink_structure = get_option('permalink_structure');
		global $post;
	    $current_post_id = $post->ID;
	    $new_canonical_url = get_permalink($current_post_id);
	    $new_canonical_url = trailingslashit($new_canonical_url);
		$post_paginated_page = get_query_var('page');
		if($post_paginated_page){
			if('' == $permalink_structure){
				$new_canonical_url = add_query_arg('page',$post_paginated_page,$new_canonical_url);
			}
			else{
				$new_canonical_url = $new_canonical_url.$post_paginated_page;
			}
			?>
			<link rel="canonical" href="<?php echo $new_canonical_url ?>/" /><?php  } 
}
add_action('ampforwp_after_post_content','ampforwp_post_pagination');


// 70. Hide AMP by specific Categories #872

function ampforwp_posts_to_remove () {
	global $redux_builder_amp;
	$get_categories_from_checkbox 	= $current_cats = '';
	$get_selected_cats 				= array();
	$selected_cats 					= array();
	$post_id_array 					= array();
	$current_cats_ids 				= array();
	if(isset($redux_builder_amp['hide-amp-categories2'])){
		$get_categories_from_checkbox = $redux_builder_amp['hide-amp-categories2'];
		if($get_categories_from_checkbox){
			$get_selected_cats = array_filter($get_categories_from_checkbox);
			foreach ($get_selected_cats as $key => $value) {
				$selected_cats[] = $value;
			}  
		}
		$current_cats = get_the_category(get_the_ID());
		if ( $current_cats ) {
			foreach ($current_cats as $key => $cats) {
				$current_cats_ids[] =$cats->cat_ID;
			}
		}
		if( count(array_intersect($selected_cats,$current_cats_ids))>0 ){
	    	return true;
	    }
	}
	if( is_array(ampforwp_get_setting('hide-amp-tags-bulk-option2')))	{
		$get_tags_checkbox =  array_values(array_filter($redux_builder_amp['hide-amp-tags-bulk-option2'])); 
		$all_tags = get_the_tags(get_the_ID());
		$tagsOnPost = array();
		if ( $all_tags ) {
			foreach ($all_tags as $tagskey => $tagsvalue) {
				$tagsOnPost[] = $tagsvalue->term_id;
			}
		}			
		if( count(array_intersect($get_tags_checkbox,$tagsOnPost))>0 ){
			return true;
		}
	}
    return false;
}

function is_category_amp_disabled(){
	global $redux_builder_amp;
	$current_cats_ids = array();
	if(is_archive() && $redux_builder_amp['ampforwp-archive-support']==1){
		if(is_tag() && is_array($redux_builder_amp['hide-amp-tags-bulk-option2']))	{
			$all_tags = get_the_tags();
			$tagsOnPost = array();
			if ( $all_tags ) {
			foreach ($all_tags as $tagskey => $tagsvalue) {
				$tagsOnPost[] = $tagsvalue->term_id;
			}
			}
			$get_tags_checkbox =  array_values(array_filter($redux_builder_amp['hide-amp-tags-bulk-option2'])); 
			
			if( count(array_intersect($get_tags_checkbox,$tagsOnPost))>0 ){
				return true;
			}
			else{
				return false;
			}
		}//tags check area closed
		if( is_category() && is_array($redux_builder_amp['hide-amp-categories2'])){
			$categories = get_the_category();
			$selected_cats = array();
				$get_categories_from_checkbox =  $redux_builder_amp['hide-amp-categories2']; 
			$get_selected_cats = array_filter($get_categories_from_checkbox);
			foreach ($get_selected_cats as $key => $value) {
				$selected_cats[] = $value;
			}
			foreach ($categories as $key => $cats) {
				$current_cats_ids[] =$cats->cat_ID;
			}  
			if($selected_cats && $current_cats_ids){
				if( count(array_intersect($selected_cats,$current_cats_ids))>0 ){
			    	return true;
			    }
				else
					return false;
			}
		}
	}
}

// Excluded Categories 
if ( ! function_exists('ampforwp_exclude_archive') ) {
	function ampforwp_exclude_archive($archive = 'cat'){
		global $redux_builder_amp;
		$exclude = array();
		// Categories
		if ( isset($redux_builder_amp['hide-amp-categories2']) && is_array($redux_builder_amp['hide-amp-categories2']) && 'cat' == $archive ) {
			$exclude = array_values(array_filter($redux_builder_amp['hide-amp-categories2']));
			return $exclude;
		}
		// Tags
		if ( isset($redux_builder_amp['hide-amp-tags-bulk-option2']) && is_array($redux_builder_amp['hide-amp-tags-bulk-option2']) && 'tag' == $archive ) {
			$exclude = array_values(array_filter($redux_builder_amp['hide-amp-tags-bulk-option2']));
			return $exclude;
		}
	}
}
add_filter( 'amp_skip_post', 'ampforwp_cat_specific_skip_amp_post', 10, 3 );
function ampforwp_cat_specific_skip_amp_post( $skip, $post_id, $post ) {

	$skip_this_post = '';
	$skip_this_post = ampforwp_posts_to_remove();
	if ( $skip_this_post ) {
	  $skip = true;
	  remove_action( 'wp_head', 'ampforwp_home_archive_rel_canonical', 1 );
	  // #999 Disable mobile redirection
	  remove_action( 'template_redirect', 'ampforwp_page_template_redirect', 30 );
	}	
	return $skip;
}

// Exclude Posts from Loops based on Hide AMP Bulk Cats and Tags #2375
add_filter('ampforwp_query_args', 'ampforwp_exclude_archive_args');
function ampforwp_exclude_archive_args( $args ) {
	global $redux_builder_amp;
	if ( ampforwp_exclude_archive() ) {
		$args['category__not_in'] = ampforwp_exclude_archive();
	}
	if ( ampforwp_exclude_archive('tag') ) {
		$args['tag__not_in'] = ampforwp_exclude_archive('tag');
	}
	return $args;
}

add_action('amp_post_template_head','ampforwp_rel_canonical_home_archive');
function ampforwp_rel_canonical_home_archive(){
	global $redux_builder_amp;
	global $wp;
	$current_archive_url 	= '';
	$amp_url				= '';
	$remove					= '';
	$query_arg_array 		= '';
	$page                   = '' ;


	if ( is_home() || is_front_page() ||  is_archive() && $redux_builder_amp['ampforwp-archive-support'] )	{
		$current_archive_url = home_url( $wp->request );
		$amp_url 	= trailingslashit($current_archive_url);
		$remove 	= '/'. AMPFORWP_AMP_QUERY_VAR;
		$amp_url 	= str_replace($remove, '', $amp_url);
	  	$query_arg_array = $wp->query_vars;
	  	if( array_key_exists( "page" , $query_arg_array  ) ) {
		   $page = $wp->query_vars['page'];
	  	}
	  	if ( $page >= '2') { 
			$amp_url = trailingslashit( $amp_url  . '?page=' . $page);
		} ?>
		<link rel="canonical" href="<?php echo user_trailingslashit( esc_url( apply_filters('ampforwp_modify_rel_url', $amp_url ) ) ) ?>">
	<?php }

	if(is_search()){
		$paged = get_query_var( 'paged' );
		$current_search_url = trailingslashit(get_home_url())."?s=".get_search_query();
		$amp_url = untrailingslashit($current_search_url);
		if ($paged > 1 ) {
			global $wp;
			$current_archive_url 	= home_url( $wp->request );
			$amp_url 				= trailingslashit($current_archive_url);
			$remove 				= '/'. AMPFORWP_AMP_QUERY_VAR;
			$amp_url				= str_replace($remove, '', $amp_url) ;
			$amp_url 				= $amp_url ."?s=".get_search_query();
		} 
		?>
		<link rel="canonical" href="<?php echo untrailingslashit( esc_url( apply_filters('ampforwp_modify_rel_url', $amp_url) ) ); ?>">
	<?php
	}
				
}

// 71. Alt tag for thumbnails #1013
function ampforwp_thumbnail_alt(){
	$thumb_id = '';
	$thumb_alt = '';
	$thumb_id = get_post_thumbnail_id();
	$thumb_alt = get_post_meta( $thumb_id, '_wp_attachment_image_alt', true) ;
	if($thumb_alt){
		echo ' alt="' . esc_attr($thumb_alt) . '" ';
	}
}

// 72. Blacklist Sanitizer Added back #1024
add_filter('amp_content_sanitizers', 'ampforwp_add_blacklist_sanitizer');
function ampforwp_add_blacklist_sanitizer($data){
	// Blacklist Sanitizer Added back until we find a better solution to replace it 
	$data['AMP_Blacklist_Sanitizer']  = array();
	return $data;
}

//Meta description #1013
// Moved to functions.php

//Compatibility with WP User Avatar #975
function ampforwp_get_wp_user_avatar(){
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		if(is_plugin_active( 'wp-user-avatar/wp-user-avatar.php' )){
			if(class_exists('WP_User_Avatar_Functions')){
				$user_avatar_url = '';
				$user_avatar_url = get_wp_user_avatar_src();
				return $user_avatar_url;
			}
		}
}
add_filter('get_amp_supported_post_types','ampforwp_supported_post_types');
function ampforwp_supported_post_types($supported_types){
global $redux_builder_amp;
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
				if( is_plugin_active( 'amp-custom-post-type/amp-custom-post-type.php' ) ) {					
					if ( isset($redux_builder_amp['ampforwp-custom-type']) && $redux_builder_amp['ampforwp-custom-type'] ) {
						foreach($redux_builder_amp['ampforwp-custom-type'] as $custom_post){
							$supported_types[] = $custom_post;
						}
					}
				}	
				if( is_plugin_active( 'amp-woocommerce/amp-woocommerce.php' ) ) {
					if( !in_array("product", $supported_types) ){
						$supported_types[]= 'product';
					}
				}
	return $supported_types;
}

// 73. View AMP Site below View Site In Dashboard #1076

add_action( 'admin_bar_menu', 'ampforwp_visit_amp_in_admin_bar',999 );
 
function ampforwp_visit_amp_in_admin_bar($admin_bar) {
	global $redux_builder_amp;
	if ( isset($redux_builder_amp['ampforwp-homepage-on-off-support']) && $redux_builder_amp['ampforwp-homepage-on-off-support'] ) {
		$args = array(
		    'parent' => 'site-name',
		    'id'     => 'view-amp',
		    'title'  => 'Visit AMP',
		    'href'   => ampforwp_url_controller( get_home_url() ),
		    'meta'   => false
		);
		$admin_bar->add_node( $args );
	}       
}

// Things to be added in the Body Tag #1064
add_action('ampforwp_body_beginning','ampforwp_body_beginning_html_output',11);
function ampforwp_body_beginning_html_output(){
	global $redux_builder_amp;
  	if( $redux_builder_amp['amp-body-text-area'] ) {
    	echo $redux_builder_amp['amp-body-text-area'] ;
  }
}

add_filter('get_amp_supported_post_types','is_amp_post_support_enabled');
function is_amp_post_support_enabled($supportedTypes){
	global $redux_builder_amp;
	if( isset( $redux_builder_amp['amp-on-off-for-all-posts'] ) ) {
		if($redux_builder_amp['amp-on-off-for-all-posts']!='1'){
			$index = array_search('post',$supportedTypes);
			unset($supportedTypes[$index]);
		}elseif($redux_builder_amp['amp-on-off-for-all-posts']==1){
			$supportedTypes[] = 'post';
			$supportedTypes = array_unique($supportedTypes);
		}
	}
	return $supportedTypes;
}

// 74. Featured Image check from Custom Fields
// Moved to functions.php

function ampforwp_cf_featured_image_src($param=""){
global $redux_builder_amp, $post;
	if($redux_builder_amp['ampforwp-custom-fields-featured-image-switch']){
		$post_id 				= '';
		$custom_fields 			= '';
		$featured_image_field 	= '';
		$output 				= '';
		$custom_fields_name 	= array();
		$post_id 				= get_the_ID();
		$custom_fields 			= get_post_custom($post_id);
		foreach ($custom_fields as $key => $value) {
			$custom_fields_name[] = $key;	 
		}
		$featured_image_field = $redux_builder_amp['ampforwp-custom-fields-featured-image'];
		if(in_array($featured_image_field, $custom_fields_name)){
			$amp_img_src = $custom_fields[$featured_image_field][0];
      $image = @getimagesize($amp_img_src);	
			if(empty($image) || $image==false){
				$img_id  	 = attachment_url_to_postid($amp_img_src);
				$imageDetail = wp_get_attachment_image_src( $img_id , 'full');
				$image[0] 	 = $imageDetail[1];
				$image[1] 	 = $imageDetail[2];
			}
			switch ($param) {
				case 'url':
					$output = $amp_img_src;
					break;
				case 'width':
					$output = $image[0];
					break;
				case 'height':
					$output = $image[1];
						break;	
				default:
					$output = $amp_img_src;
					break;
			}
			return $output;
		}
	}
}

// 75. Dev Mode in AMP
add_action('amp_init','ampforwp_dev_mode');
function ampforwp_dev_mode(){
	global $redux_builder_amp;
	if(isset($redux_builder_amp['ampforwp-development-mode']) && $redux_builder_amp['ampforwp-development-mode']){
		add_action( 'wp', 'ampforwp_dev_mode_remove_amphtml' );		
		add_action( 'amp_post_template_head', 'ampforwp_dev_mode_add_noindex' );		
	}
}
// Remove amphtml from non-AMP
function ampforwp_dev_mode_remove_amphtml(){
	remove_action( 'wp_head', 'ampforwp_home_archive_rel_canonical', 1 );
}
// Add noindex,nofollow in the AMP
if ( ! function_exists('ampforwp_dev_mode_add_noindex') ) {
	function ampforwp_dev_mode_add_noindex() {
		global $redux_builder_amp;
		if ( isset($redux_builder_amp['amp-inspection-tool']) && false == $redux_builder_amp['amp-inspection-tool'] ){ 
			echo '<meta name="robots" content="noindex,nofollow"/>';
		}
	}
}
// Notice for Dev Mode
add_action('admin_notices', 'ampforwp_dev_mode_notice');
function ampforwp_dev_mode_notice(){ 
	global $redux_builder_amp;
	$message = '';
	if(isset($redux_builder_amp['ampforwp-development-mode']) && $redux_builder_amp['ampforwp-development-mode']) {
			$message =  '<strong>AMP Dev mode is Enabled! </strong> Please turn off Development mode, when you are done.';?>		
			<div class="notice notice-success is-dismissible amp-dev-notice" style="position:relative;
		    height: 40px; overflow: hidden; ">
				<div class="ampforwp-dev-mode-message" style="margin-top: 10px;">
					<?php echo $message; ?>					
				</div>	
			</div>
<?php }
}
 
// 76. Body Class for AMP pages
if (! function_exists( 'ampforwp_body_class' ) ) {
	function ampforwp_body_class( $class = '' ) {
	    // Separates classes with a single space, collates classes for body element
	    echo 'class="' . join( ' ', ampforwp_get_body_class( $class ) ) . '"';
	}
}

if (! function_exists( 'ampforwp_get_body_class' ) ) {
	function ampforwp_get_body_class( $class = '' ){
		global $wp_query, $redux_builder_amp, $post;
	 
	    $classes = array();
		$post_id = '';
		$post_type = '';

		$classes[] = 'body';

		if ( is_singular() ) {
			$post_id = $post->ID;
			$classes[] = 'single-post';
		}

		if ( ampforwp_is_front_page() ) {
	    	$post_id = ampforwp_get_frontpage_id();
		}

		if ( ampforwp_is_front_page() ) {
			$classes[] = 'amp-frontpage';
		}

	    $classes[] = $post_id;

	    if ( $post_id ) {
	    	$classes[] = 'post-id-' . $post_id;
	    	$classes[] = 'singular-' . $post_id;
	    }

	    if ( is_page() ) {
	    	$classes[] = 'amp-single-page';
	    }
	    
 
		if ( is_post_type_archive() ) {
			$post_type = get_queried_object();
			$classes[] = 'type-'. $post_type->rewrite['slug'];
		}
 
		if ( is_archive() ) {
			$page_id 	= get_queried_object_id();
			$classes[] 	= 'archives_body archive-'. $page_id;
		}

		if ( ! empty( $class ) ) {
		    if ( !is_array( $class ) )
		        $class = preg_split( '#\s+#', $class );
		    $classes = array_merge( $classes, $class );
		} else {
		    // Ensure that we always coerce class to being an array.
		    $class = array();
		}

		$classes = array_map( 'esc_attr', $classes );
	    $classes = apply_filters( 'ampforwp_body_class', $classes, $class );
	 
	    return array_unique( $classes );
	}

}

// Fallback for ticket #1006
function ampforwp_the_body_class(){ return ;}

// 77. AMP Blog Details
if( !function_exists('ampforwp_get_blog_details') ) {
	function ampforwp_get_blog_details( $param = "" ) {
		global $redux_builder_amp;
		$current_url = '';
		$output 	 = '';
		$slug 		 = '';
		$title 		 = '';
		$blog_id 	 = '';
		$current_url_in_pieces = array();
		if(is_home() && get_option('show_on_front') == 'page' ) {
			$current_url = home_url( $GLOBALS['wp']->request );
			$current_url_in_pieces = explode( '/', $current_url );
			$page_for_posts  =  get_option( 'page_for_posts' );
			if( $page_for_posts ){
				$post = get_post($page_for_posts);
				if ( $post ) {
					$slug = $post->post_name;
					$title = $post->post_title;
					$blog_id = $post->ID;
				}						
				switch ($param) {
					case 'title':
						$output = $title;
						break;
					case 'name':
						$output = $slug;
						break;
					case 'id':
						$output = $blog_id;
						break;
					default:
						if( in_array( $slug , $current_url_in_pieces , true ) || get_query_var('page_id') == $blog_id ) {
							$output = true;
						}
						else
							$output = false;
						break;
				}
			}
			else
				$output = false;
		}
		return $output;
	}
}
// 78. Saved Custom Post Types for AMP in Options for Structured Data
add_action("redux/options/redux_builder_amp/saved",'ampforwp_save_custom_post_types_sd', 10, 1);
if(! function_exists('ampforwp_save_custom_post_types_sd') ) {
	function ampforwp_save_custom_post_types_sd( $redux_builder_amp ){
		global $redux_builder_amp;
		$post_types 		= array();
		$saved_custom_posts = array();
		$count_current_pt 	= "";
		$count_saved_pt 	= "";
		$array_1 			= "";
		$array_2 			= "";

		$saved_custom_posts = get_option('ampforwp_custom_post_types');
		$post_types = ampforwp_get_all_post_types();

		
		if (empty($post_types)) {
			$post_types = array();
		}

		if (empty($saved_custom_posts)) {
			update_option('ampforwp_custom_post_types',  $post_types);
		}
 		if ( empty( $saved_custom_posts ) ) {
			$saved_custom_posts = array();
 		}

 		$count_current_pt = count( $post_types );
		$count_saved_pt =  count( $saved_custom_posts );

		if ( $count_current_pt > $count_saved_pt) {
			
			$array_1 = $post_types;
			$array_2 = $saved_custom_posts;
		} else {
			$array_1 = $saved_custom_posts;
			$array_2 = $post_types;
		}

		if( array_diff( $array_1, $array_2 ) ){	
			update_option('ampforwp_custom_post_types',  $post_types);
		}

	}
}

// 79. Favicon for AMP
add_action('amp_post_template_head','wp_site_icon');

// 80. Mobile Preview Styling 
	/*
	 * Code moved to accelerated-mobile-pages/includes/admin-style.css 
	 * As it is not the best practice to add css directly into admin head
	 * for more info please check the issue #1082 in github 
	*/
// 81. Duplicate Featured Image Support
add_filter('ampforwp_allow_featured_image', 'ampforwp_enable_post_and_featured_image');
function ampforwp_enable_post_and_featured_image($show_image){
	global $redux_builder_amp;

	if ( isset($redux_builder_amp['ampforwp-duplicate-featured-image']) && $redux_builder_amp['ampforwp-duplicate-featured-image'] == 1  ) {
		$show_image = true;	 
	}

	return $show_image; 
}

// 82. Grab Featured Image from The Content
function ampforwp_get_featured_image_from_content( $featured_image = "", $size="") {
	global $post, $posts;
	$image_url = $image_width = $image_height = $output = $matches = $output_fig = $amp_html_sanitizer = $amp_html = $image_html = $featured_image_output = $matches_fig = $figure = $output_fig_image = $matches_fig_img = '';
	ob_start();
	ob_end_clean();
	// Match all the images from the content
	if(is_object($post)){
		$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*.+width=[\'"]([^\'"]+)[\'"].*.+height=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
		// Match all the figure tags from the content
		$output_fig = preg_match_all('/\[caption.+id=[\'"]([^\'"]+).*]/i', $post->post_content, $matches_fig);
		if ( $output_fig && $matches_fig[0][0] ) {
			$output_fig_image = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*.+width=[\'"]([^\'"]+)[\'"].*.+height=[\'"]([^\'"]+)[\'"].*>(.*)\[/i', $matches_fig[0][0], $matches_fig_img);
			// Check if the first image is inside the figure and it got caption
			if ( $matches_fig_img[1][0] == $matches[1][0] && $matches_fig_img[4][0]) {
				$figure = true;
			}
		}
	}
	//Grab the First Image
	if (is_array($matches) && $matches[0] ) {
		$image_url 		= $matches[1][0];
		$image_html 	= $matches[0][0];
		$image_width 	= $matches[2][0];
		$image_height 	= $matches[3][0];
		// Sanitize it
		$amp_html_sanitizer = new AMPFORWP_Content( $image_html, array(), apply_filters( 'ampforwp_content_sanitizers', array( 'AMP_Img_Sanitizer' => array(), 'AMP_Style_Sanitizer' => array() ) ) );
	    $amp_html =  $amp_html_sanitizer->get_amp_content();
	    // If its figure then add the figcaption inside the figure
	    if ( $figure ) {
	   		$amp_html = $amp_html . '<figcaption class="wp-caption-text">' . esc_attr($matches_fig_img[4][0]) . '</figcaption>';
	   	}
	    // Filter to remove that image from the content
	    add_filter('ampforwp_modify_the_content','featured_image_content_filter');
	
		if ( isset( $size ) && '' !== $size ) {
			$image_id = attachment_url_to_postid( $image_url );
			if ($image_id) {
				$image_array = wp_get_attachment_image_src($image_id, $size, true);
				$image_url = $image_array[0];
				$image_width = $image_array[1];
				$image_height = $image_array[2]; 
			}
		}
	}
	switch ($featured_image) {
			case 'image':
				$featured_image_output = $amp_html;
			break;
			case 'url':
				$featured_image_output = $image_url;
			break;
			case 'width':
				$featured_image_output = $image_width;
			break;
			case 'height':
				$featured_image_output = $image_height;
			break;
			default:
				$featured_image_output = $amp_html;
			break;
		}	
	return $featured_image_output;
}
// Remove 1st image from the content if Featured image from the content option is enabled
if( ! function_exists( 'featured_image_content_filter' ) ){
	function featured_image_content_filter($content){
		global $redux_builder_amp;
		$featured_image = "";
		$featured_image = ampforwp_get_featured_image_from_content('url');
		if( $featured_image && false == $redux_builder_amp['ampforwp-duplicate-featured-image']){
			// Change the src to use it in the pattern
			$featured_image = str_replace('/', '\/', $featured_image);
			// Remove the figure (due to caption)
			$content = preg_replace('/<figure(.*)src="'.$featured_image.'"(.*?)<\/figure>/', '', $content);
			// Remove the amp-img
			if(empty(has_post_thumbnail())){
			$content = preg_replace('/<amp-img(.*)src="'.$featured_image.'"(.*?)<\/amp-img>/', '', $content);
			}
		}
	return $content;
	}
}


// 83. Advance Analytics(Google Analytics)
add_filter('ampforwp_advance_google_analytics','ampforwp_add_advance_ga_fields');
function ampforwp_add_advance_ga_fields($ga_fields){
	global $redux_builder_amp, $post;
	$url = $title = $id = $author_id = $author_name = '';
	$url = get_the_permalink();
	if(!is_object($post)){ return $ga_fields; }
	$title = $post->post_title;
	$id = $post->ID;
	$author_id = $post->post_author;
	$author_name = get_the_author_meta( 'display_name' , $author_id );
	$ampforwp_adv_ga_fields = array();
	$ampforwp_adv_ga_fields = $redux_builder_amp['ampforwp-ga-field-advance'];
	if($ampforwp_adv_ga_fields && $redux_builder_amp['ampforwp-ga-field-advance-switch'])	{
		$ampforwp_adv_ga_fields = str_replace('{url}', $url, $ampforwp_adv_ga_fields);
		$ampforwp_adv_ga_fields = str_replace('{id}', $id, $ampforwp_adv_ga_fields);
		$ampforwp_adv_ga_fields = str_replace('{title}', $title, $ampforwp_adv_ga_fields);
		$ampforwp_adv_ga_fields = str_replace('{author_name}', $author_name, $ampforwp_adv_ga_fields);
		$ampforwp_adv_ga_fields = str_replace('{author_id}', $author_id, $ampforwp_adv_ga_fields);
		return $ampforwp_adv_ga_fields;
	}	
	return $ga_fields;	
}

function ampforwp_yarpp_post_loop_query($reference_ID = null, $args = array()){
		global $yarpp,$redux_builder_amp;
		$string_number_of_related_posts = $redux_builder_amp['ampforwp-number-of-related-posts'];
		$int_number_of_related_posts = (int) $string_number_of_related_posts;
		$posts = $yarpp->get_related( null, array());
		if(!$posts){
			return ;
		}
		foreach ($posts as $key => $value) {
			$postsIds[] = $value->ID;
		}
		$args = array(
			'posts_per_page' => $int_number_of_related_posts,
		    'post__in' => $postsIds
		);
		$posts = new WP_Query($args);
		return $posts;	
}


function ampforwp_yarpp_loop_query_for_inline_related_posts($reference_ID = null, $args = array()){
		global $yarpp,$redux_builder_amp;
		$string_number_of_related_posts = $redux_builder_amp['ampforwp-number-of-inline-related-posts'];
		$int_number_of_related_posts = (int) $string_number_of_related_posts;
		$posts = $yarpp->get_related( null, array());
		if(!$posts){
			return ;
		}
		foreach ($posts as $key => $value) {
			$postsIds[] = $value->ID;
		}
		$orderby = 'ID';
		if( isset( $redux_builder_amp['ampforwp-inline-related-posts-order'] ) && $redux_builder_amp['ampforwp-inline-related-posts-order'] ){
			$orderby = 'rand';
		}
		$args = array(
			'orderby' => $orderby,
			'posts_per_page' => $int_number_of_related_posts,
		    'post__in' => $postsIds
		);
		$posts = new WP_Query($args);
		return $posts;
}

// 84. Inline Related Posts

function ampforwp_inline_related_posts(){
	global $post, $redux_builder_amp;
		$string_number_of_related_posts = $redux_builder_amp['ampforwp-number-of-inline-related-posts'];		
		$int_number_of_related_posts = (integer) $string_number_of_related_posts;

		// declaring this variable here to prevent debug errors
		$args = null;
		$orderby = 'ID';
		if( isset( $redux_builder_amp['ampforwp-inline-related-posts-order'] ) && $redux_builder_amp['ampforwp-inline-related-posts-order'] ){
			$orderby = 'rand';
		}

		// Custom Post types 
       if( $current_post_type = get_post_type( $post )) {
                // The query arguments
       		//#1263
       		if($current_post_type != 'page'){
                $args = array(
                    'posts_per_page'=> $int_number_of_related_posts,
                    'order' => 'DESC',
                    'orderby' => $orderby,
                    'post_type' => $current_post_type,
                    'post__not_in' => array( $post->ID )

                );  
            } 			
		}//end of block for custom Post types

		if($redux_builder_amp['ampforwp-inline-related-posts-type']==2){
		    $categories = get_the_category($post->ID);
					if ($categories) {
							$category_ids = array();
							foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
							$args=array(
							    'category__in' => $category_ids,
							    'post__not_in' => array($post->ID),
							    'posts_per_page'=> $int_number_of_related_posts,
							    'ignore_sticky_posts'=>1,
								'has_password' => false ,
								'post_status'=> 'publish',
								'orderby'    => $orderby
							);
						}
			} //end of block for categories
			//code block for tags
		 if($redux_builder_amp['ampforwp-inline-related-posts-type']==1) {
					$ampforwp_tags = get_the_tags($post->ID);
						if ($ampforwp_tags) {
										$tag_ids = array();
										foreach($ampforwp_tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
										$args=array(
										   'tag__in' => $tag_ids,
										    'post__not_in' => array($post->ID),
										    'posts_per_page'=> $int_number_of_related_posts,
										    'ignore_sticky_posts'=>1,
											'has_password' => false ,
											'post_status'=> 'publish',
											'orderby'    => $orderby
										);
					}
			}//end of block for tags
			$my_query = new wp_query( $args );
			if( is_plugin_active( 'yet-another-related-posts-plugin/yarpp.php' )){
				$yarpp_query = ampforwp_yarpp_loop_query_for_inline_related_posts();
				if( $yarpp_query ){
					$my_query = $yarpp_query;
				}
			}
					if( $my_query->have_posts() ) { 
				$inline_related_posts = '<div class="amp-wp-content relatedpost">
						    <div class="related_posts">
										<ol class="clearfix">
						<span class="related-title">'.ampforwp_translation( $redux_builder_amp['amp-translator-related-text'], 'Related Post' ).'</span>';
						
				    while( $my_query->have_posts() ) {
					    $my_query->the_post();
						$related_post_permalink = get_permalink();
						$related_post_permalink = trailingslashit($related_post_permalink);
						$related_post_permalink = ampforwp_url_controller( $related_post_permalink );
						if ( ampforwp_has_post_thumbnail() ) {
							$title_class = 'has_related_thumbnail';
						} else {
							$title_class = 'no_related_thumbnail'; 
						}
						$inline_related_posts .= '<li class="'.$title_class.'">';
						if ( true == $redux_builder_amp['ampforwp-single-related-posts-image'] ) {
                            $inline_related_posts .= '<a href="'.esc_url( $related_post_permalink ).'" rel="bookmark" title="'.get_the_title().'">';
			          
			           		$thumb_url_2 = ampforwp_get_post_thumbnail('url');
			            
							if ( ampforwp_has_post_thumbnail() ) {
								if( 4 == $redux_builder_amp['amp-design-selector'] ){
									$thumb_url_2 = ampforwp_aq_resize( $thumb_url_2, 220 , 134 , true, false );
									$inline_related_posts .= '<amp-img src="'.esc_url( $thumb_url_2[0] ).'" width="' . $thumb_url_2[1] . '" height="' . $thumb_url_2[2] . '" layout="responsive"></amp-img>';
								}
								else{
									$inline_related_posts .= '<amp-img src="'.esc_url( $thumb_url_2 ).'" width="150" height="150" layout="responsive"></amp-img>';
								}
							} 
							$inline_related_posts .='</a>';
						}
						$inline_related_posts .='<div class="related_link">';
						$inline_related_posts .='<a href="'.esc_url( $related_post_permalink ).'">'.get_the_title().'</a>';
	                    if( has_excerpt() ){
							$content ='<p>'.get_the_excerpt().'</p>';
						}else{
							$content ='<p>'.get_the_content().'</p>';
						}
                    	$inline_related_posts .= '<p>'. wp_trim_words( strip_shortcodes( $content ) , '15' ).'</p>
                			</div>
           			 	</li>';							
					}					     
				$inline_related_posts .= '</ol>
						    </div>
						</div>';
					}
	      wp_reset_postdata();
	      return $inline_related_posts;
//related posts code ends here
}

add_action('pre_amp_render_post','ampforwp_add_inline_related_posts');
function ampforwp_add_inline_related_posts(){
	global $redux_builder_amp;
	if($redux_builder_amp['ampforwp-inline-related-posts'] == 1 && is_single() && ampforwp_inline_related_posts() ){
		if( isset($redux_builder_amp['ampforwp-inline-related-posts-display-type']) && $redux_builder_amp['ampforwp-inline-related-posts-display-type']=='middle' ){
			add_filter('ampforwp_modify_the_content','ampforwp_generate_inline_related_posts');
		}else{
			add_filter('ampforwp_modify_the_content','ampforwp_generate_inline_related_posts_by_paragraph');
		}
		
	}
}
function ampforwp_generate_inline_related_posts($content){
	global $post;
		
	$break_point = '</p>';
	$content_parts = explode($break_point, $content);
	array_walk($content_parts, function(&$value, $key) {
		 	$value = trim($value);
			if( !empty($value) && strpos($value, "<p>")!==false ){
			         $value .= '</p>';
			}
		}
	);
	if(count($content_parts)>1){
		$no_of_parts = count($content_parts);
		$half_index = floor($no_of_parts / 2);
		$half_content = array_chunk($content_parts, $half_index);
		
		$html ='<div class="ampforwp-inline-related-post">'.ampforwp_inline_related_posts().'</div>';
		$half_content[0][] = $html;
		$final_content ='';
		foreach ($half_content as $key => $value) {
			$final_content .= implode("", $value);
		}
		$content = $final_content;
	}
	return $content;
}
function  ampforwp_generate_inline_related_posts_by_paragraph($content){
	global $redux_builder_amp;
	$total_count = '';
	$int_number_of_paragraphs = (integer) $redux_builder_amp['ampforwp-related-posts-after-number-of-paragraphs'];

	if(isset($int_number_of_paragraphs) && $int_number_of_paragraphs!=''){
		if($int_number_of_paragraphs == 0){
			$content = '<div class="ampforwp-inline-related-post">'.ampforwp_inline_related_posts().'</div>'.$content;
		}else{
			$total_count = explode("</p>", $content);
    		$total_count = count($total_count); // call count() only once, it's faster
    		if($total_count < $int_number_of_paragraphs){
    			$content = $content.'<div class="ampforwp-inline-related-post">'.ampforwp_inline_related_posts().'</div>';
    		}else{
    			$content = preg_replace_callback('#(<p>.*?</p>)#', 'ampforwp_add_related_post_after_paragraph', $content);
    		}
			
		}
	}else{
		$content = $content.'<div class="ampforwp-inline-related-post">'.ampforwp_inline_related_posts().'</div>';
	}
	
	return $content;
}

function ampforwp_add_related_post_after_paragraph($matches)
{
	global $redux_builder_amp;
	static $count = 0;
	$ret = '';
	$int_number_of_paragraphs = (integer) $redux_builder_amp['ampforwp-related-posts-after-number-of-paragraphs'];
	
  		$ret = $matches[1];

	  	if (++$count == $int_number_of_paragraphs){
	  		$ret .= '<div class="ampforwp-inline-related-post">'.ampforwp_inline_related_posts().'</div>';

	  	}
    
  return $ret;
}

// 85. Caption for Gallery Images
// Add extra key=>value pair into the attachment array
add_filter('amp_gallery_image_params','ampforwp_gallery_new_params', 10, 2);
function ampforwp_gallery_new_params($urls, $attachment_id ){
	$new_urls = array();
	$captext = '';
	$caption = array();
	$captext = get_post( $attachment_id)->post_excerpt;
	if($captext){
		// Append only when caption is present
		$caption = array('caption'=>$captext);
		$new_urls = array_merge($urls,$caption);
		return $new_urls;
	}
	else{
		//If there's No caption
		return $urls;	
	}
}


if( !function_exists( 'ampforwp_carousel_class_magic' ) ){
	function ampforwp_carousel_class_magic($content){
		$content = str_replace(array(':openbrack:',':closebrack:'), array('[',']'), $content);
	return $content;
	}
}
// 86. minify the content of pages
// Moved to performance-functions.php

// 87. Post Thumbnail
// Checker for Post Thumbnail
if( !function_exists('ampforwp_has_post_thumbnail')){
	function ampforwp_has_post_thumbnail(){
		global $post, $redux_builder_amp;
		if(has_post_thumbnail()){
			return true;
		}
		elseif(ampforwp_is_custom_field_featured_image() && ampforwp_cf_featured_image_src()){
			return true;
		}
		elseif(isset($redux_builder_amp['ampforwp-featured-image-from-content']) && $redux_builder_amp['ampforwp-featured-image-from-content'] == true){
			if( ampforwp_get_featured_image_from_content() || ampforwp_get_featured_image_from_content('url') ){				
				return true;
			}
		}
		else
			return false;
	}
}
// Get Post Thumbnail URL
if( !function_exists('ampforwp_get_post_thumbnail')){
	function ampforwp_get_post_thumbnail($param="", $size=""){
		global $post, $redux_builder_amp;
		$thumb_url 		= '';
		$thumb_width 	= '';
		$thumb_height 	= '';
		$output 		= '';
		if ( has_post_thumbnail()) {
			if( empty($size) ) {
				$size = 'medium';
			} 
			$thumb_id 			= get_post_thumbnail_id();
			$thumb_url_array 	= wp_get_attachment_image_src($thumb_id, $size , true);
			$thumb_url 			= $thumb_url_array[0];
			$thumb_width 		= $thumb_url_array[1];
			$thumb_height 		= $thumb_url_array[2];
		}
		if(ampforwp_is_custom_field_featured_image() && ampforwp_cf_featured_image_src()){
			$thumb_url 		= ampforwp_cf_featured_image_src();
			$thumb_width 	= ampforwp_cf_featured_image_src('width');
			$thumb_height 	= ampforwp_cf_featured_image_src('height');
		}
		if( true == $redux_builder_amp['ampforwp-featured-image-from-content'] && ampforwp_get_featured_image_from_content('url') ){
			$thumb_url 		= ampforwp_get_featured_image_from_content('url', $size);
			$thumb_width 	= ampforwp_get_featured_image_from_content('width', $size);
			$thumb_height 	= ampforwp_get_featured_image_from_content('height', $size);
		}
		switch ($param) {
			case 'url':
				$output = $thumb_url;
				break;
			case 'width':
				$output = $thumb_width;
				break;
			case 'height':
				$output = $thumb_height;
				break;	
			default:
				$output = $thumb_url;
				break;
		}
		return $output;
	}	
}

// 88. Author Details
// Author Page URL
if( ! function_exists( 'ampforwp_get_author_page_url' ) ){
	function ampforwp_get_author_page_url(){
		global $redux_builder_amp, $post;
		$author_id = '';
		$author_page_url = '';
		$author_id = get_the_author_meta( 'ID' );
		$author_page_url = get_author_posts_url( $author_id );
		// If Archive support is enabled
		if(  isset($redux_builder_amp['ampforwp-archive-support'] ) && $redux_builder_amp['ampforwp-archive-support'] ){
    		$author_page_url = ampforwp_url_controller( $author_page_url  );
    	}
		return $author_page_url;
	}
}
// Author Meta
if( ! function_exists( 'ampforwp_get_author_details' ) ){
	function ampforwp_get_author_details( $post_author , $params='' ){
		global $redux_builder_amp, $post;
		$post_author_url = '';
		$post_author_name = '';
		$post_author_name = $post_author->display_name;
		$post_author_url = ampforwp_get_author_page_url();
		$and_text = '';
		$and_text = ampforwp_translation($redux_builder_amp['amp-translator-and-text'], 'and' );
		if ( function_exists('coauthors') ) { 
			$post_author_name = coauthors($and_text,$and_text,null,null,false);
		}
		if ( function_exists('coauthors_posts_links') ) {
			$post_author_url = coauthors_posts_links($and_text,$and_text,null,null,false);
		}
		switch ($params) {
			case 'meta-info':
				if( isset($redux_builder_amp['ampforwp-author-page-url']) && $redux_builder_amp['ampforwp-author-page-url'] ) {
					if ( function_exists('coauthors_posts_links') ) {
						return '<span class="amp-wp-author author vcard">'. $post_author_url .'</span>';
					}
					return	'<span class="amp-wp-author author vcard"><a href="'.esc_url($post_author_url).'">'.esc_html( $post_author_name ).'</a></span>';
 				}
				else { 
					return '<span class="amp-wp-author author vcard">' .esc_html( $post_author_name ).'</span>';
				 } 
				break;

			case 'meta-taxonomy':
				if( isset($redux_builder_amp['ampforwp-author-page-url']) && $redux_builder_amp['ampforwp-author-page-url'] ) { 
					if ( function_exists('coauthors_posts_links') ) {
						return	$post_author_url;
					}
	                return	'<a href="' . esc_url($post_author_url) . ' "><strong>' . esc_html( $post_author_name ) . ' </strong></a>:'; 
	                 }
                	else{ 
                		return '<strong> ' . esc_html( $post_author_name) . ' </strong>:';
                	}
				break;
		}
	}
}

// 89. Facebook Pixel

add_action('amp_post_template_footer','ampforwp_facebook_pixel',11);
		function ampforwp_facebook_pixel() {

			global $redux_builder_amp;
			if( isset($redux_builder_amp['amp-fb-pixel']) && $redux_builder_amp['amp-fb-pixel'] ){
				$amp_pixel = '<amp-pixel ';
				if(ampforwp_get_data_consent()){
					$amp_pixel .= 'data-block-on-consent';
				}
				$amp_pixel .= ' src="https://www.facebook.com/tr?id='.$redux_builder_amp['amp-fb-pixel-id'].'&ev=PageView&noscript=1"></amp-pixel>';
				echo $amp_pixel;

			}
		}
//90. Set Header last modified information
add_action('template_redirect', 'ampforwp_addAmpLastModifiedHeader',12);
function ampforwp_addAmpLastModifiedHeader($headers) {

    //Check if we are in a single post of any type (archive pages has not modified date)
    $ampforwp_is_amp_endpoint = ampforwp_is_amp_endpoint();

    if( is_singular() && $ampforwp_is_amp_endpoint ) {
        $post_id = get_queried_object_id();
        if( $post_id ) {
            header("Last-Modified: " . get_the_modified_time("D, d M Y H:i:s", $post_id) );
        }
    }
}
// 91. Comment Author Gravatar URL
if( ! function_exists('ampforwp_get_comments_gravatar') ){
	function ampforwp_get_comments_gravatar( $comment ) {
		global $redux_builder_amp;
		if(isset($redux_builder_amp['ampforwp-display-avatar']) && $redux_builder_amp['ampforwp-display-avatar']==0){
			return '';
		}
	$gravatar_exists = '';
	$gravatar_exists = ampforwp_gravatar_checker($comment->comment_author_email);
	if($gravatar_exists == true){
		return get_avatar_url( $comment, apply_filters( 'ampforwp_get_comments_gravatar', '60' ), '' );
	}
	else
		return apply_filters( 'ampforwp_get_comments_gravatar', '' );   	
	}
}
// Gravatar Checker
if ( ! function_exists('ampforwp_gravatar_checker') ) {
	function ampforwp_gravatar_checker( $email ) {
		// Craft a potential url and test its headers
		$hash = md5(strtolower(trim($email)));
		//$uri = 'http://www.gravatar.com/avatar/' . $hash . '?d=404';
		$gravatar_server = 0;
		if ( $hash ) {
			$gravatar_server = hexdec( $hash[0] ) % 3;
		} else {
			$gravatar_server = rand( 0, 2 );
		}
		if ( is_ssl() ) {
			$uri = 'https://secure.gravatar.com/avatar/' . $hash;
		} else {
			$uri = sprintf( 'http://%d.gravatar.com/avatar/%s', $gravatar_server, $hash );
		}
		$headers = @get_headers($uri);
		// If its 404
		if (!preg_match("|200|", $headers[0])) {
			$has_valid_avatar = FALSE;
		} 
		// Else if it is 200
		else {
			$has_valid_avatar = TRUE;
		}
		return $has_valid_avatar;
	}
}
// 92. View AMP in Admin Bar
add_action( 'wp_before_admin_bar_render', 'ampforwp_view_amp_admin_bar' ); 
if( ! function_exists( 'ampforwp_view_amp_admin_bar' ) ) {
	function ampforwp_view_amp_admin_bar( ) {
		global $wp_admin_bar, $post, $wp_post_types, $redux_builder_amp;
		$post_type_title = '';
		$supported_amp_post_types = array();
		
		// Get all post types supported by AMP
		$supported_amp_post_types = ampforwp_get_all_post_types();
		// Check for Admin
		if ( is_admin() ) {
			$current_screen = get_current_screen();
			// Check for Screen base, user ability to read and visibility
			if ('post' == $current_screen->base 
				&& 'add' != $current_screen->action 
				&& current_user_can('read_post', $post->ID )
				&& ( $wp_post_types[$post->post_type]->public )
				&& ( $wp_post_types[$post->post_type]->show_in_admin_bar ) ) {
				// Check if current post type is AMPed or not
				if( $supported_amp_post_types && in_array($post->post_type, $supported_amp_post_types) ){
					// If AMP on Posts or Pages is off then do nothing
					if($post->post_type == 'post' && !$redux_builder_amp['amp-on-off-for-all-posts'] || $post->post_type == 'page' && !$redux_builder_amp['amp-on-off-for-all-pages']) {
						return;
					}
					$post_type_title = ucfirst($post->post_type);
					$wp_admin_bar->add_node(array(
						'id'    => 'ampforwp-view-amp',
						'title' => 'View ' . $post_type_title . ' (AMP)' ,
						'href'  => ampforwp_url_controller( get_permalink( $post->ID ) )
					));
				}
			}
		}
	}
}
//93. added AMP url purifire for amphtml
function ampforwp_url_purifier($url){
	global $wp_query,$wp,$redux_builder_amp;
	$get_permalink_structure 	= "";
	$endpoint 					= "";
	$endpointq					= "";
	$queried_var				= "";
	$quried_value				= "";
	$query_arg					= "";
	$endpoint 					= AMPFORWP_AMP_QUERY_VAR;
	$get_permalink_structure = get_option('permalink_structure');
	$checker = $redux_builder_amp['amp-core-end-point'];
	$endpointq = '?' . $endpoint;

	if ( empty( $get_permalink_structure ) ) {

		if ( is_home() || is_archive() || is_front_page() ) {
			$url  = add_query_arg(AMPFORWP_AMP_QUERY_VAR,'1', $url);
			if ( is_home() && get_query_var('page_id') == ampforwp_get_blog_details('id') ) {
				$quried_value = get_query_var('page_id');
				if ( '' != $quried_value)
					$url  = add_query_arg('page_id',$quried_value, $url);
			}
			if ( get_query_var('paged') >= 2 ) {
				$quried_value = get_query_var('paged');
				$url  = add_query_arg('paged',$quried_value, $url);
			}
		}
		if ( is_archive() ) {

			if ( is_archive() ) {
				$queried_var 	= 'm';
			}
			if ( is_tag() ) {
				$queried_var 	= 'tag';
			}
			if ( is_category() ) {
				$queried_var 	= 'cat';
			}
			if ( is_author() ) {
				$queried_var 	= 'author';
			}
			$quried_value 	= get_query_var($queried_var);
			$url  = add_query_arg($queried_var,$quried_value, $url);
			//$url = $url .'&'. $queried_var .'='. $quried_value;
		}
		/*if ( is_home() && get_query_var('paged') > 1 ) {
			$quried_value = get_query_var('paged');
			$url = add_query_arg('paged',$quried_value, $url);
			if ( get_query_var('page_id') == ampforwp_get_blog_details('id') ) {
				$quried_value2 = get_query_var('page_id');
				$url = add_query_arg('page_id',$quried_value2, $url);
			}
		}
		elseif ( is_home() && get_query_var('paged') < 1 && get_query_var('page_id') == ampforwp_get_blog_details('id') ) {
			$quried_value2 = get_query_var('page_id');
			$url = add_query_arg('page_id',$quried_value2, $url);
		}*/
	} else {
		if ( is_singular() && true == $checker ) {
			$url = untrailingslashit($url);
		}
		if ( is_home() || is_archive() || is_front_page() ) {
	        if ( is_archive() && get_query_var('paged') > 1 || is_home() && get_query_var('paged') > 1 ) {
	        	if ( true == $checker )
	        		$url = trailingslashit($url).$endpointq;
	        	else
	          		$url = user_trailingslashit( trailingslashit($url) );
	        } else {
	        	if ( true == $checker )
	        		$url =  trailingslashit($url) . $endpointq;
	        	else
	          		$url = user_trailingslashit( trailingslashit($url) . $endpoint );
	        }
      	}
	}
	if ( is_singular() && !empty($_SERVER['QUERY_STRING']) ) {
	      $query_arg   = wp_parse_args($_SERVER['QUERY_STRING']);
	      $query_name = '';
			if(is_single()){
				$query_name = $wp_query->query['name'];	
			}
			else{
				$query_name = $wp_query->query['pagename'];
			}
	      	if( ampforwp_is_query_post_same( $_SERVER['QUERY_STRING'],$query_name) && isset( $query_arg['q'] ) ){
           	 	unset($query_arg['q']);
          	}
	  		else if ( $query_name && isset( $query_arg['q'] ) ){ 
	  			unset($query_arg['q']); 
	  		}
	      
	      $url     = add_query_arg( $query_arg, $url);
	}
	return apply_filters( 'ampforwp_url_purifier', $url );
}

// 94. OneSignal Push Notifications
// Moved to push-notifications-functions.php

// 95. Modify menu link attributes for SiteNavigationElement Schema Markup #1229 #1345
add_filter( 'nav_menu_link_attributes', 'ampforwp_nav_menu_link_attributes', 10, 3 );
if( ! function_exists( 'ampforwp_nav_menu_link_attributes' ) ) {
	function ampforwp_nav_menu_link_attributes( $atts, $item, $args ) {
		if ( function_exists('ampforwp_is_amp_endpoint') && ampforwp_is_amp_endpoint() ) {
	    // Manipulate link attributes
	    	$atts['itemprop'] = "url";
	    }
	    return $atts;
	}
}

// 96. ampforwp_is_front_page() ampforwp_is_home() and ampforwp_is_blog is created
// Moved to functions.php

// 97. Change the format of the post date on Loops #1384
add_filter('ampforwp_modify_post_date', 'ampforwp_full_post_date_loops');
if( ! function_exists( 'ampforwp_full_post_date_loops' ) ){
	function ampforwp_full_post_date_loops($full_date){
	global $redux_builder_amp;
	if( is_home() || is_archive() ){
		if( 2 == $redux_builder_amp['ampforwp-post-date-format'] ){	
			$full_date =  get_the_date();
			if( 2 == $redux_builder_amp['ampforwp-post-date-global'] ){
				$full_date =  get_the_modified_date();
			}
		}
		if( 1 == $redux_builder_amp['ampforwp-post-date-format'] ){
			$time = get_the_time('U', get_the_ID() );
			if( 2 == $redux_builder_amp['ampforwp-post-date-global'] ){
					$time = get_the_modified_time('U', get_the_ID() );
			}
			$date = human_time_diff( $time, current_time('timestamp') );
			if( $redux_builder_amp['ampforwp-post-date-format-text'] ){
				$full_date = $redux_builder_amp['ampforwp-post-date-format-text'];
				// Change the % days into the actual number of days
				$full_date = str_replace('% days', $date, $full_date);
				$full_date = str_replace('ago', ampforwp_translation( $redux_builder_amp['amp-translator-ago-date-text'],'ago'), $full_date);
			}
		}
	}
	if(is_single() && 1 == $redux_builder_amp['ampforwp-post-date-format']){
		$time = get_the_time('U', get_the_ID() );
		if( 2 == $redux_builder_amp['ampforwp-post-date-global'] ){
			$time = get_the_modified_time('U', get_the_ID() );
		}
		$date 		= human_time_diff( $time, current_time('timestamp') );
		$full_date 	= human_time_diff( $time, current_time('timestamp') ) .' '. ampforwp_translation( $redux_builder_amp['amp-translator-ago-date-text'],'ago');
		if( $redux_builder_amp['ampforwp-post-date-format-text'] ){
			$full_date = $redux_builder_amp['ampforwp-post-date-format-text'];
			// Change the % days into the actual number of days
			$full_date = str_replace('% days', $date, $full_date);
			$full_date = str_replace('ago', ampforwp_translation( $redux_builder_amp['amp-translator-ago-date-text'],'ago'), $full_date);
		}
	}
	return $full_date;
	}
}

// 98. Create Dynamic url of amp according to the permalink structure #1318
function ampforwp_url_controller( $url, $nonamp = '' ) {
	global $redux_builder_amp;
	$non_amp = false;
	$non_amp = apply_filters( 'ampforwp_non_amp_links', $non_amp );
	if($non_amp == true){
		return $url;
	}
	$new_url = "";
	$get_permalink_structure = "";
	if ( ampforwp_amp_nonamp_convert("", "check") || (isset($redux_builder_amp['ampforwp-amp-takeover']) && true == $redux_builder_amp['ampforwp-amp-takeover']) ) {
		$nonamp = 'nonamp';
	}
	if ( isset($nonamp) && 'nonamp' == $nonamp ) {
		return $url;
	}
	$get_permalink_structure = get_option('permalink_structure');
	if ( $get_permalink_structure ) {
 		if ( isset($redux_builder_amp['amp-core-end-point']) && 1 == $redux_builder_amp['amp-core-end-point'] ) {
	     		$new_url = trailingslashit($url);
	     		$new_url = $new_url.'?'.AMPFORWP_AMP_QUERY_VAR;
	 			//$new_url = add_query_arg(AMPFORWP_AMP_QUERY_VAR,'1', $new_url);
 			}
 		else {
 				$new_url = user_trailingslashit( trailingslashit( $url ) . AMPFORWP_AMP_QUERY_VAR);
 			}
	} else {
		$new_url = add_query_arg( 'amp', '1', $url );
	}

	return esc_url( apply_filters( 'ampforwp_url_controller', $new_url ) );
}
// 99. Merriweather Font Management
add_filter( 'amp_post_template_data', 'ampforwp_merriweather_font_management' );
function ampforwp_merriweather_font_management( $data ) {
	global $redux_builder_amp;

	if ( isset($redux_builder_amp['amp-design-selector']) && $redux_builder_amp['amp-design-selector'] != 1) {
		unset($data['font_urls']['merriweather']);
	}
	
	return $data;
}

// 100. Flags compatibility in Menu
add_filter('ampforwp_menu_content','ampforwp_modify_menu_content');
if( ! function_exists(' ampforwp_modify_menu_content ') ){
	function ampforwp_modify_menu_content($menu){
		$dom 		= '';
		$nodes 		= '';
		$num_nodes 	= '';
		if( !empty( $menu ) ){
			// Create a new document
			$dom = new DOMDocument();
			if( function_exists( 'mb_convert_encoding' ) ){
				$menu = mb_convert_encoding($menu, 'HTML-ENTITIES', 'UTF-8');			
			}
			else{
				$menu =  preg_replace( '/&.*?;/', 'x', $menu ); // multi-byte characters converted to X
			}

			// To Suppress Warnings
			libxml_use_internal_errors(true);

			$dom->loadHTML($menu);

			libxml_use_internal_errors(false);

			// get all the img's
			$nodes 		= $dom->getElementsByTagName( 'img' );
			$num_nodes 	= $nodes->length;
			for ( $i = $num_nodes - 1; $i >= 0; $i-- ) {
				$node 	= $nodes->item( $i );
				// Set The Width and Height if there in none
				if ( '' === $node->getAttribute( 'width' ) ) {
					$node->setAttribute('width', 15);
				}
				if( '' === $node->getAttribute( 'height' ) ){
					$node->setAttribute('height', 15);
				}
			}
			$menu = $dom->saveHTML();
		}
		return $menu;
	}
}
/*
 * Fetches the logo data 
 * More details about the fix https://github.com/ahmedkaludi/accelerated-mobile-pages/pull/2317
 * Props to: https://github.com/saucal for suggesting the fix.
*/

function ampforwp_default_logo_data() {
	global $redux_builder_amp, $ampwforwp_default_logo_data;

	if( $ampwforwp_default_logo_data ) {
		return $ampwforwp_default_logo_data;
	}

	$logo_id		= '';
	$image 			= array();
	$value 			= '';
	$logo_alt		= '';

	$logo_id = get_theme_mod( 'custom_logo' );
	if( isset($redux_builder_amp['opt-media']['id']) && empty( $logo_id ) ) {
		$logo_id = (integer) $redux_builder_amp['opt-media']['id'];
	}

	if( empty( $logo_id ) ) {
		return false;
	}

	if( ! wp_attachment_is( 'image', $logo_id ) ) {
		$logo_url = $redux_builder_amp['opt-media']['url'];
		$image = @getimagesize( $logo_url );
	} else {
		$imageDetail = wp_get_attachment_image_src( $logo_id , 'full');
		$logo_url = $imageDetail[0];
		$image[0] = $imageDetail[1];
		$image[1] = $imageDetail[2];
		if ( 0 === $image[1] ) {
			$image[0] = '190';
			$image[1] = '36';
		}
	}

	$logo_alt = get_post_meta( $logo_id, '_wp_attachment_image_alt', true);

	$ampwforwp_default_logo_data = array(
		'logo_id' => $logo_id,
		'logo_url' => $logo_url,
		'logo_alt' => $logo_alt,
		'logo_size' => $image
	);
	return $ampwforwp_default_logo_data;
}

// 101. Function for Logo attributes
function ampforwp_default_logo($param=""){
	global $redux_builder_amp;
	$value 		= '';
	$logo_alt 	= '';
	$data 		= ampforwp_default_logo_data();
	if( ! $data ) {
		return $value;
	}

	switch ($param) {
		case 'url':
				$value = $data['logo_url'];
			break;
		case 'width':
			if (true == $redux_builder_amp['ampforwp-custom-logo-dimensions'] && 'prescribed' == $redux_builder_amp['ampforwp-custom-logo-dimensions-options']) {
				$value = $redux_builder_amp['opt-media-width'];
			}
			else 
				$value = $data['logo_size'][0];
			break;
		case 'height':
			if (true == $redux_builder_amp['ampforwp-custom-logo-dimensions'] && 'prescribed' == $redux_builder_amp['ampforwp-custom-logo-dimensions-options']) {
				$value = $redux_builder_amp['opt-media-height'];
			}
			else
				$value = $data['logo_size'][1];
			break;
		case 'alt':
			if($logo_alt){
				$value = $data['logo_alt'];
			}
			else
				$value = get_bloginfo('name');
			break;	
		default:
			$value = $data['logo_url'];
			break;
	}

	return $value;
} 
// Envira Lazy Load compatibility
add_filter('envira_gallery_pre_data', 'ampforwp_envira_lazy_load');
if( ! function_exists(' ampforwp_envira_lazy_load ') ){
	function ampforwp_envira_lazy_load($data){
	if( function_exists('ampforwp_is_amp_endpoint') && ampforwp_is_amp_endpoint() ){
		if(function_exists('envira_get_config')){
			$checker = envira_get_config( 'lazy_loading', $data);
			if( 1 === $checker){
				$data['config']['lazy_loading'] = 0;
			}
		}
	}	
	return $data;
	}
}	

#1581 Instagram Sanitizer 

add_filter( 'amp_content_sanitizers', 'ampforwp_instagram_sanitizer', 10, 1 );

function ampforwp_instagram_sanitizer( $sanitizer_classes ) {
  require_once( AMPFORWP_PLUGIN_DIR. 'classes/class-ampforwp-instagram-sanitizer.php' );
  $sanitizer_classes[ 'AMPFORWP_Instagram_Embed_Sanitizer' ] = array(); 
  return $sanitizer_classes;
}

// Allowed Tags
if ( ! function_exists('ampforwp_allowed_tags') ) {
	function ampforwp_allowed_tags() {
		$allowed_tags = '';
		$allowed_tags = wp_kses_allowed_html('post');
		$allowed_tags['a']['itemprop'] = true;
      	$allowed_tags['span']['itemprop'] = true;

      	return $allowed_tags;
	}
}

// List of Subpages/Childpages on Pages
add_action('ampforwp_after_post_content', 'ampforwp_list_subpages');
if ( ! function_exists('ampforwp_list_subpages') ) {
	function ampforwp_list_subpages() {
		global $post, $redux_builder_amp;
		if ( is_page() && true == $redux_builder_amp['ampforwp_subpages_list'] ) {
			$pages = '';
			$pages = wp_list_pages( array( 
							'echo' => 0,
							'child_of' => $post->ID,
							'title_li' => '', 
			) );
			$pages = preg_replace('/href="(.*?)"/', 'href="$1/amp/"', $pages);
			echo wp_kses($pages, ampforwp_allowed_tags());
		}
	}
}

// Disable wptextturize #1458
add_action('init','ampforwp_wptexturize_disabler');
if ( ! function_exists('ampforwp_wptexturize_disabler') ) {
	function ampforwp_wptexturize_disabler(){
		global $redux_builder_amp;
		if ( isset($redux_builder_amp['ampforwp-wptexturize']) && true == $redux_builder_amp['ampforwp-wptexturize'] ) {
			remove_filter('the_content', 'wptexturize');
			remove_filter('the_title', 'wptexturize');
		}
	}
}

// amp-vimeo proper video id for 3 parameter url
add_filter('amp_vimeo_parse_url','amp_vimeo_parse_url_video_id');
function amp_vimeo_parse_url_video_id($tok){

	  if(sizeof($tok)==3){
       return $tok[1];
      }else{
        return end($tok);
      }
}

// Cart Page URL
if( ! function_exists( 'ampforwp_wc_cart_page_url' ) ){
	function ampforwp_wc_cart_page_url(){
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	 	if( is_plugin_active( 'amp-woocommerce-pro/amp-woocommerce.php' ) ){
		    global $woocommerce;
		    $cart_url = $woocommerce->cart->get_cart_url();
		    $cart_url = ampforwp_url_controller($cart_url);
		    return $cart_url;;
	 	}
	 	else
	 		return '#'; 
	}
}

// Add Google Font support
add_action('amp_post_template_css', 'ampforwp_google_fonts_generator');
if ( ! function_exists( 'ampforwp_google_fonts_generator' ) ) {
  function ampforwp_google_fonts_generator() {
    global $redux_builder_amp;
    if( isset($redux_builder_amp['amp_google_font_restrict']) && $redux_builder_amp['amp_google_font_restrict'] ){
    	return;
    }
	if(isset($redux_builder_amp['google_current_font_data'])){
		$font_data = json_decode(stripslashes($redux_builder_amp['google_current_font_data']));
	}

    $font_weight = "";
    $font_output = "";
    $font_type = "";
    if(isset( $redux_builder_amp['amp_font_type'])){
    	$font_type = $redux_builder_amp['amp_font_type'];
    }

    if ( $font_type ) {
	    foreach ($font_type as $key => $value) {
			// Font Weight generator
			$font_weight = (int) $value;
			$font_weight =  ( $font_weight != 0 ? $font_weight : 400 );

			// Font Stlye Generator
			$font_style = preg_replace('/\d+/u', '', $value);
			$font_style = ( $font_style == 'italic' ? 'italic' : 'normal' );

			// Local Generator
			// Font Weight 
			$font_local_weight = '';

			if ( $font_weight === 100 ) {
				$font_local_weight = 'Thin';
			}

			if ( $font_weight === 200 ) {
				$font_local_weight = 'Ultra Light';
			}

			if ( $font_weight === 300 ) {
				$font_local_weight = 'Light';
			}

			if ( $font_weight === 400 ) {
				$font_local_weight = 'Regular';
			}

			if ( $font_weight === 500 ) {
				$font_local_weight = 'Medium';
			}

			if ( $font_weight === 600 ) {
				$font_local_weight = 'SemiBold';
			}

			if ( $font_weight === 700 ) {
				$font_local_weight = 'Bold';
			}

			if ( $font_weight === 800 ) {
				$font_local_weight = 'ExtraBold';
			}

			if ( $font_weight === 900 ) {
				$font_local_weight = 'Black';
			}

	      	// Font Style 
	     	$font_local_type = '';
	      	if ('italic' === $font_style) {
	        	$font_local_type = 'Italic';
	      	}

	        $font_output .= "@font-face {  ";
	        $font_output .= "font-family: " . $redux_builder_amp['amp_font_selector']. ';' ;
	        $font_output .= "font-style: " . $font_style . ';';
	        $font_output .= "font-weight: " . $font_weight . ';' ;
	        $font_output .= "src: local('". $redux_builder_amp['amp_font_selector']." ".$font_local_weight." ".$font_local_type."'), local('". $redux_builder_amp['amp_font_selector']."-".$font_local_weight.$font_local_type."'), url(" .str_replace("http://", "https://", $font_data->files->$value) . ');' ;
	        $font_output .= "}";
	    }
    }

    echo $font_output;
  }
}

function swifttheme_footer_widgets_init() {
 	if(ampforwp_design_selector()==4){
	    register_sidebar( array(
	        'name' => __( 'AMP Footer', 'accelerated-mobile-pages' ),
	        'id' => 'swift-footer-widget-area',
	        'description' => __( 'The Swift footer widget area', 'accelerated-mobile-pages' ),
	        'class'=>'w-bl',
	        'before_widget' => '<div class="w-bl">',
	        'after_widget' => '</div>',
	        'before_title' => '<h4>',
	        'after_title' => '</h4>',
	    ) );
	    register_sidebar( array(
	        'name' => __( 'AMP Sidebar', 'accelerated-mobile-pages' ),
	        'id' => 'swift-sidebar',
	        'description' => __( 'The Swift Sidebar', 'accelerated-mobile-pages' ),
	        'class'=>'amp-sidebar',
	        'before_widget' => '<div class="amp-sidebar">',
	        'after_widget' => '</div>',
	        'before_title' => '<h4>',
	        'after_title' => '</h4>',
	    ) );
	}
}
add_action( 'init', 'swifttheme_footer_widgets_init' );

// AMP Takeover
function ampforwp_is_non_amp( $type="" ) {
	global $redux_builder_amp;
	$non_amp = false;
	if ( false !== get_query_var( 'amp', false ) ) {
		return false;
	}
	if (""===$type  && isset( $redux_builder_amp['ampforwp-amp-takeover']) && true == $redux_builder_amp['ampforwp-amp-takeover'] ) {
		$non_amp = true;

		
		// Check for Posts
		if ( is_single() && false == $redux_builder_amp['amp-on-off-for-all-posts'] ) {
			return false;
		}
		// Archives
		if ( is_archive() && false == $redux_builder_amp['ampforwp-archive-support'] ) {
			return false;
		}
		// Pages
		if ( is_page() && false == $redux_builder_amp['amp-on-off-for-all-pages'] ) {
			return false;
		}
		// Homepage
		if ( is_home() && false == $redux_builder_amp['ampforwp-homepage-on-off-support'] ) {
			return false;
		}
		// Enabling AMP Takeover only when selected in Custom Post Type
		$supported_types_for_takeover = array();
	    $supported_types_for_takeover = ampforwp_get_all_post_types();
	    if( $supported_types_for_takeover ){
	            $current_type = get_post_type(get_the_ID());
	            if(!in_array($current_type, $supported_types_for_takeover) && !is_404()){ 
	              return ;
	            }
	    }
		if ( is_front_page() && false == $redux_builder_amp['ampforwp-homepage-on-off-support'] ) {
			return false;
		}
		if ( is_feed() ) {
			return false;
		}
		$amp_metas = json_decode(get_post_meta( get_the_ID(),'ampforwp-post-metas',true), true );
		$ampforwp_amp_post_on_off_meta = $amp_metas['ampforwp-amp-on-off'];
		if($ampforwp_amp_post_on_off_meta == 'hide-amp'){
			return false;	
		}
	}elseif(	(
				isset($redux_builder_amp['amp-design-selector']) 
				&& true == ($redux_builder_amp['amp-design-selector']==4)
				)
				&&
				(
				isset( $redux_builder_amp['ampforwp-amp-convert-to-wp']) 
				&& true == $redux_builder_amp['ampforwp-amp-convert-to-wp'] 
				) 
				|| 
				(
					'non_amp_check_convert' === $type
					&& isset( $redux_builder_amp['ampforwp-amp-convert-to-wp']) 
					&& true == $redux_builder_amp['ampforwp-amp-convert-to-wp']  
				) ) {
		$non_amp = true;

	}

	// Convert AMP to WP issues fixed #2493
	//Blogposts
	if ( is_home()  && $redux_builder_amp['ampforwp-homepage-on-off-support'] ==false ) {
      return;
    }
    // Pages
		if ( is_page() && false == $redux_builder_amp['amp-on-off-for-all-pages'] ) {
			return;
		}
	//check for theme
	/*if ( 'Twenty Fifteen' != wp_get_theme() ) {
		return false;
	}*/
    // Removing the AMP on login register etc of Theme My Login plugin	
	if (false === ampforwp_remove_login_tml() ){
     return false;
	}
	return $non_amp;
}

function ampforwp_remove_login_tml(){
if (function_exists('tml_register_default_actions')){
      $tml_pages = theme_my_login()->get_actions();
    if ( isset( $_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI']  ) {
      $current_page = $_SERVER['REQUEST_URI'];
    }
  
      $current_page = explode('/', $current_page);

      if ( isset($tml_pages) && $tml_pages ) {
        foreach ($tml_pages as $page) {
          if ( in_array($page->get_slug(), $current_page)) {
            return false;
          }
        }
      }
 	}
 }

// END Point
// Moved to functions.php

// Allow AMP Components in "The Content" #1588
// Check for amp-components in the_content
/*add_filter('the_content','ampforwp_amp_component_checker');
if ( ! function_exists('ampforwp_amp_component_checker') ) {
	function ampforwp_amp_component_checker( $content ) {
		if ( function_exists('ampforwp_is_amp_endpoint') && ampforwp_is_amp_endpoint() ) {
			global $post;
			$dom = '';
			$dom = AMP_DOM_Utils::get_dom_from_content($content);
			$components = ampforwp_get_amp_components();
			foreach ( $components as $component ) {		
				$nodes = $dom->getElementsByTagName( $component );
				$num_nodes = $nodes->length;
				if ( 0 !== $num_nodes ) {
					update_post_meta($post->ID,'ampforwp-wpautop', 'false');
					// Update the Post meta with amp-component
					update_post_meta($post->ID, $component , 'true');
				}
			}
			$content = AMP_DOM_Utils::get_content_from_dom($dom);
			return $content;
		}
		else
			return $content;
	}
}*/

// Remove wpautop from specific posts which contain amp-components
add_action('pre_amp_render_post','ampforwp_custom_wpautop');
function ampforwp_custom_wpautop(){
	if ( is_single() ) {
		if ( get_post_meta(get_the_ID(), 'ampforwp-wpautop', true) == 'false') {
			remove_filter('the_content', 'wpautop');
		}
	}
}
//remove_filter('the_content', 'wpautop');
//add_filter('the_content', 'ampforwp_custom_wpautop');
//if ( ! function_exists('ampforwp_custom_wpautop') ) {
//	function ampforwp_custom_wpautop( $content ) {
//		global $post;
//		if ( get_post_meta(get_the_ID(), 'ampforwp-wpautop', true) == 'false' && function_exists('ampforwp_is_amp_endpoint') && ampforwp_is_amp_endpoint() ) {
//	    	return $content;
//	  	}
//	 	else
//	    	return wpautop($content);
//	}
//}
// Get the AMP components


// Backward Compatibility for AMP Preview #1529
if ( ! function_exists('get_preview_post_link') ) { 
function get_preview_post_link( $post = null, $query_args = array(), $preview_link = '' ) {
	$post = get_post( $post );
	if ( ! $post ) {
		return;
	}

	$post_type_object = get_post_type_object( $post->post_type );
	if ( is_post_type_viewable( $post_type_object ) ) {
		if ( ! $preview_link ) {
			$preview_link = set_url_scheme( get_permalink( $post ) );
		}

		$query_args['preview'] = 'true';
		$preview_link = add_query_arg( $query_args, $preview_link );
	}
	return apply_filters( 'preview_post_link', $preview_link, $post );
}
}

// Homepage Loop Modifier #1701
add_filter('ampforwp_query_args','ampforwp_homepage_loop');
function ampforwp_homepage_loop( $args ) {
	global $redux_builder_amp;
	if ( is_home() ) {
		$post_type = 'post';
		// Check if Custom Post Type is selected
		if ( isset($redux_builder_amp['ampforwp-homepage-loop-type']) && '' != $redux_builder_amp['ampforwp-homepage-loop-type'] ) {
			$post_type = $redux_builder_amp['ampforwp-homepage-loop-type'];
		}
		$args['post_type'] = $post_type;
		// Exclude Categories if any selected
		if ( isset($redux_builder_amp['ampforwp-homepage-loop-cats']) && ! empty($redux_builder_amp['ampforwp-homepage-loop-cats']) ) {
			$args['category__not_in'] = $redux_builder_amp['ampforwp-homepage-loop-cats'];
		}
	}
	return $args; 
}
// To get correct comments count #1662
add_filter('get_comments_number', 'ampforwp_comment_count', 0);
function ampforwp_comment_count( $count ) {
	
	/* TODO: Allowed memory size exhausted #1865	 
		get_comments() was trying to access by Id and because the ID is not present on amp frontpages. It is getting exhausted. Need to recreate issue and validate the hypothesis
	*/

	if ( ! is_admin() && function_exists('ampforwp_is_amp_endpoint') && ampforwp_is_amp_endpoint() && is_single() ) {
		global $id;
		$get_comments = get_comments('status=approve&post_id=' . $id); 	 
 		$comments_by_type = separate_comments($get_comments); 
		return count($comments_by_type['comment']);
	} 
	else {
		return $count;
	}
}
// Glue underline css compatibility #1743 #1932
add_action('amp_post_template_css', 'ampforwp_glue_css_comp', PHP_INT_MAX );
if ( ! function_exists('ampforwp_glue_css_comp') ) {
	function ampforwp_glue_css_comp() {
		global $redux_builder_amp; 
		if (class_exists('YoastSEO_AMP_Frontend') ) { ?>
			a {text-decoration:none;}
			html {background:none;}
		<?php }
		 if ( isset($redux_builder_amp['ampforwp-underline-content-links']) && $redux_builder_amp['ampforwp-underline-content-links'] ) { ?>
			.the_content a {text-decoration:underline;}
		<?php }
	}
}

// Filter for Frontpage id
add_filter('ampforwp_modify_frontpage_id', 'ampforwp_modified_frontpage_id');
if( ! function_exists('ampforwp_modified_frontpage_id') ) {
	function ampforwp_modified_frontpage_id($page_id){
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		// WPML Compatibility #1111
	 	if( is_plugin_active( 'sitepress-multilingual-cms/sitepress.php' )){
		 	$page_id = get_option('page_on_front');	
	 	}
	 	// Polylang Compatibility #1779
	 	elseif( ampforwp_polylang_front_page() ){
	 		$frontpage_id = get_option('page_on_front');
	 		if($frontpage_id){
		 		$page_id = pll_get_post($frontpage_id);
		 	}	
	 	}
	 return $page_id;
	}
}

// AMP to WP Theme Ads
add_filter('ampforwp_modify_ads', 'ampforwp_nonamp_ads',10, 5);
if ( ! function_exists('ampforwp_nonamp_ads') ) {
	function ampforwp_nonamp_ads($output, $width, $height, $client_id, $data_slot) {
		if ( ampforwp_is_non_amp('non_amp_check_convert') ) {

			$output = '	<div class="add-wrapper" style="text-align:center;">
							<script async="" src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js">
							</script>
							<ins class="adsbygoogle" style="display:inline-block;width:'.$width.';height:'.$height.'" data-ad-client="'.$client_id.'" data-ad-slot="'.$data_slot.'">
							</ins>
							<script>
								(adsbygoogle = window.adsbygoogle || []).push({});
							</script>
						</div>';
		}
	return $output;
	}
}
//AMP to WP Theme Analytics
add_action('wp_footer','ampforwp_nonamp_analytics');
if ( ! function_exists('ampforwp_nonamp_analytics') ) {
	function ampforwp_nonamp_analytics() {
		global $redux_builder_amp;
		$ga_account = $redux_builder_amp['ga-feild'];
		if ( ampforwp_is_non_amp("non_amp_check_convert") ) {
			echo "	
		<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', '$ga_account', 'auto');
		ga('send', 'pageview');
		</script>";
		}
	}
}
// Coauthors Compatibility #1895
add_filter('coauthors_posts_link', 'ampforwp_coauthors_links');
function ampforwp_coauthors_links($args){
	global $redux_builder_amp;
	if ( function_exists('ampforwp_is_amp_endpoint' ) && ampforwp_is_amp_endpoint() && true == $redux_builder_amp['ampforwp-archive-support']) {
		$args['href'] = ampforwp_url_controller($args['href']);
	}
	return $args;
}

// amp-image-lightbox #1892
if ( ! function_exists('ampforwp_amp_img_lightbox') ) {
	function ampforwp_amp_img_lightbox(){ 
		echo '<amp-image-lightbox id="amp-img-lightbox" layout="nodisplay"></amp-image-lightbox>';
	}
}
// New Image attributes for amp-image-lightbox #1892
add_filter('amp_img_attributes', 'ampforwp_img_new_attrs');
function ampforwp_img_new_attrs($attributes) {
	global $redux_builder_amp;
	if ( isset($redux_builder_amp['ampforwp-amp-img-lightbox']) && $redux_builder_amp['ampforwp-amp-img-lightbox'] ) {		
		$attributes['on'] = 'tap:amp-img-lightbox';
		$attributes['role'] = 'button';
		$attributes['tabindex'] = '0';
	}
	return $attributes;
}
// Facebook Comments script for AMP2WP
add_action('ampforwp_body_beginning', 'ampforwp_amp2wp_fb');
if ( ! function_exists('ampforwp_amp2wp_fb') ) {
	function ampforwp_amp2wp_fb(){
		global $redux_builder_amp;
		if( ampforwp_is_non_amp() && isset($redux_builder_amp['ampforwp-amp-convert-to-wp']) && $redux_builder_amp['ampforwp-amp-convert-to-wp'] && ($redux_builder_amp['ampforwp-facebook-comments-support'] || $redux_builder_amp['ampforwp-facebook-like-button']) ) {
			echo '<div id="fb-root"></div>
					<script>(function(d, s, id) {
		  				var js, fjs = d.getElementsByTagName(s)[0];
		  				if (d.getElementById(id)) return;
		  				js = d.createElement(s); js.id = id;
		  				js.src = "https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.12";
		  				fjs.parentNode.insertBefore(js, fjs);
					}(document, "script", "facebook-jssdk"));</script>';
		}
	}
}

// Backward Compatibility
function ampforwp_correct_frontpage() {
	return ampforwp_get_frontpage_id();
}

//Common function to get frontpageID
function ampforwp_get_frontpage_id() {
	global $redux_builder_amp;
	$post_id = '';

	//$post_id = get_the_ID();
	if ( ampforwp_is_front_page() && $redux_builder_amp['amp-frontpage-select-option']==1 
		&& isset( $redux_builder_amp['amp-frontpage-select-option-pages'] ) 
		 ) { 
		$post_id = $redux_builder_amp['amp-frontpage-select-option-pages'];
	}
  
	$post_id = apply_filters('ampforwp_modify_frontpage_id', $post_id);
	return $post_id;
}

// Removing AMPHTML Added by Facebook's Instant Article's Plugin #2043
add_action( 'wp', 'ampforwp_remove_instant_articles_amp_markup' );
function ampforwp_remove_instant_articles_amp_markup(){
	
	if(class_exists('Instant_Articles_AMP_Markup')){
		remove_action( 'wp_head', array('Instant_Articles_AMP_Markup', 'inject_link_rel') );
	}
}
// #2042 
function ampforwp_404_canonical(){
	global $wp;
	return home_url( $wp->request );
}
// #2001 removing unused JS from the Paginated Posts
add_filter('ampforwp_post_content_filter', 'ampforwp_paginated_post_content');

function ampforwp_paginated_post_content($content){
	global $numpages;
	if(is_single()){
		if ( get_query_var( 'paged' ) ) {
			$paged = get_query_var('paged');
		} elseif ( get_query_var( 'page' ) ) {
		  	$paged = get_query_var('page');
		} else {
		  	$paged = 1;
		}
	    if( $numpages >= 2 ){
	      	return get_the_content();
	    }
	}

    return $content;
}

// GDPR Compliancy #2040
 // Moved to functions.php

// #1696
add_action('wp','ampforwp_remove_squirly_js');
function ampforwp_remove_squirly_js(){
  if(function_exists('ampforwp_is_amp_endpoint') && ampforwp_is_amp_endpoint()){
    if(class_exists('SQ_Classes_ObjController')){
	    $SQ_Classes_ObjController = new SQ_Classes_ObjController();
	    $sq_analytics_class_obj = $SQ_Classes_ObjController::getClass('SQ_Models_Services_Analytics');
	}

  }
}

// Thrive Leads Compatibility #2067
add_filter('thrive_leads_skip_request', 'ampforwp_skip_thrive_leads');
if ( ! function_exists('ampforwp_skip_thrive_leads') ) {
	function ampforwp_skip_thrive_leads($skip) {
		// Skip thrive leads on AMP
		if ( function_exists('ampforwp_is_amp_endpoint') && ampforwp_is_amp_endpoint() ) {
			return true;
		}

		return $skip;
	}
}

// Re-save permalink once the post value changed in Redading Settings #2190

add_action( 'update_option', 'ampforwp_resave_permalink', 10, 3 );
function ampforwp_resave_permalink( $option, $old_value, $value ){
 	if('posts_per_page' === $option){
 		if($old_value != $value){
 			delete_transient( 'ampforwp_current_version_check' );
 		}
 	}
}

// Canonical From Yoast #2118 and All in One SEO #1720
function ampforwp_generate_canonical(){
	global $redux_builder_amp;
	$canonical = '';
	$canonical = $WPSEO_Frontend = $All_in_One_SEO_Pack = $opts = '';
	if ( isset($redux_builder_amp['ampforwp-seo-yoast-canonical']) && true == $redux_builder_amp['ampforwp-seo-yoast-canonical'] && class_exists('WPSEO_Frontend') ) {
		$WPSEO_Frontend = WPSEO_Frontend::get_instance();
		$canonical = $WPSEO_Frontend->canonical(false);
	}
	elseif ( isset($redux_builder_amp['ampforwp-seo-aioseo-canonical']) && true == $redux_builder_amp['ampforwp-seo-aioseo-canonical'] && class_exists('All_in_One_SEO_Pack') ) {
		$All_in_One_SEO_Pack = new All_in_One_SEO_Pack();
		$opts = $All_in_One_SEO_Pack->get_current_options( array(), 'aiosp' );
		$canonical = $opts['aiosp_custom_link'];
	}
	return $canonical;
}
add_filter('amp_post_template_data', 'ampforwp_modified_canonical', 85);
function ampforwp_modified_canonical( $data ) {
	$canonical = '';
	$canonical = ampforwp_generate_canonical();
	if ( !empty($canonical) ) {
		$data['canonical_url'] = $canonical;
	}
	return $data;
}

function ampforwp_amp_consent_check($attrs){

	if( ampforwp_get_data_consent() ){
		$attrs['data-block-on-consent'] = '';
	}
	$attrs = apply_filters( 'ampforwp_embedd_attrs_handler', $attrs );
	return $attrs;
}
// #2220 Remove Space Shortcode by Pro Theme from THEMCO
add_action('pre_amp_render_post','ampforwp_remove_space_shortcodes');
function ampforwp_remove_space_shortcodes(){
	add_filter('the_content','ampforwp_remove_pro_theme_space_shortcodes');
}

function ampforwp_remove_pro_theme_space_shortcodes($content){
	if(has_shortcode( $content, 'gap' )){
		remove_shortcode( 'gap' );
		// to remove the useless shortcode from the AMP Content
		add_shortcode( 'gap', 'ampforwp_return_no_gap' );
	}
	return $content;
}

function ampforwp_return_no_gap(){
	return;
}

/*
	#2229 Function to check the option for comments to display on post, page or both.
 */
function ampforwp_get_comments_status(){
	global $redux_builder_amp;
	$display_comments_on = "";
	if ( (isset($redux_builder_amp['ampforwp-display-on-pages']) && $redux_builder_amp['ampforwp-display-on-pages']==false ) && (isset($redux_builder_amp['ampforwp-display-on-posts']) && $redux_builder_amp['ampforwp-display-on-posts']==true ) ) {
		$display_comments_on =  is_single();
	}
	if ( (isset($redux_builder_amp['ampforwp-display-on-pages']) && $redux_builder_amp['ampforwp-display-on-pages']==true ) && (isset($redux_builder_amp['ampforwp-display-on-posts']) && $redux_builder_amp['ampforwp-display-on-posts']==false ) ) {
		$display_comments_on =  is_page();
	}
	if ( (isset($redux_builder_amp['ampforwp-display-on-pages']) && $redux_builder_amp['ampforwp-display-on-pages']==true ) && (isset($redux_builder_amp['ampforwp-display-on-posts']) && $redux_builder_amp['ampforwp-display-on-posts']==true ) ) {
		$display_comments_on =  is_singular();
	}
	$display_comments_on = apply_filters('ampforwp_comments_visibility', $display_comments_on);
	return $display_comments_on;
}

// Vuukle Comments Support #2075

add_action('ampforwp_post_after_design_elements','ampforwp_vuukle_comments_support');
function ampforwp_vuukle_comments_support() {
	global $redux_builder_amp;
	if ( 4 != $redux_builder_amp['amp-design-selector']
		 && isset($redux_builder_amp['ampforwp-vuukle-comments-support'])
		 && $redux_builder_amp['ampforwp-vuukle-comments-support']==1
		 && comments_open() 
		) {
		echo ampforwp_vuukle_comments_markup();
	}
}
function ampforwp_vuukle_comments_markup() {
	global $redux_builder_amp;
	$apiKey = $locale = '';
	if( isset($redux_builder_amp['ampforwp-vuukle-comments-apiKey']) && $redux_builder_amp['ampforwp-vuukle-comments-apiKey'] !== ""){
		$apiKey = $redux_builder_amp['ampforwp-vuukle-comments-apiKey'];
	}
	$display_comments_on = false;
	$display_comments_on = ampforwp_get_comments_status();
	$siteUrl = trim(site_url(), '/');
	  
	  if (!preg_match('#^http(s)?://#', $siteUrl)) {
	      $siteUrl = 'http://' . $siteUrl;
	  }
	  $urlParts = parse_url($siteUrl);
	  $siteUrl = preg_replace('/^www\./', '', $urlParts['host']);// remove www

	$srcUrl = 'https://cdn.vuukle.com/amp.html?';
	$srcUrl = add_query_arg('url' ,get_permalink(), $srcUrl);
	$srcUrl = add_query_arg('host' ,$siteUrl, $srcUrl);
	$srcUrl = add_query_arg('id' , $post->ID, $srcUrl);
	$srcUrl = add_query_arg('apiKey' , $apiKey, $srcUrl); 
	$srcUrl = add_query_arg('title' , urlencode($post->post_title), $srcUrl); 

	$vuukle_html ='';
	if ( $display_comments_on ) {
		$vuukle_html .= '<amp-iframe width="600" height="350" layout="responsive" sandbox="allow-scripts allow-same-origin allow-modals allow-popups allow-forms" resizable frameborder="0" src="'.$srcUrl.'">

			<div overflow tabindex="0" role="button" aria-label="Show comments" class="afwp-vuukle-support">Show comments</div>';
	}
	return $vuukle_html;
}
add_filter( 'amp_post_template_data', 'ampforwp_add_vuukle_scripts' );
function ampforwp_add_vuukle_scripts( $data ) {
	global $redux_builder_amp;
	$display_comments_on = "";
	$display_comments_on = ampforwp_get_comments_status();
	if ( isset($redux_builder_amp['ampforwp-vuukle-comments-support'])
		 && $redux_builder_amp['ampforwp-vuukle-comments-support']
		 && $display_comments_on
		) {
			if ( empty( $data['amp_component_scripts']['amp-iframe'] ) ) {
				$data['amp_component_scripts']['amp-iframe'] = 'https://cdn.ampproject.org/v0/amp-iframe-0.1.js';
			}
			if ($redux_builder_amp['ampforwp-vuukle-Ads-before-comments']==1
			 && empty( $data['amp_component_scripts']['amp-ad'] ) ) {
				$data['amp_component_scripts']['amp-ad'] = 'https://cdn.ampproject.org/v0/amp-ad-0.1.js';
			}
	}
	return $data;
}
//spotim #2076
add_action('ampforwp_post_after_design_elements','ampforwp_spotim_comments_support');
function ampforwp_spotim_comments_support() {
	global $redux_builder_amp;
	if ( 4 != $redux_builder_amp['amp-design-selector']
		 && isset($redux_builder_amp['ampforwp-spotim-comments-support'])
		 && $redux_builder_amp['ampforwp-spotim-comments-support']==1
		) {
		echo ampforwp_spotim_comments_markup();
	echo "called";die;
	}
}
function ampforwp_spotim_comments_markup() {
	global $post, $redux_builder_amp; 
	$display_comments_on = false;
	$display_comments_on = ampforwp_get_comments_status();
	if (! $display_comments_on ) {
		return '';
	}
	$spotId ='';
	if( isset($redux_builder_amp['ampforwp-spotim-comments-apiKey']) && $redux_builder_amp['ampforwp-spotim-comments-apiKey'] !== ""){
		$spotId = $redux_builder_amp['ampforwp-spotim-comments-apiKey'];
	}
	$srcUrl = 'https://amp.spot.im/production.html?';
	$srcUrl = add_query_arg('spotId' ,get_permalink(), $srcUrl);
	$srcUrl = add_query_arg('postId' , $post->ID, $srcUrl);
	$spotim_html = '<amp-iframe width="375" height="815" resizable sandbox="allow-scripts allow-same-origin allow-popups allow-top-navigation" layout="responsive"
	  frameborder="0" src="'.$srcUrl.'">
	  <amp-img placeholder height="815" layout="fill" src="//amp.spot.im/loader.png"></amp-img>
	  <div overflow class="spot-im-amp-overflow" tabindex="0" role="button" aria-label="Read more">Load more...</div>
	</amp-iframe>';
	return $spotim_html;
}
//spotim script
add_filter( 'amp_post_template_data', 'ampforwp_add_spotim_scripts' );
function ampforwp_add_spotim_scripts( $data ) {
	global $redux_builder_amp;
	$display_comments_on = "";
	$display_comments_on = ampforwp_get_comments_status();
	if ( 4 != $redux_builder_amp['amp-design-selector']
		 && isset($redux_builder_amp['ampforwp-spotim-comments-support'])
		 && $redux_builder_amp['ampforwp-spotim-comments-support']
		 && $display_comments_on  && comments_open() 
		) {
			if ( empty( $data['amp_component_scripts']['amp-iframe'] ) ) {
				$data['amp_component_scripts']['amp-iframe'] = 'https://cdn.ampproject.org/v0/amp-iframe-0.1.js';
			}
	}
	return $data;
}
//spotim css
add_action('amp_post_template_css','ampforwp_spotim_vuukle_styling',60);
function ampforwp_spotim_vuukle_styling(){
	global $redux_builder_amp;
	$display_comments_on = "";
	$display_comments_on = ampforwp_get_comments_status();
	if ( isset($redux_builder_amp['ampforwp-spotim-comments-support'])
	 	&& $redux_builder_amp['ampforwp-spotim-comments-support']
	 	&& $display_comments_on  && comments_open() ) {
		?>.spot-im-amp-overflow {
	    background: white;
	    font-size: 15px;
	    padding: 15px 0;
	    text-align: center;
	    font-family: Helvetica, Arial, sans-serif;
	    color: #307fe2;
	  }<?php
	}
	if ( isset($redux_builder_amp['ampforwp-vuukle-comments-support'])
	 	&& $redux_builder_amp['ampforwp-vuukle-comments-support']
	 	&& $display_comments_on  && comments_open() ) { ?>
		.afwp-vuukle-support{
			display: block;text-align: center;background: #1f87e5;color: #fff;border-radius: 4px;
		} <?php 
	}
}
// #1575 Thrive Content Support
add_action('amp_init','ampforwp_thrive_architect_content');
function ampforwp_thrive_architect_content(){
	if(function_exists('tve_wp_action') && !function_exists('et_setup_theme')){
		add_filter( 'ampforwp_modify_the_content','ampforwp_thrive_content');
	}
}
function ampforwp_thrive_content($content){
	$post_id = "";
	if ( ampforwp_is_front_page() ){
		$post_id = ampforwp_get_frontpage_id();
		$content = get_post_field( 'post_content', $post_id ); 
	}

	$sanitizer_obj = new AMPFORWP_Content( $content,
									array(), 
									apply_filters( 'ampforwp_content_sanitizers', 
										array( 'AMP_Img_Sanitizer' => array(), 
											'AMP_Blacklist_Sanitizer' => array(),
											'AMP_Style_Sanitizer' => array(), 
											'AMP_Video_Sanitizer' => array(),
					 						'AMP_Audio_Sanitizer' => array(),
					 						'AMP_Iframe_Sanitizer' => array(
												 'add_placeholder' => true,
											 ),
										) 
									) 
								);
				$content =  $sanitizer_obj->get_amp_content();
	return $content;
}

// Yoast BreadCrumbs #1473
add_action('pre_amp_render_post', 'ampforwp_yoast_breadcrumbs');
if ( ! function_exists('ampforwp_yoast_breadcrumbs') ) {
	function ampforwp_yoast_breadcrumbs(){
		global $redux_builder_amp;
		if ( isset($redux_builder_amp['ampforwp-yoast-bread-crumb']) && $redux_builder_amp['ampforwp-yoast-bread-crumb'] ) {
			// Remove the separator of Yoast
			add_filter('wpseo_breadcrumb_separator','ampforwp_yoast_breadcrumbs_sep');
			function ampforwp_yoast_breadcrumbs_sep($sep) {
				$sep = '';
				return $sep;
			}
			// Remove xmlns:v to avoid validation error
			add_filter('wpseo_breadcrumb_output','ampforwp_yoast_breadcrumbs_modified_output');
			function ampforwp_yoast_breadcrumbs_modified_output($output){
				$output = str_replace('xmlns:v="http://rdf.data-vocabulary.org/#"', '', $output);
				return $output;
			}
			// Change the wrapper to div
			add_filter('wpseo_breadcrumb_output_wrapper', 'ampforwp_yoast_breadcrumbs_wrapper');
			function ampforwp_yoast_breadcrumbs_wrapper($wrap) {
				$wrap = 'div';
				return $wrap;
			}
			// Add the Breadcrumbs class to wrapper
			add_filter('wpseo_breadcrumb_output_class','ampforwp_yoast_breadcrumbs_wrapper_class');
			function ampforwp_yoast_breadcrumbs_wrapper_class($class) {
				$class = 'breadcrumbs';
				return $class;
			}
		}
	}
}
function ampforwp_yoast_breadcrumbs_output(){
	if ( class_exists('WPSEO_Options') ){
		$breadcrumb = '';
		if ( true == ampforwp_get_setting('ampforwp-yoast-bread-crumb') && true === WPSEO_Options::get( 'breadcrumbs-enable' ) && function_exists('yoast_breadcrumb')) {
			$breadcrumb = yoast_breadcrumb('','', false);
			return $breadcrumb;
		}
	}
}

// Content Sneak Peek #2246
add_action('pre_amp_render_post', 'ampforwp_content_sneak_peek');
if ( ! function_exists('ampforwp_content_sneak_peek') ) {
	function ampforwp_content_sneak_peek() {
		global $redux_builder_amp;
		if ( isset($redux_builder_amp['content-sneak-peek']) && $redux_builder_amp['content-sneak-peek'] && is_single() && 'post' == get_post_type() ) {		
			add_filter('ampforwp_modify_the_content', 'ampforwp_sneak_peek_content_modifier');
			add_action('amp_post_template_css','ampforwp_sneak_peek_css');
			add_filter('amp_post_template_data','ampforwp_sneak_peek_scripts');
		}

	}
}
// Content Sneak Peek content
function ampforwp_sneak_peek_content_modifier($content){
	global $redux_builder_amp;
	if ( strlen($content) >= 3000 ) {
		$content = '<div class="fd-h" [class]="contentVisible ? \'show\' : \'fd-h\'">' . $content . '</div>';
		$content = $content . '<div id="fader" class="content-fader" [class]="contentVisible ? \'content-fader hide\' : \'content-fader\'"></div>';
		$content = $content . '<div class="fd-b-c" [class]="contentVisible ? \'fd-b-c hide\' : \'fd-b-c\'"><button class="fd-b" [text]="contentVisible ? \'\' : \'Show Full Article\'" on="tap:AMP.setState({contentVisible: !contentVisible})">'.ampforwp_translation($redux_builder_amp['content-sneak-peek-btn-text'], 'Show Full Article').'</button></div>';
	}
	return $content;
}
// Content Sneak Peek Scripts css
function ampforwp_sneak_peek_css(){
	global $redux_builder_amp;
	$height = $txt_color = $btn_color = '';
	$height = $redux_builder_amp['content-sneak-peek-height'];
	$btn_color = $redux_builder_amp['content-sneak-peek-btn-color']['color'];
	$txt_color = $redux_builder_amp['content-sneak-peek-txt-color']['color'];?>
	.fd-h{height: <?php echo $height; ?>;overflow: hidden;position: relative;}
    .fd-b-c{text-align: center;margin: 0px 0px 30px 0px;}
    .fd-b-c .fd-b {border:none;border-radius: 5px;color: <?php echo $txt_color; ?>;font-size: 16px;font-weight: 700;padding: 12px 32px 12px 32px;background-color: <?php echo $btn_color; ?>;
    }
    .fd-h:after {
	    content: "";
	    display: inline-block;
	    position: absolute;
	    background: linear-gradient(to bottom,rgba(255,255,255,0) 0,rgba(255,255,255,1) 100%);
	    width:100%;
	    bottom: 0;
	    top:auto;
	    height:230px;
	}
<?php }
// Content Sneak Peek Scripts
function ampforwp_sneak_peek_scripts($data) {
	if ( empty( $data['amp_component_scripts']['amp-bind'] ) ) {
		$data['amp_component_scripts']['amp-bind'] = 'https://cdn.ampproject.org/v0/amp-bind-0.1.js';
	}
	return $data;
}

// Back to top 
add_action( 'ampforwp_body_beginning' ,'ampforwp_back_to_top_markup');
function ampforwp_back_to_top_markup(){
	global $redux_builder_amp;
	if( '1' == $redux_builder_amp['ampforwp-footer-top'] ) {
		echo '<div id="backtotop"></div>
		<div id="marker">
	      <amp-position-observer on="enter:hideAnim.start; exit:showAnim.start"
	        layout="nodisplay">
	      </amp-position-observer>
	    </div>';
	}
}

// AMPforWP allowed html tags
function ampforwp_wp_kses_allowed_html(){
	$allowed_html = '';
	$allowed_html = wp_kses_allowed_html( 'post' );
	if( $allowed_html ) {
		foreach ( $allowed_html as $tag => $atts ) {
	      	if ( is_array($atts) ){
	        	unset($allowed_html[$tag]['style']);
	      	}
	      	if ( 'form' == $tag ) {
	      		unset($allowed_html[$tag]);
	      	}
	    }
  	}
  	return $allowed_html; 
}

function ampforwp_check_excerpt(){
	global $redux_builder_amp;

	$value = '';
	$value =  ( isset( $redux_builder_amp['excerpt-option'] ) &&  $redux_builder_amp['excerpt-option'] ) ;
	if ( null === $value ) {
		$value = '1';
	}

	return $value;
}

function ampforwp_loop_full_content_featured_image(){
	global $redux_builder_amp;
				$post_id 		= get_the_ID();
				$featured_image = "";
				$amp_html 		= "";
				$caption 		= "";
				if( true == ampforwp_has_post_thumbnail() )	{
					if (has_post_thumbnail( $post_id ) ){
					 	$thumb_id = get_post_thumbnail_id($post_id);
						$image = wp_get_attachment_image_src( $thumb_id, 'full' ); 
						$caption = get_the_post_thumbnail_caption( $post_id ); 
						$thumb_alt = get_post_meta( $thumb_id, '_wp_attachment_image_alt', true);
						if($thumb_alt){
							$alt = $thumb_alt;
						}
						else{
							$alt = get_the_title( $post_id );
						}
						$alt = esc_attr($alt);
						if( $image ){			
							$amp_html = "<amp-img src='$image[0]' width='$image[1]' height='$image[2]' layout=responsive alt='$alt'></amp-img>";
						}
					}
					if ( ampforwp_is_custom_field_featured_image() ) {
						$amp_img_src 	= ampforwp_cf_featured_image_src();
						$amp_img_width 	= ampforwp_cf_featured_image_src('width');
						$amp_img_height = ampforwp_cf_featured_image_src('height');
						if( $amp_img_src ){			
							$amp_html = "<amp-img src='$amp_img_src' width=$amp_img_width height=$amp_img_height layout=responsive ></amp-img>";
						}
					}
					if( true == $redux_builder_amp['ampforwp-featured-image-from-content'] && ampforwp_get_featured_image_from_content() ){
						$amp_html = ampforwp_get_featured_image_from_content();
						$amp_html = preg_replace('#sizes="(.*)"#', "layout='responsive'", $amp_html);
					} 
					if( $amp_html ){ ?>
						<figure class="amp-featured-image"> <?php  
							echo $amp_html;
							 if ( $caption ) : ?>
								<p class="wp-caption-text">
									<?php echo wp_kses_data( $caption ); ?>
								</p>
							<?php endif; ?>
						</figure>
					<?php
					}
				}
}

// Allow AMP Tags in Tinymce Editor #2134
add_filter('tiny_mce_before_init', 'ampforwp_tinymce_allowed_tags');
function ampforwp_tinymce_allowed_tags( $allowed_tags ) {
	$amp_tags = 'amp-*[*]';
	if ( isset($allowed_tags['extended_valid_elements']) ) {
		$allowed_tags['extended_valid_elements'] .= ',' . $amp_tags;
	}
	else {
		$allowed_tags['extended_valid_elements'] = $amp_tags;
	}
	return $allowed_tags;
}

// Modify the Plugin Managers section #2339
function ampforwp_modify_plugin_manager_options($sections){
	foreach ($sections as $section_key => $section_value) {
		if ( 'Plugin Manager' == $section_value['title'] ) {
			$sections[$section_key]['id'] = 'plugin-manager-section';
			$sections[$section_key]['fields'][] = array(
				        'id'   => 'amp-plugin-manager-notice',
				        'type' => 'info',
				                'desc' => '<div style=" background: #FFF9C4;padding: 12px;line-height: 1.6;margin: -45px -14px -18px -17px;">This is an older version, please download the latest version from here:  <a href="https://ampforwp.com/plugins-manager" target="_blank">AMP Plugin Manager</a>.<br /> <div style="margin-top:4px;"></div></div>',               
				           );		
		}
	}
	return $sections;
}



// Fallbacks for Vendor AMP #2287
// Class AMP_Base_Sanitizer
if ( ! class_exists('AMP_Base_Sanitizer') && class_exists('AMPforWP\\AMPVendor\\AMP_Base_Sanitizer') ) {
	abstract class AMP_Base_Sanitizer extends AMPforWP\AMPVendor\AMP_Base_Sanitizer
	{

	}
}
// Class AMP_HTML_Utils
if ( ! class_exists('AMP_HTML_Utils') && class_exists('AMPforWP\\AMPVendor\\AMP_HTML_Utils') ) {
	class AMP_HTML_Utils extends AMPforWP\AMPVendor\AMP_HTML_Utils{}
}
// Function is_amp_endpoint
add_action('pre_amp_render_post', 'ampforwp_is_amp_endpoint_old');
if ( !function_exists('ampforwp_is_amp_endpoint_old') ) {
	function ampforwp_is_amp_endpoint_old(){
		if ( !is_plugin_active( 'amp/amp.php' ) && ! function_exists('is_amp_endpoint') ){
			function is_amp_endpoint(){
				return ampforwp_is_amp_endpoint();
			}
		}
		// Class AMP_Post_Template
		if ( ! class_exists('AMP_Post_Template') && class_exists('AMPforWP\\AMPVendor\\AMP_Post_Template') ) {
			class AMP_Post_Template extends AMPforWP\AMPVendor\AMP_Post_Template{}
		}
	}
}
// End Fallbacks for Vendor AMP

// 	Custom Post Type Vs Post name(slug) Conflict #2374
add_action('pre_amp_render_post','ampforwp_page_cpt_same_slug');

function ampforwp_page_cpt_same_slug(){
	global $post;
	if( !$post ){
		return;
	} 
	$post_id = $conflict_slug = $is_slug_conflict = '';
	$all_post_types = array();
	$post_id = get_the_ID();
	$all_post_types = get_post_types();
	$conflict_slug = $post->post_name;
	$is_slug_conflict = in_array($conflict_slug, $all_post_types);
	if($is_slug_conflict){
		add_filter('ampforwp_modify_endpoint', 'ampforwp_enable_endpoint_for_conflict_posts',10,4);
	return true;
	}
	return false;
}

function ampforwp_enable_endpoint_for_conflict_posts($new_url, $url, $setting, $endpoint){

	if('0' == $setting || empty($setting) ){
		$new_url = add_query_arg('amp','1',$url);
	}
	
	return $new_url;
}

// Function to check if the query and the post name are same #2361
function ampforwp_is_query_post_same($haystack = '' , $needle = ''){
  $result = '';
  if(!empty($haystack) && !empty($needle)){
    $result = strpos($haystack ,$needle);
  }
  if( ($result != false || is_int($result)) && !empty($result) ){
    return true;
  }
  return false;
}

// rel="next" & rel="prev" pagination meta tags #2343
add_action( 'amp_post_template_head', 'ampforwp_rel_next_prev' );	

function ampforwp_rel_next_prev(){
    global $paged;
    if ( get_previous_posts_link() ) { ?>
        <link rel="prev" href="<?php echo get_pagenum_link( $paged - 1 ); ?>" /><?php
    }
    if ( get_next_posts_link() ) { ?>
        <link rel="next" href="<?php echo get_pagenum_link( $paged + 1 ); ?>" /><?php
    }
}

// Font URL controller
if ( ! function_exists('ampforwp_font_url') ) {
	function ampforwp_font_url($font_url){
		return apply_filters('ampforwp_font_url', $font_url);
	}
}

// Removing Marfeel plugin which was blocking internal pages of AMP #2423
add_action('wp','ampforwp_remove_marfeel',9);
function ampforwp_remove_marfeel(){
remove_action('wp', 'render_marfeel_amp_content' );
}

// uploading the images with SVG format #2431
function ampforwp_upload_svg($file_types){
$new_filetypes = array();
$new_filetypes['svg'] = 'image/svg+xml';
$file_types = array_merge($file_types, $new_filetypes );
return $file_types;
}
add_action('upload_mimes', 'ampforwp_upload_svg');

// Facebook Live chat lightbox #2430
add_action('amp_init', 'ampforwp_fb_chat');
if ( ! function_exists('ampforwp_fb_chat') ) {
	function ampforwp_fb_chat() {
		if ( true == ampforwp_get_setting('enable-single-facebook-chat') ) {
			add_action('amp_post_template_footer','ampforwp_fb_chat_lightbox');
			add_filter('amp_post_template_data', 'ampforwp_fb_chat_scripts');
			add_action('amp_post_template_css', 'ampforwp_fb_chat_css');
		}
	}
}
if ( ! function_exists('ampforwp_fb_chat_lightbox') ) {
	function ampforwp_fb_chat_lightbox(){ 
		global $redux_builder_amp;
		$page_id = $redux_builder_amp['amp-facebook-chat-username']; ?>
		<div class="fb-chat">
			<a class="fb-chat-a" on="tap:amp-fb-chat" > 
			<?php if ( 4 != ampforwp_get_setting('amp-design-selector') ) {?>
				<amp-img class="fb-chat-icon" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTguMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDIyMy4wNDEgMjIzLjA0MSIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgMjIzLjA0MSAyMjMuMDQxOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjI1NnB4IiBoZWlnaHQ9IjI1NnB4Ij4KPGc+Cgk8cGF0aCBkPSJNMTExLjUyNCwwQzUwLjQ1NywwLDAuNzc0LDQ2Ljk1NCwwLjc3NCwxMDQuNjY5YzAsMzEuMDc3LDE0LjQ3Miw2MC4zNDYsMzkuNzA1LDgwLjNjMy4yNTEsMi41NzEsNy45NjcsMi4wMTksMTAuNTM1LTEuMjMgICBjMi41NjktMy4yNDksMi4wMTktNy45NjYtMS4yMy0xMC41MzVjLTIxLjYxMy0xNy4wOTItMzQuMDEtNDIuMDcyLTM0LjAxLTY4LjUzNEMxNS43NzQsNTUuMjI1LDU4LjcyNywxNSwxMTEuNTI0LDE1ICAgYzUyLjc5MywwLDk1Ljc0Myw0MC4yMjUsOTUuNzQzLDg5LjY2OWMwLDQ5LjQ0OC00Mi45NSw4OS42NzgtOTUuNzQzLDg5LjY3OGMtOS4yMDksMC0xOC4zMTktMS4yMjMtMjcuMDc2LTMuNjM1ICAgYy0xLjkxNS0wLjUyOC0zLjk2MS0wLjI3My01LjY4OCwwLjcwNWwtMzEuMDY0LDE3LjU5N2MtMy42MDQsMi4wNDItNC44NzEsNi42MTgtMi44MjksMTAuMjIzYzEuMzgsMi40MzcsMy45MTgsMy44MDUsNi41MzIsMy44MDUgICBjMS4yNTIsMCwyLjUyMi0wLjMxNCwzLjY4OS0wLjk3NmwyOC40Mi0xNi4wOTljOS4xMTIsMi4yNDQsMTguNTIxLDMuMzgsMjguMDE2LDMuMzhjNjEuMDY0LDAsMTEwLjc0My00Ni45NTgsMTEwLjc0My0xMDQuNjc4ICAgQzIyMi4yNjcsNDYuOTU0LDE3Mi41ODgsMCwxMTEuNTI0LDB6IiBmaWxsPSIjRkZGRkZGIi8+Cgk8cGF0aCBkPSJNMTE0LjY3LDcxLjg1Yy0yLjY1LTEuMjI5LTUuNzcyLTAuODA2LTguMDAyLDEuMDgzbC01Ny44OSw0OS4wNTZjLTMuMTYsMi42NzgtMy41NTEsNy40MS0wLjg3MywxMC41NyAgIGMyLjY3OCwzLjE2LDcuNDExLDMuNTUxLDEwLjU3LDAuODczbDQ1LjU0MS0zOC41OTF2MzUuODUyYzAsMi45MjEsMS42OTYsNS41NzcsNC4zNDcsNi44MDVjMS4wMDgsMC40NjcsMi4wODMsMC42OTUsMy4xNTIsMC42OTUgICBjMS43NDMsMCwzLjQ2OC0wLjYwNyw0Ljg1LTEuNzc4bDU3Ljg5NS00OS4wNTZjMy4xNi0yLjY3OCwzLjU1MS03LjQxLDAuODczLTEwLjU3MWMtMi42NzgtMy4xNi03LjQxLTMuNTUyLTEwLjU3LTAuODc0ICAgbC00NS41NDcsMzguNTkzVjc4LjY1NUMxMTkuMDE3LDc1LjczMywxMTcuMzIxLDczLjA3OCwxMTQuNjcsNzEuODV6IiBmaWxsPSIjRkZGRkZGIi8+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==" width="24" height="24"/>
		<?php } ?>
			</a>
		</div>
		<amp-lightbox id="amp-fb-chat" layout="nodisplay">
				<div class="amp-fb-chat-wrap">
 				<amp-facebook-page width="310" height="310"
			       	layout="fixed"
			       	data-href="https://www.facebook.com/<?=$page_id?>"
			       	data-adapt-container-width="true"
			       	data-show-facepile="true"
			       	data-hide-cover="false"
			       	data-small-header="true"
			       	data-tabs="messages"
			       	data-width="310"
			       	data-height="310">
			    </amp-facebook-page>
		     	<button class="amp-fb-chat-button" on="tap:amp-fb-chat.close">
			    	x
			    </button>
				</div>
		</amp-lightbox>
	<?php }	
}
function ampforwp_fb_chat_scripts( $data ) {
		if(empty($data['amp_component_scripts']['amp-facebook-page'])){
			$data['amp_component_scripts']['amp-facebook-page'] = 'https://cdn.ampproject.org/v0/amp-facebook-page-0.1.js';
		}
		if(empty($data['amp_component_scripts']['amp-lightbox'])){
			$data['amp_component_scripts']['amp-lightbox'] = 'https://cdn.ampproject.org/v0/amp-lightbox-0.1.js';
		}
	return $data;
}
if ( ! function_exists('ampforwp_fb_chat_css') ) {
	function ampforwp_fb_chat_css() { ?>
		#amp-fb-chat {
		   text-align:center;
		   background-color: rgba(0,0,0,.85);
		   color:#fff;		   
     	   z-index: 99999;
		}
		#amp-fb-chat [on="tap:amp-fb-chat.close"] {
		   text-align: center;
		   display: inline-block;
		   position: absolute;
		   width: 40px;
		   height: 40px;
		   top: 10px;
		   margin: 0 auto;
		   z-index: 999;
		   right: 10px;
		   background-color: #fff;
		   background-repeat: no-repeat;
		   background-size: 30px 30px;
		   background-position: center;
		   border: 0;
		   border-radius: 100%;
		}
		.amp-fb-chat-wrap {
		   display: table;
		   max-width: 320px;
		   width: 100%;
		   height:100%;
		   margin:0 auto;
		}
		.fb-chat{position:fixed;top:70%;right:0;}
		<?php if ( 4 == ampforwp_get_setting('amp-design-selector') ){ ?>
			.fb-chat-a:after{content: "\e948";font-family:icomoon;font-size:30px;}
			.fb-chat-a{color:#fff;background:#0084ff;padding:5px;border-radius:5px;display:inline-block;}
			.fb-chat-btn{border:none;background:none}
		<?php } else { ?>
			.fb-chat-a{background-color:#0084ff;border-radius: 60%;padding:10px 10px 6px 10px;line-height:1;display:inline-block;}
		<?php }	 
	}
}

/*Amp app banner support Start #1314 */
add_filter( 'amp_post_template_data','ampforwp_amp_app_banner_support' );
if(!function_exists('ampforwp_amp_app_banner_support')){
	function ampforwp_amp_app_banner_support( $data ){
	global $redux_builder_amp;
	
	if(ampforwp_get_setting('ampforwp-amp-app-banner') == 1){
		if ( empty( $data['amp_component_scripts']['amp-app-banner'] ) ) {
				$data['amp_component_scripts']['amp-app-banner'] = 'https://cdn.ampproject.org/v0/amp-app-banner-0.1.js';
			}
		}
	return $data;
	}

}

add_action( 'amp_post_template_head' , 'ampforwp_amp_app_banner_action' );
if( ! function_exists( 'ampforwp_amp_app_banner_action' ) ) {
	function ampforwp_amp_app_banner_action() {
		global $redux_builder_amp;
		if( 1 == ampforwp_get_setting('ampforwp-amp-app-banner') ){
			if( isset($redux_builder_amp['ampforwp-apple-app-id']) && $redux_builder_amp['ampforwp-apple-app-id']!='' ){
			?>
			<meta name="apple-itunes-app" content="app-id=<?php echo $redux_builder_amp['ampforwp-apple-app-id'];?>">
			<?php }	?>
				<link rel="manifest" href="<?php echo AMPFORWP_PLUGIN_DIR_URI.'app-banner-manifest.json';?>">
			<?php
		}
	}
}


add_action('amp_post_template_footer','ampforwp_amp_app_banner_markup');
function ampforwp_amp_app_banner_markup(){
	global $redux_builder_amp;
	$banner_image = '';
	if( 1 == ampforwp_get_setting('ampforwp-amp-app-banner') ) {
		if( !isset( $redux_builder_amp['ampforwp-app-banner-image'] ) && $redux_builder_amp['ampforwp-app-banner-image'] =='' ){
			$banner_image = $redux_builder_amp['opt-media']['url'];
		}else{
			$banner_image = $redux_builder_amp['ampforwp-app-banner-image']['url'];
		}
		?>
		<amp-app-banner layout="nodisplay" id="banner">
			<div id="banner-logo">
				<amp-img src="<?php echo $banner_image;?>" width="50" height="43" layout="fixed"></amp-img>
			</div>
		    <div id="banner-text"><?php echo $redux_builder_amp['ampforwp-app-banner-text'];?></div>
			<div id="banner-action">
				<button class="ampstart-btn mr1 caps" open-button><?php echo $redux_builder_amp['ampforwp-app-banner-button-text'];?></button>
			</div>
		</amp-app-banner>
		<?php
	}
}

//add_action('wp_ajax_ampforwp_amp_app_banner_manifest_json','ampforwp_amp_app_banner_manifest_json');
function ampforwp_amp_app_banner_manifest_json(){
	global $redux_builder_amp;
		require AMPFORWP_PLUGIN_DIR  .'includes/vendor/aq_resizer.php';
		$siteUrl = site_url();
		$ampUrl = ampforwp_url_controller($siteUrl);
		$site_title = get_bloginfo( 'name' );
		$site_description = get_bloginfo( 'description' );

		$jsonFilePath = fopen(AMPFORWP_PLUGIN_DIR."/app-banner-manifest.json", "w");
		if($jsonFilePath){
		$relatedApps = array();
		$relatedApplications = array();
		$relatedApplicationList = $redux_builder_amp['ampforwp-app-banner-related-applications'];

		$relatedArray = explode(",",$relatedApplicationList);
		foreach($relatedArray as $val){
			$relatedApps['platform'] = 'play';
			$relatedApps['id'] = $val;
			array_push($relatedApplications,$relatedApps);
		}
		
		$iconArry = array();
		$iconUrl = $redux_builder_amp['ampforwp-app-banner-icon']['url'];
		$iconsList = array("36"=>"0.75","48"=>"1","72"=>"1.5","96"=>"2","144"=>"3","192"=>"4","512"=>"");
		$icons = array();
		
		foreach( $iconsList as $iconKey => $iconVal){
			$thumbArry = ampforwp_aq_resize( $iconUrl, $iconKey , $iconKey , true, false );
			$iconArry['src'] = $thumbArry[0];
			$iconArry['sizes'] = $iconKey.'x'.$iconKey;
			$iconArry['type'] = "image/png";
			if( $iconVal!='' ){
				$iconArry['density'] = $iconVal;
			}else{
				unset($iconArry['density']);
			}
			array_push( $icons, $iconArry );
		}
		
		$returnArray = array(
					"name" => $site_title,
					"short_name" => $site_title,
					"description" => $site_description,
					"start_url" => $ampUrl,
					"display" => "standalone",
					"background_color" => "#607D8B",
					"theme_color" => "#607D8B",
					"prefer_related_applications" => true,
				  	'related_applications' => $relatedApplications,
				  	"icons" => $icons,

				);
		$jsonData = json_encode($returnArray);
		
		fwrite($jsonFilePath, $jsonData);
		fclose($jsonFilePath);
		// echo "App Manifest Created Successfully.";
		// wp_die();
	}else{
		// echo "Unable to Create File.";
		// wp_die();
	}
}
/*Amp app banner support End #1314 */

// #2497 Ivory Search Compatibility Added
add_filter('ampforwp_menu_content','ampforwp_modify_ivory_search');
if( ! function_exists(' ampforwp_modify_ivory_search ') ){
	function ampforwp_modify_ivory_search($menu){
		$dom 		= '';
		$nodes 		= '';
		$num_nodes 	= '';
		if( !empty( $menu ) ){
			// Create a new document
			$dom = new DOMDocument();
			if( function_exists( 'mb_convert_encoding' ) ){
				$menu = mb_convert_encoding($menu, 'HTML-ENTITIES', 'UTF-8');			
			}
			else{
				$menu =  preg_replace( '/&.*?;/', 'x', $menu ); // multi-byte characters converted to X
			}

			// To Suppress Warnings
			libxml_use_internal_errors(true);

			$dom->loadHTML($menu);

			libxml_use_internal_errors(false);

			// get all the forms
			$nodes 		= $dom->getElementsByTagName( 'form' );
			$num_nodes 	= $nodes->length;
			for ( $i = $num_nodes - 1; $i >= 0; $i-- ) {
				$node 	= $nodes->item( $i );
				// Set The Width and Height if there in none
				if ( '' === $node->getAttribute( 'target' ) ) {
					$node->setAttribute('target', '_top');
				}
				
			}
			$menu = $dom->saveHTML();
		}
		return $menu;
	}
}

// Ajax functions
add_action( 'wp_ajax_categories', 'ampforwp_ajax_cats' );
function ampforwp_ajax_cats(){
	$return = array();
 	$categories = get_categories(array('search'=> $_GET['q'],'number'=>500));
 	$categories_array = array();
   	if ( $categories ) :
        foreach ($categories as $cat ) {
                $return[] = array($cat->cat_ID,$cat->name);// array( Cat ID, Cat Name )
        }
    endif;
	wp_send_json( $return );
}
add_action( 'wp_ajax_tags', 'ampforwp_ajax_tags' );
function ampforwp_ajax_tags(){
	$return = array();
 	$tags = get_tags(array('search'=> $_GET['q'],'number'=>500));
   	if ( $tags ) :
        foreach ($tags as $tag ) {
                $return[] = array($tag->term_id,$tag->name);// array( Tag ID, tag Name )
        }
    endif;
	wp_send_json( $return );
}

// AddThis Support
add_filter('amp_post_template_data','ampforwp_register_addthis_script', 20);
function ampforwp_register_addthis_script( $data ){ 
	global $redux_builder_amp;
	if( ampforwp_get_setting('enable-add-this-option') ) {
		
		if ( empty( $data['amp_component_scripts']['amp-addthis'] ) ) {
			$data['amp_component_scripts']['amp-addthis'] = 'https://cdn.ampproject.org/v0/amp-addthis-0.1.js';
		}
	}
	return $data;
}

// PageBuilder Status fallback #2414
function checkAMPforPageBuilderStatus($postId){
	global $post, $redux_builder_amp;
	$postId = (is_object($post)? $post->ID: '');
  
  if( ampforwp_is_front_page() ){
		$postId = ampforwp_get_frontpage_id();
	}
	if ( empty(  $postId ) ) {
    return false;
  }
  $ampforwp_metas = json_decode(get_post_meta($postId,'ampforwp-post-metas',true),true);
  $ampforwp_pagebuilder_enable = $ampforwp_metas['ampforwp_page_builder_enable'];
  //$ampforwp_pagebuilder_enable = get_post_meta($postId,'ampforwp_page_builder_enable', true);
  
	if( $ampforwp_pagebuilder_enable=='yes'){
		return true;
	}else{
		return false;
	}
}

// Featured Video Plus: amp-iframe script #2394
add_filter('amp_post_template_data', 'ampforwp_featured_video_plus_data');
function ampforwp_featured_video_plus_data($data) {
	if( function_exists('get_the_post_video') ) {
		if ( empty( $data['amp_component_scripts']['amp-iframe'] ) ) {
			$data['amp_component_scripts']['amp-iframe'] = 'https://cdn.ampproject.org/v0/amp-iframe-0.1.js';
		}
	}
	return $data;
}
// Featured Video Plus: Hide the unnecessary icon #2394
add_action('amp_post_template_css', 'ampforwp_featured_video_plus_css');
function ampforwp_featured_video_plus_css(){ 
	if( function_exists('get_the_post_video') ) {?>
		.fvp-onload{display:none}
<?php }}

// Font Selector
if( ! function_exists('ampforwp_font_selector') ) {
	function ampforwp_font_selector( $container ) {
		global $redux_builder_amp;
		$fontFamily = '';
		if(empty($container)) {
			$container = 'body';
		}
		if ( 'content' == $container && ampforwp_get_setting('amp_font_selector_content_single') && 1 != ampforwp_get_setting('amp_font_selector_content_single') ) {
			$fontFamily = "font-family: '".$redux_builder_amp['amp_font_selector_content_single']."';"; 
		}

		if ( 'body' == $container && ampforwp_get_setting('amp_font_selector') && 1 != ampforwp_get_setting('amp_font_selector') ) {
			$fontFamily = "font-family: '".$redux_builder_amp['amp_font_selector']."'";
		}

		return $fontFamily;
	}
}
add_filter( 'amp_post_template_data', 'ampforwp_backtotop' );
function ampforwp_backtotop( $data ) {
	global $redux_builder_amp;
	if( '1' == $redux_builder_amp['ampforwp-footer-top'] ) { 
			if ( empty( $data['amp_component_scripts']['amp-position-observer'] ) ) {
				$data['amp_component_scripts']['amp-position-observer'] = 'https://cdn.ampproject.org/v0/amp-position-observer-0.1.js';
			}
			if ( empty( $data['amp_component_scripts']['amp-animation'] ) ) {
				$data['amp_component_scripts']['amp-animation'] = 'https://cdn.ampproject.org/v0/amp-animation-0.1.js';
			}
			
	}
	return $data;
}
// Revolution Slider compatibility #1464
add_action('pre_amp_render_post', 'ampforwp_initialise_rev_slider');
if ( ! function_exists('ampforwp_initialise_rev_slider') ) {
	function ampforwp_initialise_rev_slider(){
		if ( class_exists('RevSliderOutput') ){
			require AMPFORWP_PLUGIN_DIR .'/classes/class-ampforwp-rev-slider.php';
		}
	}
}
add_filter('amp_content_embed_handlers','ampforwp_rev_slider_embed');
function ampforwp_rev_slider_embed($data) {
	if ( class_exists('RevSliderOutput') ){
		$data['AMP_Rev_Slider_Embed_Handler'] = array();
	}
	return $data;
}
// Photo Gallery by 10Web Compatibility #1811
add_action('pre_amp_render_post', 'ampforwp_initialise_photo_gallery');
if ( ! function_exists('ampforwp_initialise_photo_gallery') ) {
	function ampforwp_initialise_photo_gallery(){
		if ( class_exists('BWG') ) {
			require AMPFORWP_PLUGIN_DIR .'/classes/class-ampforwp-photo-gallery-embed.php';
		}
	}
}
add_filter('amp_content_embed_handlers','ampforwp_photo_gallery_embed');
function ampforwp_photo_gallery_embed($data) {
	if ( class_exists('BWG') ) {
		$data['AMPforWP_Photo_Gallery_Embed_Handler'] = array();
	}
	return $data;
}

// Post Metas
add_action('save_post','ampforwp_post_metas', 10, 2);
if ( ! function_exists('ampforwp_post_metas') ) {
	function ampforwp_post_metas($post_id,$post){
		$post_metas = array();
		$post_metas = json_decode(get_post_meta($post_id,'ampforwp-post-metas',true),true);
		// If metas array is empty, then add the previous metas in it
		if( !isset($post_metas['ampforwp-amp-on-off'] ) || null == $post_metas['ampforwp-amp-on-off'] ) {
			$post_metas['ampforwp-amp-on-off'] = get_post_meta($post_id,'ampforwp-amp-on-off',true);
		}
		if( !isset($post_metas['ampforwp-redirection-on-off'] ) || null == $post_metas['ampforwp-redirection-on-off'] ) {
			$post_metas['ampforwp-redirection-on-off'] = get_post_meta($post_id,'ampforwp-redirection-on-off',true);
		}
		if( !isset($post_metas['ampforwp-ia-on-off'] ) || null == $post_metas['ampforwp-ia-on-off'] ) {
			$post_metas['ampforwp-ia-on-off'] = get_post_meta($post_id,'ampforwp-ia-on-off',true);
		}
		if( !isset($post_metas['use_ampforwp_page_builder'] ) || null == $post_metas['use_ampforwp_page_builder'] ) {
			$post_metas['use_ampforwp_page_builder'] = get_post_meta($post_id,'use_ampforwp_page_builder',true);
		}
		if( !isset($post_metas['ampforwp_page_builder_enable'] ) || null == $post_metas['ampforwp_page_builder_enable'] ) {
			$post_metas['ampforwp_page_builder_enable'] = get_post_meta($post_id,'ampforwp_page_builder_enable',true);
		}
		if( !isset($post_metas['ampforwp_custom_content_editor_checkbox'] ) || null == $post_metas['ampforwp_custom_content_editor_checkbox'] ) {
			$post_metas['ampforwp_custom_content_editor_checkbox'] = get_post_meta($post_id,'ampforwp_custom_content_editor_checkbox',true);
		}
		if( !isset($post_metas['ampforwp_custom_content_editor'] ) || null == $post_metas['ampforwp_custom_content_editor'] ) {
			$post_metas['ampforwp_custom_content_editor'] = get_post_meta($post_id,'ampforwp_custom_content_editor',true);
		}
		update_post_meta($post_id, 'ampforwp-post-metas', json_encode($post_metas));	
		// Delete the previous metas
		if( isset($post_metas['ampforwp-amp-on-off'] ) ) {
			delete_post_meta($post_id,'ampforwp-amp-on-off');
		}
		if( isset($post_metas['ampforwp-redirection-on-off'] ) ) {
			delete_post_meta($post_id,'ampforwp-redirection-on-off');
		}
		if( isset($post_metas['ampforwp-ia-on-off'] ) ) {
			delete_post_meta($post_id,'ampforwp-ia-on-off');
		}
		if( isset($post_metas['use_ampforwp_page_builder'] ) ) {
			delete_post_meta($post_id,'use_ampforwp_page_builder');
		}
		if( isset($post_metas['ampforwp_page_builder_enable'] ) ) {
			delete_post_meta($post_id,'ampforwp_page_builder_enable');
		}
		if( isset($post_metas['ampforwp_custom_content_editor_checkbox'] ) ) {
			delete_post_meta($post_id,'ampforwp_custom_content_editor_checkbox');
		}
		if( isset($post_metas['ampforwp_custom_content_editor'] ) ) {
			delete_post_meta($post_id,'ampforwp_custom_content_editor');
		}
	}
}

#1160 Embedly Sanitizer 
add_filter( 'amp_content_sanitizers', 'ampforwp_embedly_sanitizer', 10, 1 );
function ampforwp_embedly_sanitizer( $sanitizer_classes ) {
  require_once( AMPFORWP_PLUGIN_DIR. 'classes/class-ampforwp-embedly-sanitizer.php' );
  $sanitizer_classes[ 'AMPforWP_Embedly_Sanitizer' ] = array(); 
  return $sanitizer_classes;
}