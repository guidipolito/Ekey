<?php
include('../conexao.php');
	//adiciona a conexao


	
	session_start();

$IDlogin = $_SESSION['login'];
	//esse mysqli_real_escape_string é pra evitar inject sql e o md5 pra criptografar senhas
$Idequipe = mysqli_real_escape_string($conexao, $_GET['idequipe']);

//oque vai ser consutado
$query = "select Id_chave from equipe where Id_equipe = '{$Idequipe}'";

//a consulta
$result = mysqli_query($conexao, $query);
$result=mysqli_fetch_array($result);
$idc = $result[0];


//oque vai ser consutado
$query = "select Nivel_permissao from permissao where Id_usuario = '{$IDlogin}' and Id_chave = '{$idc}'";

//a consulta
$result = mysqli_query($conexao, $query);
 $result=mysqli_fetch_array($result);
 //se der resultado ja tem registro ai volta (pra saber se existe o nick)
 if ($result[0]==1) {
 	$query = "DELETE FROM equipe WHERE Id_equipe = '{$Idequipe}'";
 	$result = mysqli_query($conexao, $query);
 	header('Location: ../chaveMaker.php?idc='.$idc);
exit();
 }else{ 
header('Location: ../chaveMaker.php?idc='.$idc);
exit();
   }
