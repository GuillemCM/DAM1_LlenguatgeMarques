<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Videojocs</title>
		<link rel="icon" type="image/png" href="images/favicon.png">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<script src="js/jquery.min.js"></script>
		<script src="js/popper.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</head>
	<body class="bg-dark">
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<a class="navbar-brand" href="index.html">Videojocs</a>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav">
					<li class="nav-item ">
						<a class="nav-link" href="form_usuari.php">Nou usuari</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="videojocs.php">Llistat de videojocs</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="form_login.html">Inici de sessió</a>
					</li>
				</ul>
			</div>
		</nav>
		<div class="container m-5 mx-auto text-white">
			<div class="row">
				<div class="col-4 offset-4">
					<form class="form-inline" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="get">
						<div class="form-group">
							<select class="form-control form-control-sm mr-2" name="plataforma" id="plataforma">
								<option>Selecciona una plataforma ...</option>
								<option>Nintendo DS</option>
								<option>Nintendo Wii</option>
								<option>PC</option>
								<option>PlayStation 3</option>
								<option>PSP</option>
								<option>Xbox 360</option>
							</select>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-default btn-sm">Filtrar</button>
						</div>
						<div class="form-check-inline">
							<label class="form-check-label">
								<input class="form-check-input" type="checkbox" name="plataforma" id="plataforma" />Guardar com a plataforma favorita
							</label>
						</div>
					</form>
				</div>
			</div>
			<div class="row">
				<div class="col-8 offset-2">
					<h3 class="text-success my-2">Llistat de videojocs</h3>
					<?php
						$servername = "localhost";
						$username = "root";
						$password = "";
						$dbname = "videojocs";

						$conn = new mysqli($servername, $username, $password, $dbname);

						if ($conn->connect_error) {
							die("ERROR al connectar con la base de datos");
						}

						if(isset($_GET["plataforma"]))
						{
							$plataforma = $_GET["plataforma"];
							$sql = "SELECT * FROM videojocs WHERE plataforma = '$plataforma' ORDER BY titol";
						}
						else
						{
							$sql = "SELECT * FROM videojocs ORDER BY titol";
						}

						

						//echo $sql;

						$result = $conn->query($sql);

						if ($result) {

							if ($result->num_rows > 0) {
								
								echo "<table border=\"2\" class=\"table\">";
								echo "<tr>";
								echo "<th>Titulo</th>";
								echo "<th>Precio</th>";
								echo "<th>Plataforma</th>";
								echo "<th>PEGI</th>";
								echo "</tr>";

								$row = $result->fetch_assoc();
								while($row) {

									$titulo = $row["titol"];
									$precio = $row["preu"];
									$plataforma = $row["plataforma"];
									$pegi = $row["pegi"];

									echo "<tr>";
									echo "<td class=\"align-middle\">$titulo</td>";
									echo "<td class=\"align-middle\">$precio</td>";
									echo "<td class=\"align-middle\">$plataforma</td>";
									echo "<td class=\"align-middle\">$pegi</td>";
									echo "</tr>";

									$row = $result->fetch_assoc();
								}

								echo "</table>";


							} else {
								echo "<p>No hay ningún/a usuario/a</p>";
							}

						} else {
							echo "ERROR al seleccionar los datos";
						}

						$conn->close();
					?>
				</div>
			</div>
		</div>
	</body>
</html>
