<?php
session_start();
require("conecta.php");

echo "<pre>";
print_r($_POST);
echo "</pre>";

if (!isset($_SESSION['usuario_id'])) {
    die("Você precisa estar logado.");
}

if (!isset($_POST['tarefa_id']) || !isset($_POST['descricao'])) {
    die("Dados incompletos.");
}

$tarefa_id = $_POST['tarefa_id'];
$descricao = $_POST['descricao'];
$usuario_id = $_SESSION['usuario_id'];

try {
    $sql = "UPDATE tarefas SET descricao = :descricao WHERE id = :id AND usuario_id = :usuario_id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':descricao' => $descricao,
        ':id' => $tarefa_id,
        ':usuario_id' => $usuario_id
    ]);


    header("Location: ToDoList.php");
    exit;

} catch (PDOException $e) {
    die("Erro ao atualizar tarefa: " . $e->getMessage());
}
