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

        $servername = "DESKTOP-1DOM035\SQLEXPRESS";

        $connectinfo = array( "Database"=>"smartmeal");
        $conn = sqlsrv_connect($servername,$connectinfo);

        if($conn){
            #echo "coneection bom" . "<br>";
        }else{
            die( print_r( sqlsrv_errors(), true));
        }

        $tsql= "UPDATE user_login SET nick='$nome', email='$email', password='$senha' WHERE id='$id' ";
        $params = array("updated data", 1);
        $stmt = sqlsrv_query($conn,$tsql,$params);
        $rows_affected = sqlsrv_rows_affected( $stmt);

        if($rows_affected === false){
            die( print_r( sqlsrv_errors(), true));
       }else if( $rows_affected == -1){
                unset($_SESSION['nick']);
                unset($_SESSION['senha_login']);
                header('Refresh: 5;url=login.php');
       }else{
                echo "Está a ser redirecionado para a página de login, por favor inicie sessão novamente....";
                unset($_SESSION['nick']);
                unset($_SESSION['senha_login']);
                header('Refresh: 5;url=login.php?sucess=1');
       }

        /*if($insertresults){
            echo "Está a ser redirecionado para a página de login, por favor inicie sessão novamente....";
            unset($_SESSION['nick']);
            unset($_SESSION['senha_login']);
            header('Refresh: 5;url=login.php?sucess=1');
        }else{
            unset($_SESSION['nick']);
            unset($_SESSION['senha_login']);
            header('Refresh: 5;url=login.php');
        }*/


?>