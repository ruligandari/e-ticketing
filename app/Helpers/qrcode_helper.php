<?php

use SimpleSoftwareIO\QrCode\Generator;

function generateQrcode($string, $size = 50)
{
    $qrcode = new Generator;
    return $qrcode->size($size)->generate($string);
}
