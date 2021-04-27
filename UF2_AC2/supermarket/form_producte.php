<?php
	require "header.php";
	require "config.php";
	if (!empty($_POST))
	{
		//Variables POST
		$codi =  $_POST["codi"];
		$nomProd =  $_POST["nom"];
		$categoria = 0;
		if (!empty($_POST["categoria"])) 
		{
			$categoria = $_POST["categoria"];
		}
		$preu =  $_POST["preu"];
		$unitatsStock =  $_POST["stock"];
		//Imatge
		if (!empty($_FILES)) 
		{
			$imatge = $_FILES["imatge"]["name"];
			$rutaTmp = $_FILES["imatge"]["tmp_name"];
			$extensio = substr($imatge, strpos($imatge, "."));
			if(!empty($_POST["codi"]) && !empty($extensio))
			{
				$novaURL = "images/productes/$codi$extensio";
			}
			else
			{
				$novaURL = "images/productes/no-image.png";
			}
			
			move_uploaded_file($rutaTmp, "./images/productes/$codi$extensio");
		}
		//Insert
		$sql = "INSERT INTO productes (codi, categoria, nom, preu, unitats_stock, imatge) 
				VALUES ('$codi', $categoria, '$nomProd', $preu, $unitatsStock, 'images/productes/$codi$extensio')";
		
		//
		$result = $conn->query($sql);
		if($result)
		{
			//Si hi ha resultat, l'INSERT s'ha fet correctament
			$insertOk = 1;
		}
		else
		{
			//No s'ha fet l'INSERT correctament
			$error = 1;
		}
	}
?>
		<div class="container m-5 mx-auto text-white">
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
				<div class="row">
					<div class="col-4 offset-2">
						<?php
							//Consultar el punt 11
							if (!empty($_GET["codi"])) 
							{
								$codi = $_GET["codi"];
								$sql = "SELECT * FROM productes WHERE codi = '$codi'";
								$result = $conn->query($sql);
								if($result)
								{
									//Si hi ha producte amb ek codi X
									$row = $result->fetch_assoc();
									$nomProd= $row["nom"];
									$categoria= $row["categoria"];
									$preu = $row["preu"];
									$unitatsStock= $row["unitats_stock"];
									$novaURL= $row["imatge"];
								}
							}

							if (isset($error)) 
							{
								echo "<div class=\"alert alert-danger\" role=\"alert\">
										  Error en afegir el producte
										</div>";
							}
							if (isset($insertOk))
							{
								echo "<div class=\"alert alert-primary\" role=\"alert\">
										  El producte s'ha afegit correctament
										</div>";
							}
						?>
						<div class="form-group">
							<label for="codi">Codi:</label>
							<?php
								if (isset($codi)) 
								{
									echo "<input type=\"text\" class=\"form-control\" name=\"codi\" id=\"codi\" value=\"$codi\"/>";
								}
								else
								{
									echo "<input type=\"text\" class=\"form-control\" name=\"codi\" id=\"codi\"/>";
								}
							?>
							
						</div>
						<div class="form-group">
							<label for="nom">Nom:</label>
							<?php
								if (isset($nomProd)) 
								{
									echo "<input type=\"text\" class=\"form-control\" name=\"nom\" id=\"nom\" value=\"$nomProd\"/>";
								}
								else
								{
									echo "<input type=\"text\" class=\"form-control\" name=\"nom\" id=\"nom\"/>";
								}
							?>
						</div>
						<div class="form-group">
							<label for="categoria">Categoria:</label>
							<select class="form-control" name="categoria" id="categoria">
								<option value="" selected disabled hidden>Selecciona una opció</option>
								<?php
									//
									$sql = "SELECT id_categoria, nom FROM categories ORDER BY nom";
									//
									$result = $conn->query($sql);

									if ($result) 
									{
										if ($result->num_rows > 0) 
										{
											$row = $result->fetch_assoc();
											while($row) 
											{
												$id_cat = $row["id_categoria"];
												$nom = $row["nom"];
												if(isset($categoria))
												{
													if ($categoria == $id_cat) 
													{
														echo "<option value=\"$id_cat\" selected>$nom</option>";
													}
													else
													{
														echo "<option value=\"$id_cat\">$nom</option>";
													}
												}
												else
												{
													echo "<option value=\"$id_cat\">$nom</option>";
												}
												$row = $result->fetch_assoc();
											}
										}
										else
										{
											//No s'han trobat categories
										}
									}
								?>
							</select>
						</div>
						<div class="form-group">
							<label for="preu">Preu:</label>
							<?php
								if (isset($preu)) 
								{
									echo "<input type=\"text\" class=\"form-control\" name=\"preu\" id=\"preu\" value=\"$preu\"/>";
								}
								else
								{
									echo "<input type=\"text\" class=\"form-control\" name=\"preu\" id=\"preu\"/>";
								}
							?>
						</div>
						<div class="form-group">
							<label for="stock">Unitats en stock:</label>
							<?php
								if (isset($unitatsStock)) 
								{
									echo "<input type=\"text\" class=\"form-control\" name=\"stock\" id=\"stock\" value=\"$unitatsStock\"/>";
								}
								else
								{
									echo "<input type=\"text\" class=\"form-control\" name=\"stock\" id=\"stock\"/>";
								}
							?>
						</div>
						<div class="form-group text-right">
							<a href="productes.php" class="btn btn-outline-secondary mx-2">Tornar</a>
							<button type="submit" class="btn btn-default">Guardar</button>
						</div>
					</div>
					<div class="col-4">
						<div class="form-group">
							<label for="imatge">Imatge:</label>
							<input type="file" class="form-control" name="imatge" id="imatge" />
						</div>
						<div class="text-center">
							<?php
								if (isset($novaURL)) 
								{
									echo "<img src=\"$novaURL\" class=\"img-thumbnail\" style=\"height: 250px;\" />";
								}
								else
								{
									echo "<img src=\"images/productes/no-image.png\" class=\"img-thumbnail\" style=\"height: 250px;\" />";
								}
								$conn->close();
							?>
							
						</div>
					</div>
				</div>
			</form>
		</div>
	</body>
</html>
