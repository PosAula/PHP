<?php
session_start();
include_once 'conexao.php';

$acao = $_GET['acao'];
$id = filter_input(INPUT_GET, 'id_grupo', FILTER_SANITIZE_NUMBER_INT);
/*$id = $_GET['id_grupo'];
echo $acao;
echo $id;*/
switch ($acao) {
    case 'sair':
        $sql_sair_grupo = "DELETE FROM `usuario_grupo` WHERE `usuario_grupo`.`id_usuario_grupo` = '$id'";
        $query_sair_grupo = $conn->query($sql_sair_grupo);
        
        if ($query_sair_grupo->rowCount() > 0) {
            header('Location: grupos.php');
            //echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/Projetos_novos/pos_aula/grupos.php'>";
        }
        break;
    case 'entrar':
        
        $id_usuario = $_SESSION['id_usuario'];
        $sql_entar_grupo = "insert into usuario_grupo (id_grupo , id_usuario) values ('$id' , '$id_usuario')";
        $query_entar_grupo = $conn->query($sql_entar_grupo);

        if ($query_entar_grupo->rowCount() > 0) {
            header('Location: grupos.php');
            //echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/Projetos_novos/pos_aula/grupos.php'>";
        }

        break;

    default:
        break;
}