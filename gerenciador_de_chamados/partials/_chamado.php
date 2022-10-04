
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
    <?=nl2br($chamado["texto"])?>
</div>
</div>



<?php
    $sqlResposta = " select resposta, dt_resposta, nome FROM tbresposta r inner join tbusuario u ON r.usuario_id = u.id
    WHERE r.chamado_id = " .$id. " ORDER BY r.id DESC ";
    $resultSetResposta = mysqli_query($conn, $sqlResposta);
    if(mysqli_num_rows($resultSetResposta)>0) {
    ?>

<div id="card-resposta" >
    <?php while($resposta = mysqli_fetch_assoc($resultSetResposta)){?>
<div>
    <?=$resposta["resposta"] ?>
    <label >
    <?=$resposta["nome"] ?> | <?=formatDateFromDb($resposta["dt_resposta"], true) ?>
    </label>
</div>
   <?php } ?>
</div>
<?php } ?>


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
