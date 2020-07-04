<?php

session_start();

include 'conexao.php';

if(isset($_SESSION['id']) && !empty($_SESSION['id'])){
    $id = addslashes(base64_decode($_GET['id']));

    $sql = $pdo->query("DELETE FROM chamado WHERE id_chamado = '$id'");
    header("Location: index.php");

}


?>