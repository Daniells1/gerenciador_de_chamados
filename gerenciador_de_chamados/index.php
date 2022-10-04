<?php
require_once "util/config.php";
require_once $basePath . "/projetos/gerenciador_de_chamados/db/conexao.php";


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <title>Document</title>
    <style>
        #paginacao{
          display:flex;
          justify-content: center;
        }
        #paginacao a{
          padding: 1rem;
          text-decoration: none;
          margin:0 0.5rem;
          background-color: rgb(0, 89, 206);
          color:#FFF;
        }
        #paginacao a:hover{
          padding: 1rem;
          text-decoration: underline;
          margin:0 0.5rem;
          background-color: rgb(0, 89, 206);
          color:#FFF;
        }



    </style>
</head>
<body>
    <div class="container">
        <h1>
            Chamados do Sistema
        </h1>
       <?php
       //pag X = tamPagina * X - tamPagina
     // pag 1 =0 ---- 5*1 - 5 =0
     //pag 2 = 5
     // pag 3 = 10

     $paginaAtual = isset($_GET["pag"]) && is_numeric($_GET["pag"]) ? $_GET["pag"] : 1;
     if($paginaAtual < 1) $paginaAtual = 1;
     $tamanhoPagina = 5;  
     $inicioBusca = $tamanhoPagina * $paginaAtual - $tamanhoPagina; 
     $sql = "SELECT titulo, texto, nome FROM tbchamado c INNER JOIN tbusuario u ON c.usuario_id = u.id 
     WHERE c.status IN ('OPEN', 'ANS')
     ORDER BY c.dt_cadastro, c.id DESC
     LIMIT ".$inicioBusca. " , " . $tamanhoPagina;

    $sqlTotalRegistros = "SELECT count(c.id) totalDeChamados FROM tbchamado c INNER JOIN tbusuario u ON c.usuario_id = u.id 
            WHERE c.status IN ('OPEN', 'ANS')";
    $sqlSetTotalChamado = mysqli_query($conn, $sqlTotalRegistros);
    $totalChamados = mysqli_fetch_assoc($sqlSetTotalChamado);
    $total =   $totalChamados ["totalDeChamados"];
    
    $temProximaPagina = false;
    if($total > ($inicioBusca + $tamanhoPagina)){
        $temProximaPagina = true;
    }



       $resultSetChamado = mysqli_query($conn, $sql);
       if(mysqli_num_rows($resultSetChamado)>0){
        while($chamado = mysqli_fetch_assoc($resultSetChamado)){
       ?>

        <div class="chamado">
            <h2><?=$chamado["titulo"] ?></h2>
            <?=nl2br(cutString( $chamado["texto"],300)) ?>
            <p>
                Autor(a) : <?=$chamado["nome"]?>
            </p>
        </div>
                 
        <?php        } //FIM DO WHILE

        ?>
        
         <div id="paginacao">
            <?php if($paginaAtual > 1){?>
            <a href="?pag=<?=($paginaAtual - 1)?>">Anterior</a>
            <?php } ?>
            <?php if($temProximaPagina){?>
            <a href="?pag=<?=($paginaAtual + 1)?>">Próximo</a>
            <?php } ?>
        </div>

        <?php
        

                  }//FIM DO IF ?>
   
        <div id="rodape">
            <a href="entrar.php">Entrar no Sistema</a>
            <a href="cadastrar.php">Cadastrar</a>
        </div>

    </div>
    
</body>
</html>