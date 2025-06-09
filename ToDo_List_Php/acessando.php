<?php
require("conecta.php");
session_start();

$senha = $_POST["senha"];
$email = $_POST["email"];

try {
    $stmt = $conn->prepare("SELECT * FROM `usuarios` WHERE `email` = :email AND `senha` = :senha");
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":senha", $senha);
    $stmt->execute();

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nome'] = $usuario['nome']; 

        header("Location: ToDoList.php");
        exit();
    } else {
        header("Location: index.php?erro=1");
    }
} catch(PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
