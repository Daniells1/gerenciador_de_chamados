<?php require_once "components/topo.php"; ?>
<?php require_once $basePath . '/projetos/gerenciador_de_chamados/db/conexao.php'; ?>
       <h2>Novo Chamado</h2>

       <form action="cadastrar-chamado-save.php" method="POST">
         <div>
              <label for="titulo">Título do Chamado</label>
              <input type="text" name="titulo" id="titulo" required>
         </div>
         <div>

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

         <div>
          <label for="texto">Mensagem</label>
          <textarea name="mensagem" id="mensagem" ></textarea>
         </div>
        
         <input type="submit" value = "Cadastrar Chamado" class = "btn btn-logar">
       </form>

<?php require_once "components/rodape.php"; ?>