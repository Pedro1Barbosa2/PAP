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



?>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - admin</title>
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
            <li>
                <a href="#">
                    <span class="icon"><i class="fa fa-cutlery" aria-hidden="true"></i></span>
                    <span class="title">Pedido</span>
                </a>
            </li>
            <li class="active">
                <a href="menu.php">
                    <span class="icon"><i class="fa fa-book" aria-hidden="true"></i></span>
                    <span class="title">Menu</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="container">
        <div class="menuform">
                <h1 class="h1menu">Prato do dia</h1>
                <div class="border1"></div>
                <form class="menu-form" action="menusend.php" method="post">
                <input name="data" class="menudate" id="data" type="date" value="<?php echo date('Y-m-d'); ?>"><input name="hora" class="menuhour" id="hora" type="time" value="<?php echo date('H:i:s'); ?>">
                <textarea name ="menu" class="textaarea" id="menu" rows="6" placeholder="Escreva o prato do dia aqui" required="required"></textarea>
                <input class="formbtn" type="submit" value="Enviar">
                </form>
                <p style="color:green;"><?php if(isset($_GET['sucess'])){echo "Enviado com sucesso.";} ?></p>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script type="text/javascript">
        $(document).on('click','.navigation ul li', function(){
            $(this).addClass('active').siblings().removeClass('active')
        });
    </script>
</body>
</html>