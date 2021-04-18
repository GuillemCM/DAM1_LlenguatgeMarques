<?php
	require "header.php";
	require "config.php";
	if (!empty($_POST)) 
	{
		//Variables post
		$nomUsuari = $_POST["username"];
		$pass = $_POST["pass"];

		$sql = "SELECT id_client FROM clients WHERE nom_usuari = '$nomUsuari' AND contrasenya = '$pass'";
		$result = $conn->query($sql);
		if($result)
		{
			if ($result->num_rows > 0)
			{
				$row = $result->fetch_assoc();
				$id_usuari = $row["id_client"];
				//L'usuari existeix, creem variable de sessió
				session_start();
				$_SESSION["user"] = $id_usuari;
				//print_r($_SESSION["user"]);
				header("Location: comprar.php");
			}
			else
			{
				//Error, no existeix l'usuari
				$error = 1;
			}
		}
	}
?>
		<div class="container m-5 mx-auto col-4 offset-4 text-white">
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
				<?php
					if (isset($error)) 
					{
						echo "<p>L'usuari o la contrasenya són incorrectes</p>";
					}
					$conn->close();
				?>
				<div class="form-group">
					<label for="username">Nom d'usuari:</label>
					<input type="text" class="form-control" name="username" id="username" />
				</div>
				<div class="form-group">
					<label for="pass">Contrasenya:</label>
					<input type="password" class="form-control" name="pass" id="pass" />
				</div>
				<div class="form-group text-right">
					<button type="submit" class="btn btn-default">Entrar</button>
				</div>
			</form>
		</div>
	</body>
</html>
