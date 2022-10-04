<?php

require_once 'components/topo.php';
require_once $basePath . '/projetos/gerenciador_de_chamados/db/conexao.php';

$categoria =mysqli_escape_string($conn,trim($_POST["categoria"]));
$dias_conclusao = mysqli_escape_string($conn,trim($_POST["dias_conclusao"]));

$sql ="insert into tbcategoria values(NULL, '".$categoria."', ".$dias_conclusao.")";


if(mysqli_query($conn, $sql)){
    $msg ="Categoria cadastrada com sucesso!";
}else{
    $msg ="Categoria  não cadastrada.";
}
mysqli_close($conn);
header("location:categorias.php?m=".base64_encode($msg));