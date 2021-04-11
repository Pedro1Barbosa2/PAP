<!DOCTYPE html>
<html lang="pt">
<head>
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

/*
$db = "smartmeal";
$host = "localhost:3306";
$user = "root";
$pass = "";
$con = mysqli_connect($host,$user,$pass,$db) or die ("Sem conexão ao servidor");

$query = "SELECT * FROM `pedido`";

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
$tsql= "SELECT id_pedido,mesa,dia,hora,estado,total from Pedido";
$tsql2= "select count(id_pedido) as quantidade from pedido";
$getResults2= sqlsrv_query($conn,$tsql2) or die(print_r(sqlsrv_errors()));
$getResults= sqlsrv_query($conn, $tsql) or die(print_r(sqlsrv_errors()));


?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="30; URL='../Login_v3/mesas.php">
    <title>Mesas - admin</title>
    <link rel="icon" href="images\logoatual.png">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/main2.css">
</head>
<body>
<nav class="nav">
    <div class="titulo"><a href="homeadmin.php">Smart Meal</a></div>
        <ul>
        <li>
                <a><i class="fa fa-user" aria-hidden="true"></i></a><a><?php echo $nick ?></a>
                <ul>
                    <li><a href="user.php">Meu Perfil</a></li>
                    <li><a href="logout.php">Logout <i class="fa fa-sign-out" aria-hidden="true"></i></a></li>             
                </ul>
        </li>
        </ul>
</nav>
    <div class="navigation">
        <ul>
            <li>
                <a href="homeadmin.php">
                    <span class="icon"><i class="fa fa-home" aria-hidden="true"></i></span>
                    <span class="title">Home</span>
                </a>
            </li>
            <li class="active">
                <a href="mesas.php">
                    <span class="icon"><i class="fa fa-table" aria-hidden="true"></i></span>
                    <span class="title">Mesas</span>
                </a>
            </li>
            <li>
                <a href="user.php">
                    <span class="icon"><i class="fa fa-user" aria-hidden="true"></i></span>
                    <span class="title">Perfil</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <span class="icon"><i class="fa fa-cutlery" aria-hidden="true"></i></span>
                    <span class="title">Pedido</span>
                </a>
            </li>
            <li>
                <a href="menu.php">
                    <span class="icon"><i class="fa fa-book" aria-hidden="true"></i></span>
                    <span class="title">Menu</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="container">
                <table class="table">
                <thead>
                    <th>Mesa</th>
                    <th>Pedido</th>
                    <th>Confirmar</th>
                    <th>Apagar</th>
                    <th>Hora</th>
                    <th>Estado</th>
                </thead>
                <tbody>
<?php

                    while($row2 = sqlsrv_fetch_array($getResults2,SQLSRV_FETCH_ASSOC)){
                        $numeroped = $row2['quantidade'];
                    }
                    echo "<h1>Foram achados " . $numeroped . " pedidos.</h1>";
                 while($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)){
                    $id = $row['id_pedido'];
                    $mesa = $row['mesa'];
                    echo "<tr><td data-label='Mesa'>" . $row['mesa'] . "</td><td data-label='Pedido'><a href='visualiza.php?id=$id' class='buttonconfirm'>Visualizar</a></td><td data-label='Confirmar'><a href='confirmaped.php?idped=$id' class='buttonconfirm'>Confirmar</a><td data-label='Apagar'><a href='apagar.php?id=$id' class='buttonconfirm'>Apagar</a></td></td><td data-label='Hora'>" . $row['hora']->format('H:i:s') . "</td> <td data-label='Estado'>" . $row['estado'] . "</td></tr>"; 
                 }
                 if(empty($mesa)){
                    echo "<h1>Por enquanto sem pedidos.</h1>";
                }
                
?>
                </tbody>
                </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script type="text/javascript">
        $(document).on('click','.navigation ul li', function(){
            $(this).addClass('active').siblings().removeClass('active')
        });
    </script>
</body>
</html>