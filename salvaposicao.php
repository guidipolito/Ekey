<?php
include('conexao.php');
	//adiciona a conexao

//aqui vai verificar se ta tudo preenchido, mesmo com required pode ter espertinhos né
	
	session_start();

$IDlogin = $_SESSION['login'];
	//esse mysqli_real_escape_string é pra evitar inject sql e o md5 pra criptografar senhas

$idc =mysqli_real_escape_string($conexao, $_GET['idc']); // id da chave
$n= mysqli_real_escape_string($conexao, $_GET['n']);
//oque vai ser consutado
$query = "select Nivel_permissao from permissao where Id_usuario = '{$IDlogin}' and Id_chave = '{$idc}'";

//a consulta
$result = mysqli_query($conexao, $query);
 $result=mysqli_fetch_array($result);
 //se der resultado ja tem registro ai volta (pra saber se existe o nick)
 if ($result[0]==1) {

$query = "DELETE FROM posicao WHERE id_chave = '{$idc}'";
 	$result = mysqli_query($conexao, $query);

 	for ($i=0; $i < $n ; $i++) { 
 		$erro= 0;
 		try {
 			if (isset($_GET['p'.$i])) {
 				$p=mysqli_real_escape_string($conexao, $_GET['p'.$i]);
 			$v=mysqli_real_escape_string($conexao, $_GET['v'.$i]);
 			}else{$erro=1;}
 			
 		} catch (Exception $e) {
 			$erro=1;
 		}

 		if ($erro==0) {
 			$query = "Insert Into posicao (id, valor, id_chave) Values('{$p}', '{$v}', '{$idc}')";
 	$result = mysqli_query($conexao, $query);
 		
 		}
 	
 	}
 	
 	header('Location: chaveMaker.php?idc='.$idc);
exit();
 }else{ 
header('Location: chaveMaker.php?idc='.$idc);

exit();
   }
