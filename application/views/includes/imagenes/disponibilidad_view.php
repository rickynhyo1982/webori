<?php
//====================================================================================================
// Debut de sala-img
//====================================================================================================
    $entradas_config = $this->config->item('entradas');

    $decalX = 0;
    $decalY = 0;

    // Craation d'une image
    $im = imagecreatetruecolor ($entradas_config['modelos']['TAMANO_SALA_X'] + $decalX*2, $entradas_config['modelos']['TAMANO_SALA_Y'] + $decalY*2);

    // Dafinit l'arriere-plan en blanc
    imagefilledrectangle($im, 0, 0, $entradas_config['modelos']['TAMANO_SALA_X']+($decalX*2)-1, $entradas_config['modelos']['TAMANO_SALA_Y']+($decalY*2)-1, 0xFFFFFF);

    // Dessine un texte dans l'image
    //imagestring($im, 3, 40, 20, 'MICROMAGIA - 28/09/2014 - 12:00 - (Sala '.$idSala.')', 0x552500);

    // Escenario
    imagefilledrectangle($im, $decalX +($entradas_config['modelos']['TAMANO_SALA_X'] - $entradas_config['modelos']['TAMANO_ESCENARIO_X'])/2, $entradas_config['modelos']['TAMANO_SALA_Y'] - $entradas_config['modelos']['TAMANO_ESCENARIO_Y'] + $decalY, $decalX +($entradas_config['modelos']['TAMANO_SALA_X']-$entradas_config['modelos']['TAMANO_ESCENARIO_X'])/2 + $entradas_config['modelos']['TAMANO_ESCENARIO_X'], $entradas_config['modelos']['TAMANO_SALA_Y'] + $decalY, $entradas_config['color']['COLOR_ESCENARIO']);
    $textWidth = imagefontwidth(3) * strlen($entradas_config['textos']['TXT_ESCENARIO']);
    imagestring($im, 3, ($entradas_config['modelos']['TAMANO_SALA_X'] -$textWidth)/2 + $decalX, $entradas_config['modelos']['TAMANO_SALA_Y'] - $entradas_config['modelos']['TAMANO_ESCENARIO_Y']/2 + $decalY, $entradas_config['textos']['TXT_ESCENARIO'],$entradas_config['color']['COLOR_TEXT']);
    
    $modelo = $sala_data['saa_modelo'];
    
    // Affichage des butacas de la salle
    foreach($butacas_data as $row) {
        $id_butaca = $row['but_id_butaca'];
        $disponible = (($reservas[0][$id_butaca]['res_type_reserva']=='5')||($reservas[0][$id_butaca]['res_type_reserva']=='0'))?$reservas[0][$id_butaca]['res_type_reserva']:'1';
        DisenoButaca( $im, $row['but_ref'] , $row['but_pos_x']+$decalX, $row['but_pos_y']+$decalY, $disponible, $row['but_area_precio']) ;
    }
  
    // Affichage des tables de la salle
	if (!empty($mesas_data)) {
            foreach ($mesas_data as $mesa) {
                    $idMesa = $mesa['mes_id_mesa'];
                    $ref = $mesa['mes_ref'];
                    $posX = $mesa['mes_pos_x']+ $decalX;
                    $posY = $mesa['mes_pos_y']+ $decalY;
                    $areaPrecio = $mesa['mes_area_precio'];
                    $nbSillas = $mesa['mes_nb_sillas'];
                    // si c'est pour un modele
                    $silla1 = ($reservas[$idMesa][1]['res_last_type_reserva']=='5')?'5':((($reservas[$idMesa][1]['res_type_reserva']=='5')||($reservas[$idMesa][1]['res_type_reserva']=='0'))?$reservas[$idMesa][1]['res_type_reserva']:'1');
                    $silla2 = ($reservas[$idMesa][2]['res_last_type_reserva']=='5')?'5':((($reservas[$idMesa][2]['res_type_reserva']=='5')||($reservas[$idMesa][2]['res_type_reserva']=='0'))?$reservas[$idMesa][2]['res_type_reserva']:'1');
                    $silla3 = ($reservas[$idMesa][3]['res_last_type_reserva']=='5')?'5':((($reservas[$idMesa][3]['res_type_reserva']=='5')||($reservas[$idMesa][3]['res_type_reserva']=='0'))?$reservas[$idMesa][3]['res_type_reserva']:'1');
                    $silla4 = ($reservas[$idMesa][4]['res_last_type_reserva']=='5')?'5':((($reservas[$idMesa][4]['res_type_reserva']=='5')||($reservas[$idMesa][4]['res_type_reserva']=='0'))?$reservas[$idMesa][4]['res_type_reserva']:'1');
                    DisenoMesa( $im, $ref , $posX, $posY, $silla1, $silla2, $silla3, $silla4, $areaPrecio) ;
		}
	}
		
    // Affichage des mesas rectangulares de la salle
    foreach($mesas_largas_data as $row) {
        $ref = $row['mel_ref'];
        $posX = $row['mel_pos_x'];
        $posY = $row['mel_pos_y'];
        $vertical = $row['mel_vertical'];
        DisenoMesa3x2( $im, $ref , $posX+ $decalX, $posY+ $decalY, $vertical) ;
    }
    
    // Affiche l'image sur le navigateur
    header('Content-Type: image/png');

    imagepng($im);
    imagedestroy($im);
?>