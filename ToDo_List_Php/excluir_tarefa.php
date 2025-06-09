<?php
session_start();
require("conecta.php");

if (!isset($_SESSION['usuario_id'])) {
    die("Você precisa estar logado.");
}

if (!isset($_POST['tarefa_id'])) {
    die("ID da tarefa não enviado.");
}

$tarefa_id = $_POST['tarefa_id'];
$usuario_id = $_SESSION['usuario_id'];

try {
    $sql = "DELETE FROM tarefas WHERE id = :id AND usuario_id = :usuario_id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':id' => $tarefa_id,
        ':usuario_id' => $usuario_id
    ]);

    header("Location: ToDoList.php");
    exit;
} catch (PDOException $e) {
    die("Erro ao excluir tarefa: " . $e->getMessage());
}
?>
