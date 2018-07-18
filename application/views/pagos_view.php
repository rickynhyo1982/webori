<!DOCTYPE html>
<html lang="<?php echo $this->lang->lang(); ?>">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Sala Charivari</title>
        <?php load_view('/includes/head') ?>
        <meta name="description" content="<?php echo strip_tags($la_sala_text); ?>">
        <!-- FancyBox -->
        <link rel="stylesheet" href="/resources/style/js/fancybox/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
        
        <!-- jQuery -->
        <script src="/resources/style/js/jquery.min.js"></script>
        
        <!-- FlexSlider -->
        <script defer src="/resources/style/js/jquery.flexslider-min.js"></script>
        
        <!-- CountDown -->
        <link rel="stylesheet" href="/resources/style/css/jquery.countdown.css?v=1.0" type="text/css" media="screen" />
    </head>
    <body>
        <div>
            <header>
                <div class="grid-container">
                    <div id="main-header" class="grid-100 grid-parent box" style="background-image: url(/resources/uploads/carrusel/<?php $img_rand=$carrusel_data[0]; echo $img_rand['car_imagen']; ?>);">
                        <?php load_view('/includes/languaje_selector') ?>
                        <div class="grid-100 grid-parent">
                            <div id="main-title" class="grid-40">
                                <h1><?php echo anchor('/', '<img src="/resources/style/img/logo.png" />', array('id'=>'logo'))?></h1>
                            </div>
                        </div>
                        <div class="separator-60"></div>
                        <div class="clear"></div>
                    </div>
                    <div class="grid-100">
                            <div id="search-box">
                                <?php echo form_open('buscar', array('method'=>'get')); ?>
                                    <fieldset>
                                        <ul>
                                            <li><input type="text" id="search-input" name="q" value="" class="width-150"><input type="submit" value="Buscar" class="button-link float-right"></li>
                                            <hr>
                                        </ul>
                                    </fieldset>
                                <?php echo form_close();?>
                            </div>
                            <nav id="main-nav">
                                <ul>
                                    <li class="man-nav-option"><?php echo anchor('inicio', 'Inicio')?></li>
                                    <li class="man-nav-option"><?php echo anchor('inicio#programacion', 'Programación') ?></li>
                                    <li class="man-nav-option current"><?php echo anchor('sala', 'La sala') ?></li>
                                    <li class="man-nav-option"><?php echo anchor(current_url().'#contact-form', 'Contacto') ?></li>
                                </ul>
                            </nav>
                            <div class="clear"></div>
                        </div>
                </div>    
            </header>
            <div id="main-content" class="wrapper odd">
                <div class="grid-container">
                    <div class="separator-40"></div>
                    <div class="grid-50">
                        <h2><?php echo $evento_data['eve_nombre']; ?> pase <?php echo fotmat_fecha_hora($fecha_evento_data['evf_fecha_hora']); ?></h2>
                        <?php if(!empty($time_left['restante'])) { ?>
                        <div><p><strong>Tiempo restante:</strong></p></div>
                        <?php } ?>
                        <div id="shortly"></div>
                        <p><h3>Entradas seleccionadas</h3></p>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Localidad</th>
                                    <th>Nombre</th>
                                    <th>Teléfono</th>
                                    <th>Mail</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $entradas_config = $this->config->item('entradas');
                                foreach ($reservas_imprimir as $row) { 
                                        $reserva_id = $row['res_id_reserva'];						
                                ?>
                                <tr>
                                    <td data-title="Localidad">
                                        <input type="hidden" name="print[<?php echo $reserva_id; ?>][id]" value="<?php echo $reserva_id; ?>"/>
                                        <?php echo $nombres[$row['res_id_mesa']][$row['res_id_butaca']]; ?>
                                    </td>
                                    <td data-title="Nombre">
                                        <?php echo $row['res_nombre']; ?>
                                    </td>
                                    <td data-title="Teléfono">
                                        <?php echo $row['res_telefono']; ?>
                                    </td>
                                    <td data-title="Mail" class="last-child">
                                        <?php echo $row['res_mail']; ?>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <div class="separator-20 clear"></div>
                        <p><?php echo anchor('compra/'.$id_fecha_evento, 'Volver', array('class'=>'button-link')); ?></p>
                    </div>
                    <div class="grid-50">
                        <section>
                            <h3>Datos para el pago</h3>
                            <p>El pago se realiza con tarjeta a través de el sistema de pagos seguro de BBVA.</p>
                            <p>Al pulsar "Continuar" será redirigido a la pasarela de pagos de BBVA.</p>
                            <p>Tras introducir los datos de la tarjeta y completar el pago puede volver a nuestra página pulsando "Cerrar".</p>
                            <?php 
                            $amount = $importe;
                            $nota = '';

                            $hidden = array(
                            'Ds_Merchant_Amount' => $amount, 
                            'Ds_SignatureVersion' => $version,
                            'Ds_MerchantParameters' => $params,
                            'Ds_Signature' => $signature,
                            'urlMerchant' => $merchant,
                            'pay_concepto' => 'Entradas',
                            'pay_id' => $id_pago
                            );
                            
                            //echo form_open($url_tpv, '',$hidden);
                            echo form_open(current_url(), '',$hidden);
                            ?>
                                <fieldset>
                                    <?php if (! empty($message)) { ?>
                                        <div id="message" class="grid-100 grid-parent">
                                                <?php echo $message; ?>
                                        </div>
                                    <?php } ?>
                                    <ul>
                                        <li><h4>Datos del pago</h4></li>
                                        <li><strong>Importe total:</strong> <?php echo ((float) $amount)/100 ?>€</li>
                                        <?php if(!empty($nota)) { ?>
                                        <li><small><?php echo $nota; ?></small></li>
                                        <?php } ?>
                                    </ul>
                                </fieldset>
                                <fieldset>
                                    <ul>
                                        <input type="hidden" id="first_name" name="pay_first_name" value="<?php echo $reservas_imprimir[0]['res_nombre'];?>" required="required"/>
                                        <input type="hidden" id="email" name="pay_email" value="<?php echo $reservas_imprimir[0]['res_mail'];?>" required="required"/>
                                        <input type="hidden" id="mobile_phone" name="pay_mobile_phone" value="<?php echo $reservas_imprimir[0]['res_telefono'];?>" required="required"/>
                                        <li><label for="comments">Añadir comentarios:</label><textarea id="comments" name="pay_comments" class="width-225"><?php echo set_value('pay_comments');?></textarea></li>
                                    </ul>
                                    <hr/>
                                    <div class="grid-70">
                                        <img src="/resources/style/img/iconos_pay.png" alt="Pago seguro" />
                                    </div>
                                    <div class="grid-30">
                                        <input type="submit" name="pay" value="Continuar" class="button-link float-right" />
                                    </div>
                                </fieldset>
                            <?php echo form_close();?>
                        </section>
                    </div>
                </div>
            </div>
            <?php load_view('/includes/footer') ?>
        </div>
        
        <?php load_view('/includes/cookies') ?>
        
        <!-- Fancybox -->
        <script type="text/javascript" src="/resources/style/js/jquery.mousewheel-3.0.6.pack.js"></script>
        <script type="text/javascript" src="/resources/style/js/fancybox/jquery.fancybox.pack.js?v=2.1.5"></script>

        <!-- Countdown -->
        <script defer src="/resources/style/js/jquery.plugin.min.js"></script>
        <script defer src="/resources/style/js/jquery.countdown.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('.flexslider').flexslider({
                    animation: "slide",
                    controlNav: "thumbnails",
                    slideshow: true,
                    directionNav: false
                  });
                
                $(".fancybox").fancybox({
                        openEffect	: 'none',
                        closeEffect	: 'none'
                });

                $(".various").fancybox({
                        fitToView	: false,
                        width		: '70%',
                        height		: '70%',
                        autoSize	: true,
                        closeClick	: false,
                        openEffect	: 'none',
                        closeEffect	: 'none'
                });
                
                <?php if(!empty($time_left['restante'])) { ?>
                $('#shortly').countdown({until: +<?php echo (intval(substr($time_left['restante'],3,2))*60+intval(substr($time_left['restante'],6,2))); ?>,  
                onExpiry: liftOff, 
                format: 'MS',
                labels: ['Years', 'Months', 'Weeks', 'Days', 'Hours', 'Minutos', 'Segundos']}); 
                <?php } ?>
            });
            
            function liftOff() { 
                window.location.reload();
            } 
        </script>
        <?php load_view('/includes/scripts') ?>
    </body>
</html>