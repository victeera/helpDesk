<?php
session_start();

require 'conexao.php';

if(isset($_SESSION['id']) && !empty($_SESSION['id'])) {
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $id = base64_decode($_GET['id']);
        $sql = $pdo->query("SELECT chamado.id_chamado, chamado.assunto, prioridade.nome as prioridade, setores.descricao as setor, chamado.descricao FROM chamado INNER JOIN prioridade ON id_prioridade = prioridade_id INNER JOIN setores ON id_setor = setor WHERE id_chamado='$id'");
        if($sql->rowCount()>0){
            $dado = $sql->fetch();

            echo '<div style="display: flex; justify-content: center;">
    <div style="margin-top: 20px; display: flex; justify-content: space-between; width: 100%; max-width: 860px;">
        <div><a href="index.php">Inicio</a> &nbsp;&nbsp;&nbsp;  <a href="novo_chamado.php">Novo Chamado</a> &nbsp;&nbsp;&nbsp;';

            $tipo_usuario = $_SESSION['tipo_usuario'];
            if ($tipo_usuario == 1 or $tipo_usuario == 2) {
                echo '<a href="painel_chamado.php">Atender Solicitações</a>';
            }

            echo '&nbsp;&nbsp;&nbsp;  <a href="historico_chamado.php">Histórico de Chamados</a>
        </div>
        <div><a href="logout.php">Sair</a></div>
    </div>
</div>
<br><br><br>
         <form method="POST" action="finalizar.php">
             <br>
             
              Sequêncial:<br>
             <input type="text" name="sequencial" value="'.$id.'" readonly><br><br>
                 Assunto:<br>
             <input type="text" name="assunto" disabled="disabled" value="'.$dado['assunto'].'"><br><br>
                 Prioridade:<br>
                <input type="text" name="prioridade" disabled="disabled" value="'.$dado['prioridade'].'"><br><br>
                 Direcionar a:<br>
                <input type="text" name="setor" disabled="disabled" value="'.$dado['setor'].'"><br><br>
                 Descrição:<br>
             <textarea name="descricao" style="width: 300px; height: 150px;" maxlength="500" disabled="disabled">'.$dado['descricao'].'</textarea><br><br>
             
             <textarea name="retorno" style="width: 300px; height: 150px;" maxlength="500"></textarea><br><br>
             <input type="submit" value="Enviar">
         </form>';

        }
    }
}else{
    session_destroy();
    header("Location: login.php");
}
?>