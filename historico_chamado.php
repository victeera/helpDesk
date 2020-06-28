<?php

session_start();

require 'conexao.php';

if(isset($_SESSION['id']) && !empty($_SESSION['id'])){





}

?>
<div style="display: flex; justify-content: center;">
    <div style="margin-top: 20px; display: flex; justify-content: space-between; width: 100%; max-width: 860px;">
        <div><a href="index.php">Inicio</a> &nbsp;&nbsp;&nbsp;  </div>
        <div><a href="logout.php">Sair</a></div>
    </div>
</div>

<br><br><br><br>

<div style="display: flex; justify-content: center;">
    <h3>Histórico de Chamados</h3>
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
        $id = $_SESSION['id'];
        $sql = $pdo->query("SELECT chamado.id_chamado, usuario.nome as solicitante, chamado.prioridade, chamado.descricao, chamado.status, (SELECT usuario.nome FROM usuario WHERE usuario.id_usuario = chamado.solicitante) as tecnico FROM chamado INNER JOIN usuario ON solicitante = id_usuario WHERE (status = 'finalizado' && solicitante = '$id' )");
             if($sql->rowCount() > 0){
            foreach($sql->fetchAll() as $chamado){
                echo '<tr>';
                echo '<th>'.$chamado['id_chamado'].'</th>';
                echo '<th>'.$chamado['solicitante'].'</th>';
                echo '<th>'.$chamado['prioridade'].'</th>';
                echo '<th>'.$chamado['descricao'].'</th>';
                echo '<th>'.$chamado['status'].'</th>';
                echo '<th>'.$chamado['tecnico'].'</th>';
                echo '<td><a href= "visualiza_chamado.php?id=' . $chamado['id_chamado'] . '">Visualizar</a></td>';

                echo '</tr>';
            }

        }else{
            echo "<h3 style='text-align: center;'>VOCÊ NÃO POSSUI CHAMADOS ABERTOS</h3> <br><br>";
        }
    }else{
        session_destroy();
        header("Location: login.php");
    }
    echo "<meta HTTP-EQUIV='refresh' CONTENT='10;URL=historico_chamado.php'>";

    ?>

</table>