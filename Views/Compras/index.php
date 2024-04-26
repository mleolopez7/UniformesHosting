<?php include "Views/Templates/header.php"; ?>

<div class="card">
    <div class="card">
        <div class="card-header bg-primary text-white text-center">
            <h4 class="mx-auto">
                Nueva Compra
            </h4>
        </div>
    </div>
    <div class="card-body">
        <form id="frmCompra">
            <div class="row">

                <div class="col-md-3">
                    <div class="form-group" id="proveedores">
                        <label for="proveedor">Proveedores</label>
                        <select id="proveedor" class="form-control" name="proveedor" class="input-group-text">
                            <option value="" selected disabled>Seleccionar Proveedor</option>
                            <!-- Aquí se llenarán dinámicamente los proveedores -->
                        </select>
                    </div>
                </div>



                <div class="col-md-3">
                    <div class="form-group" id="materia_prima">
                        <label for="materiaPrima">Materia Prima</label>
                        <select id="materiaPrima" class="form-control" name="materiaPrima" class="input-group-text">
                            <option value="" selected disabled>Seleccionar Materia Prima</option>
                            <!-- Aquí se llenarán dinámicamente los productos de materia prima -->
                        </select>
                    </div>
                </div>



                <div class="col-md-5">
                    <div class="form-group">
                        <label for="descripcion">Descripcion</label>
                        <input id="descripcion" class="form-control" type="text" name="descripcion"
                            placeholder="Descripcion" readonly>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="cantidad_compra">Cantidad</label>
                        <input id="cantidad_compra" class="form-control" type="number" name="cantidad_compra"
                            placeholder="Cantidad">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="precio_compra">Precio</label>
                        <input id="precio_compra" class="form-control" type="number" name="precio_compra"
                            placeholder="Precio Compra" onkeyup="calcularPrecio(event)">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group d-flex flex-column">
                        <label for="sub_total">Sub Total</label>
                        <div class="d-flex">
                            <input id="sub_total" class="form-control" type="text" name="sub_total" placeholder=""
                                disabled>
                            <button id="btnDetallec" name="btnDetallec" class="btn btn-success ml-4 align-self-end"
                                type="button" onclick="calcularPrecioc()">Agregar</button>
                        </div>
                    </div>
                </div>

                <div class="col-md-1">
                    <label>.</label>
                    <!-- Botón con icono de "limpiar" -->
                    <button id="btnLimpiar" name="btnLimpiar" class="btn btn-danger" type="button"
                        onclick="limpiarFormulario()" style="width: 100%;">
                        <i class="fas fa-broom"></i>
                    </button>
                </div>

                <script>
                    function limpiarFormulario() {
                        document.getElementById("frmCompra").reset();
                    }
                </script>
                <!-- <button id="btntotal" name="btntotal" class="btn btn-dark mt-2 align-self-stretch" type="button" onclick="calcularPrecio()">Agregar a la Factura</button> -->
            </div>

    </div>
    </form>
</div>
</div>

<table class="table table-light">
    <thead class="thead-dark">
        <tr>
            <th>ID usuario</th>
            <th>Proveedor</th>
            <th>Producto</th>
            <th>Descripcion</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Sub total</th>
            <th></th>
        </tr>
    </thead>
    <tbody id="tblDetalle">
    </tbody>
</table>
<div class="card-body">
    <form id="frmCompra">
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="factura">Factura</label>
                        <input id="factura" class="form-control" type="text" name="factura" placeholder="Nº Factura">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="fechas">Fecha</label>
                        <input id="fecha" class="form-control" type="date" name="fecha">
                    </div>
                    <div id="mensajeFecha" style="color: red;"></div>
                </div>


                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        var inputFechaCompra = document.getElementById('fecha');
                        inputFechaCompra.max = obtenerFechaActual(); // Establecer la fecha máxima como la fecha actual

                        inputFechaCompra.addEventListener('change', validarFechaCompra);

                        function obtenerFechaActual() {
                            var today = new Date();
                            var year = today.getFullYear();
                            var month = ('0' + (today.getMonth() + 1)).slice(-2);
                            var day = ('0' + today.getDate()).slice(-2);
                            return year + '-' + month + '-' + day;
                        }

                        function validarFechaCompra() {
                            var fechaCompra = new Date(inputFechaCompra.value);
                            var fechaActual = new Date(obtenerFechaActual());

                            fechaCompra.setHours(0, 0, 0, 0);
                            fechaActual.setHours(0, 0, 0, 0);

                            if (fechaCompra.getTime() > fechaActual.getTime()) {
                                document.getElementById('mensajeFecha').textContent = 'La fecha seleccionada no puede ser futura.';
                                document.getElementById('mensajeFecha').style.color = 'red';
                                inputFechaCompra.value = obtenerFechaActual(); // Reestablece la fecha a hoy si se selecciona una fecha futura
                            } else {
                                document.getElementById('mensajeFecha').textContent = '';
                                document.getElementById('mensajeFecha').style.color = 'green';
                            }
                        }
                    });
                </script>


                <div class="col-md-2">
                    <div class="form-group">
                        <label for="isv" class="font-weight-bold">Impuesto</label>
                        <div class="input-group">
                            <input id="isv" class="form-control" type="text" name="isv">
                            <div class="input-group-append">
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="descuento" class="font-weight-bold">Descuento</label>
                        <div class="input-group">
                            <input id="descuento" class="form-control" type="text" name="descuento">
                            <div class="input-group-append">
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group d-flex flex-column align-items-start">
                        <label for="total" class="font-weight-bold">Total Compra</label>
                        <input id="total" class="form-control" type="text" name="total" placeholder="Total" disabled>
                        <button id="btntotal" name="btntotal" class="btn btn-success mt-2 align-self-stretch"
                            type="button" onclick="generarCompra()">Generar Factura</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>



<?php include "Views/Templates/footer.php"; ?>