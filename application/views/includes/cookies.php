<?php if(!$this->session->userdata('cookies_closed')) { ?>
<style>
    #cookies-policy {
        position: fixed;
        bottom: 0px;
        left: 0px;
        width: 100%;
        text-align: center;
        padding-top: 5px;
        background: rgba(0, 0, 0, 0.6);
    }

    #cookies-policy a {
        color: #51A2C2;
    }

    #cookies-policy a:hover {
        color: #9EE4FF;
    }
</style>
<div id="cookies-policy">
    <p>Este sitio usa cookies. <?php echo anchor('cookies', 'Mas información'); ?>.&nbsp;<?php echo anchor('', '(cerrar)', array('id'=>'cerrar-cookies')); ?></p>
</div>
<script>
    $('#cerrar-cookies').click(function(e){
        e.preventDefault();
        $.get("<?php echo site_url('cookies/close'); ?>");
        $('#cookies-policy').fadeTo(1000,0.01).slideUp(500);
    })
</script>
<?php } ?>
