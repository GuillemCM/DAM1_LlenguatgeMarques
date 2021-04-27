<?php
	require "header.php";
	require "config.php"
?>
		<div class="container m-5 mx-auto">
			<div class="col-8 offset-2">
				<table class="table">        
					<tr> 
						<th>Producte</th> 
						<th>Categoria</th>
						<th>Preu</th>
						<th></th>
					</tr>
					<?php
						$sql = "SELECT productes.codi, productes.nom as nomProd, categories.nom as nomCat, preu, imatge
								FROM productes
								INNER JOIN categories ON categories.id_categoria = productes.categoria";

						$result = $conn->query($sql);
						if($result)
						{
							if ($result->num_rows > 0)
							{
								$row = $result->fetch_assoc();
								while($row) 
								{
									$codi_producte = $row["codi"];
									$nom_producte = $row["nomProd"];
									$nom_categoria = $row["nomCat"];
									$preu = $row["preu"];
									$url_imatge = $row["imatge"];

									//Taula
									echo "<tr> 
											<td class=\"align-middle\">
												<img src=\"$url_imatge\" class=\"img-thumbnail mr-2\" style=\"height: 50px;\" />
												$nom_producte
											</td>
											<td class=\"align-middle\">$nom_categoria</td>
											<td class=\"align-middle\">$preu €</td>
											<td class=\"align-middle\">
												<form class=\"form-inline\" action=\"<?php echo htmlspecialchars($_SERVER[PHP_SELF]);?>\" method=\"post\">
													<a href=\"form_producte.php?codi=$codi_producte\" class=\"btn btn-primary\"><i class=\"fas fa-pencil-alt\"></i></a>
													<div class=\"form-group\">
														<input type=\"hidden\" name=\"codi\" value=\"$codi_producte\" />
													</div>
													<button type=\"submit\" class=\"btn btn-primary\"><i class=\"fas fa-trash-alt\"></i></button>
												</form>
											</td> 
										</tr>";

									$row = $result->fetch_assoc();
								}
							}
							else
							{
								echo "<p>No es troba cap producte</p>";
							}
						}
						$conn->close();
					?>
				</table>
			</div>
		</div>
	</body>
</html>
