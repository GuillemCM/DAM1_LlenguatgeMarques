<?php
	require "header.php";
	require "config.php";
	include "common/validacions.php";
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
		$telefono = $_POST["telefono"];
		$mail = $_POST["mail"];
		//Variable es pot fer la query
		$valid = false;
		//Si les dades són correctes i les possibles casuístiques d'introducció de dades
		if (nomUsuariValid($username) == 1 && (seguretatContrasenya($pass) > 2) && $rp_pass == $pass && !empty($nombre) && !empty($apellidos)
			&& NIFValid($nif) == 1 && !empty($direccion) && !empty($codigo_postal) && !empty($poblacion) && !empty($telefono) 
			&& esEmail($mail) == 1) {

			$sql = "INSERT INTO clients (nom_usuari, contrasenya, nom, cognoms, nif, adreca, codi_postal, poblacio, telefon, email) 
			VALUES ('$username', '$pass', '$nombre', '$apellidos', '$nif', '$direccion', '$codigo_postal', '$poblacion', '$telefono', '&mail')";
			$valid = true;
		}
		elseif (nomUsuariValid($username) == 1 && (seguretatContrasenya($pass) > 2) && $rp_pass == $pass && !empty($nombre) && !empty($apellidos)
			&& NIFValid($nif) == 1 && !empty($direccion) && !empty($codigo_postal) && !empty($poblacion) && !empty($telefono) 
			&& empty($mail)) 
		{
			$sql = "INSERT INTO clients (nom_usuari, contrasenya, nom, cognoms, nif, adreca, codi_postal, poblacio, telefon) 
			VALUES ('$username', '$pass', '$nombre', '$apellidos', '$nif', '$direccion', '$codigo_postal', '$poblacion', '$telefono')";
			$valid = true;
		}
		elseif (nomUsuariValid($username) == 1 && (seguretatContrasenya($pass) > 2) && $rp_pass == $pass && !empty($nombre) && !empty($apellidos)
			&& NIFValid($nif) == 1 && !empty($direccion) && !empty($codigo_postal) && !empty($poblacion) && empty($telefono) 
			&& empty($mail)) 
		{
			$sql = "INSERT INTO clients (nom_usuari, contrasenya, nom, cognoms, nif, adreca, codi_postal, poblacio) 
			VALUES ('$username', '$pass', '$nombre', '$apellidos', '$nif', '$direccion', '$codigo_postal', '$poblacion')";
			$valid = true;
		}
		elseif (nomUsuariValid($username) == 1 && (seguretatContrasenya($pass) > 2) && $rp_pass == $pass && !empty($nombre) && !empty($apellidos)
			&& NIFValid($nif) == 1 && !empty($direccion) && !empty($codigo_postal) && !empty($poblacion) && empty($telefono) 
			&& esEmail($mail) == 1) 
		{
			$sql = "INSERT INTO clients (nom_usuari, contrasenya, nom, cognoms, nif, adreca, codi_postal, poblacio, email) 
			VALUES ('$username', '$pass', '$nombre', '$apellidos', '$nif', '$direccion', '$codigo_postal', '$poblacion', '$mail')";
			$valid = true;
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

						?>
						<div class="form-group">
							<label for="username">Nom d'usuari (obligatori):</label>
							<input type="text" class="form-control" name="username" id="username" />
						</div>
						<div class="form-group">
							<label for="pass">Contrasenya (obligatori):</label>
							<input type="password" class="form-control" name="pass" id="pass" />
						</div>
						<div class="form-group">
							<label for="rp_pass">Repeteix la contrasenya (obligatori):</label>
							<input type="password" class="form-control" name="rp_pass" id="rp_pass" />
						</div>
						<div class="form-group">
							<label for="nombre">Nom (obligatori):</label>
							<input type="text" class="form-control" name="nombre" id="nombre" />
						</div>
						<div class="form-group">
							<label for="apellidos">Cognoms (obligatori):</label>
							<input type="text" class="form-control" name="apellidos" id="apellidos" />
						</div>
						<div class="form-group">
							<label for="nif">NIF (obligatori):</label>
							<input type="text" class="form-control" name="nif" id="nif" />
						</div>
					</div>
					<div class="col-4">
						<div class="form-group">
							<label for="direccion">Adreça (obligatori):</label>
							<input type="text" class="form-control" name="direccion" id="direccion" />
						</div>
						<div class="form-group">
							<label for="codigo_postal">Codi postal (obligatori):</label>
							<input type="text" class="form-control" name="codigo_postal" id="codigo_postal" />
						</div>
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
												echo "<option value=\"$id_poblacio\">$nom_poblacio</option>";
												$row = $result->fetch_assoc();
											}
										}
										else
										{
											echo "<p>No es troba cap població</p>";
										}
									}
									$conn->close();
								?>
							</select>
						</div>
						<div class="form-group">
							<label for="telefono">Telèfon:</label>
							<input type="text" class="form-control" name="telefono" id="telefono" />
						</div>
						<div class="form-group">
							<label for="codigo_postal">Email:</label>
							<input type="text" class="form-control" name="mail" id="mail" />
						</div>
						<div class="form-group text-right">
							<button type="submit" class="btn btn-default">Enviar</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</body>
</html>
