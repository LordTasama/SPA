document.addEventListener("DOMContentLoaded", function() {
    $.ajax({
        url: "../../Controller/Administrador/gestionClientes.php",
        data:JSON.stringify(),
        type: "POST",
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        success: function(data) {
            if (data.status === true) {
                var clientes = data.clientes;

                llenarTabla(clientes);
           
            } else {
                console.error(data.error);
                // Display error message to the user
            }
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
           
        }
    });

    function llenarTabla(clientes) {
        // Check if DataTable is already initialized
        if (!$.fn.DataTable.isDataTable('#miTabla')) {
            $('#miTabla').DataTable({
                data: clientes,
                columns: [
                    { data: 'CedulaCliente' },
                    { data: 'NombreCliente' },
                    { data: 'ApellidoCliente' },
                    { data: 'DireccionCliente' },
                    { data: 'CelularCliente' },
                    { data: 'CorreoCliente' },
                 
                    {
                        targets: -1,
                        data: null,
                        defaultContent: '<div class="text-center">' +
                                             '<button class="btn btn-"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="blue" class="bi bi-pencil" viewBox="0 0 16 16"><path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/></svg></button>' +
                                         '</div>'

        
                    }
                ]
            });
        } else {
            // Update existing DataTable
            var table = $('#miTabla').DataTable();
            table.clear().draw();
            table.rows.add(clientes).draw();
        }
    }
});
