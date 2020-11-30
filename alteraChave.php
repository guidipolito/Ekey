<?php
include('conexao.php');
	//adiciona a conexao

//aqui vai verificar se ta tudo preenchido, mesmo com required pode ter espertinhos né
	
	session_start();

$IDlogin = $_SESSION['login'];
	//esse mysqli_real_escape_string é pra evitar inject sql e o md5 pra criptografar senhas
$nome = mysqli_real_escape_string($conexao, $_POST['nomeChave']);
$sobre = mysqli_real_escape_string($conexao, $_POST['sobre']);
$nTime = mysqli_real_escape_string($conexao, $_POST['nTimes']);
$logo = mysqli_real_escape_string($conexao, $_POST['logoLink']);
$banner = mysqli_real_escape_string($conexao, $_POST['bannerLink']);
$privacidade = mysqli_real_escape_string($conexao, $_POST['privacidade']);
$bgBlack = mysqli_real_escape_string($conexao, $_POST['bgBlack']);

$idc = $_GET['idc']; // id da chave

//oque vai ser consutado
$query = "select Nivel_permissao from permissao where Id_usuario = '{$IDlogin}' and Id_chave = '{$idc}'";

//a consulta
$result = mysqli_query($conexao, $query);
 $result=mysqli_fetch_array($result);
 //se der resultado ja tem registro ai volta (pra saber se existe o nick)
 if ($result[0]==1) {
 	$query = "UPDATE chave SET Nome_chave = '{$nome}', Sobre_chave = '{$sobre}', NumeroTimes_chave = '{$nTime}', Logo_chave = '{$logo}', Banner_chave = '{$banner}', publico = '{$privacidade}', bgBlack = '{$bgBlack}' where Id_chave = '{$idc}'";
 	$result = mysqli_query($conexao, $query);
 	header('Location: chaveMaker.php?idc='.$idc);
exit();
 }else{ 
header('Location: chaveMaker.php?idc='.$idc);
exit();
   }
