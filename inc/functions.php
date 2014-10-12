<?php

//front
function mbform_make_form(){
       wp_enqueue_script('mbform_scripts', plugins_url('/mbform/js/scripts.js'),array('jquery' , 'jquery-ui-datepicker'),'1.0',true);        
       wp_enqueue_style( 'mbform_styles', plugins_url('/mbform/css/style.css') );
       $options = get_option( 'mbform_option_name' );
       /**/
       $hotelDestino = $options['hotelid'];
       $action  = $options['urlmotor'];
       $noches = (isset($options['noches']))  ? $options['noches']:1;
       $id ='mbmainform';
       $method='GET';
       //palabras default
       $i18n['titulo'] = (isset($options['w_titulo'])) ? $options['w_titulo'] : _('RESERVE ONLINE')  ;
       $i18n['titulo-confeccione'] = (isset($options['w_titulo_confeccione'])) ? $options['w_titulo_confeccione']: _('Haga su reserva')  ;
	   $i18n[ 'cod-idioma'] = (isset($options['w_codigo_idioma'])) ? $options['w_codigo_idioma'] :_('es');
	   $i18n['buscar-h'] = (isset($options['w_buscar'])) ? $options['w_buscar']: _('CONSULTA ONLINE');
	   $i18n['btn-llamenos'] = (isset($options['w_llamenos'])) ? $options['w_llamenos']:_('LLAMENOS');               
	   $i18n['c-in'] =(isset($options['w_in'])) ? $options['w_in']: _('Entrada');
	   $i18n['c-out'] = (isset($options['w_out'])) ? $options['w_out']:_('Salida');
	   $i18n['url-motor'] =(isset($options['w_url'])) ? $options['w_url']: _('es/reservas/');

	   //@todo analizar si se puede usar el plugin icl para tenerlo en cuenta  aclarlo en el readme
       if(function_exists('icl_register_string')){
		foreach($i18n as $t => $w){
            icl_register_string('mbform', $t,$w);
            $i18n[$t] = icl_t('mbform', $t ,$w);
        }
       }

 echo '<div class="side-nav minimotor-widget-zone container mbresponsive">
	   	<form id="'.$id.'" action="'.$action.$i18n['url-motor'].'" target="_blank" method="'.$method.'" >
			<p id="verdispo">'.$i18n['titulo'].'</p>
			<fieldset>        
				<legend class="tpl-hidden">'.$i18n['titulo-confeccione'].'</legend>
				<input type="hidden" value="1" name="step" />
				<input type="hidden" id="hoteldestino" name="hoteldestino" value="'.$hotelDestino.'" />        
				<input type="hidden" id="cNoches" name="cNoches" value="'.$noches.'" />
				<input type="hidden" value="'.$i18n['cod-idioma'].'" name="lang" />
				<label>
					<input type="text" class="datepicker" id="fechain" name="fechain"  placeholder="'.$i18n['c-in'].'" />
				</label>
				<label>
					<input type="text" class="datepicker" id="fechaout" name="fechaout"  placeholder="'.$i18n['c-out'].'"  />        
				</label>        
				<input type="submit" class="submit" name="boton"  value="'.$i18n['buscar-h'].'" />
			</fieldset>
		</form>
		<div class="btn-mtor">
			<span class="res-btn-w">
				<a class="btn" href="'.$i18n['direccion-motor'].'">
					<i class="date_icon"></i> '.$i18n['btn-llamenos'].'
				</a>
			</span>
		</div>
	</div>';

}



?>