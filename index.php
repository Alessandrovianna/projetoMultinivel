<?php
session_start();
require 'config.php';
require 'funcoes.php';

if(empty($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$id = $_SESSION['login'];

$sql = $pdo->prepare("SELECT usuarios.nome, patentes.nome as p_nome FROM usuarios LEFT JOIN patentes ON patentes.id = usuarios.patente WHERE usuarios.id = :id");
$sql->bindValue(":id", $id);
$sql->execute();

if($sql->rowCount() > 0) {
    $sql = $sql->fetch();
    $nome = $sql['nome'];
    $p_nome = utf8_encode($sql['p_nome']);

} else {
    header("Location: login.php");
    exit;
}

$lista = listar($id, $limite);

?>
<h1>Sistema de Marketing Multinivel</h1>
<h2><?php echo "Seja bem vindo ".$nome.' ('.$p_nome.')'; ?></h2>

<a href="cadastro.php" style="text-decoration:none;color:#FFF;background-color:#000;padding:5px;border-radius:4px;">
    Cadastrar Novo Usuário
</a><br><br>

<a href="sair.php" style="text-decoration:none;color:#FFF;background-color:#000;padding:5px;border-radius:4px;">
    Sair
</a>
<hr>

<h4>Lista de cadastros</h4>

<?php exibir($lista); ?>
