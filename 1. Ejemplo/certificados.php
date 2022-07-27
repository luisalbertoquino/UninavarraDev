<?php
/*
Plugin Name: Certificados
Plugin URI: https://github.com/jesusroap/certificados
Description: Generador de certificados en formato pdf.
Author: Jesus Mauricio Roa Polania
Version: 1.0
Author URI: https://github.com/jesusroap
*/

defined('ABSPATH') or die("Acceso Denegado");

define('CFD_RUTA', plugin_dir_path(__FILE__));

define('CFD_NOMBRE', 'Certificados');

include(CFD_RUTA . 'includes/functions.php');
