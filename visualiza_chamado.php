<?php
session_start();

require 'conexao.php';

if(isset($_SESSION['id']) && !empty($_SESSION['id'])){

}else{
    session_destroy();
    header("Location: login.php");
}
?>
<form>
    <div>
        <div>
            <div>
                Sequêncial:
                <input type="text" name="sequencial" disabled="disabled" value="">
            </div>
            <div>
                Solicitante:
                <input type="text" name="solicitante" disabled="disabled" value="">
            </div>
            <div>
                Setor:
                <input type="text" name="setor" disabled="disabled" value="">
            </div>
        </div>
    </div>

</form>
