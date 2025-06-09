<?php
session_start();
require("conecta.php");

$usuario = $_SESSION['usuario_id'];
$tarefa = $_POST['tarefa'];

try{
$sql = "INSERT INTO tarefas (usuario_id, descricao) VALUES (:usuario, :tarefa)";
$stmt= $conn->prepare($sql);
$stmt->execute([':usuario' => $usuario,':tarefa' => $tarefa]);
header("Location:ToDoList.php");

} catch (PDOException $e){
    echo "Erro ao adicionar tarefa: " .$e->getMessage();
    
}
?>