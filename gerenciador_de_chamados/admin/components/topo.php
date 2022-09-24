<?php require_once "validar-acesso.php";?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
#menu{
   
   marg        in:0;
   padding:0;
   background-color: #b33e36;
}
#menu ul{
   list-style: none;
   padding: 0;
   margin:0;
   display: flex;

}
#menu ul li{
   padding: 1rem 0;
   margin:0;
}
#menu ul li a{
   text-decoration: none;
   padding:1rem;
   color:#FFF
}
#menu ul li a:hover{
   color:#b33e36;
   background-color:#FFF;
}
.container{
    gap:0;
}
#menu{
    box-shadow:0px 5px 5px rgba(0,0,0,0.7)
}
.sejabemvindo{
    float:right;
}

.container  form{
    background-color: rgba(0 ,0,0,0.2);
    padding: 1rem;
}
.container  form div{
    width: 100%;
    margin-bottom: 1rem;

}
.container  form div > label{
    display: block;
    font-weight: bold;

}
.container  form div > input,.container  form div > select,.container  form div > textarea{
 box-sizing: border-box;
 padding: 0.6rem;
 width: 100%;
 border-radius: 5px;
 outline: none;
 border:1px solid #444;
}
textarea{
    height:20rem;
}
.my-table{
    width: 100%;
    border:1px solid #444;
    border-collapse:collapse;
    margin-top: 1rem;


}
.my-table thead tr:first-child{
    background-color: rgb(104, 6, 104);
    color:#FFF;
}
.my-table tr, .my-table th, .my-table td{
    border:1px solid #000;
    padding:0.7rem;
}
.message{
    border:1px solid rgb(104, 6, 104);
    background-color:  rgba(104,6,104,0.7);
    color:#FFF;
    padding:1rem;
    margin-top:3rem;
}
.w-50{
    float:left;
    width:50% !important;
    padding: 0 0.5rem;
    box-sizing:border-box;
}
.btn-edit{
    background-color:rgb(28, 31, 201);
    color:#FFF;
}
.btn-close{
    background-color:rgb(227, 18, 21);
    color:#FFF;

}
.btn-answer{
    background-color:rgb(21, 117, 64);
    color:#FFF;

}
a{
    box-sizing:border-box;
    display:inline-block;
    

}
#card-chamado {
    background-color: #DDD;
    border:1px solid #000;
    padding : 1rem;
    border-radius:5px;
    margin: 0.5rem 0;
}
#card-chamado label{
    display: block;
    font-weight:bold;
    margin-bottom:0.5rem;

}
#card-chamado div{
    margin-bottom:1rem;

}
    </style>
</head>
<body>
<div class="container">
 
        <h1>Sistema de Chamados</h1>
  
    <nav id="menu">
        <ul>
            <li><a href="<?=$baseUrl?>admin/">Home</a></li>
            <li><a href="<?=$baseUrl?>admin/cadastrar-chamado.php">Cadastrar Chamados</a></li>
            <li><a href="<?=$baseUrl?>admin/ver-chamado.php">Ver Chamados</a></li>
            <?php if(validarPermissao(['FUNC'])): ?>
            <li><a href="<?=$baseUrl?>admin/categorias.php">Categorias</a></li>
            <?php endif ;?>
            <li><a href="<?=$baseUrl?>admin/sair.php">Sair</a></li>
        </ul>
    </nav>
    <section id="conteudo">
   <p class="sejabemvindo">
    Seja bem vindo ao sistema! <?=$_SESSION["nome"]?>
   </p>

   <?php if(isset($_GET["m"])){?>
        <div class="message">
            <?=base64_decode($_GET["m"])?>
        </div>
        <?php }?>
