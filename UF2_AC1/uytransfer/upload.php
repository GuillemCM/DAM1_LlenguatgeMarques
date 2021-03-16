<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="images/favicon.png" />
    <link rel="stylesheet" type="text/css" href="css/estilos.css" />

    <title>Uy!Transfer</title>
    <script src="https://kit.fontawesome.com/ef14336b18.js" crossorigin="anonymous"></script>
  </head>
  <body>
    
    <?php
        include "librerias/header.php";
    ?>
    <div class="container">
        <div class="row mt-5 justify-content-center">
          <?php
            if ($_SERVER["REQUEST_METHOD"] == "GET") 
            {
              $dades = $_GET;
            } else {
              $dades = $_POST;
            }
            
            if (!empty($_FILES)) {
              $nomArxiu = $_FILES["formFile"]["name"];
              $extensio = substr($nomArxiu, strpos($nomArxiu, "."));
              $tamanoArchivo = $_FILES["formFile"]["size"];
              $rutaTmp = $_FILES["formFile"]["tmp_name"];
              $data = getdate();
              $any = strval($data["year"]);
              $mes = strval($data["mon"]);
              $dia = strval($data["mday"]);
              if ($mes < 10) {
                $mes = "0$mes";
              }
              $numRand = strval(rand(11111, 99999));
              $nomArxiu = ($any.$mes.$dia.$numRand.$extensio);
              move_uploaded_file($rutaTmp, "./files/$nomArxiu");

              echo "<div class=\"col-3 offset-2\">
                    <img src=\"images/archivoBien.png\" class=\"img-fluid\" alt=\"ArchivoSubidoConExito\">
                  </div>";
              echo "<div class=\"col-7 text-center\">";
              echo "<h2>Archivo enviado correctamente</h2>";
            }
            else if(empty($_FILES))
            {
              echo "Hola No hay archivo";
              echo "<div class=\"col-3 offset-2\">
                    <img src=\"archivoFail.png\" class=\"img-fluid\" alt=\"ArchivoNoSubidoConExito\">
                  </div>";
              echo "<div class=\"col-7 text-center\">";
              echo "<h2>El archivo no se ha enviado correctamente</h2>";
            }
            foreach ($dades as $clau => $valor) 
            {
              $valorNet = trim($valor);
              if ($clau == "nameInput")
              {
                if ($valorNet != "") {
                  echo "<h4 class=\"mt-4 mb-5\">Hola $valorNet, usa éste link para compartir tu archivo</h4>";
                }
                else
                {
                  echo "<h4 class=\"mt-4 mb-5\">Oye tu!! Usa éste link para compartir tu archivo</h4>";
                } 
              }

              if ($clau == "formFile")
              {
                echo "Hola?";
                $nomArxiu = $valorNet;
                echo $nomArxiu;
              }
            }
              echo"<a href=\"\" class=\"mt-5\">http://localhost/uyTransfer/files/$nomArxiu</a>";
            echo "</div>";
          ?>
          
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
  </body>
</html>