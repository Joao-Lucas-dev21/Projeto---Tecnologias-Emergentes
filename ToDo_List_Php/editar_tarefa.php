<?php
session_start();
require("conecta.php");

if (!isset($_SESSION['usuario_id'])) {
    die("Você precisa estar logado.");
}

if (!isset($_GET['tarefa_id'])) {
    die("ID da tarefa não fornecido.");
}

$tarefa_id = $_GET['tarefa_id'];
$usuario_id = $_SESSION['usuario_id'];

$sql = "SELECT * FROM tarefas WHERE id = :id AND usuario_id = :usuario_id";
$stmt = $conn->prepare($sql);
$stmt->execute([
    ':id' => $tarefa_id,
    ':usuario_id' => $usuario_id
]);

$tarefa = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$tarefa) {
    die("Tarefa não encontrada ou acesso negado.");
}
?>

<!DOCTYPE html>
<html lang="pt-br" class="h-100">

<head>
    <meta charset="UTF-8">
    <title>Editar Tarefa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">

</head>

<body class="h-100">
    <main class="d-flex justify-content-center align-items-center w-100 bg-secondary-subtle h-100 ">
        <div class="bg-light h-25 shadow" style="width: 35%;">
            <div class="text-center p-5">
                <h1 class="text-uppercase">Editar Tarefa</h1>
                <div class="p-4 ">

                    <form class="d-flex justify-content-center align-items-center" action="atualizar_tarefa.php" method="POST">
                        <input type="hidden" name="tarefa_id" value="<?php echo $tarefa['id']; ?>">
                        <input type="text" class="rounded" name="descricao" placeholder="Digite a nova tarefa" required>
                        <input type="submit" class="btn btn-primary btn-sm mx-2" value="Salvar">
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>

</html>