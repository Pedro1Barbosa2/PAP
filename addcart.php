<?php

session_start();

	//check if product is already in the cart
	if(!in_array($_POST['category'], $_SESSION['cart'])){
		array_push($_SESSION['cart'], $_POST['category']);
	}
	else{
		/*$_SESSION['message'] = "Produto ja no carrinho";*/
	}
    if(!in_array($_POST['category2'], $_SESSION['cart'])){
		array_push($_SESSION['cart'], $_POST['category2']);
	}
	else{
		/*$_SESSION['message'] = "Produto ja no carrinho";*/
	}
    if(!in_array($_POST['category3'], $_SESSION['cart'])){
		array_push($_SESSION['cart'], $_POST['category3']);
	}
	else{
		/*$_SESSION['message'] = "Produto ja no carrinho";*/
	}
    if(!in_array($_POST['category3'], $_SESSION['cart'])){
		array_push($_SESSION['cart'], $_POST['category3']);
	}
	else{
		/*$_SESSION['message'] = "Produto ja no carrinho";*/
	}
    if(!in_array($_POST['category4'], $_SESSION['cart'])){
		array_push($_SESSION['cart'], $_POST['category4']);
	}
	else{
		/*$_SESSION['message'] = "Produto ja no carrinho";*/
	}
    header(sprintf('location: %s', $_SERVER['HTTP_REFERER']));
?>