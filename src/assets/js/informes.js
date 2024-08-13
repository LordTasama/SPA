let opcion = document.getElementById("opcionInforme");
let fechaInicio = document.getElementById("fechaInicio");
let fechaFin = document.getElementById("fechaFin");
let generarInforme = document.getElementById("generarInforme");
let mensaje = document.getElementById("mensaje");

opcion.addEventListener("change", function () {
  if (opcion.value == "Ingresos" || opcion.value == "Ocupacion") {
    fechaInicio.removeAttribute("disabled");
    fechaFin.removeAttribute("disabled");
  } else {
    fechaInicio.setAttribute("disabled", "");
    fechaFin.setAttribute("disabled", "");
  }
});

generarInforme.addEventListener("click", function () {
  if (
    opcion.value == "Ingresos" 
   
  ) 
  
  {
   if( fechaFin.value != "" &&
    fechaInicio.value != ""){
   
    let fechaInicioAdaptada = fechaInicio.value
    let fechaFinAdaptada = fechaFin.value
    autotabla("../controller/Data/graphsinfo.php?query=ingresos&fechaInicio="+fechaInicioAdaptada+"&fechaFin="+fechaFinAdaptada)
    mensaje.innerText = ""
    mensaje.setAttribute("class","")
  }
  else{
    mensaje.innerText = "Seleccione el límite de búsqueda, por favor"
    mensaje.setAttribute("class","bg-warning rounded p-2 m-3  text-white")
  }
  }

 

  if (
    opcion.value == "Ocupacion"

  ) {
    if(    fechaFin.value != "" &&
      fechaInicio.value != ""){
    let fechaInicioAdaptada = fechaInicio.value
    let fechaFinAdaptada = fechaFin.value
   autotabla("../controller/Data/graphsinfo.php?query=ocupacion&fechaInicio="+fechaInicioAdaptada+"&fechaFin="+fechaFinAdaptada)
   mensaje.innerText = ""
   mensaje.setAttribute("class","")
  }
  else{
    mensaje.innerText = "Seleccione el límite de búsqueda, por favor"
    mensaje.setAttribute("class","bg-warning rounded p-2 m-3 text-white")
  }
  }


  if (opcion.value == "Clientes") {
   autotabla("../controller/Data/graphsinfo.php?query=clientes")
   mensaje.innerText = ""
   mensaje.setAttribute("class","")

  }

  if (opcion.value == "Inventario") {
    mensaje.innerText = ""
autotabla("../controller/Data/graphsinfo.php?query=inventario")
mensaje.setAttribute("class","")
  }
});