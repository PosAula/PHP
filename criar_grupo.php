<?php
session_start();
include_once 'header.html';
include_once 'menu.html';
?>
<h3>Digite o nome do seu grupo</h3>
<form method="post" action="">
    <input type="text" name="nome_grupo" required><br>
    <h3>Descrição do grupo</h3>
    <textarea name="descricao_grupo" required></textarea><br>
    <input type="submit" value="Criar" name="btn-criar">
</form>
<?php
include_once 'conexao.php';
if (isset($_POST['btn-criar'])) {
    $nome_grupo = filter_input(INPUT_POST, 'nome_grupo', FILTER_SANITIZE_SPECIAL_CHARS);
    $descricao_grupo = filter_input(INPUT_POST, 'descricao_grupo', FILTER_SANITIZE_SPECIAL_CHARS);
    $id_usuario = $_SESSION['id_usuario'];

    $sql_criar = "insert into grupos (nome_grupo , desc_grupo , id_usuario) values ('$nome_grupo' , '$descricao_grupo' , '$id_usuario')";
    $query_criar = $conn->query($sql_criar);
    if($query_criar->rowCount() > 0){
        header('Location: todos_grupos.php');
    }
}
?>