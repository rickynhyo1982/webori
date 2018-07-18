<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$lang_aux = json_decode(file_get_contents('application/language/es/sala.json'), true);
foreach($lang_aux as $key=>$row) {
    $lang[$key] = $row;
}