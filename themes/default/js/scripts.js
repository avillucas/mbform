var Entorno = {  
		opt : {
			step:1,
			staticServer:'/',
			codigoIdioma: 'es',		
			searchForm : null,		
			i18n:{
				atencion:'Atenci&oacute;n',
				completeInOut:'Complete el campo In y Out',
				maxHabitaciones:'El maximo de habitaciones [nombre_habitacion] por reserva es de [max] . Por favor corrija la seleccion .<em > Por reservas de grupo comunicarse con el hotel </em>',
				maxHabitacionesCliente:'El maximo de habitaciones [nombre_habitacion] en tarifa convenio por reserva es de [max] . Por favor corrija la seleccion .<em > Por reservas de grupo comunicarse con el hotel </em>',
				maxHabitacionesXReserva:'Se aceptan  <strong> hasta [max]  habitaciones por reserva </strong> '
			}
		},
cargarDatepickers: function (form){		
		// definiendo el idioma de los datepickers		
		this.setDatepickerLang(Entorno.opt.codigoIdioma);		
		/* cargando los datepickers anidados */
		jQuery('#fechain',form).datepicker({
			// la fecha minima es hoy 
			minDate: new Date(),
			//el formato de la fecha tendrias que atarlo al idioma (es | pt : dd-mm-yy  , en : mm-dd-yy ) tene en cuenta que para el ingles tenes que reformatearlo a dd-mm-yy antes de pasarlo por url 
			dateFormat:"dd-mm-yy",
			// cantidad de meses que se muestran por calendario 
			numberOfMonths: 1,
			//cuando se selecciona una fecha en el in 
			onSelect: function( selectedDate ) {												
				// Seteando la fecha minima del OUT en el dia del IN  + 1 dia 				
				var ot = jQuery('#fechaout',form).datepicker( "option", "minDate", Entorno.addDays(selectedDate,1,1));												
				Entorno.validarEstadoCampo(this);				
				//elijieron en el IN  			
				Entorno.onDateChage('#fechain');
			}
		});		
		var hoy = new Date();
		var  optOut = {
			dateFormat:"dd-mm-yy",
			numberOfMonths: 1 	, 
			minDate: Entorno.addDays(hoy.getDate()+'-'+Entorno.formatNumber(parseInt(hoy.getMonth()+1))+'-'+hoy.getFullYear(),1,1) , 
			onSelect: function( selectedDate ) {
				Entorno.validarEstadoCampo(this);
				Entorno.onDateChage('#fechaout');
			}}
		if(jQuery('#fechain',form).val().length > 0) { 
			optOut.minDate = jQuery('#fechain',form).val();
		}
		// ver como saber que es una fecha valida 		
		jQuery('#fechaout',form).datepicker(optOut);				
	},
	validarEstadoCampo : function(el){		
		var cmp = jQuery(el);
		var  el = jQuery('#fechaout');
		
		if(cmp.val().length <= 0 ){	
			if(!cmp.parent().hasClass('tpl-error')){
				jQuery('<label class="error" >'+jQuery.validator.messages.required.replace(/{campo}/g,'')+'</label>').insertAfter(cmp).parent().addClass('tpl-error');	
				cmp.focus();				
			}
			return false;
		}else{
			cmp.parent().removeClass('tpl-error');
			cmp.next('.tpl-text-error').remove();			
			/* por alguna razon hace focus y lo cierra if(cmp.attr('id') == 'fechain' && el.val().length < 1){							el.focus();			}*/
			return true;	
		}			
		
	}, 
	/* definiendo idiomas en datepicker */
	setDatepickerLang : function (cid){
		if(cid == 'en'){
			jQuery.datepicker.setDefaults(	jQuery.datepicker.regional['en-GB'] = {closeText: 'Done',		prevText: 'Prev',		nextText: 'Next',		currentText: 'Today',		monthNames: ['January','February','March','April','May','June',		'July','August','September','October','November','December'],	monthNamesShort: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',		'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],		dayNames: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],		dayNamesShort: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu','Fri', 'Sat'],		dayNamesMin: ['Su','Mo','Tu','We','Th','Fr','Sa'],		weekHeader: 'Wk',		dateFormat: 'dd/mm/yy',		firstDay: 1,		isRTL: false,		showMonthAfterYear: false,		yearSuffix: ''});
		}else if(cid == 'pt'){
			jQuery.datepicker.setDefaults(jQuery.datepicker.regional['pt-BR'] = {closeText: 'Fechar',		prevText: '&#x3c;Anterior',		nextText: 'Pr&oacute;ximo&#x3e;',		currentText: 'Hoje',		monthNames: ['Janeiro','Fevereiro','Mar&ccedil;o','Abril','Maio','Junho',		'Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],		monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun',		'Jul','Ago','Set','Out','Nov','Dez'],		dayNames: ['Domingo','Segunda-feira','Ter&ccedil;a-feira','Quarta-feira','Quinta-feira','Sexta-feira','Sabado'],		dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sab'],		dayNamesMin: ['Dom','Seg','Ter','Qua','Qui','Sex','Sab'],		weekHeader: 'Sm',		dateFormat: 'dd/mm/yy',		firstDay: 0,		isRTL: false,		showMonthAfterYear: false,		yearSuffix: ''});
		}else{
			jQuery.datepicker.setDefaults( {closeText: 'Cerrar',prevText: '&#x3c;Ant',		nextText: 'Sig&#x3e;',		currentText: 'Hoy',		monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',		'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],		monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',		'Jul','Ago','Sep','Oct','Nov','Dic'],		dayNames: ['Domingo','Lunes','Martes','Mi&eacute;rcoles','Jueves','Viernes','S&aacute;bado'],		dayNamesShort: ['Dom','Lun','Mar','Mi&eacute;','Juv','Vie','S&aacute;b'],		dayNamesMin: ['D','L','M','M','J','V','S'],		weekHeader: 'Sm',		dateFormat: 'dd/mm/yy',		firstDay: 1,		isRTL: false,		showMonthAfterYear: false,		yearSuffix: '',				timeOnlyTitle:'Seleccione Momento',		timeText:'Momento',		hourText:'Hora',		minuteText:'Minutos',		secondText:'Segundo',		currentText:'Ahora'	});
		}
		return ;
	},
	onDateChage : function(sel)	{		
		var $in = jQuery('#fechain').val();
		var $out = jQuery('#fechaout').val();		
		if(!$out.length){ 
			// el out no esta definido 
			this.moverOut($in , $out);
		}else if(!$in.length){
			//el in no esta definido 
			this.moverIn($in , $out);
		}else{									
			var cdn0 = this.getNoches();			
			var date = $in.split("-");
			var d1 = date[2]+"-"+date[1]+"-"+date[0];		
			var date2 = $out.split("-");
			var d2 = date2[2]+"-"+date2[1]+"-"+date2[0];		
			var cdn1 = this.daysBetween(d2, d1, true);
			// si mueven el in adelante muevo el out 
			if( sel == '#fechain' ){														
			if( cdn1 < cdn0 ){
					//mover noches a noches cdn1				
					jQuery('#fechaout').val(this.addDays($in, cdn0 , 1)).datepicker( "refresh" );
				}else if( cdn1 > cdn0  ){
					// si mueven el in atras seteas las noches 					
					this.definirNoches($in, $out);
				}
			//  si entran por out siempre tienen la cantidad de noches modificada 
			}else if(sel == '#fechaout' ){										
				//this.setNoches(this.daysBetween($in, $out));
				this.definirNoches($in, $out);
			}
		}				
	},
	moverOut : function ($in , $out){		
		var d = this.addDays($in, this.getNoches(),1);
		jQuery('#fechaout').val(d).datepicker( "refresh" );
		
	},
	moverIn : function ($in , $out){		
		var d = this.addDays($out, this.getNoches(), -1);
		jQuery('#fechain').val(d).datepicker( "refresh" );
		
	},
	getNoches: function (){
		return 	parseInt(jQuery('#cNoches').val());
	},
	setNoches: function (n){
		return 	jQuery('#cNoches').val(parseInt(n));
	},
	calcularNoches : function( $in , $out ){							
		date = $in.split("-");
		d1 = date[2]+"-"+date[1]+"-"+date[0];
		date = $out.split("-");
		d2 = date[2]+"-"+date[1]+"-"+date[0];
		return Entorno.daysBetween(d1,d2);
	},
	definirNoches : function( $in , $out ){		
		var cn =  this.calcularNoches($in , $out);
		jQuery('#cNoches').val(cn);	
		return;
	},
	daysBetween : function(date1, date2){
		if (date1.indexOf("-") != -1) { date1 = date1.split("-"); } else if (date1.indexOf("/") != -1) { date1 = date1.split("/"); } else { return 0; }
	   if (date2.indexOf("-") != -1) { date2 = date2.split("-"); } else if (date2.indexOf("/") != -1) { date2 = date2.split("/"); } else { return 0; }
	   if (parseInt(date1[0], 10) >= 1000) {
	       var sDate = new Date(date1[0]+"/"+date1[1]+"/"+date1[2]);
	   } else if (parseInt(date1[2], 10) >= 1000) {
	       var sDate = new Date(date1[2]+"/"+date1[0]+"/"+date1[1]);
	   } else {
	       return 0;
	   }
	   if (parseInt(date2[0], 10) >= 1000) {
	       var eDate = new Date(date2[0]+"/"+date2[1]+"/"+date2[2]);
	   } else if (parseInt(date2[2], 10) >= 1000) {
	       var eDate = new Date(date2[2]+"/"+date2[0]+"/"+date2[1]);
	   } else {
	       return 0;
	   }
	   var one_day = 1000*60*60*24;
	   var daysApart = Math.ceil((sDate.getTime()-eDate.getTime())/one_day);	   
	   // evitar que no me pase lo dias en negativo para casos particulares 	   
	   if(arguments[2] != true ){
		daysApart = Math.abs(daysApart );	   
	   }
	   return daysApart;
	},
	formatNumber:function(dn){
		var d = dn.toString();
		return (d.length < 2 )  ? '0'+d:d;
	},	
	addDays : function(f , ds , sent){
		if(! ds ) return f;
		var ef = f.split('-');
		var df = Entorno.parseIntM(ef[0]);
		var mf = Entorno.parseIntM(ef[1]);
		var yf = Entorno.parseIntM(ef[2]);	
		var fd = new Date(yf, mf, df);			
		var ud = 1000*60*60*24;		
		var dt = new Date();
		// por alguna razon supone que todos los meses tienen 31 dias 
		var md = new Array(31,28,31,30,31,30,31,31,30,31,30,31);// dias por mes 		
		if(!(yf % 4)){ md[1] = 29;} // un dia mas en años bisiestos 				
		//console.info(ds + df,md[mf-1]);
		if((ds + df) > md[mf-1])
		{
			var dsr = ds + df;
			var cont = mf-1;
			var aniosASumar = 0;
			while((dsr > 0) && (dsr > md[cont]))
			{
				dsr = dsr - md[cont];
				cont = cont + 1;
				if(cont == 12){aniosASumar = aniosASumar + 1;}
				cont = cont % 12;
			}
			return this.formatNumber(dsr) +'-'+this.formatNumber(cont+1)+'-'+(parseInt(yf)+aniosASumar);
			//ds +=  (  31 -  md[mf-1] );//le sumo tantos dias como hagan falta para llegar al 31 a los que pide
		}else{
			return this.formatNumber(ds+df)+'-'+this.formatNumber(mf)+'-'+yf;
		}
		//TODO revisar porque estamos tomando el dato getMonth 
	},
	parseIntM:function(val){
		if(val.indexOf('0') == 0 ){ val = val.substring(1);}
		return parseInt(val);
	},
	cargarFormulario : function (sel){	
		//var form = jQuery(sel);
		this.searchForm = jQuery(sel);
		//validar IN y OUT 
		this.searchForm.submit(Entorno.validarCamposInOut); 
		/* cargar datepickers*/
		this.cargarDatepickers(this.searchForm);		
				
	},
	validarCamposInOut:function (){
		var infoMEl = jQuery('#infoMsj');
		//ver si esta vacio el in 
		var cin = jQuery('#fechain', Entorno.searchForm);
		var fin = cin.val();
		var cout = jQuery('#fechaout', Entorno.searchForm);
		var fout = cin.val();
		// si es valido sigue 
		if(  typeof(fin) != 'undefined' && fin.length == 10 && typeof(fout) != 'undefined' && fout.length == 10 ){
			return true;
		}else if(typeof(fin) == 'undefined' || fin.length < 10 ){
			cin.focus();			
		}else if(typeof(fout) == 'undefined' || !fout< 10  ) {
			cout.focus();		    
		}		
		infoMEl.addClass('show').find('ul.errores').html('<li><span class="ui-icon ui-icon-info"></span><strong>'+Entorno.opt.i18n.completeInOut+' </strong><ul></ul> </li>');
		return false;
	}
	};
Entorno.cargarFormulario('#mbmainform');