<?php 
session_start();

$basePath = $_SERVER["DOCUMENT_ROOT"];
require_once $basePath . "/projetos/gerenciador_de_chamados/util/funcao.php";


$baseUrl = url() . "/projetos/gerenciador_de_chamados/";

if(!isset($_SESSION["nome"]) || !isset($_SESSION["id"]) || !isset($_SESSION["login"]) ||  !isset($_SESSION["perfil"]) ){
    session_destroy();
    header("location: " . $baseUrl);
    exit;
}


?>