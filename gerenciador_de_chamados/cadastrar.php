<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <style>
    .message{
    border:1px solid rgb(104, 6, 104);
    background-color:  rgba(104,6,104,0.7);
    color:#FFF;
    padding:1rem;
}
    </style>
 
    <title>Document</title>
</head>
<body>
    <div class="container">
        <?php if(isset($_GET["m"])){?>
        <div class="message">
            <?=base64_decode($_GET["m"])?>
        </div>
        <?php }?>
        <form action="save_usuario.php" method ="POST">
            <div>
                <label for="login">Login:</label>
                <input type="text" name ="login" id="login" required>
            </div>
            <div>
                <label for="senha">Senha:</label>
                <input type="password" name ="senha" id="senha" required>
            </div>
            <div>
                <label for="nome">Nome:</label>
                <input type="text" name ="nome" id="nome" required>
            </div>
            <div>
                <label for="tipo">Tipo:</label>
               <select name="tipo" id="tipo" required>>
                <option value="CLI"> CLIENTE</option>
                <option value="FUNC"> FUNCIONÁRIO</option>
               </select>
            </div>
            <input type="submit" value = "Cadastrar no Sistema" class = "btn btn-logar">
        </form>
        <div id="rodape">
            <a href="index.php">Ver Chamados</a>
            <a href="entrar.php">Logar no Sistema</a>
        </div>

    </div>
</body>
</html>