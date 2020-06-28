<?php

session_start();

require 'conexao.php';

    if (isset($_POST['email']) && empty($_POST['email']) == false) {
        $email = addslashes($_POST['email']);
        $senha = md5(addslashes($_POST['senha']));
        $sql = $pdo->query("SELECT * FROM usuario WHERE email='$email' AND senha='$senha'");

        if ( $sql->rowCount() > 0) {
            $dado = $sql->fetch();
            $_SESSION['id'] = $dado['id_usuario'];
            $_SESSION['nome'] = $dado['nome'];
            $_SESSION['tipo_usuario'] = $dado['tipo_usuario'];
            $_SESSION['setor'] = $dado['setor_usuario'];

            header("Location: index.php");
        }else{
            echo "E-mail ou senha incorretos";
        }

    }


?>


<form method="POST" onsubmit="valida()">
    <br>
    E-mail:<br>
    <input type="text" name="email"><br><br>
    Senha:<br>
    <input type="password" name="senha"><br><br>
    <input type="submit" value="Entrar">&nbsp;&nbsp;&nbsp;<a href="cad_usuario.php">Cadastrar-se</a>

</form>