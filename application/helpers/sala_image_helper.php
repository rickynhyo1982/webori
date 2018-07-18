<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Sala image helper contains facilities to create sala images
 *
 * @package	DASC
 * @subpackage	helpers
 * @category	hepers
 * @author	Pedro Escudero
 * @link	http://pedroescudero.info
 */

// ===========================================================================
// ===     delaration des fonctions utilisés pour les dessins des sales    ===
// ===========================================================================

/* est ce utile ?
    Public Function ColorResa(ByVal TypeResa As Integer) As System.Drawing.Brush
        Select Case TypeResa
            Case resaLibre : Return Brushes.LightGray
            Case resaVenta : Return Brushes.LightGreen
            Case resaReserva : Return Brushes.Coral 'reserva
            Case resaVIP : Return Brushes.CornflowerBlue 'VIP
            Case resaInvitado : Return Brushes.Yellow 'Invitado
            Case Else : Return Brushes.GhostWhite 'no utilisado
        End Select
    End Function
*/

function imageBoldLine($image, $x1, $y1, $x2, $y2, $Color, $BoldNess=2)
{
$center = round($BoldNess/2);
for($i=0;$i<$BoldNess;$i++)
{ 
  $a = $center-$i; if($a<0){$a -= $a;}
  for($j=0;$j<$BoldNess;$j++)
  {
   $b = $center-$j; if($b<0){$b -= $b;}
   $c = sqrt($a*$a + $b*$b);
   if($c<=$BoldNess)
   {
    imageline($image, $x1 +$i, $y1+$j, $x2 +$i, $y2+$j, $Color);
   }
  }
}        
} 

// =========================================================================================================
// ===  ColorButaca :  retourne la couleur du Butaca en fonction du type de resa et de la zone de prix   ===
// =========================================================================================================
function ColorButaca( $TypeResa, $AreaPrecio) {
        $CI = get_instance();
        $CI->load->config('entradas');
        $entradas_config = $CI->config->item('entradas');
    
	$colorResult = $entradas_config['color']['COLOR_SILLA_PRECIO_1'] ;
	switch ($TypeResa) {
	    case $entradas_config['reservas']['RESA_LIBRE']:
		$colorResult = $entradas_config['color']['COLOR_SILLA_PRECIO_'.$AreaPrecio];
		break;
	    case $entradas_config['reservas']['RESA_VENTA']:
		$colorResult = $entradas_config['color']['COLOR_RESA_VENTA'] ; 
		break;
        case $entradas_config['reservas']['RESA_VENTA_WEB']:
		$colorResult = $entradas_config['color']['COLOR_RESA_VENTA_WEB'] ; 
		break;
	    case $entradas_config['reservas']['RESA_RESERVA']:
		$colorResult = $entradas_config['color']['COLOR_RESA_RESERVA'] ; 
		break;
	    case $entradas_config['reservas']['RESA_VIP']:
		$colorResult = $entradas_config['color']['COLOR_RESA_VIP'] ; 
		break;
	    case $entradas_config['reservas']['RESA_INVITADO']:
		$colorResult = $entradas_config['color']['COLOR_RESA_INVITADO'] ; 
		break;
	    case $entradas_config['reservas']['RESA_DISPONIBLE']:
		$colorResult = $entradas_config['color']['COLOR_RESA_DISPONIBLE'] ; 
		break;
	    case $entradas_config['reservas']['RESA_OCCUPADA']:
		$colorResult = $entradas_config['color']['COLOR_RESA_OCCUPADA'] ; 
		break;
	}
	return $colorResult;
}

// ================================================================
// ===  CruzMesa :  Dessine une croix sur la Mesa (non dispo)   ===
// ================================================================
function CruzMesa ( &$image, $posCruzX, $posCruzY) {
        $CI = get_instance();
        $CI->load->config('entradas');
        $entradas_config = $CI->config->item('entradas');
    
	//imageline ( $image , $posCruzX , $posCruzY , $posCruzX + $entradas_config['modelos']['TAMANO_MESA'] , $posCruzY + $entradas_config['modelos']['TAMANO_MESA'], $entradas_config['color']['COLOR_TEXT'] ) ;
	imageBoldLine ( $image , $posCruzX , $posCruzY , $posCruzX + $entradas_config['modelos']['TAMANO_MESA'] , $posCruzY + $entradas_config['modelos']['TAMANO_MESA'], $entradas_config['color']['COLOR_TEXT'] ) ;
	//imageline ( $image , $posCruzX + $entradas_config['modelos']['TAMANO_MESA'], $posCruzY , $posCruzX  , $posCruzY + $entradas_config['modelos']['TAMANO_MESA'], $entradas_config['color']['COLOR_TEXT'] ) ;
	imageBoldLine ( $image , $posCruzX + $entradas_config['modelos']['TAMANO_MESA'], $posCruzY , $posCruzX  , $posCruzY + $entradas_config['modelos']['TAMANO_MESA'], $entradas_config['color']['COLOR_TEXT'] ) ;
}

// ==================================================================
// ===  CruzButaca :  Dessine une croix sur la Butaca (no dispo)  ===
// ==================================================================
function CruzButaca ( &$image, $posCruzX, $posCruzY) {
        $CI = get_instance();
        $CI->load->config('entradas');
        $entradas_config = $CI->config->item('entradas');
    
	imageBoldLine ( $image , $posCruzX , $posCruzY , $posCruzX + $entradas_config['modelos']['TAMANO_BUTACA'] , $posCruzY + $entradas_config['modelos']['TAMANO_BUTACA'], $entradas_config['color']['COLOR_TEXT'] ) ;
	imageBoldLine ( $image , $posCruzX + $entradas_config['modelos']['TAMANO_BUTACA'], $posCruzY , $posCruzX  , $posCruzY + $entradas_config['modelos']['TAMANO_BUTACA'], $entradas_config['color']['COLOR_TEXT'] ) ;
}

// ==================================================================
// ===  CruzSilla :  Dessine une croix sur la Silla  (no dispo)  ===
// ==================================================================
function CruzSilla ( &$image, $posCruzX, $posCruzY) {
        $CI = get_instance();
        $CI->load->config('entradas');
        $entradas_config = $CI->config->item('entradas');
    
	imageBoldLine ( $image , $posCruzX , $posCruzY , $posCruzX + $entradas_config['modelos']['TAMANO_SILLA'] -10   , $posCruzY + $entradas_config['modelos']['TAMANO_SILLA'] -10, $entradas_config['color']['COLOR_TEXT'] ) ;
	imageBoldLine ( $image , $posCruzX + $entradas_config['modelos']['TAMANO_SILLA'] -10, $posCruzY , $posCruzX  , $posCruzY + $entradas_config['modelos']['TAMANO_SILLA'] -10, $entradas_config['color']['COLOR_TEXT'] ) ;
}

// ==============================================================
// ===  DisenoMesa :  dessin d'une table ronde avec chaises   ===
// ==============================================================
function DisenoMesa( &$image, $NomMesa , $posX, $posY, $TypeResa1, $TypeResa2, $TypeResa3, $TypeResa4, $AreaPrecio) {
        $CI = get_instance();
        $CI->load->config('entradas');
        $entradas_config = $CI->config->item('entradas');
        
	$textHeight = imagefontheight (3) ;
  
	// dibujo de cada silla
	if ($TypeResa1<> $entradas_config['reservas']['RESA_NODISPO'] ) {
		imagefilledellipse($image, $posX + ($entradas_config['modelos']['TAMANO_SILLA']/2), $posY + ($entradas_config['modelos']['TAMANO_SILLA']/2), $entradas_config['modelos']['TAMANO_SILLA'], $entradas_config['modelos']['TAMANO_SILLA'], ColorButaca($TypeResa1, $AreaPrecio));
		imagestring($image, 3, $posX+11, $posY + 8, "1", $entradas_config['color']['COLOR_TEXT']);
	}
	if ($TypeResa2<> $entradas_config['reservas']['RESA_NODISPO'] ) {
		imagefilledellipse($image, $posX + $entradas_config['modelos']['TAMANO_MESA'] - ($entradas_config['modelos']['TAMANO_SILLA']/2), $posY + ($entradas_config['modelos']['TAMANO_SILLA']/2), $entradas_config['modelos']['TAMANO_SILLA'], $entradas_config['modelos']['TAMANO_SILLA'], ColorButaca($TypeResa2, $AreaPrecio));
		imagestring($image, 3, $posX+85, $posY + 8, "2", $entradas_config['color']['COLOR_TEXT']);
	}
	if ($TypeResa3<> $entradas_config['reservas']['RESA_NODISPO'] ) {
		imagefilledellipse($image, $posX + ($entradas_config['modelos']['TAMANO_SILLA']/2), $posY + $entradas_config['modelos']['TAMANO_MESA'] - ($entradas_config['modelos']['TAMANO_SILLA']/2), $entradas_config['modelos']['TAMANO_SILLA'], $entradas_config['modelos']['TAMANO_SILLA'], ColorButaca($TypeResa3, $AreaPrecio));
		imagestring($image, 3, $posX+11,  $posY + 81, "3", $entradas_config['color']['COLOR_TEXT']);	
	}
	if ($TypeResa4<> $entradas_config['reservas']['RESA_NODISPO'] ) {
		imagefilledellipse($image, $posX + $entradas_config['modelos']['TAMANO_MESA'] - ($entradas_config['modelos']['TAMANO_SILLA']/2), $posY + $entradas_config['modelos']['TAMANO_MESA'] - ($entradas_config['modelos']['TAMANO_SILLA']/2) , $entradas_config['modelos']['TAMANO_SILLA'], $entradas_config['modelos']['TAMANO_SILLA'],ColorButaca($TypeResa4, $AreaPrecio));
		imagestring($image, 3, $posX+85, $posY + 81, "4", $entradas_config['color']['COLOR_TEXT']);
	}

	//dibujo de la mesa
	imagefilledellipse($image, $posX + ($entradas_config['modelos']['TAMANO_MESA']/2), $posY + ($entradas_config['modelos']['TAMANO_MESA']/2), $entradas_config['modelos']['TAMANO_MESA']*0.9, $entradas_config['modelos']['TAMANO_MESA']*0.9, $entradas_config['color']['COLOR_MESA']);
	// Nombre de la mesa
	$textWidth = imagefontwidth(3) * strlen( $NomMesa );
	imagestring($image, 3, $posX+($entradas_config['modelos']['TAMANO_MESA']/2)-($textWidth/2), $posY+($entradas_config['modelos']['TAMANO_MESA']/2)-($textHeight/2), $NomMesa, $entradas_config['color']['COLOR_TEXT']);
	
	// Pour la plan de disponibilité
	if ( ($TypeResa1 == $entradas_config['reservas']['RESA_OCCUPADA'] || $TypeResa1 == $entradas_config['reservas']['RESA_NODISPO'] ) && ($TypeResa2 == $entradas_config['reservas']['RESA_OCCUPADA'] || $TypeResa2 == $entradas_config['reservas']['RESA_NODISPO']) && ($TypeResa3 == $entradas_config['reservas']['RESA_OCCUPADA'] || $TypeResa3 == $entradas_config['reservas']['RESA_NODISPO'] ) && ($TypeResa4 == $entradas_config['reservas']['RESA_OCCUPADA'] || $TypeResa4 == $entradas_config['reservas']['RESA_NODISPO']) ) {
		CruzMesa($image, $posX, $posY);
	} else {
		if ($TypeResa1 == $entradas_config['reservas']['RESA_OCCUPADA'] ) { CruzSilla($image, $posX, $posY); }
		if ($TypeResa2 == $entradas_config['reservas']['RESA_OCCUPADA'] ) { CruzSilla($image, $posX + $entradas_config['modelos']['TAMANO_MESA'] - $entradas_config['modelos']['TAMANO_SILLA']+10, $posY); }
		if ($TypeResa3 == $entradas_config['reservas']['RESA_OCCUPADA'] ) { CruzSilla($image, $posX, $posY + $entradas_config['modelos']['TAMANO_MESA'] - $entradas_config['modelos']['TAMANO_SILLA']+10); }
		if ($TypeResa4 == $entradas_config['reservas']['RESA_OCCUPADA'] ) { CruzSilla($image, $posX + $entradas_config['modelos']['TAMANO_MESA'] - $entradas_config['modelos']['TAMANO_SILLA']+10, $posY + $entradas_config['modelos']['TAMANO_MESA'] - $entradas_config['modelos']['TAMANO_SILLA']+10); }
	}
}

// ===============================================
// ===  DisenoButaca :  dessin d'un fauteuil   ===
// ===============================================
function DisenoButaca( &$image, $Nombre , $posX, $posY, $TypeResa, $AreaPrecio) {
        $CI = get_instance();
        $CI->load->config('entradas');
        $entradas_config = $CI->config->item('entradas');
    
	$textHeight = imagefontheight (3) ;

	if ($TypeResa <> $entradas_config['reservas']['RESA_NODISPO'] ) {
		imagefilledrectangle($image, $posX, $posY + ($entradas_config['modelos']['TAMANO_BUTACA']/2), $posX + $entradas_config['modelos']['TAMANO_BUTACA'], $posY + $entradas_config['modelos']['TAMANO_BUTACA'], ColorButaca($TypeResa, $AreaPrecio));
		imagefilledellipse($image, $posX + ($entradas_config['modelos']['TAMANO_BUTACA']/2), $posY + ($entradas_config['modelos']['TAMANO_BUTACA']/2), $entradas_config['modelos']['TAMANO_BUTACA'], $entradas_config['modelos']['TAMANO_BUTACA'], ColorButaca($TypeResa, $AreaPrecio));
	}
	//Nombre
	$textWidth = imagefontwidth(3) * strlen( $Nombre );
	imagestring($image, 3, ($posX + ($entradas_config['modelos']['TAMANO_BUTACA'] - $textWidth)/2), ($posY + ($entradas_config['modelos']['TAMANO_BUTACA'] - $textHeight)/2), $Nombre, $entradas_config['color']['COLOR_TEXT']);

	if ($TypeResa == $entradas_config['reservas']['RESA_OCCUPADA'] ) { CruzButaca($image, $posX, $posY) ; }
}

// ==========================================================
// ===  DisenoMesa3x2 :  dessin d'une mesa rectangulare   ===
// ==========================================================
function DisenoMesa3x2( &$image, $Nombre , $posX, $posY, $Vertical ) {
        $CI = get_instance();
        $CI->load->config('entradas');
        $entradas_config = $CI->config->item('entradas');
    
	$textHeight = imagefontheight (3) ;
	
	if ($Vertical) {
		$DimX = $entradas_config['modelos']['TAMANO_MESA3X2_X'] ;
        	$DimY = $entradas_config['modelos']['TAMANO_MESA3X2_Y'] ;
	} else { 
	    	$DimX = $entradas_config['modelos']['TAMANO_MESA3X2_Y'] ;
	        $DimY = $entradas_config['modelos']['TAMANO_MESA3X2_X'] ;
	}
        
	imagefilledrectangle($image, $posX, $posY , $posX + $DimX, $posY + $DimY , $entradas_config['color']['COLOR_MESA']);
    
	//Nombre
	$textWidth = imagefontwidth(3) * strlen( $Nombre );
	imagestring($image, 3, ($posX + ($DimX- $textWidth)/2), ($posY + ($DimY  - $textHeight)/2), $Nombre, $entradas_config['color']['COLOR_TEXT']);

}