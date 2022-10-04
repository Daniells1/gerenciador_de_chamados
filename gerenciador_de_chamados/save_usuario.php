<?php 

require_once "db/conexao.php";
//1-resgatar os dados do formulário.
$login = trim($_POST["login"]);
$senha = trim($_POST["senha"]);
$nome = trim($_POST["nome"]);
$tipo = trim($_POST["tipo"]);

$login = mysqli_escape_string($conn, $login);
$senha = mysqli_escape_string($conn, $senha);
$nome = mysqli_escape_string($conn, $nome);
$tipo = mysqli_escape_string($conn, $tipo);



$msg ="";
$valido = true;
//Validação de dados na segunda camada(no servidor)


if($login == "" || $senha == "" || $nome == "" || $tipo == ""){
    $msg = "Preencha todos os campos!";
    $valido = false;
}

$sqllogin = "select login from tbusuario where login = '".$login."'";
$resultSetLogin = mysqli_query($conn, $sqllogin) ;

if(mysqli_num_rows($resultSetLogin) > 0){
    $msg = "O login ($login) já existe no sistema!";
    $valido = false;
}
$senha = md5($senha);



if($valido){
$sql="insert into tbusuario values (NULL, '".$login."', '".$senha."', '".$nome."', '".$tipo."')";

if(mysqli_query($conn,$sql))
    $msg = "Dados cadastrados com sucesso!";
else
    $msg = "Dados não cadastrados no sistema,ocorreu um erro.";
}
mysqli_close($conn);
header("location:cadastrar.php?m=".base64_encode($msg));
