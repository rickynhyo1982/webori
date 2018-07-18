<?
//=====================================================================================================
// Impression des entradas qui se trouvent dans la variables de session ResasAImprimir
//=====================================================================================================
require(APPPATH.'third_party/fpdf.php');
$entradas_config = $this->config->item('entradas');
$pub = false;
$imgEvento = imgEvento($evento_data['eve_imagen_principal']) ;
switch ($taille) {
    case "Petite" : 
        $imgEvento = imgEvento("SalaSmall");
        $largeurPage = 80 ;
        $hauteurImage = 30 ;
        $size[0] = $largeurPage  ;
        $size[1] = 40 ;
        $orientation = 'L';
        $fontSize = 10;
        $fontSizeEvt = 10;
        $marginSize = 4;
        $cellSize = 4;
        break;
    case "Moyenne" : 
        $largeurPage = 210 ;
        $hauteurImage = 85 ;
        $size[0] = $largeurPage  ;
        $size[1] = 105 ;
        $orientation = 'L';
        $fontSize = 12;
        $fontSizeEvt = 14;
        $marginSize = 10;
        $cellSize = 9;
        break;
    default : //page A4 avec pub
        $pub = true;
        $largeurPage = 210 ;
        $hauteurImage = 85 ;
        $size='A4';
        $orientation = 'P';
        $fontSize = 12;
        $fontSizeEvt = 14;
        $marginSize = 10;
        $cellSize = 9;
        $tablargeurImage = array(0, 90 , 90 ,190);
        $tabCentX = array(0, 55, 155 , 105);
        $tabCentY = array(0, 148, 148 , 242);
        
        // calcul de la position d'affichage des 3 pubs
        $i = 1;
        foreach($publicidad_entradas as $row) {
            $pubNom[$i] =  'resources/uploads/contenido/'.$row['pue_imagen'];
            $tailleReelleImage =getimagesize($pubNom[$i]);
            $rapHaut = $hauteurImage/ $tailleReelleImage[1];
            $rapLarg = $tablargeurImage[$i] / $tailleReelleImage[0] ;
            $rapportAffichage = min($rapHaut, $rapLarg);
            $tabposX[$i] = $tabCentX[$i]-($tailleReelleImage[0]*$rapportAffichage)/2;
            $tabposY[$i] = $tabCentY[$i]-($tailleReelleImage[1]*$rapportAffichage)/2;
            $larg[$i] = $tailleReelleImage[0]*$rapportAffichage;
            $i++;
        }
}    
    
// calcul position affichage image de l'entrada

$tailleReelleImage =getimagesize($imgEvento);
$largeurImage = (($tailleReelleImage[0]*$hauteurImage)/$tailleReelleImage[1]) ;
$centreX=$largeurImage+ ($largeurPage-$largeurImage-20)/2;
        

$pdf = new FPDF();

$pdf->SetAutoPageBreak(false);

foreach ($entradas as $row) {
        $typeResa = $row['res_type_reserva'];
        $idEvento = $evento_data['eve_id_evento']; 
        $nombreEvento = iconv('UTF-8', 'windows-1252', $evento_data['eve_nombre']); 
        $web = $evento_data['eve_web']; 
        $fechaHora = $fecha_evento_data['evf_fecha_hora'];
        $idMesa = $row['res_id_mesa']; 
        $idButaca = $row['res_id_butaca']; 
        $precioReducido = $row['res_precio_reducido'];
        
        $ref = $nombres[$idMesa][$idButaca];
        $areaPrecio = $precios[$idMesa][$idButaca];
                       
        $pdf->AddPage($orientation, $size);
        $pdf->SetMargins($marginSize,$marginSize);
        if ($taille<>"Petite") $pdf->rect (8,5, 194, 94);
        
        $pdf->Image($imgEvento,$marginSize,$marginSize,0,$hauteurImage);
        
        $pdf->SetY($marginSize);
        
        if ($taille<>"Petite") { // impression du site web
            $pdf->SetFont('Helvetica','',$fontSize);
            $tailleWeb=$pdf->GetStringWidth($web);
            $pdf->Cell($centreX-($tailleWeb/2));
            $pdf->Cell(0,$cellSize,$web,0,1);
            $pdf->SetY($marginSize*2.5);
        }
        
        $pdf->SetFont('Helvetica','B',$fontSizeEvt);

        // impression du nom de l'�v�nement
        $tailleEvento=$pdf->GetStringWidth($nombreEvento);
        $pdf->Cell($centreX-($tailleEvento/2));
        $pdf->Cell(0,$cellSize,$nombreEvento,0,1);
        
        $pdf->SetFont('Times','',$fontSize);

        // impression de l'emplacement
        $pdf->SetY($marginSize*4);
        if ($idMesa<>0) {
            $ref.="-".$idButaca;
        }
        if (strlen($ref)>5) {
            $localidad=$ref;
        } else {
            $localidad="Localidad: $ref";
        }
        $tailleLocalidad=$pdf->GetStringWidth($localidad);
        $pdf->Cell($centreX-($tailleLocalidad/2));
        $pdf->Cell($tailleLocalidad,$cellSize,$localidad,0,1);
        
        // impression de la date
        $fecha = substr(fotmat_fecha_hora($fechaHora),0,10);
        $tailleFecha=$pdf->GetStringWidth($fecha);
        $pdf->Cell($centreX-($tailleFecha/2));
        $pdf->Cell($tailleFecha,$cellSize,$fecha,0,1);
        
        // impression de l'heure
        $hora=substr(fotmat_fecha_hora($fechaHora),11,5);
        $tailleHora=$pdf->GetStringWidth($hora);
        $pdf->Cell($centreX-($tailleHora/2));
        $pdf->Cell($tailleHora,$cellSize,$hora,0,1);
        
        // on imprime la mention pour les entr�es "Invidados"
        if ($typeResa==$entradas_config['reservas']['RESA_INVITADO']) {
            $tailletxt=$pdf->GetStringWidth('Invitado');
            $pdf->Cell($centreX-($tailletxt/2));
            $pdf->Cell(0,$cellSize,'Invitado',0,1);
        } else {
            $precio = '-';            
            if($precioReducido) {
                $precio = $evento_data['eve_precio_reduc_area'.$areaPrecio];
            } else {
                $precio = $evento_data['eve_precio_area'.$areaPrecio];
            }
            $txtPrecio=$precio." Euros";
            $taillePrecio=$pdf->GetStringWidth($txtPrecio);
            $pdf->Cell($centreX-($taillePrecio/2));
            $pdf->Cell($taillePrecio,$cellSize,$txtPrecio,0);
        }
        
        if ($pub) {//Publicidad
			for ($i=1; $i<4; $i++) {
				$pdf->Image($pubNom[$i],$tabposX[$i], $tabposY[$i],$larg[$i]);
            }
            
            
        }
}
$pdf->Output('Sala-Charivari '.date('d-m-Y H:i:s'),'I');
?>

