<?php
require("conecta.php");


$nome = $_POST["nome"];
$senha = $_POST["senha"];
$email = $_POST["email"];


try {
    $stmt = $conn->prepare("INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`) VALUES (NULL, :nome, :email, :senha)");
    $stmt->bindParam("email", $email);
    $stmt->bindParam("nome", $nome);
    $stmt->bindParam("senha", $senha);

    if ($stmt->execute()) {
        header("Location:index.php?msg=0");
    } else {
        echo "Erro no cadastro do usuário!";
    }
} catch (PDOException $e) {
    $e->getMessage();
}
