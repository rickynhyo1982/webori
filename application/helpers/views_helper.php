<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Views helper contains facilities to make views coding easy
 *
 * @package	DASC
 * @subpackage	helpers
 * @category	hepers
 * @author	Pedro Escudero
 * @link	http://pedroescudero.info
 */


/**
 * Load View
 *
 * Load View in Views code
 */

if (!function_exists('load_view')) {
    function load_view($view_to_load=null) {
	$CI = get_instance();
        $CI->load->view($view_to_load);
    }
}

// =========================================================================
// ===  fotmat_fecha_hora :  retourne la fechahora au format dd/mm/yyyy hh:mm    ===
// ===     en entrée la date/heure au format sql (yyyy-mm-dd hh:mm:ss )  ===
// =========================================================================

if (!function_exists('fotmat_fecha_hora')) {        
	function fotmat_fecha_hora ($fechaHora) {            
		return substr($fechaHora,8,2)."/".substr($fechaHora,5,2)."/".substr($fechaHora,0,4)." ".substr($fechaHora,11,5) ;     
	}
}

if (!function_exists('fotmat_fecha')) {
	function fotmat_fecha ($fechaHora) {        
		$díasSemana = array('1'=>'lunes', '2'=>'martes', '3'=>'miércoles', '4'=>'jueves', '5'=>'viernes', '6'=>'sábado', '7'=>'domingo');        
		$meses = array('1'=>'Ene', '2'=>'Feb', '3'=>'Mar', '4'=>'Abr', '5'=>'May','6'=>'Jun', '7'=>'Jul', '8'=>'Ago', '9'=>'Sep', '10'=>'Oct', '11'=>'Nov', '12'=>'Dic');        
		$fecha_aux = strtotime($fechaHora);        
		$día_aux = $díasSemana[date('N', $fecha_aux)];        
		$mes_aux=$meses[date('n', $fecha_aux)];        
		return $mes_aux.'. '.$día_aux.' '.date('j', $fecha_aux);            
		 //return substr($fechaHora,8,2)."/".substr($fechaHora,5,2)."/".substr($fechaHora,0,4) ;
	}
}
			 
if (!function_exists('fotmat_hora')) {
	function fotmat_hora ($fechaHora) {           
		return substr($fechaHora,11,5) ;     
	}
}

if (!function_exists('fotmat_fecha_hora_database')) {        
	function fotmat_fecha_hora_database ($fecha) {            
		return substr($fecha,6, 4)."-".substr($fecha,3, 2)."-".substr($fecha,0, 2)." ".substr($fecha,11, 5).":00";     
	}
}



// =========================================================================================
// ===  imgEvento :  retourne le nom du fichier image de l'evenement (0.jpg par defaut)  ===
// =========================================================================================
// 26/11/2014 - buscamos jpg gif y png
function imgEvento($idEvento) {
        $CI = get_instance();
        $rep_img_eventos = 'resources/uploads/contenido/'; 
        
	if (substr($idEvento,0,3)=='pub') {
		$nomImgEvento=$rep_img_eventos.'blanc.jpg';
	} else { // dans le cas de l'image d'un evenment on met le fichier par d�faut (0.jpg)
		$nomImgEvento=$rep_img_eventos.'0.jpg';
	}

    if (file_exists($rep_img_eventos.$idEvento.".jpg")) {
        $nomImgEvento=$rep_img_eventos.$idEvento.".jpg" ;
    } else {
        if (file_exists($rep_img_eventos.$idEvento.".gif")) {
            $nomImgEvento=$rep_img_eventos.$idEvento.".gif" ;
        } else {
            if (file_exists($rep_img_eventos.$idEvento.".png")) {
               $nomImgEvento=$rep_img_eventos.$idEvento.".png" ;
            }
        }
    }	
    return $nomImgEvento;
}
