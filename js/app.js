const app = new Vue({
    el: '#app',
    data:{
  
      periodo: ''
  
    },
    computed:{
  
      fechas(){
  
          var fecha = new Date();
          this.periodo = fecha.getMonth()+1;
  
          if(fecha.getMonth()+1 >=1 && fecha.getMonth()+1 <=8 )
          {
              this.periodo = (fecha.getFullYear()-1)+'-'+fecha.getFullYear();
          }
          else{
              this.periodo = fecha.getFullYear()+'-'+(fecha.getFullYear()+1);
          }
          return this.periodo
      }
  
    }
  
  
  
  })