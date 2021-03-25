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
              $numRand = strval(rand(10000, 99999));
              $nomArxiu = ($any.$mes.$dia.$numRand.$extensio);
              if(($extensio == ".png" || $extensio == ".pdf" || $extensio == ".jpg" || $extensio == ".rar" || $extensio == ".zip") 
                && $tamanoArchivo <= 10485760)
              {
                  echo "<div class=\"col-3 offset-2\">
                      <img src=\"images/archivoBien.png\" class=\"img-fluid\" alt=\"ArchivoSubidoConExito\">
                    </div>";
                echo "<div class=\"col-7 text-center\">";
                echo "<h2>Archivo enviado correctamente</h2>";

                //Variable para el checkbox
                $checked = false;
                //Variable booleana para saber si el mail es valido
                $mailValido = false;

                //Recogemos variables del POST
                $nomUser = trim($_POST["nameInput"]);
                if (isset($_POST["enviarPorEmail"])) 
                {
                  $checked = true;
                }
                //$checked = trim($_POST["enviarPorEmail"]);
                $emaillUser = trim($_POST["emailAEnviar"]);
                $textoEmail = trim($_POST["mensajeEmail"]);

                //Si hay nombre, se le llama por el mismo
                if ($nomUser != "") {
                  echo "<h4 class=\"mt-4 mb-5\">Hola $nomUser, usa éste link para compartir tu archivo</h4>";
                }
                //Si no hay nombre, frase genérica
                else
                {
                  echo "<h4 class=\"mt-4 mb-5\">Oye tu!! Usa éste link para compartir tu archivo</h4>";
                } 

                //Variable para no  ir enviando el archivo al directorio varias veces
                $errorMail = false;
                //Comprovaciones de si es un mail correcto
                if(preg_match('/@/', $emaillUser))
                {
                  //Cumple con el pattern, se puede enviar
                  $mailValido = true;
                }
                elseif ($mailValido == false && $checked)
                {
                  $errorMail = true;
                  header("Location: index.php?error_mail=1");
                }

                //Mensaje del textArea
                if ($textoEmail == "")
                {
                  $textoEmail = "Sorpresa!! Alguien ha compartido contigo un archivo.";
                }

                //Checkbox
                if ($checked) 
                {
                  //Si mail valido, enviar mail
                  if($mailValido == 1)
                  { 
                    mail($emaillUser, "UY!TRASNFER", $textoEmail);
                  }
                }

                //Url que se genera para la descarga
                $urlDescarga = "http://localhost/DAM1_LlenguatgeMarques/UF2_AC1/uytransfer/files/$nomArxiu";
                
                echo"<a href=\"http://localhost/DAM1_LlenguatgeMarques/UF2_AC1/uytransfer/files/$nomArxiu\" class=\"mt-5\">$urlDescarga</a>";
                //Movem fitxer de temporal a files, si no s'ha prodït un error pel email
                if (!$errorMail) 
                {
                  move_uploaded_file($rutaTmp, "./files/$nomArxiu");
                }
               
                //Guardem cookie
                $numCookies = 1;
                if(isset($_COOKIE["numCookies"]))
                { 
                  $numCookies = $_COOKIE["numCookies"];
                  $numCookies++;
                }
                setcookie("numCookies", $numCookies, time()+(60*60*24*1000));
                setcookie("link$numCookies", $urlDescarga, time()+(60*60*24*7));
              }
              else
              {
                echo "<div class=\"col-3 offset-2\">
                      <img src=\"images/archivoFail.png\" class=\"img-fluid\" alt=\"ArchivoNoSubidoConExito\">
                    </div>";
                echo "<div class=\"col-7 text-center\">";
                echo "<h2>El archivo no se ha enviado correctamente</h2>";
                if($tamanoArchivo > 10485760)
                {
                  echo "<h3>Tu archivo supera el tamaño permitido de 10 MB</h3>";
                }
                else if($extensio != ".png" && $extensio != ".pdf" && $extensio != ".jpg" && $extensio != ".rar" && $extensio != ".zip")
                {
                  echo "<h3>La extensión de tu archivo no cumple con los siguientes formatos: </h3>";
                  echo "<h5> '.png'; '.pdf'; '.jpg'; '.rar'; o '.zip' </h5>";
                }
              } 
            }
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