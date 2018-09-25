<?php
include_once 'conexao.php';
session_start();/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//$id_comentario = $_POST['valor'];
//$resposta = $_GET['resposta'];
//echo $valor;

$id_comentario = filter_input(INPUT_POST, 'valor', FILTER_SANITIZE_NUMBER_INT);
$nome = $_SESSION['nome'];
$url_imagem = $_SESSION['url_imagem'];
$data = 'NOW()';
$resposta = filter_input(INPUT_POST, 'resposta', FILTER_SANITIZE_SPECIAL_CHARS);
//$comentario = $_GET['resposta'];
$id_usuario = $_SESSION['id_usuario'];

$sql = "insert into respostas (nome_usuario , url_imagem , data , resposta , id_comentario , id_usuario) values ('$nome' , '$url_imagem' , $data , '$resposta' , '$id_comentario' , '$id_usuario')";
$query = $conn->query($sql);

if($query->rowCount() > 0){
    header('Location: index.php');
    //echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/Projetos_novos/pos_aula/index.php'>";
}
//$query = $conn->query($sql);
//$return = $query->fetchAll(PDO::FETCH_ASSOC);

//echo $return[0]['url_imagem'];