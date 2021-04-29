<?php
	require "header.php";
	require "config.php";
	include "common/validacions.php";

	if (isset($_SESSION["user"])) 
	{
		//Si s'ha iniciat sessió, farem el update, sinó el INSERT
		$id_client = $_SESSION["user"];
		$sql = "SELECT * FROM clients WHERE id_client = $id_client";
		$result = $conn->query($sql);
		if ($result) 
		{
			$row = $result->fetch_assoc();
			//Recollim les dades de l'usuari
			$username = $row["nom_usuari"];
			$nombre = $row["nom"];
			$apellidos = $row["cognoms"];
			$nif = $row["nif"];
			$direccion = $row["adreca"];
			$codigo_postal = $row["codi_postal"];
			$poblacion = $row["poblacio"];
			$telefono = $row["telefon"];
			$mail = $row["email"];
		}
	}
	if (!empty($_POST))
	{
		//Dades post
		$username = $_POST["username"];
		$pass = $_POST["pass"];
		$rp_pass = $_POST["rp_pass"];
		$nombre = $_POST["nombre"];
		$apellidos = $_POST["apellidos"];
		$nif = $_POST["nif"];
		$direccion = $_POST["direccion"];
		$codigo_postal = $_POST["codigo_postal"];
		$poblacion = $_POST["poblacion"];
		if (empty($_POST["telefono"])) 
		{
			$telefono = null;
		}
		else
		{
			$telefono = $_POST["telefono"];
		}
		if (empty($_POST["mail"])) 
		{
			$mail = null;
		}
		else
		{
			$mail = $_POST["mail"];
		}
		
		//Variable es pot fer la query
		$valid = false;

		//Si les dades són correctes i les possibles casuístiques d'introducció de dades
		if (nomUsuariValid($username) == 1 && (seguretatContrasenya($pass) > 2) && $rp_pass == $pass && !empty($nombre) && !empty($apellidos)&& NIFValid($nif) == 1 && !empty($direccion) && !empty($codigo_postal) && !empty($poblacion) && 
			(esEmail($mail) == 1 || $mail == null))
		{
			//Si hay sessión UPDATE
			if (isset($_SESSION)) 
			{
				$sql = "UPDATE clients SET nom_usuari = '$username', contrasenya = '$pass', nom = '$nombre', cognoms = '$apellidos', nif = '$nif', adreca = '$direccion', codi_postal = '$codigo_postal', poblacio = '$poblacion', telefon = '$telefono', email = '$mail' WHERE id_client = '$id_client'";
				echo $sql;
				$valid = true;
			}
			//Si no hay sessión, INSERT
			else
			{
				$sql = "INSERT INTO clients (nom_usuari, contrasenya, nom, cognoms, nif, adreca, codi_postal, poblacio, telefon, email) 
					VALUES ('$username', '$pass', '$nombre', '$apellidos', '$nif', '$direccion', '$codigo_postal', '$poblacion', '$telefono', '$mail')";
				$valid = true;
			}	
		}
		else
		{
			$error = 2;
		}
		if ($valid) 
		{
			$result = $conn->query($sql);
			if ($result) 
			{
				header("Location: entrar.php");
			} else 
			{
				$error = 1;
			}
		}
	}
?>
		<div class="container m-5 mx-auto text-white">
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
				<div class="row">
					<div class="col-4 offset-2">
						<?php
							//Error al introduïr un nou usuari
							if (isset($error)) 
							{
								if($error == 1){
								echo "<div class=\"alert alert-danger\" role=\"alert\">
									  No s'ha pogut registrar el nou usuari
									</div>";
								}elseif ($error == 2) {
									echo "<div class=\"alert alert-danger\" role=\"alert\">
									  No s'ha introduït alguna dada correctament
									</div>";
								}
							}
							//Username
							if(!empty($username))
							{
								echo "<div class=\"form-group\">
							<label for=\"username\">Nom d'usuari (obligatori):</label>
							<input type=\"text\" class=\"form-control\" name=\"username\" id=\"username\" value=\"$username\" />
							</div>";
							}
							else
							{
								echo "<div class=\"form-group\">
							<label for=\"username\">Nom d'usuari (obligatori):</label>
							<input type=\"text\" class=\"form-control\" name=\"username\" id=\"username\" />
							</div>";
							}
							
						?>
						<div class="form-group">
							<label for="pass">Contrasenya (obligatori):</label>
							<input type="password" class="form-control" name="pass" id="pass" />
						</div>
						<div class="form-group">
							<label for="rp_pass">Repeteix la contrasenya (obligatori):</label>
							<input type="password" class="form-control" name="rp_pass" id="rp_pass" />
						</div>
						<?php
							//Nom
							if (!empty($nombre)) 
							{
								echo "<div class=\"form-group\">
							<label for=\"nombre\">Nom (obligatori):</label>
							<input type=\"text\" class=\"form-control\" name=\"nombre\" id=\"nombre\" value=\"$nombre\" />
								</div>";
							}
							else
							{
								echo "<div class=\"form-group\">
							<label for=\"nombre\">Nom (obligatori):</label>
							<input type=\"text\" class=\"form-control\" name=\"nombre\" id=\"nombre\" />
								</div>";
							}
							//Cognoms
							if (!empty($apellidos)) 
							{
								echo "<div class=\"form-group\">
										<label for=\"apellidos\">Cognoms (obligatori):</label>
										<input type=\"text\" class=\"form-control\" name=\"apellidos\" id=\"apellidos\" value=\"$apellidos\"/>
									</div>";
							}
							else
							{
								echo "<div class=\"form-group\">
										<label for=\"apellidos\">Cognoms (obligatori):</label>
										<input type=\"text\" class=\"form-control\" name=\"apellidos\" id=\"apellidos\" />
									</div>";
							}
							//NIF
							if (!empty($nif)) 
							{
								echo "<div class=\"form-group\">
								<label for=\"nif\">NIF (obligatori):</label>
								<input type=\"text\" class=\"form-control\" name=\"nif\" id=\"nif\" value=\"$nif\" />
								</div>";
							}
							else
							{
								echo "<div class=\"form-group\">
								<label for=\"nif\">NIF (obligatori):</label>
								<input type=\"text\" class=\"form-control\" name=\"nif\" id=\"nif\" />
								</div>";
							}
						
							echo"</div> <div class=\"col-4\">";
							
							//Dirección
							if (!empty($direccion)) 
							{
								echo "<div class=\"form-group\">
									<label for=\"direccion\">Adreça (obligatori):</label>
									<input type=\"text\" class=\"form-control\" name=\"direccion\" id=\"direccion\" value=\"$direccion\" />
								</div>";
							}
							else
							{
								echo "<div class=\"form-group\">
									<label for=\"direccion\">Adreça (obligatori):</label>
									<input type=\"text\" class=\"form-control\" name=\"direccion\" id=\"direccion\" />
								</div>";
							}

							//Codi postal
							if (!empty($codigo_postal)) 
							{
								echo "<div class=\"form-group\">
									<label for=\"codigo_postal\">Codi postal (obligatori):</label>
									<input type=\"text\" class=\"form-control\" name=\"codigo_postal\" id=\"codigo_postal\" value=\"$codigo_postal\" />
								</div>";
							}
							else
							{
								echo "<div class=\"form-group\">
									<label for=\"codigo_postal\">Codi postal (obligatori):</label>
									<input type=\"text\" class=\"form-control\" name=\"codigo_postal\" id=\"codigo_postal\" />
								</div>";
							}
						?>
						<div class="form-group">
							<label for="poblacion">Població (obligatori):</label>
							<select class="form-control" name="poblacion" id="poblacion">
								<?php
									$sql = "SELECT id_poblacio, nom FROM poblacions ORDER BY nom";
									$result = $conn->query($sql);
									if($result)
									{
										if ($result->num_rows > 0)
										{
											$row = $result->fetch_assoc();
											echo "<option value=\"\">Selecciona una opció</option>";
											while($row) 
											{

												$id_poblacio = $row["id_poblacio"];
												$nom_poblacio = $row["nom"];
												if (!empty($poblacion)) 
												{
													if ($poblacion == $id_poblacio) 
													{
														echo "<option value=\"$id_poblacio\" selected>$nom_poblacio</option>";
													}
												}
												else
												{
													echo "<option value=\"$id_poblacio\">$nom_poblacio</option>";
												}
												
												$row = $result->fetch_assoc();
											}
										}
										else
										{
											echo "<p>No es troba cap població</p>";
										}
									}
								?>
							</select>
						</div>
						<?php
							//Telefono
							if (!empty($telefono)) 
							{
								echo "<div class=\"form-group\">
								<label for=\"telefono\">Telèfon:</label>
								<input type=\"text\" class=\"form-control\" name=\"telefono\" id=\"telefono\" value=\"$telefono\" />
								</div>";
							}
							else
							{
								echo "<div class=\"form-group\">
								<label for=\"telefono\">Telèfon:</label>
								<input type=\"text\" class=\"form-control\" name=\"telefono\" id=\"telefono\" />
								</div>";
							}
							//Email
							if (!empty($mail)) 
							{
								echo "<div class=\"form-group\">
								<label for=\"codigo_postal\">Email:</label>
								<input type=\"text\" class=\"form-control\" name=\"mail\" id=\"mail\" value=\"$mail\"/>
								</div>";
							}
							else
							{
								echo "<div class=\"form-group\">
								<label for=\"codigo_postal\">Email:</label>
								<input type=\"text\" class=\"form-control\" name=\"mail\" id=\"mail\" />
								</div>";
							}
						?>
						<div class="form-group text-right">
							<button type="submit" class="btn btn-default">Enviar</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</body>
</html>
