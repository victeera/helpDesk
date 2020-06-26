<?php

    session_start();

require 'conexao.php';

?>

<h3>Meus chamados</h3>
<table border="0" width="100%">
    <tr>
        <th>Sequêncial</th>
        <th>Solicitante</th>
        <th>Setor</th>
        <th>Prioridade</th>
        <th>Descrição</th>
        <th>Status</th>
        <th>Resposável</th>


    </tr>
    <?php
    if(isset ($_SESSION['id']) && empty($_SESSION['id']) == false) {
    $sql = $pdo->query("SELECT chamado.id_chamado, usuario.nome as solicitante, chamado.setor, chamado.prioridade, chamado.descricao, chamado.status, chamado.responsavel, (SELECT usuario.nome FROM usuario WHERE usuario.id_usuario = chamado.responsavel) as tecnico FROM chamado INNER JOIN usuario ON id_usuario = solicitante WHERE solicitante='$_SESSION[id]'");
echo $_SESSION['nome'];
    if($sql->rowCount() > 0){
        foreach($sql->fetchAll() as $chamado){
            echo '<tr>';
            echo '<th>'.$chamado['id_chamado'].'</th>';
            echo '<th>'.$chamado['solicitante'].'</th>';
            echo '<th>'.$chamado['setor'].'</th>';
            echo '<th>'.$chamado['prioridade'].'</th>';
            echo '<th>'.$chamado['descricao'].'</th>';
            echo '<th>'.$chamado['status'].'</th>';
            echo '<th>'.$chamado['tecnico'].'</th>';
            if($chamado['responsavel'] <= 0) {
                echo '<td><a href= "editar.php?id=' . $chamado['id_chamado'] . '">Editar</a></td>';
            }
            if($chamado['status'] == "finalizado") {
                echo '<td><a href= "visualizar.php?id=' . $chamado['id_chamado'] . '">Visualizar</a></td>';
            }
                echo '</tr>';
        }

    }
    }else{
        session_destroy();
        header("Location: login.php");
    }
    ?>

</table>