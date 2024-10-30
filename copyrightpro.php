<?php
/*
 * Plugin Name: CopyRightPro
 * Plugin URI: http://wp-copyrightpro.com/
 * Description: CopyRightPro is a plug-in that prevents the copying of texts and images from your blog, if you install this plug-in, your content of wordpress will be protected.
 * Version: 2.1
 * Author: Andres Felipe Perea V.
 * Author URI: http://wp-copyrightpro.com/
 * Text Domain: copyrightpro
 * Domain Path: /languages/
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

/*  Copyright 2017 ANDRES FELIPE PEREA V (email : info@wp-copyrightpro.com)

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

/* INSTALL AND UNISTALL PLUG-IN */
function copyrightpro_install() {
    global $wpdb;
    
    $wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}copyrightpro");
    
    $sql = 'CREATE TABLE `' . $wpdb->prefix . 'copyrightpro` (
			`Option` VARCHAR( 20 ) NOT NULL ,
			`Value` VARCHAR( 20 ) NOT NULL
			) ENGINE = InnoDB DEFAULT CHARSET=utf8';

    $wpdb->query($sql);
    $wpdb->query('INSERT INTO `' . $wpdb->prefix . 'copyrightpro` (`Option`, `Value`) VALUES 
	(\'copy_click\', \'n\'),(\'copy_selection\', \'y\'),(\'copy_iframe\', \'n\'),(\'copy_drop\', \'n\'), (\'copy_link\', \'y\')');
}

function copyrightpro_uninstall() {
    global $wpdb;

    $sql = "DROP TABLE `" . $wpdb->prefix . "copyrightpro`";
    $wpdb->query($sql);
}

//CONSULTA BASE DE DATOS
function copyrightpro_consulta($consulta){
    global $wpdb;
    $sql  = 'SELECT *  FROM `'.$wpdb->prefix.'copyrightpro` WHERE `Option` = \''.$consulta.'\'';
    $sql = $wpdb->get_results($sql);
    
    foreach ( $sql as $fivesdraft ){
        return $fivesdraft->Value;
    }
}

// UPDATE OPTIONS
function copyrightpro_updateoptions($option, $value){
    global $wpdb;
    $sql  = 'UPDATE `'.$wpdb->prefix.'copyrightpro` SET `Value`=\''.$value.'\' WHERE `Option` =\''.$option.'\'';
    $wpdb->query($sql);
    return "update";
    
}


//NIVEL DE PROTECCION (ESTADO DE LA BARRA EN PORCENTAJE)
function copyrightpro_proteccion(){
    $opciones= 4; //NUMERO DE OPCIONES DEL PLUG-IN
    $numero=0; //NUMERO INICIAL DE LAS OPCIONES
    
    $consulta =copyrightpro_consulta('copy_click');
    if ($consulta == 'y'){
        $numero = $numero + 1;
    }
    $consulta =copyrightpro_consulta('copy_selection');
    if ($consulta == 'y'){
        $numero = $numero + 1;
    }
    
    $consulta =copyrightpro_consulta('copy_iframe');
    if ($consulta == 'y'){
        $numero = $numero + 1;
    }
    
    $consulta =copyrightpro_consulta('copy_drop');
    if ($consulta == 'y'){
        $numero = $numero + 1;
    }
    
    $numero=$numero * 100 / $opciones;
    return round($numero);//REGRESA EL PORCENTAJE DE LAS OPCIONES SELECCIONADAS
}

//PANEL DE CONTROL DEL PLUG-IN
function copyrightpro_panel(){
    include 'panel.php';
}

//CREA MENU DEL PLUG-IN
function copyrightpro_options_page(){
    add_menu_page(
        'Copyrightpro', //TITULO DE LA PAGINA
        'Copyrightpro', //NOMBRE DEL MENU
        'manage_options',
        'copyrightpro',
        'copyrightpro_panel', //NOMBRE DE FUNCION
        'dashicons-welcome-view-site' //ICONO DEL MENU
    );
}

//DOCUMENTO QUE CONTIENE LOS SCRIPS DE JAVA SCRIPT
function copyrightpro_scripts(){
    include 'scripts.php';
}

function copyrightpro_footerlink() {
    if (copyrightpro_consulta('copy_link') == 'y'){
        echo '<div class="wrap">';
        echo '<p style="text-align: center;"><small>This site is protected by <a title="Wp-Copyrightpro" href="http://wp-copyrightpro.com/" target="_blank">wp-copyrightpro.com</a></small></p>';
        echo '</div>';
    }
}

/* Añadir comando wordpress */
register_activation_hook(__FILE__,'copyrightpro_install'); //COMANDO AL ACTIVAR EL PLUG-IN
register_deactivation_hook(__FILE__,'copyrightpro_uninstall'); //COMANDO AL DESACTIVAR PLUG-IN
register_uninstall_hook(__FILE__,'copyrightpro_uninstall'); //COMANDO AL BORRAR EL PLUG-IN

add_action('admin_menu', 'copyrightpro_options_page'); // MENU ADMIN PAGE
add_action('wp_head','copyrightpro_scripts'); //INCLUIR CONTENIDO EN EL HEADER
add_action('wp_footer', 'copyrightpro_footerlink');// INCLUIR CONTENIDO EN EL FOOTER

//traduccion diferentes idiomas plug-in

add_action('init', 'copyrightpro_plugin_load_textdomain');

function copyrightpro_plugin_load_textdomain() {	
	$text_domain	= 'copyrightpro';
	$path_languages = basename(dirname(__FILE__)).'/languages/';
 	load_plugin_textdomain($text_domain, false, $path_languages );
}
?>