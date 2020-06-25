<?php
require 'conexao.php';
?>
<?php
session_start();

if(isset($_POST['email']) && empty($_POST['email']) == false){
        $email = addslashes($_POST['email']);
        $senha = md5(addslashes($_POST['senha']));
        $sql = $pdo->query("SELECT * FROM usuario WHERE email='$email' AND senha='$senha'");
    var_dump($sql);
        if($sql->rowCount() > 0){
            $dado = $sql->fetch();
            $_SESSION['id'] = $dado['id_usuario'];
            header("Location: index.php");
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

