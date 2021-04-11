<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    session_start();
    if(isset($_GET['id'])){
    $id = $_GET['id'];
    /*$db = "smartmeal";
    $host = "localhost:3306";
    $user = "root";
    $pass = "";
    $con = mysqli_connect($host,$user,$pass,$db) or die ("Sem conexão ao servidor");
    
    $query = "DELETE FROM `pedido` WHERE id = $id";
    $result = mysqli_query($con,$query);*/

    #$servername = "ERCERC-0E66ECC8";
    $servername = "DESKTOP-1DOM035\SQLEXPRESS";

    $connectinfo = array( "Database"=>"smartmeal");
    $conn = sqlsrv_connect($servername,$connectinfo);

    if($conn){
        #echo "coneection bom" . "<br>";
    }else{
        die( print_r( sqlsrv_errors(), true));
    }
    $tsql= "DELETE from detalhepedido where id_pedido=$id";
    $tsql2 = "DELETE from pedido where id_pedido=$id";
    $query = sqlsrv_query($conn, $tsql);
    $query2 = sqlsrv_query($conn,$tsql2);
    if ($query === false && $query2 === false){  exit("<pre>".print_r(sqlsrv_errors(), true));

    }
    sqlsrv_free_stmt($tsql);
    sqlsrv_free_stmt($tsql2);


    header('location:mesas.php');
    }else{
        header('location:mesas.php');
    }
    ?>
</body>
</html>