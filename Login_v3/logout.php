<?php

session_start();
unset($_SESSION['nick']);
unset($_SESSION['senha_login']);
header('location:login.php');

?>