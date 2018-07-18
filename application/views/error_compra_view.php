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
                        <p id="message">
                            <span class="error_msg">El proceso de compra online está desactivado debido a una incidencia. Por favor compre las entradas diréctamente en la sala. Disculpe las molestias.</span>
                        </p>
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