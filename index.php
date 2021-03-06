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
    <style>
        #blockcards {
            position:absolute;
            top:0;
            left:0;
            width:100%;
            height:100%;
            background-color: rgba(255, 255, 255, 0);
            z-index:900;
        }

        div[class^="bloquearCarta"] {
            z-index: 9999;
            width: 205px;
            height: 110px;
            display: none;
            background-color: rgba(255, 255, 255, 0);
        }
    </style>
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/jquery.flip.min.js"></script>
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">
</head>
<body>
    <div class="container">
        <div id="blockcards" style="display: none;"></div>
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
        <span>Número de intentos: <span id="intentos" style="margin-left: 0">0</span></span>
        <span>Nº parejas acertadas: <span id="aciertos" style="margin-left: 0">0</span></span>
        <span>Cartas restantes: <span id="cartasRestantes" style="margin-left: 0">0</span></span>
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
        Array.prototype.remove = function() {
            var what, a = arguments, L = a.length, ax;
            while (L && this.length) {
                what = a[--L];
                while ((ax = this.indexOf(what)) !== -1) {
                    this.splice(ax, 1);
                }
            }
            return this;
        };

        var urls = [], ids = [], intentos = 0, numAciertos = 0, cartasLevantadas = 0;

        $(document).ready(function () {
            $("button.dificultades").click(function () {
                urls = [];
                intentos = 0;
                numAciertos = 0;
                $("#intentos").html(intentos);
                $("#aciertos").html(numAciertos);

                $.post("getImages.php", { d: $(this).attr("value") }, function (data) {

                    var $fila = $("#fila");

                    $fila.slideUp("slow");

                    var json = JSON.parse(data);

                    //json.imagenes[0].url;

                    desordena(json.imagenes);

                    var salida = "";

                    for(var i = 0; i < json.imagenes.length; i++) {
                        salida += "<button class='carta col-sm-3' id='carta" + (i+1) + "'><div class='front'><img src='images/pregunta.png' width='93' height='93'></div><div class='back'><img src='" + json.imagenes[i].url + "' alt='Imagen' width='93' height='93'></div></button>";
                    }

                    $("#divDificultades").slideUp();

                    $fila.html(salida).slideDown("slow");

                    // Cartas restantes

                    // flip(): inicializa la librería
                    // Al hacer click, muestra la parte trasera de la carta y deshabilita el hacer click para mostrar la parte delantera.
                    $("button.carta").flip().on("click",function () {
                        var carta1 = this;
                        ids.push($(this).attr("id"));
                        // Si no encuentro el id de la carta pulsada...
                        if($.inArray($(this).attr("id"), ids) !== -1) {
                            setTimeout(function () {
                                carta1.disabled = true;
                                $(carta1).css("cursor", "not-allowed");
                                console.log("carta con id = " + carta1.id + " deshabilitada");
                            }, 50);

                            setTimeout(function () {
                                carta1.disabled = false;
                                $(carta1).css("cursor", "pointer");
                                console.log("carta con id = " + carta1.id + " habilitada");
                            }, 16000);

                            ids.remove($(this).attr("id"));
                        }

                        $("#blockcards").show();

                        cartasLevantadas++;

                        var url = $(this).find("div.back img").attr("src");

                        urls.push(url);

                        $(this).flip(true);

                        $(this).on("flip:done", function () {
                            if(cartasLevantadas == 2) {

                                //$("#blockcards").show();
                                console.log("deshabilitado");

                                if(hayPareja(url)) {
                                    console.log("URL[0]: " + urls[0] + "\n" + "URL[1]: " + urls[1] + "\n" + "cartasLevantadas: " + cartasLevantadas);
                                    urls = [];
                                    numAciertos++;
                                    $("#aciertos").html(numAciertos);
                                    //urls = [];

                                    intentos++;

                                    $("#intentos").html(intentos);

                                    if(hasGanado($("div.carta").length, numAciertos)) {
                                        $("#h1Partida").html("¡Has ganado!");
                                        $(".modal-body p").html("¡Enhorabuena!. ¿Quieres jugar una nueva partida?");
                                        $("#modalReiniciar").modal("show");
                                    }
                                }
                                else {
                                    unflip($(this));
                                    unflip($("img[src='" + urls[0] + "']").closest("button.carta"));
                                    urls = [];

                                    intentos++;

                                    $("#intentos").html(intentos);

                                    habilitaBotones();
                                }
                                cartasLevantadas = 0;
                            }
                        });

                        //urls = [];
                        //urls.push(url);

                        // ---------- Intenta petar el juego con esto :) -----------

                        setTimeout(function () {
                            $("#blockcards").hide();
                            //habilitaBotones();
                        }, 1000);
                    });
                });

                addMargin();

                $("div.bottom-bar").slideDown();
            });

            $(".modal-body button.dificultades").click(function () {
                $("#modalReiniciar").modal("toggle");
            });

            $("#btnReiniciar").click(function () {
                $("#h1Partida").html("Iniciar nueva partida");
                $(".modal-body p").html("Elige la dificultad. <strong>NOTA</strong>: Se perderá todo el progreso realizado.");
            })
        });

        function habilitaBotones() {

            var botones = document.querySelectorAll("button.carta");

            for(var i = 0; i < botones.length; i++) {
                botones[i].disabled = false;
                botones[i].style.cursor = "pointer";
            }
        }

        function deshabilitaBtns(boton1, boton2) {
            boton1.disabled = true;
            boton2.disabled = true;
        }

        function compruebaBtn(boton) {
            if(boton.disabled == false) {
                $(boton).css("cursor", "pointer");
            }
        }

        function desordena(array) {
            var i, pos, temp;
            for (i = 0; i < 100; i++) {
                pos = Math.random() * array.length | 0;
                temp = array[pos];
                array.splice(pos, 1);
                array.push(temp);
            }
        }

        function addMargin() {
            $("#divCartas").css("margin-bottom", "100px");
        }

        function hayPareja(url) {
            console.log(urls[0] === url);
            return urls[0] === url;
        }

        function unflip(element) {
            //$(element).flip(false);
            setTimeout(function () {
                $(element).flip(false);
            }, 250);
        }
        
        function hasGanado(numCartas, numAciertos) {
            if(numCartas != 0 && numAciertos != 0) {
                return (numAciertos * 2) == numCartas;
            }
        }
    </script>
</body>
</html>