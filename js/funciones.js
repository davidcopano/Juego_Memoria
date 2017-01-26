	function desordena(array) {
    var i, pos, temp;
    for (i = 0; i < 100; i++) {
        pos = Math.random() * array.length | 0;
        temp = array[pos];
        array.splice(pos, 1);
        array.push(temp);
    }
}

var Juego = {
	imagenes1: [
		{
			nombre: "Aguacate",
			url: "images/frutas/aguacate.png"
		},
		{
			nombre: "Aguacate",
			url: "images/frutas/aguacate.png"
		},
		// ---------------------------------
		{
			nombre: "Arándanos",
			url: "images/frutas/arandanos.png"	
		},
		{
			nombre: "Arándanos",
			url: "images/frutas/arandanos.png"	
		},
		// ----------------------------------
		{
			nombre: "Banana",
			url: "images/frutas/banana.png"	
		},
		{
			nombre: "Banana",
			url: "images/frutas/banana.png"	
		},
		// ----------------------------------
		{
			nombre: "Cerezas",
			url: "images/frutas/cerezas.png"	
		},
		{
			nombre: "Cerezas",
			url: "images/frutas/cerezas.png"	
		},
		// ----------------------------------
		{
			nombre: "Col",
			url: "images/frutas/col.png"	
		},
		{
			nombre: "Col",
			url: "images/frutas/col.png"	
		},
		// ----------------------------------
		{
			nombre: "Frambuesa",
			url: "images/frutas/frambuesa.png"	
		},
		{
			nombre: "Frambuesa",
			url: "images/frutas/frambuesa.png"	
		},
		// -----------------------------------
		{
			nombre: "Fresa",
			url: "images/frutas/fresa.png"	
		},
		{
			nombre: "Fresa",
			url: "images/frutas/fresa.png"	
		},
		// ------------------------------------
		{
			nombre: "Grano",
			url: "images/frutas/grano.png"	
		},
		{
			nombre: "Grano",
			url: "images/frutas/grano.png"	
		}
	],

	imagenes2: [
		{
			nombre: "Limón",
			url: "images/frutas/limon.png"
		},
		{
			nombre: "Limón",
			url: "images/frutas/limon.png"
		},
		// ----------------------------------
		{
			nombre: "Manzana",
			url: "images/frutas/manzana.png"	
		},
		{
			nombre: "Manzana",
			url: "images/frutas/manzana.png"	
		},
		// -----------------------------------
		{
			nombre: "Naranja",
			url: "images/frutas/naranja.png"	
		},
		{
			nombre: "Naranja",
			url: "images/frutas/naranja.png"	
		},
		// -----------------------------------
		{
			nombre: "Pera",
			url: "images/frutas/pera.png"	
		},
		{
			nombre: "Pera",
			url: "images/frutas/pera.png"	
		},
		// -----------------------------------
		{
			nombre: "Piña",
			url: "images/frutas/pina.png"	
		},
		{
			nombre: "Piña",
			url: "images/frutas/pina.png"	
		},
		// -----------------------------------
		{
			nombre: "Sandía",
			url: "images/frutas/sandia.png"	
		},
		{
			nombre: "Sandía",
			url: "images/frutas/sandia.png"	
		},
		// ----------------------------------
		{
			nombre: "Tomate",
			url: "images/frutas/tomate.png"	
		},
		{
			nombre: "Tomate",
			url: "images/frutas/tomate.png"	
		},
		// -----------------------------------
		{
			nombre: "Uvas",
			url: "images/frutas/uvas.png"	
		},
		{
			nombre: "Uvas",
			url: "images/frutas/uvas.png"	
		}
	],

	escogePackImagen: function () {
		// Escogemos un pack aleatorio de imágenes
		
		var aleatorio = Math.round(Math.random() + 1);

		if(aleatorio == 1) {
			this.inicia(this.imagenes1);
		}
		else {
			this.inicia(this.imagenes2);
		}
	},

	inicia: function (imagenes) {
		desordena(imagenes);

		var salida = "";

		for(var i = 0; i < imagenes.length; i++) {
			salida += "<div class='carta col-sm-3' id='carta" + i + "'><div class='front'><img src='images/pregunta.png' width='93' height='93'></div><div class='back'><img src='" + imagenes[i].url + "' alt='Imagen' width='93' height='93'><p>" + imagenes[i].nombre + "</p></div></div>";
		}

		$("#fila").html(salida);

		// var salida = "";

		// for(var i = 0; i < imagenes.length; i++) {
		// salida += "<div class='carta col-sm-3' id='carta" + i + "'><div class='front'><img src='images/pregunta.png' width='110' height='110'></div><div class='back'><img src='" + imagenes[i].url + "' alt='Imagen' width='110' height='110'></div></div>";
		// }
	}
}

$(document).ready(function () {
		Juego.escogePackImagen();
		$("#divCartas .carta").flip();
})



	// var imagenes = [
	// "images/frutas/aguacate.png",
	// "images/frutas/arandanos.png",
	// "images/frutas/banana.png",
	// "images/frutas/cerezas.png",
	// "images/frutas/col.png",
	// "images/frutas/frambuesa.png",
	// "images/frutas/fresa.png",
	// "images/frutas/grano.png",
	// "images/frutas/limon.png",
	// "images/frutas/manzana.png",
	// "images/frutas/naranja.png",
	// "images/frutas/pera.png",
	// "images/frutas/pina.png",
	// "images/frutas/sandia.png",
	// "images/frutas/tomate.png",
	// "images/frutas/uvas.png",
	// ];

	// for(var i = 0; i < imagenes.length; i++) {
	// 	salida += "<div class='carta col-sm-3' id='carta" + i + "'><div class='front'><img src='images/pregunta.png' width='110' height='110'></div><div class='back'><img src='" + imagenes[i] + "' alt='Imagen' width='110' height='110'></div></div>";

	// 	$("#fila").html(salida);
	// }

	// salida += "<div class='carta' id='carta" + i + "'><div class='front'><img src='images/pregunta.png'></div><div class='back'><img src='" + imagenes[i] + "' alt='Imagen'></div></div>";

	// $("#divCartas").html(salida);
