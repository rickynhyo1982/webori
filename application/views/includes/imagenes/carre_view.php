<?php
    $im = imagecreatetruecolor (20, 20);

    // Definit l'arriere-plan en blanc
    imagefilledrectangle($im, 0, 0, 19,19, $color);

    // Affiche l'image sur le navigateur
    header('Content-Type: image/png');

    imagepng($im);
    imagedestroy($im);
?>

