<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('active_lang'))
{
    function active_lang(){
        $CI =& get_instance();
        return $CI->lang->lang();
    }   
}