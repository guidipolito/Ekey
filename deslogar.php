<?php
if (!isset($_SESSION)) {//Verificar se a sessão não já está aberta.
  session_start();
}
session_unset();
session_destroy();
header('Location: login.php');
exit();