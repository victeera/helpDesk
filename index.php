<?php

    session_start();

require 'conexao.php';

?>


<div style="display: flex; justify-content: center;">
    <div style="margin-top: 20px; display: flex; justify-content: space-between; width: 100%; max-width: 860px;">
    <div><a href="">Novo Chamado</a> &nbsp;&nbsp;&nbsp;  <a href="">Histórico de Chamados</a></div>
    <div><a href="logout.php">Sair</a></div>
</div>
</div>

<br>
<h3>Painel de Chamados</h3>

<table border="0" width="100%">
    <tr>
        <th>Sequêncial</th>
        <th>Solicitante</th>
        <th>Prioridade</th>
        <th>Descrição</th>
        <th>Status</th>
        <th>Resposável</th>


    </tr>
    <?php
    if(isset ($_SESSION['id']) && empty($_SESSION['id']) == false) {
    $sql = $pdo->query("SELECT chamado.id_chamado, usuario.nome as solicitante, chamado.prioridade, chamado.descricao, chamado.status, chamado.responsavel, (SELECT usuario.nome FROM usuario WHERE usuario.id_usuario = chamado.responsavel) as tecnico FROM chamado INNER JOIN usuario ON id_usuario = solicitante WHERE (solicitante='$_SESSION[id]' AND chamado.status='em aberto') OR (solicitante='$_SESSION[id]' AND chamado.status='em processo')");
    if($sql->rowCount() > 0){
        foreach($sql->fetchAll() as $chamado){
            echo '<tr>';
            echo '<th>'.$chamado['id_chamado'].'</th>';
            echo '<th>'.$chamado['solicitante'].'</th>';
            echo '<th>'.$chamado['prioridade'].'</th>';
            echo '<th>'.$chamado['descricao'].'</th>';
            echo '<th>'.$chamado['status'].'</th>';
            echo '<th>'.$chamado['tecnico'].'</th>';
            if($chamado['responsavel'] <= 0) {
                echo '<td><a href= "editar.php?id=' . $chamado['id_chamado'] . '">Editar</a></td>';
            }
                echo '</tr>';
        }

    }else{
        echo "<h3 style='text-align: center;'>VOCÊ NÃO POSSUI CHAMADOS ABERTOS</h3> <br><br>";
    }
    }else{
        session_destroy();
        header("Location: login.php");
    }
    echo "<meta HTTP-EQUIV='refresh' CONTENT='10;URL=index.php'>";

    ?>

</table>