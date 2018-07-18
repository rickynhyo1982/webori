<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/*
* Name: Developa
*
* Author: 
* Pedro Escudero
* pedroescuderosanchez@gmail.com
* pedroescuderoo.info
*
* Description: Helper con funciones para ayudar al desarrollo y controlar en qué entorno nos encontramos
* Released: 11/06/2013
* Requirements: PHP5 or above and Codeigniter 2.0+
*/

class Developa {
    
    public function isPro() {
        return ENVIRONMENT === 'production';
    }
    
    public function isPre() {
        return ENVIRONMENT === 'testing';
    }
    
    public function isDev() {
        return ENVIRONMENT === 'development';
    }
    
    public function benchmark() {
        $CI =& get_instance();
        $sections = array(
                'benchmarks' => TRUE, 'memory_usage' => TRUE, 
                'config' => FALSE, 'controller_info' => FALSE, 'get' => FALSE, 'post' => FALSE, 'queries' => FALSE, 
                'uri_string' => FALSE, 'http_headers' => FALSE, 'session_data' => FALSE
        ); 
        $CI->output->set_profiler_sections($sections);
        $CI->output->enable_profiler(TRUE);
    }
}
