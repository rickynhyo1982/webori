<?php
/**
 * This controller class loads simple named pages like "home", ppp pages etc.
 *
 * @author Pedro Escudero
 */
class Contacto extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        
        $this->lang->load('sala');
        $this->lang->load('url');
        
        // Define a global variable to store data that is then used by the end view page.
        $this->data = null;
        
        //Idiomas
        $this->data['idiomas_data'] = $this->global_sala_model->get_idiomas();
        
        //Carrusel
        $this->data['carrusel_data'] = $this->global_sala_model->global_get_carrusel_data();
        
        //Enlaces footer
        $this->data['espectaculos_link'] = $this->global_rgascat_model->get_contenidos_data_link('sp');
        $this->data['enlaces_sociales_link'] = $this->global_sala_model->global_get_enlaces_data('social');
        $this->data['enlaces_externos_link'] = $this->global_sala_model->global_get_enlaces_data('enlace');
        $this->data['contacto_text'] = $this->global_sala_model->global_get_texto_fijo('6');
        $this->data['keywords_text'] = $this->global_sala_model->global_get_texto_fijo('8');
    }
    
    public function index(){
        // If 'Send Message' form has been submitted, update the user account details.
        if ($this->input->post('contact')) {
                $resultado_insercion = $this->global_sala_model->global_insert_contacto();
                
                if($resultado_insercion){
                    $this->global_sala_model->global_send_contact();
                }
        }
        
        $this->data['descripcion_text'] = $this->global_sala_model->global_get_texto_fijo('5');
        $this->data['formulario_text'] = $this->global_sala_model->global_get_texto_fijo('7');
        
        // Get any status message that may have been set.
        $this->data['message'] = $this->session->flashdata('message');		
        
        $this->load->view('contacto_view', $this->data);
    }
}

?>