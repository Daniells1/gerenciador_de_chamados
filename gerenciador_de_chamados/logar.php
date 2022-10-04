<?php 
session_start();

require_once 'db/conexao.php';

$login = mysqli_escape_string($conn, trim($_POST["login"]));
$senha = mysqli_escape_string($conn, trim($_POST["senha"]));

$senha = md5($senha);

$sql = "select * from tbusuario where login = '".$login."' AND senha ='".$senha."'";
$resultSetUsuario = mysqli_query($conn,$sql);

if(mysqli_num_rows($resultSetUsuario)==0){
    mysqli_close($conn);
    header("location: entrar.php?m=" . base64_encode("Usuário/senha inválidos"));
    exit;
}

//pegar os dados do usuário
$row =  mysqli_fetch_assoc($resultSetUsuario);

$_SESSION["id"] = $row["id"];
$_SESSION["login"] = $row["login"];
$_SESSION["nome"] = $row["nome"];
$_SESSION["perfil"] = $row["perfil"];

mysqli_close($conn);
header("location: admin/");