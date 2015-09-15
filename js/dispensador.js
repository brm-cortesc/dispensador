
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