// En este archivo se utilizan los objetos del archivo "globalvars.js"
// Objetos utilizados: columnConfig, layoutConfig, columnDefsConfig.

const createRenderer = () => {
  return function (api, rowIdx, columns) {
    var data = $.map(columns, function (col, i) {
      if (col.columnIndex == 0) {
        return (
          '<tr class="border-1 p-1" data-dt-row="' +
          col.rowIndex +
          '" data-dt-column="' +
          col.columnIndex +
          '">' +
          '<td class="border-1 p-1">' +
          col.title +
          "</td> " +
          "<td>" +
          "#" +
          "</td>" +
          "</tr>"
        );
      } else if (col.title != "Acciones") {
        return (
          '<tr class="border-1 p-1" data-dt-row="' +
          col.rowIndex +
          '" data-dt-column="' +
          col.columnIndex +
          '">' +
          '<td class="border-1 p-1">' +
          col.title +
          "</td> " +
          "<td>" +
          col.data +
          "</td>" +
          "</tr>"
        );
      }
    }).join("");
    return $("<table/>").append(data) ? data : false;
  };
};

const createExportOptions = (columns, index) => {
  return {
    columns: columns,
    format: {
      body: function (data, row, column, node) {
        let datos = data + "";
        return column === index
          ? datos.replace(/\B(?=(\d{3})+(?!\d))/g, ".")
          : datos;
      },
    },
  };
};

const createButtons = (titles, filenames, columns, numberFormat) => {
  return [
    {
      extend: "colvis",
      text: `<i class="fa-solid fa-eye"></i>`,
      className: "btn btn-secondary mx-2 datatable-buttons",
      attr: {
        "data-bs-toggle": "tooltip",
        "data-bs-placement": "top",
        "data-bs-custom-class": "custom-tooltip-visibility",
        "data-bs-title": "Visibilidad de las columnas",
      },
    },
    {
      extend: "pdf",
      text: `<i class="fa-solid fa-file-pdf"></i>`,
      className: "btn btn-danger mx-2 datatable-buttons",
      title: titles.pdf,
      filename: filenames.pdf,
      attr: {
        "data-bs-toggle": "tooltip",
        "data-bs-placement": "top",
        "data-bs-custom-class": "custom-tooltip-pdf",
        "data-bs-title": "Generar PDF",
      },
      exportOptions: createExportOptions(columns, numberFormat),
      action: (e, dt, node, config, cb) => {
        DataTable.ext.buttons.pdfHtml5.action.call(
          this,
          e,
          dt,
          node,
          config,
          cb
        );
        tooltipRemove();
      },
    },
    {
      extend: "excel",
      text: `<i class="fa-solid fa-file-excel"></i>`,
      className: "btn btn-success mx-2 datatable-buttons",
      title: titles.excel,
      filename: filenames.excel,
      attr: {
        "data-bs-toggle": "tooltip",
        "data-bs-placement": "top",
        "data-bs-custom-class": "custom-tooltip-excel",
        "data-bs-title": "Generar Excel",
      },
      exportOptions: createExportOptions(columns, numberFormat),
      action: (e, dt, node, config, cb) => {
        DataTable.ext.buttons.excelHtml5.action.call(
          this,
          e,
          dt,
          node,
          config,
          cb
        );
        tooltipRemove();
      },
    },
    {
      extend: "print",
      text: `<i class="fa-solid fa-print"></i>`,
      className: "btn btn-warning mx-2 datatable-buttons",
      title: titles.print,
      filename: filenames.print,
      customize: function (win) {
        $(win.document.body).find("h1").css("text-align", "center");
        $(win.document.body).css("font-size", "7px");
        $(win.document.body)
          .find("table")
          .addClass("compact")
          .css("font-size", "inherit");
      },
      attr: {
        "data-bs-toggle": "tooltip",
        "data-bs-placement": "top",
        "data-bs-custom-class": "custom-tooltip-print",
        "data-bs-title": "Imprimir",
      },
      exportOptions: createExportOptions(columns, numberFormat),
      action: (e, dt, node, config, cb) => {
        DataTable.ext.buttons.print.action.call(this, e, dt, node, config, cb);
        tooltipRemove();
      },
    },
  ];
};

const createCustomButton = (icon, title, modal) => {
  return {
    extend: "",
    text: `<i class="fa-solid ${icon}"></i>`,
    className: "btn btn-secondary mx-2 datatable-buttons",
    attr: {
      "data-bs-toggle": "tooltip",
      "data-bs-placement": "top",
      "data-bs-custom-class": "custom-tooltip-visibility",
      "data-bs-title": title,
      onclick: `openModal('${modal}')`,
    },
  };
};

const returnDatatableOption = (condition, URL) => {
  const datatableOptions = {
    lengthMenu: [5, 10, 15, 50, 100, 150],
    pageLength: 5,
    responsive: {
      details: { type: "column", target: 0, renderer: createRenderer() },
    },
    ajax: { url: "", dataSrc: "" },
    columns: "",
    layout: { topCenter: { buttons: [] } },
    columnDefs: "",
    order: [],
    language: {
      lengthMenu: "Mostrar _MENU_ datos por página",
      zeroRecords: "Ningún dato encontrado",
      info: "_TOTAL_ Registros",
      infoEmpty: "Ningún dato encontrado",
      emptyTable: "Sin datos para mostrar",
      infoFiltered: "(filtrados desde _MAX_ datos totales)",
      search: "Buscar: ",
      searchPlaceholder: "Digite algún parámetro",
      loadingRecords: "Cargando...",
    },
    initComplete: function (settings, json) {
      tooltipConfig();
      $("#datatable" + condition).on("draw.dt", () => {
        tooltipConfig();
      });
    },
  };

  const configOptions = [
    {
      columns: columnConfig[0],
      titles: {
        pdf: "LISTA DE USUARIOS",
        excel: "LISTA DE USUARIOS",
        print: "LISTA DE USUARIOS",
      },
      filenames: {
        pdf: layoutConfig[0],
        excel: layoutConfig[0],
        print: layoutConfig[0],
      },
      exportColumns: [1, 2, 3, 4, 5, 6, 7, 8],
      customButton: createCustomButton(
        "fa-user-plus",
        "Agregar usuario",
        "#modalUsuario"
      ),
    },
    {
      columns: columnConfig[1],
      titles: {
        pdf: "LISTA DE TERAPEUTAS",
        excel: "LISTA DE TERAPEUTAS",
        print: "LISTA DE TERAPEUTAS",
      },
      filenames: {
        pdf: layoutConfig[1],
        excel: layoutConfig[1],
        print: layoutConfig[1],
      },
      exportColumns: [1, 2, 3, 4, 5, 6, 7],
      customButton: createCustomButton(
        "fa-user-plus",
        "Agregar terapeuta",
        "#modalTerapeuta"
      ),
    },
    {
      columns: columnConfig[2],
      titles: {
        pdf: "LISTA DE CLIENTES",
        excel: "LISTA DE CLIENTES",
        print: "LISTA DE CLIENTES",
      },
      filenames: {
        pdf: layoutConfig[2],
        excel: layoutConfig[2],
        print: layoutConfig[2],
      },
      exportColumns: [1, 2, 3, 4, 5, 6, 7],
      customButton: createCustomButton(
        "fa-user-plus",
        "Agregar cliente",
        "#modalCliente"
      ),
    },
    {
      columns: columnConfig[3],
      titles: {
        pdf: "LISTA DE SERVICIOS",
        excel: "LISTA DE SERVICIOS",
        print: "LISTA DE SERVICIOS",
      },
      filenames: {
        pdf: layoutConfig[3],
        excel: layoutConfig[3],
        print: layoutConfig[3],
      },
      exportColumns: [1, 2, 3, 4, 5, 6],
      customButton: createCustomButton(
        "fa-bell-concierge",
        "Agregar servicio",
        "#modalServicio"
      ),
    },
    {
      columns: columnConfig[4],
      titles: {
        pdf: "LISTA DE PRODUCTOS",
        excel: "LISTA DE PRODUCTOS",
        print: "LISTA DE PRODUCTOS",
      },
      filenames: {
        pdf: layoutConfig[4],
        excel: layoutConfig[4],
        print: layoutConfig[4],
      },
      exportColumns: [1, 2, 3, 4, 5, 6],
      customButton: createCustomButton(
        "fa-tag",
        "Agregar producto",
        "#modalProducto"
      ),
    },
    {
      columns: columnConfig[5],
      titles: {
        pdf: "LISTA DE CITAS",
        excel: "LISTA DE CITAS",
        print: "LISTA DE CITAS",
      },
      filenames: {
        pdf: layoutConfig[5],
        excel: layoutConfig[5],
        print: layoutConfig[5],
      },
      exportColumns: [1, 2, 3, 4, 5, 6],
      customButton: createCustomButton(
        "fa-calendar-check",
        "Agregar cita",
        "#modalCita"
      ),
    },
    {
      columns: [{ data: "Servicio" }, { data: "Total" }],
      titles: {
        pdf: "INGRESOS POR PERIODO",
        excel: "INGRESOS POR PERIODO",
        print: "INGRESOS POR PERIODO",
      },
      filenames: {
        pdf: `INGRESOS_PERIODO..${obtainFilaName()}`,
        excel: `INGRESOS_PERIODO..${obtainFilaName()}`,
        print: `INGRESOS_PERIODO..${obtainFilaName()}`,
      },
      exportColumns: [0, 1],
    },
    {
      columns: [{ data: "Servicio" }, { data: "Total" }],
      titles: {
        pdf: "INGRESOS POR PERIODO",
        excel: "INGRESOS POR PERIODO",
        print: "INGRESOS POR PERIODO",
      },
      filenames: {
        pdf: `INGRESOS_PERIODO..${obtainFilaName()}`,
        excel: `INGRESOS_PERIODO..${obtainFilaName()}`,
        print: `INGRESOS_PERIODO..${obtainFilaName()}`,
      },
      exportColumns: [1, 2],
    },
    {
      columns: [
        { data: "id_cliente" },
        { data: "nombres" },
        { data: "apellidos" },
        { data: "nombre" },
        { data: "Frecuencia del servicio" },
      ],
      titles: {
        pdf: "CLIENTES FRECUENTES",
        excel: "CLIENTES FRECUENTES",
        print: "CLIENTES FRECUENTES",
      },
      filenames: {
        pdf: `CLIENTES_FRECUENTES..${obtainFilaName()}`,
        excel: `CLIENTES_FRECUENTES..${obtainFilaName()}`,
        print: `CLIENTES_FRECUENTES..${obtainFilaName()}`,
      },
      exportColumns: [0, 1, 2, 3, 4],
    },
    {
      columns: [{ data: "Servicio" }, { data: "Total" }],
      titles: {
        pdf: "INGRESOS POR PERIODO",
        excel: "INGRESOS POR PERIODO",
        print: "INGRESOS POR PERIODO",
      },
      filenames: {
        pdf: `INGRESOS_PERIODO..${obtainFilaName()}`,
        excel: `INGRESOS_PERIODO..${obtainFilaName()}`,
        print: `INGRESOS_PERIODO..${obtainFilaName()}`,
      },
      exportColumns: [1, 2],
    },
  ];
  const numberFormat =
    condition == 0 || condition == 1 || condition == 8 ? 1 : 3;
  const config = configOptions[condition];
  datatableOptions.columns = config.columns;
  datatableOptions.ajax.url = URL;
  datatableOptions.layout.topCenter.buttons = [
    ...createButtons(
      config.titles,
      config.filenames,
      config.exportColumns,
      numberFormat
    ),
    config.customButton,
  ];
  if (condition < 6) {
    datatableOptions.columnDefs = columnDefsConfig[condition];
  } else {
    if (condition == 6) {
      datatableOptions.columnDefs = [
        { responsivePriority: 1, targets: [0] },
        { responsivePriority: 2, targets: [1] },
      ];
    } else if (condition == 7) {
      datatableOptions.columnDefs = [
        columnDefault.textStart,
        { responsivePriority: 1, targets: [0, 1] },
        { responsivePriority: 2, targets: [2] },
      ];
    } else if (condition == 8) {
      datatableOptions.columnDefs = [
        { className: "text-start", targets: 0 },
        { responsivePriority: 1, targets: [0, 1] },
        { responsivePriority: 2, targets: [2] },
      ];
    } else if (condition == 9) {
      datatableOptions.columnDefs = [
        columnDefault.textStart,
        { responsivePriority: 1, targets: [0, 1] },
        { responsivePriority: 2, targets: [2] },
      ];
    }
  }
  console.log(datatableOptions);
replaceid()
  return datatableOptions;
  
};

const resetTables = () => {
  for (let i = 0; i <= 6; i++) {
    if ($.fn.DataTable.isDataTable("#datatable" + i)) {
      $("#datatable" + i)
        .DataTable()
        .destroy();
    }
    $("#datatable" + i + " tbody").empty();
  }
};
      function replaceid() {
        setTimeout(() => {
          replaceidname();
        }, "100");
      }