<div class="table-responsive">
<label class="table-title">Lista de Cuentas</label>
<table class="table table-sm" id="table-list">
    <thead>
        <tr>
            <td class="col-idx">Nro</td>
            <td>Nombre</td>
            <td class="col-sdo">Saldo</td>
            <td class="col-btn"></td>
        </tr>
    </thead>
    <tbody>
    <?php
    $idx=1;
    foreach ($datos as $key => $cuenta) {
        ?>
        <tr id="<?php echo $cuenta['id']; ?>">
            <td class="col-idx"><?php echo $idx++; ?></td>
            <td><?php echo $cuenta['descripcion']; ?></td>
            <td class="col-sdo"><?php echo $cuenta['saldo_inicial']." ".$cuenta['signo_moneda']; ?></td>
            <td class="col-btn">
                <button class="btn btn-success btn-list-item" name="btn-list-item" data-id="<?php echo $cuenta['id']; ?>" data-action="Cuentas/obtenerCuenta" type="button">C</button>
                <button class="btn btn-danger btn-list-item" name="btn-list-item" data-id="<?php echo $cuenta['id']; ?>" data-action="Cuentas/borrarCuenta" type="button">X</button>
            </td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>
</div>