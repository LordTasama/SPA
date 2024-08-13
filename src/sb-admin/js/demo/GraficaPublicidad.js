   // Set new default font family and font color to mimic Bootstrap's default styling
   Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
   Chart.defaults.global.defaultFontColor = '#858796';

   function number_format(number, decimals, dec_point, thousands_sep) {
       number = (number + '').replace(',', '').replace(' ', '');
       var n = !isFinite(+number) ? 0 : +number,
           prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
           sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
           dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
           s = '',
           toFixedFix = function(n, prec) {
               var k = Math.pow(10, prec);
               return '' + Math.round(n * k) / k;
           };
       s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
       if (s[0].length > 3) {
           s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
       }
       if ((s[1] || '').length < prec) {
           s[1] = s[1] || '';
           s[1] += new Array(prec - s[1].length + 1).join('0');
       }
       return s.join(dec);
   }

   // Bar Chart Example
   var ctx = document.getElementById("myAreaChart");
   var myBarChart = new Chart(ctx, {
       type: 'bar',
       data: {
           labels: ["Masajes", "Tratamientos Faciales", "Manicura", "Pedicura", "Aromaterapia"],
           datasets: [
               {
                   label: "Enero",
                   backgroundColor: "rgba(78, 115, 223, 0.9)",
                   borderColor: "rgba(78, 115, 223, 1)",
                   data: [30, 25, 20, 15, 10]
               },
               {
                   label: "Febrero",
                   backgroundColor: "rgba(54, 185, 204, 0.9)",
                   borderColor: "rgba(54, 185, 204, 1)",
                   data: [35, 30, 25, 20, 15]
               },
               {
                   label: "Marzo",
                   backgroundColor: "rgba(28, 200, 138, 0.9)",
                   borderColor: "rgba(28, 200, 138, 1)",
                   data: [40, 35, 30, 25, 20]
               },
               {
                   label: "Abril",
                   backgroundColor: "rgba(246, 194, 62, 0.9)",
                   borderColor: "rgba(246, 194, 62, 1)",
                   data: [45, 40, 35, 30, 25]
               },
               {
                   label: "Mayo",
                   backgroundColor: "rgba(231, 74, 59, 0.9)",
                   borderColor: "rgba(231, 74, 59, 1)",
                   data: [50, 45, 40, 35, 30]
               },
               {
                   label: "Junio",
                   backgroundColor: "rgba(133, 135, 150, 0.9)",
                   borderColor: "rgba(133, 135, 150, 1)",
                   data: [55, 50, 45, 40, 35]
               },
               {
                   label: "Julio",
                   backgroundColor: "rgba(96, 92, 168, 0.9)",
                   borderColor: "rgba(96, 92, 168, 1)",
                   data: [60, 55, 50, 45, 40]
               },
               {
                   label: "Agosto",
                   backgroundColor: "rgba(11, 94, 215, 0.9)",
                   borderColor: "rgba(11, 94, 215, 1)",
                   data: [65, 60, 55, 50, 45]
               },
               {
                   label: "Septiembre",
                   backgroundColor: "rgba(23, 162, 184, 0.9)",
                   borderColor: "rgba(23, 162, 184, 1)",
                   data: [70, 65, 60, 55, 50]
               },
               {
                   label: "Octubre",
                   backgroundColor: "rgba(0, 204, 153, 0.9)",
                   borderColor: "rgba(0, 204, 153, 1)",
                   data: [75, 70, 65, 60, 55]
               },
               {
                   label: "Noviembre",
                   backgroundColor: "rgba(255, 159, 64, 0.9)",
                   borderColor: "rgba(255, 159, 64, 1)",
                   data: [80, 75, 70, 65, 60]
               },
               {
                   label: "Diciembre",
                   backgroundColor: "rgba(153, 102, 255, 0.9)",
                   borderColor: "rgba(153, 102, 255, 1)",
                   data: [85, 80, 75, 70, 65]
               }
           ],
       },
       options: {
           indexAxis: 'y',
           maintainAspectRatio: false,
           layout: {
               padding: {
                   left: 10,
                   right: 25,
                   top: 25,
                   bottom: 0
               }
           },
           scales: {
               xAxes: [{
                   time: {
                       unit: 'number'
                   },
                   gridLines: {
                       display: false,
                       drawBorder: false
                   },
                   ticks: {
                       maxTicksLimit: 6,
                       callback: function(value, index, values) {
                           return number_format(value);
                       }
                   }
               }],
               yAxes: [{
                   ticks: {
                       maxTicksLimit: 5,
                       padding: 10,
                   },
                   gridLines: {
                       color: "rgb(234, 236, 244)",
                       zeroLineColor: "rgb(234, 236, 244)",
                       drawBorder: false,
                       borderDash: [2],
                       zeroLineBorderDash: [2]
                   }
               }],
           },
           legend: {
               display: true
           },
           tooltips: {
               backgroundColor: "rgb(255,255,255)",
               bodyFontColor: "#858796",
               titleMarginBottom: 10,
               titleFontColor: '#6e707e',
               titleFontSize: 14,
               borderColor: '#dddfeb',
               borderWidth: 1,
               xPadding: 15,
               yPadding: 15,
               displayColors: false,
               intersect: false,
               mode: 'index',
               caretPadding: 10,
               callbacks: {
                   label: function(tooltipItem, chart) {
                       var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                       return datasetLabel + ': ' + number_format(tooltipItem.xLabel);
                   }
               }
           }
       }
   });