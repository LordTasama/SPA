import { GetHost, SetTitle } from '../../../Assets/Js/globals.functions.js';
import { } from '../Assets/Helper/Admin.Layout.js';
import { SetAsideActive } from '../../Utils/asidebar.js';
SetTitle('Gráficos');
SetAsideActive('Gráficos');
// ! Primer Grafico 
fetch(`${GetHost()}/Back/Controllers/graficos/grafico_IngresosPorTiempo.php`)
.then(response => response.json())
.then(data => {
  let mes = []
  let total_Ingresos = []

  data.forEach(element =>{
    mes.push(element.mes)
    total_Ingresos.push(element.total)
  })
  document.getElementById('ingresosPorTiempo').innerHTML = `
  <canvas id="cvsIngresosTiempo"></canvas>
  `;
  const cvsIngresosTiempo = document.getElementById('cvsIngresosTiempo');
  new Chart(cvsIngresosTiempo, {
    type: 'bar',
    data: {
      labels: mes,
      datasets: [{
        label: 'Ingresos',
        data: total_Ingresos,
        borderWidth: 1,
        backgroundColor: 'green'
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
}).catch(err => {
  console.error(err);
});
// ! Segundo Grafico
fetch(`${GetHost()}/Back/Controllers/graficos/grafico_Popularidad.php`)
.then(response => response.json())
.then(data => {
  console.log(data)
  let nombres = [];
  let cantidad = [];
  data.forEach(element => {
      nombres.push(element.descripcion)
      cantidad.push(element.cantidad)
  });
  document.getElementById('popularidadTratamientos').innerHTML = `
  <canvas id="cvsPopularidadTratamientos"></canvas>
  `;
  const cvsPopularidadTratamientos = document.getElementById('cvsPopularidadTratamientos');
  new Chart(cvsPopularidadTratamientos, {
    type: 'bar',
    data: {
      labels: nombres,
      datasets: [{
        label: 'Popularidad',
        data: cantidad,
        borderWidth: 1,
        backgroundColor: 'yellow'
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
}).catch(err => {
  console.error(err);
});
// ! Tercer Grafico
fetch(`${GetHost()}/Back/Controllers/graficos/grafico_IngresosServicios.php`).then(response => response.json())
.then(data => {
  let nombres = [];
  let valor = [];
  data.forEach( element => {
    nombres.push(element.descripcion);
    valor.push(element.valor)
  })
  document.getElementById('ingresosPorServicio').innerHTML = `
  <canvas id="cvsIngresosServicio"></canvas>
  `;
  const cvsIngresosServicio = document.getElementById('cvsIngresosServicio');
  new Chart(cvsIngresosServicio, {
    type: 'pie',
    data: {
      labels: nombres,
      datasets: [{
        data: valor,
        borderWidth: 1,
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'top',
        }
      }
    },
  });
}).catch(err => {
  console.error(err);
});