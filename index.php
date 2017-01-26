<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Juego de Memoria - Inicio</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/animate.css">
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/jquery.flip.min.js"></script>
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">
</head>
<body>
    <div class="container">
        <h1>Juego de Memoria</h1>
        <h2>Elige el modo de dificultad:</h2>
        <div class="row">
            <div class="col-sm-offset-4" style="margin-left: 37%">
                <button class="btn btn-success" value="1">Fácil (4x3)</button>
                <button class="btn btn-warning" value="2">Medio (4x4)</button>
                <button class="btn btn-danger" value="3">Difícil (4x5)</button>
            </div>
        </div>
        <div class="row" id="divCartas"></div>
    </div>
    <script>
        $(document).ready(function () {
            $("button").click(function () {
                $.post("getImages.php", { d: $(this).attr("value") }, function (data) {
                    $("#divCartas").html(data);
                });
            });
        });
    </script>
</body>
</html>