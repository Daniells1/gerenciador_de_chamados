<?php require_once "components/topo.php"; ?>

<h2>Responder Chamados</h2>


<a href="#" id="btnchamado">Mostrar / Ocultar</a>

<form action="responder-chamado-save.php" method ="POST">
    <input type="hidden" name="idchamado" value="<?=$_GET["id"]?>">
    <div>
        <label for="resposta">Resposta: </label>
        <input type="text" name="resposta" id="resposta">
    </div>

    <input type="submit" value = "Adicionar Resposta" class = "btn btn-logar">
</form>

<?php require_once "../partials/_chamado.php"; ?>

<?php require_once "components/rodape.php"; ?>