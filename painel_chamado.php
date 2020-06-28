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

            $sql = $pdo->query("SELECT chamado.id_chamado, usuario.nome as solicitante, chamado.setor, chamado.prioridade, chamado.descricao, chamado.status, chamado.responsavel, (SELECT usuario.nome FROM usuario WHERE usuario.id_usuario = chamado.responsavel) as tecnico FROM chamado INNER JOIN usuario ON id_usuario = solicitante WHERE responsavel='$_SESSION[id]' AND status='em processo'");

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
    // passar por get o codigo do setor $setor = 10;
    $setor = $_SESSION['setor'];
    $sql = $pdo->query("SELECT chamado.id_chamado, usuario.nome as solicitante, chamado.prioridade, 
chamado.descricao, chamado.status, chamado.responsavel, (SELECT setores.descricao FROM setores WHERE usuario.setor_usuario = setores.id_setor) 
as setor, (SELECT usuario.nome FROM usuario WHERE usuario.id_usuario = chamado.responsavel) as tecnico FROM chamado INNER JOIN usuario ON id_usuario = solicitante 
WHERE (chamado.status = 'em aberto' AND chamado.setor_destino = ' $setor') OR (chamado.status = 'em processo' AND chamado.setor_destino = ' $setor')");


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
                echo '<th><a href= "visualiza_chamado.php?id=' . base64_encode($chamado['id_chamado']) . '">Visualizar</a></th>';

            echo '</tr>';
        }

    }
    echo "<meta HTTP-EQUIV='refresh' CONTENT='10;URL=painel_chamado.php'>";
    ?>

</table>