// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

reporteStock();
productosComprados();
cargarClientesActivosInactivos();
productosConMenorCantidad();
productosConMayorCantidad();
contarUsuariosPorEstado();
rolesConMasUsuarios();

function reporteStock() {
  const url = base_url + "Administracion/reporteStock";
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
        cantidad.push(res[i]['cantidad']);
      }
      var ctx = document.getElementById("stockminimo");
      var myPieChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
          labels: nombre,
          datasets: [{
            data: cantidad,
            backgroundColor: ['#007bff', '#dc3545', '#ffc107', '#28a745'],
          }],
        },
      });
    }
  }
}

function productosComprados() {
  const url = base_url + "Administracion/productosComprados";
  const http = new XMLHttpRequest();
  http.open("POST", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      let nombre = [];
      let cantidad = [];
      for (let i = 0; i < res.length; i++) {
        nombre.push(res[i]['descripcion']);
        cantidad.push(res[i]['total']);
      }
      var ctx = document.getElementById("productosvendidos");
      var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
          labels: nombre,
          datasets: [{
            data: cantidad,
            backgroundColor: ['#007bff', '#dc3545', '#ffc107', '#28a745'],
          }],
        },
      });
    }
  }
}

function cargarClientesActivosInactivos() {
  const url = base_url + "Reportes/contarClientes"; 
  const http = new XMLHttpRequest();
  http.open("POST", url, true);
  http.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  http.send();
  http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          const ctx = document.getElementById("clientesactivosinactivos").getContext('2d');
          const myPieChart = new Chart(ctx, {
              type: 'pie',
              data: {
                  labels: ['Activos', 'Inactivos'],
                  datasets: [{
                      data: [res.activos, res.inactivos], 
                      backgroundColor: ['#007bff', '#dc3545'],
                      borderColor: ['#ffffff'],
                      borderWidth: 1
                  }]
              },
              options: {
                  responsive: true,
                  plugins: {
                      legend: {
                          position: 'top',
                      }
                  }
              }
          });
      }
  };
}

function productosConMayorCantidad() {
  const url = base_url + "Reportes/mayorCantidadProductos";
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      let nombre = [];
      let cantidad = [];
      for (let i = 0; i < res.length; i++) {
        nombre.push(res[i]['producto']);
        cantidad.push(res[i]['cantidad']);
      }
      var ctx = document.getElementById("graficoProductosMasCantidad");
      var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
          labels: nombre,
          datasets: [{
            data: cantidad,
            backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e'],
          }],
        },
      });
    }
  }
}



function productosConMenorCantidad() {
  const url = base_url + "Reportes/menorCantidadProductos";
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      let nombre = [];
      let cantidad = [];
      for (let i = 0; i < res.length; i++) {
        nombre.push(res[i]['producto']);
        cantidad.push(res[i]['cantidad']);
      }
      var ctx = document.getElementById("graficoProductosMenosCantidad");
      var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
          labels: nombre,
          datasets: [{
            data: cantidad,
            backgroundColor: ['#ff9999', '#66b3ff', '#99e599', '#ffcc99'],
          }],
        },
      });
    }
  }
}


function contarUsuariosPorEstado() {
  const url = base_url + "Reportes/contarUsuariosPorEstado";
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      var ctx = document.getElementById("graficoUsuariosPorEstado");
      var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
          labels: ['Activos', 'Inactivos'],
          datasets: [{
            data: [res.activos, res.inactivos],
            backgroundColor: ['#4caf50', '#f44336'],
          }],
        },
      });
    }
  }
}


function rolesConMasUsuarios() {
  const url = base_url + "Reportes/getRolesConMasUsuarios";
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      let roles = [];
      let cantidades = [];
      for (let i = 0; i < res.length; i++) {
        roles.push(res[i]['rol']); 
        cantidades.push(res[i]['cantidad']);
      }
      var ctx = document.getElementById("graficoRolesConMasUsuarios");
      var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
          labels: roles,
          datasets: [{
            data: cantidades,
            backgroundColor: ['#2196f3', '#e91e63', '#ffeb3b', '#cddc39'],
          }],
        },
      });
    }
  }
}

