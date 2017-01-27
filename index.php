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
        <div class="row" id="divDificultades">
            <h2>Elige el modo de dificultad:</h2>
            <div class="col-sm-offset-4" style="margin-left: 37%">
                <button class="btn btn-success dificultades" value="1">Fácil (4x3)</button>
                <button class="btn btn-warning dificultades" value="2">Medio (4x4)</button>
                <button class="btn btn-danger dificultades" value="3">Difícil (4x5)</button>
            </div>
        </div>
        <div class="row" id="divCartas">
            <div class="row" id="fila" style="display: none;"></div>
        </div>
    </div>
    <div class="bottom-bar" style="display: none;">
        <strong id="info">Información de la partida</strong>
        <span id="intentos">Número de intentos: 0</span>
        <span id="aciertos">Número de aciertos: 0</span>
        <span id="cartasRestantes">Cartas restantes: 0</span>
        <button class="btn btn-danger" data-target="#modalReiniciar" data-toggle="modal" id="btnReiniciar">Iniciar nueva partida</button>
    </div>
    <div id="modalReiniciar" class="modal animated zoomIn" role="dialog" data-easein="expandIn">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2 class="modal-title" id="h1Partida">Iniciar nueva partida</h2>
                </div>

                <div class="modal-body">
                    <p>Elige la dificultad. <strong>NOTA</strong>: Se perderá todo el progreso realizado.</p>
                    <div class="col-sm-offset-3">
                        <button class="btn btn-success dificultades" value="1">Fácil (4x3)</button>
                        <button class="btn btn-warning dificultades" value="2">Medio (4x4)</button>
                        <button class="btn btn-danger dificultades" value="3">Difícil (4x5)</button>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" id="cerrar" class="btn btn-primary" data-dismiss="modal">Cerrar diálogo</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $("button.dificultades").click(function () {
                $.post("getImages.php", { d: $(this).attr("value") }, function (data) {

                    var $fila = $("#fila");

                    $fila.slideUp("slow");

                    var json = JSON.parse(data);

                    //json.imagenes[0].url;

                    desordena(json.imagenes);

                    var salida = "";

                    for(var i = 0; i < json.imagenes.length; i++) {
                        salida += "<div class='carta col-sm-3' id='carta" + i + "'><div class='front'><img src='images/pregunta.png' width='93' height='93'></div><div class='back'><img src='" + json.imagenes[i].url + "' alt='Imagen' width='93' height='93'></div></div>";
                    }

                    $("#divDificultades").slideUp();

                    $fila.html(salida).slideDown("slow");
                    $("div.carta").flip();
                });

                checkCards($("div.carta").length);

                $("div.bottom-bar").slideDown();
            });

            $(".modal-body button.dificultades").click(function () {
                $("#modalReiniciar").modal("toggle");
            })
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

        function checkCards(cardsLength) {
//            if(cardsLength > 12) {
//                $("#divCartas").css("margin-bottom", "100px");
//            }

            $("#divCartas").css("margin-bottom", "100px");
        }
    </script>
</body>
</html>