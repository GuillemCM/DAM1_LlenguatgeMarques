<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>SuperMarket</title>
		<link rel="icon" type="image/png" href="images/favicon.png">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/fontawesome-all.min.css">
		<script src="js/jquery.js"></script>
		<script src="js/popper.js"></script>
		<script src="js/bootstrap.js"></script>
	</head>
	<body class="bg-primary">
		<?php 
			require "config.php";
			session_start();
			if (!empty($_SESSION)) 
			{
				$id_user = $_SESSION["user"];

				$sql = "SELECT nom, cognoms FROM clients WHERE id_client = $id_user";
				$result = $conn->query($sql);
				if($result)
				{
					if ($result->num_rows > 0)
					{
						//
						$row = $result->fetch_assoc();
						$nomUsuari = $row["nom"];
						$cognomsUsuari = $row["cognoms"];
						$no_session = false;
					}
				}
			}
			else
			{
				$no_session = true;
			}
		?>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<a class="navbar-brand" href="index.php">
				 <img src="images/logo.png" width="30" height="30" class="d-inline-block align-top" alt="logo">
				SuperMarket
			</a>
			<div class="collapse navbar-collapse" id="navbarCollapse">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item">
						<a class="nav-link text-primary" href="comprar.php">Comprar</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="index.php">Sobre nosaltres</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="index.php">Atenció al client</a>
					</li>
					<?php
						if (isset($_SESSION["user"])) 
						{
							//Si existeix variable de sessió, es mostra la info del header
							echo "<li class=\"nav-item dropdown\">
								<a class=\"nav-link dropdown-toggle\" id=\"navbarDropdownMenuLink\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
									Clients
								</a>
								<div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdownMenuLink\">
									<a class=\"dropdown-item\" href=\"form_client.php\">Modificar les meves dades</a>
									<a class=\"dropdown-item\" href=\"tancar.php\">Tarcar la sessió</a>
								</div>
							</li>
							<li class=\"nav-item dropdown\">
								<a class=\"nav-link dropdown-toggle\" id=\"navbarDropdownMenuLink\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
									Comandes
								</a>
								<div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdownMenuLink\">
									<a class=\"dropdown-item\" href=\"carrito.php\">Veure el carrito</a>
									<a class=\"dropdown-item\" href=\"index.php\">Historial de comandes</a>
								</div>
							</li>";
							//Mirem si l'usuari és l'admin
							if ($nomUsuari == "administrador") 
							{
								echo "<li class=\"nav-item dropdown\">
										<a class=\"nav-link dropdown-toggle\" id=\"navbarDropdownMenuLink\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
											Gestió de productes
										</a>
										<div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdownMenuLink\">
											<a class=\"dropdown-item\" href=\"form_producte.php\">Nou producte</a>
											<a class=\"dropdown-item\" href=\"productes.php\">Editar productes</a>
										</div>
									</li>";
							}

						}
					?>
					
				</ul>
				<?php
					if(!$no_session)
					{
						echo "<a href=\"entrar.php\" class=\"btn btn-primary my-0 mx-2\">$nomUsuari $cognomsUsuari </a>
										<a href=\"tancar.php\" class=\"btn btn-outline-primary my-0\">Tancar</a>";
					}
					
					if($no_session)
					{
						//Si no hi ha sessió, es mostra normal
						echo "<a href=\"entrar.php\" class=\"btn btn-primary my-0 mx-2\">Entrar</a>
							<a href=\"form_client.php\" class=\"btn btn-outline-primary my-0\">Nou client</a>";
					}
					$conn->close();
				?>
			</div>
		</nav>