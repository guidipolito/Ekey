<?php 

include('../conexao.php');
	//adiciona a conexao	
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json'); //deifine que vai sair um arquivo json
header('Access-Control-Allow-Methods: POST, GET, PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');
//esses tantos de header são pro app poder pegar os arquivos sem retornar permission denied
$email=""; $discord=""; $telefone=""; $nick=""; $mensagem=""; $nomeequipe="";
if (isset($_GET['email'])) {
$email = mysqli_real_escape_string($conexao,$_GET['email']);	
}
if (isset($_GET['discord'])) {
 	$discord = mysqli_real_escape_string($conexao,$_GET['discord']);
 } 
if (isset($_GET['telefone'])) {
 	 $telefone = mysqli_real_escape_string($conexao,$_GET['telefone']);
 } 
if (isset($_GET['nick'])) {
 	$nick = mysqli_real_escape_string($conexao,$_GET['nick']);
 } 
if (isset($_GET['msg'])) {
 	$mensagem = mysqli_real_escape_string($conexao,$_GET['msg']);
 } 
if (isset($_GET['nomequipe'])) {
	$nomeequipe = mysqli_real_escape_string($conexao,$_GET['nomequipe']);
 
}
 

 
 
 

//pegando os dados da chave
$query = "SELECT Id_chave FROM chave WHERE nick_link='".$nick."' and publico=1";
	
//a consulta

$query = mysqli_query($conexao, $query);
 $result = mysqli_fetch_array($query);
 $idc = $result[0]; // id da chave pra puxar times e posições
 //inserindo os dados
$query = "Insert into solicitacao (Email_solicitacao, Mensagem_solicitacao, Numero_solicitacao, Discord_solicitacao, Nome_equipe, Id_chave) Values('{$email}', '{$mensagem}', '{$telefone}', '{$discord}', '{$nomeequipe}', {$idc})";

//tentando confirmar resultado de inserção para dar resposta
$query = mysqli_query($conexao, $query);
if ($query) {
	$resposta = ['resposta' => 'certo'];
	
}else{

$resposta = ['resposta' =>'errado']; 
}
 $cod = json_encode($resposta, JSON_PRETTY_PRINT); // da um print, o formato da saida ja está em json
 
echo $cod;	?>
