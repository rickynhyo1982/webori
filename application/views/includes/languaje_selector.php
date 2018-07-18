<?php
if(sizeof($idiomas_data)>1) {
?>
<div id="languages">
    <ul class="black-veil">
        <li>·</li>
        <?php 
        foreach($idiomas_data as $row) { 
        ?>
            <li>
                <?php if($row['idi_iso_code']==$this->lang->lang()) { ?>
                <strong>
                    <a id="curren-language"><?php echo $row['idi_nombre']; ?></a>
                </strong>
                <?php } else {
                    echo anchor(site_url($row['idi_iso_code']), $row['idi_nombre'], array('class'=>'language'));
                 } ?>
            </li>
            <li>·</li>
        <?php } ?>
    </ul>
</div>
<?php
}
?>