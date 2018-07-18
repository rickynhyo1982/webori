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
                    <div class="grid-100">
                        <h2><?php echo $evento_data['eve_nombre']; ?> pase <?php echo fotmat_fecha_hora($fecha_evento_data['evf_fecha_hora']); ?></h2>
                        <p>Por favor imprima las entradas y llévelas impresas el día del espectáculo.</p>
                        <div class="separator-20"></div>    
                        <p><h3>Entradas compradas</h3></p>
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
                        <p class="text-align-right">
                            <?php echo anchor('pdf/'.$id_pago, 'Imprimir', array('class'=>'button-link', 'target'=>'imprimir')); ?>
                        </p>
                        <div class="separator-40"></div>
                    </div>
                </div>
            </div>
            <?php load_view('/includes/footer') ?>
        </div>
        
        <?php load_view('/includes/cookies') ?>
        
        <!-- Fancybox -->
        <script type="text/javascript" src="/resources/style/js/jquery.mousewheel-3.0.6.pack.js"></script>
        <script type="text/javascript" src="/resources/style/js/fancybox/jquery.fancybox.pack.js?v=2.1.5"></script>

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
            });
        </script>
        <?php load_view('/includes/scripts') ?>
    </body>
</html>