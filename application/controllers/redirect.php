<?php
/**
 * This controller class loads simple named pages like "home", ppp pages etc.
 *
 * @author Pedro Escudero
 */
class Redirect extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
    }
    
    public function index(){   
        show_404();
    }
    
    public function home() {
        redirect(site_url('inicio'));  
    }
}

?>