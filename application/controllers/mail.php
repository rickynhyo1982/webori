<?php

/**
 * Mail class test purpose
 *
 * @author Pedro Escudero
 */
class mail extends CI_Controller {

    public function index()
    {
        $this->load->library('email');

        $this->email->from('charivari@rgascat.com', 'Prueba');
        $this->email->to('nomemiresqmasusto@gmail.com', 'Pedro'); 
        //$this->email->cc('another@another-example.com'); 
        //$this->email->bcc('them@their-example.com'); 

        $this->email->subject('Email Test');
        $this->email->message('Testing the email class.');	

        $this->email->send();
        
        $data['mail_message'] = $this->email->print_debugger();
        $this->load->view('pruebas/mail_send', $data);
    }
    
}

?>
