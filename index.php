<?php

    session_start();

require 'conexao.php';

?>

<div style="display: flex; justify-content: center;">
    <div style="margin-top: 20px; display: flex; justify-content: space-between; width: 100%; max-width: 860px;">
        <div><a href="novo_chamado.php">Novo Chamado</a> &nbsp;&nbsp;&nbsp; <?php
                $tipo_usuario = $_SESSION['tipo_usuario'];
                if ( $tipo_usuario == 1 or  $tipo_usuario == 2) {
                    echo '<a href="painel_chamado.php">Atender Solicitações</a>';
        }

        ?>
            &nbsp;&nbsp;&nbsp;  <a href="historico_chamado.php">Histórico de Chamados</a>
        </div>
        <div><a href="logout.php">Sair</a></div>
    </div>
</div>

<br><br><br>

<div style="display: flex; justify-content: center;">
<h3>Chamados Abertos</h3>
</div>
<br><br><br>

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
    $sql = $pdo->query("SELECT chamado.id_chamado, usuario.nome as solicitante, prioridade.nome as prioridade, chamado.descricao, status.nome as status, chamado.responsavel, (SELECT usuario.nome FROM usuario WHERE usuario.id_usuario = chamado.responsavel) as tecnico FROM chamado INNER JOIN usuario ON id_usuario = solicitante INNER JOIN prioridade ON id_prioridade = prioridade_id INNER JOIN status ON id_status = status_id WHERE (solicitante='$_SESSION[id]' AND chamado.status_id='1') OR (solicitante='$_SESSION[id]' AND chamado.status_id='2')");
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
                echo '<td><a href= "editar.php?id=' . $chamado['id_chamado'] . '">Editar</a> - <a href= "excluir.php?id=' . $chamado['id_chamado'] . '">Excluir</a></td>';
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