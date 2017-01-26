<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Juego de Parejas</title>
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
        <h1>Juego de Parejas</h1>
        <h2>Elige el modo de dificultad:</h2>
        <div class="row">
            <div class="col-sm-offset-4" style="margin-left: 37%">
                <button class="btn btn-success" value="1">Fácil (4x3)</button>
                <button class="btn btn-warning" value="2">Medio (4x4)</button>
                <button class="btn btn-danger" value="3">Difícil (4x5)</button>
            </div>
        </div>
        <div class="row" id="divCartas">
            <div class="row" id="fila"></div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $("button").click(function () {
                $.post("getImages.php", { d: $(this).attr("value") }, function (data) {

                    var json = JSON.parse(data);

                    //json.imagenes[0].url;

                    desordena(json.imagenes);

                    var salida = "";

                    for(var i = 0; i < json.imagenes.length; i++) {
                        salida += "<div class='carta col-sm-3' id='carta" + i + "'><div class='front'><img src='images/pregunta.png' width='93' height='93'></div><div class='back'><img src='" + json.imagenes[i].url + "' alt='Imagen' width='93' height='93'><p>" + json.imagenes[i].id + "</p></div></div>";
                    }

                    $("#fila").html(salida);
                    $("div.carta").flip();
                });
            });
        });

        function desordena(array) {
            var i, pos, temp;
            for (i = 0; i < 100; i++) {
                pos = Math.random() * array.length | 0;
                temp = array[pos];
                array.splice(pos, 1);
                array.push(temp);
            }
        }
    </script>
</body>
</html>