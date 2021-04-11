<?php

session_start();

if(!(isset ($_SESSION['nick']) == true) && !(isset ($_SESSION['senha_login']) == true)){
    unset($_SESSION['nick']);
    unset($_SESSION['senha_login']);
    header('location:login.php');
}else{

$nick = $_SESSION['nick'];
$senha = $_SESSION['senha_login'];
}

if(isset($_POST['data'])){

    $prato = $_POST['menu'];
    $data = $_POST['data'];
    $hora = $_POST['hora'];

$servername = "DESKTOP-1DOM035\SQLEXPRESS";

$connectinfo = array( "Database"=>"smartmeal");
$conn = sqlsrv_connect($servername,$connectinfo);

if($conn){
    #echo "coneection bom" . "<br>";
}else{
    die( print_r( sqlsrv_errors(), true));
}
$tsql2 = "Delete FROM pratododia";
$getResults2 = sqlsrv_query($conn, $tsql2) or die(print_r(sqlsrv_errors()));
$tsql= "Insert into pratododia values('$data','$hora','$prato')";
$getResults= sqlsrv_query($conn, $tsql) or die(print_r(sqlsrv_errors()));

if($getResults){
    header('location:menu.php?sucess=1');
}

}else{
    echo "erro";
}
?>