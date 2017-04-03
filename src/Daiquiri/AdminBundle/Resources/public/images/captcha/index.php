<?php
header ('Content-Type: image/png');
session_start();

function generateRandomString($length = 6) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

$im = @imagecreatetruecolor(120, 30)
      or die('No se puede Iniciar el nuevo flujo a la imagen GD');
$pass_phrase = generateRandomString(); 
$_SESSION['captcha'] = sha1($pass_phrase); 

$bg_color = imagecolorallocate($im, 255, 255, 255);     // white 
$color_texto = imagecolorallocate($im, 227, 173, 17);   // yellow 
$point_color = imagecolorallocate($im, 227, 173, 17);   // yellow 
$graphic_color = imagecolorallocate($im, 227, 173, 17);  // yellow 


 // Fill the background 
 imagefilledrectangle($im, 0, 0, 120, 30, $bg_color); 

// Draw some random lines 
for ($i = 0; $i < 5; $i++) { 
 imageline($im, 0, rand() % 100, 120, rand() % 30, $graphic_color); 
}

  
// Sprinkle in some random dots 
for ($i = 0; $i < 100; $i++) { 
  imagesetpixel($im, rand() % 120, rand() % 30, $point_color); 
} 
imagestring($im, 5, 5, 5, $pass_phrase, $color_texto);
imagepng($im);
imagedestroy($im);
?>