<?php
session_start();
include_once 'header.html';
include_once 'menu.html';
include_once 'conexao.php';

//$cod = $_GET['id_comentar'];

$cod = filter_input(INPUT_GET, 'id_comentar', FILTER_SANITIZE_NUMBER_INT);

$sql_comentar = "select * from grupos where id_grupo='$cod'";
$query_comentar = $conn->query($sql_comentar);
$grupo_comentar = $query_comentar->fetchAll(PDO::FETCH_ASSOC);


/* switch ($cod) {
  case '1':
  header('Location: comentar_matematica.php');

  break;
  case '2':
  header('Location: comentar_portugues.php');

  break;
  case '3':
  header('Location: comentar_biologia.php');

  break;

  default:
  break;
  } */
?>
<form method='post' action=''>
    Faça seu comentário sobre <?php echo $grupo_comentar[0]['nome_grupo']; ?>:<br><textarea name="comentario" required></textarea>
    <input type="hidden" name="cod_materia" value="<?php echo $cod; ?>"><br>
    <input type='submit' value='Comentar' name="btn-comentar">
</form>

<?php
//echo $cod;
if (isset($_POST['btn-comentar'])) {

    $nome = $_SESSION['nome'];
    $url_imagem = $_SESSION['url_imagem'];
    $data = 'NOW()';
    $comentario = filter_input(INPUT_POST, 'comentario', FILTER_SANITIZE_SPECIAL_CHARS);
//$comentario = $_GET['comentario'];
    $id_grupo = $cod;
    $id_usuario = $_SESSION['id_usuario'];

    $sql = "insert into comentarios (nome_usuario , url_imagem , data , comentario , id_grupo, id_usuario) values ('$nome' , '$url_imagem' , $data , '$comentario' , '$id_grupo' , '$id_usuario')";
    $query = $conn->query($sql);

    if ($query->rowCount() > 0) {
        header('Location: index.php');
        //echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/Projetos_novos/pos_aula/index.php'>";
    }
}


include_once 'footer.html';
?>

