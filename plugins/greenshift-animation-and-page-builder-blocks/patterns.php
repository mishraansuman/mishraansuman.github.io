<?php

// Exit if accessed directly.
if (!defined('ABSPATH')) {
	exit;
}

register_block_pattern_category(
    'greenshiftelements',
    array( 'label' => __( 'Greenshift Elements', 'greenshift-animation-and-page-builder-blocks') )
);

// 	'blockTypes'    => array( 'greenshift-blocks/button' ), 
register_block_pattern(
    'greenshift/buttonone',
    array(
        'title'       => __( 'Button Style', 'greenshift-animation-and-page-builder-blocks'),
        'categories' => array('greenshiftelements'),
		'keywords' => array('button', 'cta'),
		'description' => _x( 'button with secondary label and icon', 'Block pattern description', 'greenshift-animation-and-page-builder-blocks'),
        'content'     => '<!-- wp:greenshift-blocks/button {"id":"gsbp-1deff068-ceea","spacing":{"margin":{"values":{"bottom":[20]},"unit":["px","px","px","px"],"locked":false},"padding":{"values":{},"unit":["px","px","px","px"],"locked":false}},"border":{"borderRadius":{"values":{"topLeft":30,"topRight":30,"bottomRight":30,"bottomLeft":30},"unit":"px","locked":true}},"typography":{"textShadow":{"hShadow":"0","vShadow":"0","blur":"1","color":"#0000001a"},"size":[19],"customweight":"bold"},"csstransform":{"time":0.3,"scaleHover":[1.2]},"buttonLink":"#","enableIcon":true,"iconBox_icon":{"icon":{"font":"rhicon rhi-shield-check","svg":"","image":""},"fill":"#ffffff","fillhover":"","type":"font","iconSize":[22]},"enableLabel":true,"label":"Just one day","typographyLabel":{"textShadow":{},"size":[15]}} -->
        <div id="gspb_button-id-gsbp-1deff068-ceea" class="gspb_button_wrapper gspb_button-id-gsbp-1deff068-ceea wp-block-greenshift-blocks-button"><a class="gspb-buttonbox" href="#" rel="noopener"><span class="gspb-buttonbox-textwrap"><span class="gspb-buttonbox-icon"><svg class="" style="display:inline-block;vertical-align:middle" width="15" height="15" viewbox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg"><path style="fill:#565D66" d="M933 167.4l-384-160c-10.902-4.648-23.586-7.35-36.9-7.35s-25.998 2.702-37.531 7.588l0.631-0.238-384 160c-35.8 14.8-59.2 49.8-59.2 88.6 0 397 229 671.4 443 760.6 23.6 9.8 50.2 9.8 73.8 0 171.4-71.4 443.2-318 443.2-760.6 0-38.8-23.4-73.8-59-88.6zM838.6 395.8l-368 368c-12.4 12.4-32.8 12.4-45.2 0l-208-208c-12.4-12.4-12.4-32.8 0-45.2l45.2-45.2c12.4-12.4 32.8-12.4 45.2 0l140.2 140.2 300.2-300.2c12.4-12.4 32.8-12.4 45.2 0l45.2 45.2c12.6 12.6 12.6 32.8 0 45.2z"></path></svg></span><span class="gspb-buttonbox-text"><span class="gspb-buttonbox-title">Buy This Now!</span><span class="gspb-buttonbox-label">Just one day</span></span></span></a></div>
        <!-- /wp:greenshift-blocks/button -->',
    )
);
register_block_pattern(
    'greenshift/gridfour',
    array(
        'title'       => __( 'Container grid 4 items', 'greenshift-animation-and-page-builder-blocks'),
        'categories' => array('greenshiftelements'),
        'blockTypes'    => array( 'greenshift-blocks/container' ),
		'keywords' => array('container', 'grid'),
		'description' => _x( 'CSS grid with 4 items', 'Block pattern description', 'greenshift-animation-and-page-builder-blocks'),
        'content'     => '<!-- wp:greenshift-blocks/container {"id":"gsbp-45a2879d-8d4f","flexbox":{"type":"grid","gridcolumns":[4,2,2,1],"columngap":[30],"rowgap":[30]},"align":"wide"} -->
        <div id="gspb_container-id-gsbp-45a2879d-8d4f" class="gspb_container gspb_container-gsbp-45a2879d-8d4f wp-block-greenshift-blocks-container alignwide"><!-- wp:greenshift-blocks/container {"id":"gsbp-267a2853-2ce1"} -->
        <div id="gspb_container-id-gsbp-267a2853-2ce1" class="gspb_container gspb_container-gsbp-267a2853-2ce1 wp-block-greenshift-blocks-container"><!-- wp:greenshift-blocks/container {"id":"gsbp-4195e941-7d27","background":{"color":"#f7f8fa"},"border":{"borderRadius":{"values":{"topLeft":8,"topRight":8,"bottomRight":8,"bottomLeft":8},"unit":"px","locked":true},"style":{},"size":{},"color":{}},"spacing":{"margin":{"values":{},"unit":["px","px","px","px"],"locked":false},"padding":{"values":{"left":[25],"top":[25],"right":[25],"bottom":[25]},"unit":["px","px","px","px"],"locked":true}},"shadow":{"hoffsetHover":0,"voffsetHover":15,"blurHover":30,"spreadHover":0,"colorHover":"rgba(119, 123, 146, 0.1)"},"csstransform":{"time":0.4,"easing":"cubic","translateYHover":[-5,null,null,null]}} -->
        <div id="gspb_container-id-gsbp-4195e941-7d27" class="gspb_container gspb_container-gsbp-4195e941-7d27 wp-block-greenshift-blocks-container"><!-- wp:greenshift-blocks/iconbox {"id":"gsbp-f71266f8-4125","type":"boxed","spacing":{"margin":{"values":{"bottom":[20]},"unit":["px","px","px","px"],"locked":false},"padding":{"values":{"left":[14],"top":[14],"right":[14],"bottom":[14]},"unit":["px","px","px","px"],"locked":true}},"shapeJustify":"flex-start","iconBox_icon":{"icon":{"font":"rhicon rhi-paper-plane","svg":"","image":""},"fill":"#2184f9","fillhover":"#2184f9","iconSize":[26,null,null,null],"type":"font"}} -->
        <div id="gspb_iconBox-id-gsbp-f71266f8-4125" class="gspb_iconBox gspb_iconBox-id-gsbp-f71266f8-4125 wp-block-greenshift-blocks-iconbox"><div class="gspb_iconBox__wrapper" style="display:inline-flex"><svg class="" style="display:inline-block;vertical-align:middle" width="72" height="72" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg"><path style="fill:#565D66" d="M928 8.6l-896 516.8c-46 26.6-41.4 94.4 7.6 114.6l280.4 116v204c0 60.4 75.6 86.6 113.4 40.6l121.4-147.6 252.8 104.4c38.2 15.8 81.4-8.4 87.6-49.4l128-834.2c8.2-53.4-49.2-91.8-95.2-65.2zM384 960v-177.6l109 45-109 132.6zM832 898.2l-412.4-170.4 399-471.6c9.6-11.2-5.8-26.4-17-16.8l-510.6 435.2-227-93.6 896-517-128 834.2z"></path></svg></div></div>
        <!-- /wp:greenshift-blocks/iconbox -->
        
        <!-- wp:greenshift-blocks/heading {"id":"gsbp-46fa95e1-6779","headingTag":"div","headingContent":"First Column title","typography":{"customweight":"bold"},"numberCircle":"1","enablesubTitle":true,"subTitle":"Build complex layouts easily with Greenshift plugin","spacingsubTitle":{"margin":{"values":{"top":[15]},"unit":["px","px","px","px"],"locked":false},"padding":{"values":{},"unit":["px","px","px","px"],"locked":false}},"typographysubTitle":{"customweight":"normal","color":"#6d6f76"}} -->
        <div id="gspb_heading-id-gsbp-46fa95e1-6779" class="gspb_heading gspb_heading-id-gsbp-46fa95e1-6779 ">First Column title<span class="gspb_heading_subtitle">Build complex layouts easily with Greenshift plugin</span></div>
        <!-- /wp:greenshift-blocks/heading --></div>
        <!-- /wp:greenshift-blocks/container --></div>
        <!-- /wp:greenshift-blocks/container -->
        
        <!-- wp:greenshift-blocks/container {"id":"gsbp-87f3f79d-8326"} -->
        <div id="gspb_container-id-gsbp-87f3f79d-8326" class="gspb_container gspb_container-gsbp-87f3f79d-8326 wp-block-greenshift-blocks-container"><!-- wp:greenshift-blocks/container {"id":"gsbp-e909c2ad-3bd7","background":{"color":"#f7f8fa"},"border":{"borderRadius":{"values":{"topLeft":8,"topRight":8,"bottomRight":8,"bottomLeft":8},"unit":"px","locked":true},"style":{},"size":{},"color":{}},"spacing":{"margin":{"values":{},"unit":["px","px","px","px"],"locked":false},"padding":{"values":{"left":[25],"top":[25],"right":[25],"bottom":[25]},"unit":["px","px","px","px"],"locked":true}},"shadow":{"hoffsetHover":0,"voffsetHover":15,"blurHover":30,"spreadHover":0,"colorHover":"rgba(119, 123, 146, 0.1)"},"csstransform":{"time":0.4,"easing":"cubic","translateYHover":[-5,null,null,null]}} -->
        <div id="gspb_container-id-gsbp-e909c2ad-3bd7" class="gspb_container gspb_container-gsbp-e909c2ad-3bd7 wp-block-greenshift-blocks-container"><!-- wp:greenshift-blocks/iconbox {"id":"gsbp-01a936c5-f012","type":"boxed","spacing":{"margin":{"values":{"bottom":[20]},"unit":["px","px","px","px"],"locked":false},"padding":{"values":{"left":[14],"top":[14],"right":[14],"bottom":[14]},"unit":["px","px","px","px"],"locked":true}},"shapeJustify":"flex-start","iconBox_icon":{"icon":{"font":"rhicon rhi-bolt-regular","svg":"","image":""},"fill":"#2184f9","fillhover":"#2184f9","iconSize":[26,null,null,null],"type":"font"}} -->
        <div id="gspb_iconBox-id-gsbp-01a936c5-f012" class="gspb_iconBox gspb_iconBox-id-gsbp-01a936c5-f012 wp-block-greenshift-blocks-iconbox"><div class="gspb_iconBox__wrapper" style="display:inline-flex"><svg class="" style="display:inline-block;vertical-align:middle" width="72" height="72" viewBox="0 0 768 1024" xmlns="http://www.w3.org/2000/svg"><path style="fill:#565D66" d="M755.6 335.8c-16.4-28.6-46.2-45.8-79.2-45.8h-188.8l57.4-175c7.4-27.6 1.6-56.6-15.8-79.4-17.6-22.6-44.2-35.6-72.8-35.6h-261c-45.6 0-84.6 34.2-89.6 74.2l-104.8 424.4c-3.8 27.6 4.4 55.4 22.6 76.4s44.6 33 72.4 33h196.2l-69.8 303.4c-6.4 27.4-0.2 55.8 17.2 77.8 17.4 22.2 43.6 34.8 71.8 34.8 32.6 0 63-17.6 77.6-43.2l366.4-553.4c16.8-28.6 16.8-63 0.2-91.6zM320.2 914.8l92.6-402.8h-317.8l100.4-416 255.2-1.8-95.6 291.8h313l-347.8 528.8z"></path></svg></div></div>
        <!-- /wp:greenshift-blocks/iconbox -->
        
        <!-- wp:greenshift-blocks/heading {"id":"gsbp-dd1fbc71-a4b1","headingTag":"div","headingContent":"Second Column title","typography":{"customweight":"bold"},"numberCircle":"1","enablesubTitle":true,"subTitle":"Build complex layouts easily with Greenshift plugin","spacingsubTitle":{"margin":{"values":{"top":[15]},"unit":["px","px","px","px"],"locked":false},"padding":{"values":{},"unit":["px","px","px","px"],"locked":false}},"typographysubTitle":{"customweight":"normal","color":"#6d6f76"}} -->
        <div id="gspb_heading-id-gsbp-dd1fbc71-a4b1" class="gspb_heading gspb_heading-id-gsbp-dd1fbc71-a4b1 ">Second Column title<span class="gspb_heading_subtitle">Build complex layouts easily with Greenshift plugin</span></div>
        <!-- /wp:greenshift-blocks/heading --></div>
        <!-- /wp:greenshift-blocks/container --></div>
        <!-- /wp:greenshift-blocks/container -->
        
        <!-- wp:greenshift-blocks/container {"id":"gsbp-89604589-b3fb"} -->
        <div id="gspb_container-id-gsbp-89604589-b3fb" class="gspb_container gspb_container-gsbp-89604589-b3fb wp-block-greenshift-blocks-container"><!-- wp:greenshift-blocks/container {"id":"gsbp-9173b018-51ef","background":{"color":"#f7f8fa"},"border":{"borderRadius":{"values":{"topLeft":8,"topRight":8,"bottomRight":8,"bottomLeft":8},"unit":"px","locked":true},"style":{},"size":{},"color":{}},"spacing":{"margin":{"values":{},"unit":["px","px","px","px"],"locked":false},"padding":{"values":{"left":[25],"top":[25],"right":[25],"bottom":[25]},"unit":["px","px","px","px"],"locked":true}},"shadow":{"hoffsetHover":0,"voffsetHover":15,"blurHover":30,"spreadHover":0,"colorHover":"rgba(119, 123, 146, 0.1)"},"csstransform":{"time":0.4,"easing":"cubic","translateYHover":[-5,null,null,null]}} -->
        <div id="gspb_container-id-gsbp-9173b018-51ef" class="gspb_container gspb_container-gsbp-9173b018-51ef wp-block-greenshift-blocks-container"><!-- wp:greenshift-blocks/iconbox {"id":"gsbp-e1ad7e3e-6f1c","type":"boxed","spacing":{"margin":{"values":{"bottom":[20]},"unit":["px","px","px","px"],"locked":false},"padding":{"values":{"left":[14],"top":[14],"right":[14],"bottom":[14]},"unit":["px","px","px","px"],"locked":true}},"shapeJustify":"flex-start","iconBox_icon":{"icon":{"font":"rhicon rhi-gem","svg":"","image":""},"fill":"#2184f9","fillhover":"#2184f9","iconSize":[26,null,null,null],"type":"font"}} -->
        <div id="gspb_iconBox-id-gsbp-e1ad7e3e-6f1c" class="gspb_iconBox gspb_iconBox-id-gsbp-e1ad7e3e-6f1c wp-block-greenshift-blocks-iconbox"><div class="gspb_iconBox__wrapper" style="display:inline-flex"><svg class="" style="display:inline-block;vertical-align:middle" width="72" height="72" viewBox="0 0 1152 1024" xmlns="http://www.w3.org/2000/svg"><path style="fill:#565D66" d="M927.4 0h-702.8c-8.4 0-16.2 4.4-20.6 11.6l-200.6 325.6c-5.4 8.8-4.4 20.2 2.4 28l552 650.4c9.6 11.2 26.8 11.2 36.4 0l552-650.4c6.8-7.8 7.6-19.2 2.4-28l-200.6-325.6c-4.4-7.2-12.2-11.6-20.6-11.6zM900.2 72l148.6 248h-166l-113.6-248h131zM690 72l113.6 248h-455.4l113.8-248h228zM251.8 72h131l-113.6 248h-166l148.6-248zM122.4 384h146l163.6 384-309.6-384zM346.4 384h459l-229.4 527.6-229.6-527.6zM720 768l163.6-384h146l-309.6 384z"></path></svg></div></div>
        <!-- /wp:greenshift-blocks/iconbox -->
        
        <!-- wp:greenshift-blocks/heading {"id":"gsbp-78bb00ea-f8b0","headingTag":"div","headingContent":"Third Column title","typography":{"customweight":"bold"},"numberCircle":"1","enablesubTitle":true,"subTitle":"Build complex layouts easily with Greenshift plugin","spacingsubTitle":{"margin":{"values":{"top":[15]},"unit":["px","px","px","px"],"locked":false},"padding":{"values":{},"unit":["px","px","px","px"],"locked":false}},"typographysubTitle":{"customweight":"normal","color":"#6d6f76"}} -->
        <div id="gspb_heading-id-gsbp-78bb00ea-f8b0" class="gspb_heading gspb_heading-id-gsbp-78bb00ea-f8b0 ">Third Column title<span class="gspb_heading_subtitle">Build complex layouts easily with Greenshift plugin</span></div>
        <!-- /wp:greenshift-blocks/heading --></div>
        <!-- /wp:greenshift-blocks/container --></div>
        <!-- /wp:greenshift-blocks/container -->
        
        <!-- wp:greenshift-blocks/container {"id":"gsbp-6a1f41bd-a59f"} -->
        <div id="gspb_container-id-gsbp-6a1f41bd-a59f" class="gspb_container gspb_container-gsbp-6a1f41bd-a59f wp-block-greenshift-blocks-container"><!-- wp:greenshift-blocks/container {"id":"gsbp-141d09d2-f1d3","background":{"color":"#f7f8fa"},"border":{"borderRadius":{"values":{"topLeft":8,"topRight":8,"bottomRight":8,"bottomLeft":8},"unit":"px","locked":true},"style":{},"size":{},"color":{}},"spacing":{"margin":{"values":{},"unit":["px","px","px","px"],"locked":false},"padding":{"values":{"left":[25],"top":[25],"right":[25],"bottom":[25]},"unit":["px","px","px","px"],"locked":true}},"shadow":{"hoffsetHover":0,"voffsetHover":15,"blurHover":30,"spreadHover":0,"colorHover":"rgba(119, 123, 146, 0.1)"},"csstransform":{"time":0.4,"easing":"cubic","translateYHover":[-5,null,null,null]}} -->
        <div id="gspb_container-id-gsbp-141d09d2-f1d3" class="gspb_container gspb_container-gsbp-141d09d2-f1d3 wp-block-greenshift-blocks-container"><!-- wp:greenshift-blocks/iconbox {"id":"gsbp-54b835e2-41c9","type":"boxed","spacing":{"margin":{"values":{"bottom":[20]},"unit":["px","px","px","px"],"locked":false},"padding":{"values":{"left":[14],"top":[14],"right":[14],"bottom":[14]},"unit":["px","px","px","px"],"locked":true}},"shapeJustify":"flex-start","iconBox_icon":{"icon":{"font":"rhicon rhi-analytics","svg":"","image":""},"fill":"#2184f9","fillhover":"#2184f9","iconSize":[26,null,null,null],"type":"font"}} -->
        <div id="gspb_iconBox-id-gsbp-54b835e2-41c9" class="gspb_iconBox gspb_iconBox-id-gsbp-54b835e2-41c9 wp-block-greenshift-blocks-iconbox"><div class="gspb_iconBox__wrapper" style="display:inline-flex"><svg class="" style="display:inline-block;vertical-align:middle" width="72" height="72" viewBox="0 0 1152 1024" xmlns="http://www.w3.org/2000/svg"><path style="fill:#565D66" d="M160 704h-128c-17.68 0-32 14.32-32 32v256c0 17.68 14.32 32 32 32h128c17.68 0 32-14.32 32-32v-256c0-17.68-14.32-32-32-32zM128 960h-64v-192h64v192zM1120 384h-128c-17.68 0-32 14.32-32 32v576c0 17.68 14.32 32 32 32h128c17.68 0 32-14.32 32-32v-576c0-17.68-14.32-32-32-32zM1088 960h-64v-512h64v512zM1005.54 177.36c14.7 9.12 31.88 14.64 50.46 14.64 53.020 0 96-42.98 96-96s-42.98-96-96-96-96 42.98-96 96c0 11.020 2.24 21.42 5.66 31.28l-179.2 143.36c-14.7-9.14-31.88-14.66-50.46-14.66s-35.76 5.52-50.46 14.66l-179.2-143.36c3.42-9.84 5.66-20.26 5.66-31.28 0-53.020-42.98-96-96-96s-96 42.98-96 96c0 14.8 3.62 28.64 9.6 41.16l-192.44 192.44c-12.52-5.98-26.36-9.6-41.16-9.6-53.020 0-96 42.98-96 96s42.98 96 96 96 96-42.98 96-96c0-14.8-3.62-28.64-9.6-41.16l192.44-192.44c12.52 5.98 26.36 9.6 41.16 9.6 18.58 0 35.76-5.52 50.46-14.66l179.2 143.36c-3.42 9.86-5.66 20.28-5.66 31.3 0 53.020 42.98 96 96 96s96-42.98 96-96c0-11.020-2.24-21.44-5.66-31.3l179.2-143.34zM1056 64c17.64 0 32 14.36 32 32s-14.36 32-32 32-32-14.36-32-32 14.36-32 32-32zM96 448c-17.64 0-32-14.36-32-32s14.36-32 32-32 32 14.36 32 32-14.36 32-32 32zM416 128c-17.64 0-32-14.36-32-32s14.36-32 32-32 32 14.36 32 32-14.36 32-32 32zM736 384c-17.64 0-32-14.36-32-32s14.36-32 32-32 32 14.36 32 32-14.36 32-32 32zM480 384h-128c-17.68 0-32 14.32-32 32v576c0 17.68 14.32 32 32 32h128c17.68 0 32-14.32 32-32v-576c0-17.68-14.32-32-32-32zM448 960h-64v-512h64v512zM800 640h-128c-17.68 0-32 14.32-32 32v320c0 17.68 14.32 32 32 32h128c17.68 0 32-14.32 32-32v-320c0-17.68-14.32-32-32-32zM768 960h-64v-256h64v256z"></path></svg></div></div>
        <!-- /wp:greenshift-blocks/iconbox -->
        
        <!-- wp:greenshift-blocks/heading {"id":"gsbp-10a215cf-a95e","headingTag":"div","headingContent":"Fourth Column title","typography":{"customweight":"bold"},"numberCircle":"1","enablesubTitle":true,"subTitle":"Build complex layouts easily with Greenshift plugin","spacingsubTitle":{"margin":{"values":{"top":[15]},"unit":["px","px","px","px"],"locked":false},"padding":{"values":{},"unit":["px","px","px","px"],"locked":false}},"typographysubTitle":{"customweight":"normal","color":"#6d6f76"}} -->
        <div id="gspb_heading-id-gsbp-10a215cf-a95e" class="gspb_heading gspb_heading-id-gsbp-10a215cf-a95e ">Fourth Column title<span class="gspb_heading_subtitle">Build complex layouts easily with Greenshift plugin</span></div>
        <!-- /wp:greenshift-blocks/heading --></div>
        <!-- /wp:greenshift-blocks/container --></div>
        <!-- /wp:greenshift-blocks/container --></div>
        <!-- /wp:greenshift-blocks/container -->',
    )
);
register_block_pattern(
    'greenshift/ctablock',
    array(
        'title'       => __( 'CTA simple banner', 'greenshift-animation-and-page-builder-blocks'),
        'categories' => array('greenshiftelements'),
        'blockTypes'    => array( 'greenshift-blocks/container' ),
		'keywords' => array('container', 'grid'),
		'description' => _x( 'CTA banner block', 'Block pattern description', 'greenshift-animation-and-page-builder-blocks'),
        'content'     => '<!-- wp:greenshift-blocks/container {"id":"gsbp-7371d10e-a24a","flexbox":{"type":"flexbox","justifyContent":["space-between"],"flexDirection":["row",null,"column","column"],"alignItems":["center"],"marginBottom":[20,null,20,20],"marginRight":[20,null,20,20],"marginLeft":[20,null,20,20],"marginTop":[0,null,20,20],"marginUnit":["px","px","px","px"],"marginLock":false},"background":{"backgroundState":"Gradient","gradient":"linear-gradient(to top right,var(\u002d\u002dwp\u002d\u002dpreset\u002d\u002dcolor\u002d\u002dsecondary) 0%,var(\u002d\u002dwp\u002d\u002dpreset\u002d\u002dcolor\u002d\u002dprimary) 100%)"},"border":{"borderRadius":{"values":{"topLeft":5,"topRight":5,"bottomRight":5,"bottomLeft":5},"unit":"px","locked":true},"style":{},"size":{},"color":{},"styleHover":{},"sizeHover":{},"colorHover":{}},"spacing":{"margin":{"values":{},"unit":["px","px","px","px"],"locked":false},"padding":{"values":{"top":[20],"right":[10],"bottom":[10],"left":[10]},"unit":["px","px","px","px"],"locked":false}},"className":"gs-banner"} -->
        <div id="gspb_container-id-gsbp-7371d10e-a24a" class="gspb_container gspb_container-gsbp-7371d10e-a24a wp-block-greenshift-blocks-container gs-banner"><!-- wp:greenshift-blocks/heading {"id":"gsbp-c72d30f7-f0cd","headingTag":"div","headingContent":"Get the latest features","typography":{"textShadow":{},"size":[30],"customweight":"bold","color":"#ffffff","alignment":[null,null,"center","center"]},"enablesubTitle":true,"typographysubTitle":{"textShadow":{},"customweight":"normal","color":"#d6d6d6"}} -->
        <div id="gspb_heading-id-gsbp-c72d30f7-f0cd" class="gspb_heading gspb_heading-id-gsbp-c72d30f7-f0cd ">Get the latest features<span class="gspb_heading_subtitle">Build complex layouts easily</span></div>
        <!-- /wp:greenshift-blocks/heading -->
        
        <!-- wp:greenshift-blocks/button {"id":"gsbp-a1d11779-ad14","buttonContent":"Check prices!","background":{"color":"","backgroundState":"Classic","overlayOpacity":""},"spacing":{"margin":{"values":{"bottom":[null,null,10,10]},"unit":["px","px","px","px"],"locked":false},"padding":{"values":{"top":[15],"bottom":[15],"right":[25],"left":[25]},"unit":["px","px","px","px"],"locked":false}},"border":{"borderRadius":{"values":{"topLeft":5,"topRight":5,"bottomRight":5,"bottomLeft":5},"unit":"px","locked":true},"style":{},"size":{},"color":{},"styleHover":{},"sizeHover":{},"colorHover":{}},"typography":{"textShadow":{},"size":[19]},"csstransform":{"hoverClass":"gs-banner","scaleHover":[1.1],"time":0.5}} -->
        <div id="gspb_button-id-gsbp-a1d11779-ad14" class="gspb_button_wrapper gspb_button-id-gsbp-a1d11779-ad14 wp-block-greenshift-blocks-button"><a class="gspb-buttonbox" rel="noopener"><span class="gspb-buttonbox-textwrap"><span class="gspb-buttonbox-text"><span class="gspb-buttonbox-title">Check prices!</span></span></span></a></div>
        <!-- /wp:greenshift-blocks/button --></div>
        <!-- /wp:greenshift-blocks/container -->',
    )
);
register_block_pattern(
    'greenshift/rowfull',
    array(
        'title'       => __( 'Full width Row', 'greenshift-animation-and-page-builder-blocks'),
        'categories' => array('greenshiftelements'),
        'blockTypes'    => array( 'greenshift-blocks/row' ),
		'keywords' => array('container', 'row'),
		'description' => _x( 'Full width Row with background and title', 'Block pattern description', 'greenshift-animation-and-page-builder-blocks'),
        'content'     => '<!-- wp:greenshift-blocks/row {"id":"gsbp-d159b07b-e716","align":"full","displayStyles":false,"background":{"backgroundState":"Gradient","gradient":"linear-gradient(135deg,rgb(136,15,196) 0%,rgb(29,57,242) 100%)"},"spacing":{"margin":{"values":{"bottom":[50]},"unit":["px","px","px","px"],"locked":false},"padding":{"values":{"top":[20],"bottom":[20]},"unit":["px","px","px","px"],"locked":false}}} -->
        <div id="gspb_row-id-gsbp-d159b07b-e716" class="gspb_row gspb_row-id-gsbp-d159b07b-e716 wp-block-greenshift-blocks-row alignfull gspb_row-id-gsbp-d159b07b-e716"><div class="gspb_row__content"> <!-- wp:greenshift-blocks/row-column {"id":"gsbp-16eaa235-b99e"} -->
        <div id="gspb_col-id-gsbp-16eaa235-b99e" class="gspb_row__col--12 wp-block-greenshift-blocks-row-column  gspb_col-id-gsbp-16eaa235-b99e"><!-- wp:greenshift-blocks/heading {"id":"gsbp-15874208-24a8","headingTag":"div","headingContent":"Life Doesn’t Wait, Neither Should You","typography":{"textShadow":{},"alignment":["center"],"color":"#ffffff","size":[30],"line_height":[40],"customweight":"bold"},"enablesubTitle":true,"subTitle":"Lorem Ipsum is simply dummy text of printing","typographysubTitle":{"textShadow":{},"customweight":"normal","color":"#e4e4e4","line_height":[25]}} -->
        <div id="gspb_heading-id-gsbp-15874208-24a8" class="gspb_heading gspb_heading-id-gsbp-15874208-24a8 ">Life Doesn’t Wait, Neither Should You<span class="gspb_heading_subtitle">Lorem Ipsum is simply dummy text of printing</span></div>
        <!-- /wp:greenshift-blocks/heading --></div>
        <!-- /wp:greenshift-blocks/row-column --> </div></div>
        <!-- /wp:greenshift-blocks/row -->',
    )
);