<?php
session_start();

require 'conexao.php';

if(isset($_SESSION['id']) && !empty($_SESSION['id'])) {
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $id = base64_decode($_GET['id']);

        $sql = $pdo->query("SELECT chamado.id_chamado, chamado.assunto, prioridade.nome as prioridade, setores.descricao as setor, chamado.descricao FROM chamado INNER JOIN prioridade ON id_prioridade = prioridade_id INNER JOIN setores ON id_setor = setor WHERE id_chamado='$id'");
        if($sql->rowCount()>0){
           $dado = $sql->fetch();

                echo '<a href="painel_chamado.php">Voltar</a>
         <form method="POST">
             <br>
                 Assunto:<br>
             <input type="text" name="assunto" disabled="disabled" value="'.$dado['assunto'].'"><br><br>
                 Prioridade:<br>
                <input type="text" name="prioridade" disabled="disabled" value="'.$dado['prioridade'].'"><br><br>
                 Direcionar a:<br>
                <input type="text" name="setor" disabled="disabled" value="'.$dado['setor'].'"><br><br>
                 Descrição:<br>
             <textarea name="descricao" style="width: 300px; height: 150px;" maxlength="500" disabled="disabled">
'.$dado['descricao'].'
             </textarea><br><br>
         </form> 
         
                    <a href="pegar.php?id='. base64_encode($dado['id_chamado']).'">Atender</a>';

         
        }
    }
}else{
    session_destroy();
    header("Location: login.php");
}
?>