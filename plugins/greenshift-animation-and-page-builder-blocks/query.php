<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
	exit;
}

add_action( 'wp_ajax_gspb_filterpost', 'ajax_action_gspb_filterpost' );
add_action( 'wp_ajax_nopriv_gspb_filterpost', 'ajax_action_gspb_filterpost' );

function ajax_action_gspb_filterpost() {  
    check_ajax_referer( 'filterpanel', 'security' );
    $args = (!empty($_POST['filterargs'])) ? gspb_sanitize_multi_arrays(json_decode(stripslashes($_POST['filterargs']), true)) : array();
    $innerargs = (!empty($_POST['innerargs'])) ? gspb_sanitize_multi_arrays(json_decode(stripslashes($_POST['innerargs']), true)) : array();
    $offset = (!empty($_POST['offset'])) ? intval( $_POST['offset'] ) : 0;
    $template = (!empty($_POST['template'])) ? sanitize_text_field( $_POST['template'] ) : '';
    $sorttype = (!empty($_POST['sorttype'])) ? gspb_sanitize_multi_arrays(json_decode(stripslashes($_POST['sorttype']), true)) : '';
    $tax = (!empty($_POST['tax'])) ? gspb_sanitize_multi_arrays(json_decode(stripslashes($_POST['tax']), true)) : '';
    //$containerid = (!empty($_POST['containerid'])) ? sanitize_text_field( $_POST['containerid'] ) : '';
    if ($template == '') return;
    $response = $page_sorting = '';

    if ($offset !='') {$args['offset'] = $offset;}
    $offsetnext = (!empty($args['posts_per_page'])) ? (int)$offset + $args['posts_per_page'] : (int)$offset + 12;
    //$perpage = (!empty($args['posts_per_page'])) ? $args['posts_per_page'] : 12;
    $args['no_found_rows'] = true;
    $args['post_status'] = 'publish';   

    if(!empty($sorttype) && is_array($sorttype)) { //if sorting panel  
        $filtertype = $filtermetakey = $filtertaxkey = $filtertaxtermslug = $filterorder = $filterdate = $filterorderby = $filterpricerange = $filtertaxcondition = '';
        $page_sorting = ' data-sorttype=\''.json_encode($sorttype).'\'';
        extract($sorttype);
        if($filterorderby){
            $args['orderby'] = $filterorderby;
        }        
        if(!empty($filtertype) && $filtertype =='comment') {
            $args['orderby'] = 'comment_count';
        }
        if($filtertype =='meta' && !empty($filtermetakey)) { //if meta key sorting
            if(!empty($args['meta_value'])){
                $args['meta_query'] = array(array(
                    'key' => $args['meta_key'],
                    'value' => $args['meta_value'],
                    'compare' => '=',
                ));
                unset($args['meta_value']); 
            }           
            $args['orderby'] = 'meta_value_num date';
            $args['meta_key'] = esc_html($filtermetakey);
        }      
        if($filtertype =='pricerange' && !empty($filterpricerange)) { //if meta key sorting
            $price_range_array = array_map( 'trim', explode( "-", $filterpricerange ) );
            $keymeta = (!empty($args['post_type']) && $args['post_type']=='product') ? '_price' : 'rehub_main_product_price';
            $args['meta_query'][] = array(
                'key'     => $keymeta,
                'value'   => $price_range_array,
                'type'    => 'numeric',
                'compare' => 'BETWEEN',
            );
            if ($filterorderby == 'view' || $filterorderby == 'thumb' || $filterorderby == 'discount' || $filterorderby == 'price'){
                $args['orderby'] = 'meta_value_num';
            }       
            if ($filterorderby == 'view'){
                $args['meta_key'] = 'rehub_views';
            }
            if ($filterorderby == 'thumb'){
                $args['meta_key'] = 'post_hot_count';
            }
            if ($filterorderby == 'wish'){
                $args['meta_key'] = 'post_wish_count';
            }            
            if ($filterorderby == 'discount'){
                $args['meta_key'] = '_rehub_offer_discount';
            }
            if ($filterorderby == 'price'){
                $args['meta_key'] = $keymeta;
            }            
        }                                      
        if($filtertype =='tax' && !empty($filtertaxkey) && !empty($filtertaxtermslug)) { //if taxonomy sorting
            if (!empty($args['tax_query']) && !$filtertaxcondition) {
                unset($args['tax_query']);
            }  
            if(is_array($filtertaxtermslug)){
                $filtertaxtermslugarray = $filtertaxtermslug;
            }  
            else{
                $filtertaxtermslugarray = array_map( 'trim', explode( ",", $filtertaxtermslug) );
            } 
            if($filtertaxcondition){
                $args['tax_query'][] = array(
                    'taxonomy' => $filtertaxkey,
                    'field'    => 'slug',
                    'terms'    => $filtertaxtermslugarray,
                );                
            } 
            else{
                $args['tax_query'] = array (
                    array(
                        'taxonomy' => $filtertaxkey,
                        'field'    => 'slug',
                        'terms'    => $filtertaxtermslugarray,
                    )
                );
            }    
        }
        if($tax && $filtertype != 'tax'){
            $args['tax_query'] = array (
                array(
                    'taxonomy' => $tax['filtertaxkey'],
                    'field'    => 'slug',
                    'terms'    => $tax['filtertaxtermslug'],
                )
            );
        }        
        if($filterorder) { $args['order'] = $filterorder; }
        if($filterdate) { //if date sorting
            if (!empty($args['date_query']) || $filterdate =='all') {
                if(isset($args['date_query'])){
                    unset($args['date_query']);
                }
            }
            if ($filterdate == 'day') {     
                $args['date_query'][] = array(
                    'after'  => '1 day ago',
                );
            }
            if ($filterdate == 'week') {    
                $args['date_query'][] = array(
                    'after'  => '7 days ago',
                );
            }   
            if ($filterdate == 'month') {     
                $args['date_query'][] = array(
                    'after'  => '1 month ago',
                );
            }   
            if ($filterdate == 'year') {     
                $args['date_query'][] = array(
                    'after'  => '1 year ago',
                );
            }
        }
        if($args['post_type']=='product'){
            $args['tax_query'][] = array(
                'relation' => 'AND',
                array(
                    'taxonomy' => 'product_visibility',
                    'field'    => 'name',
                    'terms'    => 'exclude-from-catalog',
                    'operator' => 'NOT IN',
                )
            );          
        }
    }else{ // if infinite scroll

    }   

    $wp_query = new \WP_Query($args);
    $i=1+$offset;
    $count = 1;

    if ( $wp_query->have_posts() ) {
        while ($wp_query->have_posts() ) {
            $wp_query->the_post();
            ob_start();
            if(!empty($innerargs)) {extract($innerargs);}
            include(GUTENCON_PLUGIN_DIR.'parts/'.$template.'.php');
            $count++;$i++;
            $response .= ob_get_clean();
        }
        wp_reset_query();
        // if ($count >= $perpage){
        //     $response .='<div class="gspb_ajax_pagination"><span data-offset="'.$offsetnext.'" data-containerid="'.$containerid.'"'.$page_sorting.' class="gspb_ajax_pagination_btn def_btn">' . esc_html__('Show next', 'gutencon') . '</span></div>';
        // } 
    }           
    else {
        $response .= '<div class="clearfix flexbasisclear gcnomoreclass"><span class="no_more_posts">'.__('No more!', 'gutencon').'<span></div>';
    }       

    wp_send_json_success($response);
    exit;
}

//////////////////////////////////////////////////////////////////
// Sanitize Arrays
//////////////////////////////////////////////////////////////////
function gspb_sanitize_multi_arrays($data = array()) {
    if (!is_array($data) || empty($data)) {
    return array();
    }
    foreach ($data as $k => $v) {
    if (!is_array($v) && !is_object($v)) {
        if($k == 'contshortcode'){
            $data[sanitize_key($k)] = wp_kses_post($v);
        }elseif($k=='attrelpanel'){
            $data[sanitize_key($k)] = filter_var( $v, FILTER_SANITIZE_SPECIAL_CHARS );
        }else{
            $data[sanitize_key($k)] = sanitize_text_field($v);
        }
    }
    if (is_array($v)) {
        $data[$k] = gspb_sanitize_multi_arrays($v);
    }
    }
    return $data;
}

//////////////////////////////////////////////////////////////////
// Function for extract args from blocks
//////////////////////////////////////////////////////////////////
if( !class_exists('GSPB_Postfilters') ) {
    class GSPB_Postfilters{
        public $filter_args = array(
            'data_source'=>'cat',
            'cat'=>'',
            'cat_name'=>'',
            'tag'=>'',
            'cat_exclude'=>'',
            'tag_exclude'=>'',
            'ids'=>'',
            'orderby'=>'',
            'order '=> 'DESC',
            'meta_key'=>'',
            'show'=>12,
            'offset'=>'',
            'show_date' => '',		
            'post_type'=>'',
            'tax_name'=>'',
            'tax_slug'=>'',
            'type' => '',
            'tax_slug_exclude'=>'',
            'post_formats'=>'',
            'badge_label '=>'1',
            'enable_pagination'=>'',
            'price_range' => '',		
            'show_coupons_only'=>'',
            'user_id' => '',
            'searchtitle' => '',
        );
        function __construct( $filter_args = array() ){
            $this->set_opt( $filter_args );
            return $this;
        }
        function set_opt( $filter_args = array() ){
            $this->filter_args = (object) array_merge( $this->filter_args, (array) $filter_args );
        }	
        public function extract_filters(){
    
            $filter_args = & $this->filter_args;
    
            if ($filter_args->data_source == 'ids' && $filter_args->ids !='') {
                $ids = array_map( 'trim', explode( ",", $filter_args->ids ) );
                $args = array(
                    'post__in' => $ids,
                    'numberposts' => '-1',
                    'orderby' => 'post__in', 
                    'ignore_sticky_posts' => 1,
                    'post_type'=> 'any'            
                );
            }   
            elseif ($filter_args->data_source == 'cpt') {
                $args = array(
                    'post_type' => $filter_args->post_type,
                    'posts_per_page'   => (int)$filter_args->show, 
                    'order' => $filter_args->order,                  
                );
                if ($filter_args->offset != '') {$args['offset'] = (int)$filter_args->offset;}    
                if($filter_args->post_type == 'product') {
                    if ($filter_args->cat !='') {
                        $cat = array_map( 'trim', explode( ",", $filter_args->cat ) );
                        $args['tax_query'][] = array(
                            'relation' => 'AND',
                            array(
                                'taxonomy' => 'product_cat',
                                'field'    => 'term_id',
                                'terms'    => $cat,
                            )
                        );
                    }
                    if ($filter_args->cat_exclude !='') {
                        $cat_exclude = array_map( 'trim', explode( ",", $filter_args->cat_exclude ) );
                        $args['tax_query'][] = array(
                            'relation' => 'AND',
                            array(
                                'taxonomy' => 'product_cat',
                                'field'    => 'term_id',
                                'terms'    => $cat_exclude,
                                'operator' => 'NOT IN'
                            )
                        );
                    }
                    if ($filter_args->tag !='') {
                        $tag = array_map( 'trim', explode( ",", $filter_args->tag ) );
                        $args['tax_query'][] = array(
                            'relation' => 'AND',
                            array(
                                'taxonomy' => 'product_tag',
                                'field'    => 'term_id',
                                'terms'    => $tag,
                            )
                        );
                    }         
                    if ($filter_args->tag_exclude !='') {
                        $tag_exclude = array_map( 'trim', explode( ",", $filter_args->tag_exclude ) );
                        $args['tax_query'][] = array(
                            'relation' => 'AND',
                            array(
                                'taxonomy' => 'product_tag',
                                'field'    => 'term_id',
                                'terms'    => $tag_exclude,
                                'operator' => 'NOT IN'
                            )
                        );
                    }         
                    if ($filter_args->type !='') {
        
                        if($filter_args->type =='featured') {
                            $args['tax_query'][] = array(
                                'relation' => 'AND',
                                array(
                                    'taxonomy' => 'product_visibility',
                                    'field'    => 'name',
                                    'terms'    => 'featured',
                                    'operator' => 'IN',
                                )
                            );
                        }
                        elseif($filter_args->type =='sale') {
                            $product_ids_on_sale = wc_get_product_ids_on_sale();
                            $args['post__in'] = array_merge( array( 0 ), $product_ids_on_sale );
                            $args['no_found_rows'] = 1;
                        }
                        elseif($filter_args->type =='recentviews') {
                            $viewed_products = ! empty( $_COOKIE['woocommerce_recently_viewed'] ) ? (array) explode( '|', $_COOKIE['woocommerce_recently_viewed'] ) : array();
                            $viewed_products = array_reverse( array_filter( array_map( 'absint', $viewed_products ) ) );
                            $args['post__in'] = $viewed_products;
                            $args['no_found_rows'] = 1;
                        }
                        elseif($filter_args->type =='saled') {
                            $args['meta_query'][] = array(
                                'key'     => 'total_sales',
                                'value'   => '0',
                                'compare' => '!=',
                            );
                         }
                    }
                }
            } 
            elseif ($filter_args->data_source == 'auto') {
                $args = array(
                    'posts_per_page'   => (int)$filter_args->show, 
                    'order' => $filter_args->order,                  
                );	
                if($filter_args->enable_pagination == ''){
                    $filter_args->enable_pagination = '1';
                }    	
                if(is_category()){
                    $args['post_type'] = 'post';
                    $catid = get_query_var( 'cat' );
                    $args['cat'] = $catid;
                }elseif (is_tag()) {
                    $args['post_type'] = 'post';
                    $tagid = get_queried_object_id();
                    $args['tax_query'] = array (
                        array(
                            'taxonomy' => 'post_tag',
                            'field'    => 'id',
                            'terms'    => array($tagid),
                        )
                    );				
                } 
                elseif (is_tax('blog_category')) {
                    $args['post_type'] = 'blog';
                    $tagid = get_queried_object_id();
                    $args['tax_query'] = array (
                        array(
                            'taxonomy' => 'blog_category',
                            'field'    => 'id',
                            'terms'    => array($tagid),
                        )
                    );				
                }
                elseif (is_tax('blog_tag')) {
                    $args['post_type'] = 'blog';
                    $tagid = get_queried_object_id();
                    $args['tax_query'] = array (
                        array(
                            'taxonomy' => 'blog_tag',
                            'field'    => 'id',
                            'terms'    => array($tagid),
                        )
                    );				
                }
                elseif (is_tax('dealstore')) {
                    $args['post_type'] = 'post';
                    $tagid = get_queried_object_id();
                    $args['tax_query'] = array (
                        array(
                            'taxonomy' => 'dealstore',
                            'field'    => 'id',
                            'terms'    => array($tagid),
                        )
                    );				
                }
                elseif (is_tax('store')) {
                    $args['post_type'] = 'product';
                    $tagid = get_queried_object_id();
                    $args['tax_query'] = array (
                        array(
                            'taxonomy' => 'store',
                            'field'    => 'id',
                            'terms'    => array($tagid),
                        )
                    );				
                }
                elseif (is_tax('product_cat')) {
                    $args['post_type'] = 'product';
                    $tagid = get_queried_object_id();
                    $args['tax_query'] = array (
                        array(
                            'taxonomy' => 'product_cat',
                            'field'    => 'id',
                            'terms'    => array($tagid),
                        )
                    );				
                }
                elseif (is_tax('product_tag')) {
                    $args['post_type'] = 'product';
                    $tagid = get_queried_object_id();
                    $args['tax_query'] = array (
                        array(
                            'taxonomy' => 'product_tag',
                            'field'    => 'id',
                            'terms'    => array($tagid),
                        )
                    );				
                }										
                elseif (is_search()) {
                    $args['post_type'] = 'any';
                    $searchid = get_search_query();
                    $args['s'] = esc_attr($searchid);				
                }
                elseif (is_author()) {
                    $args['post_type'] = array('post', 'blog', 'product');
                    $curauth = ( get_query_var( 'author_name' ) ) ? get_user_by( 'slug', get_query_var( 'author_name' ) ) : get_userdata( get_query_var( 'author' ) );
                    $author_ID = $curauth->ID;
                    $args['author'] = (int)$author_ID;				
                }
                if (class_exists('WooCommerce')){
                    if(is_shop() || is_product_taxonomy()) {
                        $args['post_type'] = 'product';
                        if ( isset( $_GET['rating_filter'] ) && $args['post_type'] == 'product' ) {
                            $visibility_terms = array();
                            $rating_filter = array_filter( array_map( 'absint', explode( ',', wp_unslash( $_GET['rating_filter'] ) ) ) );
                            $product_visibility_terms = wc_get_product_visibility_term_ids();
                            foreach( $rating_filter as $rating ) {
                                $visibility_terms[] = $product_visibility_terms['rated-'. $rating];
                            }
                            $args['tax_query'][] = array(
                                'relation' => 'AND',
                                array(
                                    'taxonomy' => 'product_visibility',
                                    'field' => 'term_taxonomy_id',
                                    'terms' => $visibility_terms,
                                )
                            );
                        }
                        $_chosen_attributes = WC_Query::get_layered_nav_chosen_attributes();
                        if(!empty($_chosen_attributes)){
                            foreach($_chosen_attributes as $_chosen_attribute_tax => $_chosen_attribute ){
                                $filter_name = 'filter_' . wc_attribute_taxonomy_slug( $_chosen_attribute_tax );
                                if( isset($_GET[$filter_name]) && $args['post_type'] == 'product' ){
                                    $args['tax_query'][] = array(
                                        'taxonomy' => $_chosen_attribute_tax,
                                        'field' => 'slug',
                                        'terms' => $_chosen_attribute['terms']
                                    );
                                }
                            }
                        }
                        $args['tax_query'][] = array(
                            'relation' => 'AND',
                            array(
                                'taxonomy' => 'product_visibility',
                                'field'    => 'name',
                                'terms'    => 'exclude-from-catalog',
                                'operator' => 'NOT IN',
                            )
                        );					
                    }
                }																	     
            } 	 
            else {
                $args = array(
                    'post_type' => 'post',
                    'posts_per_page'   => (int)$filter_args->show, 
                    'order' => $filter_args->order,                  
                );	        
                if ($filter_args->offset != '') {$args['offset'] = (int)$filter_args->offset;}
                if ($filter_args->cat !='') {$args['cat'] = $filter_args->cat;}
                if ($filter_args->cat_name !='') {$args['category_name'] = $filter_args->cat_name;}
                if ($filter_args->tag !='') {$args['tag__in'] = array_map( 'trim', explode(",", $filter_args->tag ));}
                if ($filter_args->cat_exclude !='') {$args['category__not_in'] = array_map( 'trim', explode(",", $filter_args->cat_exclude ));}
                if ($filter_args->tag_exclude !='') {$args['tag__not_in'] = explode(',', $filter_args->tag_exclude);}
            }    
            if (!empty ($filter_args->searchtitle) ) {
                $args['s'] = urlencode($filter_args->searchtitle);
                if($filter_args->searchtitle == 'CURRENTPAGE'){
                    $currenttitle = get_the_title();
                    $args['s'] = urlencode($currenttitle);
                }            
            }
            if (!empty ($filter_args->tax_name) && !empty ($filter_args->tax_slug)) {
                $tax_slugs = array_map( 'trim', explode( ",", $filter_args->tax_slug ) );
                $args['tax_query'][] = array(
                    'relation' => 'AND',
                    array(
                        'taxonomy' => $filter_args->tax_name,
                        'field'    => 'slug',
                        'terms'    => $tax_slugs,
                    )
                );
            }
            if (!empty ($filter_args->tax_name) && !empty ($filter_args->tax_slug_exclude)) {
                $tax_slugs_exclude = array_map( 'trim', explode( ",", $filter_args->tax_slug_exclude) );
                $args['tax_query'][] = array(
                    'relation' => 'AND',
                    array(
                        'taxonomy' => $filter_args->tax_name,
                        'field'    => 'slug',
                        'terms'    => $tax_slugs_exclude,
                        'operator' => 'NOT IN',
                    )
                );
            }       
            if (!empty($filter_args->user_id)) {  
                if(is_numeric($filter_args->user_id)) {
                    $args['author'] = $filter_args->user_id;	        	
                }  
            }
            if (($filter_args->orderby == 'meta_value' || $filter_args->orderby == 'meta_value_num') && $filter_args->meta_key !='') {
                $args['meta_key'] = $filter_args->meta_key;
            }
            if ($filter_args->orderby != ''){
                $args['orderby'] = $filter_args->orderby;
            }	
            if ($filter_args->orderby == 'view' || $filter_args->orderby == 'thumb' || $filter_args->orderby == 'discount' || $filter_args->orderby == 'price'){
                $args['orderby'] = 'meta_value_num';
            }    	    
            if ($filter_args->orderby == 'view'){
                $args['meta_key'] = 'rehub_views';
            }
            if ($filter_args->orderby == 'thumb'){
                $args['meta_key'] = 'post_hot_count';
            }
            if ($filter_args->orderby == 'wish'){
                $args['meta_key'] = 'post_wish_count';
            }	    
            if ($filter_args->orderby == 'discount'){
                $args['meta_key'] = '_rehub_offer_discount';
            }
            if ($filter_args->orderby == 'price'){
                if ($filter_args->post_type == 'product' || $args['post_type'] == 'product') {
                    $args['meta_key'] = '_price';
                }else{
                    $args['meta_key'] = 'rehub_main_product_price';	    		
                }
    
            }
            if ($filter_args->orderby == 'hot'){
                $rehub_max_temp = (rehub_option('hot_max')) ? rehub_option('hot_max') : 50;
                $args['meta_query'] = array (
                    array (
                        'key'     => 'post_hot_count',
                        'value'   => $rehub_max_temp,
                        'type'    => 'numeric',
                        'compare' => '>=',
                        )
                    );
                $args['orderby'] = 'date';
            } 	    
    
            if ($filter_args->show_coupons_only == '1') { 
                $args['meta_query']['relation'] = 'AND';    
                $args['meta_query'][] = array(
                    'key'     => 'rehub_offer_product_price_old',
                    'value' => '',
                    'compare' => '!=',
                );
                $args['tax_query'][] = array(
                    'relation' => 'AND',
                    array(
                        'taxonomy' => 'offerexpiration',
                        'field'    => 'name',
                        'terms'    => 'yes',
                        'operator' => 'NOT IN',
                    )
                );		        
            }	     
            if ($filter_args->show_coupons_only == '2') { 
                $args['meta_query']['relation'] = 'AND';    
                $args['meta_query'][] = array(
                    'key'     => 'rehub_offer_product_coupon',
                    'value' => '',
                    'compare' => '!=',
                );
                $args['tax_query'][] = array(
                    'relation' => 'AND',
                    array(
                        'taxonomy' => 'offerexpiration',
                        'field'    => 'name',
                        'terms'    => 'yes',
                        'operator' => 'NOT IN',
                    )
                );	        
            } 
            if ($filter_args->show_coupons_only == '3') {     
                $args['tax_query'][] = array(
                    'relation' => 'AND',
                    array(
                        'taxonomy' => 'offerexpiration',
                        'field'    => 'name',
                        'terms'    => 'yes',
                        'operator' => 'NOT IN',
                    )
                );
            } 	
            if ($filter_args->show_coupons_only == '6') {     
                $args['meta_query'][] = array(
                    array(
                           'key' => 'rehub_review_overall_score',
                           'compare' => 'EXISTS',
                    ),	    	
                );
            } 	    
            if ($filter_args->show_coupons_only == '4') {     
                $args['tax_query'][] = array(
                    'relation' => 'AND',
                    array(
                        'taxonomy' => 'offerexpiration',
                        'field'    => 'name',
                        'terms'    => 'yes',
                        'operator' => 'IN',
                    )
                );
            } 
            if ($filter_args->show_coupons_only == '5') { 
                $args['meta_query']['relation'] = 'AND';    
                $args['meta_query'][] = array(
                    'key'     => 'rehub_offer_product_coupon',
                    'compare' => 'NOT EXISTS',
                );
                $args['tax_query'][] = array(
                    'relation' => 'AND',
                    array(
                        'taxonomy' => 'offerexpiration',
                        'field'    => 'name',
                        'terms'    => 'yes',
                        'operator' => 'NOT IN',
                    )
                );	        
            }	
    
            if ($filter_args->price_range !='') {
                if (!empty($args['meta_query'])){
                    $args['meta_query']['relation'] = 'AND';
                }    
                $price_range_array = array_map( 'trim', explode( "-", $filter_args->price_range ) );
                if ($filter_args->post_type == 'product' || $args['post_type'] == 'product') {
                    $key = '_price';
                }
                else{
                    $key = 'rehub_main_product_price';
                }
    
                $args['meta_query'][] = array(
                    'key'     => $key,
                    'value'   => $price_range_array,
                    'type'    => 'numeric',
                    'compare' => 'BETWEEN',
                );		        
            }	
    
            if (isset($_GET['min_price']) && isset($_GET['max_price'])) {
                if (!empty($args['meta_query'])){
                    $args['meta_query']['relation'] = 'AND';
                } 
                $price_range_array = array(floatval($_GET['min_price']), floatval($_GET['max_price']));   
                if ($filter_args->post_type == 'product' || $args['post_type'] == 'product') {
                    $key = '_price';
                }
                else{
                    $key = 'rehub_main_product_price';
                }
    
                $args['meta_query'][] = array(
                    'key'     => $key,
                    'value'   => $price_range_array,
                    'type'    => 'numeric',
                    'compare' => 'BETWEEN',
                );		        
            }	            
    
            if ($filter_args->show_date == 'day') {     
                $args['date_query'][] = array(
                    'after'  => '1 day ago',
                );
            }
            if ($filter_args->show_date == 'week') {    
                $args['date_query'][] = array(
                    'after'  => '7 days ago',
                );
            }	
            if ($filter_args->show_date == 'month') {     
                $args['date_query'][] = array(
                    'after'  => '1 month ago',
                );
            }	
            if ($filter_args->show_date == 'year') {     
                $args['date_query'][] = array(
                    'after'  => '1 year ago',
                );
            }	            
    
            if ( get_query_var('paged') ) { $paged = get_query_var('paged'); } else if ( get_query_var('page') ) {$paged = get_query_var('page'); } else {$paged = 1; }	    
            if ($filter_args->enable_pagination != '' && $filter_args->enable_pagination != '0') {
                $args['paged'] = $paged;
            }
            else {
                $args['no_found_rows'] = 1;
            }
            //$args['ignore_sticky_posts'] = 1;
            return $args;		
        }
    }
}


?>