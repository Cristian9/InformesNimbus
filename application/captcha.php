<?php

session_start();
$key = strtoupper(substr(md5(microtime()), 0, 6));
$_SESSION['key'] = $key;

$captchaTextSize = 7;

do {

    $md5Hash = md5( microtime( ) * mktime( ) );

    preg_replace( '([1aeilou0])', "", $md5Hash );

} while( strlen( $md5Hash ) < $captchaTextSize );

$image = imagecreatefrompng('http://localhost/informes_nimbus/static/images/captcha.png');
$color = imagecolorallocate($image, 31, 118, 92);
$lineColor = imagecolorallocate( $image, 15, 103, 103 );

$imageInfo = getimagesize( "http://localhost/informes_nimbus/static/images/captcha.png" );

$linesToDraw = 10;

for( $i = 0; $i < $linesToDraw; $i++ )  {

    $xStart = mt_rand( 0, $imageInfo[ 0 ] );
    $xEnd = mt_rand( 0, $imageInfo[ 0 ] );

    imageline( $image, $xStart, 0, $xEnd, $imageInfo[1], $lineColor );

}

imagettftext( $image, 20, 0, 35, 35, $color, "VeraBd.ttf", $key );

header ( "Content-type: image/png" );
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
imagepng( $image );
?>