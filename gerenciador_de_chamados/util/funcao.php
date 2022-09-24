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
function formatDateFromDb($data){
    if( $data == null || $data =="" ) return "";

    $dt = \DateTime::createFromFormat("Y-m-d", $data);
    return $dt->format("d/m/Y");
}