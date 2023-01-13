<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
	exit;
}

if (!class_exists('GreenshiftMenuSettings')) {
	class GreenshiftMenuSettings
	{

		public function __construct()
		{
			add_action('admin_menu', array($this, 'greenshift_admin_page'));

			add_action('wp_footer', array($this, 'greenshift_show_footer_scripts'));
			add_action('wp_head', array($this, 'greenshift_show_header_settings'));
			add_action('block_editor_settings_all', array($this, 'greenshift_show_editor_header_settings'));
		}

		public function greenshift_show_header_settings()
		{
			$global_settings = get_option('greenshift_theme_options');
			if (!empty($global_settings['custom_css'])) {
				echo '<style>' . wp_unslash($global_settings['custom_css']) . '</style>';
			}

			//Custom Fonts
			$global_settings = get_option('greenshift_theme_options');
			$primaryfont = !empty($global_settings['primary_font']) ? $global_settings['primary_font'] : '';
			$secondaryfont = !empty($global_settings['secondary_font']) ? $global_settings['secondary_font'] : '';
			$tertiaryfont = !empty($global_settings['tertiary_font']) ? $global_settings['tertiary_font'] : '';
			if($primaryfont == 'variable' || $secondaryfont == 'variable' || $secondaryfont == 'variable'){
				echo '<style>@font-face{font-family:"Mona Sans";src:url('.GREENSHIFT_THEME_DIR.'/assets/fonts/Mona/MonaSans.woff2) format("woff2 supports variations"),url('.GREENSHIFT_THEME_DIR.'/assets/fonts/Mona/MonaSans.woff2) format("woff2-variations");font-weight:200 900;font-stretch:75% 125%}</style>';
			}
			if($primaryfont == 'variable'){
				$primaryfont = "Mona Sans";
			}
			if($secondaryfont == 'variable'){
				$secondaryfont = "Mona Sans";
			}
			if($tertiaryfont == 'variable'){
				$tertiaryfont = "Mona Sans";
			}
			if($primaryfont || $secondaryfont || $tertiaryfont){
				$primary = $primaryfont ? '--greenshift-primary-fontfamily:' . wp_unslash($primaryfont).';' : '';
				$secondary = $secondaryfont ? '--greenshift-secondary-fontfamily:' . wp_unslash($secondaryfont).';' : '';
				$tertiary = $tertiaryfont ? '--greenshift-tertiary-fontfamily:' . wp_unslash($tertiaryfont).';' : '';
				echo '<style>body{'.$primary.$secondary.$tertiary.'}</style>';
			}

			if (!empty($global_settings['custom_code_in_head'])) {
				echo wp_kses(wp_unslash($global_settings['custom_code_in_head']), [
					'meta' => [
						'charset' => [],
						'content' => [],
						'http-equiv' => [],
						'name' => [],
					]
				]);
			}
		}

		public function greenshift_show_editor_header_settings($settings)
		{
			$global_settings = get_option('greenshift_theme_options');
			$primaryfont = !empty($global_settings['primary_font']) ? $global_settings['primary_font'] : '';
			$secondaryfont = !empty($global_settings['secondary_font']) ? $global_settings['secondary_font'] : '';
			$tertiaryfont = !empty($global_settings['tertiary_font']) ? $global_settings['tertiary_font'] : '';
			if($primaryfont == 'variable' || $secondaryfont == 'variable' || $secondaryfont == 'variable'){
				$settings['styles'][] = array( 'css' => '@font-face{font-family:"Mona Sans";src:url('.GREENSHIFT_THEME_DIR.'/assets/fonts/Mona/MonaSans.woff2) format("woff2 supports variations"),url('.GREENSHIFT_THEME_DIR.'/assets/fonts/Mona/MonaSans.woff2) format("woff2-variations");font-weight:200 900;font-stretch:75% 125%}' );
			}
			if($primaryfont == 'variable'){
				$primaryfont = "Mona Sans";
			}
			if($secondaryfont == 'variable'){
				$secondaryfont = "Mona Sans";
			}
			if($tertiaryfont == 'variable'){
				$tertiaryfont = "Mona Sans";
			}
			if($primaryfont || $secondaryfont || $tertiaryfont){
				$primary = $primaryfont ? '--greenshift-primary-fontfamily:' . wp_unslash($primaryfont).';' : '';
				$secondary = $secondaryfont ? '--greenshift-secondary-fontfamily:' . wp_unslash($secondaryfont).';' : '';
				$tertiary = $tertiaryfont ? '--greenshift-tertiary-fontfamily:' . wp_unslash($tertiaryfont).';' : '';
				$settings['styles'][] = array( 'css' => 'body{'.$primary.$secondary.$tertiary.'}' );
			}
			return $settings;
		}

		public function greenshift_show_footer_scripts()
		{
			$global_settings = get_option('greenshift_theme_options');
			if (!empty($global_settings['custom_js'])) {
				echo '<script>' . wp_unslash($global_settings['custom_js']) . '</script>';
			}
			if (!empty($global_settings['custom_code_before_closed_body'])) {
				echo wp_kses_post($global_settings['custom_code_before_closed_body']);
			}
			if(!empty($global_settings['backtotop'])){
				wp_enqueue_script('greenshift-totop-init');
			}
			if(!empty($global_settings['progressbar']) && is_singular('post')){
				wp_enqueue_script('greenshift-progressbar');
			}
		}

		public function greenshift_admin_page()
		{

			add_theme_page(
				'GreenShift Theme Options',
				'Theme Options',
				'edit_theme_options',
				'greenshifttheme_settings',
				array($this, 'themeoptions_page')
			);

		}

		public function themeoptions_page()
		{

			if (!current_user_can('edit_theme_options')) {
				wp_die('Unauthorized user');
			}

			// Get the active tab from the $_GET param
			$default_tab = null;
			$tab         = isset($_GET['tab']) ? sanitize_text_field($_GET['tab']) : $default_tab;

?>
			<div class="wrap">
				<style>
					.wrap {
						background: white;
						max-width: 900px;
						margin: 2.5em auto;
						border: 1px solid #dbdde2;
						box-shadow: 0 10px 20px #ececec;
						text-align: center
					}

					.wrap .notice,
					.wrap .error {
						display: none
					}

					.wrap h2 {
						font-size: 1.5em;
						margin-bottom: 1em;
						font-weight: bold;
						padding: 15px;
						background: #f4f4f4;
					}

					.gs-introtext {
						font-size: 14px;
						max-width: 500px;
						margin: 0 auto 50px auto
					}

					.gs-intro-video iframe {
						box-shadow: 10px 10px 20px rgb(0 0 0 / 15%);
					}

					.gs-intro-video {
						margin-bottom: 40px
					}

					.wrap h1 {
						text-align: left;
						padding: 15px 20px;
						margin: -1px -1px 0px -1px;
						font-size: 13px;
						font-weight: bold;
						text-transform: uppercase;
						box-shadow: 0 3px 8px rgb(0 0 0 / 5%);
					}

					.gs-padd {
						padding: 25px;
						text-align: left;
						background-color: #fbfbfb
					}

					.rtl .gs-padd {
						text-align: right
					}

					.wp-core-ui .button-primary {
						background-color: #2184f9
					}

					.nav-tab-active,
					.nav-tab-active:focus,
					.nav-tab-active:focus:active,
					.nav-tab-active:hover {
						border-bottom: 1px solid #fbfbfb;
						background: #fbfbfb;
					}

					.nav-tab-wrapper {
						padding-left: 20px
					}

					.wrap .fs-notice {
						margin: 0 25px 35px 25px !important
					}

					.wrap .fs-plugin-title {
						display: none !important
					}
				</style>
				<h1><?php echo esc_html(get_admin_page_title()); ?></h1>

				<div class="tab-content gs-padd">
					<?php
							$global_settings = get_option('greenshift_theme_options');
							$sitesettings = get_option('gspb_global_settings');
							$localfont = (!empty($sitesettings['localfont'])) ? json_decode($sitesettings['localfont'], true) : array();

							if (isset($_POST['greenshift_save_theme_settings'])) {
								if (!wp_verify_nonce($_POST['greenshift_settings_field'], 'greenshift_settings_page_action')) {
									esc_html_e("Sorry, your nonce did not verify.", 'greenshift');
									return;
								}

								$global_settings['primary_font'] = !empty($_POST['primary_font']) ? sanitize_text_field($_POST['primary_font']) : '';
								$global_settings['secondary_font'] = !empty($_POST['secondary_font']) ? sanitize_text_field($_POST['secondary_font']) : '';
								$global_settings['tertiary_font'] = !empty($_POST['tertiary_font']) ? sanitize_text_field($_POST['tertiary_font']) : '';
								
								$global_settings['progressbar'] = !empty($_POST['progressbar']) ? sanitize_text_field($_POST['progressbar']) : '';
								$global_settings['backtotop'] = !empty($_POST['backtotop']) ? sanitize_text_field($_POST['backtotop']) : '';

								$global_settings['custom_css'] = wp_unslash($_POST['custom_css']);
								$global_settings['custom_js'] = wp_unslash($_POST['custom_js']);
								$global_settings['custom_code_in_head'] = wp_kses(wp_unslash($_POST['custom_code_in_head']), [
									'meta' => [
										'charset' => [],
										'content' => [],
										'http-equiv' => [],
										'name' => [],
									]
								]);
								$global_settings['custom_code_before_closed_body'] = wp_kses_post(wp_unslash($_POST['custom_code_before_closed_body']));

								update_option('greenshift_theme_options', $global_settings);
							}

							$primary_font = !empty($global_settings['primary_font']) ? wp_filter_kses($global_settings['primary_font']) : '';
							$secondary_font = !empty($global_settings['secondary_font']) ? wp_filter_kses($global_settings['secondary_font']) : '';
							$tertiary_font = !empty($global_settings['tertiary_font']) ? wp_filter_kses($global_settings['tertiary_font']) : '';

							$progressbar = !empty($global_settings['progressbar']) ? esc_attr($global_settings['progressbar']) : '';
							$backtotop = !empty($global_settings['backtotop']) ? esc_attr($global_settings['backtotop']) : '';

							$custom_css = !empty($global_settings['custom_css']) ? wp_unslash($global_settings['custom_css']) : '';
							$custom_js = !empty($global_settings['custom_js']) ? wp_unslash($global_settings['custom_js']) : '';
							$custom_code_in_head = !empty($global_settings['custom_code_in_head']) ? wp_unslash($global_settings['custom_code_in_head']) : '';
							$custom_code_before_closed_body = !empty($global_settings['custom_code_before_closed_body']) ? wp_unslash($global_settings['custom_code_before_closed_body']) : '';
							?>
								<div class="greenshift_settings_form">
									<form method="POST">
										<?php wp_nonce_field('greenshift_settings_page_action', 'greenshift_settings_field'); ?>
										<h2><?php esc_html_e("Font Options", 'greenshift'); ?></h2>
										<table class="form-table">
											<tr>
												<th> <label for="primary_font"><?php esc_html_e("Primary Font family", 'greenshift'); ?></label> </th>
												<td>
													<select
														id="primary_font"
														name="primary_font"
													>
														<option value="" <?php selected( $primary_font, '' ); ?>>System
														</option>
														<option value="variable" <?php selected( $primary_font, 'variable' ); ?>>
															Variable Mona Sans
														</option>
														<?php if(!empty($localfont)):?>
															<?php foreach( $localfont as $index=>$value) :?>
																<?php $font = wp_filter_kses($index);?>
																<option value="<?php echo wp_filter_kses($index);?>" <?php selected( $primary_font, $font ); ?>>
																	<?php echo wp_filter_kses($index);?>
																</option>
															<?php endforeach;?>
														<?php endif;?>
													</select>
												</td>
											</tr>
											<tr>
												<th> <label for="secondary_font"><?php esc_html_e("Secondary Font family", 'greenshift'); ?></label> </th>
												<td>
													<select
														id="secondary_font"
														name="secondary_font"
													>
														<option value="" <?php selected( $secondary_font, '' ); ?>>System
														</option>
														<option value="variable" <?php selected( $secondary_font, 'variable' ); ?>>
															Variable Mona Sans
														</option>
														<?php if(!empty($localfont)):?>
															<?php foreach( $localfont as $index=>$value) :?>
																<?php $font = wp_filter_kses($index);?>
																<option value="<?php echo wp_filter_kses($index);?>" <?php selected( $secondary_font, $font ); ?>>
																	<?php echo wp_filter_kses($index);?>
																</option>
															<?php endforeach;?>
														<?php endif;?>
													</select>
												</td>
											</tr>
											<tr>
												<th> <label for="tertiary_font"><?php esc_html_e("Tertiary Font family", 'greenshift'); ?></label> </th>
												<td>
													<select
														id="tertiary_font"
														name="tertiary_font"
													>
														<option value="" <?php selected( $tertiary_font, '' ); ?>>System
														</option>
														<option value="variable" <?php selected( $tertiary_font, 'variable' ); ?>>
															Variable Mona Sans
														</option>
														<?php if(!empty($localfont)):?>
															<?php foreach( $localfont as $index=>$value) :?>
																<?php $font = wp_filter_kses($index);?>
																<option value="<?php echo wp_filter_kses($index);?>" <?php selected( $tertiary_font, $font ); ?>>
																	<?php echo wp_filter_kses($index);?>
																</option>
															<?php endforeach;?>
														<?php endif;?>
													</select>
												</td>
											</tr>
										</table>
										<h2><?php esc_html_e("Dynamic Options", 'greenshift'); ?></h2>
										<table class="form-table">
											<tr>
												<th> <label for="progressbar"><?php esc_html_e("Progress Bar", 'greenshift'); ?></label> </th>
												<td>
													<input type="checkbox" name="progressbar" <?php checked( $progressbar, 'on' ) ?> /> <?php esc_html_e( 'Yes', 'greenshift' );?>
												</td>
											</tr>
											<tr>
												<th> <label for="backtotop"><?php esc_html_e("Back to Top button", 'greenshift'); ?></label> </th>
												<td>
													<input type="checkbox" name="backtotop" <?php checked( $backtotop, 'on' ) ?> /> <?php esc_html_e( 'Yes', 'greenshift' );?>
												</td>
											</tr>

										</table>
										<h2></h2>
										<table class="form-table">
											<tr>
												<th> <label for="css_system"><?php esc_html_e("Custom CSS", 'greenshift'); ?></label> </th>
												<td>
													<textarea name="custom_css" id="" cols="30" rows="10" style="width: 100%"><?php echo $custom_css ?></textarea>
												</td>
											</tr>
											<tr>
												<th> <label for="css_system"><?php esc_html_e("Custom JS", 'greenshift'); ?></label> </th>
												<td>
													<textarea name="custom_js" id="" cols="30" rows="10" style="width: 100%"><?php echo $custom_js ?></textarea>
												</td>
											</tr>
											<tr>
												<th> <label for="css_system"><?php esc_html_e("Custom code in head section", 'greenshift'); ?></label> </th>
												<td>
													<textarea name="custom_code_in_head" id="" cols="30" rows="10" style="width: 100%"><?php echo $custom_code_in_head ?></textarea>
												</td>
											</tr>
											<tr>
												<th> <label for="css_system"><?php esc_html_e("Custom code before closed Body", 'greenshift'); ?></label> </th>
												<td>
													<textarea name="custom_code_before_closed_body" id="" cols="30" rows="10" style="width: 100%"><?php echo $custom_code_before_closed_body ?></textarea>
												</td>
											</tr>
										</table>
										<div style="margin-top:20px"></div>
										<input type="submit" name="greenshift_save_theme_settings" value="<?php esc_attr_e("Save settings", "greenshift"); ?>" class="button button-primary button-large">
									</form>
								</div>
							<?php
					?>
				</div>
			</div>
		<?php
		}

		public function welcome_page()
		{
		?>
			<div class="wrap gspb_welcome_div_container">
				<style>
					.wrap {
						background: white;
						max-width: 900px;
						margin: 2.5em auto;
						border: 1px solid #dbdde2;
						box-shadow: 0 10px 20px #ececec;
						text-align: center
					}

					.wrap .notice,
					.wrap .error {
						display: none
					}

					.wrap h2 {
						font-size: 1.5em;
						margin-bottom: 1em;
						font-weight: bold
					}

					.wrap h1 {
						text-align: left;
						padding: 15px 20px;
						margin: -1px -1px 0 -1px;
						font-size: 13px;
						font-weight: bold;
						text-transform: uppercase;
						box-shadow: 0 3px 8px rgb(0 0 0 / 5%);
					}

					.wrap .fs-notice {
						margin: 0 25px 25px 25px !important
					}

					.wrap .fs-plugin-title {
						display: none !important
					}

					.gs-padd {
						padding: 25px
					}

					.gs-introtext {
						font-size: 14px;
						max-width: 500px;
						margin: 10px auto 10px auto;
					}

					.gs-padd video {
						max-width: 200px;
						margin-bottom: 15px;
					}
				</style>
				<h1><?php esc_html_e("Thank you for using Greenshift Theme.", 'greenshift'); ?></h1>
				<div class="gs-padd">
					<img src="<?php echo GREENSHIFT_THEME_DIR ?>/assets/img/logo_300.svg" alt="GS theme" width="75" height="75">

					<p class="gs-introtext"><?php esc_html_e("Thank you for using Greenshift Theme.", 'greenshift'); ?></p>
					<p class="gs-introtext"><a href="<?php echo admin_url('admin.php?page=greenshifttheme_settings'); ?>"><?php esc_html_e("Start from Settings", 'greenshift'); ?></a></p>
				</div>
			</div>
		<?php
		}
	}
}
?>