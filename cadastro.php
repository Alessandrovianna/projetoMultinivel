<?php
session_start();
require 'config.php';

if(!empty($_POST['nome']) && !empty($_POST['email']) ) {
    $nome = addslashes($_POST['nome']);
    $email = addslashes($_POST['email']);
    $id_pai = $_SESSION['login'];
    $senha = md5($email);

    $sql = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
    $sql->bindValue(":email", $email);
    $sql->execute();

    if($sql->rowCount() == 0) {
        $sql = $pdo->prepare("INSERT INTO usuarios (id_pai, nome, email, senha) VALUES (:id_pai, :nome, :email, :senha)");
        $sql->bindValue(":id_pai", $id_pai);
        $sql->bindValue(":nome", utf8_encode($nome));
        $sql->bindValue(":email", $email);
        $sql->bindValue(":senha", $senha);
        $sql->execute();

        header("Location: index.php");
    } else {
        echo "Usuário já cadastrado no sistema";
    }
}
?>
<h2>Cadastrar Novo Usuário</h2>
<form method="POST">
    Nome:<br>
    <input type="text" name="nome"><br><br>

    E-mail:<br>
    <input type="email" name="email"><br><br>

    <input type="submit" value="Cadastrar" style="border:0;color:#FFF;background-color:#000;padding:5px;border-radius:4px;"><br><br>
</form>