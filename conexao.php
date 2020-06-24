<?php

$dsn = "mysql:dbname=db_helpdesk;host=localhost";
$dbuser = "victeera";
$dbpass = "victinhow0393";

try{
    $pdo = new PDO($dsn, $dbuser, $dbpass);
}catch (PDOException $e){
    echo "Conexão falhou: ".$e->getMessage();
}
?>