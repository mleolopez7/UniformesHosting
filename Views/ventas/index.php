<?php include "Views/Templates/header.php"; ?>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>



                <div class="card-body">

                    <div class="card">
                        <div class="card-header bg-light text-black ">
                            <h4 class="mx-auto">
                                Nueva orden
                            </h4>
                        </div>
                    </div>

                    <br>
                    <form id="frmV" style="margin-bottom: 0.5em;">

                        <div class="card">
                            <a href="#" onclick="frmCliente(); return false;">Agregar cliente</a>

                            <div class="row" style="margin-bottom: 0.5em;">
                                <p style="margin-bottom: 0.5em;">
                                <div class="col-md-3 position-relative">
                                    <label for="validationTooltip04" class="form-label">Clientes</label>
                                    <select class="form-select" id="clientes" required name="clientes">
                                        <option selected disabled value=""></option>
                                        <option>...</option>
                                    </select>
                                    <div class="invalid-tooltip">
                                        Please select a valid state.
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <label>Telefono</label>
                                    <input class="form-control" id="telefono" type="text" readonly />
                                </div>

                                <div class="col-md-2">
                                    <label>ID-RTN</label>
                                    <input class="form-control" id="Identificacion" type="text" readonly />
                                </div>


                                <div class="col-md-2">
                                    <label>Fecha de Entrega</label>
                                    <input class="form-control" id="fecha_entrega" type="date" />
                                    <div id="mensajeFecha" style="color: red;"></div>
                                </div>


                                <script>
                                    document.addEventListener('DOMContentLoaded', function () {
                                        var inputFechaEntrega = document.getElementById('fecha_entrega');
                                        var fechaActual = obtenerFechaActual();
                                        inputFechaEntrega.min = fechaActual;

                                        inputFechaEntrega.addEventListener('change', function () {
                                            validarFechaEntrega();
                                        });

                                        function obtenerFechaActual() {
                                            var today = new Date();
                                            var year = today.getFullYear();
                                            var month = ('0' + (today.getMonth() + 1)).slice(-2);
                                            var day = ('0' + today.getDate()).slice(-2);
                                            return year + '-' + month + '-' + day;
                                        }

                                        function validarFechaEntrega() {
                                            var fechaEntrega = new Date(inputFechaEntrega.value);
                                            var fechaActual = new Date();

                                            fechaEntrega.setHours(0, 0, 0, 0);
                                            fechaActual.setHours(0, 0, 0, 0);

                                            // Restar un día a la fecha actual
                                            var unDiaAntes = new Date(fechaActual);
                                            unDiaAntes.setDate(unDiaAntes.getDate() - 1);

                                            if (fechaEntrega.getTime() < unDiaAntes.getTime()) {
                                                var fechaActualFormateada = obtenerFechaFormateada(unDiaAntes);
                                                document.getElementById('mensajeFecha').textContent = 'La fecha que ingresó es menor a la actual.';
                                                document.getElementById('mensajeFecha').style.color = 'red'; // Cambio de color a rojo
                                                inputFechaEntrega.value = obtenerFechaFormateada(unDiaAntes); // Restablecer la fecha al día anterior
                                            } else {
                                                document.getElementById('mensajeFecha').textContent = '';
                                            }
                                        }


                                        function obtenerFechaFormateada(fecha) {
                                            var dia = ('0' + fecha.getDate()).slice(-2);
                                            var mes = ('0' + (fecha.getMonth() + 1)).slice(-2);
                                            var anio = fecha.getFullYear();
                                            return dia + '/' + mes + '/' + anio;
                                        }
                                    });
                                </script>


                                <div class="col-md-2" style="display: none;">
                                    <label>Fecha Actual</label>
                                    <input class="form-control" id="fecha_actual" type="date" placeholder="."
                                        style="display: none;">
                                </div>


                                <script>
                                    document.addEventListener('DOMContentLoaded', function () {
                                        var inputFecha = document.getElementById('fecha_actual');
                                        var fechaActual = obtenerFechaActual();
                                        inputFecha.value = fechaActual;

                                        function obtenerFechaActual() {
                                            var today = new Date();
                                            var year = today.getFullYear();
                                            var month = ('0' + (today.getMonth() + 1)).slice(-2);
                                            var day = ('0' + today.getDate()).slice(-2);
                                            return year + '-' + month + '-' + day;
                                        }
                                    });
                                </script>

                                <div class="col-md-2">
                                    <label>NO. Factura</label>
                                    <input class="form-control" id="factura" type="text" placeholder="NO. Factura"
                                        readonly />
                                </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function () {
                                        var inputFactura = document.getElementById('factura');
                                        var numeroAleatorio = generarNumeroAleatorio(5);
                                        inputFactura.value = numeroAleatorio;

                                        function generarNumeroAleatorio(longitud) {
                                            var caracteres = '0123456789ABC';
                                            var resultado = '';
                                            for (var i = 0; i < longitud; i++) {
                                                resultado += caracteres.charAt(Math.floor(Math.random() * caracteres.length));
                                            }
                                            return resultado;
                                        }
                                    });
                                </script>



                                </p>
                            </div>

                    </form>
                </div>


                <div class="card">
                    <div id="frmDetallevContainer">
                        <form id="frmDetallev" class="col-md-15" style="margin-bottom: 0.5em;">

                            <a href="#" onclick="frmTallas(); return false;">Agregar Talla</a>

                            <div class="row">


                                <div class="col-md-2 position-relative">
                                    <label for="validationTooltip04" class="form-label">Productos</label>
                                    <select class="form-select" id="tipo_productob" required>
                                        <option selected disabled value=""></option>
                                        <option>...</option>
                                    </select>
                                    <div class="invalid-tooltip">
                                        Please select a valid state.
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label>Descripcion del producto</label>
                                    <input id="descripcionpb" class="form-control" type="text" name="descripcionpb"
                                        readonly>
                                </div>


                                <div class="col-md-2 position-relative">
                                    <label for="validationTooltip04" class="form-label">Tallas</label>
                                    <select class="form-select" id="TallasText" name="TallasText" required>
                                        <option selected disabled value=""></option>
                                        <option>...</option>
                                    </select>
                                    <div class="invalid-tooltip">
                                        Please select a valid state.
                                    </div>
                                </div>


                                <div class="col-md-1">
                                    <label>Cantidad</label>
                                    <input id="cantidad" class="form-control" type="text" name="cantidad">
                                </div>

                                <div class="col-md-1">
                                    <label>Precio</label>
                                    <input id="precio" class="form-control" type="text" name="precio">
                                </div>

                                <div class="col-md-2">
                                    <label>Color</label>
                                    <input class="form-control" id="color" type="text" name="color">
                                </div>

                                <div class="col-md-2">
                                    <label>Color de la letra</label>
                                    <input class="form-control" id="color_letra" type="text" value="N/A"
                                        onfocus="if(this.value === 'N/A') { this.value = ''; }"
                                        onblur="if(this.value === '') { this.value = 'N/A'; }">
                                </div>

                                <div class="col-md-2">
                                    <label for="logo_izquierdo">Logo Izquierdo</label>
                                    <input class="form-control" id="logo_izquierdo" type="text" value="N/A"
                                        onfocus="if(this.value === 'N/A') { this.value = ''; }"
                                        onblur="if(this.value === '') { this.value = 'N/A'; }">
                                </div>

                                <div class="col-md-2">
                                    <label>Logo Derecho</label>
                                    <input class="form-control" id="logo_derecho" type="text" value="N/A"
                                        onfocus="if(this.value === 'N/A') { this.value = ''; }"
                                        onblur="if(this.value === '') { this.value = 'N/A'; }">
                                </div>

                                <div class="col-md-2">
                                    <label>Logo Delantero</label>
                                    <input class="form-control" id="logo_delantero" type="text" value="N/A"
                                        onfocus="if(this.value === 'N/A') { this.value = ''; }"
                                        onblur="if(this.value === '') { this.value = 'N/A'; }">
                                </div>

                                <div class="col-md-2">
                                    <label>Logo Trasero</label>
                                    <input class="form-control" id="logo_trasero" type="text" value="N/A"
                                        onfocus="if(this.value === 'N/A') { this.value = ''; }"
                                        onblur="if(this.value === '') { this.value = 'N/A'; }">
                                </div>

                                <div class="col-md-3">
                                    <label></label>
                                    <button id="btnDetallev" name="btnDetallev" class="btn btn-success" type="button"
                                        onclick="document.getElementById('precio').readOnly = true; calcularPreciov(event);"
                                        style="width: 100%;">Agregar</button>
                                </div>

                                <div class="col-md-1">
                                    <label></label>
                                    <button id="btnLimpiar" name="btnLimpiar" class="btn btn-danger" type="button"
                                        onclick="limpiarFormulario(); document.getElementById('precio').readOnly = false;"
                                        style="width: 100%;">
                                        <i class="fas fa-broom"></i>
                                    </button>
                                </div>

                                <script>
                                    function limpiarFormulario() {
                                        document.getElementById("frmDetallev").reset();
                                    }
                                </script>



                                <div class="col-md-1">
                                    <input id="sub_total" class="form-control" name="sub_total" type="hidden">
                                </div>

                            </div>



                    </div>
                </div>
                <br>
                <table class="table table-light table bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">ID Usuario</th>
                            <th scope="col">Tipo Producto</th>
                            <th scope="col">Descripcion del producto</th>
                            <th scope="col">Talla</th>
                            <th scope="col">Color</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Precio</th>
                            <th scope="col">SubTotal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="tblDetalleFactura">
                    </tbody>
                </table>
                </form>
        </div>

        <br>



        <div class="card">

            <form id="frmVent">
                <div class="row" style="margin-bottom: 0.5em;">


                    <p style="margin-bottom: 0.5em;">

                    </p>

                    <p>
                    <div class="col-md-2">
                        <label for="validationCustomUsername" class="form-label">Descuento</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text" id="descuentos">
                                <i class="fas fa-percent"></i>
                            </span>
                            <input type="text" class="form-control" id="descuento" aria-describedby="inputGroupPrepend"
                                required>
                        </div>
                    </div>



                    <div class="col-md-2">
                        <label for="validationCustomUsername" class="form-label">Abono</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text" id="abonos">
                                <i class="fas fa-money-bill-wave"></i>
                            </span>
                            <input type="text" class="form-control" id="abono" aria-describedby="inputGroupPrepend"
                                required>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <label for="validationCustomUsername" class="form-label">Total</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text" id="totaln">
                                <i class="fas fa-money-bill-wave"></i>
                            </span>
                            <input type="text" class="form-control" id="total" aria-describedby="inputGroupPrepend"
                                required disabled>
                        </div>
                    </div>


                    <div class="col-md-3">
                        <label for="validationCustomUsername" class="form-label">Cajero</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text" id="cajeros">
                                <i class="fas fa-user"></i>
                            </span>
                            <!-- Utilizamos PHP para obtener el nombre de usuario de la sesión -->
                            <input type="text" class="form-control" id="cajero" aria-describedby="inputGroupPrepend"
                                value="<?php echo isset($_SESSION['usuario']) ? $_SESSION['usuario'] : 'Invitado'; ?>"
                                required disabled>
                        </div>
                    </div>


                </div>


                <p>
                <div>
                    <label for="comentario">Comentario (Opcional)</label>
                    <textarea class="form-control" id="comentario" onfocus="limpiarTexto()"
                        onblur="establecerTextoPorDefecto()">N/A</textarea>
                </div>

                <script>
                    function limpiarTexto() {
                        var textarea = document.getElementById('comentario');
                        if (textarea.value === 'N/A') {
                            textarea.value = '';
                        }
                    }

                    function establecerTextoPorDefecto() {
                        var textarea = document.getElementById('comentario');
                        if (textarea.value === '') {
                            textarea.value = 'N/A';
                        }
                    }
                </script>
                </p>

        </div>
        <br>
        <div class="-grid gap-1 col-4 mx-auto">
            <div class="d-grid"><a class="btn btn-success" onclick="generarVenta()">Registrar pedido</a>
            </div>
        </div>



        </form>
    </div>







    <div id="nuevo_cliente" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="title">Nuevo Cliente</h5>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" id="frmClientes">
                        <div class="form-group">
                            <label for="clientes_id"></label>
                            <input id="clientes_id" class="form-control" type="hidden" name="clientes_id"
                                placeholder="ID cliente">
                        </div>

                        <div class="form-group">
                            <label for="nombre_cliente">Nombre del Cliente</label>
                            <input id="nombre_cliente" class="form-control" type="text" name="nombre_cliente"
                                placeholder="Nombre del Cliente">
                        </div>

                        <div class="form-group">
                            <label for="identificacion">Identificacion</label>
                            <input id="identificacion" class="form-control" type="text" name="identificacion"
                                placeholder="Identificacion">
                        </div>

                        <div class="form-group">
                            <label for="telefono">Teléfono</label>
                            <input id="telefono" class="form-control" type="text" name="telefono"
                                placeholder="Teléfono">
                        </div>

                        <button class="btn btn-primary" type="button" onclick="registrarCliente(event);"
                            id="btnAccion">Registrar</button>
                        <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancelar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <div id="nuevo_talla" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="title">Nueva Talla</h5>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" id="frmTallas">
                        <div class="form-group">
                            <label for="TallasID"></label>
                            <input id="TallasID" class="form-control" type="hidden" name="TallasID"
                                placeholder="ID Tallas">
                        </div>

                        <div class="form-group">
                            <label for="TipoTalla">Tipo de talla</label>
                            <input id="TipoTalla" class="form-control" type="text" name="TipoTalla"
                                placeholder="Tipo de talla">
                        </div>

                        <button class="btn btn-primary" type="button" onclick="registrarTallas(event);"
                            id="btnAccion">Registrar</button>
                        <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancelar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    </div>

    </div>

    </div>
    </div>
    </div>
    </main>
    </div>
    <div id="layoutAuthentication_footer">
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                </div>
            </div>
        </footer>
    </div>
    </div>
</body>

<?php include "Views/Templates/footer.php"; ?>