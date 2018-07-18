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
                    <div class="grid-100 grid-parent">
                        <div class="flex-container">
                            <div class="flexslider">
                              <ul class="slides">
                                <?php 
                                if(!empty($carrusel)) {
                                $i = 0;
                                foreach($carrusel as $row) { 
                                ?>
                                <li <?php echo ($i>0)?'style="display: none"':''; ?>>
                                <img src="/resources/style/img/trick.png"
                                     style="height: 250px;
                                            width: 100%;
                                            background-size:cover; 
                                            background-position:center center;
                                            background-repeat:no-repeat; 
                                            background-image:url(/resources/uploads/carrusel/<?php echo $row['cas_imagen']; ?>);" />
                                </li>
                                <?php 
                                $i++;
                                } } ?>
                              </ul>
                            </div>
                        </div>
                    </div>
                    <div class="separator-40"></div>
                    <div class="grid-100 grid-parent">
                        <div class="grid-50">
                            <h2>La sala</h2>
                            <?php echo $la_sala_text; ?>
                        </div>
                        <div class="grid-50">
                            <h2>Características</h2>
                            <?php echo $caracteristicas_text; ?>
                        </div>
                        <div class="clear"></div>
                        <div class="separator-40"></div>
                    </div>
                </div>
                <div class="wrapper white-veil">
                    <div class="separator-20"></div>
                    <div class="grid-container">
                        <div class="grid-100 grid-parent">
                            <div class="grid-50">
                                <h3><?php echo lang('en_las_redes_sociales'); ?></h3>
                            <div class="float-left social-go">
                                <?php 
                                $i = 1;
                                foreach ($enlaces_sociales_link as $row) {	
                                ?>
                                <a href="<?php echo $row['enl_destino']; ?>" target="social<?php echo $i ?>" title="<?php echo $row['enl_texto']; ?>"><img src="/resources/uploads/enlaces/<?php echo $row['enl_icono']; ?>" alt="<?php echo $row['enl_texto']; ?>"></a>
                                <?php 
                                $i++;
                                } ?>
                            </div>
                            <div class="clear"></div>
                            </div>
                            <div class="grid-50">
                                <h3><?php echo lang('compartir'); ?></h3>
                                <div class="float-left social-share">
                                    <a href="http://www.facebook.com/share.php?u=<?php echo current_url(); ?>" target="facebook" title="Compartir en Facebook"><img src="/resources/style/img/facebook_icon.png" alt="Icono de Facebook"></a>
                                    <a href="https://twitter.com/intent/tweet?url=<?php echo current_url(); ?>" target="twitter" title="Compartir en Twitter"><img src="/resources/style/img/tweeter_icon.png" alt="Icono de Twitter"></a>
                                </div>
                            </div>
                        </div>
                        <div class="separator-20"></div>
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
                  controlNav: false,
                  slideshow: true,
                  slideshowSpeed: 4000,
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
            
            $(".thumnail-container").hover(function () {
                $(this).find(".lupa").show("fast");}, function() {
                $(this).find(".lupa").hide("fast");
            });
        </script>
        <?php load_view('/includes/scripts') ?>
    </body>
</html>