<?php

    include('config.php');
    if(isset($_POST['conf'])){
    $usuario=$_POST["txt_reg_usuario"];
    $senha=$_POST["txt_reg_senha"];
    $criptografada = password_hash($senha, PASSWORD_DEFAULT);

    if($usuario == '' || $senha == ''){
        echo 'Preencha o campo.';
    }else{
        $sql = $pdo->prepare("INSERT INTO usuarios VALUES (null, ?, ?)");
        $sql->execute([$usuario, $criptografada]);
        echo 'Usuário cadastrado com sucesso';
    }
}   

if(isset($_GET['sair'])){
    session_destroy();
    header('Location: index.php');
    die();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registrar</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>

    <form method="post">
        <h1>Registro de Usuário</h1><br>
        <input type="text" name="txt_reg_usuario" placeholder="Insira um nome de usuário">
        <input type="text" name="txt_reg_senha" placeholder="Insira uma senha">
        <input type="submit" value="Confirmar" name="conf">
        <button><a href="?sair">Sair</a></button>
    </form>    
</body>
</html>