<?php
session_start();

include_once 'header.html';
include_once 'menu.html';
?>
<h1>Logado</h1>
<?php
if(!isset($_SESSION['id_usuario'])){
    echo 'Não autenticado';
}
include_once 'mecanismo_listar.php';
include_once 'footer.html';
?>