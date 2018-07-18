<?php
/**
 * This controller class loads simple named pages like "home", ppp pages etc.
 *
 * @author Pedro Escudero
 */
class compra extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        
        // IMPORTANT! This global must be defined BEFORE the flexi auth library is loaded! 
        // It is used as a global that is accessible via both models and both libraries, without it, flexi auth will not work.
        $this->auth = new stdClass;
        
        // Load 'standard' flexi auth library by default.
        $this->load->library('flexi_auth');
        
        $this->lang->load('sala');
        $this->lang->load('url');
        
        $this->load->helper('video');
        
        // Define a global variable to store data that is then used by the end view page.
        $this->data = null;
        
        //Idiomas
        $this->data['idiomas_data'] = $this->global_sala_model->get_idiomas();
        
        //Enlaces footer
        $this->data['enlaces_sociales_link'] = $this->global_sala_model->global_get_enlaces_data('social');
        $this->data['enlaces_externos_link'] = $this->global_sala_model->global_get_enlaces_data('enlace');
        $this->data['contacto_text'] = $this->global_sala_model->global_get_texto_fijo('6');
        $this->data['keywords_text'] = $this->global_sala_model->global_get_texto_fijo('8');
        $this->data['descripcion_text'] = $this->global_sala_model->global_get_texto_fijo('5');
        $this->data['formulario_text'] = $this->global_sala_model->global_get_texto_fijo('7');
        $this->data['la_sala_text'] = $this->global_sala_model->global_get_texto_fijo('3');
        //Carrusel
        //$this->data['carrusel_data'] = $this->global_sala_model->get_contenido_imagen_rand_1($espectaculo_data['cnt_id']);
        $this->data['carrusel_data'] = $this->global_sala_model->global_get_carrusel_data();
    }
    
    public function index($id, $id_mesa = '0', $id_butaca = '0'){
        if(empty($id)) {
            show_404();
        } else {
            $this->load->config('entradas');
            $this->data['entradas_config'] = $this->config->item('entradas');
            $this->load->model('global_sala_model');

            $this->global_sala_model->update_datetime_reservas_bloqueadas();

            if($id_mesa<>'0' || $id_butaca<>'0') {
                
                $reservas_bloqueadas = $this->global_sala_model->get_reservas_by_session($id);
                $reservas_sesion[$id] = array('mesas'=>array(), 'butacas'=>array());
                foreach($reservas_bloqueadas as $row) {
                    if($row[res_id_mesa]=='0') {
                        $reservas_sesion[$id]['butacas'][] = $row['res_id_butaca'];
                    } else {
                        $reservas_sesion[$id]['mesas'][] = $row['res_id_mesa'];
                    }
                }
                
                if($id_mesa<>'0') {
                    if(!in_array($id_mesa, $reservas_sesion[$id]['mesas'])) {
                        $this->global_sala_model->update_reserva_bloquear($id, $id_mesa, '1');
                        $this->global_sala_model->update_reserva_bloquear($id, $id_mesa, '2');
                        $this->global_sala_model->update_reserva_bloquear($id, $id_mesa, '3');
                        $this->global_sala_model->update_reserva_bloquear($id, $id_mesa, '4');

                        //Actualizar tiempo para todas las ya añadidas
                        $this->global_sala_model->update_datetime_reservas_bloqueadas_sesion();
                    }
                }
                if($id_butaca<>'0') {
                    if(!in_array($id_butaca, $reservas_sesion[$id]['butacas'])) {
                        $this->global_sala_model->update_reserva_bloquear($id, '0', $id_butaca);

                        //Actualizar tiempo para todas las ya añadidas
                        $this->global_sala_model->update_datetime_reservas_bloqueadas_sesion();
                    }
                }

                //recuperamos de sesión las reservas
                redirect(site_url('compra').'/'.$id.'#seleccion');
            }

            if ($this->input->post('comprar_entradas')) {
                $this->global_sala_model->update_reservas();
                redirect(site_url('pagos/'.$id));
            }
            
            $reservas_bloqueadas = $this->global_sala_model->get_reservas_by_session($id);
            $reservas_sesion[$id] = array('mesas'=>array(), 'butacas'=>array());
            foreach($reservas_bloqueadas as $row) {
                if($row['res_id_mesa']=='0') {
                    $reservas_sesion[$id]['butacas'][] = $row['res_id_butaca'];
                } else {
                    $reservas_sesion[$id]['mesas'][$row['res_id_mesa'].'-'.$row['res_id_butaca']] = array('id_mesa'=>$row['res_id_mesa'], 'id_butaca'=>$row['res_id_butaca']);
                }
            }
            
            $this->data['reservas_seleccionadas'] = $reservas_sesion;
            $this->data['time_left'] = $this->global_sala_model->get_time_left($id);


            $this->data['reservas_imprimir'] = $this->global_sala_model->get_reservas_imprimir($id);

            $this->data['fecha_evento_data'] = $this->global_sala_model->get_fecha_evento_data($id);
            $this->data['evento_data'] = $this->global_sala_model->get_simple_evento_data($this->data['fecha_evento_data']['evf_id_evento']);
            $this->data['tipo_reservas_data'] = $this->global_sala_model->get_count_tipo_reservas_fecha($id);
            $id_sala = $this->data['fecha_evento_data']['evf_id_sala'];
            $this->data['butacas_data'] = $this->global_sala_model->get_modelo_sala_butacas_data($id_sala);
            foreach($this->data['butacas_data'] as $butacas_aux) {
                $this->data['reservas']['0'][$butacas_aux['but_id_butaca']] = $this->global_sala_model->get_reserva_by_butaca($id, $butacas_aux['but_id_butaca']);
                $this->data['butacas_nombre'][$butacas_aux['but_id_butaca']] = $butacas_aux['but_ref'];
                $this->data['precios']['0'][$butacas_aux['but_id_butaca']] = $this->data['evento_data']['eve_precio_area'.$butacas_aux['but_area_precio']];
            }
            $this->data['mesas_data'] = $this->global_sala_model->get_modelo_sala_mesas_data($id_sala);
            foreach($this->data['mesas_data'] as $mesa_aux) {
                for ($i = 1; $i<=4;$i++) {
                    $this->data['reservas'][$mesa_aux['mes_id_mesa']][$i] = $this->global_sala_model->get_reserva_by_mesa_butaca($id, $mesa_aux['mes_id_mesa'], $i);
                    $this->data['precios'][$mesa_aux['mes_id_mesa']][$i] = $this->data['evento_data']['eve_precio_area'.$mesa_aux['mes_area_precio']];
                }
                $this->data['mesas_nombre'][$mesa_aux['mes_id_mesa']] = $mesa_aux['mes_ref'];
            }
            
            $this->load->view('compra_view', $this->data);
        }
    }
    
    public function eliminar($id, $id_mesa = '0', $id_butaca = '0'){
        $this->global_sala_model->update_reserva_bloqueada_sesion_clear($id, $id_mesa, $id_butaca);
        redirect(site_url('compra/'.$id.'#seleccion'));
    }
}

?>