<?php 
include('../conexao.php');
	//adiciona a conexao	
	
 $busca = mysqli_real_escape_string($conexao,$_POST['busca']);
 $cont = intval(mysqli_real_escape_string($conexao,$_POST['cont']));



$query = "SELECT Nome_chave, nick_link, Banner_chave FROM chave WHERE Nome_chave LIKE '%".$busca."%' AND publico=1 ORDER BY DataCriacao_chave LIMIT ".$cont.",1";
	
//a consulta
$result = mysqli_query($conexao, $query);
 $result=mysqli_fetch_array($result);
if ($result) {
	echo  $result[0]."[+]".$result[1]."[+]".$result[2];
}else{echo "[+][+]";}
 

	?>