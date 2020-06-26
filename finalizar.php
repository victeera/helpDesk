<?php
session_start();

require 'conexao.php';

if(isset($_GET['id']) && empty($_GET['id']) == false){
    $id_chamado = base64_decode(addslashes($_GET['id']));

    $sql = $pdo->query("UPDATE chamado SET status='finalizado' WHERE id_chamado = '$id_chamado'");

    header("Location: painel_chamado.php");

}

?>
