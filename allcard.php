<?php
	session_start();
	unset($_SESSION['cart']);
	header(sprintf('location: %s', $_SERVER['HTTP_REFERER']));
?>