<?php
session_start();

if (!empty($_SESSION['active'])) {
    header('location: src/');
} else {
    if (!empty($_POST)) {
        require_once "conexao.php";

        $user = mysqli_real_escape_string($conexao, $_POST['usuario']);
        $senha = md5(mysqli_real_escape_string($conexao, $_POST['senha']));

        $query = mysqli_query($conexao, "SELECT * FROM usuario WHERE usuario = '$user' AND senha = '$senha'");
        mysqli_close($conexao);

        $resultado = mysqli_num_rows($query);

        if ($resultado > 0) {
            $dado = mysqli_fetch_array($query);
            $_SESSION['active'] = true;
            $_SESSION['idUser'] = $dado['idusuario'];
            $_SESSION['nome'] = $dado['nome'];
            $_SESSION['user'] = $dado['usuario'];
            header('Location: src/');
        } else {
            $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Usuário ou senha incorretos.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
            session_destroy();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Iniciar Sessao</title>
    <link rel="stylesheet" href="assets/css/material-dashboard.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/img/favicon.ico" />
</head>

<body class="bg">
    <div class="col-md-4 mx-auto">
        <?php echo (isset($alert)) ? $alert : ''; ?>
        <div class="card">
            <div class="card-header card-header-primary text-center">
                <h4 class="card-title">Iniciar Sessao</h4>
                <img class="img-thumbnail" src="assets/img/logo.png" width="150"/>
            </div>
            <div class="card-body">
                <?php echo isset($alert) ? $alert : ''; ?>
                <form action="" method="post" class="p-3">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-lg text-center" id="exampleInputEmail1" placeholder="Usuario" name="usuario">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control form-control-lg text-center" id="exampleInputPassword1" placeholder="Senha" name="senha">
                    </div>
                    <div class="mt-3">
                        <button class="btn btn-block btn-dark btn-lg font-weight-medium auth-form-btn" type="submit">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="assets/js/material-dashboard.js"></script>
</body>

</html>
