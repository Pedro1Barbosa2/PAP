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

$servername = "DESKTOP-1DOM035\SQLEXPRESS";

$connectinfo = array( "Database"=>"smartmeal");
$conn = sqlsrv_connect($servername,$connectinfo);

if($conn){
	#echo "coneection bom" . "<br>";
}else{
	die( print_r( sqlsrv_errors(), true));
}




?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedido</title>
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
            <li>
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
            <li class="active">
                <a href="pedido.php">
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
    <!-- -->
    <div class="container">
                <div class="heading">
                    <h1>Pedido</h1>
                </div>
                <div class="row">
                    <div class="card">
                        <div class="card-header">
                            <h1>Churrasco</h1>
                        </div>
                        <div class="card-body">
                            <p>Escolha aqui o tipo de churrasco.</p>
                            <a href="/pap/churrasco.php" class="buttonconfirm">Clicar</a>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h1>Pizzas</h1>
                        </div>
                        <div class="card-body">
                            <p>Escolha aqui o tipo de pizza.</p>
                            <a href="/pap/pizza.php" class="buttonconfirm">Clicar</a>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h1>Massas</h1>
                        </div>
                        <div class="card-body">
                            <p>Escolha aqui o tipo de massa.</p>
                            <a href="#" class="buttonconfirm">Clicar</a>
                        </div>
                    </div>
                </div>
 <!-- -->
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script type="text/javascript">
        $(document).on('click','.navigation ul li', function(){
            $(this).addClass('active').siblings().removeClass('active')
        });
    </script>
</body>
</html>