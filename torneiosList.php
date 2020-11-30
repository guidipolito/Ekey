<!doctype html>
<html lang="pt_br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Ekey-Chaves</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="css/grayscale.min.css" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="css/torneiolist.css"> <!-- Coisinhas proprias dessa pagina -->

  </head>
  <body style="background-color: #3F3F3F; background-image: url('img/body-bg-login.jpg'); background-position: center; ">
    <div class="container">
      <div class="container-fluid align-middle rounded border border-light grande"  >
      <center> <h1 class="text-white mb-3 align-middle tituloo"><i>Torneios</i></h1>
      <div style="max-height: 60vh; overflow: auto;">
    <?php
   if (!isset($_SESSION)) {//Verificar se a sessão não já está aberta.
  session_start();
}
if (isset($_SESSION['erro'])) {
  echo "<script>alert(".$_SESSION['erro'].") </script>";
  unset($_SESSION['erro']);
}
    if ($_SESSION['login']) {
      $login = $_SESSION['login'];
      include('conexao.php');
      $query = "select Id_chave from permissao where Id_usuario = '{$login}'";

  $result = mysqli_query($conexao, $query);
        while($fetch = mysqli_fetch_row($result)){
        echo  $fetch[0];
        $query = "select Nome_chave, Sobre_chave, Logo_chave, Id_chave from chave where Id_chave = '{$fetch[0]}'";
        $result2 = mysqli_query($conexao, $query);
        $result2 = mysqli_fetch_row($result2);
        echo '<div class="row " style="width: 70%" >      <div style="margin: 10px;" class=" border border-light rounded boxshadow col itemselecao" data-toggle="modal" ><div style="height: 100% " ><a href="chaveMaker.php?idc='.$result2[3].'><img src="'.$result2[2].'" class="rounded float-left " alt="more" width="100px"> <h3 class="text-white">'.$result2[0].'</h3><p>'.$result2[1] .'</p> </a></div></div>
     </div>';
}
      
    
    }else{
      header('Location: login.php');
    }

    ?>
    <div class="row " style="width: 70%">      <div style="margin: 10px;" class=" border border-light rounded boxshadow col itemselecao" data-toggle="modal" data-target="#exampleModalScrollable"><div style="height: 100% "><img src="img/add.png" class="rounded float-left " alt="more"  width="100px"> <h3 class="text-white">Nova Chave</h3> </div></div>
     </div>


</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </center><a href="deslogar.php" class="text-dark">
 <div class="btn btn-outline-light border border-light">
    Sair
  </div></a>
</div>





<!-- Modal cadastro-->
<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable " role="document">
    <div class="modal-content  cadastro rounded border border-light">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Cadastro da chave</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="insereChave.php">
            
                        
                        <input type="text" name="nomeChave"  placeholder="Nome da chave" required/><br><br>
                        
                       
                        <input type="text" name="nickLink"  placeholder="Link da chave (Oque aparecera apos .com/link)" required style="width: 100%" />
                        <br><br>
                        <textarea class="form-control" rows="3" name="sobre" placeholder="Conte sobre oque é a chave, formas de contato, entra outros" style="background: transparent; color: white"></textarea><br><br>
                            <select class="custom-select" name="nTimes" required>
    <option selected>Quantia de Times</option>
    <option value="2">2</option>
    <option value="4">4</option>
    <option value="8">8</option>
    <option value="16">16</option>
    <option value="32">32</option>
    <option value="64">64</option>
    
  </select><br><br>
 <center> <input type="submit" class="btn btn-outline-light border border-light" value="Cadastrar Chave"><br>
      </center>              
        </form>

        <br>
        <button type="button" class="btn btn-outline-light border border-light" data-dismiss="modal">Fechar</button>
      </div>
     
        
        
      
    </div>
  </div>
</div>
     
</body>
</html>