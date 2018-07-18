<!DOCTYPE html>
<html lang="<?php echo $this->lang->lang(); ?>">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="description" content="<?php echo strip_tags($descripcion_text); ?>">
	<title>Sala Charivari</title>
        <?php load_view('/includes/head') ?>
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
                        <div class="grid-100">
                            <nav id="main-nav">
                                <ul>
                                    <li class="man-nav-option"><?php echo anchor(lang('url_inicio'), lang('inicio'))?></li>
                                    <li class="man-nav-option current"><?php echo anchor(lang('url_contacto'), lang('contacto')) ?></li>
                                </ul>
                            </nav>
                            <div class="clear"></div>
                        </div>
                        <div class="separator-60"></div>
                    </div>
                </div>    
            </header>
            <div id="main-content" class="wrapper">
                <div class="wrapper pair">
                    <div class="grid-container">
                        <div class="grid-100">
                            <div class="grid-100 grid-parent">
                                <h2><?php echo lang('contacto'); ?></h2>
                                <div class="grid-100">
                                    <?php echo $descripcion_text; ?>
                                </div>
                            </div>
                            <div class="separator-40"></div>
                        </div>
                    </div>
                </div>
                <div class="odd wrapper">
                    <div class="grid-container">
                        <div class="grid-100 grid-parent">
                            <div class="separator-40"></div>
                            <div class="grid-100 grid-parent">
                                <div class="grid-50">
                                    <div class="grid-50">
                                        <h3><?php echo lang('datos_de_contacto'); ?></h3>
                                        <p>
                                            <?php echo $contacto_text; ?>
                                        </p>
                                    </div>
                                    <div class="grid-50">
                                        <div class="video-container">
                                            <iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.es/maps?f=q&amp;source=s_q&amp;hl=es&amp;geocode=&amp;q=Escuela+de+Circo+Charivari,+Calle+Fray+Ceferino+Gonz%C3%A1lez,+Madrid&amp;aq=0&amp;oq=escuela+de+circo+ch&amp;sll=40.408513,-3.706706&amp;sspn=0.009624,0.01929&amp;t=h&amp;g=Calle+Fray+Ceferino+Gonz%C3%A1lez,+13&amp;ie=UTF8&amp;hq=Escuela+de+Circo+Charivari,&amp;hnear=Calle+Fray+Ceferino+Gonz%C3%A1lez,+28005+Madrid&amp;ll=40.408513,-3.706706&amp;spn=0.005719,0.00912&amp;z=16&amp;iwloc=A&amp;output=embed"></iframe>
                                        </div>
                                        <p class="text-align-right"><br><a target="google-maps" href="https://maps.google.es/maps?f=q&amp;source=embed&amp;hl=es&amp;geocode=&amp;q=Escuela+de+Circo+Charivari,+Calle+Fray+Ceferino+Gonz%C3%A1lez,+Madrid&amp;aq=0&amp;oq=escuela+de+circo+ch&amp;sll=40.408513,-3.706706&amp;sspn=0.009624,0.01929&amp;t=h&amp;g=Calle+Fray+Ceferino+Gonz%C3%A1lez,+13&amp;ie=UTF8&amp;hq=Escuela+de+Circo+Charivari,&amp;hnear=Calle+Fray+Ceferino+Gonz%C3%A1lez,+28005+Madrid&amp;ll=40.408513,-3.706706&amp;spn=0.005719,0.00912&amp;z=16&amp;iwloc=A" class="button-link">Ver mapa más grande</a></p>
                                    </div>
                                </div>
                                <div class="grid-50">
                                    <?php echo form_open(current_url()); ?>
                                        <fieldset>
                                            <h3 id="contact-form"><?php echo lang('formulario_de_contacto'); ?></h3>
                                            <p><?php echo $formulario_text; ?></p>
                                            <?php if (! empty($message)) { ?>
                                                <div id="message" class="grid-100 grid-parent">
                                                        <p class="status_msg"><?php echo $message; ?></p>
                                                </div>
                                            <?php } ?>
                                            <ul>
                                                <li><label for="first_name"><?php echo lang('nombre'); ?>*:</label><input type="text" id="first_name" name="send_first_name" value="<?php echo set_value('send_first_name');?>" class="width-225"></li>
                                                <li><label for="email"><?php echo lang('mail'); ?>*:</label><input type="text" id="email" name="send_email" value="<?php echo set_value('send_email');?>" class="width-225"></li>
                                                <li><label for="phone"><?php echo lang('telefono'); ?>:</label><input type="text" id="phone" name="send_phone" value="<?php echo set_value('send_phone');?>" class="width-225"></li>
                                                <li><label for="contact_message"><?php echo lang('mensaje'); ?>*:</label><textarea id="contact_message" name="send_message" class="width-225"><?php echo set_value('send_message');?></textarea></li>
                                                <li><small>* <?php echo lang('campos_obligatorios'); ?></small></li>
                                                <hr>
                                                <input type="submit" name="contact" value="<?php echo lang('enviar'); ?>" class="button-link float-right">
                                            </ul>
                                        </fieldset>
                                    <?php echo form_close();?>
                                </div>
                            </div>
                        </div>
                        <div class="separator-40"></div>
                    </div>
                    <div class="wrapper white-veil">
                        <div class="separator-20"></div>
                        <div class="grid-container">
                            <div class="grid-100 grid-parent">
                                <div class="grid-50">
                                    <h3><?php echo lang('compartir'); ?></h3>
                                    <div class="float-left social-share">
                                        <a href="http://www.facebook.com/share.php?u=<?php echo current_url(); ?>" target="facebook" title="Compartir en Facebook"><img src="/resources/style/img/facebook_icon.png" alt="Icono de Facebook"></a>
                                        <a href="https://twitter.com/intent/tweet?url=<?php echo current_url(); ?>" target="twitter" title="Compartir en Twitter"><img src="/resources/style/img/tweeter_icon.png" alt="Icono de Twitter"></a>
                                        <div class="clear"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="separator-20"></div>
                        </div>
                    </div>
                </div>
            </div>
            <?php load_view('/includes/footer') ?>
        </div>
        
        <?php load_view('/includes/cookies') ?>

        <script type="text/javascript">
          $(function() 
            {	
                    // Fade out status messages, but ensure error messages stay visable.
                    if ($('.status_msg').length > 0)
                    {
                            $('#message').delay(4000).fadeTo(1000,0.01).slideUp(500);
                    }

            });
        </script>
        <?php load_view('/includes/scripts') ?>
    </body>
</html>