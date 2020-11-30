<!DOCTYPE html>
<html lang="pt_br">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Ekey</title>

 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  
  <link href="css/grayscale.css" rel="stylesheet">
<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"
  />
  
</head>

<body  style="background-color: #161616" onload="iniciabusca()">

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="index.html">Ekey</a>
      
    </div>
  </nav>

 
    
  <section id="signup" class="signup-section" style="padding: 7rem 2rem">

    <div class="container">
      <div class="row">
        <div class="col text-center ">
          <center>
          <div class="form-inline d-flex w-75">
            <input type="text" class="form-control flex-fill mr-0 mr-sm-2 mb-0 mb-sm-0 animate__animated animate__fadeInDown" id="pesquisa" placeholder="pesquisa" onkeyup="iniciabusca()">
            <button onclick="iniciabusca()" class="btn btn-dark mx-auto w-25 animate__animated animate__fadeInDown"><img src="img/lupa.png" alt="pesquisar" style="pointer-events: none; width: 30px"></button>
          </div>
</center>
        </div>
      </div>
    </div>
  </section>
 
 
 

  <section class=" bg-black" >
    <div class="container" id="conteudo">

     

    </div>
  </section>


<center>  <button type="button" class="btn btn-outline-light rounded-pill border border-light" onclick="continuabusca()" id="vermais" style="visibility: hidden;">Ver mais</button></center>


  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Plugin JavaScript -->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <!-- Custom scripts for this template -->
  <script src="js/grayscale.min.js"></script>


<script type="text/javascript">
  var cont, texto, buscaperma, rowatual=0;



//Eu estou comentando muito tempo depois, mas essa parte é o processo de busca, auto explicativo
function buscamais() {
  $.ajax({
      url: 'processo/pesquisatime.php',
      method: 'post',
      data: {
        busca: buscaperma,
        cont: cont
      }
    }).done(function result(resposta) {

      if (resposta!="[+][+]"){
      resposta= resposta.split('[+]');
      console.log(resposta);
    document.getElementById(rowatual+'r').innerHTML +="<div class='col-md-3 mb-4 mt-4 m-3 border-top border-right border-left border-secondary animate__animated animate__fadeIn' style=' background: linear-gradient(to bottom, rgba(22, 22, 22, 0.3) 0%, rgba(22, 22, 22, 0.7) 50%, #161616 100%), url("+resposta[2]+"); cursor: pointer; background-position: center; background-size: 100% auto; background-repeat: no-repeat'  ><a href='"+resposta[1]+"'><div class='card-body text-center' style='color: white; padding-top: 4rem;'><div><h5>"+resposta[0]+"</h5></div></div></a></div>"; 
      document.getElementById('vermais').style.visibility="visible";

}else{document.getElementById('vermais').style.visibility="hidden";}
})
    cont++
}





 function continuabusca(){

    for (var cont2 = 0; cont2 < 6; cont2++) {
        
      buscamais();
      }

 }





  function iniciabusca(){
    
    var busca = document.getElementById('pesquisa').value;
    cont=0;
    rowatual = 0;
    document.getElementById('conteudo').innerHTML ='<div class="row justify-content-md-center" id="'+rowatual+'r">'
    buscaperma = busca;
    $.ajax({
      url: 'processo/pesquisatime.php',
      method: 'post',
      data: {
        busca: busca,
        cont: cont
      }
    }).done(function result(resposta) {

      if (resposta!="[+][+]"){
      resposta= resposta.split('[+]');
      console.log(resposta);
    document.getElementById(rowatual+'r').innerHTML +="<div class='col-md-3 mb-4 mt-4 m-3 border-top border-right border-left border-secondary animate__animated animate__fadeIn' style=' background: linear-gradient(to bottom, rgba(22, 22, 22, 0.3) 0%, rgba(22, 22, 22, 0.7) 50%, #161616 100%), url("+resposta[2]+"); cursor: pointer; background-position: center; background-size: 100% auto; background-repeat: no-repeat'  ><a href='"+resposta[1]+"'><div class='card-body text-center' style='color: white; padding-top: 4rem;'><div><h5>"+resposta[0]+"</h5></div></div></a></div>"; 
      cont++; 
            for (var cont2 = 0; cont2 < 5; cont2++) {
        
      buscamais();
      }//
}else{document.getElementById('vermais').style.visibility="hidden";}

  })
  
}





</script>
</body>
</html>
