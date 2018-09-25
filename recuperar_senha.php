<?php
include_once 'header.html';
?>
<div>
    <h3>Digite seu email cadastrado no site</h3>
    <form action="" method="post">
        Email: <input type="email" name="email">
        <input type="submit" value="Enviar" name="btn-recuperar"><br>
        <a href="login.php">Fazer login</a>
    </form>
</div>
<?php
include_once 'conexao.php';
if (isset($_POST['btn-recuperar'])) {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

    $sql_rec = "select * from usuarios where email = '$email' limit 1";
    $query_rec = $conn->query($sql_rec);

    if ($query_rec->rowCount() > 0) {
        //se for verdadeiro
        $recuperar = $query_rec->fetchAll(PDO::FETCH_ASSOC);
        
        
        //resgata a senha
        $senha = $recuperar[0]['senha'];
        $destinatario = $email;
        
        
        //envia o email
        $assunto = 'Recuperar senha !';
        $corpo = "Sua senha é: $senha";



        if (mail("$destinatario", $assunto, $corpo, 'From: PosAula@mail.com')) {
            echo "<script>alert('Sua senha foi enviada para $destinatario');</script>";
            echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/Projetos_novos/pos_aula/login.php'>";
        } else {
            echo 'Erro ao enviar email';
        }
    } else {
        echo 'Esse email não está cadastrado';
    }
}



include_once 'footer.html';
?>