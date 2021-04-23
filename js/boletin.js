var fecha = new Date();
var anno = fecha.getFullYear();
var mes = fecha.getMonth();


var selec_periodo = document.getElementById("periodo");
var opcion = document.createElement("option");
opcion.value = "0";
opcion.text = "Seleccione el Periodo";
selec_periodo.add(opcion);


if(mes < 7)
{
   var inicio = anno - 1;
   var fin = anno;

   var periodo = inicio.toString()+"-"+fin.toString();
  // console.log(periodo)

  opcion = document.createElement("option");
  opcion.value = periodo;
  opcion.text = periodo;
  selec_periodo.add(opcion);

   var i = 0;
    
    while(i < 4){
        inicio = inicio - 1;
        fin = fin - 1 ;

        periodo = inicio.toString()+"-"+fin.toString();
       // console.log(periodo);
        opcion = document.createElement("option");
        opcion.value = periodo;
        opcion.text = periodo;
        selec_periodo.add(opcion);

        i++;

    }
      
}

if(mes >=7){

    var inicio = anno ;
    var fin = anno + 1 ;
 
    var periodo = inicio.toString()+"-"+fin.toString();
   // console.log(periodo)
 
   opcion = document.createElement("option");
   opcion.value = periodo;
   opcion.text = periodo;
   selec_periodo.add(opcion);
 
    var i = 0;
     
     while(i < 4){
         inicio = inicio - 1;
         fin = fin - 1 ;
 
         periodo = inicio.toString()+"-"+fin.toString();
         //console.log(periodo);
         opcion = document.createElement("option");
         opcion.value = periodo;
         opcion.text = periodo;
         selec_periodo.add(opcion);
 
         i++;
 
     }


}

var formulario = document.getElementById("boletin");

formulario.addEventListener("submit", function(e){

    e.preventDefault();
    var datos = new FormData(formulario);

    fetch("boletin.php", {method:"POST", body:datos})
    .then(respuesta => respuesta.json())
    .then(data=>{

            alert(data);
            formulario.reset();
    })
})
