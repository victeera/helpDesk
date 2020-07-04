<?php
session_start();

require 'conexao.php';
if(isset ($_SESSION['id']) && !empty($_SESSION['id'])) {

    $id = addslashes($_POST['sequencial']);
    $retorno = addslashes($_POST['retorno']);
    echo $id;
    echo $retorno;
if (isset($_POST['sequencial']) && !empty($_POST['sequencial'])) {

    $sql = $pdo->query("UPDATE chamado SET status_id='3', retorno='$retorno' WHERE id_chamado = '$id'");

    header("Location: painel_chamado.php");

}
}else{
    session_destroy();
    header("Location: login.php");
}

?>
