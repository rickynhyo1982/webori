<?php
// Création d'une image
$im = imagecreatetruecolor (600, 600);

// Définit l'arrière-plan en blanc
imagefilledrectangle($im, 0, 0, 599, 599, 0xFFFFFF);

// Dessine un texte dans l'image
imagestring($im, 3, 40, 20, 'MICROMAGIA - 28/09/2014 - 12:00', 0x552500);

// Escenario
imagefilledrectangle($im, 200, 500, 400, 560, 0x676767);
imagestring($im, 3, 260, 520, 'ESCENARIO', 0x000000);


Function DiseñoMesa( &$image, $NomMesa , $posX, $posY) {

	$ColorMesa = 0xCD5C5C; // Indian Red
	$Gris = 0xAAAAAA;

	$textheight = imagefontheight (3) ;

	imagefilledellipse($image, $posX + 20, $posY + 20, 34, 34, $Gris);
	imagestring($image, 3, $posX+12, $posY+9, "1", 0x000000);
	imagefilledellipse($image, $posX + 80, $posY + 20, 34, 34, $Gris);
	imagestring($image, 3, $posX+80, $posY + 9, "2", 0x000000);
	imagefilledellipse($image, $posX + 20, $posY + 80, 34, 34, $Gris);
	imagestring($image, 3, $posX+12, $posY + 80, "3", 0x000000);
	imagefilledellipse($image, $posX + 80, $posY + 80 , 34, 34, $Gris);
	imagestring($image, 3, $posX+80, $posY + 80, "4", 0x000000);

	imagefilledellipse($image, $posX+50, $posY+50, 88, 88, $ColorMesa);

	$textWidth = imagefontwidth(3) * strlen( $NomMesa );

	imagestring($image, 3, $posX+50-($textWidth/2), $posY+50-($textheight/2), $NomMesa, 0x000000);


}


DiseñoMesa( $im, "Mesa 1" , 100, 100) ;
DiseñoMesa( $im, "Mesa 2" , 300, 100) ;

DiseñoMesa( $im, "Mesa 3" , 150, 250) ;
DiseñoMesa( $im, "Mesa 4" , 350, 250) ;


// Affiche l'image sur le navigateur
header('Content-Type: image/gif');

imagegif($im);
imagedestroy($im);
?>


