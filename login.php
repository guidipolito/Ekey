<!DOCTYPE html>
<html lang="pt_br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Ekey</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
<style type="text/css">
    input{font-family: arial}
      <style type="text/css">
    
    .boxshadow:hover{ box-shadow:  1px 1px 1px black, 0 0 15px white, 0 0 3px white;}

</style>
</head>
<body style="height: 100vh">
 <?php
 if (!isset($_SESSION)) {//Verificar se a sessão não já está aberta.
  session_start();
}
    $loginstatus=isset($_SESSION["login"]);
    if ($loginstatus==true) {
      header('Location: torneiosList.php'); 
    }else{
     
    }

    ?>
    <div class="main" >
        <center>
        <div class="container" style="margin: 0px; padding: 90px; margin-top: 55px" >
            <div class="signup-content overflow-auto rounded border border-light" style="height: 510px;  background-image:linear-gradient(to bottom, rgb(10, 25, 50,0.90), rgb(10, 13, 20)); opacity: 0.96; box-shadow: 10px 10px 10px black;" id="formtamanho">
                <div id="carouselExampleFade" class="carousel slide"  data-ride="carousel" data-interval="0">
  <div class="carousel-inner">
    <div class="carousel-item active">
      
                <form method="POST" id="signup-form" class="signup-form" action="loginTeste.php">
                    <h2>Login </h2>
                    
                    <div class="form-group">
                        <input type="text" class="form-input" name="usuario" id="name" placeholder="usuario" required/>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-input" name="senha" id="password" placeholder="senha" required/>
                        
                    </div>
                  
                    <div class="form-group">
                        <input type="submit" class="btn btn-outline-light border border-light" value="Login" />
                    </div>
                    
                </form><center><a class="btn btn-outline-light border border-light" href="#carouselExampleFade" role="button" data-slide="next">
 Cadastro
  </a> <br><br> <a class="btn btn-outline-light border border-light" href="#carouselExampleFade" role="button" data-slide="prev">
  Esqueci minha senha
  </a><br><br><a class="btn btn-outline-warning border border-warning" href="index.html">Ir para tela inicial</a></center>
  <br>
    </div>
    <div class="carousel-item">
      
                <form method="POST" id="signup-form" class="signup-form" action="cadastro.php">
                    <h2>Cadastro </h2>
                    <div class="form-group">
                        <input type="text" class="form-input" name="cname" id="name" placeholder="Seu nome" required/>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-input" name="cemail" id="email" placeholder="Email" required/>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-input" name="cuser" id="name" placeholder="usuario(usado para login)" required/>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-input" name="csenha" id="password" placeholder="senha" required/>
                        
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-input" name="confirmSenha" id="password" placeholder="repita a senha" required/>
                       
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="agree-term" id="agree-term" class="agree-term"  required/>
                        <label for="agree-term" class="label-agree-term" ><span><span></span></span>Eu concordo com todos os<a href="KKkTErmos" class="term-service"> Termos de serviço</a></label>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-outline-light border border-light" value="Cadastrar" />
                    </div>
                   
                </form> <center> <a class="btn btn-outline-light border border-light" href="#carouselExampleFade" role="button" data-slide="prev">Ja tem um cadastro: logar </a></center><br>
    </div>
    <div class="carousel-item">
          <form method="POST" id="signup-form" class="signup-form">
                    <h2>Recuperar senha </h2>
                    
                    <div class="form-group">
                        <input type="email" class="form-input" name="email" id="email" placeholder="Email"  required/>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-outline-light border border-light" value="Recuperar" />
                    </div>
                   
                </form> <center> <a class="btn btn-outline-light border border-light" href="#carouselExampleFade" role="button" data-slide="next">Voltar </a></center><br>


     </div>
  </div>
 
  
</div>

            </div>
        </div>
</center>
    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
 
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
 
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>