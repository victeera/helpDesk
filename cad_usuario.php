<?php
require 'conexao.php';
if(isset($_POST['nome']) && empty($_POST['nome']) == false) {
if(isset($_POST['email']) && empty($_POST['email']) == false) {
    if (isset($_POST['senha']) && empty($_POST['senha']) == false) {
        $nome = addslashes($_POST['nome']);
        $email = addslashes($_POST['email']);
        $senha = md5(addslashes($_POST['senha']));
        $c_senha = md5(addslashes($_POST['c_senha']));

        $select = $pdo->query("SELECT * FROM usuario WHERE email = '$email' AND senha = '$senha'");

        if($select->rowCount() == false){
            if($senha == $c_senha) {
                $pdo->query("INSERT INTO usuario (nome, email, senha) VALUES ('$nome', '$email', '$senha') ");
                header("Location: login.php");
            }else{
                echo "As senhas são diferentes<br>";
            }
        }else{
            echo "Este endereço de e-mail ja possui cadastro<br>";
        }
    }
    else{
        echo "Dados incorretos<br>";
    }
}
}
?>
<a href="login.php">Voltar</a>
<form method="POST">
    <br>
    Nome:<br>
    <input type="text" name="nome"><br><br>
    E-mail:<br>
    <input type="text" name="email"><br><br>
    Senha:<br>
    <input type="password" name="senha"><br><br>
    Confirmação da senha:<br>
    <input type="password" name="c_senha"><br><br>
    Tipo de Usuário:<br>
    <select name="tipo_usuario">
        <option> </option>
        <option value="1">Administrador</option>
        <option value="2">Técnico</option>
        <option value="3">Padrão</option>
    </select><br><br>
    <input type="submit" value="Cadastrar">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</form>
