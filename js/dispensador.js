
var screenWidth = jQuery(window).width();
var pos = window.location.hash;

//Carga de modal promoción
jQuery(document).on("ready", function () {


	if ( pos != "#done" ) {

		// jQuery('#myModal').modal('show');

		// jQuery("#myModal").on("hide.bs.modal", function (e) {
			
		// 	window.location.hash = "#done";
		// 	dataLayer.push({'event' : 'cerrar-modal'});

		// });
		
		jQuery(".acordeon").slideDown();

		jQuery(".acordeon .close").on("click", function () {
			jQuery(".acordeon").slideUp();
			window.location.hash = "#done";
			dataLayer.push({'event' : 'cerrar-modal'});
		});


	};

});

/*Scroll down*/
$(window).scroll(function(){

	var opacity=1.3-($(window).scrollTop()/500);
	if(opacity>1)opacity=1;
	if(opacity<0)opacity=0;$('.scrollDown').fadeTo(10,opacity);});

	$('.scrollDown').click(function(){$('html,body').animate({scrollTop:$(window).scrollTop()+600+'px'},300);}).hover(function(){$(this).fadeTo(200,1);


});



/*Boton para ver mecanica*/
jQuery(document).on("click", ".btn-aqui", function () {
	
	/*Se muestrao/oculta el row con la mecanica*/
	jQuery(".mecanica").slideToggle(function () {

		jQuery(".btn-aqui").toggleClass('cerrar');
		


		if ( jQuery(".btn-aqui").hasClass('cerrar') ){

		/*Cambiamos img cuando el acordeon está abierto*/
			jQuery(".btn-aqui").attr('src', 'images/btn-cerrar.png');
			dataLayer.push({'event' : 'mecanica-abrir'});

		}
		else
		{
			jQuery(".btn-aqui").attr('src', 'images/btn-aqui.png');
			dataLayer.push({'event' : 'mecanica-cerrar'});

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
	
	/*FUncion para twittear desde la app*/
	jQuery('.fa-twitter').click(function(){
		//console.log('hola me dieron click');
		var tw=jQuery(this).attr('data-share');
		var hash=jQuery(this).attr('data-hash');
		var mensaje=jQuery('#mensaje').val();

		window.open('https://twitter.com/intent/tweet?text=%23'+hash+'%20con%20%40nestlecolombia%20'+mensaje, "width=200, height=50", "toolbar=0");
		dataLayer.push({'event' : 'share-tw'});
		//console.log(hash);
	});

		/*Funcion para compartir en facebook*/


		window.fbAsyncInit = function() {
 		  FB.init({
 		    appId      : '443666442492858',
 		    xfbml      : true,
 		    version    : 'v2.4'
 		  });
 		};

 		(function(d, s, id){
 		   var js, fjs = d.getElementsByTagName(s)[0];
 		   if (d.getElementById(id)) {return;}
 		   js = d.createElement(s); js.id = id;
 		   js.src = "//connect.facebook.net/en_US/sdk.js";
 		   fjs.parentNode.insertBefore(js, fjs);
 		 }(document, 'script', 'facebook-jssdk'));


	/*var oli;
	function Share(url) {
	  FB.ui({
	  method: 'share_open_graph',
	  action_type: 'og:share',
	  action_properties: JSON.stringify({
	      object: oli,
	  })
	}, function(response){});
	}*/
jQuery('.fa-send').click(function(){
		//console.log('hola me dieron click');
	var fb=jQuery(this).attr('data-share');
	var hashf=jQuery(this).attr('data-hash');
	var mensaje=jQuery('#mensaje').val();

	/*Funcion que permite postear en el muro del usuario*/
	FB.login(function(){
  	// Note: The call will only work if you accept the permission request
  	FB.api('/me/feed', 'post', {message: "#"+hashf+" "+mensaje+" con NESTLÉ COLOMBIA"});
	}, {scope: 'public_profile,publish_actions'});
	dataLayer.push({'event' : 'share-fb'});


});
jQuery('.fa-facebook').click(function(){
		//console.log('hola me dieron click');
	var fb=jQuery(this).attr('data-share');
	var hashf=jQuery(this).attr('data-hash');
	var mensaje=jQuery('#mensaje').val();


	var postea ="#"+hashf+" "+mensaje+" con NESTLÉ COLOMBIA";

	/*FUncion que postea lo que escribe el usuario como un post embebido */
	FB.ui({
  	method: 'feed',
 	 link: 'http://fbapp.brm.com.co/fbappNestle/dispensadorAmistad/',
 	 caption:postea,
	}, function(response){});
	dataLayer.push({'event' : 'share-fb'});	

});


	
		//<a href="https://twitter.com/intent/tweet?text=%23AlargamosLaNavidad%20con%20%40MovistarCo%20Hola%2C%20necesito%20conocer%20el%20n%C3%BAmero%20de%20mi%20celular%20y%2Fo%20mi%20l%C3%ADnea%20fija" class="btnTwitter" data-lang="es" onclick="event.preventDefault(); ga('send', 'event', 'movistar', 'campaña-de-navidad', 'preguntar-twitter-personas');">Pregunta en Twitter</a>
	
});


var validTitu=false;
var validHist=false;
var validFile=true;
var maxTitu=104;
var maxHist=201;

// $(document).on('click', '.desplegado', function() {
// 	event.preventDefault();
// 	$(this).parent().removeClass('img-completa');
// 	$(this).parent().removeClass('desplegado');
// 	$(this).html("Ver imagen");
// 	/* Act on the event */
// });

$(document).ready(function(){

	//Mostrar fototweet*/
	// jQuery(".mostrar-img").on('click',function() {

	// 	$(this).parent().addClass('img-completa');
	// 	$(this).addClass('desplegado');
	// 	$(this).html("cerrar");
	// });

	$('#mensaje').keyup('keypress',function(){
	    console.log("Ingreso");
	    var valor=$(this).val();
	    var log = parseInt(valor.toString().length+1);
	    $("#contador").html(maxTitu-log);

	    var contador = maxTitu-log;

	    if( contador <= 0 ){

	    	$(".bg-danger").slideDown();
	    	jQuery('.fa').attr("disabled", "disabled").addClass(" disabled");


	    }else{

	    	$(".bg-danger").slideUp();
	    	jQuery('.fa').removeAttr("disabled");
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

/*Cerrar img tweet*/

jQuery(document).on('click', '.mostrar-img', function() {

		// $(this).parent().removeClass('img-completa');
		// $(this).html("Ver imagen");
		// $(this).removeClass('desplegado');
		$(this).parent().addClass('img-completa');
		$(this).addClass('desplegado');
		$(this).html("cerrar");

});


jQuery(document).on('click', '.desplegado', function() {

		$(this).parent().removeClass('img-completa');
		$(this).html("Ver imagen");
		$(this).removeClass('desplegado');

});


/*Animacion buzón */
(function() {

	/*Funcion anonima para hacer compatibilidad de canvas y animationsframes*/
    var lastTime = 0;
    var vendors = ['ms', 'moz', 'webkit', 'o'];
    for(var x = 0; x < vendors.length && !window.requestAnimationFrame; ++x) {
        window.requestAnimationFrame = window[vendors[x]+'RequestAnimationFrame'];
        window.cancelAnimationFrame = window[vendors[x]+'CancelAnimationFrame'] 
                                   || window[vendors[x]+'CancelRequestAnimationFrame'];
    }
 
    if (!window.requestAnimationFrame)
        window.requestAnimationFrame = function(callback, element) {
            var currTime = new Date().getTime();
            var timeToCall = Math.max(0, 16 - (currTime - lastTime));
            var id = window.setTimeout(function() { callback(currTime + timeToCall); }, 
              timeToCall);
            lastTime = currTime + timeToCall;
            return id;
        };
 
    if (!window.cancelAnimationFrame)
        window.cancelAnimationFrame = function(id) {
            clearTimeout(id);
        };
}());

(function () {

	/*Variables, objeto img, y donde se pinta*/
			
	var buzon,
		buzonImage,
		canvas;

	var alto = 0;			


	/*Con esto hacemos correr la animacion*/
	function chocoLoop () {

	
	  window.requestAnimationFrame(chocoLoop);

	  buzon.update();
	  buzon.render();
	}

	/*Funciones de alto, ancho & img source*/
	
	function sprite (options) {
	
		var that = {},
			frameIndex = 0,
			tickCount = 0,
			ticksPerFrame = options.ticksPerFrame || 0,
			numberOfFrames = options.numberOfFrames || 1;
		
		that.context = options.context;
		that.width = options.width;
		that.height = options.height;
		that.image = options.image;
		
		that.update = function () {

            tickCount += 1;

            /*Con esto hacemos mover 1 frame a la izquierda el sprite para generar el movimiento*/

            if (tickCount > ticksPerFrame) {

					tickCount = 0;
					
	                // If the current frame index is in range
	                if (frameIndex < numberOfFrames - 1) {	
	                    // Go to the next frame
	                    frameIndex += 1;
	                    alto = 0; 


	                }else{
	                	frameIndex = 0;

	                    // alto = 1608;
	                    // console.log("no cumplie")

	                }
	            }
        };
		
		that.render = function () {
		
		  // Clear the canvas
		  that.context.clearRect(0, 0, that.width, that.height);
		  
		  // Draw the animation
		   that.context.drawImage(
		     that.image,// imagen que cargamos
		     frameIndex * that.width / numberOfFrames, //Ancho
		     alto,//alto
		     that.width / numberOfFrames,//esto calcula el ancho de cada frame individual
		     that.height, 
		     0,
		     0,
		     that.width / numberOfFrames,
		     that.height);
		 };
		
		return that;
	}
	
	// Get canvas
	canvas = document.getElementById("buzon");
	canvas.width = 700;
	canvas.height = 402;
	
	// Create sprite sheet
	buzonImage = new Image();	
	
	// Create sprite
	buzon = sprite({
		context: canvas.getContext("2d"),
		width: 56000,
		height: 402,
		image: buzonImage,
		numberOfFrames: 80,
		ticksPerFrame: 3
	});
	
	// Load sprite sheet
	buzonImage.addEventListener("load", chocoLoop);
	buzonImage.src = "images/sprite-recubiertos.png";

} ());