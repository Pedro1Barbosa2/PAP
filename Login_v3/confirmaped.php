<?php

$servername = "DESKTOP-1DOM035\SQLEXPRESS";

$connectinfo = array( "Database"=>"smartmeal");
$conn = sqlsrv_connect($servername,$connectinfo);

if($conn){
    #echo "coneection bom" . "<br>";
}else{
    die( print_r( sqlsrv_errors(), true));
}

if(isset($_GET['idped'])){
$id = $_GET['idped'];
$tsql = "UPDATE pedido set Estado='Recebido' where id_pedido=$id";
$insertresult = sqlsrv_query($conn, $tsql) or die(print_r(sqlsrv_errors()));
header('location:mesas.php?confirm=1');
}else{
    header('location:mesas.php');
}
?>