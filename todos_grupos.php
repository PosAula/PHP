<?php
session_start();
include_once 'header.html';
include_once 'menu.html';
?>
<h2>Todos os grupos</h2>

<?php
//Todos os grupos
include_once 'conexao.php';
//session_start();
//$sql2 = "SELECT nome_grupo FROM usuario_grupo INNER JOIN grupos ON usuario_grupo.id_grupo = grupos.id_grupo";
$sql_grupos = "SELECT * from grupos";
$query_grupos = $conn->query($sql_grupos);
$todos_grupos = $query_grupos->fetchAll(PDO::FETCH_ASSOC);

/*
$sql_dentro = "SELECT usuario_grupo.id_grupo FROM usuario_grupo INNER JOIN grupos ON usuario_grupo.id_grupo = grupos.id_grupo WHERE usuario_grupo.id_usuario = '15';";
$query_dentro = $conn->query($sql_dentro);
$grupos_dentro = $query_dentro->fetchAll(PDO::FETCH_ASSOC);

var_dump($todos_grupos);
echo'<hr>';
var_dump($grupos_dentro);
echo'<hr>';
//in_array($grupos_dentro[0]['id_grupo'], $todos_grupos[0]['id_grupo']);
var_dump(in_array($grupos_dentro[1], $todos_grupos));
$a=0;
$b=0;
while ($a < $query_grupos->rowCount()){
    while ($b < $query_dentro->rowCount()) {
        $valor = $grupos_dentro[$b];
        var_dump(in_array($valor, $todos_grupos));
    $b++;
    
    }
    //$valor = $grupos_dentro[$a]['id_grupo'];
    //echo $valor;
    //echo in_array($valor, $todos_grupos);
    $b=0;
    $a++;
}*/


$j = 0;
while ($j < $query_grupos->rowCount()) {
    $id_entrar_grupo = $todos_grupos[$j]['id_grupo'];
    
    echo $todos_grupos[$j]['nome_grupo'] . ' ' . "<a href = 'acao_grupo.php?acao=entrar&id_grupo=$id_entrar_grupo'>Entrar</a>" . '<br>';
    $j++;
}?>
