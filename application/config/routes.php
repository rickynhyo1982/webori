<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

/* Trick*/
$available_langs = json_decode(file_get_contents('application/language/lang.json'), true);

//Default
$route['default_controller'] = 'inicio';

//codeigniter_i18n
if(isset($available_langs['es'])) {
    $route['^es'] = 'redirect/home';
    
    $route['^[[:alpha:]][[:alpha:]]/imprimir/(:any)'] = 'imprimir/index/$1';
    $route['^[[:alpha:]][[:alpha:]]/pdf/(:any)'] = 'pdf/index/$1';
    $route['^[[:alpha:]][[:alpha:]]/pagos/(:any)'] = 'pagos/index/$1';
    $route['^[[:alpha:]][[:alpha:]]/espectaculos/(:any)'] = 'espectaculos/index/$1';
    $route['^[[:alpha:]][[:alpha:]]/compra/eliminar/(:any)'] = 'compra/eliminar/$1';
    $route['^[[:alpha:]][[:alpha:]]/compra/(:any)'] = 'compra/index/$1';
    $route['^[[:alpha:]][[:alpha:]]/quienes-somos'] = 'quienes';
}

if(isset($available_langs['en'])) {
    $route['^en'] = 'redirect/home';
    
    $route['^(:any)/home'] = 'inicio';
    $route['^(:any)/shows'] = 'espectaculos';
    $route['^[[:alpha:]][[:alpha:]]/imprimir/(:any)'] = 'imprimir/index/$1';
    $route['^[[:alpha:]][[:alpha:]]/pdf/(:any)'] = 'pdf/index/$1';
    $route['^[[:alpha:]][[:alpha:]]/pagos/(:any)'] = 'pagos/index/$1';
    $route['^[[:alpha:]][[:alpha:]]/shows/(:any)'] = 'espectaculos/index/$1';
    $route['^[[:alpha:]][[:alpha:]]/compra/eliminar/(:any)'] = 'compra/eliminar/$1';
    $route['^[[:alpha:]][[:alpha:]]/compra/(:any)'] = 'compra/index/$1';
    $route['^(:any)/contact'] = 'contacto';
    $route['^(:any)/who-we-are'] = 'quienes';
}

if(isset($available_langs['it'])) {
    $route['^it'] = 'redirect/home';
    
    $route['^(:any)/iniziazione'] = 'inicio';
    $route['^(:any)/spettacolos'] = 'espectaculos';
    $route['^[[:alpha:]][[:alpha:]]/imprimir/(:any)'] = 'imprimir/index/$1';
    $route['^[[:alpha:]][[:alpha:]]/pdf/(:any)'] = 'pdf/index/$1';
    $route['^[[:alpha:]][[:alpha:]]/pagos/(:any)'] = 'pagos/index/$1';
    $route['^[[:alpha:]][[:alpha:]]/spettacolos/(:any)'] = 'espectaculos/index/$1';
    $route['^[[:alpha:]][[:alpha:]]/compra/eliminar/(:any)'] = 'compra/eliminar/$1';
    $route['^[[:alpha:]][[:alpha:]]/compra/(:any)'] = 'compra/index/$1';
    $route['^(:any)/contatto'] = 'contacto';
    $route['^(:any)/chi-siamo'] = 'quienes';
}

if(isset($available_langs['fr'])) {
    $route['^fr'] = 'redirect/home';
    
    $route['^(:any)/initiation'] = 'inicio';
    $route['^(:any)/spectacles'] = 'espectaculos';
    $route['^[[:alpha:]][[:alpha:]]/imprimir/(:any)'] = 'imprimir/index/$1';
    $route['^[[:alpha:]][[:alpha:]]/pdf/(:any)'] = 'pdf/index/$1';
    $route['^[[:alpha:]][[:alpha:]]/pagos/(:any)'] = 'pagos/index/$1';
    $route['^[[:alpha:]][[:alpha:]]/spectacles/(:any)'] = 'espectaculos/index/$1';
    $route['^[[:alpha:]][[:alpha:]]/compra/eliminar/(:any)'] = 'compra/eliminar/$1';
    $route['^[[:alpha:]][[:alpha:]]/compra/(:any)'] = 'compra/index/$1';
    $route['^(:any)/contact'] = 'contacto';
    $route['^(:any)/qui-nous-sommes'] = 'quienes';
}

if(isset($available_langs['pt'])) {
    $route['^pt'] = 'redirect/home';
    
    $route['^(:any)/iniciacao'] = 'inicio';
    $route['^(:any)/mostra'] = 'espectaculos';
    $route['^[[:alpha:]][[:alpha:]]/imprimir/(:any)'] = 'imprimir/index/$1';
    $route['^[[:alpha:]][[:alpha:]]/pdf/(:any)'] = 'pdf/index/$1';
    $route['^[[:alpha:]][[:alpha:]]/pagos/(:any)'] = 'pagos/index/$1';
    $route['^[[:alpha:]][[:alpha:]]/mostra/(:any)'] = 'espectaculos/index/$1';
    $route['^[[:alpha:]][[:alpha:]]/compra/eliminar/(:any)'] = 'compra/eliminar/$1';
    $route['^[[:alpha:]][[:alpha:]]/compra/(:any)'] = 'compra/index/$1';
    $route['^(:any)/contato'] = 'contacto';
    $route['^(:any)/quem-somos'] = 'quienes';
}

if(isset($available_langs['ru'])) {
    $route['^ru'] = 'redirect/home';
    
    $route['^(:any)/initsiirovaniye'] = 'inicio';
    $route['^(:any)/shou'] = 'espectaculos';
    $route['^[[:alpha:]][[:alpha:]]/imprimir/(:any)'] = 'imprimir/index/$1';
    $route['^[[:alpha:]][[:alpha:]]/pdf/(:any)'] = 'pdf/index/$1';
    $route['^[[:alpha:]][[:alpha:]]/pagos/(:any)'] = 'pagos/index/$1';
    $route['^[[:alpha:]][[:alpha:]]/shou/(:any)'] = 'espectaculos/index/$1';
    $route['^[[:alpha:]][[:alpha:]]/compra/eliminar/(:any)'] = 'compra/eliminar/$1';
    $route['^[[:alpha:]][[:alpha:]]/compra/(:any)'] = 'compra/index/$1';
    $route['^(:any)/kontakt'] = 'contacto';
    $route['^(:any)/kto-my'] = 'quienes';
}

//Escobas
if(isset($available_langs['es'])) {
    $route['^es/(.+)$'] = '$1';
}

if(isset($available_langs['en'])) {
    $route['^en/(.+)$'] = '$1';
}

if(isset($available_langs['it'])) {
    $route['^it/(.+)$'] = '$1';
}

if(isset($available_langs['fr'])) {
    $route['^fr/(.+)$'] = '$1';
}

if(isset($available_langs['pt'])) {
    $route['^pt/(.+)$'] = '$1';
}

if(isset($available_langs['ru'])) {
    $route['^ru/(.+)$'] = '$1';
}

//404
$route['404_override'] = '';

/* End of file routes.php */
/* Location: ./application/config/routes.php */