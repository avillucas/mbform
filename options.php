<?php
class MBFormPlugin
{
	/**
	 * Holds the values to be used in the fields callbacks
	 */
	private $options;

	/**
	 * Start up
	 */
	public function __construct()
	{
		add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
		add_action( 'admin_init', array( $this, 'page_init' ) );
	}

	/**
	 * Add options page
	 */
	public function add_plugin_page()
	{
		add_options_page(
		_('Formulario de Motor de reservas'),
		_('MB Form'),
		'manage_options',
		'mbform-setting',
		array( $this, 'create_admin_page' )
		);
	}

	/**
	 * Options page callback
	 */
	public function create_admin_page()
	{
		// Set class property
		$this->options = get_option( 'mbform_option_name' );
		?>
        <div class="wrap">
            <?php screen_icon(); ?>
            <h2>MBForm Plugin page </h2>           
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'mbform_option_group' );   
                do_settings_sections( 'mbform-setting' );
                submit_button(); 
            ?>
            </form>
        </div>
        <?php
    }

    /**
     * Register and add settings
     */
    public function page_init()
    {        
        register_setting(
            'mbform_option_group', // Option group
            'mbform_option_name', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'setting_section_id', // ID
            _('MB Form configuraciones'), // Title
            array( $this, 'print_section_info' ), // Callback
            'mbform-setting' // Page
        );  

        add_settings_field(
            'hotelid', // ID
            _('Id del hotel [HOTEL ID] '), // Title 
            array( $this, 'mbform_admin_input_hotelid' ), // Callback
            'mbform-setting', // Page
            'setting_section_id'   
        );      

        add_settings_field(
            'urlmotor', 
           _('Url del motor '), // Title 
            array( $this, 'mbform_admin_input_urlmotor' ), 
            'mbform-setting', 
            'setting_section_id'
        );
        
        add_settings_field(
        'w_url',
        _('Url del nodo reservas'), // Title
        array( $this, 'mbform_admin_input_tranlate_input' ),
        'mbform-setting',
        'setting_section_id',
		array('w_url')
        		);

        add_settings_field(
        'noches',
        _('Noches default'), // Title
        array( $this, 'mbform_admin_input_noches' ),
        'mbform-setting',
        'setting_section_id'
        );
        
        
        /* traducciones */
        add_settings_field(
        'w_titulo',
        _('Titulo '), // Title
        array( $this, 'mbform_admin_input_tranlate_input' ),
        'mbform-setting',
        'setting_section_id',
			array('w_titulo')         
        		);
        
        add_settings_field(
        'w_titulo_confeccione',
        _('Subtitulo'), // Title
        array( $this, 'mbform_admin_input_tranlate_input' ),
        'mbform-setting',
        'setting_section_id',
			array('w_titulo_confeccione')         
        		);
        
        add_settings_field(
        'w_codigo_idioma',
        _('Codigo Idioma'), // Title
        array( $this, 'mbform_admin_input_tranlate_input' ),
        'mbform-setting',
        'setting_section_id',
			array('w_codigo_idioma')         
        		);
        
        add_settings_field(
        'w_buscar',
        _('Boton Buscar'), // Title
        array( $this, 'mbform_admin_input_tranlate_input' ),
        'mbform-setting',
        'setting_section_id',
			array('w_buscar')         
        		);
        
        add_settings_field(
        'w_llamenos',
        _('Boton Llamenos'), // Title
        array( $this, 'mbform_admin_input_tranlate_input' ),
        'mbform-setting',
        'setting_section_id',
			array('w_llamenos')         
        		);
        
        add_settings_field(
        'w_in',
        _('Campo In'), // Title
        array( $this, 'mbform_admin_input_tranlate_input' ),
        'mbform-setting',
        'setting_section_id',
			array('w_in')         
        		);      
      
        add_settings_field(
        'w_out',
        _('Campo Out'), // Title
        array( $this, 'mbform_admin_input_tranlate_input' ),
        'mbform-setting',
        'setting_section_id',
			array('w_out')         
        		);
        
        
        
    }
    
    public function sanitaze_traduccion($text){
    	//@todo armar la sanitizacion
    	return $text;
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
        $new_input = array();
        if( isset( $input['hotelid'] ) ){
        	$m = explode('.',trim($input['hotelid']));        	
        	$new_input['hotelid'] = intval($m[0]).'.'.intval($m[1]);
        }            

        if( isset( $input['urlmotor'] ) ){
        	//revisar que tenga el https al principio 
        	$url =sanitize_text_field( $input['urlmotor'] );
        	//sacar barras del principio y el final 
        	$url = trim($url, '/');        	 
        	//sacar el http si lo tiene y poner un https 
        	$url = str_replace(array('http://','',$url ); 
        	//revisar que tenga el https:// al principio
        	if(strpos( $url  , 'https://' )  !== FALSE){
        		$url = 'https://'.$url;
        	}
        	// si no termina en barra
        	$len = strlen($url);
        	if($url[$len-1] != '/' ){
				$url .='/';         		
        	}
        	$new_input['urlmotor'] = $url;
        }
        
        if(isset($input['w_url'])) 
        	$new_input['w_url'] = $this->sanitaze_traduccion( $input['w_url'] );
        
        if(isset($input['w_titulo']))
        	$new_input['w_titulo'] = $this->sanitaze_traduccion( $input['w_titulo'] );
        
        if(isset( $input['w_titulo_confeccione'])) 
        	$new_input['w_titulo_confeccione'] = $this->sanitaze_traduccion( $input['w_titulo_confeccione'] );
        
        if(isset( $input['w_codigo_idioma'])) 
        	$new_input['w_codigo_idioma'] = $this->sanitaze_traduccion( $input['w_codigo_idioma'] );
        
        if(isset( $input['w_buscar'])) 
        	$new_input['w_buscar'] = $this->sanitaze_traduccion( $input['w_buscar'] );
        
        if(isset( $input['w_llamenos'])) 
        	$new_input['w_llamenos'] = $this->sanitaze_traduccion( $input['w_llamenos'] );
        
        if(isset( $input['w_in'])) 
        	$new_input['w_in'] = $this->sanitaze_traduccion( $input['w_in'] );
        
        if(isset( $input['w_out'])) 
        	$new_input['w_out'] = $this->sanitaze_traduccion( $input['w_out'] );
        
        if(isset( $input['noches']))
        	$new_input['noches'] = intval( $input['noches'] );
        
        return $new_input;
    }

    /** 
     * Print the Section text
     */
    public function print_section_info()
    {
    	print _e('Defina los parametros de configuración dle minimotor , obtengalos entre los datos de instalación');
    }
    function mbform_admin_input_tranlate_input($args){
    	$campo = $args[0];
    	printf(
    	'<input type="text" id="mbform_'.$campo.'" name="mbform_option_name['.$campo.']" value="%s" />',
    	isset( $this->options[$campo] ) ? esc_attr( $this->options[$campo]) : ''
    			);
    }    
    
    function mbform_admin_input_hotelid() {
    	printf(
    	'<input type="text" id="hotelid" name="mbform_option_name[hotelid]" value="%s" />',
    	isset( $this->options['hotelid'] ) ? esc_attr( $this->options['hotelid']) : ''
    			);
    	
    }
    
    function mbform_admin_input_noches() {
    	printf(
    	'<input type="text" id="noches" name="mbform_option_name[noches]" value="%s" />',
    	isset( $this->options['noches'] ) ? esc_attr( $this->options['noches']) : ''
    			);
    	 
    }
    
    function mbform_admin_input_urlmotor() {
    	
    	printf(
    	'<input type="text" id="hotelid" name="mbform_option_name[urlmotor]" value="%s" />',
    	isset( $this->options['urlmotor'] ) ? esc_attr( $this->options['urlmotor']) : ''
    	);
    }
    
    
    
}

if( is_admin() )
    $my_settings_page = new MBFormPlugin();
else
	add_action('get_sidebar', 'mbform_make_form', 100);
