=== Plugin Name ===
Contributors: ezequiel hoyos , nicolas bocacci , agustin dotta 
Donate link: http://www.div-it.com.ar
Tags: formulario para conectarse con el sitio 
Requires at least: 1.0.0
Tested up to: 1.0.0
Stable tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Agrega un formulario de reservas dentro del sitio para conectarlo con el book-it

== Description ==

This is the long description.  No limit, and you can use Markdown (as well as in the following sections).

For backwards compatibility, if this section is missing, the full length of the short description will be used, and
Markdown parsed.

A few notes about the sections above:

*   "Contributors" is a comma separated list of wp.org/wp-plugins.org usernames
*   "Tags" is a comma separated list of tags that apply to the plugin
*   "Requires at least" is the lowest version that the plugin will work on
*   "Tested up to" is the highest version that you've *successfully used to test the plugin*. Note that it might work on
higher versions... this is just the highest one you've verified.
*   Stable tag should indicate the Subversion "tag" of the latest stable version, or "trunk," if you use `/trunk/` for
stable.

    Note that the `readme.txt` of the stable tag is the one that is considered the defining one for the plugin, so
if the `/trunk/readme.txt` file says that the stable tag is `4.3`, then it is `/tags/4.3/readme.txt` that'll be used
for displaying information about the plugin.  In this situation, the only thing considered from the trunk `readme.txt`
is the stable tag pointer.  Thus, if you develop in trunk, you can update the trunk `readme.txt` to reflect changes in
your in-development version, without having that information incorrectly disclosed about the current stable version
that lacks those changes -- as long as the trunk's `readme.txt` points to the correct stable tag.

    If no stable tag is provided, it is assumed that trunk is stable, but you should specify "trunk" if that's where
you put the stable version, in order to eliminate any doubt.

== Installation ==

<h1>Instalaci&oacute;n</h1>		
		<ol>
			<li><a href="mbform.zip">Descargar el plugin</a></li>
			<li>Acceder al dashboard y realizar de ser posible una copia de seguridad.</li>
			<li>Ir a Plugins, A&ntilde;adir Nuevo.</li>
			<li>En la parte superior escoger la opci&oacute;n "Subir".</li>
			<li>Clic en "Examinar" y seleccionar el archivo descargado.</li>
			<li>Clic en "Instalar Ahora".</li>
			<li>Una vez subido e instalado hacer clic en "Activar plugin".</li>					
		</ol>
		<h1> Mostrar el formulario del motor dentro de la cabecera del template </h1>
		<ol>			
			<li>En apariencia -> editor -> "header.php" insertar el siguiente codigo <sup>1</sup> donde se precise mostrar el formulario <strong>&lt;?php mbform_make_form('<em>[https://sumotor.mbooking.com.ar/]</em>', '<em>[HOTEL ID]</em>'); ?&gt; </strong></li>						
			<li>Guardar</li>
		</ol>
		<p><sup>1</sup> solicite los datos [HOTEL ID] y [https://sumotor.mbooking.com.ar/] a motores@div-it.com.ar en caso de que no hayan sido enviados </p>
		<h2>Cambiar las palabras definidas en la interface</h2>
		<p> Si se desea moficar los textos de los botones o los placeholders de los campos (en la version beta ) se deben cambiar los parÃ¡metros del array <strong>$i18n</strong> en el archivo <strong>/wp-content/plugins/mbform/inc/functions.php</strong></p>		

== Frequently Asked Questions ==

= A question that someone might have =

An answer to that question.

= What about foo bar? =

Answer to foo bar dilemma.

== Screenshots ==

1. This screen shot description corresponds to screenshot-1.(png|jpg|jpeg|gif). Note that the screenshot is taken from
the /assets directory or the directory that contains the stable readme.txt (tags or trunk). Screenshots in the /assets 
directory take precedence. For example, `/assets/screenshot-1.png` would win over `/tags/4.3/screenshot-1.png` 
(or jpg, jpeg, gif).
2. This is the second screen shot

== Changelog ==

= 1.0 =
* A change since the previous version.
* Another change.

= 0.5 =
* List versions from most recent at top to oldest at bottom.

== Upgrade Notice ==

= 1.0 =
Upgrade notices describe the reason a user should upgrade.  No more than 300 characters.

= 0.5 =
This version fixes a security related bug.  Upgrade immediately.

== Arbitrary section ==

You may provide arbitrary sections, in the same format as the ones above.  This may be of use for extremely complicated
plugins where more information needs to be conveyed that doesn't fit into the categories of "description" or
"installation."  Arbitrary sections will be shown below the built-in sections outlined above.

== A brief Markdown Example ==

Ordered list:

1. Some feature
1. Another feature
1. Something else about the plugin

Unordered list:

* something
* something else
* third thing

Here's a link to [WordPress](http://wordpress.org/ "Your favorite software") and one to [Markdown's Syntax Documentation][markdown syntax].
Titles are optional, naturally.

[markdown syntax]: http://daringfireball.net/projects/markdown/syntax
            "Markdown is what the parser uses to process much of the readme file"

Markdown uses email style notation for blockquotes and I've been told:
> Asterisks for *emphasis*. Double it up  for **strong**.

`<?php code(); // goes in backticks ?>`
