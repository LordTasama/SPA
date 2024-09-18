// Hacer una solicitud AJAX al archivo PHP
fetch('../../Back/Controllers/clientes/controlador_select_cliente.php')
    .then(response => response.json())
    .then(data => {
        // Crear la tabla HTML
        let tabla = document.createElement('table');
        tabla.classList.add('table','table-hover')

        // Crear la fila de encabezados
        let fila = document.createElement('tr');
        fila.style.background ='#569863'
        for (let clave in data[0]) {
            let encabezado = document.createElement('th');
            encabezado.textContent = clave;
            fila.appendChild(encabezado);
        }
        tabla.appendChild(fila);    

        // Crear las filas de datos
        data.forEach(cliente => {
            let fila = document.createElement('tr');
            fila.style.backgroundColor = '#9ac19f';
            for (let valor of Object.values(cliente)) {
                let celda = document.createElement('td');
                celda.textContent = valor;
                fila.appendChild(celda);
            }
            tabla.appendChild(fila);
        });
        let container = document.getElementById('container')
        // Agregar la tabla al documento HTML
       
    
        container.appendChild(tabla);

    })
    .catch(error => console.error(error));