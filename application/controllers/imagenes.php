<?php
/**
 * This controller class loads simple named pages like "home", ppp pages etc.
 *
 * @author Pedro Escudero
 */
class Imagenes extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        
        // IMPORTANT! This global must be defined BEFORE the flexi auth library is loaded! 
        // It is used as a global that is accessible via both models and both libraries, without it, flexi auth will not work.
        $this->auth = new stdClass;
        
        // Load 'standard' flexi auth library by default.
        $this->load->library('flexi_auth');
        
        // Define a global variable to store data that is then used by the end view page.
        $this->data = null;
        
        
    }
    
    public function index(){
        show_404();
    }
    
    public function disponibilidad($id){
        $this->load->config('entradas');
        $this->load->helper('sala_image');
        $this->load->model('global_sala_model');
        
        $this->data['sala_data'] = $this->global_sala_model->get_modelo_sala_data($id);
        $this->data['evento_data'] = $this->global_sala_model->get_fecha_evento_from_sala($id);
        $this->data['butacas_data'] = $this->global_sala_model->get_modelo_sala_butacas_data($id);
        if(!empty($this->data['evento_data']['evf_id_fecha_evento'])) {
            foreach($this->data['butacas_data'] as $butacas_aux) {
                $this->data['reservas']['0'][$butacas_aux['but_id_butaca']] = $this->global_sala_model->get_reserva_by_butaca($this->data['evento_data']['evf_id_fecha_evento'], $butacas_aux['but_id_butaca']);
            }
        }
        $this->data['mesas_data'] = $this->global_sala_model->get_modelo_sala_mesas_data($id);
        if(!empty($this->data['evento_data']['evf_id_fecha_evento'])) {
            foreach($this->data['mesas_data'] as $mesa_aux) {
                for ($i = 1; $i<=4;$i++) {
                    $this->data['reservas'][$mesa_aux['mes_id_mesa']][$i] = $this->global_sala_model->get_reserva_by_mesa_butaca($this->data['evento_data']['evf_id_fecha_evento'], $mesa_aux['mes_id_mesa'], $i);
                }
            }
        }
        $this->data['mesas_largas_data'] = $this->global_sala_model->get_modelo_sala_mesas_largas_data($id);
        
        $this->load->model('global_sala_model');
        $this->load->view('includes/imagenes/disponibilidad_view', $this->data);
    }
    
    public function carre($color) {
        $this->data['color'] = $color;
        $this->load->view('includes/imagenes/carre_view', $this->data);
    }
}