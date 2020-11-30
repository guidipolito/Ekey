<?php 

include('../conexao.php');
	//adiciona a conexao	
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json'); //deifine que vai sair um arquivo json
header('Access-Control-Allow-Methods: POST, GET, PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');
//esses tantos de header são pro app poder pegar os arquivos sem retornar permission denied
 $nick = mysqli_real_escape_string($conexao,$_GET['nick']);

//pegando os dados da chave
$query = "SELECT Id_chave, Nome_chave, Banner_chave, NumeroTimes_chave, Sobre_chave FROM chave WHERE nick_link='".$nick."' and publico=1";
	
//a consulta

$query = mysqli_query($conexao, $query);
 
 $arrayGeral = []; //onde vai ser colocado tudo
 $result = mysqli_fetch_array($query);
 $idc = $result[0]; // id da chave pra puxar times e posições
 $arrayGeral = array('nome' =>$result[1] , 'ntimes' => $result[3], 'image' => $result[2], 'desc'=> $result[4], 'times' => null, 'posicao'=> null);
 //array_push($arrayGeral, $array1);
 
//query das equipes
$query = "select Nome_equipe, ImagemLink_equipe, Desc_equipe, Id_equipe from equipe where Id_chave={$idc}";

$query = mysqli_query($conexao, $query);
$array2 = []; //aqui vai juntar mais muitos array de equipe, cada posição deste array vai ser dados de uma equipe
$cont=0;
$array1 =[]; //pra limpar o array e não mostrar novamente a informação anterior caso não tenha equipe
 while($result = mysqli_fetch_row($query)){
$array1 = array ('nomeequipe' => $result[0], 'imageequipe' => $result[1], 'valor' => $cont); //pega dados da equipe
$cont++;
array_push($array2, $array1); //junta dados da equipe
 }

$arrayGeral['times'] = $array2;
//array_push($arrayGeral, $array2); //dados das equipes na segunda posição do array geral

//query das posições
$query= "select id, valor from posicao where id_chave={$idc}";
$query = mysqli_query($conexao, $query);
$array1 =[]; //pra limpar o array e não mostrar novamente a informação anterior caso não tenha posição
$array2 = []; //assim como antes vai jutar posições num array dentro do array, ela vai ficar na 3° (essa[2]) posição do array geral
 while($result = mysqli_fetch_row($query)){
$array1 = array ('id' => $result[0], 'valor' => $result[1]); //pega dados da equipe
array_push($array2, $array1); //junta dados da equipe
 }

$arrayGeral['posicao'] = $array2;
//array_push($arrayGeral, $array1); //junta dados da posição no array geral


 $cod = json_encode($arrayGeral, JSON_PRETTY_PRINT); // da um print, o formato da saida ja está em json
 
echo $cod;	?>
