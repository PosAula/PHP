<?php
include_once 'header.html';
?>
<form method="post" action="">
    Nome: <input type="text" name="nome"><br>
    Login: <input type="text" name="login"><br>
    Senha: <input type="password" name="senha"><br>
    Sexo: <select name="sexo">
        <option value="m">Masculino</option>
        <option value="f">Feminino</option>
    </select><br>
    Email: <input type="email" name="email"><br>
    <input type="submit" value="Cadastrar" name="btn-cadastrar">
</form><a href="login.php">Fazer login</a>

<?php
include_once 'conexao.php';
if (isset($_POST['btn-cadastrar'])) {
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
    $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_SPECIAL_CHARS);
    $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);
    $sexo = filter_input(INPUT_POST, 'sexo', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
//var_dump($_POST);
    if ($sexo === 'm') {
        $url_imagem = 'img/user-m.png';
    } else {
        $url_imagem = 'img/user-f.png';
    }

    $sql_cad = "insert into usuarios (login , senha , nome , url_imagem, email) values ('$login' , '$senha' , '$nome' , '$url_imagem' , '$email')";
    $query_cad = $conn->query($sql_cad);

    if ($query_cad->rowCount() > 0) {
        echo "
<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/Projetos_novos/pos_aula/login.php'>
    <script type=\"text/javascript\">
        alert('Cadastrado com sucesso !');
    </script>
";
    }
}

include_once 'footer.html';
?>
