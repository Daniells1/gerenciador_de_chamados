<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
    <?php if(isset($_GET["m"])){?>
        <div class="message">
            <?=base64_decode($_GET["m"])?>
        </div>
        <?php }?>
        <form action="logar.php" method ="post">
            <div>
                <label for="login">Login</label>
                <input type="text" name ="login" id="login">
            </div>
            <div>
                <label for="senha">Senha</label>
                <input type="password" name ="senha" id="senha">
            </div>
            <input type="submit" value = "Logar no Sistema" class = "btn btn-logar">
        </form>
        <div id="rodape">
            <a href="index.php">Ver Chamados</a>
            <a href="cadastrar.php">Cadastrar</a>
        </div>

    </div>
</body>
</html>