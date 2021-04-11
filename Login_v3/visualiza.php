<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
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
    
    $query = "SELECT Pedidoo FROM `pedido` WHERE id = $id";
    $result = mysqli_query($con,$query);

    $dados = mysqli_fetch_array($result);
    $pedido =  $dados['Pedidoo'];
    }else{
        header('location:homeadmin.php');
    }*/
} 
        #$servername = "ERCERC-0E66ECC8";
        $servername = "DESKTOP-1DOM035\SQLEXPRESS";

        $connectinfo = array( "Database"=>"smartmeal");
        $conn = sqlsrv_connect($servername,$connectinfo);

        if($conn){
            #echo "coneection bom" . "<br>";
        }else{
            die( print_r( sqlsrv_errors(), true));
        }
        $tsql= "SELECT nomeproduto,subtotal,quantidade,Pedido.total from produto join detalhepedido on produto.id_produto=detalhepedido.id_produto join Pedido on Pedido.id_pedido=Detalhepedido.id_pedido where Pedido.id_pedido=$id";
        $getResults= sqlsrv_query($conn, $tsql) or die(print_r(sqlsrv_errors()));
        $getResults2= sqlsrv_query($conn, $tsql) or die(print_r(sqlsrv_errors()));

        while($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)){
            $total = $row['total'];
         }

    ?>
    
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'poppins', sans-serif;
        }
            body{
                background: linear-gradient(to right, #ff416c, #ff4b2b);
            }

            .container {
                width: 90%;
                margin: 50px auto;
            }
            .head {
                text-align:center;
                font-size:30px;
                margin-bottom:50px;
            }
            .row{
                display:flex;
            }
            .pedido{
                    width:100%;
                    background:#fff;
                    border: 1px solid #ccc;
                    margin-bottom:50px;
                    transition:0.3s;
            }
            .pedido-head{
                text-align:center;
                padding:50px 10px;
                margin-top:10px;
                background: linear-gradient(to right, #ff416c, #ff4b2b);
                color: #fff;
            }
            .corpo{
                padding:30px 20px;
                text-align:center;
                font-size:18px;
            }
            .corpo .buttonconfirm{
                text-align:center;
            }
            .pedido:hover{
                transform:scale(1.05);
                box-shadow: 0 0 40px -10px rgba(0,0,0,0.25);
            }
            .buttonconfirm{
                color:#FF6347;
                font-weight: 100;
                text-align: center;
                border: solid 2px #FF6347;
                border-radius: 10px;
                padding: 5px 25px;
                -webkit-transition-duration: 200ms;
                transition-duration: 200ms;
                text-decoration:none;
            }

            .buttonconfirm:hover{
                background-color: #ff4040;
                color: #fff;
            }
            .h1{
                color:#FF6347;
                font-weight: 100;
                text-align: center;
                border: solid 2px #FF6347;
                border-radius: 15px;
                padding: 5px 25px;
                background: linear-gradient(to right, #ff416c, #ff4b2b);
                color: #fff;
            }
           
            @media (max-width:500px){
                .container{
                    width: 100%;
                    
                }
                .head{
                    padding:20px;
                    font-size:20px;
                }
                .pedido{
                    width:80%;
                    margin-left:40px;
                }
            }

    </style>
    <div class="container">
        <div class="head">
            <h1 class="h1">Confirme o Pedido</h1>
        </div>
    <div class="row">
        <div class="pedido">
            <div class="pedido-head">
                <h1>Pedido</h1>
            </div>
            <div class="corpo">
                <?php while($row2 = sqlsrv_fetch_array($getResults2, SQLSRV_FETCH_ASSOC)){ ?>
                    <p><?php echo "Quantidade: " . $row2['quantidade'] . "<br> " . "Produto/s: " . $row2['nomeproduto']. " " . $row2['subtotal'] ."€". "<br> "; } echo "Total: " . $total;?></p>
                    <a href="mesas.php" class="buttonconfirm">Voltar</a>
            </div>
        </div>
    </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
</body>
</html>