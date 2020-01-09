<?php

function encRSA($M){
    $data[0] = 1;
    for($i = 0; $i <= 35; $i++) {
        $rest[$i] = pow($M,1)%119;
        if($data[$i]>119) {
            $data[$i+1] = $data[$i]*$rest[$i]%119;
        }
        else {
            $data[$i+1] = $data[$i]*$rest[$i];
        }
    }
    $get = $data[35]%119;
    return $get;
}

function decRSA($E){
    $data[0] = 1;
    for($i = 0; $i <= 11; $i++) {
        $rest[$i] = pow($E,1)%119;
        if($data[$i]>119) {
            $data[$i+1] = $data[$i]*$rest[$i]%119;
        }
        else {
            $data[$i+1] = $data[$i]*$rest[$i];
        }
    }
    $get = $data[11]%119;
    return $get;
}

//$mess : pesan yang akan di encrypt
function encrypt($mess , $enc = ""){
    for($i = 0; $i < strlen($mess); $i++) {
        $m = ord($mess[$i]);
        if($m <= 119) {
            $enc = $enc.chr(encRSA($m));
        }
        else {
            $enc = $enc.$mess[$i];
        }
    }
    return $enc;
}

//$enc : pesan yang akan di encrypt
function decrypt($enc , $dec = ""){
    for($i = 0; $i < strlen($enc); $i++) {
        $m = ord($enc[$i]);
        if($m <= 119) {
            $dec = $dec.chr(decRSA($m));
        }
        else {
            $dec = $dec.$enc[$i];
        }
    }
    return $dec;
}

?>