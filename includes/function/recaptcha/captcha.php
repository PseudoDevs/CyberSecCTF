<?php 
session_start(); 
$width = 100; 
$height = 40; 
$im = imagecreate($width, $height); 
$bg = imagecolorallocate($im, 0, 0, 0); 

// generate random string 
$permitted_chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcd3fghijklmnopqrstupwxyz0123456789';
  
function generate_string($input, $strength) {
    $input_length = strlen($input);
    $random_string = '';
    for($i = 0; $i < $strength; $i++) {
        $random_character = $input[mt_rand(0, $input_length - 1)];
        $random_string .= $random_character;
    }
  
    return $random_string;
}
 
$string_length = 5;
$captcha_string = generate_string($permitted_chars, $string_length);

//$_SESSION['img_session'] = $captcha_string;

$_SESSION['captcha'] = $captcha_string; 

/*/ grid 
$grid_color = imagecolorallocate($im, 175, 0, 0); 
$number_to_loop = ceil($width / 20); 
for($i = 0; $i < $number_to_loop; $i++) { 
    $x = ($i + 1) * 20; 
    imageline($im, $x, 0, $x, $height, $grid_color); 
} 
$number_to_loop = ceil($height / 10); 
for($i = 0; $i < $number_to_loop; $i++) { 
    $y = ($i + 1) * 10; 
    imageline($im, 0, $y, $width, $y, $grid_color); 
} 
*/
// random lines 
$line_color = imagecolorallocate($im, 100, 0, 0); 
for($i = 0; $i < 30; $i++) { 
    $rand_x_1 = rand(0, $width - 1); 
    $rand_x_2 = rand(0, $width - 1); 
    $rand_y_1 = rand(0, $height - 1); 
    $rand_y_2 = rand(0, $height - 1); 
    imageline($im, $rand_x_1, $rand_y_1, $rand_x_2, $rand_y_2, $line_color); 
} 
//*/
// write the text 
$text_color = imagecolorallocate($im, 255, 0, 0); 
$rand_x = rand(0, $width - 50); 
$rand_y = rand(0, $height - 15); 

$fw = imagefontwidth(100);     // width of a character
$l = strlen($captcha_string);          // number of characters
$tw = $l * $fw;              // text width
$iw = imagesx($im);          // image width

$xpos = ($iw - $tw)/2;
$ypos = 10;

imagestring($im, 6,  $xpos, $ypos, $captcha_string, $text_color); 


header ("Content-type: image/gif"); 
imagegif($im); 
?>