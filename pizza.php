<!DOCTYPE HTML>
<html>
<?php
session_start();


/*Carrinho*/

//initialize cart if not set or is unset
if(!isset($_SESSION['cart'])){
	$_SESSION['cart'] = array();
}

//unset qunatity
unset($_SESSION['qty_array']);

#$servername = "ERCERC-0E66ECC8";
$servername = "DESKTOP-1DOM035\SQLEXPRESS";

$connectinfo = array( "Database"=>"smartmeal");
$conn = sqlsrv_connect($servername,$connectinfo);

if($conn){
    #echo "coneection bom" . "<br>";
}else{
    die( print_r( sqlsrv_errors(), true));
}
$tsql= "SELECT id_produto,Nomeproduto,Descricao,preco from produto join Categoria on Produto.id_categoria=Categoria.id_categoria where nome='Pizzas'";
$tsql2= "SELECT id_produto,Nomeproduto,preco from produto join Categoria on Produto.id_categoria=Categoria.id_categoria where nome='Batata'";
$tsql3= "SELECT id_produto,Nomeproduto,preco from produto join Categoria on Produto.id_categoria=Categoria.id_categoria where nome='Bebidas'";
$tsql4= "SELECT id_produto,Nomeproduto,preco from produto join Categoria on Produto.id_categoria=Categoria.id_categoria where nome='Entradas'";
$getResults= sqlsrv_query($conn, $tsql) or die(print_r(sqlsrv_errors()));
$getResults2= sqlsrv_query($conn, $tsql2) or die(print_r(sqlsrv_errors()));
$getResults3= sqlsrv_query($conn, $tsql3) or die(print_r(sqlsrv_errors()));
$getResults4= sqlsrv_query($conn, $tsql4) or die(print_r(sqlsrv_errors()));


if(isset($_SESSION['message'])){
	echo "<div class='alert alert-danger'>
	<a href='#' class='close' data-dismiss='alert'>&times;</a>
	<i>ERRO!</i> Produto já no carrinho!
</div>";
}
unset($_SESSION['message']);
?>
	<head>
		<title>Pizzas</title>
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
				  </svg></button><span><?php echo count($_SESSION['cart']); ?></span>
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

            <div id="main" class="container">
                <!-- Form -->
								<h3 style="text-align:center;">Pizza</h3>
								<hr />
								<form method="post" action="addcart.php">
									<div class="row uniform">
											
										<!-- Break -->
										<div class="12u$">
											<div class="select-wrapper">
												<p>Tipo de Pizza</p>
												<select name="category" id="category" required="required">
												<option value="">- Selecionar -</option>
													<?php while($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)){ ?>
													<option value="<?php echo $row['id_produto']; ?>"><?php echo $row['Nomeproduto'] . " --> " . $row['Descricao'] . " " . $row['preco'] . "$";?></option>
													<?php } ?>
												</select>
												<p>Batata</p>
												<select name="category2" id="category2" required="required">
													<option value="">- Selecionar -</option>
													<?php while($row2 = sqlsrv_fetch_array($getResults2, SQLSRV_FETCH_ASSOC)){ ?>
													<option value="<?php echo $row2['id_produto']; ?>"><?php echo $row2['Nomeproduto'] . " " . $row2['preco'] . "$";?></option>
													<?php } ?>
													<option value="Sem Batata">Sem Batata</option>
												</select>
												<p>Bebida</p>
												<select name="category3" id="category3" required="required">
												<option value="">- Selecionar -</option>
													<?php while($row3 = sqlsrv_fetch_array($getResults3, SQLSRV_FETCH_ASSOC)){ ?>
													<option value="<?php echo $row3['id_produto']; ?>"><?php echo $row3['Nomeproduto'] . " " . $row3['preco'] . "$" ?></option>
													<?php } ?>
												</select>
												<p>Acompanhamentos</p>
												<select name="category4" id="category4" required="required">
													<option value="">- Selecionar -</option>
													<?php while($row4 = sqlsrv_fetch_array($getResults4, SQLSRV_FETCH_ASSOC)){ ?>
													<option value="<?php echo $row4['id_produto']; ?>"><?php echo $row4['Nomeproduto'] . " " . $row4['preco'] . "$"?></option>
													<?php } ?>
												</select>
											</div>
										</div>
										<!-- Break -->
										<div class="4u 12u$(small)">
											
										</div>
										<div class="4u 12u$(small)">
											
										</div>	
										<!-- Break -->
										<div class="12u$">
										<p>Detalhes do seu pedido <style> p{font-family:"Open Sans", Arial, Helvetica, sans-serif ; font-size: 25px; margin: 0 0 0 0;}</style></p> 
											<textarea name="message" id="message" placeholder="Escreva aqui os detalhes" rows="6"></textarea>
										</div>
										<div class="4u 12u$(small)">
											<input type="radio" id="priority-low" name="priority" value="Para comer no restaurante" checked>
											<label for="priority-low">Para comer no restaurante</label>
										</div>
										<div class="4u 12u$(small)">
											<input type="radio" id="priority-normal" name="priority" value="Para levar">
											<label for="priority-normal">Para levar</label>
										</div>
										<!-- Break -->
										<div class="12u$">
											<ul class="actions">
												<li><input type="submit" value="Adicionar ao Pedido" /></li>
												<li><input type="reset" value="Resetar Pedido" class="alt" /></li>
											</ul>
											<ul class="actions">
												<!--<li><a href="#" class="button special big">+ Acrescentar ao pedido</a></li>-->
											</ul>	
										</div>
										
									</div>
								</form>

								<hr />

								


</code></pre>

						</div>
					</div>

			</div>
			</div>
			
			<!--Modal-->
<style>
	.modal{
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
		<style>
		th{
			color:black;
		}
		</style>
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
									<?php $total += $_SESSION['qty_array'][$index]*$row5['preco']; ?>
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
		 <button type="button" class="btn btn-primary text-decoration-none" role="button" aria-pressed="true">Gerar Pedido</button>
		 <button type="submit" class="btn btn-success" name="save">Salvar</button>
		 <a href="allcard.php" class="btn btn-danger text-decoration-none" role="button" aria-pressed="true">LIMPAR</a>
			</form>
		</div>
		<div class="modal-footer">
		 <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
		 <a href="#" class="btn btn-primary text-decoration-none" role="button" aria-pressed="true">Gerar Pedido</a>-->
		</div>
	  </div>
	</div>
  </div>
	

    </body>

	<!--Scripts-->
			<script src="assets/js/app.js"></script>
            <script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
			<script src="assets/js/pace.min.js"></script>
	<!--Scripts Bootstrap-->
			<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
			<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
			<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

</html>