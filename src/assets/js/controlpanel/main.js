//Configuración general de elementos
$.notify.defaults({
  style: "bootstrap",
  showDuration: 250,
  autoHide: true,
  autoHideDelay: 3000,
  arrowShow: true,
  elementPosition: "bottom center",
  globalPosition: "right bottom",
});

// Configuración del tooltip, Bootstrap
const tooltipConfig = () => {
  const tooltipTriggerList = document.querySelectorAll(
    '[data-bs-toggle="tooltip"]'
  );
  const tooltipList = [...tooltipTriggerList].map(
    (tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl)
  );
};

const tooltipRemove = () => {
  document.querySelectorAll(".tooltip").forEach((element) => {
    element.remove();
  });
};
tooltipConfig();

// Gestionar modales

const openModal = (target) => {
  $(target).modal("show");
};

// Elementos
let globalModal = "";

const idSearchUser = document.querySelector("#idSearchUser");
const idSearchTherapist = document.querySelector("#idSearchTherapist");
const idSearchClient = document.querySelector("#idSearchClient");
const idSearchService = document.querySelector("#idSearchService");
const idSearchProduct = document.querySelector("#idSearchProduct");
const idSearchquotes = document.querySelector("#idSearchquotes");
const filterUser = document.querySelector("#filterUser");

// Definimos un FormData global, el que contendrá los datos de todos los modales y operaciones.
let formData = new FormData();

const handleListAll = (target, action) => {
  resetTables();
  const carpets = ["Administrador", "Data"];
  const actionTarget = [
    "usersinfo.php",
    "therapistsinfo.php",
    "clientsinfo.php",
    "servicesinfo.php",
    "productsinfo.php",
    "appointmentsinfo.php",
  ];
  const actionParams = [
    `rol=${filterUser.value}&all=true`,
    "all=true",
    "all=true",
    "all=true",
    "all=true",
    "all=true",
  ];

  $("#datatable" + action).dataTable(
    returnDatatableOption(
      action,
      `../controller/${carpets[target]}/${actionTarget[action]}?${actionParams[action]}`
    )
  );
  tooltipRemove();
};

const handleSearch = (target, action) => {
  resetTables();
  const carpets = ["Administrador", "Data"];
  const actionTarget = [
    "usersinfo.php",
    "therapistsinfo.php",
    "clientsinfo.php",
    "servicesinfo.php",
    "productsinfo.php",
    "appointmentsinfo.php",
  ];
  const actionParams = [
    idSearchUser.value,
    idSearchTherapist.value,
    idSearchClient.value,
    idSearchService.value,
    idSearchProduct.value,
    idSearchquotes.value,
  ];
  $("#datatable" + action).dataTable(
    returnDatatableOption(
      action,
      `../controller/${carpets[target]}/${actionTarget[action]}?id=${actionParams[action]}`
    )
  );
  tooltipRemove();
};

// Métodos POST Y PUT que servirán para realizar todas las operaciones de las tablas, crear, editar, obtener datos etc..
const handleRequest = (element, target, method, action) => {
  prepareFormData(element);
  const urls = {
    post: [
      "../controller/Administrador/createuser.php",
      "../controller/Administrador/createtherapist.php",
      "../controller/Create/createclient.php",
      "../controller/Create/createservice.php",
      "../controller/Create/createproduct.php",
      "../controller/Create/createQuote.php",
    ],
    put: [
      "../controller/Administrador/edituser.php",
      "../controller/Administrador/edittherapist.php",
      "../controller/Edit/editclient.php",
      "../controller/Edit/editservice.php",
      "../controller/Edit/editproduct.php",
      "../controller/Edit/editquote.php",
    ],
    status: [
      "../controller/Administrador/statususer.php",
      "../controller/Administrador/statustherapist.php",
      "../controller/Status/statusclient.php",
      "../controller/Status/statusservice.php",
      "../controller/Status/statusproduct.php",
      "../controller/Status/statusquote.php",
    ],
  };

  const successUrls = [
    "../controller/Administrador/usersinfo.php",
    "../controller/Administrador/therapistsinfo.php",
    "../controller/Data/clientsinfo.php",
    "../controller/Data/servicesinfo.php",
    "../controller/Data/productsinfo.php",
    "../controller/Data/appointmentsinfo.php",
  ];

  const url = urls[action][target];
  const success = successUrls[target];

  fetch(url, {
    method: method,
    body: formData,
  })
    .then((res) => res.json())
    .then((res) => {
      $.notify(res.data, res.response);
      if (res.response === "success") {
        resetTables();
        $("#datatable" + target).dataTable(
          returnDatatableOption(target, success)
        );
        clearData(element);
        if (action != "post") {
          $(globalModal).modal("hide");
        }
        target == 2 ? fillSelect() : "";
      }
    });
};

// Método para las funciones editar y cambiar estado
const handleModal = (element, target, action) => {
  const modals = [
    ["#editModalUsuario", "#statusModalUsuario"],
    ["#editModalTerapeuta", "#statusModalTerapeuta"],
    ["#editModalCliente", "#statusModalCliente"],
    ["#editModalServicio", "#statusModalServicio"],
    ["#editModalProducto", "#statusModalProducto"],
    ["#editModalquote", "#statusModalquote"],
  ];
  globalModal = modals[target][action];
  const elements = Array.from(element.parentElement.parentElement.children);
  elements.shift();
  elements.pop();
  elements.pop();
  const newElements = elements.map((e) => {
    return e.innerHTML;
  });
  fillData(modals[target][action], newElements);
};

// Fin de los métodos

// Función para llenar el FormData
const prepareFormData = (element) => {
  formData = new FormData();
  // Recorremos los inputs y select del formulario, luego de eso se procede a manipular el FormData con esos datos.
  element.parentElement.parentElement.children[1]
    .querySelectorAll("input")
    .forEach((e) => {
      const attributeName = e.attributes["name"].value;
      formData.append(attributeName, e.value);
    });
  element.parentElement.parentElement.children[1]
    .querySelectorAll("select")
    .forEach((e) => {
      const attributeName = e.attributes["name"].value;
      formData.append(attributeName, e.value);
    });
};

// Función para limpiar los datos de la modal
const clearData = (element) => {
  element.parentElement.parentElement.children[1]
    .querySelectorAll("input")
    .forEach((e) => {
      e.value = "";
    });
};

const fillData = (modal, data) => {
  let index = 0;
  const element = document.querySelector(modal);
  element.querySelectorAll("input").forEach((e, i) => {
    e.value = data[i];
    index++;
  });
  data.splice(0, index - 1);
  element.querySelectorAll("select").forEach((e) => {
    for (let i = 0; i < e.options.length; i++) {
      for (let j = 0; j < data.length; j++) {
        const valueOption = e.options[i].value.toUpperCase();
        const textOption = e.options[i].text.toUpperCase();
        let dataValue = data[j].toUpperCase();
        const nextIndex = j + 1 < e.options.length ? j + 1 : j;
        dataValue =
          modal != "#editModalUsuario" && modal != "#editModalTerapeuta"
            ? data[j].toUpperCase()
            : data[j].toUpperCase().substring(0, 2) +
              "-" +
              data[nextIndex].toUpperCase().substring(0, 2);

        if (valueOption == dataValue || textOption == dataValue) {
          e.selectedIndex = i;
        }
      }
    }
  });
  modal == "#editModalUsuario" || modal == "#editModalTerapeuta"
    ? (element.querySelectorAll("input")[5].value = "")
    : "";
  openModal(modal);
};

const fillSelect = () => {
  fetch("../controller/Data/servicesinfo.php?all=true")
    .then((res) => res.json())
    .then((res) => {
      const services = document.querySelectorAll(".services");
      services[0].innerHTML = "";
      services[1].innerHTML = "";
      res.forEach((e) => {
        services[0].innerHTML += `<option value=${e.id}>${e.nombre}</option>`;
        services[1].innerHTML += `<option value=${e.id}>${e.nombre}</option>`;
      });
    });
};

fillSelect();

//Llenar el campo de nombre con el id proporcionado
const search = (id) => {
  if (id != "") {
    $.ajax({
      url: "../controller/Data/search.php",
      method: "POST",
      data: { id: id },
      success: function (data) {
        nameUpdate(data);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.error("Error en la solicitud AJAX:", textStatus, errorThrown);
      },
    });
  } else {
    nameUpdate("");
  }
};
const nameUpdate = (name) => {
  $("#name").val(name);
};
// Inicializar el evento change para que al cambiar un valor dentro de un input, llene el nombre que esta en la base de datos
$(document).ready(function () {
  $("#id").on("change", function () {
    const id = $(this).val();
    search(id);
  });
});

const alertaMensaje = document.getElementById("alertMessage");
$(document).ready(function () {
  // Función para cargar fechas disponibles y deshabilitadas
  const loadAvailableDateTime = () => {
    $.ajax({
      url: "../controller/Data/validateDateTime.php",
      method: "GET",
      success: function (data) {
        const availableDateTime = JSON.parse(data);
        const minDate = availableDateTime.minDate;
        const disabledDates = availableDateTime.disabledDates;

        // configurar el min para el input de datetime-local
        document.querySelectorAll(".datetime").forEach((e) => {
          e.setAttribute("min", minDate);
        });
        // Change para disparar algun cambio
        $("#datetime").on("change", function () {
          const selectedDateTime = $(this).val(); // Obtener fecha y hora seleccionada
          console.log("Fecha y hora seleccionadas:", selectedDateTime);

          // Verificar si la fecha y hora están deshabilitadas en el controlador
          if (disabledDates.includes(selectedDateTime)) {
            alertaMensaje.innerHTML = `<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    La fecha y hora seleccionadas no están disponibles.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>`;
            $(this).val("");
          }
        });
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.error("Error en la solicitud AJAX:", textStatus, errorThrown);
      },
    });
  };

  // Cargar fechas disponibles y deshabilitadas al cargar la página
  loadAvailableDateTime();
});
