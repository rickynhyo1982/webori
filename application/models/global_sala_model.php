<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Global_sala_model extends CI_Model {
	
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
                        ->join('sal_idioma', 'glo_idioma.idi_id=sal_idioma.idi_id')
                        ->where('sal_idioma.idi_active', '1')
			->order_by('idi_nombre_es', 'asc')
			->get()
			->result_array();
        }
        
        ###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// TABLA DE CONTENIDOS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
        
        function get_contenidos_data($tipo) {
		return $this->db->select('cnt_id, cid_titulo, cid_descripcion, cid_descripcion_corta, cnt_imagen_principal, cid_uri_segment', false)
                        ->from('sal_contenido')
                        ->join('sal_contenido_idioma', 'sal_contenido.cnt_id=sal_contenido_idioma.cid_id_contenido')
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
                        ->from('sal_contenido')
                        ->join('sal_contenido_idioma', 'sal_contenido.cnt_id=sal_contenido_idioma.cid_id_contenido')
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
                    ->from('sal_contenido')
                    ->join('sal_contenido_idioma', 'sal_contenido.cnt_id=sal_contenido_idioma.cid_id_contenido')
                    ->where('cnt_deleted !=', '1')
                    ->where('cnt_active', '1')
                    ->where('cid_uri_segment', $url)
                    ->where('cid_iso_idioma', $this->lang->lang())
                    ->get()
                    ->row_array();
        }
        
        function get_contenido_imagenes_array($id) {
            return $this->db->select('cim_imagen, cim_thumnail')
                    ->from('sal_contenido_imagen')
                    ->where('cim_id_contenido', $id)
                    ->order_by('cim_orden', 'asc')
                    ->get()
                    ->result_array();
        }
        
        function get_contenido_videos_array($id) {
            return $this->db->select('cvi_thumnail, cvi_video')
                    ->from('sal_contenido_video')
                    ->where('cvi_id_contenido', $id)
                    ->order_by('cvi_orden', 'asc')
                    ->get()
                    ->result_array();
        }
        
        function get_contenidos_rand_4($tipo) {
            return $this->db->select('cnt_id, cid_titulo, cnt_imagen_principal, cid_uri_segment')
                        ->from('sal_contenido')
                        ->join('sal_contenido_idioma', 'sal_contenido.cnt_id=sal_contenido_idioma.cid_id_contenido')
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
                        ->from('sal_contenido')
                        ->join('sal_contenido_idioma', 'sal_contenido.cnt_id=sal_contenido_idioma.cid_id_contenido')
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
                    ->from('sal_contenido_imagen')
                    ->where('cim_id_contenido', $id)
                    ->order_by('RAND()', 'asc')
                    ->limit(1)
                    ->get()
                    ->row_array();
        }
        
        function get_contenido_imagen_rand_4($id) {
            return $this->db->select('cim_imagen, cim_thumnail')
                    ->from('sal_contenido_imagen')
                    ->where('cim_id_contenido', $id)
                    ->order_by('RAND()', 'asc')
                    ->limit(4)
                    ->get()
                    ->result_array();
        }
        
        function get_contenido_video_rand_1($id) {
            return $this->db->select('cvi_thumnail, cvi_video')
                    ->from('sal_contenido_video')
                    ->where('cvi_id_contenido', $id)
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
                        ->from('sal_enlace')
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
                        ->from('sal_carrousel')
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

                    $this->db->insert('sal_contacto', $sql_insert);
                    
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
                        'from_email' => 'salacharivari@rgascat.com',
                        'from_name' => $this->input->post('send_first_name'),
                        'headers' => array('Reply-To'=>$this->input->post('send_email')),
                        'to' => array(array('email' => 'salacharivari@rgascat.com', 'name'=>'RGcascat', 'type' => 'to' ))
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
                        'from_email' => 'salacharivari@rgascat.com',
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
                        ->from('sal_texto_fijo_idioma')
                        ->where('tef_id', $id)
                        ->where('tid_iso_code', $this->lang->lang())
			->get()
			->row_array();
                 return $result['tid_texto'];
	}
        
        ###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// PUBLICIDAD
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
        
        function get_publicidad_data() {
		return $this->db->select('pub_imagen, pub_orden, pub_active, pub_texto, pub_enlace')
                        ->from('sal_publi')
                        ->join('sal_publi_idioma', 'sal_publi.pub_id=sal_publi_idioma.pub_id')
                        ->where('pub_deleted !=', '1')
                        ->where('pub_active', '1')
                        ->where('pid_iso_code', $this->lang->lang())
			->order_by('pub_orden', 'asc')
			->get()
			->result_array();
	}
        
        ###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// CARRUSEL SALA
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
        
        function get_carrusel_sala_data() {
		return $this->db->select('cas_imagen, cas_id')
                        ->from('sal_carrousel_sala')
                        ->where('cas_deleted !=', '1')
                        ->where('cas_active', '1')
			->order_by('cas_orden', 'asc')
			->get()
			->result_array();
	}
        
        ###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// TPV
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
        
        function global_insert_pago() {
                    
        $this->load->library('form_validation');

            // Set validation rules.
            $this->form_validation->set_rules('pay_first_name', 'Nombre', 'required');
            $this->form_validation->set_rules('pay_email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('pay_mobile_phone', 'Teléfono móvil', 'required|min_length[9]|max_length[15]|integer');
            
            $this->form_validation->set_rules('pay_comments');
            $this->form_validation->set_rules('pay_id');
            $this->form_validation->set_rules('Ds_Merchant_Amount');
            $this->form_validation->set_rules('Ds_SignatureVersion');
            $this->form_validation->set_rules('Ds_MerchantParameters');
            $this->form_validation->set_rules('Ds_Signature');
            $this->form_validation->set_rules('pay_concepto');

            // Validate fields.
            if ($this->form_validation->run()) {
                    
                    $sql_insert = array(
                            'pag_id' => $this->input->post('pay_id'),
                            'pag_nombre' => $this->input->post('pay_first_name'),
                            'pag_concepto' => $this->input->post('pay_concepto'),
                            'pag_importe' => $this->input->post('Ds_Merchant_Amount'),
                            'pag_estado' => '2',
                            'pag_mail' => $this->input->post('pay_email'),
                            'pag_phone' => $this->input->post('pay_mobile_phone'),
                            'pag_comentario' => $this->input->post('pay_comments')
                    );

                    //Es necesario establecer la fecha por separado, por tema de que no pase por el filtro
                    $this->db->set('`pag_fecha_solicitud`', 'NOW()', FALSE);
                    
                    $this->db->insert('sal_pago', $sql_insert);
            }
            else {
                    // Set validation errors.
                    $this->data['message'] = validation_errors('<p class="error_msg">', '</p>');

                    return FALSE;
            }
            
        }
        
        function global_insert_respuesta($parametros) {
            
        $id_pago = $parametros['id_pago'];
                    
        $sql_insert = array(
                'pag_id' => $id_pago,
                'Ds_ErrorCode' => '',
                'Ds_TransactionType' => $parametros['Ds_TransactionType'],
                'Ds_Card_Country' => $parametros['Ds_Card_Country'],
                'Ds_SecurePayment' => $parametros['Ds_SecurePayment'],
                'Ds_Order' => $parametros['Ds_Order'],
                'Ds_Signature' => '',
                'Ds_Response' => $parametros['Ds_Response'],
                'Ds_AuthorisationCode' => $parametros['Ds_AuthorisationCode'],
                'Ds_Currency' => $parametros['Ds_Currency'],
                'Ds_ConsumerLanguage' => $parametros['Ds_ConsumerLanguage'],
                'Ds_MerchantCode' => $parametros['Ds_MerchantCode'],
                'Ds_Amount' => $parametros['Ds_Amount'],
                'Ds_Terminal' => $parametros['Ds_Terminal'],
                'pin_firmada' => $parametros['pin_firmada']
        );
        
        //Es necesario establecer la fecha por separado, por tema de que no pase por el filtro
        $this->db->set('`Ds_time`', 'NOW()', FALSE);

        $this->db->insert('sal_pago_intento', $sql_insert);
        
        if($parametros['Ds_Response']=='0000') {
            $sql_update = array(
            'pag_estado' => '1'
            );

            $this->db->set('pag_fecha_completado', 'NOW()', FALSE);

            $this->db->where('pag_id', $id_pago);
            $this->db->update('sal_pago', $sql_update);
            
            $datos_pago = $this->db->select('pag_id, pag_nombre, pag_importe, pag_concepto, pag_mail, pag_phone, pag_fecha_completado, pag_comentario')
                        ->from('sal_pago')
                        ->where('pag_id', $id_pago)
			->get()
			->row_array();
            
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

                $message = $this->load->view('/includes/mail/pago', $datos_pago, TRUE);

                $email = array(
                    'html' => $message,
                    'subject' => 'Nuevo pago de '.$datos_pago['pag_nombre'],
                    'from_email' => 'salacharivari@rgascat.com',
                    'from_name' => 'Auto: Sala Charivari',
                    'headers' => array('Reply-To'=>$datos_pago['pag_mail']),
                    'to' => array(array('email' => 'salacharivari@rgascat.com', 'name'=>'Sala Charivari', 'type' => 'to' ))
                    );
                $result = $this->mandrill->messages_send($email);
                $this->data['mail_message'] = $result;
            }

            //Confirmación
            if( $mandrill_ready ) {

                $message = $this->load->view('/includes/mail/pago_confirmar', $datos_pago, TRUE);

                $email = array(
                    'html' => $message,
                    'subject' => 'Hola '.$datos_pago['pag_nombre'].', hemos recibido tu pago con tarjeta',
                    'from_email' => 'salacharivari@rgascat.com',
                    'from_name' => 'Sala Charivari',
                    'to' => array(array('email' => $datos_pago['pag_mail'], 'name'=>$datos_pago['pag_nombre'], 'type' => 'to' ))
                    );
                $result = $this->mandrill->messages_send($email);
                $this->data['mail_message'] = $result;
            }
        }
        
        ###+++++++++++++++++++++++++++++++++###
        }
        
        ###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// Gestión de entradas
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
        
        function get_fechas_evento_data($id) {
		return $this->db->select('cid_titulo, evf_id_fecha_evento, evf_fecha_hora, eve_nombre, evf_active, eve_precio_area1, eve_precio_area2, eve_precio_area3, eve_precio_area4, eve_precio_reduc_area1, eve_precio_reduc_area2,  eve_precio_reduc_area3,  eve_precio_reduc_area4')
                        ->from('sal_evento_fecha')
                        ->join('sal_evento', 'evf_id_evento=eve_id_evento')
                        ->join('sal_contenido_idioma', 'cid_id_contenido=eve_id_cnt')
                        ->where('eve_id_cnt', $id)
                        ->where('evf_deleted', '0')
                        ->where('evf_active', '1')
                        ->where('eve_deleted', '0')
                        ->where('cid_iso_idioma', $this->lang->lang())
			->order_by('evf_fecha_hora')
			->get()
			->result_array();
	}
        
        function get_fechas_evento_espectaculo_data() {
		return $this->db->select('cid_titulo, evf_id_fecha_evento, evf_fecha_hora, eve_nombre, evf_active, eve_precio_area1, eve_precio_area2, eve_precio_area3, eve_precio_area4, eve_precio_reduc_area1, eve_precio_reduc_area2,  eve_precio_reduc_area3,  eve_precio_reduc_area4')
                        ->from('sal_evento_fecha')
                        ->join('sal_evento', 'evf_id_evento=eve_id_evento')
                        ->join('sal_contenido_idioma', 'cid_id_contenido=eve_id_cnt')
                        ->where('evf_deleted', '0')
                        ->where('evf_active', '1')
                        ->where('eve_deleted', '0')
                        ->where('cid_iso_idioma', $this->lang->lang())
			->order_by('evf_fecha_hora')
                        ->limit(20)
			->get()
			->result_array();
	}
        
        ###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// MODELOS DE SALA
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
        
        function get_modelo_sala_data($id) {
		return $this->db->select('saa_id_sala, saa_nombre, saa_modelo')
                        ->from('sal_sala')
                        ->where('saa_id_sala', $id)
			->get()
			->row_array();
	}
        
        function get_modelos_sala_data() {
		return $this->db->select('saa_id_sala, saa_nombre')
                        ->from('sal_sala')
                        ->where('saa_modelo', '1')
			->order_by('saa_nombre', 'asc')
			->get()
			->result_array();
	}
        
        function get_modelo_sala_butacas_data($id) {
		return $this->db->select('but_id_butaca, but_ref, but_pos_x, but_pos_y, but_area_precio')
                        ->from('sal_butaca')
                        ->where('but_id_sala', $id)
			->order_by('but_pos_y')
                        ->order_by('but_pos_x')
			->get()
			->result_array();
	}
        
        function get_modelo_sala_mesas_data($id) {
		return $this->db->select('mes_id_mesa, mes_ref, mes_pos_x, mes_pos_y, mes_area_precio, mes_nb_sillas')
                        ->from('sal_mesa')
                        ->where('mes_id_sala', $id)
                        ->order_by('mes_nb_sillas', 'desc')
			->order_by('mes_pos_x')
                        ->order_by('mes_pos_y')
			->get()
			->result_array();
	}
        
        function get_modelo_sala_mesas_largas_data($id) {
		return $this->db->select('mel_id_mesa, mel_ref, mel_pos_x, mel_pos_y, mel_vertical')
                        ->from('sal_mesa_larga')
                        ->where('mel_id_sala', $id)
                        ->order_by('mel_vertical')
			->order_by('mel_pos_x')
                        ->order_by('mel_pos_y')
			->get()
			->result_array();
	}
        
        function get_numero_asientos_modelos_sala_data($id) {
                $retorno['mesas'] = $this->get_count_mesas_sala($id);
                $retorno['butacas'] = $this->get_count_butacas_sala($id);
                $retorno['mesas_largas'] = $this->get_count_mesas_largas_sala($id);
		return $retorno;
	}
        
        function get_count_butacas_sala($id) {
            $butacas_aux = $this->db->select('count(but_id_butaca) as num_butacas')
                        ->from('sal_butaca')
                        ->where('but_id_sala', $id)
                        ->group_by('but_id_sala')
			->get()
			->row_array();
            return empty($butacas_aux['num_butacas'])?'0':$butacas_aux['num_butacas'];
        }
        
        function get_count_mesas_sala($id) {
            $mesas_aux = $this->db->select('count(mes_id_mesa) as num_mesas')
                        ->from('sal_mesa')
                        ->where('mes_id_sala', $id)
                        ->group_by('mes_id_sala')
			->get()
			->row_array();
            return empty($mesas_aux['num_mesas'])?'0':$mesas_aux['num_mesas'];
        }
        
        function get_count_mesas_largas_sala($id) {
            $mesas_largas_aux = $this->db->select('count(mel_id_mesa) as num_mesas_largas')
                        ->from('sal_mesa_larga')
                        ->where('mel_id_sala', $id)
                        ->group_by('mel_id_sala')
			->get()
			->row_array();
            return empty($mesas_largas_aux['num_mesas_largas'])?'0':$mesas_largas_aux['num_mesas_largas'];
        }
        
        ###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// EVENTOS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
        
        function get_eventos_data() {
		return $this->db->select('eve_id_evento, eve_nombre')
                        ->from('sal_evento')
                        ->where('eve_deleted', '0')
			->order_by('eve_nombre', 'desc')
			->get()
			->result_array();
	}
        
        function get_evento_data($id) {
		return $this->db->select('eve_id_evento, eve_nombre, eve_precio_area1, eve_precio_area2, eve_precio_area3, eve_precio_area4,
                    eve_precio_reduc_area1, eve_precio_reduc_area2, eve_precio_reduc_area3, eve_precio_reduc_area4, 
                    eve_web, eve_imagen_principal, cnt_titulo_defecto, saa_nombre, eve_id_cnt, eve_id_sala')
                        ->from('sal_evento')
                        ->join('sal_contenido', 'eve_id_cnt=cnt_id')
                        ->join('sal_sala', 'eve_id_sala=saa_id_sala')
                        ->where('eve_deleted', '0')
                        ->where('eve_id_evento', $id)
			->order_by('eve_nombre', 'desc')
			->get()
			->row_array();
	}
        
        function get_simple_evento_data($id) {
		return $this->db->select('eve_id_evento, eve_nombre, eve_precio_area1, eve_precio_area2, eve_precio_area3, eve_precio_area4,
                    eve_precio_reduc_area1, eve_precio_reduc_area2, eve_precio_reduc_area3, eve_precio_reduc_area4, eve_imagen_principal, eve_web')
                        ->from('sal_evento')
                        ->where('eve_deleted', '0')
                        ->where('eve_id_evento', $id)
			->order_by('eve_nombre', 'desc')
			->get()
			->row_array();
	}
        
        function get_fecha_evento_data($id) {
		return $this->db->select('evf_id_fecha_evento, evf_id_evento, evf_fecha_hora, evf_id_sala, evf_active')
                        ->from('sal_evento_fecha')
                        ->where('evf_id_fecha_evento', $id)
			->get()
			->row_array();
	}
        
        function get_fecha_evento_from_sala($id) {
		return $this->db->select('evf_id_fecha_evento')
                        ->from('sal_evento_fecha')
                        ->where('evf_id_sala', $id)
			->get()
			->row_array();
	}
        
        function get_fechas_evento_activo_data($id) {
		return $this->db->select('evf_fecha_hora')
                        ->from('sal_evento_fecha')
                        ->where('evf_id_evento', $id)
                        ->where('evf_active', '1')
                        ->where('evf_deleted', '0')
			->order_by('evf_fecha_hora')
			->get()
			->result_array();
	}
        
        ###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// RESERVAS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
        
        function get_reservas_by_fecha_evento($id_fecha_evento) {
            return $this->db->select('res_id_reserva, res_id_fecha_evento, res_id_butaca, res_type_reserva, res_nombre, res_dni, res_telefono, res_mail, res_impresa, res_horodate, res_id_mesa, res_precio_reducido')
                        ->from('sal_reserva')
                        ->where('res_id_fecha_evento', $id_fecha_evento)
                        ->order_by('res_id_mesa', 'desc')
			->order_by('res_id_butaca', 'asc')
			->get()
			->result_array();
        }
        
        function get_reserva_data($id) {
            return $this->db->select('res_id_reserva, res_id_fecha_evento, res_id_butaca, res_type_reserva, res_nombre, res_dni, res_telefono, res_mail, res_impresa, res_horodate, res_id_mesa, res_precio_reducido')
                        ->from('sal_reserva')
                        ->where('res_id_reserva', $id)
			->get()
			->row_array();
        }
        
        function get_reservas_imprimir($id) {
            return $this->db->select('res_id_reserva, res_id_fecha_evento, res_id_butaca, res_type_reserva, res_nombre, res_dni, res_telefono, res_mail, res_impresa, res_horodate, res_id_mesa, res_precio_reducido')
                        ->from('sal_reserva')
                        ->where('res_id_fecha_evento', $id)
                        ->where('res_impresa', '0')
                        ->where('res_username', $this->flexi_auth->get_user_identity())
			->get()
			->result_array();
        }
        
        function get_reservas_by_session($id) {
            return $this->db->select('res_id_reserva, res_id_fecha_evento, res_id_butaca, res_id_mesa, res_type_reserva, res_nombre, res_dni, res_telefono, res_mail')
                        ->from('sal_reserva')
                        ->where('res_id_fecha_evento', $id)
                        ->where('res_session_id', $this->session->userdata('session_id'))
			->get()
			->result_array();
        }
        
        function get_reservas_by_pago($id) {
            return $this->db->select('res_id_reserva, res_id_fecha_evento, res_id_butaca, res_id_mesa, res_type_reserva, res_nombre, res_dni, res_telefono, res_mail')
                        ->from('sal_reserva')
                        ->where('res_id_pago', $id)
			->get()
			->result_array();
        }
        
        function get_time_left($id) {
            return $this->db->select('TIMEDIFF(res_fecha_hora_bloqueo, NOW()) restante', false)
                        ->from('sal_reserva')
                        ->where('res_id_fecha_evento', $id)
                        ->where('res_session_id', $this->session->userdata('session_id'))
			->get()
			->row_array();
        }
        
        function get_reserva_by_mesa_butaca($id_fecha_evento, $id_mesa, $id_butaca) {
            return $this->db->select('res_id_reserva, res_id_fecha_evento, res_id_butaca, res_type_reserva, res_last_type_reserva, res_nombre, res_dni, res_telefono, res_mail, res_impresa, res_horodate, res_id_mesa, res_precio_reducido')
                        ->from('sal_reserva')
                        ->where('res_id_fecha_evento', $id_fecha_evento)
                        ->where('res_id_mesa', $id_mesa)
                        ->where('res_id_butaca', $id_butaca)
			->get()
			->row_array();
        }
        
        function get_reservas_by_fecha_evento_data($id_fecha_evento) {
            return $this->db->select('res_id_reserva, res_id_fecha_evento, res_id_butaca, res_type_reserva, res_nombre, res_dni, res_telefono, res_mail, res_impresa, res_horodate, res_id_mesa, res_precio_reducido')
                        ->from('sal_reserva')
                        ->where('res_id_fecha_evento', $id_fecha_evento)
                        ->where('res_id_mesa', $id_mesa)
                        ->where('res_id_butaca', $id_butaca)
			->get()
			->row_array();
        }
        
        function get_reserva_by_butaca($id_fecha_evento, $id_butaca) {
            return $this->get_reserva_by_mesa_butaca($id_fecha_evento, '0', $id_butaca);
        }
        
        function get_entradas_data() {
		return $this->db->select('eve_nombre, evf_id_sala, evf_fecha_hora, evf_id_evento, evf_id_fecha_evento, evf_active')
                        ->from('sal_evento')
                        ->join('sal_evento_fecha', 'evf_id_evento=eve_id_evento')
                        ->where('eve_deleted', '0')
                        ->where('evf_deleted', '0')
                        ->where('evf_active', '1')
                        //->where('evf_fecha_hora >=', 'NOW()')
                        ->order_by('evf_active', 'desc')
			->order_by('evf_fecha_hora', 'desc')
			->get()
			->result_array();
	}
        
        function get_count_tipo_reservas_fecha($id) {
            $butacas_aux = $this->db->select('res_type_reserva, count(res_type_reserva) as num_reservas')
                        ->from('sal_reserva')
                        ->where('res_id_fecha_evento', $id)
                        ->group_by('res_type_reserva')
			->get()
			->result_array();
            return $butacas_aux;
        }
        
        function update_reservas() {
            foreach($this->input->post('update') as $row) {
                $this->db->trans_start();
                $tipo_reserva = $row['type'];
                $sql_update = array(
                    'res_nombre' => $row['nombre'],
                    'res_dni' => $row['dni'],
                    'res_telefono' => $row['telefono'],
                    'res_mail' => $row['email'],
                    'res_horodate' => date("Y-m-d H:i:s"),
                    'res_precio_reducido' => '0' //TODO
                    );
                
                $id = $row['id'];
                $this->db->where('res_id_reserva', $id);
                $this->db->update('sal_reserva', $sql_update);
                
                /*$sql_update = array(
                    'vnn_username' => $this->flexi_auth->get_user_identity(),
                    'vnn_horodate' => date("Y-m-d H:i:s"),
                    'vnn_id_reserva' => $id,
                    'vnn_action' =>  $row['type'],
                    'vnn_param' => $row['nombre'].' - '.$row['dni'].' - '.$row['telefono'].' - '.$row['email'],
                    'vnn_ip' => $this->session->userdata('ip_address')
                    );
                $this->db->insert('sal_venta_entrada', $sql_update);*/
                
                $resultado = $this->db->trans_complete();
                if($resultado) {
                    $this->session->unset_userdata('reservas_seleccionadas');
                }
            }
                    
            // Set a custom status message stating that data has been successfully updated.
            $this->flexi_auth->set_status_message('Data successfully updated.', 'public', TRUE);

            // Set a message to the CI flashdata so that it is available after the page redirect.
            $this->session->set_flashdata('message', $this->flexi_auth->get_messages('admin'));
        }
        
        function update_reserva_impresa($id) {
            $sql_update = array(
                    'res_impresa' => '1',
                    'res_horodate' => date("Y-m-d H:i:s"),
                    'res_username' => $this->flexi_auth->get_user_identity()
                    );
            $this->db->where('res_id_reserva', $id);
            $this->db->update('sal_reserva', $sql_update);
        }
        
        function update_reserva_bloquear($id_fecha_evento, $id_mesa, $id_butaca) {
            $sql_update = array(
                    'res_type_reserva' => '10',
                    'res_session_id' => $this->session->userdata('session_id'),
                    'res_last_type_reserva' => '0'
                    );
            $this->db->set('res_fecha_hora_bloqueo', 'DATE_ADD(NOW( ), INTERVAL 5 MINUTE)', FALSE);
            $this->db->where('res_type_reserva', '0');
            $this->db->where('res_id_fecha_evento', $id_fecha_evento);
            $this->db->where('res_session_id', null);
            $this->db->where('res_id_mesa', $id_mesa);
            $this->db->where('res_id_butaca', $id_butaca);
            $this->db->update('sal_reserva', $sql_update);
        }
        
        function update_reservas_marcar($id_fecha_evento) {
            $sql_update = array(
                    'res_id_pago' => $this->input->post('pay_id')
                    );
            $this->db->set('res_fecha_hora_bloqueo', 'DATE_ADD(NOW( ), INTERVAL 5 MINUTE)', FALSE);
            $this->db->where('res_type_reserva', '10');
            $this->db->where('res_session_id', $this->session->userdata('session_id'));
            $this->db->where('res_id_fecha_evento', $id_fecha_evento);

            $this->db->update('sal_reserva', $sql_update);
        }
        
        function update_reservas_confirmar($id_pago) {
            $sql_update = array(
                    'res_type_reserva' => '6',
                    'res_fecha_hora_bloqueo' => null,
                    'res_session_id' => null
                    );
            $this->db->where('res_id_pago', $id_pago);

            $this->db->update('sal_reserva', $sql_update);
        }
        
        function update_datetime_reservas_bloqueadas_sesion() {
            $this->db->set('res_fecha_hora_bloqueo', 'DATE_ADD(NOW( ), INTERVAL 5 MINUTE)', FALSE);
            $this->db->where('res_type_reserva', '10');
            $this->db->where('res_session_id', $this->session->userdata('session_id'));
            $this->db->update('sal_reserva');
        }
        
        function update_datetime_reservas_bloqueadas() {
            $sql_update = array(
                    'res_type_reserva' => '0',
                    'res_fecha_hora_bloqueo' => null,
                    'res_session_id' => null
                    );
            $this->db->set('res_type_reserva', 'res_last_type_reserva', FALSE);
            $this->db->set('res_last_type_reserva', null);
            $this->db->where('res_fecha_hora_bloqueo <', 'NOW()', false);
            $this->db->update('sal_reserva', $sql_update);
        }
        
        function update_reservas_bloqueadas_sesion_clear($id_fecha_evento) {
            $sql_update = array(
                    'res_type_reserva' => '0',
                    'res_fecha_hora_bloqueo' => null,
                    'res_session_id' => null
                    );
            $this->db->set('res_last_type_reserva', null);
            $this->db->where('res_id_fecha_evento', $id_fecha_evento);
            $this->db->where('res_session_id', $this->session->userdata('session_id'));
            $this->db->update('sal_reserva', $sql_update);
        }
        
        function update_reserva_bloqueada_sesion_clear($id_fecha_evento, $id_mesa, $id_butaca) {
            $sql_update = array(
                    'res_type_reserva' => '0',
                    'res_last_type_reserva' => null,
                    'res_fecha_hora_bloqueo' => null,
                    'res_session_id' => null
                    );
            $this->db->where('res_id_fecha_evento', $id_fecha_evento);
            $this->db->where('res_id_mesa', $id_mesa);
            $this->db->where('res_id_butaca', $id_butaca);
            $this->db->where('res_session_id', $this->session->userdata('session_id'));
            $this->db->update('sal_reserva', $sql_update);
        }
        
        ###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// TABLA DE PUBLICIDAD PARA ENTRADAS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
        
        function get_publicidad_entradas_data() {
		return $this->db->select('pue_id, pue_imagen')
                        ->from('sal_publi_entrada')
			->order_by('pue_id', 'asc')
			->get()
			->result_array();
	}
}
/* End of file global_charivari_model.php */
/* Location: ./application/models/global_charivari_model.php */
