<?php

function url(){
   return sprintf("%s://%s",
   (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] != 'off')?"https":"http",
   $_SERVER["SERVER_NAME"]);
//return http://localhost
}

function validarPermissao($permissao = []){
    return in_array($_SESSION["perfil"], $permissao);
}

function getStatus($status){
    switch($status){
        case 'OPEN':return "Aberto";
        case 'ANS':return "Respondido";
        case 'CLOSE':return "Fechado";
        default:return "";
    }
}
function formatDateFromDb($data, $complete = false){
    if( $data == null || $data =="" ) return "";
  if(!$complete){
    $dt = \DateTime::createFromFormat("Y-m-d", $data);
    return $dt->format("d/m/Y");
  }
  $dt = \DateTime :: createFromFormat("Y-m-d H:i:s", $data);
  return $dt ->format("d/m/Y H:i:s");
}

function cutString($texto, $makeCut = 300){
  $tamString = strlen($texto);
  if($tamString <= $makeCut){
    return $texto;
  }
  $cutText = substr($texto, 0 ,$makeCut);
  return $cutText . "...";
}
