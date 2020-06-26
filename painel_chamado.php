<?php
require 'conexao.php';

session_start();

?>

<h3>Meus chamados</h3>
<table border="0" width="100%">
    <tr>
        <th>Seqêncial</th>
        <th>Solicitante</th>
        <th>Setor</th>
        <th>Prioridade</th>
        <th>Descrição</th>
        <th>Status</th>


    </tr>
    <?php
    $sql = $pdo->query("SELECT chamado.id_chamado, usuario.nome as solicitante, chamado.setor, chamado.prioridade, chamado.descricao, chamado.status, chamado.responsavel, (SELECT usuario.nome FROM usuario WHERE usuario.id_usuario = chamado.responsavel) as tecnico FROM chamado INNER JOIN usuario ON id_usuario = solicitante WHERE responsavel='$_SESSION[id]' AND status='em processo'");

    if($sql->rowCount() > 0){
        foreach($sql->fetchAll() as $chamado){
            echo '<tr>';
            echo '<th>'.$chamado['id_chamado'].'</th>';
            echo '<th>'.$chamado['solicitante'].'</th>';
            echo '<th>'.$chamado['setor'].'</th>';
            echo '<th>'.$chamado['prioridade'].'</th>';
            echo '<th>'.$chamado['descricao'].'</th>';
            echo '<th>'.$chamado['status'].'</th>';
            echo '<th><a href= "pegar.php?id=' . $chamado['id_chamado'] . '">Finalizar</a></th>';

            echo '</tr>';
        }

    }
    ?>

</table>

<h3>Painel de Chamados</h3>
<table border="0" width="100%">
    <tr>
        <th>Seqêncial</th>
        <th>Solicitante</th>
        <th>Setor</th>
        <th>Prioridade</th>
        <th>Descrição</th>
        <th>Status</th>


    </tr>
    <?php
    $sql = $pdo->query("SELECT chamado.id_chamado, usuario.nome as solicitante, chamado.setor, chamado.prioridade, chamado.descricao, chamado.status, chamado.responsavel, (SELECT usuario.nome FROM usuario WHERE usuario.id_usuario = chamado.responsavel) as tecnico FROM chamado INNER JOIN usuario ON id_usuario = solicitante WHERE chamado.status = 'em aberto'");

    if($sql->rowCount() > 0){
        foreach($sql->fetchAll() as $chamado){
            echo '<tr>';
            echo '<th>'.$chamado['id_chamado'].'</th>';
            echo '<th>'.$chamado['solicitante'].'</th>';
            echo '<th>'.$chamado['setor'].'</th>';
            echo '<th>'.$chamado['prioridade'].'</th>';
            echo '<th>'.$chamado['descricao'].'</th>';
            echo '<th>'.$chamado['status'].'</th>';
            if($chamado['responsavel'] <= 0)
                echo '<th><a href= "pegar.php?id=' . $_SESSION['id'] . '">Pegar</a></th>';

            echo '</tr>';
        }

    }
    ?>

</table>