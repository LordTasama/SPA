let btnbuscar = document.getElementById("buscar");
let largo = 0;
let keys = [];
let ind = 0;
let ronda = 0;
let Paso = -1;
btnbuscar.addEventListener("click", cargarlink);
let Parametros = "";

function cargarlink() {
  let API = document.getElementById("LinkAPI").value + "";
  Parametros = document.getElementById("Parametros").value + "";
  if (API.length > 0) {
    autotabla(API);
  } else {
    Swal.fire({
      position: "top-end",
      icon: "error",
      title: "Faltan datos",
      showConfirmButton: false,
      timer: 1500,
    });
  }
}

function autotabla(API) {
  tablaactual = document.getElementById("tabla");
  if (tablaactual) {
    if (tablaactual.hasChildNodes()) {
      while (tablaactual.firstChild) {
        tablaactual.removeChild(tablaactual.lastChild);
      }
    }
  }
  elementosactuales = document.getElementById("elementostabla");
  if (elementosactuales) {
    if (elementosactuales.hasChildNodes()) {
      while (elementosactuales.firstChild) {
        elementosactuales.removeChild(elementosactuales.lastChild);
      }
    }
  }

  let cabeza = document.createElement("thead");
  cabeza.setAttribute("id", "appendcabezera");
  document.getElementById("tabla").append(cabeza);

  let thead = document.getElementById("appendcabezera");
  let tbody = document.getElementById("tabla");

  let cabezeratabla = document.createElement("tr");
  let elementostabla = document.createElement("tbody");

  cabezeratabla.setAttribute("id", "cabezeratabla");
  elementostabla.setAttribute("id", "elementostabla");

  fetch(API)
    .then((res) => res.json())
    .then((res) => {
      let f = true;
      let c;
      let cancelar = "";
      let results = res;

      // you can loop through all, assuming that each result set is the same.

      if (results.length > 0) {
        // iterating through the results array
        for (var i = 0; i < results.length; i++) {
          largo += 1 * results.length;
          // get i-th object in the results array
          var columnsIn = results[i];
          // loop through every key in the object
          if (f == true) {
            for (var key in columnsIn) {
              keys[ind] = key;
              ind += 1;
              if (cancelar == key && c == true) {
                f = false;

                break;
              }

              cabezeratabla.innerHTML += `<th scope="col">${key} </th>`;

              if (cancelar == "") {
                cancelar = key;
                c = true;
                ronda += 1;
              }
            }
          }
        }
      }

      for (let i = 0; i < results.length; i++) {
        let fila = document.createElement("tr");

        for (let j = 0; j < keys.length + Paso; j++) {
          let contenido = res[i][keys[j]] + "";
          JSON.stringify(contenido);
          contenido.replace(/"|{|}/g, " ");

          if (contenido.includes("https://")) {
            contenido = `<img src="${res[i][keys[j]]}" class="img-thumbnail">`;
          }

          fila.innerHTML += `<td scope="col">${contenido}  </td>`;

          elementostabla.appendChild(fila);
        }
      }

      //

      cabezeratabla.innerHTML += ` 
  </tbody>
</table>

`;
    });
  thead.append(cabezeratabla);
  tbody.append(elementostabla);

  largo = 0;
  keys = [];
  ind = 0;
  ronda = 0;
  Paso = -1;


setTimeout(() => {
  
  const datatables = document.querySelectorAll('.datatable');
    
   

  datatables.forEach(datatable => {
    if (!$.fn.dataTable.isDataTable(datatable)) {
      new DataTable(datatable, {
        responsive: {
          details: { type: "column", target: 0, renderer: createRenderer() },
        },
        layout: {
    
          topEnd:{ buttons: ['copy', 'excel', 'pdf', 'print']},
          bottomEnd: {
            buttons: ['pageLength'],
            }
        },

        language: {
          sProcessing:    "Procesando...",
          sLengthMenu:    "Mostrar _MENU_ registros",
          sZeroRecords:   "No se encontraron resultados",
          sEmptyTable:    "Ningún dato disponible en esta tabla",
          sInfo:          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
          sInfoEmpty:     "Mostrando registros del 0 al 0 de un total de 0 registros",
          sInfoFiltered:  "(filtrado de un total de _MAX_ registros)",
          sInfoPostFix:   "",
          sSearch:        "Buscar:",
          sUrl:           "",
          sInfoThousands:  ",",
          sLoadingRecords: "Cargando...",
          
          oPaginate: {
              sFirst:    "Primero",
              sLast:    "Último",
              sNext:    "Siguiente",
              sPrevious: "Anterior"
          },
          buttons: {
            copy: 'Copiar',
            excel: 'Exportar Excel',
            
            pdf: 'Exportar PDF',
            print: 'Imprimir'
          },
          oAria: {
              sSortAscending:  ": Activar para ordenar la columna de manera ascendente",
              sSortDescending: ": Activar para ordenar la columna de manera descendente"
          }
          }
    });}
      })
}, "300");

}
