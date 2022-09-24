<?php require_once "components/topo.php"; ?>
<?php require_once $basePath . '/projetos/gerenciador_de_chamados/db/conexao.php'; ?>
       <h2>Categorias</h2>
<form action="categorias_save.php" method="POST">
    <div>
  <label for="categoria">Categoria</label>
  <input type="text" name="categoria" required>
  </div>
  <div>
  <label for="dias_conclusao">Dias para conclusão</label>
  <input type="number" name="dias_conclusao" required>
  </div>
  <input type="submit" value = "Cadastrar no Categoria" class = "btn btn-logar">
</form>
<?php 
$sql = "select * from tbcategoria";
$resultSetCategoria = mysqli_query($conn, $sql);
if(mysqli_num_rows($resultSetCategoria)>0) {
?>
<table class="my-table">
    <thead>
        <tr>
            <th>Categoria</th>
            <th>Dias para conclusão do Chamado</th>
        </tr>
    </thead>
    <tbody>
        <?php while($categoria = mysqli_fetch_assoc($resultSetCategoria)) { ?>
            <tr>
                <td><?=$categoria["categoria"] ?> </td>
                <td><?=$categoria["dias_conclusao"] ?> </td>
            </tr>
            <?php } ?>
    </tbody>
</table>
<?php } ?>

<?php require_once "components/rodape.php"; ?>