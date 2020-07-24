<?php

add_filter( 'wpsf_register_settings_wcec', 'wpsf_tabbed_settings_wcec' );

function wpsf_tabbed_settings_wcec( $wpsf_settings ) {
	
	// Tabs
	$wpsf_settings['tabs'] = array(
		array(
			'id'    => 'general_tab',
			'title' => __( 'General' ),
		),
		array(
			'id'    => 'navigation_tab',
			'title' => __( 'Navegación' ),
		),
	);

	// Settings
	$wpsf_settings['sections'] = array(
		array(
			'tab_id'		=> 'general_tab',
			'section_id'    => 'general_section',
			'section_title' => 'Ajustes Generales',
			'section_order' => 10,
			'fields'        => array(
				array(
					'id'      => 'disable_postcode',
					'title'   => 'Deshabilitar Código Postal',
					'desc'    => 'Deshabilita el código postal en el checkout',
					'type'    => 'checkbox',
					'default' => 1,
				),
				array(
					'id'      => 'enable_document',
					'title'   => 'Habilitar documento de identificación',
					'desc'    => 'Solicita el documento de identificación en el checkout',
					'type'    => 'checkbox',
					'default' => 1,
				)
			),
		)
	);

	return $wpsf_settings;
}