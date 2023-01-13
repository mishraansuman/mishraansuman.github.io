<?php


class Optimization {

	/**
	 * This plugin's instance.
	 *
	 * @var Optimization
	 */
	private static $instance;

	/**
	 * Isallowed page Delay js
	 * Script enqueued status.
	 *
	 * @var bool
	 */
	private $is_enqueued = false;

    /**
	 * Registers the plugin.
	 *
	 * @return Optimization
	 */
	public static function register()
	{
		if (null === self::$instance) {
			self::$instance = new Optimization();
		}

		return self::$instance;
	}

	/**
	 *  constructor.
	 *
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'gs_filter_delayjs' ));
	}

	/**
	 * Checks if is allowed to Delay JS.
	 *
	 */
	public function gs_filter_delayjs() {
		if( ! is_admin() && $this->is_allowed_page() ){
			add_filter( 'script_loader_tag',  array($this,'add_id_to_script'), 10, 3 );
			add_action( 'wp_enqueue_scripts',  array( $this, 'add_delay_js_script' ));
		}
	}

	/**
	 * Checks if page is allowed to Delay JS.
	 *
	 * @return boolean
	 */
	public function is_allowed_page() {

		$gspb_gs_delay_js = get_option('gspb_gs_delay_js', false );

		if( isset( $gspb_gs_delay_js ) &&  $gspb_gs_delay_js != true ){
			return false;
		}

		$gspb_jsdelayon_page = get_option('gspb_jsdelayon_page', false );

		if( isset( $gspb_jsdelayon_page ) && !empty( $gspb_jsdelayon_page ) ){

			$allowedpagesArray = array( );

    		$current_url = home_url( $_SERVER['REQUEST_URI'] );
			
			$gs_delay_pages = get_option( 'gs_delay_pages', false );

			if(!empty( $gs_delay_pages ) ){
				$allowedpagesArray = explode( " ", $gs_delay_pages );
			}

			switch ($gspb_jsdelayon_page) {
				case "all":
					return true;
				  break;
				case "includefor":
					if (in_array($current_url, $allowedpagesArray)){
						return true;
					}
					return false;
				  break;
				case "excludefor":
					if (in_array($current_url, $allowedpagesArray)){
						return false;
					}
					return true;
				  break;
				default:
			  }
		} 

        return false;
    }

    
	/**
	 * filter out GS scripts tag and add custom attributes to all scripts
	 *
	 * @return string 
	 */
	public function add_id_to_script( $tag, $handle, $src ) {
		$is_gsscript = substr( $handle, 0, 2 );
		if( $is_gsscript === "gs" ){
		
			$tag = preg_replace_callback( '/<script\s*(?<attr>[^>]*)?>(?<content>.*)?<\/script>/Uims', [$this, 'replace_scripts'] , $tag );
		
		}

    	return $tag;
    }

	/**
	 *
	 * @param string $matches script attributes array
	 *
	 * @return string
	 */
	public function replace_scripts( $matches ) {
	
        $src             = '';
        $matches['attr'] = trim( $matches['attr'] );
    
        if ( ! empty( $matches['attr'] ) ) {
            if ( preg_match( '/src=(["\'])(.*?)\1/', $matches['attr'], $src_matches ) ) {
                $src = $src_matches[2];
    
                // Remove the src attribute.
                $matches['attr'] = str_replace( $src_matches[0], '', $matches['attr'] );
            }
        }

    
        if ( empty( $src ) ) {
            return $matches[0];
        }
    
        return "<script data-gslazyloadscript='{$src}' {$matches['attr']}></script>";
    }

	/**
	 * Adds the inline script to the footer when the option is enabled.
	 *
	 *
	 * @return void
	 */
	public function add_delay_js_script() {
		if ( $this->is_enqueued ) {
			return;
		}
		
		$js_assets_path = GREENSHIFT_DIR_PATH . '/libs/lazyloadjs/';

		// Register handle with no src to add the inline script after.
		// phpcs:ignore WordPress.WP.EnqueuedResourceParameters.NoExplicitVersion
		wp_register_script( 'gs-delay', '', [], '', true );
		wp_enqueue_script( 'gs-delay' );

		$script_filename = 'lazyload-scripts.min.js';

		wp_add_inline_script(
			'gs-delay',
			@file_get_contents( "{$js_assets_path}{$script_filename}" )
		);
		 
		$this->is_enqueued = true;
	}
}


Optimization::register();