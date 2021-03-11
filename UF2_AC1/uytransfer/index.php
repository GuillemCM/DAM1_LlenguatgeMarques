<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="images/favicon.png" />
    <link rel="stylesheet" type="text/css" href="css/estilos.css" />

    <title>Uy!Transfer</title>
    <script src="https://kit.fontawesome.com/ef14336b18.js" crossorigin="anonymous"></script>
  </head>
  <body>
    <div class="container d-flex p-3 mx-auto bg-secondary">
        <header class="mb-auto">
            <div class="inner">
                <h3 class="m-1">Uy!Transfer</h3>
            </div>
        </header>
    </div>
    <div class="container">
        <div class="row">
            <div class="offset-2 col-8 justify-content-center mt-4">
                <form name="file" action="upload.php" method="post" enctype="multipart/form-data">
                  <div class="m-3">
                    <input type="text" class="form-control" id="nameInput" placeholder="Tu nombre">
                  </div>
                  <div class="m-3">
                    <input type="file" name="file" class="form-control form-control-sm" id="formFile"/>
                  </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
  </body>
</html>