<?php
session_start();
include_once 'header.html';
include_once 'menu.html';
include_once 'conexao.php';

$id_usuario = $_SESSION['id_usuario'];

$sql_grupo = "SELECT nome_grupo, id_usuario_grupo FROM usuario_grupo INNER JOIN grupos ON usuario_grupo.id_grupo = grupos.id_grupo WHERE usuario_grupo.id_usuario = '$id_usuario'";
$query_grupo = $conn->query($sql_grupo);
$grupo = $query_grupo->fetchAll(PDO::FETCH_ASSOC);


$sql_comentar = "SELECT * from usuario_grupo where id_usuario = '$id_usuario'";
$query_comentar = $conn->query($sql_comentar);
$comentar = $query_comentar->fetchAll(PDO::FETCH_ASSOC);

$i = 0;

echo "<h2>Meus grupos</h2>";
while ($i < $query_grupo->rowCount()) {
    $id_sair_grupo = $grupo[$i]['id_usuario_grupo'];
    $id_comentar = $comentar[$i]['id_grupo'];
?>

<?php echo $grupo[$i]['nome_grupo']; ?>

 <a href="comentar_grupos.php?id_comentar=<?php echo $id_comentar; ?>">Comentar</a>
 
 <a href="acao_grupo.php?acao=sair&id_grupo=<?php echo $id_sair_grupo;?>">Sair</a><br>
</form>
<?php
//echo $grupo[$i]['nome_grupo'].'  '."<a href = 'comentar_grupos.php?id_comentar=$id_comentar'>Comentar</a>" . '  ' . "<a href = 'sair_grupo.php?id_grupo=$id_sair_grupo'>Sair</a>" . '<br>';
    $i++;
}
//Todos os grupos
