document.addEventListener("DOMContentLoaded", function() {
    $.ajax({
        url: "../../Controller/Administrador/traerEmpleado.php",
        data:JSON.stringify(),
        type: "POST",
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        success: function(data) {
            if (data.status === true) {
                var empleados = data.empleados;

                llenarTabla(empleados);
           
            } else {
                console.error(data.error);
                // Display error message to the user
            }
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
           
        }
    });

    function llenarTabla(empleados) {
        // Check if DataTable is already initialized
            // Aquí accede a los nombres del terapeuta y del servicio
            let nombreEspecialidad = empleados.NombreRol;
          
        if (!$.fn.DataTable.isDataTable('#miTabla')) {
            $('#miTabla').DataTable({
             
                data: empleados,
                columns: [
                    { data: 'NombreEmpleado' },
                    { data: 'ApellidoEmpleado' },
                    { data: 'CelularEmpleado' },
                    { data: 'CedulaEmpleado' },
                    { data: 'CorreoEmpleado' },
                    { data: 'HorarioTrabajoEmpleado' },
                    { data: 'NombreRol' },
                    { data: 'estado' },
                    {
                        targets: -1,
                        data: null,
                        defaultContent: '<div class="d-flex">' +
                                             '<button class="btn btn-edit" title="Editar"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="blue" class="bi bi-pencil" viewBox="0 0 16 16"><path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/></svg></button>' +
                                             '<button class="btn btn-sm" title="Estado"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16"><path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492M5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0"/> <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115z"/></svg></button>' +
                                         '</div>'

        
                    }
                ]
            });
        } else {
            // Update existing DataTable
            var table = $('#miTabla').DataTable();
            table.clear().draw();
            table.rows.add(empleados).draw();
        }
        $('#miTabla tbody').on('click', '.btn-edit', function() {
            var data = $('#miTabla').DataTable().row($(this).parents('tr')).data();
            var idEmpleado = data.idEmpleados; 
            Swal.fire({
                title: 'Editar Empleado',
                text: 'ID del Empleado: ' + idEmpleado,
                icon: 'info'
            });
        })
    }
})