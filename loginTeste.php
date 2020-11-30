<?php
include('conexao.php');

	if(empty($_POST['usuario']) || empty($_POST['senha'])){
header('Location: login.php');
	exit();
	} if (!isset($_SESSION)) {//Verificar se a sessão não já está aberta.
  session_start();
}else if ($_SESSION['login']) {
		 header('Location : torneiosList.php');
	}
$usuario = mysqli_real_escape_string($conexao, $_POST['usuario']);
$senha = mysqli_real_escape_string($conexao, md5($_POST['senha']));

//$query = "select Id_login from login where Usuario_login = ".$usuario." and Senha_login = ".$senha;
$query = "select Id_usuario from usuario Where Nick_usuario = '{$usuario}' and Senha_usuario = '{$senha}'";

$result = mysqli_query($conexao, $query);
$escrever=mysqli_fetch_array($result);
 if ($escrever[0]) {
 	echo "Login efetuado";
 	
 	  $_SESSION['login']=$escrever[0];
 	  header('Location: torneiosList.php');
 	  exit();
 		
 }else{
 	header('Location: login.php');

 	exit();
 }


