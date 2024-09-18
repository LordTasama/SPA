import { GetHost, SetTitle, SetError, SetCatchModal, SetSucessModal, SetLoading, FillSelect, SetSelectOpt, ValidForm } from '../../../Assets/Js/globals.functions.js';
import { } from '../Assets/Helper/Admin.Layout.js';
import { SetAsideActive } from '../../Utils/asidebar.js';
import { DefaultOptions, SetColumns, FillTable } from '../Assets/Js/table.js';
import { SetModal, ShowModal } from '../../../Assets/Js/modal.js';
SetTitle('Usuarios');
SetAsideActive('Usuarios');
//Set columns
const Columns = [
    'Id',
    'Nombre',
    'Apellidos',
    'Correo',
    'Rol',
    ''
];
const btnNuevo = document.getElementById('btnNuevo');
const dataTable = document.getElementById('dataTable');
let arrayRoles = [];
fetch(`${GetHost()}/Back/Controllers/spaEmpelados/roles/controlador_select_rol.php`).then(response => response.json())
    .then(data => {
        arrayRoles = data;
    })
    .catch(err => {
        SetCatchModal(err);
    })
fetch(`${GetHost()}/Back/Controllers/spaEmpelados/usuarios/controlador_Select_usuario.php`).then(response => response.json())
.then(data => {
    FillTable(dataTable, data, 'ambos');
    SetButtons();
}).catch(err => {
    SetModal(
        `
        <div class="text-danger">
            <i class="bi bi-emoji-frown-fill"></i>
            ERROR <span class="fs-6">${err}</span>
        </div>
        `,
        'Ha ocurrido un fallo con el servidor, te recomendamos <b>recargar la pagina</b>',
        `<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Aceptar</button>`
    );
    ShowModal();
}).finally(()=>{
    new DataTable('#dataTable', DefaultOptions('usuarios', Columns.length - 1));
});
const SetButtons = () => {
    var btnEdit = document.querySelectorAll('.btn-outline-info');
    btnEdit.forEach(item => {
        item.addEventListener('click', () => {
            var dataNode = item.parentElement.parentElement.parentElement.parentElement.childNodes;
            SetModal(
                `
                <div class="text-info">
                    <i class="bi bi-pencil-square"></i>
                    Editar Usuario
                </div>
                `,
                `
                <form id="frmEditar">
                    <div class="row flex-column">
                        <div class="col">
                            <div class="row row-cols-1 row-cols-md-2">
                                <div class="col mb-2">
                                    <label class="ms-1 mb-1 text-black-50" for="nombre">Nombre</label>
                                    <input class="form-control" type="text" name="nombre" id="nombre" value="${dataNode[1].innerText}" required>
                                </div>
                                <div class="col mb-2">
                                    <label class="ms-1 mb-1 text-black-50" for="apellido">Apellido</label>
                                    <input class="form-control" type="text" name="apellido" id="apellido" value="${dataNode[2].innerText}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col mb-2">
                            <label class="ms-1 mb-1 text-black-50" for="correo">Correo</label>
                            <input class="form-control" type="email" name="correo" id="correo" value="${dataNode[3].innerText}" required>
                        </div>
                        <div class="col">
                            <label class="ms-1 mb-1 text-black-50" for="idRol">Servicio</label>
                            <select class="form-select" name="id_Rol" id="idRol"></select>
                        </div>
                    </div>
                </form>
                `,
                `
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-info" id="btnEditar">Guardar</button
                `
            );
            FillSelect('idRol', arrayRoles);
            SetSelectOpt('idRol', dataNode[4].innerText)
            ShowModal();
            var btnEditar = document.getElementById('btnEditar');
            btnEditar.addEventListener('click', () => {
                if (ValidForm('frmEditar')) {
                    SetLoading(btnEditar);
                    var formData = new FormData(document.getElementById('frmEditar'));
                    formData.append('id', parseInt(dataNode[0].innerText));
                    var object = {};
                    formData.forEach((value, key) => {
                        object[key] = value;
                    });
                    //Set controller and send data for body
                    $.ajax({
                        url: `${GetHost()}/Back/Controllers/spaEmpelados/usuarios/controlador_edit_usuario.php`,
                        type: 'POST',
                        data: object,
                        success: function (data) {
                            SetSucessModal(data);
                        },
                        error: function (err) {
                            SetCatchModal(err);
                        }
                    });
                };
            });
        });
    });
    var btnDelete = document.querySelectorAll('.btn-danger');
    btnDelete.forEach(item => {
        item.addEventListener('click', () => {
            var dataNode = item.parentElement.parentElement.parentElement.parentElement.childNodes;
            SetModal(
                `
                <div class="text-info">
                    <i class="bi bi-trash-fill"></i>
                    Eliminar Cliente
                </div>
                `,
                `
                ¿Seguro que quieres eliminar a "<b>${dataNode[1].innerText} ${dataNode[2].innerText}</b>"?
                `,
                `
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-danger" id="btnEliminar">Eliminar</button
                `
            );
            ShowModal();
            var btnEliminar = document.getElementById('btnEliminar');
            btnEliminar.addEventListener('click', () => {
                SetLoading(btnEliminar);
                //Set controller and send data for body
                $.ajax({
                    url: `${GetHost()}/Back/Controllers/spaEmpelados/usuarios/controlador_eliminar_usuario.php`,
                    type: 'POST',
                    data: { id: parseInt(dataNode[0].innerText) },
                    success: function (data) {
                        SetSucessModal(data);
                    },
                    error: function (err) {
                        SetCatchModal(err);
                    }
                });
            });
        });
    });
};
document.addEventListener('DOMContentLoaded', () => {
    SetColumns(dataTable, Columns);
});
btnNuevo.addEventListener('click', () => {
    SetModal(
        `
        <div class="text-primary">
            <i class="bi bi-plus-lg"></i>
            Agregar Usuario
        </div>
        `,
        `
        <form id="frmNuevo">
            <div class="row flex-column">
                <div class="col">
                    <div class="row row-cols-1 row-cols-md-2">
                        <div class="col mb-2">
                            <label class="ms-1 mb-1 text-black-50" for="nombre">Nombre</label>
                            <input class="form-control" type="text" name="nombre" id="nombre" required>
                        </div>
                        <div class="col mb-2">
                            <label class="ms-1 mb-1 text-black-50" for="apellido">Apellido</label>
                            <input class="form-control" type="text" name="apellido" id="apellido" required>
                        </div>
                    </div>
                </div>
                <div class="col mb-2">
                    <label class="ms-1 mb-1 text-black-50" for="correo">Correo</label>
                    <input class="form-control" type="email" name="correo" id="correo" required>
                </div>
                <div class="col">
                    <label class="ms-1 mb-1 text-black-50" for="idRol">Rol</label>
                    <select class="form-select" name="id_Rol" id="idRol"></select>
                </div>
            </div>
        </form>
        `,
        `
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="btnGuardar">Guardar</button>
        `
    );
    FillSelect('idRol', arrayRoles);
    ShowModal();
    var btnGuardar = document.getElementById('btnGuardar');
    btnGuardar.addEventListener('click', () => {
        if (ValidForm('frmNuevo')) {
            SetLoading(btnGuardar);
            var formData = new FormData(document.getElementById('frmNuevo'));
            var object = {};
            formData.forEach((value, key) => {
                object[key] = value;
            });
            //Set controller and send data for body
            $.ajax({
                url: `${GetHost()}/Back/Controllers/spaEmpelados/usuarios/controlador_insertar_usuario.php`,
                type: 'POST',
                data: object,
                success: function (data) {
                    SetSucessModal(data);
                },
                error: function (err) {
                    SetCatchModal(err);
                }
            });
        };
    });
});