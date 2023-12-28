<?php

function enkripsi($string)
{
    $hasil = base64_encode($string);
    return $hasil;
}

function dekripsi($string)
{
    $hasil = base64_decode($string);
    return $hasil;
}
