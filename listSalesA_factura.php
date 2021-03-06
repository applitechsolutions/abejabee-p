<?php
include_once 'funciones/sesiones.php';
include_once 'templates/header.php';
?>

<body class="hold-transition skin-blue sidebar-collapse sidebar-mini">
    <?php
    include_once 'templates/navBar.php';
    include_once 'templates/sideBar.php';
    include_once 'funciones/bd_conexion.php';
    ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <i class="fas fa-file-invoice"></i> Facturas
                <small>Listado de ventas activas.</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Listado de ventas activas</h3>
                        </div>

                        <!-- MODAL DETALLES -->
                        <div class="modal fade" id="modal-detailS">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <h4 class="modal-title">
                                            <li class="glyphicon glyphicon-list-alt"></li> Detalle de la Venta
                                        </h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="box box-success">
                                            <div class="box-header">
                                            </div>
                                            <!-- /.box-header -->
                                            <div class="box-body table-responsive no-padding">
                                                <table id="detalles" class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Imagen</th>
                                                            <th>Nombre</th>
                                                            <th>Código</th>
                                                            <th>Cantidad</th>
                                                            <th>Precio/u</th>
                                                            <th>Descuento</th>
                                                            <th>SubTotal</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>Imagen</th>
                                                            <th>Nombre</th>
                                                            <th>Código</th>
                                                            <th>Cantidad</th>
                                                            <th>Precio/u</th>
                                                            <th>Descuento</th>
                                                            <th>SubTotal</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                            <!-- /.box-body -->
                                        </div>
                                    </div>
                                    <?php
                                    if ($_SESSION['rol'] == 1) { ?>
                                        <div id="editarF" class="modal-footer">
                                        </div>
                                    <?php
                                    } ?>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>

                        <!-- MODAL BALANCES -->
                        <div class="modal fade" id="modal-balance">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button id="correlativeCloseB" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <h4 class="modal-title"><i class="fa fa-balance-scale"></i> Balance de Saldos
                                        </h4>
                                    </div>
                                    <div class="modal-body">
                                        <form role="form" id="form-pay" name="form-pay" method="post" action="BLL/balance.php">
                                            <div class="row">
                                                <div class="col-md-4 pull-left">
                                                    <div class="info-box bg-green">
                                                        <span class="info-box-icon"><i class="fa fa-money"></i></span>
                                                        <div class="info-box-content">
                                                            <span class="info-box-text">Saldo actual:</span>
                                                            <span class="info-box-number"><label for="totalB" id="totalBal"></label></span>
                                                        </div>
                                                        <!-- /.info-box-content -->
                                                    </div>
                                                </div>

                                                <div class="col-md-3 pull-left">
                                                    <div class="form-group">
                                                        <span class="text-danger text-uppercase">*</span>
                                                        <label>Fecha</label>
                                                        <div class="input-group date">
                                                            <div class="input-group-addon">
                                                                <i class="fa fa-calendar"></i>
                                                            </div>
                                                            <input type="text" class="form-control pull-right datepicker" id="datepicker" name="dateB">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 pull-left">
                                                    <div class="form-group">
                                                        <label for="noDocument">No. de documento</label>
                                                        <input type="text" class="form-control" id="noDocument" name="noDocument" placeholder="Escriba un número de documento" autofocus>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 pull-left">
                                                    <div class="info-box bg-yellow">
                                                        <span class="info-box-icon"><i class="fa fa- fa-hourglass-half"></i></span>
                                                        <div class="info-box-content">
                                                            <span class="info-box-text">Pagos retenidos:</span>
                                                            <span class="info-box-number"><label for="totalP" id="totalPal">Q.
                                                                    0.00</label></span>
                                                        </div>
                                                        <!-- /.info-box-content -->
                                                    </div>
                                                </div>
                                                <div class="col-md-2 pull-right">
                                                    <div class="form-group">
                                                        <span class="text-danger text-uppercase">*</span><label>Tipo</label>
                                                        <label for="cheque">
                                                            <input type="checkbox" id="cheque" name="cheque" class="minimal" value="0">
                                                            Cheque
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 pull-right">
                                                    <div class="form-group">
                                                        <span class="text-danger text-uppercase">*</span>
                                                        <label for="amount">Monto</label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                Q.
                                                            </span>
                                                            <input type="number" id="amount" name="amount" placeholder="0.00" min="0.00" step="0.01" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 pull-right">
                                                    <div class="form-group">
                                                        <label for="noReceipt">No. de recibo</label>
                                                        <input type="text" class="form-control" id="noReceipt" name="noReceipt" placeholder="Escriba un número de recibo">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- /.box-body -->
                                            <div class="modal-footer">
                                                <input type="hidden" name="tipo" value="pago">
                                                <input type="hidden" id="idSale" name="idSale" value="0">
                                                <input type="hidden" id="totalB" name="totalB" value="0">
                                                <input type="hidden" id="totalP" name="totalP" value="0">
                                                <?php
                                                if ($_SESSION['rol'] == 1) { ?>
                                                    <span class="text-warning pull-right"> *Debe llenar los campos
                                                        obligatorios
                                                    </span>
                                                    <button type="submit" class="btn btn-primary pull-right" id="crear-pago">
                                                        <i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
                                                <?php
                                                } elseif ($_SESSION['rol'] == 2) { ?>
                                                    <span class="text-warning pull-right"> *No tiene permisos para ingresar
                                                        pagos </span>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                            <div class="box box-primary">
                                                <div class="box-header">
                                                    <h3 class="box-title">
                                                        <i class="fa fa-history"></i> Historial</h3>
                                                </div>
                                                <!-- /.box-header -->
                                                <div class="box-body table-responsive no-padding">
                                                    <table id="detallesB" class="table table-bordered table-striped product-add">
                                                        <thead>
                                                            <tr>
                                                                <th>Fecha</th>
                                                                <th>Recibo No°</th>
                                                                <th>Tipo</th>
                                                                <th>Documento No°</th>
                                                                <th>Monto</th>
                                                                <th>Saldo</th>
                                                                <th>Acciones</th>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                                    <!-- /.box-body -->
                                                </div>
                                            </div>
                                            <br>
                                            <div class="box box-danger">
                                                <div class="box-header">
                                                    <h3 class="box-title">
                                                        <i class="fa fa-ban"></i> Pagos Anulados</h3>
                                                </div>
                                                <!-- /.box-header -->
                                                <div class="box-body table-responsive no-padding">
                                                    <table id="anuladosB" class="table table-bordered table-striped product-add">
                                                        <thead>
                                                            <tr>
                                                                <th>Fecha</th>
                                                                <th>Recibo No°</th>
                                                                <th>Tipo</th>
                                                                <th>Documento No°</th>
                                                                <th>Monto</th>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                                    <!-- /.box-body -->
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.modal-content -->

                        <!-- MODAL IMPRIMIR -->
                        <div class="modal fade" id="modal-printS">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <h4 class="modal-title">
                                            <li class="glyphicon glyphicon-print"></li> Imprimir
                                        </h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="box box-info">
                                            <div class="box-header">
                                            </div>
                                            <!-- /.box-header -->
                                            <div id="divreporteL" class="w3-rest">
                                                <iframe src="" style="width: 100%; height: 700px; min-width: 300px;"></iframe>
                                            </div>
                                            <!-- /.box-body -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <table id="registros" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Factura No°</th>
                                        <th>Fecha</th>
                                        <th>Código vendedor</th>
                                        <th>Código Cliente</th>
                                        <th>Cliente</th>
                                        <th>Nit</th>
                                        <th>Dirección</th>
                                        <th>Teléfono</th>
                                        <th>Fecha de vencimiento</th>
                                        <th>Total</th>
                                        <th>Acciones <i class="fa fa-cogs"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    try {
                                        $sql = "SELECT B.*, (select noDeliver from sale where idSale = B._idSale) as remision,
                                        (select cancel from sale where idSale = B._idSale) as cancel
                                        FROM bill B ORDER BY B.noBill DESC";
                                        $resultado = $conn->query($sql);
                                    } catch (Exception $e) {
                                        $error = $e->getMessage();
                                        echo $error;
                                    }

                                    while ($bill = $resultado->fetch_assoc()) {
                                        $dateEnd = date_create($bill['dateEnd']);
                                        $dateB = date_create($bill['date']);
                                        ?>
                                        <tr>
                                            <td>
                                                Factura:
                                                <h6><span class="label label-primary"><?php echo $bill['serie'] . ' ' . $bill['noBill']; ?></span>
                                                </h6>
                                                Remisión:
                                                <h6><span class="label label-default"><?php echo $bill['remision']; ?></span>
                                                    <?php if ($bill['cancel'] == 49) { ?>
                                                        <span class="label label-success"><i class="fas fa-hand-holding-usd"></i></span>
                                                    <?php } else if ($bill['cancel'] == 48) { ?>
                                                        <span class="label label-warning"><i class="fas fa-clock"></i></span>
                                                    <?php } ?>
                                                </h6>
                                            </td>
                                            <td>
                                                <?php if ($bill['date'] != '0000-00-00') {
                                                        echo date_format($dateB, 'd/m/y');
                                                    } else {
                                                        echo 'No disponible';
                                                    } ?>
                                            </td>
                                            <td>
                                                <?php echo $bill['codeSeller']; ?>
                                            </td>
                                            <td>
                                                <?php echo $bill['codeCustomer']; ?>
                                            </td>
                                            <td>
                                                <?php echo $bill['custName']; ?>
                                            </td>
                                            <td>
                                                <?php echo $bill['custNit']; ?>
                                            </td>
                                            <td>
                                                <?php echo $bill['address']; ?>
                                            </td>
                                            <td>
                                                <?php echo $bill['mobile']; ?>
                                            </td>
                                            <td>
                                                <?php echo date_format($dateEnd, 'd/m/y'); ?>
                                            </td>
                                            <td>
                                                <?php echo 'Q' . $bill['total']; ?>
                                            </td>
                                            <td>
                                                <div class="btn-group-vertical col-xs-8">
                                                    <button type="button" class="btn btn-primary btn-sm imprimir_bill" data-id="<?php echo $bill['idBill']; ?>"><i class="fas fa-search"></i> Previsualizar</button>
                                                    <button type="button" class="btn btn-success btn-sm detalle_bill" data-id="<?php echo $bill['idBill']; ?>" data-tipo="listDetailB"><i class="fa fa-info"></i> Detalles</button>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn bg-teal-active btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                                            <span><i class="fa fa-print"></i> Imprimir</span>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li><a href="printSale.php?id=<?php echo $bill['_idSale']; ?>">
                                                                    Nueva Factura</a>
                                                            </li>
                                                            <li><a href="#" onclick="imprimir('guia',<?php echo $bill['_idSale']; ?>);">Guía</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Factura No°</th>
                                        <th>Código vendedor</th>
                                        <th>Código Cliente</th>
                                        <th>Cliente</th>
                                        <th>Nit</th>
                                        <th>Dirección</th>
                                        <th>Teléfono</th>
                                        <th>Fecha de vencimiento</th>
                                        <th>Total</th>
                                        <th>Acciones <i class="fa fa-cogs"></i></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <?php
    include_once 'templates/footer.php';

    ?>