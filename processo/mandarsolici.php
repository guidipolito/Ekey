<?php
include '../conexao.php';
$email=""; $diretorio=""; $telefone=""; $discord=""; $nomeequipe=""; $mensagem=""; $idc=intval($_GET['idc']);
try{
	$img = $_FILES['imagesoli']; //pega o arquivo
	if ($img!==null) {
		preg_match("/.(png|jpg|jpeg){1}$/i", $img["name"], $sufixo); //pega o tipo do arquivo apos o ponto 
		if ($sufixo == true) {//se conseguiu pegar faz (aparentemente o sufixo fica na posi [1])
			$novonome = md5(uniqid(time())).".".$sufixo[1];//defini como nome a data do momento criptogramada pra n ter nomes iguais
			$diretorio = "../uploadedimg/".$novonome;//local pra onde vai
			//move

		}
	}
	//aqui ele só vai pegar, se n tiver oq pegar n dará erro por estar no try
	$email = mysqli_real_escape_string($conexao, $_POST['email']);
	$telefone = mysqli_real_escape_string($conexao, $_POST['telefone']);
	$discord = mysqli_real_escape_string($conexao, $_POST['discord']);
	$nomeequipe = mysqli_real_escape_string($conexao, $_POST['nomequipe']);
	$mensagem = mysqli_real_escape_string($conexao, $_POST['mensagem']);
}catch(Execptions $e){}


//oque vai inserido
$query = "Insert into solicitacao (Email_solicitacao, Mensagem_solicitacao, Numero_solicitacao, Discord_solicitacao, ImagemLink_solicitacao, Nome_equipe, Id_chave) Values('{$email}', '{$mensagem}', '{$telefone}', '{$discord}', '{$diretorio}', '{$nomeequipe}', {$idc})";

//inserção
$result = mysqli_query($conexao, $query);
if($result){
	echo "<script>alert('solicitação realizada com sucesso')</script>";
	if ($sufixo) {//se conseguiu adicionar os dados ao banco e o sufixo for valido ele move o arquivo
	move_uploaded_file($img["tmp_name"], $diretorio);	
	}
	
}else{
	echo "<script>alert('Não foi possivel realizar solicitação')</script>";
}

header('Location: ../'.$_GET['link']);