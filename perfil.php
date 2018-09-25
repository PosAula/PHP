<?php
session_start();
include_once 'header.html';
include_once 'menu.html';
include_once 'conexao.php';
?>
<center>
    <div id='info'>
        <img src='<?php echo $_SESSION['url_imagem']; ?>'><br>
        <form method="post" action="" enctype="multipart/form-data">
            <input type="file" name="arquivo"><br>
            <input type="submit" value="Enviar" name="btn-upload">
        </form>
        <span>Nome: <?php echo $_SESSION['nome']; ?></span><br>
        <span>Email: <?php echo $_SESSION['email']; ?></span><br>
        <span>Cidade: Barueri</span>
    </div>
</center>
<?php
if (isset($_POST['btn-upload'])) {
    $formatos = array("jpg", "jpeg", "png");
    $extensao = pathinfo($_FILES['arquivo']['name'], PATHINFO_EXTENSION);

    if (in_array($extensao, $formatos)) {
        $pasta = 'img/';
        $temporario = $_FILES['arquivo']['tmp_name'];
        $novo_nome = uniqid() . ".$extensao";
        if (move_uploaded_file($temporario, $pasta . $novo_nome)) {
            $id_usuario = $_SESSION['id_usuario'];
            $nome_sql = $pasta . $novo_nome;
            $sql_img = "UPDATE usuarios SET url_imagem = '$nome_sql' WHERE id_usuario = '$id_usuario'";
            $query_img = $conn->query($sql_img);

            if ($query_img->rowCount() > 0) {
                $_SESSION['url_imagem'] = $nome_sql;

                $sql_all1 = "UPDATE usuarios SET url_imagem = '$nome_sql' WHERE id_usuario = '$id_usuario'";
                $sql_all = "UPDATE usuarios SET url_imagem = '$nome_sql' WHERE id_usuario = '$id_usuario';
                UPDATE comentarios SET url_imagem = '$nome_sql' WHERE id_usuario = '$id_usuario';
                UPDATE respostas SET url_imagem = '$nome_sql' WHERE id_usuario = '$id_usuario';";
                $query_all = $conn->query($sql_all);

                echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/Projetos_novos/pos_aula/perfil.php'>";
            }
        } else {
            echo 'Falha no upload';
        }
    } else {
        echo 'Extensão inválida';
    }
}
?>