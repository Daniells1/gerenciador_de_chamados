<?php require_once "components/validar-acesso.php";?>
<?php require_once $basePath . '/projetos/gerenciador_de_chamados/db/conexao.php'; ?>

<?php
$titulo = mysqli_escape_string($conn, trim($_POST["titulo"]));
$categoria = mysqli_escape_string($conn, trim($_POST["categoria"]));
$mensagem = mysqli_escape_string($conn, trim($_POST["mensagem"]));

if($titulo == "" || $categoria == "" ){
    header("location: cadastrar-chamado.php?m=" . base64_encode("Preencha o titulo e a categoria."));
    exit;
}

/*
status do chamado
OPEN - ABERTO
ANS-RESPONDIDO
CLOSE - FECHADO
*/
$sqlCategoria = "select  dias_conclusao from tbcategoria where id= " . $categoria;
$resultSetCategoria = mysqli_query($conn, $sqlCategoria);

if(mysqli_num_rows($resultSetCategoria) != 1){
      header("location: cadastrar-chamado?m=" . base64_encode("Categoria não existe no sistema "));
      exit;
}

$rowCategoria = mysqli_fetch_assoc($resultSetCategoria);

$hoje = new \DateTime();
$dtPrevisao =  new \DateTime();
$dtPrevisao->add(new \DateInterval("P" . $rowCategoria["dias_conclusao"] . "D"));


$idusuario = $_SESSION["id"];
$sql = "insert into tbchamado values(NULL, '".$titulo."', '".$mensagem."' , '".$hoje->format('Y-m-d')."', '".$dtPrevisao->format('Y-m-d')."', null, 'OPEN', ".$categoria." , ".$idusuario.")";
$message = "";
if(mysqli_query($conn, $sql))
      $message = "Chamado criado com sucesso";
else
      $message = "Chamado  não criado";

mysqli_close($conn);
header("location:cadastrar-chamado.php?m=" . base64_encode($message));      
?>
