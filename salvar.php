<?php
	session_start();
	if(isset($_POST['save'])){
		foreach($_POST['indexes'] as $key){
			$_SESSION['qty_array'][$key] = $_POST['qty_'.$key];

		}
        header(sprintf('location: %s', $_SERVER['HTTP_REFERER']));
		
	}
?>
