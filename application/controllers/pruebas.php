<?php
/**
 * This controller class loads simple named pages like "home", ppp pages etc.
 *
 * @author Pedro Escudero
 */
class Pruebas extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        
        $this->load->library('developa');
        if($this->developa->isPro())
            show_404();
        
        // Define a global variable to store data that is then used by the end view page.
        $this->data = null;
    }
    
    public function index(){
        show_404();
        //$this->load->view('pruebas_view');
    }
    
    public function tri() {
        $this->load->view('pruebas_view', $this->data);
    }
}

?>
