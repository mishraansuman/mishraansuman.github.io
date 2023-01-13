<?php

// Exit if accessed directly.
if (!defined('ABSPATH')) {
	exit;
}

//////////////////////////////////////////////////////////////////
// Render animation for dynamic blocks
//////////////////////////////////////////////////////////////////

if(!function_exists('gspb_AnimationRenderProps')){
	function gspb_AnimationRenderProps ($animation=''){
		if($animation){
			$animeprops = array();

			if (!empty($animation['usegsap'])) {

				$animeprops['data-gsapinit'] = 1;
				$animeprops['data-from'] = "yes";

				if (!empty($animation['delay'])) {
					$animeprops['data-delay'] = floatval($animation['delay']) / 1000;
				}
				if (!empty($animation['duration'])) {
					$animeprops['data-duration'] = floatval($animation['duration']) / 1000;
				}
				if (!empty($animation['ease'])) {
					$animeprops['data-ease'] = $animation['ease'];
				}
				if (!empty($animation['x'])) {
					$animeprops['data-x'] = $animation['x'];
				}
				if (!empty($animation['y'])) {
					$animeprops['data-y'] = $animation['y'];
				}
				if (!empty($animation['z'])) {
					$animeprops['data-z'] = $animation['z'];
				}
				if (!empty($animation['rx'])) {
					$animeprops['data-rx'] = $animation['rx'];
				}
				if (!empty($animation['ry'])) {
					$animeprops['data-ry'] = $animation['ry'];
				}
				if (!empty($animation['r'])) {
					$animeprops['data-r'] = $animation['r'];
				}
				if (!empty($animation['s'])) {
					$animeprops['data-s'] = $animation['s'];
				}
				if (!empty($animation['o'])) {
					$animeprops['data-o'] = $animation['o'];
				}
				if (!empty($animation['origin'])) {
					$animeprops['data-origin'] = $animation['origin'];
				}
				if (!empty($animation['text'])) {
					if (!empty($animation['texttype'])) {
						$animeprops['data-text'] = $animation['texttype'];
					} else {
						$animeprops['data-text'] = 'words';
					}
					if (!empty($animation['textdelay'])) {
						$animeprops['data-stdelay'] = $animation['textdelay'];
					}
					if (!empty($animation['textrandom'])) {
						$animeprops['data-strandom'] = "yes";
					}
				} else if (!empty($animation['stagger'])) {
					if (!empty($animation['staggerdelay'])) {
						$animeprops['data-stdelay'] = $animation['staggerdelay'];
					}
					if (!empty($animation['staggerrandom'])) {
						$animeprops['data-strandom'] = "yes";
					}
					$animeprops['data-stchild'] = "yes";
				}
				if (!empty($animation['o']) && ($animation['o'] == 1 || $animation['o'] == 0)) {
					$animeprops['data-prehidden'] = 1;
				}
				if (!empty($animation['onload'])) {
					$animeprops['data-triggertype'] = "load";
				}
				
			}
			else if (!empty($animation['type'])) {

				$animeprops['data-aos'] = $animation['type'];

				if (!empty($animation['delay'])) {
					$animeprops['data-aos-delay'] = $animation['delay'];
				}
				if (!empty($animation['easing'])) {
					$animeprops['data-aos-easing'] = $animation['easing'];
				}
				if (!empty($animation['duration'])) {
					$animeprops['data-aos-duration'] = $animation['duration'];
				}
				if (!empty($animation['anchor'])) {
					$anchor = str_replace(' ', '-', $animation['anchor']);
					$animeprops['data-aos-anchor-placement'] = $anchor;
				}
				if (!empty($animation['onlyonce'])) {
					$animeprops['data-aos-once'] = true;
				}
			}
			else {
				return false;
			}
			$out = '';
			foreach($animeprops as $key=>$value){
				$out .=' '.$key.'="'.$value.'"';
			}
			return $out;


		}
		return false;
	}
}

//////////////////////////////////////////////////////////////////
// Get custom value shortcode
//////////////////////////////////////////////////////////////////

if( !function_exists('gspb_query_get_custom_value') ) {
	function gspb_query_get_custom_value($atts, $content = null){
		extract(shortcode_atts(array(
			'post_id' => NULL,
			'field' => NULL,
			'subfield' => NULL,
			'subsubfield' => NULL,
			'attrfield' => '',
			'type' => 'custom',
			'show_empty' => '',
			'prefix' => '',
			'postfix' => '',
			'icon' => '',
			'list' => '',
			'showtoggle' => '',
			'imageMapper' => '',
			'post_type' => '',
			'repeaternumber'=> '',
			'acfrepeattype'=>'',
			'postprocessor'=> ''
	
		), $atts));
		  if(!$field && !$attrfield && !$type) return;
		$field = trim($field);  
		$attrfield = trim($attrfield);	
		$result = $out = '';
		$field = esc_attr($field);
		$attrfield = esc_attr($attrfield);

		if(!$post_id){
			global $post;
			if(is_object($post)){
				$post_id = $post->ID;
			}
		}

		$post_id = (int)$post_id;

		if ($type=='custom'){
			if(!$field) return;
			$result = get_post_meta($post_id, $field, true);
		}else if(($type=='attribute' || $type=='local') && function_exists('wc_get_product')){
			if($post_id){
				$post_id = trim($post_id);
				$post_id = (int)$post_id;
				$product = wc_get_product( $post_id );
				if(!$product) return;
			}else{
				global $product;
				if ( ! is_object( $product)) $product = wc_get_product( get_the_ID() );
				if(!$product) return;
			}
			if($attrfield) $field = $attrfield;
			if(!empty($product)){
				$woo_attr = $product->get_attribute(esc_html($field));
				if(!is_wp_error($woo_attr)){
					$result = $woo_attr;
				}
			}    	
		}
		else if($type=='checkattribute' && function_exists('wc_get_product')){
			if($post_id){
				$post_id = trim($post_id);
				$post_id = (int)$post_id;
				$product = wc_get_product( $post_id );
				if(!$product) return;
			}else{
				global $product;
				if ( ! is_object( $product)) $product = wc_get_product( get_the_ID() );
				if(!$product) return;
			}
			if($attrfield) $field = $attrfield;
			if(!empty($product)){
				$woo_attr = $product->get_attribute(esc_html($field));
				if(!is_wp_error($woo_attr)){
					$result = $woo_attr;
				}
			} 
			if (!empty($result)){
				$content = do_shortcode($content);
				$content = preg_replace( '%<p>&nbsp;\s*</p>%', '', $content ); 
				$content = preg_replace('/^(?:<br\s*\/?>\s*)+/', '', $content);
				return $content;
			} 
			return false;
		}  
		else if($type=='vendor'){
			$vendor_id = get_query_var( 'author' );
			if(!empty($vendor_id)){
				$result = get_user_meta($vendor_id, $field, true);		
			}	
		}  
		else if($type=='taxonomy'){
			$terms = get_the_terms($post_id, esc_html($field));
			if ($terms && ! is_wp_error($terms)){
				$term_slugs_arr = array();
				foreach ($terms as $term) {
					$term_slugs_arr[] = ''.$term->name.'';
				}
				$terms_slug_str = join(", ", $term_slugs_arr);
				$result = $terms_slug_str;
			}
		}
		else if($type=='taxonomylink'){
			$term_list = get_the_term_list($post_id, esc_html($field), '', ', ', '' );
			if(!is_wp_error($term_list)){
				$result = $term_list;
			}
		}
		else if($type=='author' || $type=='author_meta' ){
			$author_id = get_post_field('post_author', $post_id);
			if(!empty($author_id)){
				$result = get_user_meta($author_id, $field, true);
			}	
		}   
		else if($type=='author_name'){
			$author_id = get_post_field('post_author', $post_id);
			if(!empty($author_id)){
				$result = get_the_author_meta('display_name', $author_id);
			}	
		} 
		else if($type=='author_name_link'){
			$author_id = get_post_field('post_author', $post_id);
			if(!empty($author_id)){
				$link = get_author_posts_url($author_id);
				$name = get_the_author_meta('display_name', $author_id);
				$result = '<a href='.$link.'>'.$name.'</a>';
			}	
		}   
		else if($type=='author_description'){
			$author_id = get_post_field('post_author', $post_id);
			if(!empty($author_id)){
				$result = get_the_author_meta( 'user_description', $author_id);
			}	
		}   
		else if($type=='post_date'){
			$result = get_the_date('', $post_id);
		}		
		else if($type=='comment_count'){
			$result = get_post_field('comment_count', $post_id);
		}
		else if($type=='post_modified'){
			$result = get_the_modified_date('', $post_id);
		}
		else if($type=='excerpt'){
			$result = get_the_excerpt($post_id);
		}
		else if($type=='date'){
			if($field == 'year'){
				return date_i18n("Y");
			}else if($field == 'month'){
				return date_i18n("F");
			}	
		}     
		else if($type=='attributelink'){
			if($attrfield) $field = $attrfield;
			if(function_exists('wc_get_product_terms')) {
				$attribute_values = wc_get_product_terms( $post_id, $field, array( 'fields' => 'all' ) );
				$values = array();
				foreach ( $attribute_values as $attribute_value ) {
					$value_name = esc_html( $attribute_value->name );
					$values[] = '<a href="' . esc_url( get_term_link( $attribute_value->term_id, $field ) ) . '" rel="tag">' . $value_name . '</a>';
				}
				$result = implode (', ', $values); 
			}  	
		}
		else if($type=='checkmeta'){
			$result = get_post_meta($post_id, $field, true);
			if (!empty($result)){
				$content = do_shortcode($content);
				$content = preg_replace( '%<p>&nbsp;\s*</p>%', '', $content ); 
				$content = preg_replace('/^(?:<br\s*\/?>\s*)+/', '', $content);
				return $content;
			} 
			return false;
		}
		else if($type=='acfmulti' && function_exists('get_field')){
			$result = get_field($field, $post_id);
			if (!empty($result)){
				$result = implode(', ', $result);
			} 
		}
		else if($type=='acfimage' && function_exists('get_field')){
			$result = get_field($field, $post_id);
			if (!empty($result) && is_array($result)){
				$id = $result['id'];
			} else{
				$id = $result;
			}
			if(is_numeric($id)){
				$result = wp_get_attachment_image($id, 'full' );
			}else{
				$result = '<img src='.$id.' />';
			}
			return $result;
		}
		else if($type=='acfrepeater' && function_exists('get_field')){
			$result = get_field($field, $post_id);
			if (!empty($result) && !empty($subfield) && is_array($result)){
				$rownumber = $repeaternumber ? intval($repeaternumber-1) : 0;
				$result = $result[$rownumber][$subfield];
				if(!empty($subsubfield)){
					$result = $result[$rownumber][$subfield][$subsubfield];
				}
				if (!empty($result) && $acfrepeattype=='multi'){
					$result = implode(', ', $result);
				} 
				else if (!empty($result) && $acfrepeattype=='image'){
					if (!empty($result) && is_array($result)){
						$id = $result['id'];
					} else{
						$id = $result;
					}
					if(is_numeric($id)){
						$result = wp_get_attachment_image($id, 'full' );
					}else{
						$result = '<img src='.$id.' />';
					}
				} 
				else if(is_array($result)){
					$result = $result[0];
				}
			} 
			return $result;
		}
		else if($type=='acfrepeatertable' && function_exists('get_field')){
			$getrepeatable = get_field($field, $post_id);
			if (!empty($getrepeatable) && is_array($getrepeatable)){
				$firstrow = $getrepeatable[0];
				$titlearray = array();
				$rowcount = 0;
				while( have_rows($field, $post_id) ): the_row();
					$rowcount++;
					if($rowcount == 1){
						foreach ($firstrow as $rowkey=>$rowvalue){
							$current = get_sub_field_object($rowkey);
							$titlearray[] = $current['label'];
						}
					}
				endwhile;
				$result = '<table>';
					$result .= '<tr>';
					foreach($titlearray as $title){
						$result .= '<th>'.$title.'</th>';
					}
					$result .= '</tr>';
					foreach($getrepeatable as $item=>$value){
						$result .= '<tr>';
						foreach($value as $field){
							$result .= '<td>';
								if(is_array($field)){
									if(!empty($field['id'])){
										$result .= wp_get_attachment_image($field['id'], 'full' );
									}else{
										$result .= implode(', ', $field);
									}
								}else{
									$result .= $field;
								}
							$result .= '</td>';
						}
						$result .= '</tr>';
					}
				$result .= '</table>';
			} 
			return $result;
		}
		else{
			$result = get_post_meta($post_id, $field, true);
		}
		if($type !='acfmulti' && $type !='acfimage' && $type != 'acfrepeater' && $type != 'acfrepeatertable'){
			if(!empty($subfield) && !empty($subsubfield) && is_array($result)){
				$result = $result[$subfield][$subsubfield];
			}
			else if(!empty($subfield) && is_array($result)){
				$result = $result[$subfield];
			} 
			else if( is_array($result) && !empty($result[0])){
				$result = $result[0];
			} 
		}
		if($result){  	
			if ($icon){
				$out .= '<span class="gspb_meta_prefix_icon">'.greenshift_render_icon_module($icon).'</span>';
			}     	
			if ($prefix){
				$out .= '<span class="gspb_meta_prefix">'.esc_attr($prefix).'</span> ';
			}  
			if($showtoggle){
				$out .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="30" height="30" fill="green"><path d="M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zM227.314 387.314l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.249-16.379-6.249-22.628 0L216 308.118l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.249 16.379 6.249 22.628.001z"/></svg>';
			}else{
				$out .= '<div class="gspb_meta_value">';
				$key = '';
				if(!empty($imageMapper)){
					$key = array_search($result, $imageMapper);
					if($key){
						$out .= wp_get_attachment_image( (int)$key, 'full');
					}
				}
				if(!$key){
					if($postprocessor == 'textformat'){
						$out .= wpautop(wptexturize($result));
					}else if($postprocessor == 'ymd'){
						$date = DateTime::createFromFormat('Ymd', $result);
						$out .= $date ? wp_date( get_option( 'date_format' ), $date->format('U') ) : $result;
					}else if($postprocessor == 'ytmd'){
						$date = DateTime::createFromFormat('Y-m-d', $result);
						$out .= $date ? wp_date( get_option( 'date_format' ), $date->format('U') ) : $result;
					}else if($postprocessor == 'mailto'){
						$out .= '<a href="mailto:'.$result.'">'.$result.'</a>';
					}else if($postprocessor == 'postlink'){
						$out .= '<a href="'.get_permalink($post_id).'">'.$result.'</a>';
					}else{
						$out .= $result;
					}
				}
				$out .='</div>';
			}
			
			if ($postfix){
				$out .= '<span class="gspb_meta_postfix">'.esc_attr($postfix).'</span> ';
			} 	    	
		} 
		else{
			if($show_empty){   		
				if ($icon){
					$out .= '<span class="gspb_meta_prefix_icon">'.greenshift_render_icon_module($icon).'</span>';
				}     		
				if ($prefix){
					$out .= '<span class="gspb_meta_prefix">'.esc_attr($prefix).'</span> ';
				}
				if($showtoggle){
					$out .= '<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 512 512" fill="red"><path d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 448c-110.5 0-200-89.5-200-200S145.5 56 256 56s200 89.5 200 200-89.5 200-200 200zm101.8-262.2L295.6 256l62.2 62.2c4.7 4.7 4.7 12.3 0 17l-22.6 22.6c-4.7 4.7-12.3 4.7-17 0L256 295.6l-62.2 62.2c-4.7 4.7-12.3 4.7-17 0l-22.6-22.6c-4.7-4.7-4.7-12.3 0-17l62.2-62.2-62.2-62.2c-4.7-4.7-4.7-12.3 0-17l22.6-22.6c4.7-4.7 12.3-4.7 17 0l62.2 62.2 62.2-62.2c4.7-4.7 12.3-4.7 17 0l22.6 22.6c4.7 4.7 4.7 12.3 0 17z"/></svg>';
				}else{
					$out .= '-';
				}	    	    	   		
			}
		}   
		return $out; 
	
	}
}

//////////////////////////////////////////////////////////////////
// Smooth Mouse
//////////////////////////////////////////////////////////////////

add_action('wp_footer', 'greenshift_additional__footer_elements');
function greenshift_additional__footer_elements (){
	if(defined('GREENSHIFTGSAP_DIR_URL')){
		$sitesettings = get_option('gspb_global_settings');
		if (!empty($sitesettings['sitesettings']['mousefollow'])) {
			$color = !empty($sitesettings['sitesettings']['mousecolor']) ? $sitesettings['sitesettings']['mousecolor'] : '#2184f9';
			echo '<div class="gsmouseball"></div><div class="gsmouseballsmall"></div><style scoped>.gsmouseball{width:33px;height:33px;position:fixed;top:0;left:0;z-index:99999;border:1px solid '.esc_attr($color).';border-radius:50%;pointer-events:none;opacity:0}.gsmouseballsmall{width:4px;height:4px;position:fixed;top:0;left:0;background:'.esc_attr($color).';border-radius:50%;pointer-events:none;opacity:0; z-index:99999}</style>';
			wp_enqueue_script('gsap-mousefollow-init');
		}
	}
}

//////////////////////////////////////////////////////////////////
// Render icon for dynamic blocks
//////////////////////////////////////////////////////////////////

function greenshift_render_icon_module($attribute, $size=20){
	
	$type = !empty($attribute['type']) ? $attribute['type'] : '';
	$icon = !empty($attribute['icon']) ? $attribute['icon'] : '';

	if($type == 'image'){
		return '<img src="'.$icon['image']['url'].'" alt="Image" width="'.$size.'px" height="'.$size.'px" />';
	}else if($type == 'svg'){
		//return $icon['svg']; disable direct load as it's unsafe for dynamic fields
		return false;
	}else if($type == 'font'){
		$font = str_replace('rhicon rhi-', '', $icon['font']);
		$pathicon = '';$widthicon = '1024';
		$iconfontsaved = get_transient('gspb-dynamic-icons-render');

		if(empty($iconfontsaved[$font])){
			$icons = GREENSHIFT_DIR_PATH.'libs/iconpicker/selection.json'; 
			$iconsfile = file_get_contents($icons); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
			$iconsdecode = json_decode($iconsfile,true);
			$iconsarray = [];
			foreach ($iconsdecode['icons'] as $key=>$value){
				$name = $value['properties']['name'];
				$path = $value['icon']['paths'];
				$width = !empty($value['icon']['width']) ? $value['icon']['width'] : '';
				if($width){
					$iconsarray[$name]['width']=$width;
				}
				$iconsarray[$name]['path']=$path;
			}
			
			if(is_array($iconsarray[$font])){
				foreach ($iconsarray[$font]['path'] as $key=>$value){
					$pathicon .= '<path d="'.$value.'" />';
				}
				if(!empty($iconsarray[$font]['width'])){
					$widthicon = $iconsarray[$font]['width'];
				}
			}
			if(empty($iconfontsaved)) $iconfontsaved = [];
			$iconfontsaved[$font]['path'] = $pathicon;
			$iconfontsaved[$font]['width'] = $widthicon;
			set_transient( 'gspb-dynamic-icons-render', $iconfontsaved, 180 * DAY_IN_SECONDS );
		}
		
		return '<svg width="'.$size.'" height="'.$size.'" viewBox="0 0 '.$iconfontsaved[$font]['width'].' 1024" xmlns="http://www.w3.org/2000/svg">'.$iconfontsaved[$font]['path'].'</svg>';

	}
}

//////////////////////////////////////////////////////////////////
// Disable Lazy load on image
//////////////////////////////////////////////////////////////////

add_filter( 'wp_img_tag_add_loading_attr', 'gspb_skip_lazy_load', 10, 3 );
remove_filter( 'admin_head', 'wp_check_widget_editor_deps' );

function gspb_skip_lazy_load( $value, $image, $context ) {
	if ( strpos( $image, 'no-lazyload' ) !== false ) $value = 'eager';
	return $value;
}