<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://palmera.ec/
 * @since      1.0.0
 *
 * @package    Wcec
 * @subpackage Wcec/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Wcec
 * @subpackage Wcec/public
 * @author     Guillermo Sornoza <guillermo@palmera.ec>
 */
class Wcec_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version, $wpsf ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		$this->wpsf = $wpsf;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wcec-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wcec-public.js', array( 'jquery' ), $this->version, false );

	}

	public function set_ec_checkout_fields($fields){

		$disable_postcode = wpsf_get_setting('wcec', 'general_tab_general_section', 'disable_postcode');

		if ($disable_postcode == "1"){
			unset($fields['billing']['billing_postcode']);
			unset($fields['shipping']['shipping_postcode']);
		}

		unset($fields['billing']['billing_address_2']);
		unset($fields['billing']['billing_company']);
		
		unset($fields['shipping']['shipping_company']);
		unset($fields['shipping']['shipping_address_2']);

		$fields["shipping"]["shipping_first_name"]["priority"] = 10;
		$fields["shipping"]["shipping_last_name"]["priority"] = 20;
		
		$fields["shipping"]["shipping_address_1"]["priority"] = 30;
		$fields["shipping"]["shipping_address_1"]["maxlength"] = 250;

		$fields["shipping"]["shipping_country"]["priority"] = 50;
		$fields["shipping"]["shipping_state"]["priority"] = 60;
		$fields["shipping"]["shipping_city"]["priority"] = 70;

		$fields["billing"]["billing_address_1"]["priority"] = 80;
		$fields["billing"]["billing_address_1"]["maxlength"] = 250;
		
		$fields['billing']['document_type'] = array(
			'type'      => 'radio',
			'class'     => array('form-row-first document-type'),
			'required'  => true,                             // ¿El campo es obligatorio 'true' o 'false'?
			'label'     => '¿Tipo de identificación?',       // Nombre del campo
			'options'   => array ('C' => 'Cédula', 'R' => 'RUC.', 'P' => 'Pasaporte'), // Opciones del radio button
			'default'   => 'C',
			'priority'  => 1
		);

		$fields['billing']['document_number'] = array(             // Identificador del campo 
			'type'      => 'text',
			'class'     => array('form-row-last document-number'),
			'required'  => true,                            // ¿El campo es obligatorio 'true' o 'false'?
			'label'     => __('Cédula / RUC / Pasaporte'),   // Nombre del campo 
			'default'   => '',
			'priority'  => 2
		);

		return $fields;
	}

	public function wcec_states($states){

		$states['EC'] = array(
			'A' => 'Azuay',
			'B' => 'Bolívar',
			'F' => 'Cañar',
			'C' => 'Carchi',
			'H' => 'Chimborazo',
			'X' => 'Cotopaxi',
			'O' => 'El Oro',
			'E' => 'Esmeraldas',
			'W' => 'Galápagos',
			'G' => 'Guayas',
			'I' => 'Imbabura',
			'L' => 'Loja',
			'R' => 'Los Ríos',
			'M' => 'Manabí',
			'S' => 'Morona Santiago',
			'N' => 'Napo',
			'D' => 'Orellana',
			'Y' => 'Pastaza',
			'P' => 'Pichincha',
			'SE' => 'Santa Elena',
			'SD' => 'Santo Domingo',
			'U' => 'Sucumbíos',
			'T' => 'Tungurahua',
			'Z' => 'Zamora Chinchipe'
		);
		return $states;

	}

	public function country_locale_ec($locales){
		$ecVariables = array(
			'EC' => array(
				"first_name" => array (
					"priority" => 10
				),
				"last_name"=> array(
					"priority" => 20
				),
				"country" => array(
					"priority" => 30
				),
				"state" => array(
					"priority" => 40
				),
				"city" => array(
					"priority" => 50
				),
				"address_1" => array(
					"priority" => 60
				),
				"address_2" => array(
					"priority" => 70
				),
				"email" => array(
					"priority" => 80
				),
				"phone" => array(
					"priority" => 90
				)
			)
		);

		return array_merge($locales, $ecVariables);
	}

}
