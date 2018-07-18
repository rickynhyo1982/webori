<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width" />

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Sala Charivari</title>
</head>
 
<body bgcolor="#FFFFFF" style="margin:0; padding:0; font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;-webkit-font-smoothing:antialiased; -webkit-text-size-adjust:none; width: 100%!important; height: 100%;">
<style>
@media only screen and (max-width: 600px) {
	
	a[class="btn"] { display:block!important; margin-bottom:10px!important; background-image:none!important; margin-right:0!important;}

	div[class="column"] { width: auto!important; float:none!important;}
	
	table.social div[class="column"] {
		width:auto!important;
	}

}
</style>
<!-- HEADER -->
<table style="margin:0; padding:0; width: 100%; border-bottom: 1px #6c6c6c solid;" bgcolor="#0A0A0A">
	<tr style="margin:0; padding:0;">
		<td style="margin:0; padding:0;"></td>
		<td style="margin:0; padding:0;">
				
				<div style="padding:15px; max-width:600px; margin:0 auto; display:block; ">
				<table bgcolor="#0A0A0A" style="margin:0; padding:0; width: 100%">
					<tr style="margin:0; padding:0;">
						<td style="margin:0; padding:0;"><img alt="Sala Charivari" src="<?php echo base_url(); ?>resources/style/img/logo.png" style="margin:0; padding:0; max-width: 100%;" /></td>
					</tr>
				</table>
				</div>
				
		</td>
		<td style="margin:0; padding:0;"></td>
	</tr>
</table><!-- /HEADER -->


<!-- BODY -->
<table style="margin:0; padding:0; width: 100%; border-bottom: 5px #51A2C2 solid; border-top: 5px #51A2C2 solid;">
	<tr style="margin:0; padding:0;">
		<td style="margin:0; padding:0;"></td>
		<td style="margin:0; padding:0; display:block!important; max-width:600px!important; margin:0 auto!important; /* makes it centered */ clear:both!important;" bgcolor="#FFFFFF">

			<div style="padding:15px; max-width:600px; margin:0 auto; display:block; ">
			<table style="margin:0; padding:0; width: 100%">
				<tr style="margin:0; padding:0;">
					<td style="margin:0; padding:0;">
						<h3 style="line-height: 1.1; margin-bottom:15px; color:#000; font-weight:500; font-size: 27px;">Nuevo pago realizado desde la web</h3>
						<p style="margin:0; padding:0;margin-bottom: 10px; font-weight: normal; font-size:14px; line-height:1.6;"><b>ID:</b> <?php echo $pag_id?></p>
                                                <p style="margin:0; padding:0;margin-bottom: 10px; font-weight: normal; font-size:14px; line-height:1.6;"><b>Nombre:</b> <?php echo $pag_nombre?></p>
                                                <p style="margin:0; padding:0;margin-bottom: 10px; font-weight: normal; font-size:14px; line-height:1.6;"><b>Mail:</b> <?php echo $pag_mail?></p>
						<p style="margin:0; padding:0;margin-bottom: 10px; font-weight: normal; font-size:14px; line-height:1.6;"><b>Teléfono:</b> <?php echo $pag_phone?></p>		
                                                <p style="margin:0; padding:0;margin-bottom: 10px; font-weight: normal; font-size:14px; line-height:1.6;"><b>Comentario:</b> <?php echo $pag_comentario?></p>
                                                <p style="margin:0; padding:0;margin-bottom: 10px; font-weight: normal; font-size:14px; line-height:1.6;"><b>Concepto:</b> <?php echo $pag_concepto?></p>
                                                <p style="margin:0; padding:0;margin-bottom: 10px; font-weight: normal; font-size:14px; line-height:1.6;"><b>Importe:</b> <?php echo ((float) $pag_importe)/100?>&euro;</p>
						<p style="margin:0; padding:0;margin-bottom: 10px; font-weight: normal; font-size:14px; line-height:1.6;"><b>Fecha:</b> <?php echo date('d-m-Y H:i', strtotime($pag_fecha_completado)) ?></p>
					</td>
				</tr>
			</table>
			</div><!-- /content -->
									
		</td>
		<td></td>
	</tr>
</table><!-- /BODY -->

<!-- FOOTER -->
<table style="margin:0; padding:0; width: 100%; clear:both!important; border-top: 1px #6c6c6c solid" bgcolor="#0A0A0A">
	<tr style="margin:0; padding:0;">
		<td style="margin:0; padding:0;"></td>
		<td style="margin:0; padding:0;display:block!important; max-width:600px!important; margin:0 auto!important; /* makes it centered */ clear:both!important;">
			
				<!-- content -->
				<div style="padding:15px; max-width:600px; margin:0 auto; display:block; ">
				<table style="margin:0; padding:0;">
				<tr style="margin:0; padding:0;">
					<td style="margin:0; padding:0;">
						<p style="margin:0; padding:0;margin-bottom: 10px; font-weight: normal; font-size:11px; line-height:1.3; color:#6c6c6c;">AVISO LEGAL: La información contenida en este mensaje de correo electrónico es confidencial y puede revestir el carácter de reservada. Está destinada exclusivamente a su destinatario. El acceso o uso de este mensaje, por parte de cualquier otra persona que no está autorizada, pueden ser ilegal. Si no es Usted la persona destinataria, le rogamos que proceda a eliminar su contenido.</p>
						<p style="margin:0; padding:0;margin-bottom: 10px; font-weight: normal; font-size:11px; line-height:1.3; color:#6c6c6c;">Conforme a la Ley Orgánica 15/1999, de 13 de diciembre, de Protección de Datos Personales, le comunicamos que su dirección de correo electrónico forma parte de nuestro fichero automatizado con el objetivo de poder mantener el contacto con Ud. En virtud de la ley antes citada, si desea oponerse, acceder, cancelar o rectificar sus datos, puede ejercer sus derechos a través del correo electrónico <a href="mailto:baja@rgascat.com" target="_blank" style="color:#6c6c6c;">baja@rgascat.com</a> o por escrito al domicilio de la entidad sito en C/ Fray Ceferino González, 13 CP. 28005 - Madrid - España.</p>
						<p style="margin:0; padding:0;margin-bottom: 10px; font-weight: normal; font-size:11px; line-height:1.3; color:#6c6c6c;">LEGAL NOTICE:  The information contained in this e-mail is confidential and can be considered as reserved. It´s exclusively destined to its recipient. The access or use of this message, by any another non authorized person, can be illegal.  If you're not you the intended person, we beg you that please proceed to eliminate its content.  According to the Organic Law 15/1999, of 13 of December, on Personal Data, we communicate you that your electronic address forms part of our card index automated with purpose to be able to maintain the contact with you. According to named Law, for cancellation, agreement or rectification of data, contact us, by mail <a href="mailto:baja@rgascat.com" target="_blank" style="color:#6c6c6c;">baja@rgascat.com</a> or you may address the firm at C/ Fray Ceferino González, 13 CP. 28005 - Madrid - España.</p>
					</td>
				</tr>
			</table>
				</div><!-- /content -->
				
		</td>
		<td></td>
	</tr>
</table><!-- /FOOTER -->

</body>
</html>