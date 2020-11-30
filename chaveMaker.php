<html lang="pt_br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="css/grayscale.min.css" rel="stylesheet">
  <link rel="stylesheet" type="stylesheet" href="css/torneiolist.css">
  <link rel="stylesheet" type="text/css" href="css/chaveMaker.css">
    <?php
   if (!isset($_SESSION)) {//Verificar se a sessão não já está aberta.
  session_start();
}
if (isset($_SESSION['erro'])) {
  echo "<script>alert(".$_SESSION['erro'].") </script>";
  unset($_SESSION['erro']);
}
    if (isset($_SESSION['login'])) {
      $login = $_SESSION['login'];
      include('conexao.php');
      $idc = intval($_GET['idc']);//id chave
      $query = "select Nivel_permissao from permissao where Id_usuario = '{$login}' and Id_chave = '{$idc}'";

//a consulta
$result = mysqli_query($conexao, $query);
 $result=mysqli_fetch_array($result);
  if ($result[0]!=1) {
    header('Location: torneiosList.php');
  }
      $query = "select Nome_chave, Sobre_chave, Logo_chave, Banner_chave, NumeroTimes_chave, publico, bgBlack from chave where Id_chave ={$idc}"; //pega dados da chave
      $result = mysqli_query($conexao, $query);
      $result = mysqli_fetch_array($result);
      echo "<title>EKey-{$result[0]}</title>";

        
    }else{
      header('Location: login.php');
    }

    ?>
     <link rel="stylesheet" type="text/css" href="css/torneiolist.css"> <!-- Coisinhas proprias da outra pagina mas vou usar nessa tambem-->
     <style type="text/css"> 
        .timetamanho{width: 90%; 
          margin-left: 2%; 
        -webkit-user-select: none; /* Safari */        
        -moz-user-select: none; /* Firefox */
        -ms-user-select: none; /* IE10+/Edge */
        user-select: none;}

        .timeSelect{cursor: cell; 
          background-size: 100%;
          }
          .chavetime{cursor: pointer; min-width: 150px}
          .removebt{transition: 0.2s; cursor: pointer;}
          .removebt:hover{ filter:saturate(2); }
          .removebt:active{filter:saturate(8);}

          td{width: 12%; overflow-y: auto;}

     </style>

  </head>



  <body style="background-color: #3F3F3F; background-image: url('img/body-bg-login.jpg'); background-position: center; " onload="sidetime()">
    <div class="container-fluid">

      <div class="row">
        <!-- Parte onde mostra os times-->
      <div class="col ladinho md" id="timezim"><div class="container rounded border border-light grande" style="visibility: hidden;" id="visivel"> <h2 class="text-white mb-3 "> Times</h2>

<?php 
    //mostra os times na pagina

    $query= "select Nome_equipe, ImagemLink_equipe, Desc_equipe, Id_equipe from equipe where Id_chave={$idc}";
  $timesResultado = mysqli_query($conexao, $query);
  $cont=0;
        while($linha = mysqli_fetch_row($timesResultado)){

        echo '
<div class="row timetamanho">      
  <div style="margin: 7px;" class=" border border-light rounded boxshadow col-8 itemselecao timeSelect" onclick="selecao('.$cont.')" id="'.$cont.'">
      <div>
          <img src="'.$linha[1].'" class="rounded float-left " width="40px" id="'.$cont.'img">
     <h3 class="text-white" id="'.$cont.'name">'.$linha[0].'</h3> </div></div>
      <div class="col-3">
      <span >
      <img src="img/remove.png" width="40" height="40" style="margin-top:5px; cursor:pointer" onclick="veriremovtime(1, '.$linha[3].')"  data-toggle="modal" data-target="#removeequipe" >
      </span>
      <img src="img/edit.png" width="40" height="40" style="cursor:pointer " onclick="alteratime('.$linha[3].')" data-toggle="modal" data-target="#alterartime">

      </div>

     </div>';
     $cont++;

          }
?>


<div class="row timetamanho" style="cursor: pointer;">      
  <div style="margin: 10px;"  class=" border border-light rounded boxshadow col itemselecao" data-toggle="modal" data-target="#time">
      <div style="height: 100% ">
          <img src="img/add.png" class="rounded float-left " alt="more"  width="40px"> <h3 class="text-white">Novo time</h3> </div></div>
     </div>



</div>
</div>

<div class="col">
      <div class="container-fluid rounded border border-light grande"  >
      <center> <h1 class="text-white mb-3 align-middle tituloo"><i><?php echo $result[0] ?></i></h1>
      <div style="max-height: 60vh; overflow: auto;">
    
    


</div>
    
  </center><div class="row"><div class="col-sm-2">
<div class="btn btn-outline-light border border-light" style="margin-bottom: 5px" onclick="sidetime()">
    --Times-
  </div><br> <!-- botao para mostrar a parte dos times-->
 <div class="btn btn-outline-light border border-light" style="margin-bottom: 5px"data-toggle="modal"  data-target="#exampleModalScrollable" >
    Config. Chave
  </div> <!-- botao para alterar os dados-->
<div class="btn btn-outline-light border border-light" style="margin-bottom: 5px; cursor: pointer;" onclick="rando()" >
    Randomizar chave
  </div> 
<br><br>
  <a href="torneiosList.php" class="text-dark">
 <div class="btn btn-outline-light border border-light">
    Voltar
  </div></a>

</div>
   <!-- parte da tabela dos times -->
<div class="col-sm-1"><br></div>
<div class="col-sm-9" style="overflow-x: auto;"> <img src="img/remove.png" width="70px" style="float: right; visibility: hidden;" class="removebt" id="removebtn" onclick="removebtn()">
  <table class="table table-borderless" style="overflow-x: auto;">
    <?php 
     
        if ($result[4]==2) {
          echo '
    <tr><td rowspan="2" class="border chavetime boxshadow ini" id="j1t1" onclick="coloca(this)"></td><td></td><td rowspan="2"></td></tr>
    <tr><td class="border-top border-right"></td></tr>
    <tr><td></td><td class=" border-right border-warning"></td><td rowspan="2" class="border chavetime boxshadow" id="j2t3" onclick="coloca(this)"></td></tr>
    <tr><td></td><td class=" border-right border-warning"></td></tr>
    <tr><td rowspan="2" class="border chavetime boxshadow ini" id="j1t2" onclick="coloca(this)"></td><td class="border-bottom border-right"></td><td></td></tr>
    <tr><td ></td><td></td></tr>
          

          ';
          
        }elseif ($result[4]==4) {
          echo '
    <tr>
      <td rowspan="2" class="border chavetime boxshadow ini" id="j1t1" onclick="coloca(this)"></td>
      <td></td>
      <td rowspan="2"></td>
    </tr>
    <tr>
      <td class="border-top border-right"></td>
    </tr>
    <tr>
      <td></td>
      <td class=" border-right border-warning"></td><td rowspan="2" class="border chavetime boxshadow" id="j2t3" onclick="coloca(this)"></td>
    </tr>
    <tr>
      <td></td>
      <td class=" border-right border-warning"></td>
      <td class="border-top border-right"></td>
    </tr>
    <tr>
      <td rowspan="2" class="border chavetime boxshadow ini" id="j1t2" onclick="coloca(this)"></td>
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
       <td rowspan="2" class="border chavetime boxshadow" id="j3t6" onclick="coloca(this)"></td>
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
      <td rowspan="2" class="border chavetime boxshadow ini" id="j1t4" onclick="coloca(this)"></td>
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
      <td class=" border-right border-warning"></td><td rowspan="2" class="border chavetime boxshadow" id="j2t5" onclick="coloca(this)"></td> 
      <td class="border-bottom border-right"></td>
    </tr>
    <tr>
      <td></td>
      <td class=" border-right border-warning"></td>
    </tr>
    <tr>
      <td rowspan="2" class="border chavetime boxshadow ini" id="j1t6" onclick="coloca(this)"></td>
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
      <td rowspan="2" class="border chavetime boxshadow ini" id="j1t1" onclick="coloca(this)"></td>
      <td></td>
      <td rowspan="2"></td>
    </tr>
    <tr>
      <td class="border-top border-right"></td>
    </tr>
    <tr>
      <td></td>
      <td class=" border-right border-warning"></td><td rowspan="2" class="border chavetime boxshadow" id="j2t3" onclick="coloca(this)"></td>
    </tr>
    <tr>
      <td></td>
      <td class=" border-right border-warning"></td>
      <td class="border-top border-right"></td>
    </tr>
    <tr>
      <td rowspan="2" class="border chavetime boxshadow ini" id="j1t2" onclick="coloca(this)"></td>
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
       <td rowspan="2" class="border chavetime boxshadow" id="j3t6" onclick="coloca(this)"></td>
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
      <td rowspan="2" class="border chavetime boxshadow ini" id="j1t4" onclick="coloca(this)"></td>
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
      <td class=" border-right border-warning"></td><td rowspan="2" class="border chavetime boxshadow" id="j2t5" onclick="coloca(this)"></td> 
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
      <td rowspan="2" class="border chavetime boxshadow ini" id="j1t7" onclick="coloca(this)"></td>
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
      <td rowspan="2" class="border chavetime boxshadow" id="j4t15" onclick="coloca(this)"></td>
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
      <td rowspan="2" class="border chavetime boxshadow ini" id="j1t8" onclick="coloca(this)"></td>
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
      <td class=" border-right border-warning"></td><td rowspan="2" class="border chavetime boxshadow" id="j2t9" onclick="coloca(this)"></td>
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
      <td rowspan="2" class="border chavetime boxshadow ini" id="j1t10" onclick="coloca(this)"></td>
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
       <td rowspan="2" class="border chavetime boxshadow" id="j3t11" onclick="coloca(this)"></td>
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
      <td rowspan="2" class="border chavetime boxshadow ini" id="j1t12" onclick="coloca(this)"></td>
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
      <td class=" border-right border-warning"></td><td rowspan="2" class="border chavetime boxshadow" id="j2t13" onclick="coloca(this)"></td> 
      <td class="border-bottom border-right"></td>
    </tr>
    <tr>
      <td></td>
      <td class=" border-right border-warning"></td>
    </tr>
    <tr>
      <td rowspan="2" class="border chavetime boxshadow ini" id="j1t14" onclick="coloca(this)"></td>
      <td class="border-bottom border-right"></td>
      <td></td>
    </tr>
    <tr>
      <td ></td>
      <td></td>
    </tr>

          ';

        }
      
     ?>
  </table>
 <button class="btn btn-outline-warning border border-warning" style="float: right; " onclick="podefechar=1; salvarposi()">Salvar posições</button>
</div> 
</div></div></div></div>
</div>
</div>


<!-- alterar a chave   -->
<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable " role="document">
    <div class="modal-content  cadastro rounded border border-light">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Cadastro da chave</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"><?php 
        echo '<form method="POST" action="alteraChave.php?idc='.$idc.'">';
            
                       
                        echo '<input type="text" name="nomeChave"  placeholder="Nome da chave" value="'.$result[0].'" required/><br><br>
                        
                       
                        <input type="text" name="logoLink"  placeholder="Link da logo (Oque aparecera apos .com/link)"  style="width: 100%" value="'.$result[2].'" />
                        <br><br>
                        <input type="text" name="bannerLink"  placeholder="Link do banner (Oque aparecera apos .com/link)"  style="width: 100%" value="'.$result[3].'" />
                        <br><br>
                        <textarea class="form-control" rows="3" name="sobre" placeholder="Conte sobre oque é a chave, formas de contato, entra outros" style="background: transparent; color: white">'.$result[1].'</textarea><br><br>
                            <select class="custom-select" name="nTimes" required>
    <option selected value="'.$result[4].'">'.$result[4].' Times</option>
    <option value="2">2 Times</option>
    <option value="4">4 Times</option>
    <option value="8">8 Times</option>
    <option value="16">16 Times</option>
    <option value="32">32 Times</option>
    <option value="64">64 Times</option>
    
  </select><br><br>';
    if ($result[5]==1) {
      echo 'Privacidade:<select class="custom-select" name="privacidade" required>
    <option selected value="1">Publico</option>
    <option value="0">Privado</option>

  </select>';
    }else{
        echo 'Privacidade:<select class="custom-select" name="privacidade" required>
    <option selected value="0">Privado</option>
    <option value="1">Publico</option>

  </select>';

    }
  if ($result[6]==1) {
    echo 'Fundo:<select class="custom-select" name="bgBlack" required>
    <option selected value="1">Fundo Escuro</option>
    <option value="0">Fundo Claro</option>

  </select>';
  }else{
    echo 'Fundo:<select class="custom-select" name="bgBlack" required>
    
    <option selected value="0">Fundo Claro</option>
    <option   value="1">Fundo Escuro</option>
    </select> ';

  }






  ?>
 <center> <br><input type="submit" class="btn btn-outline-light border border-light" value="Salvar"><br>
      </center>              
        </form>

        <br>
        <button type="button" class="btn btn-outline-light border border-light" data-dismiss="modal">Fechar</button>
      </div>
     
        
        
      
    </div>
  </div>
</div>

<!-- parte dos times (modal cadastro) -->
<div class="modal fade" id="time" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable " role="document">
    <div class="modal-content  cadastro rounded border border-light">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Cadastro do time</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php
       echo '<form method="POST" action="insereTime.php?idc='.$idc.'">';
            ?>
                       
                       <input type="text" name="nomeTime"  placeholder="Nome do time" required/><br><br>
                        
                      
                        <input name="logoLinktime" placeholder="Link da imagem do time"  style="width: 100%" />
                        <br>
                        
                        <br><br>
                        <textarea class="form-control" rows="3" name="sobre" placeholder="descrição" style="background: transparent; color: white"></textarea><br><br>
                            <br>
 <center> <br><input type="submit" class="btn btn-outline-light border border-light" value="Inserir"><br>
      </center>              
        </form>

        
        <button type="button" class="btn btn-outline-light border border-light" data-dismiss="modal">Fechar</button>
      </div>      
    </div>
  </div>
</div>








<!-- parte da verificação para remover-->
<div class="modal fade" id="removeequipe" tabindex="-1" role="dialog" aria-labelledby="removeequipe" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable " role="document">
    <div class="modal-content  cadastro rounded border border-light">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Verificação de remoção</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="veriremovtime(3)">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <h3>Tem certeza que deseja fazer isso?</h3>
        
        <button type="button" class="btn btn-outline-light border border-danger" data-dismiss="modal" onclick="veriremovtime(2)">Remover</button>
        <button type="button" class="btn btn-outline-light border border-light" data-dismiss="modal" onclick="veriremovtime(3)">Fechar</button>
      </div>      
    </div>
  </div>
</div>




<!-- parte de mudar dados-->
<div class="modal fade" id="alterartime" tabindex="-1" role="dialog" aria-labelledby="removeequipe" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable " role="document">
    <div class="modal-content  cadastro rounded border border-light">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Alterar time</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="alterartimesform">
       

      </div>      
    </div>
  </div>
</div>

      <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="vendor/jquery/jquery.min.js"></script>
     <script type="text/javascript">
      var idchavegeral= <?php echo $idc; ?>;
      var cont=0, podefechar=1;

      function sidetime() {
        if (cont==0) {
          document.getElementById("visivel").style.visibility = "visible";
          document.getElementById("timezim").style.maxWidth = "30%";
          
          
          cont=1;

        }else{
          document.getElementById("visivel").style.visibility = "hidden";
          document.getElementById("timezim").style.maxWidth = "0%";
         
          cont=0;
        }
      }

      var selecionado=0, ids=0, selecionadoc=0, idsc=0, idchave; //ids== id do selecionado, e idsc == id selecionado da chave, idsc == id da posição de chave selecionado
      // selecionado quando em 0 indica que n tem nenhum selecionado, ids é pra gravar o id do objeto selecionado
      const imagemselecao = "url('https://media1.tenor.com/images/6f60415eed53c0dfa28c80f5016ad6fa/tenor.gif?itemid=16310252')";
      function selecao(id){

        if (selecionadoc==1) {
          document.getElementById(idchave).value= id; 
          document.getElementById(idchave).style.backgroundImage ="";
           document.getElementById(idchave).innerHTML= "<img src='" +document.getElementById(id+"img").src+"' width='70px' height='50px'/>"+"<h3 class='text-white' style='float:right'>"+document.getElementById(id+"name").innerHTML+"</h3>"; 
          selecionadoc=0;
          podefechar=0;
         document.getElementById("removebtn").style.visibility = "hidden";
        }else if (selecionado==0) {
          ids=id;
          selecionado=1;
          document.getElementById(ids).style.backgroundImage = imagemselecao;


        }else{
          if (ids==id){
            selecionado=0;
            document.getElementById(ids).style.backgroundImage = "";

          }else{
             document.getElementById(ids).style.backgroundImage = "";
             ids=id;
             document.getElementById(ids).style.backgroundImage = imagemselecao;
          }

        }
      }

     function coloca(obj){


      if (selecionado) {
        
          obj.innerHTML= "<img src='" +document.getElementById(ids+"img").src+"' width='70px' height='50px'/>"+"<h3 class='text-white' style='float:right'>"+document.getElementById(ids+"name").innerHTML+"</h3>";
          obj.value=ids;
          selecao(ids);
          podefechar=0;
        }else if(selecionadoc==1){ 
          selecionadoc=0;

         document.getElementById("removebtn").style.visibility = "hidden";
          var conteudo= obj.innerHTML, timedachave = obj.value;
          obj.value=idsc;
           obj.innerHTML= document.getElementById(idchave).innerHTML;
           obj.style.backgroundImage="";
          document.getElementById(idchave).style.backgroundImage = "";
          document.getElementById(idchave).innerHTML = conteudo;
          document.getElementById(idchave).value = timedachave;
          


        }else{
          obj.style.backgroundImage = imagemselecao;
          selecionadoc=1;
          idsc = obj.value;
          idchave=obj.id;
          document.getElementById("removebtn").style.visibility = "visible";
           podefechar=0;
        }
     }
  
      
      function salvarposi() {

       var quebra=true, texto="?idc="+idchavegeral+"&", texto2="";
       var cont=0;
       var cont2=0;

       while(quebra){
        try{
          if ( document.getElementsByClassName("chavetime")[cont].value!=null) {

            texto2+="p"+cont+"="+document.getElementsByClassName("chavetime")[cont].id+"&v"+cont+"="+document.getElementsByClassName("chavetime")[cont].value+"&";
            
           }
      cont++;
    
          
        }catch{ quebra=false; texto+=texto2; texto+="n="+cont;}
       }

      
       window.location="salvaposicao.php"+texto;
     }

     function colocaposi(id, valor){ 
      document.getElementById(id).value=valor; 
       document.getElementById(id).innerHTML="<img src='" +document.getElementById(valor+"img").src+"' width='70px' height='50px'/>"+"<h3 class='text-white' style='float:right'>"+document.getElementById(valor+"name").innerHTML+"</h3>";
     }




     function removebtn(){

        document.getElementById(idchave).style.backgroundImage = "";
        document.getElementById(idchave).value = "";
        document.getElementById(idchave).innerHTML = "";
        document.getElementById("removebtn").style.visibility="hidden";
        selecionadoc=0;
        podefechar=0;
     }

     function rando(){
      var tamanhoini = document.getElementsByClassName('ini').length;
       for (var i = 0; i < tamanhoini; i++) {document.getElementsByClassName('ini')[i].value=null;
       document.getElementsByClassName('ini')[i].innerHTML=""; }
      for (var i = 0; i < tamanhoini; i++) {
        var quebra=false;
        while(quebra==false){
        var dado=Math.floor(Math.random()*tamanhoini);
        if (document.getElementsByClassName('ini')[dado].value==null) {
          console.log(document.getElementsByClassName('ini')[dado].id+" para id"+i);
          document.getElementsByClassName('ini')[dado].value=i;
           document.getElementsByClassName('ini')[dado].innerHTML="<img src='" +document.getElementById(i+"img").src+"' width='70px' height='50px'/>"+"<h3 class='text-white' style='float:right'>"+document.getElementById(i+"name").innerHTML+"</h3>";
           quebra=true;
        }

        podefechar=0;
        }
      }

     }
var activeremovtime=0, removtime;
 function veriremovtime(act, idremo) {
   if (act==1) {
    activeremovtime=1;
    removtime=idremo;
   }else if(act==2){
    if (activeremovtime==1) {
      window.location.href = "processo/removetime.php?idequipe="+removtime;
    }else{alert('algo esta errado  ╯▂╰ ');}
   }else if(act==3){
    activeremovtime=0;
    removtime=null;
   }else{ alert("Bug  ╯▂╰ ")}
 }


 function alteratime(idtime) {
    $.ajax({ 
      url: 'processo/timedados.php',
      method: 'post',
      data: { 
        idequipe: idtime
      }
    }).done(function(resposta){ document.getElementById('alterartimesform').innerHTML=resposta;})
 }



     window.onbeforeunload = function fechaando(){
 if (podefechar==0) {
  return 'Você fez mudanças que talvez não tenham sido salvas, por favor, salve as alterações antes de sair (づ￣ ³￣)づ';}
};
     </script>
     

    

    <?php 


    // a partir daqui vou colocar as posições
    $query= "select id, valor from posicao where id_chave={$idc}";
  $coloca = mysqli_query($conexao, $query);
    echo "<script>";
        while($linha = mysqli_fetch_row($coloca)){
       
          echo "colocaposi('".$linha[0]."', ".$linha[1].");";
        }
        echo "</script>";
     ?>
</body>
</html>