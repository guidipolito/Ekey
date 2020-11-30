<?php
include('conexao.php');
	//adiciona a conexao

//aqui vai verificar se ta tudo preenchido, mesmo com required pode ter espertinhos né
	if(empty($_POST['cname']) || empty($_POST['cemail'])|| empty($_POST['cuser'])|| empty($_POST['csenha']) || empty($_POST['confirmSenha'])){
		echo "algo vazio";
	exit();
	}



	//esse mysqli_real_escape_string é pra evitar inject sql e o md5 pra criptografar senhas
$nome = mysqli_real_escape_string($conexao, $_POST['cname']);
$senha = mysqli_real_escape_string($conexao, md5($_POST['csenha']));
$csenha = mysqli_real_escape_string($conexao, md5($_POST['confirmSenha']));
$nick = mysqli_real_escape_string($conexao, $_POST['cuser']);
$email = mysqli_real_escape_string($conexao, $_POST['cemail']);


//oque vai ser consutado
$query = "select Id_usuario from usuario where Nick_usuario = '{$nick}'";

//a consulta
$result = mysqli_query($conexao, $query) ;
 $result=mysqli_fetch_array($result);
 //se der resultado ja tem registro ai volta (pra saber se existe o nick)
 if (isset($result['Id_usuario'])) {
 		echo "achou resultado";
 		exit();

 }else{

 	//mesma coisa de antes mas pra saber se tem o email ja(da pra colocar os 2 juntos mas n ia saber onde tem erro)
 	$query = "select Id_usuario from usuario where Email_usuario = '{$email}'";

$result = mysqli_query($conexao, $query) or die( mysqli_error($conexao));;
 $result=mysqli_fetch_array($result);
 		if (isset($result['Id_usuario'])) {
 			echo "achou resultado email";
 			exit();

	 }else{


	 	//ve se o cara digito as senhas certo pq n fiz sistema de recuperar senha e nem sei
	 	if ($senha==$csenha) {

	 		//aqui tenta inserir e pega um true ou false dependedo se deu certo
	 		$query = "Insert Into usuario(Nome_usuario, Senha_usuario, Nick_usuario, Email_usuario) Values('{$nome}', '{$senha}', '{$nick}' , '{$email}')";
	 		$tentaInserir = mysqli_query($conexao, $query);
if ( $tentaInserir === false ){
	echo "Erro na insersão";
} else{echo "insersão bem sucedida"; header('Location: login.php');}
	 		
	 	}else{

	 		echo "Senhas diferentes";
	 	}



	 }
 	
 }


 exit();