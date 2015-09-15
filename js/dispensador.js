
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
		var hash=jQuery(this).attr('data-hash');
		var mensaje=jQuery('#mensaje').val();

		window.open('https://twitter.com/intent/tweet?text=%23'+hash+'%20con%20%40nestlecolombia%20'+mensaje, "width=200, height=50", "toolbar=0");
		console.log(hash);
	});

		/*Funcion para compartir en facebook*/
	var oli;
	function Share(url) {
	  FB.ui({
	  method: 'share_open_graph',
	  action_type: 'og:share',
	  action_properties: JSON.stringify({
	      object: oli,
	  })
	}, function(response){});
	}
	
		//<a href="https://twitter.com/intent/tweet?text=%23AlargamosLaNavidad%20con%20%40MovistarCo%20Hola%2C%20necesito%20conocer%20el%20n%C3%BAmero%20de%20mi%20celular%20y%2Fo%20mi%20l%C3%ADnea%20fija" class="btnTwitter" data-lang="es" onclick="event.preventDefault(); ga('send', 'event', 'movistar', 'campaña-de-navidad', 'preguntar-twitter-personas');">Pregunta en Twitter</a>
	
});


var validTitu=false;
var validHist=false;
var validFile=true;
var maxTitu=104;
var maxHist=201;

$(document).ready(function(){

	$('#mensaje').keyup('keypress',function(){
	    console.log("Ingreso");
	    var valor=$(this).val();
	    var log = parseInt(valor.toString().length+1);
	    $("#contador").html(maxTitu-log);

	    var contador = maxTitu-log;

	    if( contador <= 0 ){

	    	$(".bg-danger").slideDown();
	    	jQuery('.fa-twitter').attr("disabled", "disabled").addClass(" disabled");


	    }else{

	    	$("-bg-danger").slideUp;
	    	jQuery('.fa-twitter').removeAttr("disabled");
	    }

	}).focusout(function () {
	    // body...
	    var valor=$(this).val();
	    var log = parseInt(valor.toString().length+1);
	    if(log<=maxTitu && log>0){
	        validTitu=true;
	    }else{

	        validTitu=false;
	    }
	});
	/*$('#historia').keyup('keypress',function(){
	    var valor=$(this).val();
	    var log = parseInt(valor.toString().length+1);
	    $("#carcHist").html(maxHist-log);
	}).focusout(function () {
	    // body...
	    var valor=$(this).val();
	    var log = parseInt(valor.toString().length+1);
	    if(log<=maxHist && log>0){
	        console.log("historia valida");
	        validHist=true;
	    }else{
	        validHist=false;
	    }
	})*/



});