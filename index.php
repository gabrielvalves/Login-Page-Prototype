<?php
include('config.php');

if(isset($_POST['acao'])){
    $usuario = $_POST['txt_usuario'];
    $senha = $_POST['txt_senha'];

    $sql = $pdo->prepare("SELECT * FROM usuarios WHERE usuario = ?");
    $sql->execute([$usuario]);

    if($sql->rowCount() == 1){
        $info = $sql->fetch();
        if(password_verify($senha, $info['senha'])){
            $_SESSION['login'] = true;
            $_SESSION['id'] = $info['id'];
            $_SESSION['usuario'] = $info['usuario'];
            header("Location: main.php");
            die();
        }else{
            //Erro
            echo '<div class="box_erro_login"><p><i class="fas fa-exclamation-circle"></i> Usuário ou senha incorretos!</p></div>';
        }
    }else{
        //Erro
        echo '<div class="box_erro_login"><p><i class="fas fa-exclamation-circle"></i> Usuário não encontrado.</p></div>';
    }
}

if(isset($_GET['registrar'])){
    session_destroy();
    header('Location: register.php');
    die();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
<h1>Login</h1>
<form method="post">
    <input type="text" name="txt_usuario" placeholder="Insira o usuário">
    <input type="password" name="txt_senha" placeholder="Insira a senha" >
    <input href= ""type="submit" value="Entrar" name="acao">
    <button><a href="?registrar">Registrar</a></button>
</form>
</body>
</html>


