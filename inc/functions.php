<?php

// front
function mbform_make_form() {
	$options = get_option ( 'mbform_option_name' );
	$hotelDestino = $options ['hotelid'];
	$action = $options ['urlmotor'];
	$noches = (isset ( $options ['noches'] )) ? $options ['noches'] : 1;
	$id = 'mbmainform';
	$method = 'GET';
	// theme a usar
	$theme = (isset ( $options ['theme'] )) ? $options ['theme'] : 'default';
	wp_enqueue_script ( 'mbform_scripts', plugins_url ( '/mbform/themes/'.$theme.'/js/scripts.js' ), array (
	'jquery',
	'jquery-ui-datepicker'
			), '1.0', true );
			wp_enqueue_style ( 'mbform_styles', plugins_url ( '/mbform/themes/'.$theme.'/css/style.css' ) );
	// palabras default
	$i18n ['titulo'] = (isset ( $options ['w_titulo'] )) ? $options ['w_titulo'] : _ ( 'RESERVE ONLINE' );
	$i18n ['titulo-confeccione'] = (isset ( $options ['w_titulo_confeccione'] )) ? $options ['w_titulo_confeccione'] : _ ( 'Haga su reserva' );
	$i18n ['cod-idioma'] = (isset ( $options ['w_codigo_idioma'] )) ? $options ['w_codigo_idioma'] : _ ( 'es' );
	$i18n ['buscar-h'] = (isset ( $options ['w_buscar'] )) ? $options ['w_buscar'] : _ ( 'CONSULTA ONLINE' );
	$i18n ['btn-llamenos'] = (isset ( $options ['w_llamenos'] )) ? $options ['w_llamenos'] : _ ( 'LLAMENOS' );
	$i18n ['c-in'] = (isset ( $options ['w_in'] )) ? $options ['w_in'] : _ ( 'Entrada' );
	$i18n ['c-out'] = (isset ( $options ['w_out'] )) ? $options ['w_out'] : _ ( 'Salida' );
	$i18n ['url-motor'] = (isset ( $options ['w_url'] )) ? $options ['w_url'] : _ ( 'es/reservas/' );
	
	// @todo analizar si se puede usar el plugin icl para tenerlo en cuenta aclarlo en el readme
	if (function_exists ( 'icl_register_string' )) {
		foreach ( $i18n as $t => $w ) {
			icl_register_string ( 'mbform', $t, $w );
			$i18n [$t] = icl_t ( 'mbform', $t, $w );
		}
	}
	
	// buscar el tema .
	//
	$html = file_get_contents ( plugin_dir_path ( __FILE__ ) . '..' . DIRECTORY_SEPARATOR . 'themes' . DIRECTORY_SEPARATOR . $theme . DIRECTORY_SEPARATOR . 'index.html' );
	$search = array (
			'{id}',
			'{action}',
			'{titulo}',
			'{subtitulo}',
			'{hotel-destino}',
			'{noches}',
			'{codigo_idioma}',
			'{campo_in}',
			'{campo_out}',
			'{submit}',
			'{url_motor}',
			'{llamenos}' 
	);
	$replace = array ( $id, $action . $i18n ['url-motor'], $i18n ['titulo'], $i18n ['titulo-confeccione'], $hotelDestino, $noches, $i18n ['cod-idioma'], $i18n['c-in'], $i18n ['c-out'], $i18n ['buscar-h'], $i18n ['direccion-motor'], $i18n ['btn-llamenos'] );
	$html = str_replace ( $search, $replace, $html );
	echo $html;
}

?>