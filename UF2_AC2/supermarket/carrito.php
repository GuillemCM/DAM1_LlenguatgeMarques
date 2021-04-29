<?php
	require "header.php";
	require "config.php";
	include "common/carrito.php";

	if (!empty($_GET)) 
	{
		$codiEliminar = $_GET["codi"];
		if (!empty($codiEliminar)) 
		{
			eliminarProducte($codiEliminar);
		}
	}

	if (!empty($_POST)) 
	{	
		$pAfegit = false;
		$codi = $_POST["codi"];
		$quantitat = $_POST["quantitat"];
		$sql = "SELECT nom, preu FROM productes WHERE codi = '$codi'";
		$result = $conn->query($sql);
		if ($result) 
		{
			$row = $result->fetch_assoc();
			$nombre = $row["nom"];
			$preu = $row["preu"];
			//Afegir producte
			if (!empty($nombre) && !empty($preu)) 
			{
				afegirProducte($codi, $nombre, $preu, $quantitat);
			}
		}
	}
?>
		<div class="container m-5 mx-auto">
			<div class="col-8 offset-2">
				<h3 class="text-white">Contingut del carrito</h3>
				<table class="table">        
					<tr> 
						<th>Producte</th> 
						<th class="text-right">Preu</th>
						<th class="text-right">Unitats</th>
						<th class="text-right">Import</th>
						<th class="text-right"></th>
					</tr>
					<?php
						$count_i = count($_SESSION["carrito"]);
						for ($i=0; $i < $count_i; $i++) 
						{ 
							$codi = $_SESSION["carrito"][$i]["codi"];
							$nom = $_SESSION["carrito"][$i]["nom"];
							$preu = $_SESSION["carrito"][$i]["preu"];
							$quantitat = $_SESSION["carrito"][$i]["quantitat"];
							$importProducte = importProducte($codi);
							echo"<tr> 
									<td class=\"align-middle\">
										$nom
									</td>
									<td class=\"align-middle text-right\">$preu €</td>
									<td class=\"align-middle text-right\">$quantitat u.</td>
									<td class=\"align-middle text-right\">$importProducte €</td>
									<td class=\"align-middle text-right\">
										<a href=\"carrito.php?codi=$codi\" class=\"btn btn-primary\"><i class=\"fas fa-trash-alt\"></i></a>
									</td>
								</tr>";
						}
					?>
					<tr class="bg-info"> 
						<th colspan="3" scope="row" class="text-right">							
							Import total
						</td>
						<td class="align-middle text-right"><?php echo importTotal(); $conn->close();?> €</td>
						<td></td>
					</tr>
				</table>
				<div class="text-right">
					<a href="comprar.php" class="btn btn-outline-secondary mx-2">Afegir més productes</a>
					<a href="index.php" class="btn btn-secondary">Finalitzar la compra</a>
				</div>
			</div>
		</div>
	</body>
</html>
