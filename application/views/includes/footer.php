<footer id="main-footer-wrapper" class="wrapper">
    <div class="grid-container">
        <div id="main-footer" class="grid-100 grid-parent">
            <div class="grid-100 grid-parent">
                <div class="separator-40"></div>
                <div class="grid-50 grid-parent">
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
                        <p class="text-align-right"><br><a target="google-maps" href="https://maps.google.es/maps?f=q&amp;source=embed&amp;hl=es&amp;geocode=&amp;q=Escuela+de+Circo+Charivari,+Calle+Fray+Ceferino+Gonz%C3%A1lez,+Madrid&amp;aq=0&amp;oq=escuela+de+circo+ch&amp;sll=40.408513,-3.706706&amp;sspn=0.009624,0.01929&amp;t=h&amp;g=Calle+Fray+Ceferino+Gonz%C3%A1lez,+13&amp;ie=UTF8&amp;hq=Escuela+de+Circo+Charivari,&amp;hnear=Calle+Fray+Ceferino+Gonz%C3%A1lez,+28005+Madrid&amp;ll=40.408513,-3.706706&amp;spn=0.005719,0.00912&amp;z=16&amp;iwloc=A" class="blue-link">Ver mapa más grande</a></p>
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
                                <input type="submit" name="contact" value="<?php echo lang('enviar'); ?>" class="button-link float-right">
                            </ul>
                        </fieldset>
                    <?php echo form_close();?>
                </div>
                <div class="clear"></div>
                <div class="separator-20"></div>
            </div>
            <div class="grid-100">
                <h3>Enlaces</h3>
                <ul class="parallel-list-left">
                    <?php 
                        foreach ($enlaces_externos_link as $row) { 
                    ?>
                    <li><a href="<?php echo $row['enl_destino'] ?>" target="_blank"><?php echo $row['enl_texto'] ?></a></li>
                    <?php } ?>
                </ul>
                <div class="clear"></div>
                <div class="separator-20"></div>
            </div>
            <div class="grid-100">
                <hr/>
                <p class="text-align-right"><small>&copy; <?php echo lang('); ?> <a href="" target="_blank"></a> <?php echo lang('fecha_desarrollo'); ?></small></p>
            </div>
        </div>
    </div>
</footer>