<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Config para motor de entradas
|--------------------------------------------------------------------------
*/

// taille sala, mesas y butacas
$config['entradas']['modelos']['TAMANO_SALA_X'] = 620;
$config['entradas']['modelos']['TAMANO_SALA_Y'] = 850;
$config['entradas']['modelos']['TAMANO_MESA'] = 100;
$config['entradas']['modelos']['TAMANO_BUTACA'] = 40;
$config['entradas']['modelos']['TAMANO_SILLA'] = 38;
$config['entradas']['modelos']['TAMANO_MESA3X2_X'] = 80;
$config['entradas']['modelos']['TAMANO_MESA3X2_Y'] = 120;
$config['entradas']['modelos']['TAMANO_ESCENARIO_X'] = 500;
$config['entradas']['modelos']['TAMANO_ESCENARIO_Y'] = 300;
$config['entradas']['modelos']['TAMANO_BANCO_X'] = 150;
$config['entradas']['modelos']['TAMANO_BANCO_Y'] = 40;

// constante pour le plan de disponibilité
$config['entradas']['modelos']['TAMANO_PRECIO'] = 200;
$config['entradas']['modelos']['TAMANO_ENTETE'] = 30;

// Types de reservation
$config['entradas']['reservas']['RESA_INDETERMINADA'] = -1;
$config['entradas']['reservas']['RESA_LIBRE'] = 0;
$config['entradas']['reservas']['RESA_VENTA'] = 1;
$config['entradas']['reservas']['RESA_RESERVA'] = 2;
$config['entradas']['reservas']['RESA_VIP'] = 3;
$config['entradas']['reservas']['RESA_INVITADO'] = 4;
$config['entradas']['reservas']['RESA_NODISPO'] = 5;
$config['entradas']['reservas']['RESA_VENTA_WEB'] = 6;
$config['entradas']['reservas']['RESA_DISPONIBLE'] = 7;
$config['entradas']['reservas']['RESA_OCCUPADA'] = 8;
$config['entradas']['reservas']['RESA_RESERVA_INTERNET'] = 10;

// Couleurs
$config['entradas']['color']['COLOR_TEXT'] = 0x000000; // black
$config['entradas']['color']['COLOR_MESA'] = 0xCD5C5C; // Indian Red
$config['entradas']['color']['COLOR_SILLA_PRECIO_1'] = 0xC3FDB8; // green
$config['entradas']['color']['COLOR_SILLA_PRECIO_2'] = 0xAFE9A4; // 
$config['entradas']['color']['COLOR_SILLA_PRECIO_3'] = 0x9BD590; // 
$config['entradas']['color']['COLOR_SILLA_PRECIO_4'] = 0x7DB772; // 
$config['entradas']['color']['COLOR_RESA_VENTA'] = 0xF75D59; // bean red
$config['entradas']['color']['COLOR_RESA_VENTA_WEB'] = 0xA74AC7; // Purple Flower
$config['entradas']['color']['COLOR_RESA_RESERVA'] = 0xFBB117; // 
$config['entradas']['color']['COLOR_RESA_VIP'] = 0x6495ED; // 
$config['entradas']['color']['COLOR_RESA_INVITADO'] = 0xFFFF00; // Yellow
$config['entradas']['color']['COLOR_RESA_DISPONIBLE'] = 0x98FB98; // Pale Green
$config['entradas']['color']['COLOR_RESA_OCCUPADA'] = 0xD3D3D3; // Light Grey
$config['entradas']['color']['COLOR_GRIS'] = 0xD3D3D3; // 
$config['entradas']['color']['COLOR_ESCENARIO'] = 0xA76767; // 

$config['entradas']['textos']['TXT_ESCENARIO'] = '=== ESCENARIO ===';

$config['entradas']['otros']['DIEZ_DIAS'] = 60*60*24*10;

// Messages d'information
$config['entradas']['otros']['MSG_INFO_GUARDADAS'] = 'Informaciones guardadas correctamente'; 

// Message Erreur
$config['entradas']['error']['ERR_NOMBRE_SALA'] = 'El modelo de sala necesita un nombre'; 
$config['entradas']['error']['ERR_NOMBRE_EVENTO'] = 'El evento necesita un nombre'; 

// Images des evenements
$config['entradas']['otros']['REP_IMG_EVENTOS'] = 'imgeventos/'; // Repertoire cible
$config['entradas']['otros']['MAX_SIZE_IMG'] = 300000; // Taille max en octets du fichier