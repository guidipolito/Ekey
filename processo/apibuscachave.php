<?php 

include('../conexao.php');
	//adiciona a conexao	
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST, GET, PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');
 $busca = mysqli_real_escape_string($conexao,$_GET['busca']);



$query = "SELECT Nome_chave, nick_link, Banner_chave, NumeroTimes_chave FROM chave WHERE Nome_chave LIKE '%".$busca."%' AND publico=1 ORDER BY DataCriacao_chave";
	
//a consulta

$result2 = mysqli_query($conexao, $query);
 
 $array2 = [];
 while($result = mysqli_fetch_row($result2)){
 $array1 = array('nome' =>$result[0] , 'nick' => $result[1], 'image' => $result[2], 'times' => $result[3] );
 array_push($array2, $array1);
 }
 $cod = json_encode($array2, JSON_PRETTY_PRINT);
 
echo $cod;	?>