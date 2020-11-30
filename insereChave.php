<?php
include('conexao.php');
	//adiciona a conexao

//aqui vai verificar se ta tudo preenchido, mesmo com required pode ter espertinhos né
	if(empty($_POST['nomeChave']) || empty($_POST['nickLink'])|| empty($_POST['sobre'])|| empty($_POST['nTimes'])){
		echo "algo vazio";
		echo $_POST['nomeChave'];
		echo $_POST['nickLink'];
		echo $_POST['sobre'];
		echo $_POST['nTimes'];
		
	exit();
	}else{

	session_start();

$IDlogin = $_SESSION['login'];
	//esse mysqli_real_escape_string é pra evitar inject sql e o md5 pra criptografar senhas
$nome = mysqli_real_escape_string($conexao, $_POST['nomeChave']);
$sobre = mysqli_real_escape_string($conexao, $_POST['sobre']);
$nTime = mysqli_real_escape_string($conexao, $_POST['nTimes']);
$nick = mysqli_real_escape_string($conexao, $_POST['nickLink']);

//oque vai ser consutado
$query = "select nick_link from chave where nick_link = '{$nick}'";

//a consulta
$result = mysqli_query($conexao, $query);
 $result=mysqli_fetch_array($result);
 //se der resultado ja tem registro ai volta (pra saber se existe o nick)
 if ($result['nick_link']) {
 		$_SESSION['erro']="Nick de chave ja existe";
 		header('Location: torneiosList.php');
 		exit();

 }else{

 	//mesma coisa de antes mas pra saber se tem o email ja(da pra colocar os 2 juntos mas n ia saber onde tem erro)
 	$query = "Insert into chave (Nome_chave, Sobre_chave, NumeroTimes_chave, nick_Link) Values('{$nome}', '{$sobre}', '{$nTime}', '{$nick}')";

$result = mysqli_query($conexao, $query);

$query = "select Id_chave from chave where nick_link = '{$nick}'";
$result = mysqli_query($conexao, $query);

 $result=mysqli_fetch_array($result);

$query = "Insert into  permissao(Id_usuario, Id_chave, Nivel_permissao) Values('{$IDlogin}', '{$result[0]}', 1)";
 		
$result = mysqli_query($conexao, $query);
header('Location: torneiosList.php');
exit();
	 }
 	
 }
 exit();

