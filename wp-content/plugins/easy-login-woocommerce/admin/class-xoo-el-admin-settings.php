<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


class Xoo_El_Admin_Settings{

	protected static $_instance = null;

	public static function get_instance(){
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function __construct(){
		$this->hooks();	
	}


	public function hooks(){

		if( current_user_can( 'manage_options' ) ){
			add_action( 'init', array( $this, 'generate_settings' ), 0 );
			add_action( 'admin_menu', array( $this, 'add_menu_pages' ) );
		}

		add_filter( 'plugin_action_links_' . XOO_EL_PLUGIN_BASENAME, array( $this, 'plugin_action_links' ) );
		add_filter( 'xoo_aff_add_fields', array( $this,'add_new_fields' ), 10, 2 );
		add_action( 'xoo_aff_field_selector', array( $this, 'customFields_addon_notice' ) );
		add_action('admin_enqueue_scripts',array($this,'enqueue_scripts'));
		add_action( 'admin_footer', array( $this, 'inline_css' ) );

		add_action( 'wp_loaded', array( $this, 'register_addons_tab' ), 20 );
		add_action('xoo_tab_page_start', array( $this, 'addon_html' ), 10, 2 );
	}

	public function register_addons_tab(){
		xoo_el_helper()->admin->register_tab( 'Add-ons', 'addon' );
	}

	public function addon_html( $tab_id, $tab_data ){
		if( xoo_el_helper()->admin->is_settings_page() && $tab_id === 'addon' ){
			xoo_el_helper()->get_template( '/admin/views/settings/add-ons.php', array(), XOO_EL_PATH );
		}
	}

	public function customFields_addon_notice( $aff ){
		if( defined( 'XOO_ELCF_VERSION' ) || $aff->plugin_slug !== 'easy-login-woocommerce' ) return;
		?>
		<a class="xoo-el-field-addon-notice" href="https://xootix.com/easy-login-for-woocommerce#sp-addons" target="__blank"><span class="dashicons dashicons-admin-links"></span> Adding custom fields is a separate add-on.</a>
		<?php
	}


	public function add_new_fields( $allow, $aff ){
		if( $aff->plugin_slug === 'easy-login-woocommerce' ) return false;
		return $allow;
	}
	

	public function generate_settings(){
		xoo_el_helper()->admin->auto_generate_settings();
	}



	/**
	 * Show action links on the plugin screen.
	 *
	 * @param	mixed $links Plugin Action links
	 * @return	array
	 */
	public function plugin_action_links( $links ) {
		$action_links = array(
			'settings' 	=> '<a href="' . admin_url( 'admin.php?page=easy-login-woocommerce-settings' ) . '">Settings</a>',
			'support' 	=> '<a href="https://xootix.com/support" target="__blank">Support</a>',
			'upgrade' 	=> '<a href="https://xootix.com/plugins/easy-login-for-woocommerce" target="__blank">Upgrade</a>',
		);

		return array_merge( $action_links, $links );
	}



	public function enqueue_scripts($hook) {

		//Enqueue Styles only on plugin settings page
		if($hook != 'login-signup-popup_page_xoo-el-fields' && !xoo_el_helper()->admin->is_settings_page() ){
			return;
		}
		
		wp_enqueue_style( 'xoo-el-admin-style', XOO_EL_URL . '/admin/assets/css/xoo-el-admin-style.css', array(), XOO_EL_VERSION, 'all' );
		wp_enqueue_script( 'xoo-el-admin-js', XOO_EL_URL . '/admin/assets/js/xoo-el-admin-js.js', array( 'jquery' ), XOO_EL_VERSION, false );
		wp_localize_script('xoo-el-admin-js','xoo_el_admin_localize',array(
			'adminurl'  => admin_url().'admin-ajax.php',
		));


	}


	public function add_menu_pages(){

		$args = array(
			'menu_title' 	=> 'Login/Signup Popup',
			'icon' 			=> 'dashicons-unlock',
			'has_submenu' 	=> true
		);

		xoo_el_helper()->admin->register_menu_page( $args );

		add_submenu_page(
			'easy-login-woocommerce-settings',
			'Fields',
			'Fields',
    		'manage_options',
    		'xoo-el-fields',
    		array( $this, 'admin_fields_page' )
    	);
	}


	//Fields page callback
	public function admin_fields_page(){
		xoo_el()->aff->admin->display_page();
	}


	//Inline CSS
	public function inline_css(){
		if( isset( $_GET['xoo_el_nav'] ) ){
			?>
			<style type="text/css">
				li#xoo_el_actions_link .accordion-section-title {
				    background-color: #007cba;
				    color: #fff;
				}
			</style>
			<?php
		}
	}


}

function xoo_el_admin_settings(){
	return Xoo_El_Admin_Settings::get_instance();
}
xoo_el_admin_settings();

?>