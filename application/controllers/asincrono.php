<?php
/**
 * This controller class loads simple named pages like "home", ppp pages etc.
 *
 * @author Pedro Escudero
 */
class Asincrono extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        
        // API BBVA
	include APPPATH . 'third_party/apiRedsys.php';
        
        $this->load->config('tpv_bbva');
        
        // Define a global variable to store data that is then used by the end view page.
        $this->data = null;
    }
    
    public function index(){
        show_404();
        //$this->load->view('pruebas_view');
    }
    
    public function bbva($id_pago) {
        // Se crea Objeto
        $miObj = new RedsysAPI;

        $version = $this->input->post("Ds_SignatureVersion");
        $datos = $this->input->post("Ds_MerchantParameters");
        $signatureRecibida = $this->input->post("Ds_Signature");


        $decodec = $miObj->decodeMerchantParameters($datos);	
        $kc = $this->config->item('bbva_encoding_key'); //Clave recuperada de CANALES
        $firma = $miObj->createMerchantSignatureNotif($kc,$datos);
        
        $parametros['id_pago'] = $id_pago;
        $parametros['signature'] = $signatureRecibida;
        $parametros['Ds_Date'] = $miObj->getParameter('Ds_Date');
        $parametros['Ds_Hour'] = $miObj->getParameter('Ds_Hour');
        $parametros['Ds_Amount'] = $miObj->getParameter('Ds_Amount');
        $parametros['Ds_Currency'] = $miObj->getParameter('Ds_Currency');
        $parametros['Ds_Order'] = $miObj->getParameter('Ds_Order');
        $parametros['Ds_MerchantCode'] = $miObj->getParameter('Ds_MerchantCode');
        $parametros['Ds_Terminal'] = $miObj->getParameter('Ds_Terminal');
        $parametros['Ds_Response'] = $miObj->getParameter('Ds_Response');
        $parametros['Ds_MerchantData'] = $miObj->getParameter('Ds_MerchantData');
        $parametros['Ds_SecurePayment'] = $miObj->getParameter('Ds_SecurePayment');
        $parametros['Ds_TransactionType'] = $miObj->getParameter('Ds_TransactionType');
        $parametros['Ds_Card_Country'] = $miObj->getParameter('Ds_Card_Country');
        $parametros['Ds_AuthorisationCode'] = $miObj->getParameter('Ds_AuthorisationCode');
        $parametros['Ds_ConsumerLanguage'] = $miObj->getParameter('Ds_ConsumerLanguage');
        $parametros['Ds_Card_Type'] = $miObj->getParameter('Ds_Card_Type');
        $parametros['pin_firmada'] = ($firma === $signatureRecibida);
        
        $this->global_sala_model->global_insert_respuesta($parametros);
        
        if($parametros['Ds_Response']!=NULL && $parametros['Ds_Response']<99) {
        $this->global_sala_model->update_reservas_confirmar($id_pago);
        }
    }
}

?>
