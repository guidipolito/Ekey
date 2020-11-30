<?php
include('../conexao.php');
	//adiciona a conexao

//aqui vai verificar se ta tudo preenchido, mesmo com required pode ter espertinhos né
	
	session_start();

$IDlogin = $_SESSION['login'];
	//esse mysqli_real_escape_string é pra evitar inject sql e o md5 pra criptografar senhas
$Idequipe = mysqli_real_escape_string($conexao, $_GET['idequipe']);

$nome = mysqli_real_escape_string($conexao, $_POST['nomeequipe']);
$imglink = mysqli_real_escape_string($conexao, $_POST['imagemlink']);
$sobre = mysqli_real_escape_string($conexao, $_POST['sobreequipe']);
$email = mysqli_real_escape_string($conexao, $_POST['emailequipe']);
$numero = mysqli_real_escape_string($conexao, $_POST['numero']);
$discord = mysqli_real_escape_string($conexao, $_POST['discord']);


 // id da chave
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
 if ($result[0]==1) {
 	$query = "UPDATE equipe SET Nome_equipe = '{$nome}', ImagemLink_equipe = '{$imglink}', Desc_equipe = '{$sobre}', Email_equipe = '{$email}', Numero_equipe = '{$numero}', Discord_equipe = '{$discord}' where Id_equipe = '{$Idequipe}'";
 	
 	$result = mysqli_query($conexao, $query);
 	header('Location: ../chaveMaker.php?idc='.$idc);

exit();
 }else{ 
header('Location: ../chaveMaker.php?idc='.$idc);
exit();
   }
