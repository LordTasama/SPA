const totalPriceInput = document.getElementById('preciopagar');
let totalPrice = 0; // Initialize totalPrice to 0
const tableBodyOtherTable = document.getElementById('table-body-other-table');

// Add event listener to the "Añadir" button
document.addEventListener('click', function(event) {
    if (event.target.classList.contains('btn-warning')) {
        // Get the product information
        const productId = event.target.parentNode.parentNode.cells[0].textContent;
        const productName = event.target.parentNode.parentNode.cells[2].textContent;
        const productPrice = event.target.parentNode.parentNode.cells[4].textContent;
        const stockSpan = event.target.parentNode.parentNode.cells[1].childNodes[0];
        const stock = parseInt(stockSpan.textContent);

        if (stock > 0) {
            // Check if the product already exists in the other table
            const existingRow = tableBodyOtherTable.querySelector(`tr[data-product-id="${productId}"]`);
            if (existingRow) {
                // Update the quantity of the existing product
                const quantityCell = existingRow.cells[3];
                const currentQuantity = parseInt(quantityCell.textContent);
                quantityCell.textContent = currentQuantity + 1;
            } else {
                // Add the product to the other table
                const row = document.createElement('tr');
                row.dataset.productId = productId;
                row.innerHTML = `
  <td>${productId}</td>
  <td>${productName}</td>
  <td>${productPrice}</td>
  <td>1</td>
  <td><button class="btn btn-danger bg-danger fw-bold text-white return-product">Retornar</button></td>
`;
                tableBodyOtherTable.appendChild(row);
            }

            // Reduce the stock of the product
            stockSpan.textContent = stock - 1;

            // Disable the button if the stock is 0
            if (stock - 1 === 0) {
                event.target.disabled = true;
            }

            // Update the total price
            const totalPriceInput = document.getElementById('preciopagar');
            const totalPrice = parseFloat(totalPriceInput.value);
            totalPriceInput.value = totalPrice + parseFloat(productPrice);
        } else {
            if (stock <= 0) {
    alert("No hay stock disponible para este producto");
}}
    }
});
// Add event listener to the "Devolver" button
document.addEventListener('click', function(event) {
    if (event.target.classList.contains('return-product')) {
        // Get the product information
        const row = event.target.parentNode.parentNode;
        const productId = row.cells[0].textContent;
        const productName = row.cells[1].textContent;
        const productPrice = row.cells[2].textContent;
        const quantity = parseInt(row.cells[3].textContent);

        // Find the stockSpan element
        const tableBody = document.getElementById('table-body');
        const rows = tableBody.rows;
        let stockSpan;
        for (let i = 0; i < rows.length; i++) {
            const rowCells = rows[i].cells;
            if (rowCells[2].textContent === productName) {
                stockSpan = rowCells[1].querySelector('span');
                break;
            }
        }

        // Increase the stock of the product
        const stock = parseInt(stockSpan.textContent);
        stockSpan.textContent = stock + 1;

        // Decrease the quantity of the product in the other table
        const quantityCell = row.cells[3];
        const currentQuantity = parseInt(quantityCell.textContent);
        if (currentQuantity > 1) {
            quantityCell.textContent = currentQuantity - 1;
        } else {
            row.remove();
        }

        // Update the total price
        const totalPriceInput = document.getElementById('preciopagar');
        const totalPrice = parseFloat(totalPriceInput.value);
        totalPriceInput.value = totalPrice - parseFloat(productPrice);

        const addButton = document.getElementById(`add-button-${productId}`);
        addButton.disabled = false;
    }
});

// Add event listener to the "Añadir" button for services
document.addEventListener('click', function(event) {
if (event.target.classList.contains('btn-warning') && event.target.id.startsWith('add-service-button-')) {
const serviceId = event.target.id.split('-')[3];
const serviceName = event.target.parentNode.parentNode.cells[1].textContent;
const servicePrice = event.target.parentNode.parentNode.cells[2].textContent;
const serviceDuration = event.target.parentNode.parentNode.cells[4].textContent;

// Check if the service already exists in the other table
const existingRow = tableBodyOtherTable.querySelector(`tr[data-service-id="${serviceId}"]`);
if (!existingRow) {
    // Add the service to the other table
    const row = document.createElement('tr');
    row.dataset.serviceId = serviceId;
    row.innerHTML = `
        <td>${serviceId}</td>
        <td>${serviceName}</td>
        <td>${servicePrice}</td>
        <td>1</td>
        <td><button class="btn btn-danger bg-danger fw-bold text-white return-service">Retornar</button></td>
    `;
    tableBodyOtherTable.appendChild(row);

    // Update the total price
    const totalPriceInput = document.getElementById('preciopagar');
    const totalPrice = parseFloat(totalPriceInput.value);
    totalPriceInput.value = totalPrice + parseFloat(servicePrice);
} else {
    alert("El servicio ya ha sido agregado");
}
}
});

// Add event listener to the "Retornar" button for services
document.addEventListener('click', function(event) {
if (event.target.classList.contains('return-service')) {
const row = event.target.parentNode.parentNode;
const serviceId = row.dataset.serviceId;
const serviceName = row.cells[1].textContent;
const servicePrice = row.cells[2].textContent;

// Remove the service from the other table
row.remove();

// Update the total price
const totalPriceInput = document.getElementById('preciopagar');
const totalPrice = parseFloat(totalPriceInput.value);
totalPriceInput.value = totalPrice - parseFloat(servicePrice);
}
});






