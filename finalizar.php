<?php
session_start();

require 'conexao.php';
if(isset ($_SESSION['id']) && empty($_SESSION['id']) == false) {
if (!empty($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] == 1) {
if(isset($_GET['id']) && empty($_GET['id']) == false){
    $id_chamado = base64_decode(addslashes($_GET['id']));

    $sql = $pdo->query("UPDATE chamado SET status='Finalizado' WHERE id_chamado = '$id_chamado'");

    header("Location: painel_chamado.php");

}
}else{
    session_destroy();
    header("Location: login.php");
}
}else{
    session_destroy();
    header("Location: login.php");
}

?>
