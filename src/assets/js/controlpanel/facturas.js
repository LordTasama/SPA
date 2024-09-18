document.getElementById("searchReceiptButton").addEventListener('click', function () {
    const idCliente = document.getElementById('idSearchClientReceipt').value;

    if (idCliente !== '') {
        fetch('../controller/Data/facturas.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ idCliente: idCliente })
        })
        .then(response => response.json())
        .then(data => {
            // Limpiar la tabla antes de cargar los nuevos datos
            const tbody = document.querySelector('#datatable6 tbody');
            tbody.innerHTML = '';

            // Añadir las nuevas filas
            data.forEach(factura => {
                let row = `<tr>
                    <td>${factura.id}</td>
                    <td>${factura.fecha}</td>
                    <td>${factura.total}</td>
                    <td>${factura.metodo_pago}</td>
                    <td>${factura.id_cliente}</td>
                    <td><button class="btn btnDetail3" data-id="${factura.id}" style="background-image: linear-gradient(rgb(67, 28, 103), rgb(98, 61, 133)); color: white;" data-bs-toggle="modal" data-bs-target="#detailModal">Ver Detalle</button></td>
                </tr>`;
                tbody.innerHTML += row;
            });

            // Añadir event listeners para los botones de detalle
            document.querySelectorAll('#datatable6 .btnDetail3').forEach(button => {
                button.addEventListener('click', function () {
                    const facturaId = this.getAttribute('data-id');
                    fetch(`../controller/Data/detalleFactura.php?id=${facturaId}`)
                    .then(response => response.json())
                    .then(detailData => {
                        // Limpiar la tabla del modal antes de cargar los nuevos datos
                        const detailsTbody = document.querySelector('#invoiceDetailsTable tbody');
                        detailsTbody.innerHTML = '';
                        
                        // Mostrar los detalles en la tabla del modal
                        detailData.forEach(detail => {
                            let row = `<tr>
                                <td>${detail.nombre}</td>
                                <td>${detail.cantidad}</td>
                                <td>${detail.precio_unitario}</td>
                                <td>${detail.subtotal}</td>
                            </tr>`;
                            detailsTbody.innerHTML += row;
                        });
                    })
                    .catch(error => console.error('Error:', error));
                });
            });
        })
        .catch(error => console.error('Error:', error));
    } else {
        alert('Por favor ingrese un ID de cliente');
    }
});
