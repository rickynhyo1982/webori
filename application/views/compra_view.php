<!DOCTYPE html>
<html lang="<?php echo $this->lang->lang(); ?>">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Sala Charivari</title>
        <?php load_view('/includes/head') ?>
        <meta name="description" content="<?php echo strip_tags($la_sala_text); ?>">
        <!-- FancyBox -->
        <link rel="stylesheet" href="/resources/style/js/fancybox/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
        <!-- Flexslider -->
        <link rel="stylesheet" href="/resources/style/css/flexslider.css?v=2.1.5" type="text/css" media="screen" />
        <!-- CountDown -->
        <link rel="stylesheet" href="/resources/style/css/jquery.countdown.css?v=1.0" type="text/css" media="screen" />
        <!-- jQuery -->
        <script src="/resources/style/js/jquery.min.js"></script>
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
                                    <li class="man-nav-option"><?php echo anchor('sala', 'La sala') ?></li>
                                    <li class="man-nav-option"><?php echo anchor(current_url().'#contact-form', 'Contacto') ?></li>
                                </ul>
                            </nav>
                            <div class="clear"></div>
                        </div>
                </div>    
            </header>
            <div id="main-content" class="wrapper odd">
                <?php $id_fecha_evento = $fecha_evento_data['evf_id_fecha_evento']; ?>
                <div class="grid-container">
                    <div class="grid-100">
                        <div class="separator-40"></div>
                        <h2>Comprar entradas para <?php echo $evento_data['eve_nombre']; ?> pase <?php echo fotmat_fecha_hora($fecha_evento_data['evf_fecha_hora']); ?></h2>
                        <p>Usa el mapa de la sala para seleccionar las entradas. Puedes seleccionar a la vez hasta 6 butacas o 1 mesa. <u>Selecciona todas las localidades que quieras comprar antes de introducir tus datos</u>. Una vez termines de seleccionar tendrás reservadas las entradas durante 5 minutos para que puedas completar la compra.</p>
                        <?php if (! empty($message)) { ?>
                        <div id="message">
                            <?php echo $message; ?>
                        </div>
                        <?php } ?>

                        <?php $primera_fila = true; ?>
                        <div class="grid-40">
                            <!-- Limpiar -->
                            <?php echo form_open(current_url()); ?>
                            <div class="little-pad">
                                <ul class="parallel-list-left">
                                <?php foreach($tipo_reservas_data as $row){ 
                                    switch ($row['res_type_reserva']) {
                                            case $entradas_config['reservas']['RESA_LIBRE']:?>
                                                    <li><img src="<?php echo site_url('imagenes/carre/'.$entradas_config['color']['COLOR_SILLA_PRECIO_2']);?>" /> <?php echo $row['num_reservas'] ?> entradas disponibles</li>
                                                    <?php
                                                    break;
                                            }
                                    } ?>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div id="seleccion"></div>
                            <?php if(!empty($time_left['restante'])) { ?>
                            <div><p><strong>Tiempo restante:</strong></p></div>
                            <?php } ?>
                            <div id="shortly"></div>
                            <?php if(empty($reservas_seleccionadas[$id_fecha_evento]['butacas']) && empty($reservas_seleccionadas[$id_fecha_evento]['mesas'])) { ?>
                            <div class="separator-20"></div>
                            <div class="little-pad">
                                <p><strong>Selecciona algunas butacas o mesas.</strong></p>
                            </div>
                            <?php } ?>
                            <?php 
                            $i = 0;
                            $total_entradas = 0;
                            if(!empty($reservas_seleccionadas[$id_fecha_evento]['butacas'])) { ?>
                                <div class="separator-20"></div>
                                <h3>Butacas seleccionadas</h3>
                                <hr/>
                                <?php 
                                foreach($reservas_seleccionadas[$id_fecha_evento]['butacas'] as $row) { 
                                $i++;
                                ?>
                                    <p><strong>Butaca <?php echo $butacas_nombre[$row]; ?></strong> (<?php echo anchor(site_url('compra/eliminar/'.$id_fecha_evento.'/0/'.$row), 'Eliminar', array('class'=>'blue-link')) ?>)</p>
                                    <ul>
                                        <?php $total_entradas += $precios[0][$row]; ?>
                                        <li><label>Precio</label> <?php echo $precios[0][$row] . '&euro;' ?></li>
                                        <li>
                                            <input type="hidden" name="update[<?php echo $i ?>][id]" value="<?php echo $reservas[0][$row]['res_id_reserva'] ?>" />
                                            <label for="reserva_<?php echo $i; ?>_name">Nombre:</label>
                                            <input type="text" id="reserva_<?php echo $i; ?>_name" name="update[<?php echo $i ?>][nombre]" value="<?php echo set_value('update['.$i.'][nombre]');?>" class="<?php if($i>1) { echo 'copy_name'; }?>" maxlength="100" required="required" />
                                        </li>
                                        <li>
                                            <label for="reserva_<?php echo $i; ?>_dni">DNI:</label>
                                            <input type="text" id="reserva_<?php echo $i; ?>_dni" name="update[<?php echo $i ?>][dni]" value="<?php echo set_value('update['.$i.'][dni]');?>" class="<?php if($i>1) { echo 'copy_dni'; }?>" maxlength="20" required="required" />
                                        </li>
                                        <li>
                                            <label for="reserva_<?php echo $i; ?>_phone">Teléfono:</label>
                                            <input type="text" id="reserva_<?php echo $i; ?>_phone" name="update[<?php echo $i ?>][telefono]" value="<?php echo set_value('update['.$i.'][telefono]');?>" class="<?php if($i>1) { echo 'copy_phone'; }?>" maxlength="20" required="required" />
                                        </li>
                                        <li>
                                            <label for="reserva_<?php echo $i; ?>_mail">Email:</label>
                                            <input type="text" id="reserva_<?php echo $i; ?>_mail" name="update[<?php echo $i ?>][email]" value="<?php echo set_value('update['.$i.'][email]');?>" class="<?php if($i>1) { echo 'copy_mail'; }?>" maxlength="50" required="required" />
                                        </li>
                                    </ul>
                                    <?php if(count($reservas_seleccionadas[$id_fecha_evento]['butacas'])>1 && $primera_fila) { ?>
                                        <p class="text-align-right">
                                            <button type="button" value="Copiar datos" class="copy_data blue-link">Copiar datos al resto de entradas</button>
                                        </p>
                                    <?php } ?>
                                    <hr/>
                                <?php 
                                $primera_fila = false;
                                } ?>
                            <?php } ?>
                            <?php if(!empty($reservas_seleccionadas[$id_fecha_evento]['mesas'])) { ?>
                                <div class="little-pad">
                                    <h3>Mesas seleccionadas</h3>
                                    <hr/>
                                    <?php 
                                    $last_nombre = '';
                                    $num_silla = 1;
                                    foreach($reservas_seleccionadas[$id_fecha_evento]['mesas'] as $row) { 
                                    ?>
                                        <?php 
                                        $i++;
                                        $j = $i;
                                        if($last_nombre==$mesas_nombre[$row['id_mesa']]) {
                                            $num_silla++;
                                        } else {
                                            $num_silla = 1;
                                        }
                                        $last_nombre = $mesas_nombre[$row['id_mesa']];
                                        ?>
                                        <p><strong><?php echo $mesas_nombre[$row['id_mesa']]; ?></strong> <?php echo $row['id_butaca']; ?> (<?php echo anchor(site_url('compra/eliminar/'.$id_fecha_evento.'/'.$row['id_mesa'].'/'.$row['id_butaca']), 'Eliminar', array('class'=>'blue-link')) ?>)</p>
                                        <ul>
                                            <?php $total_entradas += $precios[$row['id_mesa']][$row['id_butaca']]; ?>
                                            <li><label>Precio</label> <?php echo $precios[$row['id_mesa']][$row['id_butaca']] . '&euro;' ?></li>
                                            <li>
                                                <input type="hidden" name="update[<?php echo $i ?>][id]" value="<?php echo $reservas[$row['id_mesa']][$row['id_butaca']]['res_id_reserva'] ?>" />
                                                <label for="reserva_<?php echo $i; ?>_name">Nombre:</label>
                                                <input type="text" id="reserva_<?php echo $i; ?>_name" name="update[<?php echo $i ?>][nombre]" value="<?php echo set_value('update['.$i.'][nombre]');?>" class="<?php if(!$primera_fila) { echo 'copy_name'; }?>" maxlength="100" required="required" />
                                            </li>
                                            <li>
                                                <label for="reserva_<?php echo $i; ?>_dni">DNI:</label>
                                                <input type="text" id="reserva_<?php echo $i; ?>_dni" name="update[<?php echo $i ?>][dni]" value="<?php echo set_value('update['.$i.'][dni]');?>" class="<?php if(!$primera_fila) { echo 'copy_dni'; }?>" maxlength="20" required="required" />
                                            </li>
                                            <li>
                                                <label for="reserva_<?php echo $i; ?>_phone">Teléfono:</label>
                                                <input type="text" id="reserva_<?php echo $i; ?>_phone" name="update[<?php echo $i ?>][telefono]" value="<?php echo set_value('update['.$i.'][telefono]');?>" class="<?php if(!$primera_fila) { echo 'copy_phone'; }?>" maxlength="20" required="required" />
                                            </li>
                                            <li>
                                                <label for="reserva_<?php echo $i; ?>_mail">Email:</label>
                                                <input type="text" id="reserva_<?php echo $i; ?>_mail" name="update[<?php echo $i ?>][email]" value="<?php echo set_value('update['.$i.'][email]');?>" class="<?php if(!$primera_fila) { echo 'copy_mail'; }?>" maxlength="50" required="required" />
                                            </li>
                                        </ul>
                                        <?php if(count($reservas_seleccionadas[$id_fecha_evento]['mesas'])>1 && $primera_fila) { ?>
                                            <p class="text-align-right">
                                                <button type="button" value="Copiar datos" class="copy_data blue-link">Copiar datos al resto de entradas</button>
                                            </p>
                                        <?php } ?>
                                        <hr/>
                                    <?php 
                                        $primera_fila = false;
                                    } ?>
                                </div>
                            <?php } ?>
                            <?php if(!empty($reservas_seleccionadas[$id_fecha_evento]['butacas']) || !empty($reservas_seleccionadas[$id_fecha_evento]['mesas'])) { ?>
                            <div class="separator-20"></div>
                            <p><strong>Coste total de las entradas:</strong>&nbsp;<?php echo $total_entradas; ?>&euro;</p>
                            <p class="text-align-right"><button id="submit" name="comprar_entradas" type="submit" value="Comprar" class="button-link">Comprar <span class="glyphicon glyphicon-refresh"></span></button></p>
                            <?php } ?>
                            <?php echo form_close();?>
                            <!-- End Limpiar -->
                        </div>
                        <div class="grid-60 grid-parent" style="min-width: 620px !important;">
                                <?php if(!(count($reservas_seleccionadas[$id_fecha_evento]['butacas'])<6 && count($reservas_seleccionadas[$id_fecha_evento]['mesas'])<1)) { ?>
                                <div id="message">
                                    <p class="error_msg">Alcanzado el límite de localidades seleccionables</p>
                                </div>
                                <?php } ?>
                                <img width="620px" height="850px" style="display: block; margin: 0 auto; width: 620px !important; min-width: 620px !important; height: 850px !important;" src="<?php echo site_url('imagenes/disponibilidad/'.$fecha_evento_data['evf_id_sala']);?>" usemap="#mapa-sala" />
                                <?php if(count($reservas_seleccionadas[$id_fecha_evento]['butacas'])<6 && count($reservas_seleccionadas[$id_fecha_evento]['mesas'])<1) { ?>
                                <map id='mapa-sala' name="mapa-sala">
                                    <?php // mapping des buracas ?>
                                    <?php foreach($butacas_data as $row) {
                                        $id_butaca = $row['but_id_butaca'];
                                        if($reservas['0'][$id_butaca]['res_type_reserva']==0) {
                                        $title = $row['but_ref'] . ' - ' . $precios[0][$id_butaca] . '&euro;';
                                        ?>
                                        <area shape="rect" coords="<?php echo $row['but_pos_x'];?>,<?php echo $row['but_pos_y'];?>,<?php echo  $row['but_pos_x']+$entradas_config['modelos']['TAMANO_BUTACA'] ?>,<?php echo  $row['but_pos_y']+$entradas_config['modelos']['TAMANO_BUTACA'] ?>" 
                                              href="<?php echo site_url('compra').'/'.$id_fecha_evento.'/0/'.$row['but_id_butaca']?>" title="<?php echo $title; ?>">
                                    <?php 
                                        }
                                    } ?>
                                    <?php // mapping des mesas ?>
                                    <?php foreach($mesas_data as $row) {
                                        $i = 1;
                                        $title = $row['mes_ref'] . ' - ' . $precios[$row['mes_id_mesa']][$i] . '&euro;'; 
                                        ?>
                                        <area shape="rect" coords="<?php echo $row['mes_pos_x'];?>,<?php echo $row['mes_pos_y'];?>,<?php echo  $row['mes_pos_x']+$entradas_config['modelos']['TAMANO_MESA'] ?>,<?php echo  $row['mes_pos_y']+$entradas_config['modelos']['TAMANO_MESA'] ?>" 
                                              href="<?php echo site_url('compra').'/'.$id_fecha_evento.'/'.$row['mes_id_mesa'].'/0'?>" title="<?php echo $title; ?>">
                                    <?php
                                    $i++;
                                    } 
                                    ?>
                                </map>
                                <?php } ?>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="separator-20"></div>
                </div>
        </div>
        <?php load_view('/includes/footer') ?>
            
        <?php load_view('/includes/cookies') ?>
        
        <!-- FlexSlider -->
        <script defer src="/resources/style/js/jquery.flexslider-min.js"></script>
        
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
                
                $( ".copy_data" ).click(function() {
                    copyEntradaData();
                  });
                
                <?php if(!empty($time_left['restante'])) { ?>
                $('#shortly').countdown({until: +<?php echo (intval(substr($time_left['restante'],3,2))*60+intval(substr($time_left['restante'],6,2))); ?>,  
                onExpiry: liftOff, 
                format: 'MS',
                labels: ['Years', 'Months', 'Weeks', 'Days', 'Hours', 'Minutos', 'Segundos']}); 
                <?php } ?>
            });
            
            $(".thumnail-container").hover(function () {
                $(this).find(".lupa").show("fast");}, function() {
                $(this).find(".lupa").hide("fast");
            });

            function copyEntradaData() {
                //iterate through each textboxes and add the values
                $(".copy_name").val(($("#reserva_1_name").val()));
                $(".copy_dni").val(($("#reserva_1_dni").val()));
                $(".copy_phone").val(($("#reserva_1_phone").val()));
                $(".copy_mail").val(($("#reserva_1_mail").val()));
            }
            
            function liftOff() { 
                window.location.reload();
            } 
        </script>
        <?php load_view('/includes/scripts') ?>
    </body>
</html>