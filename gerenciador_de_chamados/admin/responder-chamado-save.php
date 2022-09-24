<?php require_once "components/validar-acesso.php";
require_once $basePath . "/projetos/gerenciador_de_chamados/db/conexao.php"; 


$idChamado = base64_decode($_POST["idchamado"]);
$resposta = $_POST["resposta"];



$hoje = new \DateTime();



$sql ="insert into tbresposta values(null, '".$resposta."', '".$hoje->format("Y-m-d H:i:s")."', "
.$idChamado.", ". $_SESSION["id"].")";



if(mysqli_query($conn, $sql)){
    $msg = "Resposta adicionada com sucesso!";
}else{
    $msg = "Resposta não adicionada";
}

mysqli_close($conn);


header("location: responder-chamado.php?id=" . $_POST["idchamado"]."&m=" . base64_encode($msg) );
