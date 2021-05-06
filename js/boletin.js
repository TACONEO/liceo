var fecha = new Date();
var anno = fecha.getFullYear();
var mes = fecha.getMonth();
var lapsos = '1';


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

    var grado_seccion = datos.get("grado")+datos.get("seccion");
    var periodos =  datos.get("periodo");

    
    if(datos.get("grado") != "0" && datos.get("seccion") != "0" && datos.get("periodo") != "0")
    {
       /* fetch("boletin.php", {method:"POST", body:datos})
        .then(respuesta => respuesta.json())
        .then(data=>{
            
            if(data=="Lapso1" || data=="Lapso2" || data=="Lapso3")
            {
                alert("Boletines Se Generaron Satisfactoriamente!!!")
            }
            formulario.reset();

           formulario.classList.toggle("d-none");

            var descargar = document.querySelector("#boletin2")

            descargar.classList.toggle("d-none");
          
            descargar.grado_seccion.value = grado_seccion;
            descargar.periodo2.value = periodos;
            descargar.lapso.value = data;

            descargar.addEventListener('submit', function(e){

                location.reload();
            })*/


            $.ajax({                        
                type: "POST",                 
                url: 'boletin.php',                    
                data: $('#boletin').serialize(),
                success: function(data)            
                {
                                        
                    
                    if(data=="Lapso1" || data=="Lapso2" || data=="Lapso3")
                    {
                        alert("Boletines Se Generaron Satisfactoriamente!!!")
                    }
                    formulario.reset();
        
                   formulario.classList.toggle("d-none");
        
                    var descargar = document.querySelector("#boletin2")
        
                    descargar.classList.toggle("d-none");
                  
                    descargar.grado_seccion.value = grado_seccion;
                    descargar.periodo2.value = periodos;
                    descargar.lapso.value = data;
        
                   
             

                }

            });

           
        



      

    }
    else{
            $control = 0;
            if(datos.get("grado")== "0" && $control==0){

                alert("Atención: Debe Seleccionar un Grado"); $control = 1;
            }

            if(datos.get("seccion")== "0" && $control==0){

                alert("Atención: Debe Seleccionar una Sección"); $control = 1;
            }

            if(datos.get("periodo")== "0" && $control==0){

                alert("Atención: Debe Seleccionar un Periodo");
            }
    }

   
})
