<?php
session_start();
require("conecta.php");
if (!isset($_SESSION['usuario_id'])) {
    die("Você precisa estar logado para ver suas tarefas.");
}

$usuario_id = $_SESSION['usuario_id'];

try {
    $sql = "SELECT * FROM tarefas WHERE usuario_id = :usuario_id ORDER BY id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':usuario_id' => $usuario_id]);
    $tarefas = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro ao buscar tarefas: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="pt-BR" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-do-List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>

<body class="h-100">
    <main class="d-flex justify-content-center align-items-center w-100 bg-secondary-subtle h-100 ">
        <div class="bg-light h-auto shadow rounded" style="width: 35%;">
            <h1 class="m-5 text-center text-uppercase fw-bolder">To-do List</h1>

            <div class="row">
                <form class=" gap-1 d-flex justify-content-center align-items-center" method="POST" action="adicionar_tarefa.php">
                    <input class="rounded" type="text" name="tarefa" placeholder="Digite sua tarefa" required>
                    <button type="submit" class="btn btn-primary btn-sm fw-semibold">Add</button>
                </form>
                <div class="col p-3">
                    <?php if (count($tarefas) === 0): ?>
                        <p class="text-center m-3">Você ainda não cadastrou nenhuma tarefa.</p>
                    <?php else: ?>
                        <div class="text-capitalize	">
                            <ul class="list-unstyled">
                                <?php foreach ($tarefas as $tarefa): ?>
                                    <li>
                                        <div class="d-flex align-items-center position-relative my-3 bg-secondary-subtle">
                                            <div class=" position-absolute start-50 translate-middle-x">
                                                <div class="fw-bolder">
                                                    <?php echo htmlspecialchars($tarefa['titulo'] ?? $tarefa['descricao'] ?? 'Sem título'); ?>
                                                </div>
                                            </div>

                                            <div class="ms-auto mx-5">
                                                <form action="editar_tarefa.php" method="GET">
                                                    <input type="hidden" name="tarefa_id" value="<?php echo $tarefa['id']; ?>">
                                                    <input type="submit" class="btn btn-secondary btn-sm w-100 fw-semibold" value="Editar">

                                                </form>
                                                <form action="excluir_tarefa.php" method="POST">
                                                    <input type="hidden" name="tarefa_id" value="<?php echo $tarefa['id']; ?>">
                                                    <input type="submit" class="btn btn-danger btn-sm fw-semibold" value="Excluir">

                                                </form>
                                            </div>
                                        </div>

                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
    </main>
    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous">
    </script>

</body>

</html>