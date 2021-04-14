<!DOCTYPE HTML>
<html>
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

$pedidoid = $_SESSION['idpedido'];

$tsql= "SELECT estado from pedido where id_pedido=$pedidoid";
$getResults= sqlsrv_query($conn, $tsql) or die(print_r(sqlsrv_errors()));


    ?>
	<head>
		<title>Ementa</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="icon" href="images/logoatual.png">
	</head>
	<body class="subpage">

		<!-- Header -->
			<header id="header" class="alt">
				<div class="logo"><a href="<?php if(isset($_SESSION['mesaconfirm'])){$mesa = $_SESSION['mesaconfirm']; echo "index.php?mesa=$mesa";}else{echo "index.php";} ?>">Smart Meal <span>by Pedro Barbosa</span></a></div>
				<button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#exampleModal"><svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-cart3" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
					<path fill-rule="evenodd" d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
				  </svg></button><?php echo count($_SESSION['cart']); ?>
				<a href="#menu"><span>Menu</span></a>
			</header>

		<!-- Nav -->
			<nav id="menu">
				<ul class="links">
					<li><a href="<?php if(isset($_SESSION['mesaconfirm'])){$mesa = $_SESSION['mesaconfirm']; echo "index.php?mesa=$mesa";}else{echo "index.php";} ?>">Home</a></li>
					<li><a href="generic.php">Prato do dia</a></li>
					<li><a href="elements.php">Realizar Pedido</a></li>
				</ul>
			</nav>

        <!-- Body -->

        <?php
		 while($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)){
			 $estado = $row['estado'];
		 }
		?>

		<h1>O seu pedido está</h1>
		<?php echo "<p>$estado</p>";?>

		<!--Modal-->
<style>
	.modal{
		z-index: 100000 !important;	
	}
	.alert{
        z-index: 100000 !important;	
    }
</style>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
	  <div class="modal-content">
		<div class="modal-header">
		  <h2 class="modal-title text-dark text-center" id="exampleModalLabel">O seu pedido<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-cart3" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
			<path fill-rule="evenodd" d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
		  </svg></h2>
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		</div>
		<div class="modal-body text-dark">
		<form method="POST" action="salvar.php">
			<table class="table table-bordered table-striped">
				<thead>
					<th style="color:black; text-align:center;">Mesa</th>
				</thead>
				<tbody>
					<tr>	
						<td style="color:black; text-align:center;"><?php echo $mesa; ?></td>
					</tr>
				</tbody>
			</table>
			<table class="table table-bordered table-striped">
				<thead>
					<th style="color:black; font-size:13px;"></th>
					<th style="color:black; font-size:13px;">Nome</th>
					<th style="color:black; font-size:13px;">Preço</th>
					<th style="color:black; font-size:13px;">Quant</th>
					<th style="color:black; font-size:13px;">Subtot</th>
				</thead>
				<tbody>
					<?php
						//initialize total
						$total = 0;
						if(!empty($_SESSION['cart'])){
						//connection
						
						//create array of initail qty which is 1
 						$index = 0;
 						if(!isset($_SESSION['qty_array'])){
 							$_SESSION['qty_array'] = array_fill(0, count($_SESSION['cart']), 1);
 						}
						 $tsql5= "SELECT id_produto,Nomeproduto,preco from produto where id_produto IN (".implode(',',$_SESSION['cart']).")";
						 $getResult5= sqlsrv_query($conn, $tsql5) or die(print_r(sqlsrv_errors()));
							while($row5 = sqlsrv_fetch_array($getResult5, SQLSRV_FETCH_ASSOC)){
								?>
								<tr>
								
									<td>
										<a href="deleteitem.php?id=<?php echo $row5['id_produto']; ?>&index=<?php echo $index; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i></span></a>
									</td>
									<td><?php echo $row5['Nomeproduto']; ?></td>
									<td><?php echo number_format($row5['preco'], 2); ?></td>
									<input type="hidden" name="indexes[]" value="<?php echo $index; ?>">
									<td><input type="text" class="form-control" value="<?php echo $_SESSION['qty_array'][$index]; ?>" name="qty_<?php echo $index; ?>"></td>
									<td><?php echo number_format($_SESSION['qty_array'][$index]*$row5['preco'], 2); ?></td>
									<?php $_SESSION['totalvalor'] = $total += $_SESSION['qty_array'][$index]*$row5['preco']; ?>
								</tr>
								<?php
								$index ++;
							}
						}
						else{
							?>
							<tr>
								<td colspan="5" class="text-center">Carrinho vazio</td>
							</tr>
							<?php
						}

					?>
					<tr>
						<td colspan="4" align="right"><b style="color:black">Total</b></td>
						<td><b style="color:black"><?php echo number_format($total, 2); ?></b></td>
					</tr>
				</tbody>
			</table>
			<button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
			<a href="gerarpedido.php" class="btn btn-primary text-decoration-none" role="button" aria-pressed="true">Gerar Pedido</a>
		 <button type="submit" class="btn btn-success" name="save">Salvar</button>
		 <a href="allcard.php" class="btn btn-danger text-decoration-none" role="button" aria-pressed="true">LIMPAR</a>
			</form>
		</div>
		<div class="modal-footer">
		  <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
		 <a href="validapedido.php" class="btn btn-primary text-decoration-none" role="button" aria-pressed="true">Gerar Pedido</a>
		</div>
	  </div>
	</div>
  </div>

	
		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
			<script src="assets/js/pace.min.js"></script>
		<!--BootStrap-->
			<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
			<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
			<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>


	</body>
</html>