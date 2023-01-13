<?php

// Exit if accessed directly.
if (!defined('ABSPATH')) {
	exit;
}

//////////////////////////////////////////////////////////////////
// Functions to render conditional styles
//////////////////////////////////////////////////////////////////
$gspb_css_save_method = get_option('gspb_css_save');
function gspb_get_breakpoints()
{
	// defaults breakpoints.
	$gsbp_breakpoints = array(
		'mobile' 	=> 576,
		'tablet' 	=> 768,
		'desktop' =>  992
	);

	$gs_settings = get_option('gspb_global_settings');

	if (!empty($gs_settings)) {
		$gsbp_custom_breakpoints = (!empty($gs_settings['breakpoints'])) ? $gs_settings['breakpoints'] : '';

		if (!empty($gsbp_custom_breakpoints['mobile'])) {
			$gsbp_breakpoints['mobile'] = trim($gsbp_custom_breakpoints['mobile']);
		}

		if (!empty($gsbp_custom_breakpoints['tablet'])) {
			$gsbp_breakpoints['tablet'] = trim($gsbp_custom_breakpoints['tablet']);
		}

		if (!empty($gsbp_custom_breakpoints['desktop'])) {
			$gsbp_breakpoints['desktop'] = trim($gsbp_custom_breakpoints['desktop']);
		}

	}

	return array(
		'mobile' 			=> intval($gsbp_breakpoints['mobile']),
		'mobile_down' 		=> intval($gsbp_breakpoints['mobile']) - 0.02,
		'tablet' 			=> intval($gsbp_breakpoints['tablet']),
		'tablet_down' 		=> intval($gsbp_breakpoints['tablet']) - 0.02,
		'desktop' 			=> intval($gsbp_breakpoints['desktop']),
		'desktop_down'		=> intval($gsbp_breakpoints['desktop']) - 0.02,
	);
}

function gspb_get_final_css($gspb_css_content)
{
	$get_breakpoints = gspb_get_breakpoints();

	if($get_breakpoints['mobile'] != 576){
		$gspb_css_content = str_replace('@media (max-width: 575.98px)', '@media (max-width: '.$get_breakpoints["mobile_down"] .'px)', $gspb_css_content);
		$gspb_css_content = str_replace('@media (min-width: 576px)', '@media (min-width: '.$get_breakpoints["mobile"] .'px)', $gspb_css_content);
		$gspb_css_content = str_replace('@media (max-width:575.98px)', '@media (max-width: '.$get_breakpoints["mobile_down"] .'px)', $gspb_css_content);
		$gspb_css_content = str_replace('@media (min-width:576px)', '@media (min-width: '.$get_breakpoints["mobile"] .'px)', $gspb_css_content);
	}

	if($get_breakpoints['tablet'] != 768){
		$gspb_css_content = str_replace('and (max-width: 767.98px)', 'and (max-width: '.$get_breakpoints["tablet_down"] .'px)', $gspb_css_content);
		$gspb_css_content = str_replace('@media (min-width: 768px)', '@media (min-width: '.$get_breakpoints["tablet"] .'px)', $gspb_css_content);
		$gspb_css_content = str_replace('and (max-width:767.98px)', 'and (max-width: '.$get_breakpoints["tablet_down"] .'px)', $gspb_css_content);
		$gspb_css_content = str_replace('@media (min-width:768px)', '@media (min-width: '.$get_breakpoints["tablet"] .'px)', $gspb_css_content);
		$gspb_css_content = str_replace('@media (max-width:767.98px)', '@media (max-width: '.$get_breakpoints["tablet_down"] .'px)', $gspb_css_content);
		$gspb_css_content = str_replace('@media (max-width: 767.98px)', '@media (max-width: '.$get_breakpoints["tablet_down"] .'px)', $gspb_css_content);
	}

	if($get_breakpoints['desktop'] != 992){
		$gspb_css_content = str_replace('and (max-width: 991.98px)', 'and (max-width: '.$get_breakpoints["desktop_down"] .'px)', $gspb_css_content);
		$gspb_css_content = str_replace('and (max-width:991.98px)', 'and (max-width: '.$get_breakpoints["desktop_down"] .'px)', $gspb_css_content);
		$gspb_css_content = str_replace('@media (min-width: 992px)', '@media (min-width: '.$get_breakpoints["desktop"] .'px)', $gspb_css_content);
		$gspb_css_content = str_replace('@media (min-width:992px)', '@media (min-width: '.$get_breakpoints["desktop"] .'px)', $gspb_css_content);
		$gspb_css_content = str_replace('@media (max-width:991.98px)', '@media (max-width: '.$get_breakpoints["desktop_down"] .'px)', $gspb_css_content);
		$gspb_css_content = str_replace('@media (max-width: 991.98px)', '@media (max-width: '.$get_breakpoints["desktop_down"] .'px)', $gspb_css_content);
	}

	return $gspb_css_content;
}

//////////////////////////////////////////////////////////////////
// CSS minify
//////////////////////////////////////////////////////////////////
function gspb_quick_minify_css( $css ) {
	$css = preg_replace( '/\s+/', ' ', $css );
	$css = preg_replace( '/\/\*[^\!](.*?)\*\//', '', $css );
	$css = preg_replace( '/(,|:|;|\{|}) /', '$1', $css );
	$css = preg_replace( '/ (,|;|\{|})/', '$1', $css );
	$css = preg_replace( '/(:| )0\.([0-9]+)(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}.${2}${3}', $css );
	//$css = preg_replace( '/(:| )(\.?)0(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}0', $css );
	return trim( $css );
}


//////////////////////////////////////////////////////////////////
// Functions to render conditional scripts
//////////////////////////////////////////////////////////////////

// Hook: Frontend assets.
add_action('init', 'gspb_greenShift_register_scripts_blocks');
add_filter('render_block', 'gspb_greenShift_block_script_assets', 10, 2);

function gspb_greenShift_register_scripts_blocks()
{

	//lazyload
	wp_register_script(
		'gs-lazyload',
		GREENSHIFT_DIR_URL . 'libs/lazysizes/index.js',
		array(),
		'5.3.2',
		true
	);

	// aos script
	wp_register_script(
		'greenShift-aos-lib',
		GREENSHIFT_DIR_URL . 'libs/aos/aoslight.js',
		array(),
		'3.2',
		true
	);

	wp_register_script(
		'greenShift-aos-lib-full',
		GREENSHIFT_DIR_URL . 'libs/aos/aos.js',
		array(),
		'3.1',
		true
	);

	wp_register_script(
		'greenShift-scrollable-init',
		GREENSHIFT_DIR_URL . 'libs/scrollable/init.js',
		array(),
		'1.4',
		true
	);

	// accordion
	wp_register_script(
		'gs-accordion',
		GREENSHIFT_DIR_URL . 'libs/accordion/index.js',
		array(),
		'1.0',
		true
	);

	// toc
	wp_register_script(
		'gs-toc',
		GREENSHIFT_DIR_URL . 'libs/toc/index.js',
		array(),
		'1.3',
		true
	);

	// swiper
	wp_register_script(
		'gsswiper',
		GREENSHIFT_DIR_URL . 'libs/swiper/swiper-bundle.min.js',
		array(),
		'8.1.1',
		true
	);
	wp_register_script(
		'gs-swiper-init',
		GREENSHIFT_DIR_URL . 'libs/swiper/init.js',
		array(),
		'8.1.4',
		true
	);
	wp_register_script(
		'gs-swiper-loader',
		GREENSHIFT_DIR_URL . 'libs/swiper/loader.js',
		array(),
		'7.3.4',
		true
	);
	wp_localize_script(
		'gs-swiper-loader',
		'gs_swiper_params',
		array(
			'pluginURL' => GREENSHIFT_DIR_URL
		)
	);
	wp_register_style('gsswiper', GREENSHIFT_DIR_URL . 'libs/swiper/swiper-bundle.min.css', array(), '8.0');

	// tabs
	wp_register_script(
		'gstabs',
		GREENSHIFT_DIR_URL . 'libs/tabs/tabs.js',
		array(),
		'1.2',
		true
	);

	// toggler
	wp_register_script(
		'gstoggler',
		GREENSHIFT_DIR_URL . 'libs/toggler/index.js',
		array(),
		'1.0',
		true
	);

	wp_register_script(
		'gssmoothscrollto',
		GREENSHIFT_DIR_URL . 'libs/scrollto/index.js',
		array(),
		'1.0',
		true
	);

	// video
	wp_register_script(
		'gsvideo',
		GREENSHIFT_DIR_URL . 'libs/video/index.js',
		array(),
		'1.6',
		true
	);

	wp_register_script(
		'gsvimeo',
		GREENSHIFT_DIR_URL . 'libs/video/vimeo.js',
		array(),
		'1.5',
		true
	);

	// lightbox
	wp_register_script(
		'gslightbox',
		GREENSHIFT_DIR_URL . 'libs/lightbox/simpleLightbox.min.js',
		array(),
		'1.1',
		true
	);
	wp_register_style('gslightbox', GREENSHIFT_DIR_URL . 'libs/lightbox/simpleLightbox.min.css', array(), '1.0');

	// counter
	wp_register_script(
		'gscounter',
		GREENSHIFT_DIR_URL . 'libs/counter/index.js',
		array(),
		'1.5',
		true
	);

	// countdown
	wp_register_script(
		'gscountdown',
		GREENSHIFT_DIR_URL . 'libs/countdown/index.js',
		array(),
		'1.1',
		true
	);

	// share
	wp_register_script(
		'gsshare',
		GREENSHIFT_DIR_URL . 'libs/social-share/index.js',
		array(),
		'1.0',
		true
	);

	// cook
	wp_register_script(
		'gspbcook',
		GREENSHIFT_DIR_URL . 'libs/cook/index.js',
		array(),
		'1.0',
		true
	);
	wp_register_script(
		'gspbcookbtn',
		GREENSHIFT_DIR_URL . 'libs/cook/btn.js',
		array('gspbcook'),
		'1.1',
		true
	);

	// sliding panel
	wp_register_script(
		'gsslidingpanel',
		GREENSHIFT_DIR_URL . 'libs/slidingpanel/index.js',
		array(),
		'2.0',
		true
	);

	// flipbox
	wp_register_script(
		'gsflipboxpanel',
		GREENSHIFT_DIR_URL . 'libs/flipbox/index.js',
		array(),
		'1.0',
		true
	);

	//animated text
	wp_register_script(
		'gstextanimate',
		GREENSHIFT_DIR_URL . 'libs/animatedtext/index.js',
		array(),
		'1.1',
		true
	);

	//Inview
	wp_register_script(
		'greenshift-inview',
		GREENSHIFT_DIR_URL . 'libs/inview/index.js',
		array(),
		'1.1',
		true
	);
	wp_register_script(
		'greenshift-inview-bg',
		GREENSHIFT_DIR_URL . 'libs/inview/bg.js',
		array(),
		'1.0',
		true
	);

	//register scripts
	wp_register_script(
		'gsslightboxfront',
		GREENSHIFT_DIR_URL . 'libs/imagelightbox/imagelightbox.js',
		array(),
		'1.1',
		true
	);
	wp_register_style(
		'gsslightboxfront',
		GREENSHIFT_DIR_URL . 'libs/imagelightbox/imagelightbox.css',
		array(),
		'1.0'
	);

	//Model viewer
	wp_register_script(
		'gsmodelviewer',
		GREENSHIFT_DIR_URL . 'libs/modelviewer/model-viewer.min.js',
		array(),
		'1.11.1',
		true
	);
	wp_register_script(
		'gsmodelfocus',
		GREENSHIFT_DIR_URL . 'libs/modelviewer/focus-visible.js',
		array(),
		'1.9.2',
		true
	);
	wp_register_script(
		'gsmodelinit',
		GREENSHIFT_DIR_URL . 'libs/modelviewer/index.js',
		array(),
		'1.11.1',
		true
	);
	wp_localize_script(
		'gsmodelinit',
		'gs_model_params',
		array(
			'pluginURL' => GREENSHIFT_DIR_URL
		)
	);

	wp_register_style(
		'gssmoothscrollto',
		GREENSHIFT_DIR_URL . 'libs/scrollto/index.css',
		array(),
		'1.0'
	);
	

	$upload_dir = wp_get_upload_dir();
	$globalstyle = trailingslashit($upload_dir['basedir']) . 'GreenShift/globalstyle.css';
	if(file_exists($globalstyle)){
		wp_register_style(
			'greenShift-global',
			trailingslashit($upload_dir['baseurl']) . 'GreenShift/globalstyle.css',
			'',
			time()
		);
	}else{
		wp_register_style(
			'greenShift-global',
			GREENSHIFT_DIR_URL . 'libs/global/style.css',
			'',
			'1.0'
		);
	}

	//Script for ajax reusable loading
	wp_register_script( 'gselajaxloader',  GREENSHIFT_DIR_URL.'libs/reusable/index.js', array(), '1.6', true );
	wp_register_style( 'gspreloadercss',  GREENSHIFT_DIR_URL.'libs/reusable/preloader.css', array(), '1.2' );
        

	//register blocks on server side with block.json
	register_block_type(__DIR__ . '/blockrender/accordion');
	register_block_type(__DIR__ . '/blockrender/accordionitem');
	register_block_type(__DIR__ . '/blockrender/column');
	register_block_type(__DIR__ . '/blockrender/container');
	register_block_type(__DIR__ . '/blockrender/counter');
	register_block_type(__DIR__ . '/blockrender/countdown');
	register_block_type(__DIR__ . '/blockrender/heading');
	register_block_type(__DIR__ . '/blockrender/icon-box');
	register_block_type(__DIR__ . '/blockrender/iconList');
	register_block_type(__DIR__ . '/blockrender/image');
	register_block_type(__DIR__ . '/blockrender/infobox');
	register_block_type(__DIR__ . '/blockrender/progressbar');
	register_block_type(__DIR__ . '/blockrender/row');
	register_block_type(__DIR__ . '/blockrender/svg-shape');
	register_block_type(__DIR__ . '/blockrender/swiper');
	register_block_type(__DIR__ . '/blockrender/swipe');
	register_block_type(__DIR__ . '/blockrender/tab');
	register_block_type(__DIR__ . '/blockrender/tabs');
	register_block_type(__DIR__ . '/blockrender/titlebox');
	register_block_type(__DIR__ . '/blockrender/toc');
	register_block_type(__DIR__ . '/blockrender/toggler');
	register_block_type(__DIR__ . '/blockrender/video');
	register_block_type(__DIR__ . '/blockrender/modelviewer');
	register_block_type(__DIR__ . '/blockrender/button');


	//Ajax register
	add_action( 'wp_ajax_gspb_check_youtube_url', 'gspb_check_youtube_url' );

	// admin settings scripts and styles
	wp_register_script( 'gsadminsettings',  GREENSHIFT_DIR_URL.'libs/admin/settings.js', array(), '1', true );
	wp_register_style( 'gsadminsettings',  GREENSHIFT_DIR_URL.'libs/admin/settings.css', array(), '1' );
	wp_localize_script(
	'gsadminsettings',
	'greenShift_params',
	array(
		'ajaxUrl' => admin_url('admin-ajax.php')
	)
	);
}

//////////////////////////////////////////////////////////////////
// Register server side
//////////////////////////////////////////////////////////////////
require_once GREENSHIFT_DIR_PATH .'blockrender/social-share/block.php';


if(!function_exists('gspb_check_youtube_url')){
	function gspb_check_youtube_url(){
		$url = esc_url($_POST['url']);
		$max = wp_safe_remote_head($url);
		wp_send_json_success( wp_remote_retrieve_response_code($max) );
	}
}

function gspb_greenShift_block_script_assets($html, $block)
{
	// phpcs:ignore

	//Main styles for blocks are loaded via Redux. Can be found in src/customJS/editor/store/index.js

	if(!is_admin()){

		$blockname = $block['blockName'];
	
		// looking lazy load
		if ($blockname === 'greenshift-blocks/image') {
	
			if (!empty($block['attrs']) && isset($block['attrs']['additional']) && $block['attrs']['additional'] == 'lazyload') {
				wp_enqueue_script('gs-lazyload');
			}
			if (!empty($block['attrs']['lightbox'])) {
				wp_enqueue_script('gsslightboxfront');
				wp_enqueue_style('gsslightboxfront');
			}
			if(function_exists('GSPB_make_dynamic_image') && !empty($block['attrs']['dynamicimage']['dynamicEnable'])){
				$html = GSPB_make_dynamic_image($html, $block['attrs'], $block, $block['attrs']['dynamicimage'], $block['attrs']['mediaurl']);
			}
		}
	
		// looking for accordion
		else if ($blockname === 'greenshift-blocks/accordion') {
			wp_enqueue_script('gs-accordion');
		}
	
		// looking for toc
		else if ($blockname === 'greenshift-blocks/toc') {
			wp_enqueue_script('gs-toc');
		}

		// looking for toggler
		else if ($blockname === 'greenshift-blocks/toggler') {
			wp_enqueue_script('gstoggler');
		}

		// looking for counter
		else if ($blockname === 'greenshift-blocks/counter') {
			wp_enqueue_script('gscounter');
		}

		// looking for sliding panel
		else if ($blockname === 'greenshift-blocks/button') {
			if(!empty( $block['attrs']['overlay']['inview'])){
				wp_enqueue_script( 'greenshift-inview' );
			}
			if (!empty( $block['attrs']['cookname'])) {
				wp_enqueue_script('gspbcookbtn');
			}
			if (!empty( $block['attrs']['scrollsmooth'])) {
				wp_enqueue_script('gssmoothscrollto');
			}
			if (!empty( $block['attrs']['slidingPanel'])) {
				wp_enqueue_script('gsslidingpanel');
				$position = !empty($block['attrs']['slidePosition']) ? $block['attrs']['slidePosition'] : '';
				$html = str_replace('id="gspb_button-id-'.$block['attrs']['id'], 'data-paneltype="'.$position.'" id="gspb_button-id-'.$block['attrs']['id'], $html);
				$html = str_replace('class="gspb_slidingPanel"', 'data-panelid="gspb_button-id-'.$block['attrs']['id'].'" class="gspb_slidingPanel"', $html);
			}
			if(!empty($block['attrs']['buttonLink'])){
				$link = $block['attrs']['buttonLink'];
				if(strpos($link, "#") !== false){
					wp_enqueue_style('gssmoothscrollto');
				}
				$linknew = apply_filters('greenshiftseo_url_filter', $link);
				$linknew = apply_filters('rh_post_offer_url_filter', $linknew);
				$html = str_replace($link, $linknew, $html);
			}
			if(function_exists('GSPB_make_dynamic_link') && !empty($block['attrs']['dynamicEnable'])){
				$attribute = !empty($block['attrs']['dynamicField']) ? $block['attrs']['dynamicField'] : '';
				$html = GSPB_make_dynamic_link($html, $block['attrs'], $block, $attribute, $block['attrs']['buttonLink']);
			}
		}

		// looking for container
		else if ($blockname === 'greenshift-blocks/container') {
			if(!empty( $block['attrs']['overlay']['inview'])){
				wp_enqueue_script( 'greenshift-inview' );
			}
			if(!empty( $block['attrs']['background']['lazy'])){
				wp_enqueue_script( 'greenshift-inview-bg' );
			}
			if(!empty( $block['attrs']['flipbox'])){
				wp_enqueue_script('gsflipboxpanel');
			}
			if(!empty($block['attrs']['containerLink'])){
				$link = $block['attrs']['containerLink'];
				$linknew = apply_filters('greenshiftseo_url_filter', $link);
				$linknew = apply_filters('rh_post_offer_url_filter', $linknew);
				$html = str_replace($link, $linknew, $html);
			}
			if(!empty( $block['attrs']['mobileSmartScroll']) && !empty( $block['attrs']['carouselScroll'])){
				wp_enqueue_script('greenShift-scrollable-init');
			}
			if ( !empty($block['attrs']['shapeDivider']['topShape']['animate']) || !empty($block['attrs']['shapeDivider']['bottomShape']['animate'])) {
				wp_enqueue_script('greenShift-aos-lib-full');
				// init aos library
			}
			if(function_exists('GSPB_make_dynamic_link') && !empty($block['attrs']['dynamicEnable'])){
				$field = !empty($block['attrs']['dynamicField']) ? $block['attrs']['dynamicField'] : '';
				$html = GSPB_make_dynamic_link($html, $block['attrs'], $block, $field, $block['attrs']['containerLink']);
			}
		}

		// looking for row
		else if ($blockname === 'greenshift-blocks/row') {
			if(!empty( $block['attrs']['overlay']['inview'])){
				wp_enqueue_script( 'greenshift-inview' );
			}
			if(!empty( $block['attrs']['background']['lazy'])){
				wp_enqueue_script( 'greenshift-inview-bg' );
			}
			if(!empty( $block['attrs']['mobileSmartScroll']) && !empty( $block['attrs']['carouselScroll'])){
				wp_enqueue_script('greenShift-scrollable-init');
			}
			if ( !empty($block['attrs']['shapeDivider']['topShape']['animate']) || !empty($block['attrs']['shapeDivider']['bottomShape']['animate'])) {
				wp_enqueue_script('greenShift-aos-lib-full');
				// init aos library
			}
		}

		else if ($blockname === 'greenshift-blocks/row-column') {
			if(!empty( $block['attrs']['overlay']['inview'])){
				wp_enqueue_script( 'greenshift-inview' );
			}
			if(!empty( $block['attrs']['background']['lazy'])){
				wp_enqueue_script( 'greenshift-inview-bg' );
			}
		}

		// looking for countdown
		else if ($blockname === 'greenshift-blocks/countdown') {
			wp_enqueue_script('gscountdown');
		}

		// looking for social share
		else if ($blockname === 'greenshift-blocks/social-share') {
			wp_enqueue_script('gsshare');
		}
	
		// looking for swiper
		else if ($blockname === 'greenshift-blocks/swiper') {
			if(!empty( $block['attrs']['smartloader'])){
				wp_enqueue_script('gs-swiper-loader');
			}else{
				wp_enqueue_script('gsswiper');
				wp_enqueue_script('gs-swiper-init');
			}
		}

		// looking for tabs
		else if ($blockname === 'greenshift-blocks/tabs') {
			if(!empty( $block['attrs']['swiper'])){
				wp_enqueue_style('gsswiper');
				wp_enqueue_script('gsswiper');
			}
			wp_enqueue_script('gstabs');
		}

		// looking for animated text
		else if ($blockname === 'greenshift-blocks/heading') {
			if(!empty( $block['attrs']['enableanimate'])){
				wp_enqueue_script('gstextanimate');
			}
			if(!empty( $block['attrs']['background']['lazy'])){
				wp_enqueue_script( 'greenshift-inview-bg' );
			}
			if(!empty( $block['attrs']['className'])){
				$html = str_replace('class="gspb_heading', 'class="'.$block['attrs']['className'].' gspb_heading', $html);
			}
			if(function_exists('GSPB_make_dynamic_text') && !empty($block['attrs']['dynamictext']['dynamicEnable'])){
				if(!empty($block['attrs']['enableanimate'])){
					$html = GSPB_make_dynamic_text($html, $block['attrs'], $block, $block['attrs']['dynamictext'], $block['attrs']['textbefore']);
				}else{
					$html = GSPB_make_dynamic_text($html, $block['attrs'], $block, $block['attrs']['dynamictext'], $block['attrs']['headingContent']);
				}
			}
		}

		else if ($blockname === 'greenshift-blocks/text') {
			if(!empty( $block['attrs']['background']['lazy'])){
				wp_enqueue_script( 'greenshift-inview-bg' );
			}
			if(function_exists('GSPB_make_dynamic_text') && !empty($block['attrs']['dynamictext']['dynamicEnable'])){
				$html = GSPB_make_dynamic_text($html, $block['attrs'], $block, $block['attrs']['dynamictext'], $block['attrs']['textContent']);
			}
		}

		// looking for 3d modelviewer
		else if ($blockname === 'greenshift-blocks/modelviewer') {
			if(empty($block['attrs']['td_load_iter'])){
				wp_enqueue_script('gsmodelviewer');
				$html = str_replace('ar="true"', 'ar ar-modes="webxr scene-viewer quick-look"', $html);
			}
			wp_enqueue_script('gsmodelinit');
		}

		//looking for video
		else if( $blockname === 'greenshift-blocks/video' ){
			if( !empty($block['attrs']['provider']) && $block['attrs']['provider'] === "vimeo" ){
				wp_enqueue_script('gsvimeo');
			}
			wp_enqueue_script('gsvideo');
			if( isset($block['attrs']['overlayLightbox']) && $block['attrs']['overlayLightbox'] ){
				wp_enqueue_style( 'gslightbox');
				wp_enqueue_script( 'gslightbox' );
			}
			if(function_exists('GSPB_make_dynamic_video') && !empty($block['attrs']['dynamicEnable'])){
				$html = GSPB_make_dynamic_video($html, $block['attrs'], $block, $block['attrs']['dynamicField'], $block['attrs']['src']);
			}
		}
		// looking for toggler
		else if ($blockname === 'greenshift-blocks/svgshape' && !empty( $block['attrs']['customshape'])) {
			$html = str_replace('strokewidth', 'stroke-width', $html);
			$html = str_replace('strokedasharray', 'stroke-dasharray', $html);
			$html = str_replace('stopcolor', 'stop-color', $html);
		}

		// aos script
		if (!empty($block['attrs']['animation']['type']) && empty($block['attrs']['animation']['usegsap'])) {
			$animationtype = $block['attrs']['animation']['type'];
			if($animationtype == 'slide-up' || $animationtype == 'slide-down' || $animationtype == 'slide-right' || $animationtype == 'slide-left'){
				wp_enqueue_script('greenShift-aos-lib-full');
			}else{
				wp_enqueue_script('greenShift-aos-lib');
			}
		}

		if(!empty($block['attrs']['dynamicGClass'])){
			$gs_settings = get_option('gspb_global_settings');
			$class = $block['attrs']['dynamicGClass'];
			if(!empty($gs_settings['reusablestyles'][$class]['style'])){
				$reusable_style = '<style scoped>' . wp_kses_post($gs_settings['reusablestyles'][$class]['style']) . '</style>';
				$reusable_style = gspb_get_final_css($reusable_style);
				$reusable_style = gspb_quick_minify_css($reusable_style);
				$reusable_style = htmlspecialchars_decode($reusable_style);
				$html = $html.$reusable_style;
			}
		}

		if(!empty( $block['attrs']['inlineCssStyles'])){
			$dynamic_style = '<style scoped>' . wp_kses_post($block['attrs']['inlineCssStyles']) . '</style>';
			$dynamic_style = gspb_get_final_css($dynamic_style);
			$dynamic_style = gspb_quick_minify_css($dynamic_style);
			$dynamic_style = htmlspecialchars_decode($dynamic_style);
			if(function_exists('GSPB_make_dynamic_image') && !empty($block['attrs']['background']['dynamicEnable'])){
				$dynamic_style = GSPB_make_dynamic_image($dynamic_style, $block['attrs'], $block, $block['attrs']['background'], $block['attrs']['background']['image']);
			}
			$html = $html.$dynamic_style;
		}
	}


	return $html;
}

//////////////////////////////////////////////////////////////////
// Enqueue Gutenberg block assets for backend editor.
//////////////////////////////////////////////////////////////////

// Hook: Editor assets.
add_action('enqueue_block_editor_assets', 'gspb_greenShift_editor_assets');

function gspb_greenShift_editor_assets()
{
	// phpcs:ignor

	$index_asset_file = include(GREENSHIFT_DIR_PATH . 'build/index.asset.php');
	$library_asset_file = include(GREENSHIFT_DIR_PATH . 'build/gspbLibrary.asset.php');

	// gspb library script
	wp_register_script(
		'greenShift-library-script',
		GREENSHIFT_DIR_URL . 'build/gspbLibrary.js',
		array('wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor', 'wp-data', 'wp-plugins', 'wp-edit-post', 'wp-edit-site'),
		$library_asset_file['version'],
		false
	);
	wp_set_script_translations( 'greenShift-library-script', 'greenshift-animation-and-page-builder-blocks' );

	// Custom Editor JavaScript
	wp_register_script(
		'greenShift-editor-js',
		GREENSHIFT_DIR_URL . 'build/gspbCustomEditor.js',
		array('greenShift-library-script', 'jquery', 'wp-data'),
		$index_asset_file['version'],
		true
	);
	wp_set_script_translations( 'greenShift-editor-js', 'greenshift-animation-and-page-builder-blocks' );

	$gspb_css_save = get_option('gspb_css_save');
	$sitesettings = get_option('gspb_global_settings');
	$row = (!empty($sitesettings['breakpoints']['row'])) ? (int)$sitesettings['breakpoints']['row'] : 1200;
	$localfont = (!empty($sitesettings['localfont'])) ? $sitesettings['localfont'] : array();
	$addonlink = admin_url('admin.php?page=greenshift_upgrade');
	$updatelink = $addonlink;
	$theme = wp_get_theme();
	if($theme->parent_theme) {
		$template_dir =  basename(get_template_directory());
		$theme = wp_get_theme($template_dir);
	}
	$themename = $theme->get( 'TextDomain' );
	//$updatelink = str_replace('greenshift_dashboard-addons', 'greenshift_dashboard-pricing', $addonlink);
	wp_localize_script(
		'greenShift-library-script',
		'greenShift_params',
		array(
			'ajaxUrl' => admin_url('admin-ajax.php'),
			'pluginURL' => GREENSHIFT_DIR_URL,
			'rowDefault' => apply_filters('gspb_default_row_width_px', $row),
			'theme' => $themename,
			'isRehub' => ($themename == 'rehub-theme'),
			'isSaveInline' => (!empty($gspb_css_save) && $gspb_css_save == 'inlineblock') ? '1' : '',
			'addonLink' => $addonlink,
			'updateLink' => $updatelink,
			'localfont' => apply_filters('gspb_local_font_array', $localfont)
		)
	);

	// Blocks Assets Scripts
	wp_register_script(
		'greenShift-block-js', // Handle.
		GREENSHIFT_DIR_URL . 'build/index.js',
		array('greenShift-editor-js', 'greenShift-library-script', 'wp-block-editor', 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor', 'wp-data'),
		$index_asset_file['version'],
		true
	);
	wp_set_script_translations( 'greenShift-block-js', 'greenshift-animation-and-page-builder-blocks' );
	wp_enqueue_script('greenShift-block-js');
	

	// Styles.

	// gspb library css
	wp_register_style(
		'greenShift-library-editor',
		GREENSHIFT_DIR_URL . 'build/gspbLibrary.css',
		'',
		$library_asset_file['version']
	);

	wp_enqueue_style('greenShift-global');

	wp_enqueue_style(
		'greenShift-block-css', // Handle.
		GREENSHIFT_DIR_URL . 'build/index.css', // Block editor CSS.
		array('greenShift-library-editor', 'wp-edit-blocks'),
		$index_asset_file['version']
	);

	// Animation Library

	//animated text
	wp_enqueue_script('gstextanimate');
}


//////////////////////////////////////////////////////////////////
// Helper Functions to save conditional assets to meta
//////////////////////////////////////////////////////////////////

// Meta Data For CSS Post.

function gspb_register_post_meta()
{
	register_meta(
		'post',
		'_gspb_post_css',
		array(
			'show_in_rest' => true,
			'single'       => true,
			'type'         => 'string',
			'auth_callback' => function() {
				return current_user_can('edit_posts');
			}
		)
	);
}
add_action('init', 'gspb_register_post_meta', 10);

if (!empty($gspb_css_save_method) && $gspb_css_save_method == 'file') {
	add_action('wp_head', 'gspb_enqueue_page_style');
}
else if (!empty($gspb_css_save_method) && $gspb_css_save_method == 'inlineblock') {
}
else {
	add_action('wp_enqueue_scripts', 'gspb_save_inline_css');
}

function gspb_enqueue_page_style()
{
	$gspb_post_id          = get_queried_object_id();
	$gspb_css_content = get_post_meta($gspb_post_id, '_gspb_post_css', true);

	$gspb_saved_css_content = gspb_get_final_css($gspb_css_content);

	$final_css = $gspb_saved_css_content;

	$upload_dir = wp_upload_dir();

	require_once ABSPATH . 'wp-admin/includes/file.php';
	global $wp_filesystem;
	$dir = trailingslashit($upload_dir['basedir']) . 'GreenShift/'; // Set storage directory path

	WP_Filesystem(); // WP file system

	if (!$wp_filesystem->is_dir($dir)) {
		$wp_filesystem->mkdir($dir);
	}

	$gspb_css_filename = 'style-' . $gspb_post_id . '.css';

	if (!$wp_filesystem->put_contents($dir . $gspb_css_filename, $final_css)) {
		throw new Exception(__('CSS not saved due the permission!!!', 'greenshift-animation-and-page-builder-blocks'));
	}

	wp_register_style('gspb_single_style', $upload_dir['baseurl'] . '/GreenShift/style-' . $gspb_post_id . '.css?v=' . time(), array(), '1.0.0', 'all');
	wp_enqueue_style('gspb_single_style');
}

function gspb_save_inline_css()
{
	// Get the css registred for the post
	$post_id          = get_queried_object_id();
	$gspb_css_content = get_post_meta($post_id, '_gspb_post_css', true);

	if($gspb_css_content){
		$gspb_saved_css_content = gspb_get_final_css($gspb_css_content);
		$final_css = $gspb_saved_css_content;
	
		wp_register_style('greenshift-post-css', false);
		wp_enqueue_style('greenshift-post-css');
		wp_add_inline_style('greenshift-post-css', $final_css);
	}
}

//////////////////////////////////////////////////////////////////
// Global presets init
//////////////////////////////////////////////////////////////////
add_action('enqueue_block_assets', 'gspb_global_variables');
function gspb_global_variables() {

	if(!is_admin()){
		//root styles
		$options = get_option( 'gspb_global_settings');
		$gs_global_css='';
		if(!empty($options['globalcss'])){
			$gs_global_css = $options['globalcss'];
			$gs_global_css = str_replace('!important', '', $gs_global_css);
		}
		if(!empty($options['localfontcss'])){
			$gs_global_css = $gs_global_css.$options['localfontcss'];
		}
		
		if($gs_global_css){
			$gs_global_css = gspb_get_final_css($gs_global_css);
			wp_register_style('greenshift-global-css', false);
			wp_enqueue_style('greenshift-global-css');
			wp_add_inline_style('greenshift-global-css',$gs_global_css);

		}
		//root styles
		//wp_enqueue_style('greenShift-global');
	}

}

//////////////////////////////////////////////////////////////////
// REST routes to save and get settings
//////////////////////////////////////////////////////////////////

add_action('rest_api_init', 'gspb_register_route');
function gspb_register_route()
{

	register_rest_route(
		'greenshift/v1',
		'/global_settings/',
		array(
			array(
				'methods'             => 'GET',
				'callback'            => 'gspb_get_global_settings',
				'permission_callback' => function () {
					return current_user_can('manage_options');
				},
				'args'                => array(),
			),
			array(
				'methods'             => 'POST',
				'callback'            => 'gspb_update_global_settings',
				'permission_callback' => function () {
					return current_user_can('manage_options');
				},
				'args'                => array(),
			),
		)
	);

	register_rest_route(
		'greenshift/v1',
		'/css_settings/',
		array(
			array(
				'methods'             => 'POST',
				'callback'            => 'gspb_update_css_settings',
				'permission_callback' => function () {
					return current_user_can('edit_posts');
				},
				'args'                => array(),
			),
		)
	);

}

function gspb_get_global_settings()
{

	try {

		$settings = get_option('gspb_global_settings');

		return array(
			'success'  => true,
			'settings' => $settings,
		);
	} catch (Exception $e) {
		return array(
			'success' => false,
			'message' => $e->getMessage(),
		);
	}
}

function gspb_update_global_settings($request)
{

	try {
		$params = $request->get_params();
		$defaults = get_option('gspb_global_settings');
		$settings = '';

		if ($defaults === false) {
			add_option('gspb_global_settings', $params);
			$settings = $params;
		} else {
			$newargs = wp_parse_args( $params, $defaults );
			update_option('gspb_global_settings', $newargs);
			$settings = $newargs;
		}

		$gs_global_css = (!empty($settings['globalcss'])) ? $settings['globalcss'] : '';
		$gs_global_css = str_replace('!important', '', $gs_global_css);

		$gs_reusable_css = (!empty($settings['reusablestyles'])) ? $settings['reusablestyles'] : '';
		if(!empty($gs_reusable_css)){
			foreach($gs_reusable_css as $key=>$value){
				$gs_global_css .= $value['style'];
			}
		}

		if(!empty($settings['localfontcss'])){
			$gs_global_css = $gs_global_css.$settings['localfontcss'];
		}

		$upload_dir = wp_upload_dir();
		require_once ABSPATH . 'wp-admin/includes/file.php';
		global $wp_filesystem;
		$dir = trailingslashit($upload_dir['basedir']) . 'GreenShift/'; // Set storage directory path
		WP_Filesystem(); // WP file system
		if (!$wp_filesystem->is_dir($dir)) {
			$wp_filesystem->mkdir($dir);
		}
	
		$gspb_css_filename = 'globalstyle.css';
	
		if (!$wp_filesystem->put_contents($dir . $gspb_css_filename, $gs_global_css)) {
			throw new Exception(__('CSS not saved due the permission!!!', 'greenshift-animation-and-page-builder-blocks'));
		}
		
		return json_encode(array(
			'success' => true,
			'message' => 'Global settings updated!',
		));
	} catch (Exception $e) {
		return json_encode(array(
			'success' => false,
			'message' => $e->getMessage(),
		));
	}
}

function gspb_update_css_settings($request)
{

	try {
		$css = sanitize_text_field($request->get_param('css'));
		$id = sanitize_text_field($request->get_param('id'));
		if($css){
			update_post_meta($id, '_gspb_post_css', $css);
		}
		
		return json_encode(array(
			'success' => true,
			'message' => 'Post css updated!',
		));
	} catch (Exception $e) {
		return json_encode(array(
			'success' => false,
			'message' => $e->getMessage(),
		));
	}
}

//////////////////////////////////////////////////////////////////
// USDZ support until WP will have it
//////////////////////////////////////////////////////////////////

function gspb_enable_extended_upload( $mime_types = array() ) {
	$mime_types['txt'] = 'application/text';
	$mime_types['svg'] = 'image/svg+xml';
	$mime_types['glb']  = 'application/octet-stream';
	$mime_types['usdz']  = 'application/octet-stream';
	$mime_types['gltf']  = 'text/plain';
	return $mime_types;
}
add_filter( 'upload_mimes', 'gspb_enable_extended_upload' );


//////////////////////////////////////////////////////////////////
// Template Library
//////////////////////////////////////////////////////////////////

const TEMPLATE_SERVER_URL = 'https://greenshift.wpsoul.net/';

add_action('wp_ajax_gspb_get_layouts', 'gspb_get_all_layouts');
add_action('wp_ajax_gspb_get_layout_by_id', 'gspb_get_layout');
add_action('wp_ajax_gspb_get_categories', 'gspb_get_categories');
add_action('wp_ajax_gspb_get_saved_block', 'gspb_get_saved_block');

if(!function_exists('gspb_get_all_layouts')){
	function gspb_get_all_layouts()
	{
		$get_args = array('timeout' => 200,'sslverify' => false,);
		$category = intval($_POST['category_id']);
		$page = !empty($_POST['page']) ? intval($_POST['page']) : 1;
		$apiUrl   = TEMPLATE_SERVER_URL . '/wp-json/wp/v2/posts/?_embed&categories=' . $category . '&per_page=99&page='.$page.'';
		$response = wp_remote_get($apiUrl, $get_args);
		$request_result = wp_remote_retrieve_body( $response );
		if ( $request_result == '' ) {
		  return false;
		}else{
			echo wp_remote_retrieve_body($response);
		}
		wp_die();
	}
}

if(!function_exists('gspb_get_layout')){
	function gspb_get_layout()
	{
		$get_args = array(
			'timeout'   => 200,
			'sslverify' => false,
		);
		$id       = intval($_POST['gspb_layout_id']);
		$apiUrl   = TEMPLATE_SERVER_URL . '/wp-json/greenshift/v1/layout/' . $id;
		$response = wp_remote_get($apiUrl, $get_args);
		$request_result = wp_remote_retrieve_body( $response );
		if ( $request_result == '' ) {
		  return false;
		}else{
			$request_result = greenshift_replace_ext_images($request_result);
			echo $request_result;
		}
		wp_die();
	}
}

if(!function_exists('gspb_get_categories')){
	function gspb_get_categories()
	{
		$get_args = array(
			'timeout'   => 200,
			'sslverify' => false,
		);
		$id       = intval($_POST['category_id']);
		$apiUrl   = TEMPLATE_SERVER_URL . '/wp-json/wp/v2/categories?parent=' . $id;
		$response = wp_remote_get($apiUrl, $get_args);
		$request_result = wp_remote_retrieve_body( $response );
		if ( $request_result == '' ) {
		  return false;
		}else{
			echo wp_remote_retrieve_body($response);
		}
		wp_die();
		
	}
}

function gspb_get_saved_block() {
	$args      = array(
		'post_type'   => 'wp_block',
		'post_status' => 'publish',
		'posts_per_page' => 100
	);
	$id       = (!empty($_POST['block_id'])) ? intval($_POST['block_id']) : '';
	if($id){
		$args['p'] = $id;
	}
	$r         = wp_parse_args( null, $args );
	$get_posts = new WP_Query();
	$wp_blocks = $get_posts->query( $r );
	$response = array(
		'blocks' => $wp_blocks,
		'admin' => admin_url()
	);
	wp_send_json_success( $response );
}