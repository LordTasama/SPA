// CONSTANTES Y FUNCIONES REUTILIZABLES

const columnDefault = {
  empty: {
    data: null,
    defaultContent: "",
  },
  control: {
    className: "dt-control",
    orderable: false,
    targets: 0,
  },
  textStart: {
    className: "text-start",
    targets: 1,
  },
  editButton: (index) => ({
    data: null,
    defaultContent: `<i class="fa-solid fa-pencil text-primary mx-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Editar" style="cursor:pointer" onclick="handleModal(this,${index},0)"></i>
                     <i class="fa-solid fa-gear text-warning mx-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Estado" style="cursor:pointer" onclick="handleModal(this,${index},1)"></i>`,
  }),
  statusRender: {
    data: "estado",
    render: (data) => (data === 1 ? "Activo" : "Inactivo"),
  },
};

const obtainFilaName = () => {
  let fechaHoy = new Date();
  return `${fechaHoy.getFullYear()}-${
    fechaHoy.getMonth() + 1
  }-${fechaHoy.getDate()}.${fechaHoy.getHours()}.${fechaHoy.getMinutes()}.${fechaHoy.getSeconds()}.${fechaHoy.getMilliseconds()}`;
};

// FUNCIONES PARA CREAR CONFIGURACIONES DE COLUMNAS

const createUserColumns = () => [
  columnDefault.empty,
  { data: "id" },
  { data: "nombres" },
  { data: "apellidos" },
  { data: "telefono" },
  { data: "correo" },
  { data: "hora_inicio" },
  { data: "hora_fin" },
  {
    data: "id_rol",
    render: (data) => {
      switch (data) {
        case 1:
          return "Administrador";
        case 2:
          return "Secretaria";
        default:
          return "No definido";
      }
    },
  },
  columnDefault.statusRender,
  columnDefault.editButton(0),
];
const createTherapistColumns = () => [
  columnDefault.empty,
  { data: "id" },
  { data: "nombres" },
  { data: "apellidos" },
  { data: "telefono" },
  { data: "correo" },
  { data: "hora_inicio" },
  { data: "hora_fin" },
  columnDefault.statusRender,
  columnDefault.editButton(1),
];

const createClientColumns = () => [
  columnDefault.empty,
  { data: "id" },
  { data: "nombres" },
  { data: "apellidos" },
  { data: "direccion" },
  { data: "telefono" },
  { data: "correo" },
  columnDefault.statusRender,
  columnDefault.editButton(2),
];

const createServiceColumns = () => [
  columnDefault.empty,
  { data: "id" },
  { data: "nombre" },
  { data: "tipo" },
  { data: "duracion" },
  { data: "precio" },
  columnDefault.statusRender,
  columnDefault.editButton(3),
];

const createProductColumns = () => [
  columnDefault.empty,
  { data: "id" },
  { data: "stock" },
  { data: "nombre" },
  { data: "tipo" },
  { data: "precio" },
  columnDefault.statusRender,
  columnDefault.editButton(4),
];

const createAppointmentColumns = () => [
  columnDefault.empty,
  { data: "id" },
  { data: "fecha" },
  { data: "id_cliente" },
  { data: "id_servicio" },
  columnDefault.statusRender,
  columnDefault.editButton(5),
];

const columnConfig = [
  createUserColumns(),
  createTherapistColumns(),
  createClientColumns(),
  createServiceColumns(),
  createProductColumns(),
  createAppointmentColumns(),
];

// FUNCIONES PARA CREAR CONFIGURACIONES DE COLUMNDEF

const createColumnDefs = (editButtonIndex) => [
  columnDefault.control,
  columnDefault.textStart,
  { className: "text-center", targets: [editButtonIndex] },
  { responsivePriority: 1, targets: [0, 1, editButtonIndex] },
  { responsivePriority: 2, targets: [2, 3] },
];

const columnDefsConfig = [
  createColumnDefs(10),
  createColumnDefs(9),
  createColumnDefs(7),
  createColumnDefs(7),
  createColumnDefs(7),
  createColumnDefs(6),
];

// FUNCIONES PARA OBTENER NOMBRES DE ARCHIVOS

const layoutConfig = [
  () => `USUARIOS..${obtainFilaName()}`,
  () => `TERAPEUTAS..${obtainFilaName()}`,
  () => `CLIENTES..${obtainFilaName()}`,
  () => `SERVICIOS..${obtainFilaName()}`,
  () => `PRODUCTOS..${obtainFilaName()}`,
  () => `CITAS..${obtainFilaName()}`,
];
