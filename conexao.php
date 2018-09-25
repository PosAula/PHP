<?php
$host = 'localhost';
$dbname = 'posaula';
$user = 'root';
$password = '';
//Faz a conexão com o banco de dados
$conn = new PDO ("mysql:host=$host; dbname=$dbname; charset=utf8",$user,$password);


//Consulta Padrão
/*
$sql = "select * from user";
$query = $conn->query($sql);
$return = $query->fetchAll(PDO::FETCH_ASSOC);

echo $return[0]['url_imagem'];
$query->rowCount();
$sql2 = "SELECT nome_grupo FROM usuario_grupo INNER JOIN grupos ON usuario_grupo.id_grupo = grupos.id_grupo";
 */