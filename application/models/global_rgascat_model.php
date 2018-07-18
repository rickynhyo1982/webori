<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Global_rgascat_model extends CI_Model {
	
	// The following method prevents an error occurring when $this->data is modified.
	// Error Message: 'Indirect modification of overloaded property Demo_cart_admin_model::$data has no effect'.
	public function &__get($key)
	{
		$CI =& get_instance();
		return $CI->$key;
	}
        
        ###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// IDIOMAS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
        
        function get_idiomas() {
            return $this->db->select('glo_idioma.idi_id, glo_idioma.idi_nombre, glo_idioma.idi_iso_code')
                        ->from('glo_idioma')
                        ->join('rga_idioma', 'glo_idioma.idi_id=rga_idioma.idi_id')
                        ->where('rga_idioma.idi_active', '1')
			->order_by('idi_nombre_es', 'asc')
			->get()
			->result_array();
        }
        
        ###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// TABLA DE PERSONAL
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
        
        function get_personal_data() {
		return $this->db->select('rga_personal.per_nombre, rga_personal.per_apellidos, 
                                rga_personal_idioma.per_titulo, rga_personal_idioma.per_descripcion, rga_personal.per_foto')
                        ->from('rga_personal')
                        ->join('rga_personal_idioma', 'rga_personal.per_id=rga_personal_idioma.per_id')
                        ->where('rga_personal.per_deleted !=', '1')
                        ->where('rga_personal.per_active', '1')
                        ->where('rga_personal_idioma.per_iso_idioma', $this->lang->lang())
			->order_by('rga_personal.per_orden', 'asc')
			->get()
			->result_array();
	}
        
        ###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// TABLA DE TESTIMONIOS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
        
        function get_testimonios_data() {
		return $this->db->select('tes_texto, tes_quien')
                        ->from('rga_testimonio')
                        ->where('tes_deleted !=', '1')
                        ->where('tes_active', '1')
                        ->where('tes_iso_idioma', $this->lang->lang())
			->order_by('tes_orden', 'asc')
			->get()
			->result_array();
	}
        
        ###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// TABLA DE PREMIOS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
        
        function get_premios_data() {
		return $this->db->select('pre_texto')
                        ->from('rga_premio')
                        ->where('pre_deleted !=', '1')
                        ->where('pre_active', '1')
                        ->where('pre_iso_idioma', $this->lang->lang())
			->order_by('pre_orden', 'asc')
			->get()
			->result_array();
	}
        
        ###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// TABLA DE CONTENIDOS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
        
        function get_contenidos_data($tipo) {
		return $this->db->select('cid_titulo, cid_descripcion, cid_descripcion_corta, cnt_imagen_principal, cid_uri_segment', false)
                        ->from('rga_contenido')
                        ->join('rga_contenido_idioma', 'rga_contenido.cnt_id=rga_contenido_idioma.cid_id_contenido')
                        ->where('cnt_tipo', $tipo)
                        ->where('cnt_deleted !=', '1')
                        ->where('cnt_active', '1')
                        ->where('cid_iso_idioma', $this->lang->lang())
			->order_by('cnt_orden', 'asc')
			->get()
			->result_array();
	}
        
        function get_contenidos_data_link($tipo) {
		return $this->db->select('cid_titulo, cid_uri_segment')
                        ->from('rga_contenido')
                        ->join('rga_contenido_idioma', 'rga_contenido.cnt_id=rga_contenido_idioma.cid_id_contenido')
                        ->where('cnt_tipo', $tipo)
                        ->where('cnt_deleted !=', '1')
                        ->where('cnt_active', '1')
                        ->where('cid_iso_idioma', $this->lang->lang())
			->order_by('cnt_orden', 'asc')
			->get()
			->result_array();
	}
        
        function get_contenido_row_array($url) {
            return $this->db->select('cnt_id, cid_titulo, cid_descripcion, cid_descripcion_corta, cnt_imagen_principal', false)
                    ->from('rga_contenido')
                    ->join('rga_contenido_idioma', 'rga_contenido.cnt_id=rga_contenido_idioma.cid_id_contenido')
                    ->where('cnt_deleted !=', '1')
                    ->where('cnt_active', '1')
                    ->where('cid_uri_segment', $url)
                    ->where('cid_iso_idioma', $this->lang->lang())
                    ->get()
                    ->row_array();
        }
        
        function get_contenido_imagenes_array($id) {
            return $this->db->select('cim_imagen, cim_thumnail')
                    ->from('rga_contenido_imagen')
                    ->where('cim_id_contenido', $id)
                    ->order_by('cim_orden', 'asc')
                    ->get()
                    ->result_array();
        }
        
        function get_contenido_videos_array($id) {
            return $this->db->select('cvi_thumnail, cvi_video')
                    ->from('rga_contenido_video')
                    ->where('cvi_id_contenido', $id)
                    ->order_by('cvi_orden', 'asc')
                    ->get()
                    ->result_array();
        }
        
        function get_contenidos_rand_4($tipo) {
            return $this->db->select('cnt_id, cid_titulo, cnt_imagen_principal, cid_uri_segment')
                        ->from('rga_contenido')
                        ->join('rga_contenido_idioma', 'rga_contenido.cnt_id=rga_contenido_idioma.cid_id_contenido')
                        ->where('cnt_tipo', $tipo)
                        ->where('cnt_deleted !=', '1')
                        ->where('cnt_active', '1')
                        ->where('cid_iso_idioma', $this->lang->lang())
			->order_by('RAND()', 'asc')
                        ->limit(4, 0)
			->get()
			->result_array();
	}
        
        function get_contenidos_rand_4_rand_img_1($tipo) {
            $numeros_rand = $this->db->select('cnt_id, cid_titulo, cid_uri_segment')
                        ->from('rga_contenido')
                        ->join('rga_contenido_idioma', 'rga_contenido.cnt_id=rga_contenido_idioma.cid_id_contenido')
                        ->where('cnt_tipo', $tipo)
                        ->where('cnt_deleted !=', '1')
                        ->where('cnt_active', '1')
                        ->where('cid_iso_idioma', $this->lang->lang())
			->order_by('RAND()', 'asc')
                        ->limit(4, 0)
			->get()
			->result_array();
            foreach($numeros_rand as $row) {
                $sub_result = $this->get_contenido_imagen_rand_1($row['cnt_id']);
                $row['cim_imagen'] = !empty($sub_result['cim_imagen'])?$sub_result['cim_imagen']:'';
                $result[] = $row;
            }
            return $result;
	}
        
        function get_contenido_imagen_rand_1($id) {
            return $this->db->select('cim_imagen')
                    ->from('rga_contenido_imagen')
                    ->where('cim_id_contenido', $id)
                    ->order_by('RAND()', 'asc')
                    ->limit(1)
                    ->get()
                    ->row_array();
        }
        
        ###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// TABLA DE ENLACES
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
        
        function global_get_enlaces_data($tipo = 'enlace') {
		return $this->db->select('enl_texto, enl_icono, enl_destino, enl_orden, enl_active')
                        ->from('rga_enlace')
                        ->where('enl_deleted !=', '1')
                        ->where('enl_active', '1')
                        ->where('enl_tipo', $tipo)
			->order_by('enl_orden', 'asc')
			->get()
			->result_array();
	}
        
        ###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// TABLA DE CARRUSEL
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
        
        function global_get_carrusel_data() {
		return $this->db->select('car_imagen')
                        ->from('rga_carrousel')
                        ->where('car_deleted !=', '1')
                        ->where('car_active', '1')
			->order_by('RAND()', 'asc')
			->get()
			->result_array();
	}
        
        ###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// FORMULARIO DE CONTACTO
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
        
        function global_insert_contacto() {
            $this->load->library('form_validation');

            // Set validation rules.
            $validation_rules = array(
                    array('field' => 'send_first_name', 'label' => 'Nombre', 'rules' => 'required'),
                    array('field' => 'send_message', 'label' => 'Mensaje', 'rules' => 'required'),
                    array('field' => 'send_email', 'label' => 'Email', 'rules' => 'required|valid_email'), 
                    array('field' => 'send_phone', 'label' => 'Teléfono', 'rules' => 'min_length[9]|max_length[15]|integer')
            );
            $this->form_validation->set_rules($validation_rules);

            // Validate fields.
            if ($this->form_validation->run()) {

                    $sql_insert = array(
                            'con_nombre' => $this->input->post('send_first_name'),
                            'con_mail' => $this->input->post('send_email'),
                            'con_phone' => $this->input->post('send_phone'),
                            'con_mensaje' => $this->input->post('send_message')
                    );
                    
                    //Es necesario establecer la fecha por separado, por tema de que no pase por el filtro
                    $this->db->set('`con_fecha`', 'NOW()', FALSE);

                    $this->db->insert('rga_contacto', $sql_insert);
                    
                    return TRUE;
            }
            else {
                    // Set validation errors.
                    $this->data['message'] = validation_errors('<p class="error_msg">', '</p>');

                    return FALSE;
            }
        }
        
        function global_send_contact() {
            $this->load->library('form_validation');

            // Set validation rules.
            // The custom rule 'identity_available' can be found in '../libaries/MY_Form_validation.php'.
            $validation_rules = array(
                    array('field' => 'send_first_name', 'label' => 'Nombre', 'rules' => 'required'),
                    array('field' => 'send_message', 'label' => 'Mensaje', 'rules' => 'required'),
                    array('field' => 'send_email', 'label' => 'Email', 'rules' => 'required|valid_email'), 
                    array('field' => 'send_phone', 'label' => 'Teléfono', 'rules' => 'min_length[9]|max_length[15]|integer')
            );
            
            $this->form_validation->set_rules($validation_rules);
            
            // Run the validation.
            if ($this->form_validation->run()) {
                $this->load->library('email');

                $data['nombre'] = $this->input->post('send_first_name');
                $data['telefono'] = $this->input->post('send_phone');
                $data['mail'] = $this->input->post('send_email');
                $data['mensaje'] = $this->input->post('send_message');
                
                //Send Mandrill
                $this->load->config('mandrill');
                $this->load->library('mandrill');
                $mandrill_ready = NULL;

                try {
                    $this->mandrill->init( $this->config->item('mandrill_api_key') );
                    $mandrill_ready = TRUE;
                } catch(Mandrill_Exception $e) {
                    $mandrill_ready = FALSE;
                }

                //Mensaje
                if( $mandrill_ready ) {
                    
                    $message = $this->load->view('/includes/mail/contacto', $data, TRUE);
                    
                    $email = array(
                        'html' => $message,
                        'subject' => 'Auto: Nuevo mensaje de '.$this->input->post('send_first_name'),
                        'from_email' => $this->input->post('send_email'),
                        'from_name' => $this->input->post('send_first_name'),
                        'to' => array(array('email' => 'rgascat@rgascat.com', 'name'=>'RGcascat', 'type' => 'to' ))
                        );
                    $result = $this->mandrill->messages_send($email);
                    $this->data['mail_message'] = $result;
                }

                //Confirmación
                if( $mandrill_ready ) {
                    
                    $message = $this->load->view('/includes/mail/contacto_confirmar', $data, TRUE);
                    
                    $email = array(
                        'html' => $message,
                        'subject' => 'Hola '.$this->input->post('send_first_name').', hemos recibido tu mensaje',
                        'from_email' => 'rgascat@rgascat.com',
                        'from_name' => 'RGcascat',
                        'to' => array(array('email' => $this->input->post('send_email'), 'name'=>$this->input->post('send_first_name'), 'type' => 'to' ))
                        );
                    $result = $this->mandrill->messages_send($email);
                    $this->data['mail_message'] = $result;
                }
                
                // Save any public status or error messages (Whilst suppressing any admin messages) to CI's flash session data.
                $this->session->set_flashdata('message', 'Gracias '.$this->input->post('send_first_name').', hemos recibido tu mensaje, pronto nos pondremos en contacto contigo');
                
                redirect('contacto#contact-form');
            } else {
                // Set validation errors.
                $this->data['message'] = validation_errors('<p class="error_msg">', '</p>');

                return FALSE;
            }
        }
        
        ###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// TEXTO FIJO
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
        
        function global_get_texto_fijo($id) {
		$result = $this->db->select('tid_texto')
                        ->from('rga_texto_fijo_idioma')
                        ->where('tef_id', $id)
                        ->where('tid_iso_code', $this->lang->lang())
			->get()
			->row_array();
                 return $result['tid_texto'];
	}
}
/* End of file global_charivari_model.php */
/* Location: ./application/models/global_charivari_model.php */
