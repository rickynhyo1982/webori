<?php
/**
 * This controller class loads simple named pages like "home", ppp pages etc.
 *
 * @author Pedro Escudero
 */
class Inicio extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        
        $this->lang->load('sala');
        $this->lang->load('url');
        
        $this->load->helper('video');
        
        // Define a global variable to store data that is then used by the end view page.
        $this->data = null;
        
        //Idiomas
        $this->data['idiomas_data'] = $this->global_sala_model->get_idiomas();
        
        //Carrusel
        $this->data['carrusel_data'] = $this->global_sala_model->global_get_carrusel_data();
        
        //Enlaces footer
        $this->data['enlaces_sociales_link'] = $this->global_sala_model->global_get_enlaces_data('social');
        $this->data['enlaces_externos_link'] = $this->global_sala_model->global_get_enlaces_data('enlace');
        $this->data['contacto_text'] = $this->global_sala_model->global_get_texto_fijo('6');
        $this->data['keywords_text'] = $this->global_sala_model->global_get_texto_fijo('8');
        $this->data['descripcion_text'] = $this->global_sala_model->global_get_texto_fijo('5');
        $this->data['formulario_text'] = $this->global_sala_model->global_get_texto_fijo('7');
        $this->data['la_sala_text'] = $this->global_sala_model->global_get_texto_fijo('3');
    }
    
    public function index(){
        // If 'Send Message' form has been submitted, update the user account details.
        if ($this->input->post('contact')) {
                $resultado_insercion = $this->global_sala_model->global_insert_contacto();
                
                if($resultado_insercion){
                    $this->global_sala_model->global_send_contact();
                }
        }
        
        $this->data['programacion'] = $this->global_sala_model->get_contenidos_data('sp');
        foreach ($this->data['programacion'] as $programacion_item) {
            $this->data['programacion_imagenes'][$programacion_item['cnt_id']] = $this->global_sala_model->get_contenido_imagen_rand_1($programacion_item['cnt_id']);
            $this->data['programacion_video'][$programacion_item['cnt_id']] = $this->global_sala_model->get_contenido_video_rand_1($programacion_item['cnt_id']);
        }
        
        $this->data['fechas_eventos_data'] = $this->global_sala_model->get_fechas_evento_espectaculo_data();

        $this->data['publicidad'] = $this->global_sala_model->get_publicidad_data();
        $this->data['programacion_text'] = $this->global_sala_model->global_get_texto_fijo('1');
        $this->data['venta_entradas_text'] = $this->global_sala_model->global_get_texto_fijo('2');
        $this->data['caracteristicas_text'] = $this->global_sala_model->global_get_texto_fijo('4'); 

        $this->load->view('inicio_view', $this->data);
    }
}

?>