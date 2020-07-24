<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://palmera.ec/
 * @since      1.0.0
 *
 * @package    Wcec
 * @subpackage Wcec/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wcec
 * @subpackage Wcec/admin
 * @author     Guillermo Sornoza <guillermo@palmera.ec>
 */
class Wcec_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	private $wpsf;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version, $wpsf ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->wpsf = $wpsf;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wcec_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wcec_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wcec-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wcec_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wcec_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wcec-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function on_admin_menu(){
		$this->wpsf->add_settings_page( array(
			'parent_slug' => 'woocommerce',
			'page_title'  => __( 'Opciones WooCommerce Ecuató', 'wcec' ),
			'menu_title'  => __( 'WC Ecuató', 'wcec' ),
			'capability'  => 'manage_options',
		) );
	}

}
