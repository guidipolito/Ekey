<?php
include('../conexao.php');
	//adiciona a conexao


	
	session_start();

$IDlogin = $_SESSION['login'];
	//esse mysqli_real_escape_string é pra evitar inject sql e o md5 pra criptografar senhas
$Idequipe = mysqli_real_escape_string($conexao, $_POST['idequipe']);

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
 	
 	$query = "select Nome_equipe, ImagemLink_equipe, Desc_equipe, Email_equipe, Numero_equipe, Discord_equipe from equipe where Id_equipe = '{$Idequipe}'";

//a consulta
$result = mysqli_query($conexao, $query);
 $result=mysqli_fetch_array($result);
 //se der resultado ja tem registro ai volta (pra saber se existe o nick)
 
 echo '<form action="processo/alteratime.php?idequipe='.$Idequipe.'" method="POST">
        <input type="text" name="nomeequipe"  placeholder="nome da equipe"  style="width: 100%" value="'.$result[0].'" />
        <br><br>
        <input type="text" name="imagemlink"  placeholder="link da imagem"  style="width: 100%" value="'.$result[1].'" />
        <br><br>
           <textarea class="form-control" rows="3" name="sobreequipe" placeholder="descrição ou alguma infromação sobre" style="background: transparent; color: white">
           '.$result[2].'
           	</textarea>
           	<br><br>
        <input type="email" name="emailequipe"  placeholder="email do responsavel pelo time"  style="width: 100%" value="'.$result[3].'" />
        <br><br>
        <input type="text" name="numero"  placeholder="numero do responsavel pelo time"  style="width: 100%" value="'.$result[4].'" />
        <br><br>
        <input type="text" name="discord"  placeholder="discord do responsavel pelo time"  style="width: 100%" value="'.$result[5].'" />
        <br><br>
        <input type="submit" class="btn btn-outline-light border border-light" value="Salvar">
       </form>';

exit();
 }else{ 

 	

exit();
   }
