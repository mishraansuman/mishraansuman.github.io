<?php

if (!defined('ABSPATH')) {
	exit;
}

function greenshift_edd_check_all_licenses() {
	$licenses = get_option('gspb_edd_licenses');
	$res = [];
	foreach ($licenses as $plugin_key => $data) {
	  $expires = $data['expires'];
	  $res[$plugin_key] = $data['status'] === 'valid' && !empty($expires) && ($expires === 'lifetime' || (date('Y-m-d') <= date('Y-m-d', strtotime($expires)))) ? 'valid' : 'invalid';
	}
  
	return $res;
  }
  
  // if all access key is valid return it, else return addon key
  function greenshift_edd_get_license_for_addon($addon) {
	$licenses = get_option('gspb_edd_licenses');
  
	foreach ($licenses[$addon]['included_in'] as $key_pack) {
	  if($licenses[$key_pack]['status'] === 'valid') return $licenses[$key_pack]['license'];
	}
  
	return $licenses[$addon]['license'];
  }

class EddLicensePage
{
	private $licensesData = [
		'all_in_one' => [
			'plugin_id' => EDD_ALL_IN_ONE_ADDON_ID,
			'plugin_name' => EDD_ALL_IN_ONE_ADDON_NAME,
			'license_key' => 'edd_license_key_all_in_one',
			'expires_key' => 'edd_license_expires_all_in_one',
			'license_status_key' => 'edd_license_status_all_in_one',
			'license' => '',
			'status' => '',
			'expires' => '',
			'license_limit'=> '',
			'included_in' => [],
		],
		'all_in_one_seo' => [
			'plugin_id' => EDD_ALL_IN_ONE_SEO_ADDON_ID,
			'plugin_name' => EDD_ALL_IN_ONE_SEO_ADDON_NAME,
			'license_key' => 'edd_license_key_all_in_one_seo',
			'expires_key' => 'edd_license_expires_all_in_one_seo',
			'license_status_key' => 'edd_license_status_all_in_one_seo',
			'license' => '',
			'status' => '',
			'expires' => '',
			'license_limit'=> '',
			'included_in' => [],
		],
		'all_in_one_design' => [
			'plugin_id' => EDD_ALL_IN_ONE_DESIGN_ADDON_ID,
			'plugin_name' => EDD_ALL_IN_ONE_DESIGN_ADDON_NAME,
			'license_key' => 'edd_license_key_all_in_one_design',
			'expires_key' => 'edd_license_expires_all_in_one_design',
			'license_status_key' => 'edd_license_status_all_in_one_design',
			'license' => '',
			'status' => '',
			'expires' => '',
			'license_limit'=> '',
			'included_in' => [],
		],
		'woocommerce_addon' => [
			'plugin_id' => EDD_WOO_ADDON_ID,
			'plugin_name' => EDD_WOO_ADDON_NAME,
			'license_key' => 'edd_license_key_woocommerce_addon',
			'expires_key' => 'edd_license_expires_woocommerce_addon',
			'license_status_key' => 'edd_license_status_woocommerce_addon',
			'license' => '',
			'status' => '',
			'expires' => '',
			'license_limit'=> '',
			'included_in' => ['all_in_one'],
		],
		'query_addon' => [
			'plugin_id' => EDD_QUERY_ADDON_ID,
			'plugin_name' => EDD_QUERY_ADDON_NAME,
			'license_key' => 'edd_license_key_query_addon',
			'expires_key' => 'edd_license_expires_query_addon',
			'license_status_key' => 'edd_license_status_query_addon',
			'license' => '',
			'status' => '',
			'expires' => '',
			'license_limit'=> '',
			'included_in' => ['all_in_one', 'all_in_one_seo', 'all_in_one_design'],
		],
		'chart_addon' => [
			'plugin_id' => EDD_CHART_ADDON_ID,
			'plugin_name' => EDD_CHART_ADDON_NAME,
			'license_key' => 'edd_license_key_chart_addon',
			'expires_key' => 'edd_license_expires_chart_addon',
			'license_status_key' => 'edd_license_status_chart_addon',
			'license' => '',
			'status' => '',
			'expires' => '',
			'license_limit'=> '',
			'included_in' => ['all_in_one'],
		],
		'seo_addon' => [
			'plugin_id' => EDD_SEO_ADDON_ID,
			'plugin_name' => EDD_SEO_ADDON_NAME,
			'license_key' => 'edd_license_key_seo_addon',
			'expires_key' => 'edd_license_expires_seo_addon',
			'license_status_key' => 'edd_license_status_seo_addon',
			'license' => '',
			'status' => '',
			'expires' => '',
			'license_limit'=> '',
			'included_in' => ['all_in_one', 'all_in_one_seo'],
		],
		'gsap_addon' => [
			'plugin_id' => EDD_GSAP_ADDON_ID,
			'plugin_name' => EDD_GSAP_ADDON_NAME,
			'license_key' => 'edd_license_key_gsap_addon',
			'expires_key' => 'edd_license_expires_gsap_addon',
			'license_status_key' => 'edd_license_status_gsap_addon',
			'license' => '',
			'status' => '',
			'expires' => '',
			'license_limit'=> '',
			'included_in' => ['all_in_one', 'all_in_one_design'],
		],
	];

	public function __construct()
	{
		//    update_option('gspb_edd_licenses', []);
		if (!is_admin()) return false;

		$dbOptions = get_option('gspb_edd_licenses');
		if (!empty($dbOptions)) $this->licensesData = $dbOptions;
		else {
			update_option('gspb_edd_licenses', $this->licensesData);
		}

		if (!empty($_GET['page']) && $_GET['page'] === 'greenshift-license') {
			$this->edd_check_and_update_licenses();
		} else {
			//greenshift_edd_check_all_licenses();
		}

		//    add_action( 'admin_init', [$this, 'edd_check_and_update_licenses'] );
		add_action('admin_menu', [$this, 'edd_license_menu'], 999);
		add_action('admin_init', [$this, 'edd_register_option']);
		add_action('admin_init', [$this, 'edd_activate_license']);
		add_action('admin_init', [$this, 'edd_deactivate_license']);
		add_action('admin_notices', [$this, 'edd_admin_notices']);
	}

	public function edd_license_menu()
	{
		add_submenu_page(
			'greenshift_dashboard',
			__('Manage Licenses', 'greenshift-animation-and-page-builder-blocks'),
			__('Manage Licenses', 'greenshift-animation-and-page-builder-blocks'),
			'manage_options',
			EDD_GSPB_PLUGIN_LICENSE_PAGE,
			[$this, 'edd_license_page'],
			99
		);
	}

	public function edd_license_page()
	{
		add_settings_section(
			'edd_license_section',
			__('Manage Licenses', 'greenshift-animation-and-page-builder-blocks'),
			[$this, 'edd_license_key_settings_section'],
			EDD_GSPB_PLUGIN_LICENSE_PAGE
		);

		// adding fields for addons keys
		foreach ($this->licensesData as $addon_key => $data) {
			add_settings_field(
				'edd_license_key_' . $addon_key,
				'<label for="edd_license_key_' . $addon_key . '">' . $data['plugin_name'] . '</label>',
				[$this, 'edd_license_key_settings_field'],
				EDD_GSPB_PLUGIN_LICENSE_PAGE,
				'edd_license_section',
				['product' => $addon_key]
			);
		}
?>
		<div class="wrap gspb-edd-settings">
			<h2><?php esc_html_e('Plugins License Options'); ?></h2>
			<form method="post" action="options.php" class="gspb-edd-settings-form" style="padding:10px 30px; background:#fff">

				<?php
				do_settings_sections(EDD_GSPB_PLUGIN_LICENSE_PAGE);
				settings_fields('edd_license_section');
				submit_button();
				?>

			</form>
		</div>
	<?php
	}

	public function edd_license_key_settings_section()
	{
		esc_html_e('This is where you enter your license key. If you have All in one license, you can activate it without activation separate addons', 'greenshift-animation-and-page-builder-blocks');
	}

	public function edd_license_key_settings_field($args)
	{
		if($args['product'] != 'all_in_one'){
			if($this->licensesData['all_in_one']['status'] == 'valid'){
				echo '<p class="description">License: <span style="color: green;">Activated</span></p>';
				return;
			}
		}
		$license = $this->licensesData[$args['product']]['license'];
		$status  = $this->licensesData[$args['product']]['status'];
		$expires = $this->licensesData[$args['product']]['expires'];
	?>
		<p class="description"><?php esc_html_e('Enter your license key.', 'greenshift-animation-and-page-builder-blocks'); ?></p>
		<?php
		if ('valid' !== $status) {
			printf(
				'<input type="password" autocomplete="off" class="regular-text" id="edd_license_key_' . $args['product'] . '" name="edd_license_key_' . $args['product'] . '" value="%s" />',
				esc_attr($license)
			);
		}else{
			printf(
				'<input type="text" class="regular-text" value="%s" />',
				"******************"
			);
		}
		$button = array(
			'name'  => 'edd_license_deactivate_' . $args['product'],
			'label' => __('Deactivate License', 'greenshift-animation-and-page-builder-blocks'),
		);
		if ('valid' !== $status) {
			$button = array(
				'name'  => 'edd_license_activate_' . $args['product'],
				'label' => __('Activate License', 'greenshift-animation-and-page-builder-blocks'),
			);
		}
		wp_nonce_field('edd_nonce', 'edd_nonce');
		?>
		<input type="submit" class="button-secondary" name="<?php echo esc_attr($button['name']); ?>" value="<?php echo esc_attr($button['label']); ?>" />

		<p class="description">
			<?php esc_html_e('License:', 'greenshift-animation-and-page-builder-blocks') ?>
			<?php if (!empty($expires) && (date('Y-m-d') <= date('Y-m-d', strtotime($expires)) || $expires === 'lifetime') && 'valid' === $status) : ?>
				<span style="color: green;">Activated</span>
			<?php else : ?>
				<span style="color: red;">Deactivated</span>
			<?php endif; ?>
		</p>

		<?php if (!empty($expires) && date('Y-m-d') > date('Y-m-d', strtotime($expires)) && $expires !== 'lifetime') : ?>
			<p class="description">
				<span style="color: red;"><?php esc_html_e('This license is expired', 'greenshift-animation-and-page-builder-blocks') ?></span>
			</p>
		<?php endif; ?>

		<?php if (!empty($expires) && 'valid' === $status) : ?>
			<p class="description"><?php esc_html_e('Expires:', 'greenshift-animation-and-page-builder-blocks') ?> <?php echo esc_html($expires); ?></p>
		<?php endif; ?>
		<?php
	}

	/**
	 * Registers the license key setting in the options table.
	 *
	 * @return void
	 */
	public function edd_register_option()
	{
		register_setting('edd_license_section', 'gspb_edd_licenses', function ($new) {

			foreach ($this->licensesData as $key => $data) {
				if(isset($_POST[$data['license_key']])){
					if ($data['license'] && $data['license'] !== $_POST[$data['license_key']]) {
						$this->deactivate_license($data['license'], $data['plugin_id'], $data['plugin_name']);
	
						$this->licensesData[$key]['status'] = '';
						$this->licensesData[$key]['expires'] = '';
					}
					$this->licensesData[$key]['license'] = $_POST[$data['license_key']];
				}
			}

			return $this->licensesData;
		});
	}

	/**
	 * Activates the license key.
	 *
	 * @return void
	 */
	public function edd_activate_license()
	{

		if (!empty($_POST['edd_license_activate_query_addon'])) {
			$dataKey = 'query_addon';
		} else if (!empty($_POST['edd_license_activate_woocommerce_addon'])) {
			$dataKey = 'woocommerce_addon';
		} else if (!empty($_POST['edd_license_activate_chart_addon'])) {
			$dataKey = 'chart_addon';
		} else if (!empty($_POST['edd_license_activate_seo_addon'])) {
			$dataKey = 'seo_addon';
		} else if (!empty($_POST['edd_license_activate_gsap_addon'])) {
			$dataKey = 'gsap_addon';
		} else if (!empty($_POST['edd_license_activate_all_in_one'])) {
			$dataKey = 'all_in_one';
		} else if (!empty($_POST['edd_license_activate_all_in_one_seo'])) {
			$dataKey = 'all_in_one_seo';
		} else if (!empty($_POST['edd_license_activate_all_in_one_design'])) {
			$dataKey = 'all_in_one_design';
		} else {
			return;
		}

		// run a quick security check
		if (!check_admin_referer('edd_nonce', 'edd_nonce')) {
			return; // get out if we didn't click the Activate button
		}

		// retrieve the license from the database
		$license = $this->licensesData[$dataKey]['license'];
		$license_key = $this->licensesData[$dataKey]['license_key'];

		if (!$license) {
			$license = !empty($_POST[$license_key]) ? sanitize_text_field($_POST[$license_key]) : '';
		}
		if (!$license) {
			return;
		}

		// data to send in our API request
		$api_params = array(
			'edd_action'  => 'activate_license',
			'license'     => $license,
			'item_id'     => $this->licensesData[$dataKey]['plugin_id'],
			'item_name'   => rawurlencode($this->licensesData[$dataKey]['plugin_name']), // the name of our product in EDD
			'url'         => home_url(),
			'environment' => function_exists('wp_get_environment_type') ? wp_get_environment_type() : 'production',
		);

		// Call the custom API.
		$response = wp_remote_post(
			EDD_GSPB_STORE_URL,
			array(
				'timeout'   => 15,
				'sslverify' => false,
				'body'      => $api_params,
			)
		);

		// make sure the response came back okay
		if (is_wp_error($response) || 200 !== wp_remote_retrieve_response_code($response)) {

			if (is_wp_error($response)) {
				$message = $response->get_error_message();
			} else {
				$message = __('An error occurred, please try again.');
			}
		} else {

			$license_data = json_decode(wp_remote_retrieve_body($response));

			if (false === $license_data->success) {

				switch ($license_data->error) {

					case 'expired':
						$message = sprintf(
							/* translators: the license key expiration date */
							__('Your license key expired on %s.', 'greenshift-animation-and-page-builder-blocks'),
							date_i18n(get_option('date_format'), strtotime($license_data->expires, current_time('timestamp')))
						);
						break;

					case 'disabled':
					case 'revoked':
						$message = __('Your license key has been disabled.', 'greenshift-animation-and-page-builder-blocks');
						break;

					case 'missing':
						$message = __('Invalid license.', 'greenshift-animation-and-page-builder-blocks');
						break;

					case 'invalid':
					case 'site_inactive':
						$message = __('Your license is not active for this URL.', 'greenshift-animation-and-page-builder-blocks');
						break;

					case 'item_name_mismatch':
						/* translators: the plugin name */
						$message =  __('This appears to be an invalid license key for %s.', 'greenshift-animation-and-page-builder-blocks');
						break;

					case 'no_activations_left':
						$message = __('Your license key has reached its activation limit.', 'greenshift-animation-and-page-builder-blocks');
						break;

					default:
						$message = __('An error occurred, please try again.', 'greenshift-animation-and-page-builder-blocks');
						break;
				}
			}
		}

		// Check if anything passed on a message constituting a failure
		if (!empty($message)) {
			$redirect = add_query_arg(
				array(
					'page'          => EDD_GSPB_PLUGIN_LICENSE_PAGE,
					'sl_activation' => 'false',
					'message'       => rawurlencode($message),
				),
				admin_url('admin.php?page=' . EDD_GSPB_PLUGIN_LICENSE_PAGE)
			);

			wp_safe_redirect($redirect);
			exit();
		}

		if ('valid' === $license_data->license) {
			$this->licensesData[$dataKey]['expires'] = $license_data->expires;
			$this->licensesData[$dataKey]['status'] = $license_data->license;
			$this->licensesData[$dataKey]['license_limit'] = $license_data->license_limit;
			update_option('gspb_edd_licenses', $this->licensesData);
		}

		wp_safe_redirect(admin_url('admin.php?page=' . EDD_GSPB_PLUGIN_LICENSE_PAGE));
		exit();
	}

	/**
	 * Deactivates the license key.
	 * This will decrease the site count.
	 *
	 * @return void
	 */
	public function edd_deactivate_license()
	{
		// listen for our activate button to be clicked
		if (
			isset($_POST['edd_license_deactivate_query_addon']) ||
			isset($_POST['edd_license_deactivate_woocommerce_addon']) ||
			isset($_POST['edd_license_deactivate_all_in_one']) ||
			isset($_POST['edd_license_deactivate_chart_addon']) ||
			isset($_POST['edd_license_deactivate_seo_addon']) ||
			isset($_POST['edd_license_deactivate_gsap_addon']) ||
			isset($_POST['edd_license_deactivate_all_in_one_seo']) ||
			isset($_POST['edd_license_deactivate_all_in_one_design'])
		) {

			if (!empty($_POST['edd_license_deactivate_query_addon'])) {
				$dataKey = 'query_addon';
			} else if (!empty($_POST['edd_license_deactivate_woocommerce_addon'])) {
				$dataKey = 'woocommerce_addon';
			} else if (!empty($_POST['edd_license_deactivate_chart_addon'])) {
				$dataKey = 'chart_addon';
			} else if (!empty($_POST['edd_license_deactivate_seo_addon'])) {
				$dataKey = 'seo_addon';
			} else if (!empty($_POST['edd_license_deactivate_gsap_addon'])) {
				$dataKey = 'gsap_addon';
			} else if (!empty($_POST['edd_license_deactivate_all_in_one'])) {
				$dataKey = 'all_in_one';
			} else if (!empty($_POST['edd_license_deactivate_all_in_one_seo'])) {
				$dataKey = 'all_in_one_seo';
			} else if (!empty($_POST['edd_license_deactivate_all_in_one_design'])) {
				$dataKey = 'all_in_one_design';
			}

			// run a quick security check
			if (!check_admin_referer('edd_nonce', 'edd_nonce')) {
				return; // get out if we didn't click the Activate button
			}

			$response = $this->deactivate_license($this->licensesData[$dataKey]['license'], $this->licensesData[$dataKey]['plugin_id'], $this->licensesData[$dataKey]['plugin_name']);

			// decode the license data
			$license_data = json_decode(wp_remote_retrieve_body($response));

			// $license_data->license will be either "deactivated" or "failed"
			if ('deactivated' === $license_data->license) {
				$this->licensesData[$dataKey]['expires'] = '';
				$this->licensesData[$dataKey]['status'] = '';
				update_option('gspb_edd_licenses', $this->licensesData);
			}

			wp_safe_redirect(admin_url('admin.php?page=' . EDD_GSPB_PLUGIN_LICENSE_PAGE));
			exit();
		}
	}

	public function deactivate_license($license, $plugin_id, $plugin_name)
	{
		// data to send in our API request
		$api_params = array(
			'edd_action'  => 'deactivate_license',
			'license'     => $license,
			'item_id'     => $plugin_id,
			'item_name'   => rawurlencode($plugin_name), // the name of our product in EDD
			'url'         => home_url(),
			'environment' => function_exists('wp_get_environment_type') ? wp_get_environment_type() : 'production',
		);

		// Call the custom API.
		$response = wp_remote_post(
			EDD_GSPB_STORE_URL,
			array(
				'timeout'   => 15,
				'sslverify' => false,
				'body'      => $api_params,
			)
		);

		// make sure the response came back okay
		if (is_wp_error($response) || 200 !== wp_remote_retrieve_response_code($response)) {

			if (is_wp_error($response)) {
				$message = $response->get_error_message();
			} else {
				$message = __('An error occurred, please try again.');
			}

			$redirect = add_query_arg(
				array(
					'page' => EDD_GSPB_PLUGIN_LICENSE_PAGE,
					'sl_activation' => 'false',
					'message' => rawurlencode($message),
				),
				admin_url('admin.php?page=' . EDD_GSPB_PLUGIN_LICENSE_PAGE)
			);

			wp_safe_redirect($redirect);
			exit();
		}

		return $response;
	}

	public function edd_check_license($license, $plugin_id, $plugin_name)
	{
		$api_params = array(
			'edd_action'  => 'check_license',
			'license'     => $license,
			'item_id'     => $plugin_id,
			'item_name'   => rawurlencode($plugin_name),
			'url'         => home_url(),
			'environment' => function_exists('wp_get_environment_type') ? wp_get_environment_type() : 'production',
		);

		// Call the custom API.
		$response = wp_remote_post(
			EDD_GSPB_STORE_URL,
			array(
				'timeout'   => 15,
				'sslverify' => false,
				'body'      => $api_params,
			)
		);

		if (is_wp_error($response)) {
			return false;
		}

		return json_decode(wp_remote_retrieve_body($response));
	}

	public function edd_check_and_update_licenses()
	{

		foreach ($this->licensesData as $plugin_key => $data) {
			if (!$data['status']) continue;

			$license_data = $this->edd_check_license($data['license'], $data['plugin_id'], $data['plugin_name']);

			switch ($license_data->license) {
				case 'invalid':
					$this->licensesData[$plugin_key]['expires'] = '';
					$this->licensesData[$plugin_key]['status'] = '';
					break;
				case 'expired':
					$this->licensesData[$plugin_key]['expires'] = $license_data->expires;
					$this->licensesData[$plugin_key]['status'] = '';
					break;
				case 'inactive':
					$this->licensesData[$plugin_key]['expires'] = '';
					$this->licensesData[$plugin_key]['status'] = '';
					break;
				case 'disabled':
					$licenses_data[$plugin_key]['expires'] = $license_data->expires;
					$licenses_data[$plugin_key]['status'] = $license_data->license;
					break;
				default:
					$this->licensesData[$plugin_key]['expires'] = $license_data->expires;
					break;
			}
		}
		update_option('gspb_edd_licenses', $this->licensesData);
	}

	static function edd_check_and_update_licenses_static() {
		$licenses_data = [];
		$dbOptions = get_option('gspb_edd_licenses');
	
		if(empty($dbOptions)) return false;
	
		$licenses_data = $dbOptions;
	
		foreach ($licenses_data as $plugin_key => $data){
		  if(!$data['status']) continue;
	
		  $api_params = array(
			'edd_action'  => 'check_license',
			'license'     => $data['license'],
			'item_id'     => $data['plugin_id'],
			'item_name'   => rawurlencode( $data['plugin_name'] ),
			'url'         => home_url(),
			'environment' => function_exists( 'wp_get_environment_type' ) ? wp_get_environment_type() : 'production',
		  );
	
		  // Call the custom API.
		  $response = wp_remote_post(
			EDD_GSPB_STORE_URL,
			array(
			  'timeout'   => 15,
			  'sslverify' => false,
			  'body'      => $api_params,
			)
		  );
	
		  if ( is_wp_error( $response ) ) {
			return false;
		  }
	
		  $license_data = json_decode( wp_remote_retrieve_body( $response ) );
	
		  switch ($license_data->license){
			case 'invalid':
			  $licenses_data[$plugin_key]['expires'] = '';
			  $licenses_data[$plugin_key]['status'] = '';
			  break;
			case 'expired':
			  $licenses_data[$plugin_key]['expires'] = $license_data->expires;
			  $licenses_data[$plugin_key]['status'] = '';
			  break;
			case 'inactive':
			  $licenses_data[$plugin_key]['expires'] = '';
			  $licenses_data[$plugin_key]['status'] = '';
			  break;
			case 'disabled':
			  $licenses_data[$plugin_key]['expires'] = $license_data->expires;
			  $licenses_data[$plugin_key]['status'] = $license_data->license;
			  break;
			default:
			  $licenses_data[$plugin_key]['expires'] = $license_data->expires;
			  break;
		  }
		}
	
		update_option('gspb_edd_licenses', $licenses_data);
	  }

	/**
	 * This is a means of catching errors from the activation method above and displaying it to the customer
	 */
	public function edd_admin_notices()
	{
		if (isset($_GET['sl_activation']) && !empty($_GET['message'])) {

			switch ($_GET['sl_activation']) {

				case 'false':
					$message = urldecode($_GET['message']);
		?>
					<div class="error">
						<p><?php echo wp_kses_post($message); ?></p>
					</div>
				<?php
					break;

				case 'true':
				default:
				?>
					<div class="updated">
						<p><?php esc_html_e('Activated succesfull.', 'greenshift-animation-and-page-builder-blocks') ?></p>
					</div>
<?php
					// Developers can put a custom success message here for when activation is successful if they way.
					break;
			}
		}
	}
}

//////////////////////////////////////////////////////////////////
// Schedule events
//////////////////////////////////////////////////////////////////
add_action( 'wp', 'greenshift_add_cron_event' );
add_action( 'greenshift_check_cron_hook', 'greenshift_check_cron_exec' );
function greenshift_check_cron_exec(){
	EddLicensePage::edd_check_and_update_licenses_static();
}
function greenshift_add_cron_event(){
	if ( ! wp_next_scheduled( 'greenshift_check_cron_hook' ) ) {
		wp_schedule_event( time(), 'daily', 'greenshift_check_cron_hook' );
	}
}