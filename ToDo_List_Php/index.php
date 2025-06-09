<?php
session_start();
if (isset($_POST['usuario_id'])) {
    $_SESSION['usuario_id'] = $usuario['id'];
}

if (isset($_GET["msg"])) {
    $msg = "Usuário cadastrado. Faça o login";
} else {
    $msg = "";
}

if (isset($_GET["erro"])) {
    $erro = "Usuário não cadastrado. Faça o cadastro ou tente um login válido!";
} else {
    $erro = "";
}

?>

<!DOCTYPE html>
<html lang="pt-BR" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>

<body class="h-100">
    <main class="d-flex align-items-center w-100 m-auto bg-secondary-subtle h-100 ">
        <div class="container bg-light text-black w-25 p-5 shadow-lg rounded">
            <h2 class="text-center text-uppercase fw-bolder mb-5">ACESSE SUA CONTA </h2>
            <p class="text-center">Bem vindo(a) ao To-do List</p>
            <div class="container">
                <form class="" action="acessando.php" method="post">
                    <div class="mt-auto">
                        <label class="container mx-1 mt-2 fw-medium form-label">Email:</label>
                        <div class="d-inline-flex w-100">
                            <input class="form-control mx-3" type="text" name="email" id="email" required placeholder="Digite seu email">
                        </div>
                        <br>
                    </div>
                    <div class="mt-auto">
                        <label class="container mx-1 mt-2 fw-medium form-label">Senha:</label>
                        <div class="d-inline-flex w-100">
                            <input class="form-control mx-3" type="password" name="senha" id="senha" required placeholder="Digite sua senha">
                        </div>
                        <br>
                    </div>
                    <div class="text-center">
                        <input class="btn btn-primary mt-3" type="submit" value="Acessar">
                        <a href="cadastro.php"><input class="btn btn-secondary mt-3" type="button" value="Cadastrar"></a>
                    </div>
                    <?php
                    echo "<div class=text-center>
                     $msg
                     $erro
                    </div>"
                    ?>
                </form>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>

</html>