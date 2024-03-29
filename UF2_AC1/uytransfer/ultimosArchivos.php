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
        <div class="row">
            <div class="offset-2 col-8 offset-2 justify-content-center align-items-center mt-4">
                <h1 class="mt-4 mb-5" style="text-align: center;">Archivos enviados recientemente</h1>
                <?php
                    //Si existe cookie
                    if (isset($_COOKIE["numCookies"])) 
                    {
                        $numCookies = $_COOKIE["numCookies"];

                        while (isset($_COOKIE["link$numCookies"])) 
                        {
                            $url = $_COOKIE["link$numCookies"];
                            echo "<p style=\"text-align: center;\"><a href=\"$url\">$url</a></p>";
                            $numCookies--;
                        }
                    }  
                ?>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
  </body>
</html>