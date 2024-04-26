// Set new default font family and font color to mimic Bootstrap's default styling
let myChart, myChartSaldo, myChartVentas, myChartSalidas, myChartVendidos, myChartEntradas;

reporteStock();
reporteStockMaximo();
comparacion();
reporteSaldos();
abonosporMes();
reporteSalidas();
reporteVendidos();
reporteEntradas();
cargarClientesConMasCompras();
proveedoresConMasCompras();
productosMasVendidos();

function reporteStock() {
  const url = base_url + "Administracion/kardexEntradaMaxima";
  const http = new XMLHttpRequest();
  http.open("POST", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      let nombre = [];
      let cantidad = [];
      for (let i = 0; i < res.length; i++) {
        nombre.push(res[i]['producto']);
        cantidad.push(res[i]['cantidad_entrada']);
      }
      // Bar Chart Example
      var ctx = document.getElementById("myBarChart");
      var myLineChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: nombre,
          datasets: [{
            backgroundColor: "rgba(2,117,216,1)",
            borderColor: "rgba(2,117,216,1)",
            data: cantidad,
          }],
        },
        options: {
          scales: {
            xAxes: [{
              time: {
                unit: 'month'
              },
              gridLines: {
                display: false
              },
              ticks: {
                maxTicksLimit: 20
              }
            }],
            yAxes: [{
              ticks: {
                min: 0,
                max: 500,
                maxTicksLimit: 10
              },
              gridLines: {
                display: true
              }
            }],
          },
          legend: {
            display: false
          }
        }
      });

    }
  }
}

function reporteStockMaximo() {
  const url = base_url + "Administracion/kardexSalidaMaxima";
  const http = new XMLHttpRequest();
  http.open("POST", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      let nombre = [];
      let cantidad = [];
      for (let i = 0; i < res.length; i++) {
        nombre.push(res[i]['producto']);
        cantidad.push(res[i]['total_salida']);
      }
      // Bar Chart Example
      var ctx = document.getElementById("cantidad_salida");
      var myLineChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: nombre,
          datasets: [{
            backgroundColor: "rgba(2,117,216,1)",
            borderColor: "rgba(2,117,216,1)",
            data: cantidad,
          }],
        },
        options: {
          scales: {
            xAxes: [{
              time: {
                unit: 'month'
              },
              gridLines: {
                display: false
              },
              ticks: {
                maxTicksLimit: 30
              }
            }],
            yAxes: [{
              ticks: {
                min: 0,
                max: 500,
                maxTicksLimit: 20
              },
              gridLines: {
                display: true
              }
            }],
          },
          legend: {
            display: false
          }
        }
      });

    }
  }
}



function comparacion() {
  if (myChart) {
    myChart.destroy();
  }
  const anio = document.querySelector('#anio').value;
  const url = base_url + "Administracion/comparacion/" + anio;
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);

      document.querySelector('#totalVentas').textContent = "Total Ventas: " + res.totalVentas.total;
      document.querySelector('#totalCompras').textContent = "Total Compras: " + res.totalCompras.total;

      // Bar Chart Example
      var ctx = document.getElementById("comparacion");

      myChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
          datasets: [{
            label: 'Ventas',
            backgroundColor: "rgba(54, 162, 235, 0.5)", // Color azul para las ventas
            borderColor: "rgba(54, 162, 235, 1)",
            data: [res.venta.ene, res.venta.feb, res.venta.mar,
            res.venta.abr, res.venta.may, res.venta.jun,
            res.venta.jul, res.venta.ago, res.venta.sep,
            res.venta.oct, res.venta.nov, res.venta.dic],

          }, {
            label: 'Compras',
            backgroundColor: "rgba(255, 99, 132, 0.5)", // Color rojo para las compras
            borderColor: "rgba(255, 99, 132, 1)",
            data: [res.compra.ene, res.compra.feb, res.compra.mar,
            res.compra.abr, res.compra.may, res.compra.jun,
            res.compra.jul, res.compra.ago, res.compra.sep,
            res.compra.oct, res.compra.nov, res.compra.dic],
          }],
        },
        options: {
          scales: {
            xAxes: [{
              time: {
                unit: 'month'
              },
              gridLines: {
                display: true
              },
              ticks: {
                maxTicksLimit: 12
              }
            }],
            yAxes: [{
              ticks: {
                min: 0,
                max: 50000,
                maxTicksLimit: 25
              },
              gridLines: {
                display: true
              }
            }],
          },
          legend: {
            display: true
          }
        }
      });

    }
  }
}




function reporteSaldos() {
  if (myChartSaldo) {
    myChartSaldo.destroy();
  }
  
  const anio = document.querySelector('#anioSaldos').value;
  const url = base_url + "Administracion/saldos/" + anio;
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);

      //document.querySelector('#totalVentas').textContent = "Total Ventas: " + res.totalVentas.total;

      // Bar Chart Example
      var ctx = document.getElementById("saldos");

      myChartSaldo = new Chart(ctx, {
        type: 'line',
        data: {
          labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
          datasets: [{
            label: "Saldos Pendientes",
            lineTension: 0.3,
            backgroundColor: "rgba(2,117,216,0.2)",
            borderColor: "rgba(2,117,216,1)",
            pointRadius: 5,
            pointBackgroundColor: "rgba(2,117,216,1)",
            pointBorderColor: "rgba(255,255,255,0.8)",
            pointHoverRadius: 5,
            pointHoverBackgroundColor: "rgba(2,117,216,1)",
            pointHitRadius: 50,
            pointBorderWidth: 2,
            data: [res.ene, res.feb, res.mar,
              res.abr, res.may, res.jun,
              res.jul, res.ago, res.sep,
              res.oct, res.nov, res.dic],
          }],
        },
        options: {
          scales: {
            xAxes: [{
              time: {
                unit: 'date'
              },
              gridLines: {
                display: true
              },
              ticks: {
                maxTicksLimit: 12
              }
            }],
            yAxes: [{
              ticks: {
                min: 0,
                max: 40000,
                maxTicksLimit: 25
              },
              gridLines: {
                color: "rgba(0, 0, 0, .125)",
              }
            }],
          },
          legend: {
            display: true
          }
        }
      });
    }
  }

}



function abonosporMes() {
  if (myChartVentas) {
    myChartVentas.destroy();
  }
  
  const anioventas = document.querySelector('#anioventas').value; // Obtener el mes seleccionado
  const url = base_url + "Administracion/abonosporMes/" + anioventas; // URL con el mes como parámetro
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);


      // Bar Chart Example
      var ctx = document.getElementById("abonospormes");


      myChartVentas = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
          datasets: [{
            label: 'Abonos',
            backgroundColor: "rgba(54, 162, 235, 0.5)", // Color azul para las ventas
            borderColor: "rgba(54, 162, 235, 1)",
            data: [res.abono.ene, res.abono.feb, res.abono.mar,
              res.abono.abr, res.abono.may, res.abono.jun,
              res.abono.jul, res.abono.ago, res.abono.sep,
              res.abono.oct, res.abono.nov, res.abono.dic], // Utilizar los datos de ventas por mes del servidor

          }],
        },
        options: {
          scales: {
            xAxes: [{
              time: {
                unit: 'month'
              },
              gridLines: {
                display: true
              },
              ticks: {
                maxTicksLimit: 12
              }
            }],
            yAxes: [{
              ticks: {
                min: 0,
                max: 20000,
                maxTicksLimit: 25
              },
              gridLines: {
                display: true
              }
            }],
          },
          legend: {
            display: true
          }
        }
      });

    }
  }
}



function reporteSalidas() {
  if (myChartSalidas) {
    myChartSalidas.destroy();
  }
  
  const anio = document.querySelector('#anioSalidas').value;
  const url = base_url + "Administracion/salidasporMes/" + anio;
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);

      //document.querySelector('#totalVentas').textContent = "Total Ventas: " + res.totalVentas.total;

      // Bar Chart Example
      var ctx = document.getElementById("salidas");

      myChartSalidas = new Chart(ctx, {
        type: 'line',
        data: {
          labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
          datasets: [{
            label: "Salidas de materia prima por mes",
            lineTension: 0.3,
            backgroundColor: "rgba(2,117,216,0.2)",
            borderColor: "rgba(2,117,216,1)",
            pointRadius: 5,
            pointBackgroundColor: "rgba(2,117,216,1)",
            pointBorderColor: "rgba(255,255,255,0.8)",
            pointHoverRadius: 5,
            pointHoverBackgroundColor: "rgba(2,117,216,1)",
            pointHitRadius: 50,
            pointBorderWidth: 2,
            data: [res.salida.ene, res.salida.feb, res.salida.mar,
              res.salida.abr, res.salida.may, res.salida.jun,
              res.salida.jul, res.salida.ago, res.salida.sep,
              res.salida.oct, res.salida.nov, res.salida.dic],
          }],
        },
        options: {
          scales: {
            xAxes: [{
              time: {
                unit: 'date'
              },
              gridLines: {
                display: true
              },
              ticks: {
                maxTicksLimit: 12
              }
            }],
            yAxes: [{
              ticks: {
                min: 0,
                max: 500,
                maxTicksLimit: 25
              },
              gridLines: {
                color: "rgba(0, 0, 0, .125)",
              }
            }],
          },
          legend: {
            display: true
          }
        }
      });
    }
  }

}


function reporteVendidos() {
  if (myChartVendidos) {
    myChartVendidos.destroy();
  }
  
  const anio = document.querySelector('#anioVendidos').value;
  const url = base_url + "Administracion/productoVendido/" + anio;
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);

      //document.querySelector('#totalVentas').textContent = "Total Ventas: " + res.totalVentas.total;

      // Bar Chart Example
      var ctx = document.getElementById("vendidos");

      myChartVendidos = new Chart(ctx, {
        type: 'line',
        data: {
          labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
          datasets: [{
            label: "Productos vendidos por mes",
            lineTension: 0.3,
            backgroundColor: "rgba(2,117,216,0.2)",
            borderColor: "rgba(2,117,216,1)",
            pointRadius: 5,
            pointBackgroundColor: "rgba(2,117,216,1)",
            pointBorderColor: "rgba(255,255,255,0.8)",
            pointHoverRadius: 5,
            pointHoverBackgroundColor: "rgba(2,117,216,1)",
            pointHitRadius: 50,
            pointBorderWidth: 2,
            data: [res.vendido.ene, res.vendido.feb, res.vendido.mar,
              res.vendido.abr, res.vendido.may, res.vendido.jun,
              res.vendido.jul, res.vendido.ago, res.vendido.sep,
              res.vendido.oct, res.vendido.nov, res.vendido.dic],
          }],
        },
        options: {
          scales: {
            xAxes: [{
              time: {
                unit: 'date'
              },
              gridLines: {
                display: true
              },
              ticks: {
                maxTicksLimit: 12
              }
            }],
            yAxes: [{
              ticks: {
                min: 0,
                max: 200,
                maxTicksLimit: 25
              },
              gridLines: {
                color: "rgba(0, 0, 0, .125)",
              }
            }],
          },
          legend: {
            display: true
          }
        }
      });
    }
  }

}



function reporteEntradas() {
  if (myChartEntradas) {
    myChartEntradas.destroy();
  }
  
  const anio = document.querySelector('#anioEntradas').value;
  const url = base_url + "Administracion/entradasporMes/" + anio;
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);

      //document.querySelector('#totalVentas').textContent = "Total Ventas: " + res.totalVentas.total;

      // Bar Chart Example
      var ctx = document.getElementById("entradas");

      myChartEntradas = new Chart(ctx, {
        type: 'line',
        data: {
          labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
          datasets: [{
            label: "Entradas de materia prima por mes",
            lineTension: 0.3,
            backgroundColor: "rgba(2,117,216,0.2)",
            borderColor: "rgba(2,117,216,1)",
            pointRadius: 5,
            pointBackgroundColor: "rgba(2,117,216,1)",
            pointBorderColor: "rgba(255,255,255,0.8)",
            pointHoverRadius: 5,
            pointHoverBackgroundColor: "rgba(2,117,216,1)",
            pointHitRadius: 50,
            pointBorderWidth: 2,
            data: [res.entrada.ene, res.entrada.feb, res.entrada.mar,
              res.entrada.abr, res.entrada.may, res.entrada.jun,
              res.entrada.jul, res.entrada.ago, res.entrada.sep,
              res.entrada.oct, res.entrada.nov, res.entrada.dic],
          }],
        },
        options: {
          scales: {
            xAxes: [{
              time: {
                unit: 'date'
              },
              gridLines: {
                display: true
              },
              ticks: {
                maxTicksLimit: 12
              }
            }],
            yAxes: [{
              ticks: {
                min: 0,
                max: 650,
                maxTicksLimit: 25
              },
              gridLines: {
                color: "rgba(0, 0, 0, .125)",
              }
            }],
          },
          legend: {
            display: true
          }
        }
      });
    }
  }

}

function cargarClientesConMasCompras() {
  const url = base_url + "Reportes/mostrarClientesConMasCompras"; // Asegúrate de que la URL es correcta
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      let nombres = [];
      let compras = [];
      let backgroundColors = [];
      const clientList = document.getElementById('clientList'); // Asegúrate de tener este elemento en tu HTML
      clientList.innerHTML = ''; // Limpiar lista existente

      // Colores para cada barra del gráfico
      const colors = ['#007bff', '#dc3545', '#ffc107', '#28a745', '#6610f2', '#6f42c1', '#e83e8c', '#fd7e14', '#20c997', '#17a2b8'];

      for (let i = 0; i < res.length; i++) {
        nombres.push(res[i]['cliente'] + ' (' + res[i]['identificacion'] + ')'); // Utilizado para la lista, no para el gráfico
        compras.push(res[i]['num_compras']);
        backgroundColors.push(colors[i % colors.length]);

        // Crear y añadir elemento a la lista con estilo
        const listItem = document.createElement('div');
        listItem.textContent = nombres[i];
        listItem.style.color = colors[i % colors.length]; // Asignar el color del texto
        clientList.appendChild(listItem);
      }

      const ctx = document.getElementById('clientesMasCompras').getContext('2d');
      const myBarChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: Array(nombres.length).fill(''), // Usar un array lleno de cadenas vacías para las etiquetas
          datasets: [{
            label: 'Número de Compras',
            data: compras,
            backgroundColor: backgroundColors,
            borderColor: 'rgba(0, 0, 0, 0.1)',
            borderWidth: 1
          }]
        },
        options: {
          scales: {
            x: {
              beginAtZero: true,
              ticks: {
                display: false // Oculta las etiquetas en el eje X
              }
            }
          },
          plugins: {
            legend: {
              display: true,
              position: 'top'
            },
            tooltip: {
              callbacks: {
                label: function(tooltipItem) {
                  return tooltipItem.raw; // Solo muestra el número en el tooltip
                }
              }
            }
          },
          responsive: true,
          maintainAspectRatio: false
        }
      });
    }
  };
}


function proveedoresConMasCompras() {
  const url = base_url + "Reportes/mostrarProveedoresConMasCompras"; 
  const http = new XMLHttpRequest();
  http.open("GET", url, true); 
  http.send();
  http.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      let proveedores = [];
      let numCompras = [];
      let backgroundColors = []; 
      for (let i = 0; i < res.length; i++) {
        proveedores.push(res[i]['proveedor']);
        numCompras.push(res[i]['num_compras']);
        // Añadir un color diferente para cada barra
        backgroundColors.push(`hsla(${360 * i / res.length}, 70%, 70%, 0.6)`);
      }
      var ctx = document.getElementById("graficoProveedoresMasCompras");
      var myBarChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: proveedores,
          datasets: [{
            label: 'Número de Compras',
            backgroundColor: backgroundColors,  
            borderColor: "rgba(54, 162, 235, 1)",
            borderWidth: 1,
            data: numCompras,
          }]
        },
        options: {
          scales: {
            xAxes: [{
              gridLines: {
                display: false
              },
              ticks: {
                autoSkip: false
              }
            }],
            yAxes: [{
              ticks: {
                beginAtZero: true
              },
              gridLines: {
                display: true
              }
            }]
          },
          legend: {
            display: true
          }
        }
      });
    }
  }
}

function productosMasVendidos() {
  const url = base_url + "Reportes/getProductosMasVendidos"; 
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      let tiposProducto = [];
      let cantidades = [];
      let backgroundColors = [];
      for (let i = 0; i < res.length; i++) {
        tiposProducto.push(res[i]['tipo_productob']);
        cantidades.push(res[i]['cantidad_total']);

        backgroundColors.push(`hsla(${360 * i / res.length}, 70%, 70%, 0.6)`);
      }
      var ctx = document.getElementById("graficoProductosMasVendidos");
      var myBarChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: tiposProducto,
          datasets: [{
            label: 'Cantidad Vendida',
            backgroundColor: backgroundColors,
            borderColor: "rgba(54, 162, 235, 1)",
            borderWidth: 1,
            data: cantidades,
          }]
        },
        options: {
          scales: {
            xAxes: [{
              gridLines: {
                display: false
              },
              ticks: {
                autoSkip: false
              }
            }],
            yAxes: [{
              ticks: {
                min: 0,
                max: 700,
                maxTicksLimit: 15,
                beginAtZero: true
              },
              gridLines: {
                display: true
              }
            }]
            
          },
          legend: {
            display: true
          }
        }
      });
    }
  }
}
