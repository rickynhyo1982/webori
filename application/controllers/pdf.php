<?php
/**
 * This controller class loads simple named pages like "home", ppp pages etc.
 *
 * @author Pedro Escudero
 */
class Pdf extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        
        //$this->lang->load('rgascat');
        
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
    
    public function index($id){ 
        $this->load->config('entradas');
        $this->load->model('global_sala_model');
        
        $this->data['taille'] = 'default';
        $reservas_imprimir = $this->global_sala_model->get_reservas_by_pago($id);
        foreach($reservas_imprimir as $row) {
                $id_reserva = $row['res_id_reserva'];
                $this->data['entradas'][] = $this->data['fecha_evento_data'] = $this->global_sala_model->get_reserva_data($id_reserva);
            }
        
        $this->data['publicidad_entradas'] = $this->global_sala_model->get_publicidad_entradas_data();
        $this->data['fecha_evento_data'] = $this->global_sala_model->get_fecha_evento_data($reservas_imprimir[0]['res_id_fecha_evento']);
        $this->data['evento_data'] = $this->global_sala_model->get_simple_evento_data($this->data['fecha_evento_data']['evf_id_evento']);
        $id_sala = $this->data['fecha_evento_data']['evf_id_sala'];
        $this->data['butacas_data'] = $this->global_sala_model->get_modelo_sala_butacas_data($id_sala);
        foreach($this->data['butacas_data'] as $butacas_aux) {
            $this->data['nombres']['0'][$butacas_aux['but_id_butaca']] = 'Butaca: '.$butacas_aux['but_ref'];
            $this->data['precios']['0'][$butacas_aux['but_id_butaca']] = $butacas_aux['but_area_precio'];
        }
        $this->data['mesas_data'] = $this->global_sala_model->get_modelo_sala_mesas_data($id_sala);
        foreach($this->data['mesas_data'] as $mesa_aux) {
            for ($i = 1; $i<=4;$i++) {
                $this->data['nombres'][$mesa_aux['mes_id_mesa']][$i] = 'Mesa: '.$mesa_aux['mes_ref'].' '.$i;
                $this->data['precios'][$mesa_aux['mes_id_mesa']][$i] = $mesa_aux['mes_area_precio'];
            }
            
        }
        
        $this->load->model('global_sala_model');
        $this->load->view('includes/pdf/entradas_view', $this->data);
    }
}

?>
