<?php
session_start();

require 'conexao.php';

    if(isset($_SESSION['id']) &&  !empty($_SESSION['id'])) {
        if (isset($_POST['descricao']) && !empty($_POST['descricao'])) {
            if (isset($_POST['setor']) > 0 && !empty($_POST['setor'])) {
                $assunto = addslashes($_POST['assunto']);
                $prioridade = addslashes($_POST['prioridade']);
                $setor = addslashes($_POST['setor']);
                $descricao = addslashes($_POST['descricao']);
                $solicitante = $_SESSION['id'];
                $status = 1;

               $teste = $pdo->query("INSERT INTO chamado (assunto, setor, prioridade_id, descricao, solicitante, status_id) VALUES ('$assunto', '$setor', '$prioridade', '$descricao', '$solicitante', ' $status')");
                echo "Chamado realizado com sucesso <br><br>";
            }else{
                echo "Informe um setor<br><br>";
            }
        }
    }else{
        session_destroy();
        header("Location: login.php");
    }
?>
<a href="index.php">Voltar</a>
<form method="POST">
    <br>
    Assunto:<br>
    <input type="text" name="assunto"><br><br>
    Prioridade:<br>
    <select name="prioridade">
        <option> </option>
        <option value="1">Baixa</option>
        <option value="2">Média</option>
        <option value="3">Alta</option>
        <option value="4">Urgente</option>
    </select><br><br>
    Direcionar a:<br>
    <select name="setor">
        <option value="0"> </option>
        <option value="1">Ambiental</option>
        <option value="2">Comercial</option>
        <option value="3">Compras</option>
        <option value="4">Contabilidade</option>
        <option value="5">Diretoria</option>
        <option value="6">Estoque</option>
        <option value="7">Financeiro</option>
        <option value="8">Fiscal</option>
        <option value="9">RH</option>
        <option value="10">T.I</option>
    </select><br><br>
    Descrição:<br>
    <textarea name="descricao" style="width: 300px; height: 150px;" maxlength="500" ></textarea><br><br>
    <input type="submit" value="Enviar">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</form>
