/************  REGISTRO DEL PERSONAL ************************* */


var formulario = document.querySelector(".formulario");
var boton = document.querySelector(".boton");

$(document).ready(function()
{
      

      $(".modal").modal("show");

                   
});

formulario.addEventListener("click", function(e){

      e.stopPropagation();

     
      var elemento = e.target;

      var siguiente = elemento.classList.contains("siguiente");
      var regresar = elemento.classList.contains("atras");

      if(siguiente || regresar){

            var actual = document.getElementById("paso-"+elemento.dataset.actual);
            var sigue = document.getElementById("paso-"+elemento.dataset.siguiente);
           

            if(elemento.dataset.siguiente == 2){
                  $(".modal").css("height","400px");
                }
      
                if(elemento.dataset.siguiente == 3){
                  $(".modal").css("height","580px");
                }
                if(elemento.dataset.siguiente == 4){
                  $(".modal").css("height","450px");
                }
                if(elemento.dataset.siguiente == 1){
                  $(".modal").css("height","1000px");
                }

                  actual.classList.remove("activo")
                 
                  sigue.classList.add("activo")

                  if(siguiente){
                        actual.classList.add("izquierda")
                              
                  }else{

                      sigue.classList.remove("izquierda");
                  }
            
          

      }


})

/************ FIN DE REGISTRO DEL PERSONAL ************************* */

//var registro = document.getElementById("registra_per");
/* ********************** VALIDAR SÓLO NYMEROS ******************************** */
        formulario.cedula.addEventListener('keypress', function (e){
            if (!soloNumeros(event)){
                    e.preventDefault();

                }
        })

                      

           // Solo permite introducir numeros.
                function soloNumeros(e){
                    var key = e.charCode;
                   
                    return key >= 48 && key <= 57;
                }



var video = document.getElementById("video_p");
var canvas = document.getElementById("canvas_p");
var btn = document.getElementById("boton_p");
var btn2 = document.getElementById("boton2_p");


     function tieneSoporteUserMedia(){
 return !!(navigator.getUserMedia || (navigator.mozGetUserMedia ||  navigator.mediaDevices.getUserMedia) || navigator.webkitGetUserMedia || navigator.msGetUserMedia)
 }

function _getUserMedia(){
  return (navigator.getUserMedia || (navigator.mozGetUserMedia ||  navigator.mediaDevices.getUserMedia) || navigator.webkitGetUserMedia || navigator.msGetUserMedia).apply(navigator, arguments);
}

if (tieneSoporteUserMedia()) {
_getUserMedia(
{video: true},
function (stream) {
    console.log("Permiso concedido");
    video.srcObject = stream;
   
   

    video.play();
   
   

    
}, function (error) {
    console.log("Permiso denegado o error: ", error);
});
} else {
alert("Lo siento. Tu navegador no soporta esta característica");
}







btn.addEventListener("click", function(){

console.log("QQQQQQQQQ")

if(formulario.cedula.value!=0){

//Pausar reproducción
video.pause();

canvas.classList.remove("d-none");

video.classList.add("d-none");
btn.classList.add("d-none");
btn2.classList.remove("d-none");

//Obtener contexto del canvas y dibujar sobre él
var contexto = canvas.getContext("2d");
canvas.width = video.videoWidth;
canvas.height = video.videoHeight;
contexto.drawImage(video, 0, 0, canvas.width, canvas.height);

var foto = canvas.toDataURL(); //Esta es la foto, en base 64
foto = encodeURIComponent(foto);

const fotos = {
"captura": foto,
"cedula": formulario.cedula.value,
"guarda": "../fotos/personal/",
// Aquí más datos...
};
// Aquí la ruta en donde enviamos la foto. Podría ser una absoluta o relativa
const ruta = "http://localhost/PROYECTO_LICEO/php/guardar_foto.php";
fetch(ruta, {
method: "POST",
body: JSON.stringify(fotos),
headers: {
"Content-type": "application/x-www-form-urlencoded",
}
})
.then(resultado2 => resultado2.json())
.then(nombreDeLaFoto => {
// nombreDeLaFoto trae el nombre de la imagen que le dio PHP
console.log({ nombreDeLaFoto });
alert(`Guardada como ${nombreDeLaFoto}`);

});


//Reanudar reproducción
video.play();


}else{

alert("Debe Ingresar Cédula");
}



});



btn2.addEventListener("click", function(){

canvas.classList.add("d-none");

video.classList.remove("d-none");
btn.classList.remove("d-none");
btn2.classList.add("d-none");



})




