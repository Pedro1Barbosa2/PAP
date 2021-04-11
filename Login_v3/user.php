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

#$db = "smartmeal";
#$host = "localhost:3306";
#$user = "root";
#pass = "";
#$con = mysqli_connect($host,$user,$pass,$db) or die ("Sem conexão ao servidor");

        $servername = "DESKTOP-1DOM035\SQLEXPRESS";

        $connectinfo = array( "Database"=>"smartmeal");
        $conn = sqlsrv_connect($servername,$connectinfo);

        if($conn){
            #echo "coneection bom" . "<br>";
        }else{
            die( print_r( sqlsrv_errors(), true));
        }


/*$query = "SELECT * FROM `login` WHERE  nick = '$nick'";

$result = mysqli_query($con,$query);

$dados = mysqli_fetch_array($result);

$email = $dados['email'];
$pass = $dados['pass'];
$id = $dados['id'];
$_SESSION['id'] = $id;*/

$sql = "SELECT * FROM user_login WHERE nick='$nick'";
$stmt = sqlsrv_query($conn,$sql);
if( $stmt === false) {
    die( print_r( sqlsrv_errors(), true) );
}

while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
    $email = $row['email'];
    $nick = $row['nick'];
    $pass = $row['password'];
    $id = $row['id'];
}
$_SESSION['id'] = $id;

if(empty($email)){
    $email = "Sem dados";
}else if(empty($nick)){
    $nick = "Sem dados";
}else if(empty($pass)){
    $pass = "Sem dados";
}


?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - admin</title>
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
            <li class="active">
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
        <section class="contact">
            <div class="content">
                <h2>Meu Perfil</h2>
                <p>Aqui voce pode mudar o seu perfil.</p>
            </div>
            <div class="corpo">
                <div class="info">
                    <div class="box">
                        <div class="icone"><i class="fa fa-user" aria-hidden="true"></i></div>
                        <div class="text">
                            <h3>Nick</h3>
                            <p><?php echo $nick ?></p>
                        </div>
                    </div>
                    <div class="box">
                        <div class="icone"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                        <div class="text">
                            <h3>Email</h3>
                            <p><?php echo $email ?></p>
                        </div>
                    </div>
                    <div class="box">
                        <div class="icone"><i class="fa fa-unlock-alt" aria-hidden="true"></i></div>
                        <div class="text">
                            <h3>Password</h3>
                            <p id="senhaa"></p><input id="in" type="checkbox" onclick="mostrartexto();"></input>
                        </div>
                    </div>
                </div>
                <div class="editform">
                    <form method="post" action="edit.php">
                        <h2>Editar os dados.</h2>
                        <div class="inputbox">
                            <input type="text" name="nick" required="required">
                            <span>Novo Nick.</span>
                        </div>
                        <div class="inputbox">
                            <input type="text" name="email" required="required">
                            <span>Novo Email.</span>
                        </div>
                        <div class="inputbox">
                            <input type="password" name="pass" id="pass" required="required">
                            <span>Nova Password.</span>
                        </div>
                        <input type="checkbox" onclick="mostrarsenha();"> Mostrar Senha</input>
                        <div class="inputbox">
                            <input type="submit" name="" value="Editar">
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script type="text/javascript">
        $(document).on('click','.navigation ul li', function(){
            $(this).addClass('active').siblings().removeClass('active')
        });

        function mostrarsenha(){
            var tipo = document.getElementById('pass');
            if(tipo.type == "password"){
                tipo.type = "text";
            }else{
                tipo.type = "password";
            }
        }

        function mostrartexto(){
            document.getElementById("senhaa").innerHTML="<?php echo "$pass"; ?>";
                var checkBox = document.getElementById("in");
                var text = document.getElementById("senhaa");
                if (checkBox.checked == true){
                    text.style.display = "block";
                } else {
                    text.style.display = "none";
                }
        }
        
    </script>
</body>
</html>