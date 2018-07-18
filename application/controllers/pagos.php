<?php
/**
 * This controller class loads simple named pages like "home", ppp pages etc.
 *
 * @author Pedro Escudero
 */
class Pagos extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        
        // Se incluye la librería
	include APPPATH . 'third_party/apiRedsys.php';
        
        $this->load->config('tpv_bbva');
        
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
    
    public function index($id){
        if ($this->input->post('pay')) {
                //UPDATE_RESERVAS con id_pago
            
                $this->global_sala_model->global_insert_pago();
                $this->global_sala_model->update_reservas_marcar($id);
                
                $message = (! isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];
                if (empty($message)) {
                    redirect($this->config->item('bbva_url_tpv'), 'location', 307);
                }
        }
        
        //INICIO DATOS
        $this->data['entradas_config'] = $this->config->item('entradas');
        $this->load->model('global_sala_model');
        
        $this->global_sala_model->update_datetime_reservas_bloqueadas();
        
        $this->data['id_fecha_evento'] = $id;
        
        $this->data['reservas_imprimir'] = $this->global_sala_model->get_reservas_by_session($id);
        
        if(count($this->data['reservas_imprimir'])==0) {
            redirect(site_url('compra/'.$id));
        }
        
        $this->data['time_left'] = $this->global_sala_model->get_time_left($id);
        
        $this->data['fecha_evento_data'] = $this->global_sala_model->get_fecha_evento_data($id);
        $this->data['evento_data'] = $this->global_sala_model->get_simple_evento_data($this->data['fecha_evento_data']['evf_id_evento']);
        $this->data['tipo_reservas_data'] = $this->global_sala_model->get_count_tipo_reservas_fecha($id);
        $id_sala = $this->data['fecha_evento_data']['evf_id_sala'];
        $this->data['butacas_data'] = $this->global_sala_model->get_modelo_sala_butacas_data($id_sala);
        foreach($this->data['butacas_data'] as $butacas_aux) {
            $this->data['reservas']['0'][$butacas_aux['but_id_butaca']] = $this->global_sala_model->get_reserva_by_butaca($id, $butacas_aux['but_id_butaca']);
            $this->data['nombres']['0'][$butacas_aux['but_id_butaca']] = 'Butaca: '.$butacas_aux['but_ref'];
            $this->data['precios']['0'][$butacas_aux['but_id_butaca']] = $butacas_aux['but_area_precio'];
        }
        $this->data['mesas_data'] = $this->global_sala_model->get_modelo_sala_mesas_data($id_sala);
        foreach($this->data['mesas_data'] as $mesa_aux) {
            for ($i = 1; $i<=4;$i++) {
                $this->data['reservas'][$mesa_aux['mes_id_mesa']][$i] = $this->global_sala_model->get_reserva_by_mesa_butaca($id, $mesa_aux['mes_id_mesa'], $i);
                $this->data['nombres'][$mesa_aux['mes_id_mesa']][$i] = 'Mesa: '.$mesa_aux['mes_ref'].' '.$i;
                $this->data['precios'][$mesa_aux['mes_id_mesa']][$i] = $mesa_aux['mes_area_precio'];
            }            
        }
        //FIN DATOS
        
        
        //INICIO PAGOS
        
        $sum_precio = 0;
        foreach($this->data['reservas_imprimir'] as $row) {
            $aux_precio = 0;
            $area_precio = $this->data['precios'][$row['res_id_mesa']][$row['res_id_butaca']];
            //if($row['res_precio_reducido']) {
            //    $aux_precio = $this->data['evento_data']['eve_precio_reduc_area'.$area_precio];
            //} else {
                $aux_precio = $this->data['evento_data']['eve_precio_area'.$area_precio];
            //}
            $sum_precio += $aux_precio;
            ?>
            <input type="hidden" name="print[<?php echo $row['res_id_reserva']; ?>][id]" value="<?php echo $row['res_id_reserva']; ?>"/>
            <input type="hidden" name="print[<?php echo $row['res_id_reserva']; ?>][print]" value="1"/>
            <?php
        }
        
        $miObj = new RedsysAPI;
        
        $id_pago = time();
        $importe = intval($sum_precio*100);
        
        /* Nuevo sistema */
        $code=$this->config->item('bbva_commerce');
        $terminal=$this->config->item('bbva_terminal');
        $amount=$importe;
        $currency=$this->config->item('bbva_currency');
        $transactionType='0';
        $urlMerchant=base_url().'asincrono/bbva/'.$id_pago;
        $urlOK = site_url('imprimir/'.$id_pago);
        $urlKO = site_url('compra/'.$id_pago);
        
        // Se Rellenan los campos
        $miObj->setParameter("DS_MERCHANT_AMOUNT",$amount);
        $miObj->setParameter("DS_MERCHANT_ORDER",strval($id_pago));
        $miObj->setParameter("DS_MERCHANT_MERCHANTCODE",$code);
        $miObj->setParameter("DS_MERCHANT_CURRENCY",$currency);
        $miObj->setParameter("DS_MERCHANT_TRANSACTIONTYPE",$transactionType);
        $miObj->setParameter("DS_MERCHANT_TERMINAL",$terminal);
        $miObj->setParameter("DS_MERCHANT_MERCHANTURL",$urlMerchant);
        $miObj->setParameter("DS_MERCHANT_URLOK", $urlOK);		
        $miObj->setParameter("DS_MERCHANT_URLKO", $urlKO);

        //Datos de configuración
        $version="HMAC_SHA256_V1";
        $kc = $this->config->item('bbva_encoding_key');;//Clave recuperada de CANALES
        // Se generan los parámetros de la petición

        $params = $miObj->createMerchantParameters();
        $signature = $miObj->createMerchantSignature($kc);

        // Valores de llamada
        $this->data['version'] = $version;
        $this->data['params'] = $params;
        $this->data['signature'] = $signature;
        $this->data['merchant'] = $urlMerchant;
        /*Fin nuevo sistema*/
                
        // Valores constantes del comercio
        $this->data['id_pago'] = $id_pago;
        //$this->data['order'] = date('ymdHis');
        //$this->data['url_tpv'] = $this->config->item('bbva_url_tpv');
        //$this->data['name'] = $this->config->item('bbva_commerce_name');
        //$this->data['code'] = $this->config->item('bbva_commerce');
        //$this->data['terminal'] = $this->config->item('bbva_terminal');
        //$this->data['currency'] = $this->config->item('bbva_currency');
        //$this->data['transactionType'] = '0';
        //$this->data['urlMerchant'] = base_url().'asincrono/bbva/'.$id_pago;
        $this->data['importe'] = $importe;

        // Compute hash to sign form data
        // $signature=sha1_hex($amount,$order,$code,$currency,$clave);
        //$message = $importe.$this->data['order'].$this->data['code'].$this->data['currency'].$this->data['transactionType'].$this->data['urlMerchant'].$this->config->item('bbva_tpv_key');
        //$this->data['signature'] = strtoupper(sha1($message));
        //FIN PAGOS
        
        $this->load->view('pagos_view', $this->data);
    }
}

?>
