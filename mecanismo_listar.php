<?php

include_once 'conexao.php';
$id_usuario = $_SESSION['id_usuario'];

$sql_dentro = "SELECT usuario_grupo.id_grupo , nome_grupo FROM usuario_grupo INNER JOIN grupos ON usuario_grupo.id_grupo = grupos.id_grupo WHERE usuario_grupo.id_usuario = '$id_usuario'";
$query_dentro = $conn->query($sql_dentro);
$grupos_dentro = $query_dentro->fetchAll(PDO::FETCH_ASSOC);

$a = 0;
if ($query_dentro->rowCount() > 0) {
    while ($a < $query_dentro->rowCount()) {
        $id_dentro = $grupos_dentro[$a]['id_grupo'];
        $nome_grupo = $grupos_dentro[$a]['nome_grupo'];
        
        echo "<h1>Comentarios sobre $nome_grupo</h1>";
        
        echo '<div>';
        $sql = "select * from comentarios where id_grupo = $id_dentro order by id_comentario desc";
        $query = $conn->query($sql);
        $comentarios = $query->fetchAll(PDO::FETCH_ASSOC);
        $i = 0;

        while ($i < $query->rowCount()) {

            // echo "<h2>Comentario</h2> <br>";
            $imagem_c = $comentarios[$i]['url_imagem'];
            echo "<img src='$imagem_c' alt='' id='perfil'/>";
            echo $comentarios[$i]['nome_usuario'] . ' comentou:';
            //echo'<br>';
            //echo $comentarios[$i]['url_imagem'];
            echo'<br><br>';
            echo $comentarios[$i]['comentario'];
            echo'<br><br>';
            echo "Na data: " . $comentarios[$i]['data'];

            $id = $comentarios[$i]['id_comentario'];
            echo'<br>';
            //Começou as respostas

            $sql_resposta = "select * from respostas where id_comentario = '$id' order by id_resposta asc";
            $query_resposta = $conn->query($sql_resposta);
            $respostas = $query_resposta->fetchAll(PDO::FETCH_ASSOC);
            $j = 0;
            while ($j < $query_resposta->rowCount()) {
                $imagem_r = $respostas[$j]['url_imagem'];
                echo "<div id='respostas'>";
                echo "<h3>Respostas</h3>";
                echo "<img src='$imagem_r' alt='' id='perfil'/>";
                echo $respostas[$j]['nome_usuario'] . ' respondeu o comentário de ' . $comentarios[$i]['nome_usuario'] . ' com: ';
                //echo'<br>';
                // echo $respostas[$j]['url_imagem'];
                echo'<br>';
                echo $respostas[$j]['resposta'];
                echo'<br><br>';
                echo 'Na data: ' . $respostas[$j]['data'];

                echo'<br>';
                echo '<br>';
                $j++;
                echo '</div>';
            }



            //Acabou as respostas
            echo "<form method='post' action='responder.php'>
            Resposta: <input type='text' name='resposta' required>
            <input type='hidden' name='valor'";
            echo " value='$id'>
            <input type='submit' value='Responder'>
        </form>";
            echo '<hr><br>';
            $i++;
        }
        echo '</div>';

        //------------------
        $a++;
    }
}


?>