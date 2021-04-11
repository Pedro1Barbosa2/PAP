<?php

session_start();
if((!isset ($_POST['nick']) == true) && (!isset ($_POST['pass']) == true)){
    header('location:user.php');
}
if((!isset ($_SESSION['nick']) == true) && (!isset ($_SESSION['senha_login']) == true)){
    unset($_SESSION['nick']);
    unset($_SESSION['senha_login']);
    header('location:login.php');
}else{
    $nome = $_POST['nick'];
    $email = $_POST['email'];
    $senha = $_POST['pass'];
    $id = $_SESSION['id'];
}

$ligacao = new mysqli("localhost","root","","smartmeal");

if ($ligacao->connect_errno) {
    echo "Falha na ligação: " . $ligacao->connect_error; 
    exit();
}

$consulta = "UPDATE `login` SET nick='$nome', email='$email', pass='$senha' WHERE id='$id' ";

if (!$ligacao->query($consulta)) {
    echo " ERRO - Falha ao executar a consulta: \"$consulta\" <br>" . $ligacao->error;
    $ligacao->close();  /* fechar a ligação */
    unset($_SESSION['nick']);
    unset($_SESSION['senha_login']);
    header('Refresh: 5;url=login.php');
}
else{
    echo "Está a ser redirecionado para a página de login, por favor inicie sessão novamente....";
    unset($_SESSION['nick']);
    unset($_SESSION['senha_login']);
    header('Refresh: 5;url=login.php?sucess=1');
}
$ligacao->close();

?>