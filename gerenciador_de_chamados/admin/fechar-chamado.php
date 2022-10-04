<?php

require_once "components/validar-acesso.php";
require_once $basePath . "/projetos/gerenciador_de_chamados/db/conexao.php"; 

$id = base64_decode($_GET["id"]);

$id = mysqli_escape_string($conn, $id);

$sql = "select id from tbchamado where id = ". $id;

$resultSetDbChamado = mysqli_query($conn, $sql);
if(mysqli_num_rows($resultSetDbChamado) != 1){
    mysqli_close($conn);
    header("location: ver-chamado.php?m=" . base64_encode("Chamado não encontrado"));
    exit;
}

$dtConclusao = new \DateTime();

$sqlFecharChamado = " UPDATE tbchamado SET dt_conclusao = '".$dtConclusao->format("Y-m-d")."' , status = 'CLOSE' WHERE id = " . $id;
if(mysqli_query($conn ,$sqlFecharChamado)){
    $msg = "Chamado fechado com sucesso!";
}else{
    $msg = "Chamado não fechado";
}
mysqli_close($conn);
header("location: ver-chamado.php?m=".base64_encode($msg));