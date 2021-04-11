<?php

session_start();

if(isset($_SESSION['mesaconfirm'])){
    $mesa = $_SESSION['mesa'];
}

$_SESSION['priority'] = $_POST['priority'];
$_SESSION['category'] = $_POST['category'];
$_SESSION['category2'] = $_POST['category2'];
$_SESSION['category3'] = $_POST['category3'];
$_SESSION['category4'] = $_POST['category4'];
header('location:pizza.php');
$paragrafo2 = '<p>' . 'Pedido: ' . " " . " " . '<b>' . $pedido1 . ", " . $pedido2 . " " . $pedido3 . '</b>' .'</p>';
$paragrafo3 = '<p>' . 'O pedido vai ser ' . '<b>' . $estado . '<b>' .' Mesa: ' . $mesa . '<p>';
echo $paragrafo2,$paragrafo3;




?>