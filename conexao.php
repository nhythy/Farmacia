<?php
    $host = "localhost";
    $user = "root";
    $senha = "";
    $bd = "farmacia";
    $conexao = mysqli_connect($host, $user, $senha, $bd);
    if (mysqli_connect_errno()){
        echo "sem conexao";
        exit();
    }
    mysqli_select_db($conexao, $bd) or die("nao foi encontrando o banco");
    mysqli_set_charset($conexao, "utf8");
?>
