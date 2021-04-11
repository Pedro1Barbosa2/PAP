<?php

session_start();

$nick = $_POST['username'];
$senha = $_POST['pass'];
#BASE DE DADOS
#$db = "smartmeal";
#$host = "localhost:3306";
#$user = "root";
#$pass = "";
#con = mysqli_connect($host,$user,$pass,$db) or die ("Sem conexão ao servidor");
#BASE DE DADOS

#$servername = "ERCERC-0E66ECC8";
$servername = "DESKTOP-1DOM035\SQLEXPRESS";

$connectinfo = array( "Database"=>"smartmeal");
$conn = sqlsrv_connect($servername,$connectinfo);

if($conn){
    #echo "coneection bom" . "<br>";
}else{
    die( print_r( sqlsrv_errors(), true));
}
/*
$result = mysqli_query($con, "SELECT * FROM `login`
WHERE `nick` = '$nick' AND `pass` = '$senha'");

if(mysqli_num_rows($result) > 0){
    $_SESSION['nick'] = $nick;
    $_SESSION['senha_login'] = $senha;
    header('location:homeadmin.php');
}else{
    unset ($_SESSION['email_login']);
    unset ($_SESSION['senha_login']);
    header('location:login.php?erro=1');
}*/

$tsql = "SELECT * FROM `user_login`";
$stmt = sqlsrv_query( $conn, $tsql, array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));

if($stmt == true){
    $_SESSION['nick'] = $nick;
    $_SESSION['senha_login'] = $senha;
    header('location:homeadmin.php');
}else{
    unset ($_SESSION['email_login']);
    unset ($_SESSION['senha_login']);
    header('location:login.php?erro=1');
    die();
}

?>