<?php
try {
    global $pdo;

    $pdo = new PDO("mysql:dbname=projeto_marketingmultinivel;host=localhost", "root", "P63H65P");
} catch(PDOException $e) {
    echo "ERRO: ".$e->getMessage();
    exit;
}

$limite = 3;

?>