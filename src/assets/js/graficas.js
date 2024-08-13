function cargar() {
  //limpiar las gráficas
  document.getElementById("Grafica1").innerHTML = "";
  document.getElementById("Grafica2").innerHTML = "";
  //Opciones de la gráfica de barra

  var options1 = {
    chart: {
      height: 350,
      type: "bar",
    },
   
    dataLabels: {
      enabled: false,
    },

    xaxis: {
      labels: {
        style: {
          fontWeight: "bold",
          fontSize: "12px",
        },
      },
    },

    series: [],
    title: {
      text: "Tratamientos más solicitados",
    },
    noData: {
      text: "Cargando...",
    },
  };

  //Crear la gráfica utilizando las opciones anteriores

  var Grafica1 = new ApexCharts(document.querySelector("#Grafica1"), options1);
  //Muestra la gráfica en la página
  Grafica1.render();

  //Lee los datos desde el endpoint
  fetch("../controller/Data/graphsinfo.php?query=1")
    .then(function (response) {
      return response.json();
    })

    .then(function (data) {
      //Esperar
      setTimeout(() => {
        //Asignar los datos a la gráfica

        Grafica1.updateSeries([
          {
            colors: ["#5eb319"],
            name: "Frecuencia",
            data: data,
          },
        ]);
      }, "300");
    });

  //Gráfica de barras

  //Lee los datos desde el endpoint
  fetch("../controller/Data/graphsinfo.php?query=2")
    .then(function (response) {
      return response.json();
    })

    .then(function (data) {
      //Esperar
      setTimeout(() => {
        //Crear 2 arreglos para separar los datos
        let x = [];
        let y = [];
        let i = 0;
        //asigna los datos por cada eje
        data.forEach((row) => {
          x[i] = row.x;
          y[i] = parseInt(row.y);
          i += 1;
        });
        let options2 = {
          chart: {
            height: 400,
            type: "pie",
        
            
            toolbar: {
              show: true,
              offsetX: 0,
              offsetY: 0,
              tools: {
                download: true,
                selection: true,
                zoom: true,
                zoomin: true,
                zoomout: true,
                pan: true,
                reset: true | '<img src="/static/icons/reset.png" width="20">',
                customIcons: [],
              },
              export: {
                csv: {
                  filename: undefined,
                  columnDelimiter: ",",
                  headerCategory: "category",
                  headerValue: "value",
                  dateFormatter(timestamp) {
                    return new Date(timestamp).toDateString();
                  },
                },
                svg: {
                  filename: undefined,
                },
                png: {
                  filename: undefined,
                },
              },
              autoSelected: "zoom",
            },
          },
          
        
            theme: {
              mode: 'light', 
              palette: 'palette10', 
              monochrome: {
                  enabled: false,
                  color: '#255aee',
                  shadeTo: 'light',
                  shadeIntensity: 0.65
              },
          },

          dataLabels: {
            enabled: true,
          },
          //establece los datos separados anteriormente
          series: y,
          labels: x,
          

          title: {
            text: "Contribución de cada servicio",
          },
          noData: {
            text: "Cargando...",
          },
          responsive: [
            {
              breakpoint: 480,
              options: {
                
                chart: {
                  width: 200,
                },
                legend: {
                  position: "bottom",
                },
              },
            },
          ],
        };
        //incializa la gráfica
        var Grafica2 = new ApexCharts(
          document.querySelector("#Grafica2"),
          options2
        );

        Grafica2.render();
      }, "300");
    });
}
cargar();
