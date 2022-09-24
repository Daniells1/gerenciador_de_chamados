<?php require_once "components/topo.php"; ?>
<?php require_once $basePath . '/projetos/gerenciador_de_chamados/db/conexao.php'; ?>
<?php require_once $basePath . '/projetos/gerenciador_de_chamados/util/funcao.php'; ?>
        
<?php
$id = base64_decode($_GET["id"]);
$sql = " select c.titulo, c.texto, c.dt_cadastro, c.dt_conclusao, c.status, c.dt_previsao_conclusao, cat.categoria, u.nome 
FROM tbchamado c INNER JOIN tbcategoria cat ON cat.id = c.categoria_id 
INNER JOIN tbusuario u ON u.id = c.usuario_id
WHERE c.id = " . $id;

$resultSetChamado = mysqli_query($conn, $sql);
if(mysqli_num_rows($resultSetChamado)!= 1){
    header("location: ver-chamado.php?m= ".base64_encode("Chamado não encontrado"));
    exit;
}
$chamado = mysqli_fetch_assoc($resultSetChamado);
?>


<h2>Responder Chamados</h2>
<a href="#" id="btnchamado">Mostrar / Ocultar</a>
<div id="card-chamado">
<div>
    <label>Título: </label>
    <?=$chamado["titulo"]?>
</div>
<div>
    <label>Data de Cadastro: </label>
    <?=formatDateFromDb($chamado["dt_cadastro"])?>
</div>
<div>
    <label>Data de Previsão: </label>
    <?=formatDateFromDb($chamado["dt_previsao_conclusao"])?>
</div>
<?php if(!is_null($chamado["dt_conclusao"])){?>
<div>
    <label>Data de Conclusão: </label>
    <?=formatDateFromDb($chamado["dt_conclusao"])?>
</div>
<?php }?>
<div>
    <label>Categoria: </label>
    <?=$chamado["categoria"]?>
</div>
<div>
    <label>Usuário: </label>
    <?=$chamado["nome"]?>
</div>

<div>
    <label>Texto: </label>
    <?=$chamado["texto"]?>
</div>
</div>

<form action="responder-chamado-save.php" method ="POST">
    <input type="hidden" name="idchamado" value="<?=$_GET["id"]?>">
    <div>
        <label for="resposta">Resposta: </label>
        <input type="text" name="resposta" id="resposta">
    </div>

    <input type="submit" value = "Adicionar Resposta" class = "btn btn-logar">
</form>

<?php
    $sqlResposta = " SELECT resposta, dt_resposta, nome FROM tbresposta r INNER JOIN tbusuario u ON r.usuario_id = u.id
    WHERE r.chamado_id = " .$id. " ORDER BY r.id DESC ";
    $resultSetResposta = mysqli_query($conn, $sqlResposta);
    if(mysqli_num_rows($resultSetResposta)>0) {
    ?>

<div id="card-resposta">
    <?php while($reposta = mysqli_fetch_assoc($resultSetResposta)){?>
<div>
    <?=$resposta["resposta"] ?>
    <label >
    <?=$resposta["nome"] ?> / <?=$resposta["dt_resposta"] ?>
    </label>
</div>
   <?php } ?>
</div>
<?php } ?>
<?php require_once "components/rodape.php"; ?>

<script>
    document.getElementById("btnchamado").addEventListener("click",()=>{
        let visible = document.getElementById("card-chamado").style.display
        if(visible == "none"){
            document.getElementById("card-chamado").style.display = "block"
        }else{
            document.getElementById("card-chamado").style.display = "none"
        }
    })
</script>