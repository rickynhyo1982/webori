<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Mail Config
|--------------------------------------------------------------------------
|
| Estamos usando Mandrill -> https://mandrillapp.com
|
*/

$config['protocol'] = 'smtp';
$config['charset'] = 'utf-8';
$config['mailtype'] = 'html';
$config['smtp_timeout'] = 5;
$config['smtp_host'] = 'smtp.mandrillapp.com';
$config['smtp_port'] = 587;
$config['smtp_user'] = 'pedroescuderosanchez@gmail.com';
$config['smtp_pass'] = 'tWm6D_qpxEGbi-EsWdH3pA'; 