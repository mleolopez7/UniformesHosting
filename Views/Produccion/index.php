<?php

include "Views/Templates/header.php"; ?>
<div class="card-header bg-dark text-white text-center fs-4">
    Produccion de ordenes
</div>

<div class="table-responsive-sm">
    <table class="table table-sm table-light" id="tblProduccion">
        <thead class="thead-dark">
            <tr>
                <th>Nº Factura</th>
                <th>Cliente</th>
                <th>Identificacion</th>
                <th>Telefono</th>
                <th>Fecha Entrega</th>
                <th>Total Venta</th>
                <th>Debe</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>

            <!-- Aquí van tus filas de datos -->
        </tbody>
    </table>
</div>

<div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="title">Material utilizado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="frmUsado">

                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="fecha_actual">Fecha</label>
                                <input id="fecha_actual" class="form-control" type="date" name="fecha_actual"
                                    placeholder="Cant" disabled>
                            </div>
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


                        <div class="col-md-4">
                            <div class="form-group" id="materia_prima">
                                <label for="materiaPrima">Producto</label>
                                <select id="materiaPrima" class="form-control" name="materiaPrima"
                                    class="input-group-text">
                                    <option value="" selected disabled>Seleccionar Materia Prima</option>
                                    <!-- Aquí se llenarán dinámicamente los productos de materia prima -->
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="cantidad">Cantidad</label>
                                <input id="cantidad" class="form-control" type="number" name="cantidad"
                                    placeholder="Cant">
                            </div>
                        </div>

                        <div class="col-md-7">
                            <div class="form-group">
                                <label for="motivo">Motivo</label>
                                <input id="motivo" class="form-control" type="text" name="motivo"
                                    placeholder="Motivo de salida">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-floating">
                                <button id="btnDetallesa" name="btnDetallesa"
                                    class="btn btn-success mt-4 align-self-stretch" type="button"
                                    onclick="calcularSalida(event)">Agregar</button>
                            </div>
                        </div>

                    </div>

                    <table class="table table-light">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID Usuario</th>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Motivo de salida</th>
                                <th>Fecha</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="tblDetalleSalida">
                        </tbody>
                    </table>

                    <div class="mt-4 mb-0">
                        <div class="d-grid"><a class="btn btn-success btn-block" onclick="generarSalida()">Generar Salida</a></div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

</div>


<?php include "Views/Templates/footer.php"; ?>