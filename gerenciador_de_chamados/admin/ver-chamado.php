<?php require_once "components/topo.php"; ?>
<?php require_once $basePath . '/projetos/gerenciador_de_chamados/db/conexao.php'; ?>
<?php require_once $basePath . '/projetos/gerenciador_de_chamados/util/funcao.php'; ?>
        <h2>Consultar Chamados</h2>
        <form action="ver-chamado.php" method="POST">
        <div class="w-50">
          
          <label for="status">Status</label>
          <select name="status" id="status">
          <option value="">EM ANDAMENTO</option>
           <option value="OPEN">ABERTO(S)</option>
           <option value="ANS">RESPONDIDO(S)</option>
           <option value="CLOSE">FECHADO(S)</option>
           
          </select>
          </div>
        
        
        <div class="w-50">
          
          <label for="categoria">Categoria</label>
          <select name="categoria" id="categoria">
           <option value=""></option>
          <?php
          $sql = "select id,categoria from tbcategoria";
          $resultSetCategoria = mysqli_query($conn,$sql);
          if(mysqli_num_rows($resultSetCategoria)>0){
           while($row = mysqli_fetch_assoc($resultSetCategoria)){
             echo "<option value=" . $row["id"] . ">" . $row["categoria"]. "</option>";
           }
          }
          ?>
          </select>
          </div>
          <input type="submit" value = "Buscar" class = "btn btn-logar">
        </form>
        <?php if($_POST) { 
          $categoria = $_POST["categoria"];
          $status = $_POST["status"];

          if($status == "OPEN")  $whereStatus = "('OPEN')";
           else if($status == "ANS") $whereStatus = "('ANS')";
           else if($status == "CLOSE") $whereStatus = "('CLOSE')";
           else  $whereStatus = "('OPEN','ANS')";

          $sql = " SELECT c.id idchamado, c.titulo, cat.categoria, c.status, c.dt_previsao_conclusao, u.nome, u.id idusuario
          FROM tbchamado c INNER JOIN tbcategoria cat ON c.categoria_id = cat.id 
          INNER JOIN tbusuario u ON u.id = c.usuario_id ";
          
         //ENTRADA DAS CONDIÇÕES
          $sql .= " WHERE c.status IN " . $whereStatus;
          //nunca esqueça do espaço no começo do sql E NO FIM TBM
         if($categoria != "")
              $sql .= " AND cat.id = " . $categoria;

          if($_SESSION["perfil"] == "CLI")
              $sql .= " AND u.id = " . $_SESSION["id"];

          $sql .= " ORDER BY c.dt_conclusao DESC, c.dt_previsao_conclusao LIMIT 200 ";

          $resultSetChamado = mysqli_query($conn, $sql);
          if(mysqli_num_rows($resultSetChamado)>0){
          ?>
        <table class="my-table">
    <thead>
        <tr>
            <th>Titulo</th>
            <th>Categoria</th>
            <th>Status</th>
            <th>Data Previsão de Conclusão</th>
            <th>Usuário</th>
            <th></th>
        </tr>
        <tbody>
          <?php while($registro = mysqli_fetch_assoc($resultSetChamado)){?>
            <tr>
            <td><?=$registro["titulo"] ?></td>
            <td><?=$registro["categoria"] ?></td>
            <td><?=getStatus($registro["status"]) ?></td>
            <td><?=formatDateFromDb($registro["dt_previsao_conclusao"]) ?></td>
            <td><?=$registro["nome"] ?></td>
            <td>
              <a href="detalhe-chamado.php?id=<?=base64_encode($registro["idchamado"]) ?>" class="btn btn-edit" title="Visualizar Chamado"><i class="fas fa-info-circle"></i></a>
              
            <?php if($registro["idusuario"] == $_SESSION["id"] || $registro["status"] != "CLOSE"){?>
              <a href="fechar-chamado.php?id=<?=base64_encode($registro["idchamado"]) ?>" class="btn btn-close" title="Fechar Chamado"><i class="far fa-calendar-times"></i></a>

              <?php }?>

              <?php if(
                 
                 $registro["status"] != "CLOSE" && (
                 $registro["idusuario"] == $_SESSION["id"] ||
                (validarPermissao(['FUNC']) && $registro["status"] == "OPEN") || (validarPermissao(['CLI']) && $registro["status"] == "ANS") 
                ) ){ ?>
              <a href="responder-chamado.php?id=<?=base64_encode($registro["idchamado"]) ?>" class="btn btn-answer" title="Responder Chamado"> <i class="fas fa-share-square"></i></i></a>
              <?php }?> 
             
            </td>
          
             
            
            </tr>
            <?php } ?>
        </tbody>
    </thead>
</table>

<?php
          }
} ?>
<?php require_once "components/rodape.php"; ?>