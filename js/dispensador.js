
var screenWidth = jQuery(window).width();
var pos = window.location.hash;

//Carga de modal promoción
jQuery(document).on("ready", function () {


	if (  screenWidth >= 800 && pos != "#done" ) {

		jQuery('#myModal').modal('show');

		jQuery("#myModal").on("hide.bs.modal", function (e) {
			
			window.location.hash = "#done";

		});


	};

});


/*Boton para ver mecanica*/
jQuery(document).on("click", ".btn-aqui", function () {
	
	/*Se muestrao/oculta el row con la mecanica*/
	jQuery(".mecanica").slideToggle(function () {

		jQuery(".btn-aqui").toggleClass('cerrar');

		if ( jQuery(".btn-aqui").hasClass('cerrar') ){

		/*Cambiamos img cuando el acordeon está abierto*/
			jQuery(".btn-aqui").attr('src', 'images/btn-cerrar.png');


		}
		else
		{
			jQuery(".btn-aqui").attr('src', 'images/btn-aqui.png');

		};
	});

});


/*Carga funciones para twitter*/

	!function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
			if (!d.getElementById(id)) {
				js = d.createElement(s);
				js.id = id;
				js.src = p + '://platform.twitter.com/widgets.js';
				fjs.parentNode.insertBefore(js, fjs);
			}
		}(document, 'script', 'twitter-wjs');


jQuery(document).ready(function(){
	

	jQuery('.fa-twitter').click(function(){
		//console.log('hola me dieron click');
		var tw=jQuery(this).attr('data-share');
		var mensaje=jQuery('#mensaje').val();
		console.log(mensaje);
	});

	//<a href="https://twitter.com/intent/tweet?text=%23AlargamosLaNavidad%20con%20%40MovistarCo%20Hola%2C%20necesito%20conocer%20el%20n%C3%BAmero%20de%20mi%20celular%20y%2Fo%20mi%20l%C3%ADnea%20fija" class="btnTwitter" data-lang="es" onclick="event.preventDefault(); ga('send', 'event', 'movistar', 'campaña-de-navidad', 'preguntar-twitter-personas');">Pregunta en Twitter</a>
	
});
