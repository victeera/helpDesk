<?php
require 'conexao.php';
?>
<?php
session_start();

if(isset($_POST['email']) && empty($_POST['email']) == false){
        $email = addslashes($_POST['email']);
        $senha = md5(addslashes($_POST['senha']));
        $sql = $pdo->query("SELECT * FROM usuario WHERE email='$email' AND senha='$senha'");
        if($sql->rowCount() > 0) {
            $dado = $sql->fetch();
            $_SESSION['id'] = $dado['id_usuario'];
            echo $dado['nome'];
            if ($dado['tipo_usuario'] == 1) {
                header("Location: painel.php");
            }
            if ($dado['tipo_usuario'] == 3){
                header("Location: index.php");
        }
        }
        else{
            echo "Usuario ou senha incorretos";
        }

}

?>

<form method="POST">
    <br>
    E-mail:<br>
    <input type="text" name="email"><br><br>
    Senha:<br>
    <input type="password" name="senha"><br><br>
    <input type="submit" value="Entrar">

</form>