<?php 

include('conexao.php');
//le a url
$link= $_SERVER['REQUEST_URI'];
$link= str_replace("/", "", $link);
//puxa do banco a chave com o nick da url
$link= mysqli_real_escape_string($conexao, $link);

$query="SELECT Nome_chave, Sobre_chave, Logo_chave, Banner_chave, NumeroTimes_chave, nick_link, Id_chave, bgBlack FROM chave where nick_link = '".$link."' and publico = 1";
$result = mysqli_query($conexao, $query);
$result=mysqli_fetch_array($result,);

//salva o id da chave seleionada pra fazer outras consultas
//nem sei pq botei o if (to comentando bastante tempo depois)
if (isset($result[5])) {
	$idc=$result[6]; 	

  ?> 

  <!DOCTYPE html>
  <html lang="pt_br">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $result[0]; ?>-Ekey</title>

    <!-- Bootstrap core CSS -->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Fontes do thema -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- css template free que peguei pra ter uma base -->
    <link href="css/grayscale.min.css" rel="stylesheet">

    <style type="text/css">
      <style type="text/css"> 
      .timetamanho{width: 90%; 
        margin-left: 2%; 
        -webkit-user-select: none; /* Safari */        
        -moz-user-select: none; /* Firefox */
        -ms-user-select: none; /* IE10+/Edge */
        user-select: none;}

        .timeSelect{ 
          background-size: 100%;
        }
        .chavetime{cursor: pointer; min-width: 150px}


        td{width: 12%; overflow-y: auto;}

        .inlarge{ 
          font-size: 1.4rem;
          width: 80%;
        }

      </style>  

    </style>

    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"
    />
    <script type="text/javascript">
      //script que pega os valores e coloca nas posições
      //entretando é um sistema falho, pois se excluir o anterior as coisas ficam desorganizadas, concertarei isso eventualmente
      function colocaposi(id, valor){ 
        document.getElementById(id).value=valor; 
        if (document.getElementById(valor+"img").src!="") {document.getElementById(id).innerHTML="<img src='" +document.getElementById(valor+"img").src+"' width='70px' height='50px'/>"+"<h3 style='float:right'>"+document.getElementById(valor+"name").innerHTML+"</h3>";
      }else{
        document.getElementById(id).innerHTML="<h3 style='float:right'>"+document.getElementById(valor+"name").innerHTML+"</h3>";

      }
    }


  </script>
</head>

<body id="page-top" <?php if ($result[7]) {
  echo " class=' text-white' style='background-color:#2A2C31'";
}else{ echo "class='bg-light' style='color: black'";} ?>>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
  <div class="container">
    <a class="navbar-brand js-scroll-trigger animate__animated animate__bounceInLeft" href="index.html" >Ekey</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      Menu
      <i class="fas fa-bars"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="#about">Sobre</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="#projects">Projects</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="#signup">Contato</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Header -->
<header class="masthead" style="background-image: url(<?php if($result[3]!=""){ echo $result[3];}else{echo "img/bgt.jpg";} ?>); "><div  style="background: rgb(255,255,255);
background: linear-gradient(0deg, rgba(0,0,0,0.8) 0%, rgba(255,255,255,0) 100%, rgba(255,255,255,0) 100%); height: 100%">
<div class="container d-flex h-100 align-items-center">
  <div>
    <h1 class="  animate__animated animate__fadeInDown" style="animation-duration: 2.5s; margin-left: 10%" style="font-size: 2.1em"><?php echo $result[0]; ?></h1>
    <h2 class="text-white mx-auto mt-2 mb-5 animate__animated animate__fadeInUp" style="animation-duration: 4s; font-size: 1.5em"><?php echo $result[1] ?>;</h2>
    <a data-toggle="modal" data-target="#formInscricao" class="btn btn-outline-success border border-success animate__animated animate__fadeIn" style="animation-duration: 6s" >Mandar solicitação para participar</a><br><br>
    <a href="pesquisa.php" class="btn btn-outline-light border border-light animate__animated animate__fadeIn" style="animation-duration: 6s" >Voltar</a><br>
    <br>

  </div>
</div>
</div>
</header>

<!-- sessão da chave  -->
<section id="chave" class="projects-section">
  <div class="container">
    <center><h1>Chave</h1></center>
    <div class="container-fluid" style="overflow-x: auto; ">
     <table class="table table-borderless" style="overflow-x: auto;">

      <?php 
      if ($result[7]) {
        if ($result[4]==2) {
          echo '
          <tr><td rowspan="2" class="border chavetime boxshadow ini" id="j1t1"></td><td></td><td rowspan="2"></td></tr>
          <tr><td class="border-top border-right"></td></tr>
          <tr><td></td><td class=" border-right border-warning"></td><td rowspan="2" class="border chavetime boxshadow" id="j2t3"></td></tr>
          <tr><td></td><td class=" border-right border-warning"></td></tr>
          <tr><td rowspan="2" class="border chavetime boxshadow ini" id="j1t2"></td><td class="border-bottom border-right"></td><td></td></tr>
          <tr><td ></td><td></td></tr>
          

          ';
          
        }elseif ($result[4]==4) {
          echo '
          <tr>
          <td rowspan="2" class="border chavetime boxshadow ini" id="j1t1"></td>
          <td></td>
          <td rowspan="2"></td>
          </tr>
          <tr>
          <td class="border-top border-right"></td>
          </tr>
          <tr>
          <td></td>
          <td class=" border-right border-warning"></td><td rowspan="2" class="border chavetime boxshadow" id="j2t3"></td>
          </tr>
          <tr>
          <td></td>
          <td class=" border-right border-warning"></td>
          <td class="border-top border-right"></td>
          </tr>
          <tr>
          <td rowspan="2" class="border chavetime boxshadow ini" id="j1t2"></td>
          <td class="border-bottom border-right"></td>
          <td></td>
          <td class="border-right"></td>

          </tr>
          <tr>
          <td ></td>
          <td></td>
          <td class=" border-right"></td>

          </tr>
          <tr>
          <td ></td>
          <td colspan="2"></td>

          <td class=" border-right border-warning"></td>
          <td rowspan="2" class="border chavetime boxshadow" id="j3t6"></td>
          </tr>

          <tr>
          <td ></td>
          <td colspan="2"></td>
          <td class=" border-right"></td>
          </tr>
          <tr>
          <td ></td>
          <td colspan="2"></td>
          <td class=" border-right"></td>
          </tr>
          <tr>
          <td rowspan="2" class="border chavetime boxshadow ini" id="j1t4"></td>
          <td></td>
          <td rowspan="2"></td>
          <td class=" border-right"></td>

          </tr>
          <tr>
          <td class="border-top border-right"></td>
          <td class=" border-right"></td>
          </tr>
          <tr>
          <td></td>
          <td class=" border-right border-warning"></td><td rowspan="2" class="border chavetime boxshadow" id="j2t5"></td> 
          <td class="border-bottom border-right"></td>
          </tr>
          <tr>
          <td></td>
          <td class=" border-right border-warning"></td>
          </tr>
          <tr>
          <td rowspan="2" class="border chavetime boxshadow ini" id="j1t6"></td>
          <td class="border-bottom border-right"></td>
          <td></td>
          </tr>
          <tr>
          <td ></td>
          <td></td>
          </tr>



          ';
        }elseif($result[4]==8){

          echo '
          <tr>
          <td rowspan="2" class="border chavetime boxshadow ini" id="j1t1"></td>
          <td></td>
          <td rowspan="2"></td>
          </tr>
          <tr>
          <td class="border-top border-right"></td>
          </tr>
          <tr>
          <td></td>
          <td class=" border-right border-warning"></td><td rowspan="2" class="border chavetime boxshadow" id="j2t3"></td>
          </tr>
          <tr>
          <td></td>
          <td class=" border-right border-warning"></td>
          <td class="border-top border-right"></td>
          </tr>
          <tr>
          <td rowspan="2" class="border chavetime boxshadow ini" id="j1t2"></td>
          <td class="border-bottom border-right"></td>
          <td></td>
          <td class="border-right"></td>

          </tr>
          <tr>
          <td ></td>
          <td></td>
          <td class=" border-right"></td>

          </tr>
          <tr>
          <td ></td>
          <td colspan="2"></td>

          <td class=" border-right border-warning"></td>
          <td rowspan="2" class="border chavetime boxshadow" id="j3t6"></td>
          </tr>

          <tr>
          <td ></td>
          <td colspan="2"></td>
          <td class=" border-right"></td>
          <td class="border-top border-right"></td>
          </tr>
          <tr>
          <td ></td>
          <td colspan="2"></td>
          <td class=" border-right"></td>
          <td/>
          <td class=" border-right"/>
          </tr>
          <tr>
          <td rowspan="2" class="border chavetime boxshadow ini" id="j1t4"></td>
          <td></td>
          <td rowspan="2"></td>
          <td class=" border-right"></td>
          <td/>
          <td class=" border-right"/>

          </tr>
          <tr>
          <td class="border-top border-right"></td>
          <td class=" border-right"></td>
          <td/>
          <td class=" border-right"/>
          </tr>
          <tr>
          <td></td>
          <td class=" border-right border-warning"></td><td rowspan="2" class="border chavetime boxshadow" id="j2t5"></td> 
          <td class="border-bottom border-right"></td>
          <td/>
          <td class=" border-right"/>
          </tr>

          <tr>
          <td></td>
          <td class=" border-right border-warning"></td>
          <td/>
          <td/>
          <td class=" border-right"/>
          </tr>

          <tr>
          <td rowspan="2" class="border chavetime boxshadow ini" id="j1t7"></td>
          <td class="border-bottom border-right"></td>
          <td/>
          <td/>
          <td/>
          <td class=" border-right"></td>
          </tr>
          <tr>
          <td ></td>
          <td></td>
          <td></td>
          <td/>
          <td class=" border-right"/>
          </tr>




          <tr>
          <td ></td>
          <td colspan="4"></td>
          <td class=" border-right border-warning"></td>
          <td rowspan="2" class="border chavetime boxshadow" id="j4t15"></td>
          </tr>
          <tr>
          <td ></td>
          <td colspan="4"></td>
          <td class=" border-right"></td>
          </tr>
          <tr>
          <td ></td>
          <td colspan="4"></td>
          <td class=" border-right"></td>
          </tr>



          <tr>
          <td rowspan="2" class="border chavetime boxshadow ini" id="j1t8"></td>
          <td></td>
          <td rowspan="2"></td>
          <td/>
          <td/>
          <td class=" border-right"/>
          </tr>
          <tr>
          <td class="border-top border-right"></td>
          <td/>
          <td/>
          <td class=" border-right"/>

          </tr>
          <tr>
          <td></td>
          <td class=" border-right border-warning"></td><td rowspan="2" class="border chavetime boxshadow" id="j2t9"></td>
          <td/>
          <td/>
          <td class=" border-right"/>
          </tr>
          <tr>
          <td></td>
          <td class=" border-right border-warning"></td>
          <td class="border-top border-right"></td>
          <td/>
          <td class=" border-right"/>
          </tr>
          <tr>
          <td rowspan="2" class="border chavetime boxshadow ini" id="j1t10"></td>
          <td class="border-bottom border-right"></td>
          <td></td>
          <td class="border-right"></td>
          <td/>
          <td class=" border-right"/>
          </tr>
          <tr>
          <td ></td>
          <td></td>
          <td class=" border-right"></td>
          <td/>
          <td class=" border-right"/>
          </tr>
          <tr>
          <td ></td>
          <td colspan="2"></td>

          <td class=" border-right border-warning"></td>
          <td rowspan="2" class="border chavetime boxshadow" id="j3t11"></td>
          <td class="border-bottom border-right"></td>
          </tr>

          <tr>
          <td ></td>
          <td colspan="2"></td>
          <td class=" border-right"></td>
          </tr>
          <tr>
          <td ></td>
          <td colspan="2"></td>
          <td class=" border-right"></td>
          </tr>
          <tr>
          <td rowspan="2" class="border chavetime boxshadow ini" id="j1t12"></td>
          <td></td>
          <td rowspan="2"></td>
          <td class=" border-right"></td>

          </tr>
          <tr>
          <td class="border-top border-right"></td>
          <td class=" border-right"></td>
          </tr>
          <tr>
          <td></td>
          <td class=" border-right border-warning"></td><td rowspan="2" class="border chavetime boxshadow" id="j2t13"></td> 
          <td class="border-bottom border-right"></td>
          </tr>
          <tr>
          <td></td>
          <td class=" border-right border-warning"></td>
          </tr>
          <tr>
          <td rowspan="2" class="border chavetime boxshadow ini" id="j1t14"></td>
          <td class="border-bottom border-right"></td>
          <td></td>
          </tr>
          <tr>
          <td ></td>
          <td></td>
          </tr>

          ';

        }
        

      }else{

        if ($result[4]==2) {
          echo '
          <tr><td rowspan="2" class="border chavetime boxshadow border-secondary ini" id="j1t1"></td><td></td><td rowspan="2"></td></tr>
          <tr><td class="border-top border-right border-secondary"></td></tr>
          <tr><td></td><td class=" border-right border-primary"></td><td rowspan="2" class="border chavetime boxshadow border-secondary" id="j2t3"></td></tr>
          <tr><td></td><td class=" border-right border-primary"></td></tr>
          <tr><td rowspan="2" class="border chavetime boxshadow border-secondary ini" id="j1t2"></td><td class="border-bottom border-right border-secondary"></td><td></td></tr>
          <tr><td ></td><td></td></tr>
          

          ';
          
        }elseif ($result[4]==4) {
          echo '
          <tr>
          <td rowspan="2" class="border chavetime boxshadow border-secondary ini" id="j1t1"></td>
          <td></td>
          <td rowspan="2"></td>
          </tr>
          <tr>
          <td class="border-top border-right border-secondary"></td>
          </tr>
          <tr>
          <td></td>
          <td class=" border-right border-primary"></td><td rowspan="2" class="border chavetime boxshadow border-secondary" id="j2t3"></td>
          </tr>
          <tr>
          <td></td>
          <td class=" border-right border-primary"></td>
          <td class="border-top border-right border-secondary"></td>
          </tr>
          <tr>
          <td rowspan="2" class="border chavetime boxshadow border-secondary ini" id="j1t2"></td>
          <td class="border-bottom border-right border-secondary"></td>
          <td></td>
          <td class="border-right border-secondary"></td>

          </tr>
          <tr>
          <td ></td>
          <td></td>
          <td class=" border-right border-secondary"></td>

          </tr>
          <tr>
          <td ></td>
          <td colspan="2"></td>

          <td class=" border-right border-primary"></td>
          <td rowspan="2" class="border chavetime boxshadow border-secondary" id="j3t6"></td>
          </tr>

          <tr>
          <td ></td>
          <td colspan="2"></td>
          <td class=" border-right border-secondary"></td>
          </tr>
          <tr>
          <td ></td>
          <td colspan="2"></td>
          <td class=" border-right border-secondary"></td>
          </tr>
          <tr>
          <td rowspan="2" class="border chavetime boxshadow border-secondary ini" id="j1t4"></td>
          <td></td>
          <td rowspan="2"></td>
          <td class=" border-right border-secondary"></td>

          </tr>
          <tr>
          <td class="border-top border-right border-secondary"></td>
          <td class=" border-right border-secondary"></td>
          </tr>
          <tr>
          <td></td>
          <td class=" border-right border-primary"></td><td rowspan="2" class="border chavetime boxshadow border-secondary" id="j2t5"></td> 
          <td class="border-bottom border-right border-secondary"></td>
          </tr>
          <tr>
          <td></td>
          <td class=" border-right border-primary"></td>
          </tr>
          <tr>
          <td rowspan="2" class="border chavetime boxshadow border-secondary ini" id="j1t6"></td>
          <td class="border-bottom border-right border-secondary"></td>
          <td></td>
          </tr>
          <tr>
          <td ></td>
          <td></td>
          </tr>



          ';
        }elseif($result[4]==8){

          echo '
          <tr>
          <td rowspan="2" class="border chavetime boxshadow border-secondary ini" id="j1t1"></td>
          <td></td>
          <td rowspan="2"></td>
          </tr>
          <tr>
          <td class="border-top border-right border-secondary"></td>
          </tr>
          <tr>
          <td></td>
          <td class=" border-right border-primary"></td><td rowspan="2" class="border chavetime boxshadow border-secondary" id="j2t3"></td>
          </tr>
          <tr>
          <td></td>
          <td class=" border-right border-primary"></td>
          <td class="border-top border-right border-secondary"></td>
          </tr>
          <tr>
          <td rowspan="2" class="border chavetime boxshadow border-secondary ini" id="j1t2"></td>
          <td class="border-bottom border-right border-secondary"></td>
          <td></td>
          <td class="border-right border-secondary"></td>

          </tr>
          <tr>
          <td ></td>
          <td></td>
          <td class=" border-right border-secondary"></td>

          </tr>
          <tr>
          <td ></td>
          <td colspan="2"></td>

          <td class=" border-right border-primary"></td>
          <td rowspan="2" class="border chavetime boxshadow border-secondary" id="j3t6"></td>
          </tr>

          <tr>
          <td ></td>
          <td colspan="2"></td>
          <td class=" border-right border-secondary"></td>
          <td class="border-top border-right border-secondary"></td>
          </tr>
          <tr>
          <td ></td>
          <td colspan="2"></td>
          <td class=" border-right border-secondary"></td>
          <td/>
          <td class=" border-right border-secondary"/>
          </tr>
          <tr>
          <td rowspan="2" class="border chavetime boxshadow border-secondary ini" id="j1t4"></td>
          <td></td>
          <td rowspan="2"></td>
          <td class=" border-right border-secondary"></td>
          <td/>
          <td class=" border-right border-secondary"/>

          </tr>
          <tr>
          <td class="border-top border-right border-secondary"></td>
          <td class=" border-right border-secondary"></td>
          <td/>
          <td class=" border-right border-secondary"/>
          </tr>
          <tr>
          <td></td>
          <td class=" border-right border-primary"></td><td rowspan="2" class="border chavetime boxshadow border-secondary" id="j2t5"></td> 
          <td class="border-bottom border-right border-secondary"></td>
          <td/>
          <td class=" border-right border-secondary"/>
          </tr>

          <tr>
          <td></td>
          <td class=" border-right border-primary"></td>
          <td/>
          <td/>
          <td class=" border-right border-secondary"/>
          </tr>

          <tr>
          <td rowspan="2" class="border chavetime boxshadow border-secondary ini" id="j1t7"></td>
          <td class="border-bottom border-right border-secondary"></td>
          <td/>
          <td/>
          <td/>
          <td class=" border-right border-secondary"></td>
          </tr>
          <tr>
          <td ></td>
          <td></td>
          <td></td>
          <td/>
          <td class=" border-right border-secondary"/>
          </tr>




          <tr>
          <td ></td>
          <td colspan="4"></td>
          <td class=" border-right border-primary"></td>
          <td rowspan="2" class="border chavetime boxshadow border-secondary" id="j4t15"></td>
          </tr>
          <tr>
          <td ></td>
          <td colspan="4"></td>
          <td class=" border-right border-secondary"></td>
          </tr>
          <tr>
          <td ></td>
          <td colspan="4"></td>
          <td class=" border-right border-secondary"></td>
          </tr>



          <tr>
          <td rowspan="2" class="border chavetime boxshadow border-secondary ini" id="j1t8"></td>
          <td></td>
          <td rowspan="2"></td>
          <td/>
          <td/>
          <td class=" border-right border-secondary"/>
          </tr>
          <tr>
          <td class="border-top border-right border-secondary"></td>
          <td/>
          <td/>
          <td class=" border-right border-secondary"/>

          </tr>
          <tr>
          <td></td>
          <td class=" border-right border-primary"></td><td rowspan="2" class="border chavetime boxshadow border-secondary" id="j2t9"></td>
          <td/>
          <td/>
          <td class=" border-right border-secondary"/>
          </tr>
          <tr>
          <td></td>
          <td class=" border-right border-primary"></td>
          <td class="border-top border-right border-secondary"></td>
          <td/>
          <td class=" border-right border-secondary"/>
          </tr>
          <tr>
          <td rowspan="2" class="border chavetime boxshadow border-secondary ini" id="j1t10"></td>
          <td class="border-bottom border-right border-secondary"></td>
          <td></td>
          <td class="border-right border-secondary"></td>
          <td/>
          <td class=" border-right border-secondary"/>
          </tr>
          <tr>
          <td ></td>
          <td></td>
          <td class=" border-right border-secondary"></td>
          <td/>
          <td class=" border-right border-secondary"/>
          </tr>
          <tr>
          <td ></td>
          <td colspan="2"></td>

          <td class=" border-right border-primary"></td>
          <td rowspan="2" class="border chavetime boxshadow border-secondary" id="j3t11"></td>
          <td class="border-bottom border-right border-secondary"></td>
          </tr>

          <tr>
          <td ></td>
          <td colspan="2"></td>
          <td class=" border-right border-secondary"></td>
          </tr>
          <tr>
          <td ></td>
          <td colspan="2"></td>
          <td class=" border-right border-secondary"></td>
          </tr>
          <tr>
          <td rowspan="2" class="border chavetime boxshadow border-secondary ini" id="j1t12"></td>
          <td></td>
          <td rowspan="2"></td>
          <td class=" border-right border-secondary"></td>

          </tr>
          <tr>
          <td class="border-top border-right border-secondary"></td>
          <td class=" border-right border-secondary"></td>
          </tr>
          <tr>
          <td></td>
          <td class=" border-right border-primary"></td><td rowspan="2" class="border chavetime boxshadow border-secondary" id="j2t13"></td> 
          <td class="border-bottom border-right border-secondary"></td>
          </tr>
          <tr>
          <td></td>
          <td class=" border-right border-primary"></td>
          </tr>
          <tr>
          <td rowspan="2" class="border chavetime boxshadow border-secondary ini" id="j1t14"></td>
          <td class="border-bottom border-right border-secondary"></td>
          <td></td>
          </tr>
          <tr>
          <td ></td>
          <td></td>
          </tr>

          ';

        }
        


      }

      ?>
      
      
    </table>
  </div>



</div>
</section>
<section style="width: 0px; visibility: hidden; height: 1px" id="It's not to see - by Dipolito"> 
  <?php 

  $query= "select Nome_equipe, ImagemLink_equipe, Desc_equipe, Id_equipe from equipe where Id_chave={$idc}";
  $timesResultado = mysqli_query($conexao, $query);
  $cont=0;
  while($linha = mysqli_fetch_row($timesResultado)){

    echo '
    <div>      
    <div>
    <div>
    <img src="'.$linha[1].'" class="rounded float-left " id="'.$cont.'img">
    <h3 id="'.$cont.'name">'.$linha[0].'</h3> </div></div>

    </div>';
    $cont++;
  }

       // a partir daqui vou colocar as posições
  $query= "select id, valor from posicao where id_chave={$idc}";
  $coloca = mysqli_query($conexao, $query);
  echo "<script>";
  while($linha = mysqli_fetch_row($coloca)){

    echo "colocaposi('".$linha[0]."', ".$linha[1].");";
  }
  echo "</script>";

  ?>
</section>



<div class="modal fade" id="formInscricao" tabindex="-1" role="dialog" aria-labelledby="formInscricao" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable " role="document">
    <div class="modal-content  cadastro rounded border border-light">
      <div class="modal-header">
        <h5 class="modal-title" style="color: black">Formulario de solicitação</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="color: black">
        <form <?php echo "action='/processo/mandarsolici.php?idc=".$idc."&link=".$link."'"; ?> method="POST" enctype="multipart/form-data">
          <center>
            <input type="email" class="form-control" name="email" placeholder="Email: SeuEmail@algo.com" required><br>
            <input type="phone" class="form-control" name="telefone" placeholder="Telefone: 14999999999"><br>
            <input type="text"class="form-control" name="discord" placeholder="Discord: nome#numero"><br>
            <input type="text"class="form-control" name="nomequipe" placeholder="Nome da equipe ou nick individuo" required><br><br>

            <label for="imagesoli">Logo da sua equipe:</label>
            <input type="file" class="form-control" id="imagesoli" name="imagesoli"><br><br>
            <label for="msg">Mensagem</label><br>
            <textarea name="mensagem" class="form-control" id="msg"></textarea>

            <br><input type="submit" class="btn btn-outline-primary border border-primary" value="Enviar"><br> </center>

          </form>

          <br>
        </div>





        <!-- Bootstrap core JavaScript -->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Plugin JavaScript -->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for this template -->
        <script src="js/grayscale.min.js"></script>


      </body>

      </html>














      <?php

    }else{

      echo '
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">

      <title>Ekey</title>


      <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


      <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

      <link href="css/grayscale.min.css" rel="stylesheet">
      <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"
      />
      </head>

      <body>
      <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="index.html">Ekey</a>
      </div></nav>

      <header class="masthead" style=" background-image: linear-gradient(#1b1e36, #020412); padding: 0px">
      <iframe width="100%" height="100%" src="https://www.youtube.com/embed/reRivGDJVPw?autoplay=1&mute=1;" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="position: fixed; pointer-events: none; margin: none; opacity: 0.2; filter: blur(5px); min-height: 100%; min-width: 100%" id="som" st></iframe>
      <div class="container d-flex h-100 align-items-center" >

      <div class="mx-auto text-center">

      <h1 class="mx-auto my-0 text-uppercase animate__animated animate__fadeInDown" style="animation-duration: 2.5s; font-size: 3.5em">Não achamos Nada</h1>

      <a href="index.html" class="btn btn-outline-light border border-light animate__animated animate__fadeIn" style="animation-duration: 6s" >Ir para pagina inicial</a><br><br>

      </div>


      </div>
      </header>

      </body>
      ';

    }

    ?>



