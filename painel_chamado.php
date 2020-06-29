<?php
session_start();

require 'conexao.php';



?>

<div style="display: flex; justify-content: center;">
    <div style="margin-top: 20px; display: flex; justify-content: space-between; width: 100%; max-width: 860px;">
        <div><a href="index.php">Inicio</a></div>
        <div><a href="logout.php">Sair</a></div>
    </div>
</div>

<br>

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



        if (isset ($_SESSION['id']) && empty($_SESSION['id']) == false) {

            if($_SESSION['tipo_usuario'] == 1) {

            $sql = $pdo->query("SELECT chamado.id_chamado, usuario.nome as solicitante, (SELECT setores.descricao FROM setores WHERE usuario.setor_usuario = setores.id_setor) as setor, prioridade.nome as prioridade, chamado.descricao, status.nome as status FROM chamado INNER JOIN usuario ON id_usuario = solicitante INNER JOIN prioridade ON id_prioridade = prioridade_id INNER JOIN status ON id_status = status_id WHERE responsavel='$_SESSION[id]' AND chamado.status_id='2'");

            if ($sql->rowCount() > 0) {
                foreach ($sql->fetchAll() as $chamado) {
                    echo '<tr>';
                    echo '<th>' . $chamado['id_chamado'] . '</th>';
                    echo '<th>' . $chamado['solicitante'] . '</th>';
                    echo '<th>' . $chamado['setor'] . '</th>';
                    echo '<th>' . $chamado['prioridade'] . '</th>';
                    echo '<th>' . $chamado['descricao'] . '</th>';
                    echo '<th>' . $chamado['status'] . '</th>';
                    echo '<th><a href= "finalizar.php?id=' . base64_encode($chamado['id_chamado']) . '">Finalizar</a></th>';

                    echo '</tr>';
                }

            }
        }else{
                session_destroy();
            header("Location: login.php");
            }
    }
        else{
            session_destroy();
            header("Location: login.php");
        }
    ?>

</table>

<h3>Solicitações para Atender</h3>
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

    $setor = $_SESSION['setor'];
    $sql = $pdo->query("SELECT chamado.id_chamado, usuario.nome as solicitante, prioridade.nome as prioridade, chamado.descricao, status.nome as status, chamado.responsavel, (SELECT setores.descricao FROM setores WHERE usuario.setor_usuario = setores.id_setor) as setor, (SELECT usuario.nome FROM usuario WHERE usuario.id_usuario = chamado.responsavel) as tecnico FROM chamado INNER JOIN usuario ON id_usuario = solicitante INNER JOIN prioridade ON id_prioridade = prioridade_id INNER JOIN status ON id_status = status_id WHERE (status_id = '1' AND chamado.setor = '$setor')");


    if($sql->rowCount() > 0){
        foreach($sql->fetchAll() as $chamado){
            echo '<tr>';
            echo '<th>'.$chamado['id_chamado'].'</th>';
            echo '<th>'.$chamado['solicitante'].'</th>';
            echo '<th>'.$chamado['setor'].'</th>';
            echo '<th>'.$chamado['prioridade'].'</th>';
            echo '<th>'.$chamado['descricao'].'</th>';
            echo '<th>'.$chamado['status'].'</th>';
            if($chamado['tecnico'] <= 0)
                //echo '<th><a href= "pegar.php?id=' . base64_encode($chamado['id_chamado']) . '">Pegar</a></th>';
                echo '<th><a href= "visualiza_chamado.php?id='.base64_encode($chamado['id_chamado']).'">Visualizar</a></th>';

            echo '</tr>';
        }

    }
    echo "<meta HTTP-EQUIV='refresh' CONTENT='10;URL=painel_chamado.php'>";
    ?>

</table>