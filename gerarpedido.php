<?php

session_start();

    $servername = "DESKTOP-1DOM035\SQLEXPRESS";

	$connectinfo = array( "Database"=>"smartmeal");
	$conn = sqlsrv_connect($servername,$connectinfo);

	if($conn){
		#echo "coneection bom" . "<br>";
	}else{
		die( print_r( sqlsrv_errors(), true));
	}
$hora = date("H:i:s");
$data = date("Y-m-d");
$mesa = $_SESSION['mesaconfirm'];
if(!empty($_SESSION['cart'])){
	$tsql2 = "SELECT max(id_pedido) as id_pedido from pedido";
	$getResult2 = sqlsrv_query($conn, $tsql2) or die(print_r(sqlsrv_errors()));
	while($row2 = sqlsrv_fetch_array($getResult2, SQLSRV_FETCH_ASSOC)){
		$idped = $row2['id_pedido'];
		$idped ++;
		$_SESSION['idpedido'] = $idped;		 
	}
                        $total = 0;
						if(!empty($_SESSION['cart'])){
 						$index = 0;
 						if(!isset($_SESSION['qty_array'])){
 							$_SESSION['qty_array'] = array_fill(0, count($_SESSION['cart']), 1);
 						}
						$tsql5= "SELECT id_produto,Nomeproduto,preco from produto where id_produto IN (".implode(',',$_SESSION['cart']).")";
						$getResult5= sqlsrv_query($conn, $tsql5) or die(print_r(sqlsrv_errors()));
						$total = $_SESSION['totalvalor'];
						$tsql6 ="INSERT into pedido(mesa,dia,Hora,Total,Estado) values ($mesa,'$data','$hora',$total,'Em processamento')";
                        $insertresults6 = sqlsrv_query($conn, $tsql6) or die(print_r(sqlsrv_errors()));
							while($row5 = sqlsrv_fetch_array($getResult5, SQLSRV_FETCH_ASSOC)){
									$idprod = $row5['id_produto'];
		                            $prod = $row5['Nomeproduto'];
									$prec = number_format($row5['preco'], 2);
									$qty = $_SESSION['qty_array'][$index];
									$subtotal = number_format($_SESSION['qty_array'][$index]*$row5['preco'], 2);
									$tsql7 = "INSERT into detalhepedido(id_produto,id_pedido,quantidade,subtotal) values ($idprod,$idped,$qty,$subtotal)";
									$insertresults7 = sqlsrv_query($conn, $tsql7) or die(print_r(sqlsrv_errors()));
									header("location:index.php?mesa=$mesa&pedido=1");
								$index ++;
							}
						}
						$total = 0;

}else{
    header("location:index.php?mesa=$mesa&&error=1");
}

?>