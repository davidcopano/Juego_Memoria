<?php
    if(isset($_POST["d"]))
    {
        $archivos = scandir("images/frutas");

        // Necesario para que no muestre '.' y '..'

        array_shift($archivos);
        array_shift($archivos);

        shuffle($archivos);

        $dificultad = intval($_POST["d"]);

        switch ($dificultad)
        {
            // Tamaño de 12 cartas (6 cartas con su pareja)
            case 1: {
                for($i = 0; $i < 8; $i++) {
                    array_pop($archivos);
                }
            }

            break;

            // Tamaño de 16 cartas (8 cartas con su pareja)
            case 2: {
                for($i = 0; $i < 4; $i++) {
                    array_pop($archivos);
                }
            }

            break;
        }

        // Conversión a JSON

        $salida = "{\"imagenes\": [";

        for($i = 0; $i < count($archivos); $i++) {
            $salida .= "{ \"id\": " . ($i+1) . ", \"url\": " . "\"images/frutas/" . $archivos[$i] . "\"},";
        }

        $salida .= "]}";

        $salida = substr($salida, 0, -3);

        $salida .= "]}";

        echo $salida;

        //var_dump($archivos);
    }
    else {
        die("No tiene permiso para visualizar esta página.");
    }
