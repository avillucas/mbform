<?php
/*
Plugin Name: mbform
Plugin URI: https://github.com/avillucas/mbform
Description: Agregá a tu wordpress un formulario para linkearlo a tu  motor book-it  
Version: 1.0
Author: Div-it
Author URI: http://www.div-it.com.ar/
License: GPL2
*/


/*  Copyright AÑO mbform  (email : webmaster@div-it.com.ar)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

//evitar que lo accedan a directamente 
defined('ABSPATH') or die("No script kiddies please!");

//incluir todo lo que esta en inc 
foreach ( glob( plugin_dir_path( __FILE__ ) . "inc/*.php" ) as $file ) {
	include_once $file;
}
include_once(  plugin_dir_path( __FILE__ ).'options.php');


//funcion para agregarlo 

