<?php include "Views/Templates/header.php"; ?>
<div class="card">
    <div class="card-header bg-primary text-white text-center">
        <h4 class="mx-auto">
            Compras Realizadas
        </h4>
    </div>
</div>
<br>

<form action="<?php echo base_url; ?>Compras/pdf" method="POST" target="_blank">
    <center>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="min">Desde</label>
                    <input type="date" value="<?php echo date('Y-m-d'); ?>" name="desde" id="min">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="hasta">Hasta</label>
                    <input type="date" value="<?php echo date('Y-m-d'); ?>" name="hasta" id="hasta">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <button type="submit" class="btn btn-danger">PDF</button>
                </div>
            </div>
        </div>
</form>


<div class="table-responsive">
    <table class="table table-light" id="tblrealizadas">
        <thead class="thead-dark">
            <tr>
                <th>Nº Factura</th>
                <th>Total</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>


<?php include "Views/Templates/footer.php"; ?>