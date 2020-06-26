<?php
require 'conexao.php';

session_start();

?>


<table border="0" width="100%">
    <tr>
        <th>Seqêncial</th>
        <th>Solicitante</th>
        <th>Setor</th>
        <th>Prioridade</th>
        <th>Descrição</th>
        <th>Status</th>
        <th>Resposável</th>


    </tr>
    <?php
    $sql = $pdo->query("SELECT chamado.id_chamado, usuario.nome as solicitante, chamado.setor, chamado.prioridade, chamado.descricao, chamado.status, (SELECT usuario.nome FROM usuario WHERE usuario.id_usuario = chamado.responsavel) as responsavel FROM chamado INNER JOIN usuario ON id_usuario = solicitante WHERE solicitante='$_SESSION[id]'");

    if($sql->rowCount() > 0){
        foreach($sql->fetchAll() as $chamado){
            echo '<tr>';
            echo '<th>'.$chamado['id_chamado'].'</th>';
            echo '<th>'.$chamado['solicitante'].'</th>';
            echo '<th>'.$chamado['setor'].'</th>';
            echo '<th>'.$chamado['prioridade'].'</th>';
            echo '<th>'.$chamado['descricao'].'</th>';
            echo '<th>'.$chamado['status'].'</th>';
            echo '<th>'.$chamado['responsavel'].'</th>';
            echo '<th> </th>';

            echo '</tr>';
        }

    }
    ?>

</table>