<?php
include_once 'header.html';
?>
<form method="post" action="">
    Login:<input type="text" name="login"><br>
    Senha:<input type="password" name="senha"><br>
    <input type="submit" value="Entrar" name="btn-logar">
</form>
<a href="cadastro.php">Cadastre-se</a>
<a href="recuperar_senha.php">Recuperar senha</a>

<?php
include_once 'conexao.php';
if(isset($_POST['btn-logar'])){

$login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_SPECIAL_CHARS);
$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);

//valida o usuario
$sql_login = "select * from usuarios where login = '$login' && senha = '$senha' limit 1";
$query_login = $conn->query($sql_login);
//$usuario = $query_login->fetchAll(PDO::FETCH_ASSOC);

if($query_login->rowCount() > 0){
    //Cria um sessao e armazena os dados do usuario
    session_start();
    $usuario = $query_login->fetchAll(PDO::FETCH_ASSOC);
    $_SESSION['nome'] = $usuario[0]['nome'];
    $_SESSION['url_imagem'] = $usuario[0]['url_imagem'];
    $_SESSION['id_usuario'] = $usuario[0]['id_usuario'];
    $_SESSION['email'] = $usuario[0]['email'];
    
    header('Location: index.php');
}else{
    header('Location: login.php');
}

}

include_once 'footer.html';
?>

