<?php
include_once 'funciones/sesiones.php';
include_once 'templates/header.php';
include_once 'templates/navBar.php';
include_once 'templates/sideBar.php';
include_once 'funciones/bd_conexion.php';
$id = $_GET['id'];
if (!filter_var($id, FILTER_VALIDATE_INT)) {
    die("Error!");
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-briefcase"></i>
            Vendedores
            <small>cambia los datos de un vendedor</small>
        </h1>
    </section>

    <div class="row">
        <div class="col-md-6">
            <!-- Main content -->
            <section class="content">
                <!-- Default box -->
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Actualizar Vendedores</h3>
                    </div>
                    <div class="box-body">
                        <?php
$sql = "SELECT * FROM `seller` S INNER JOIN commission C ON S.idSeller = C._idSeller WHERE `idSeller` = $id ";
$resultado = $conn->query($sql);
$seller = $resultado->fetch_assoc();
?>
                        <form role="form" id="form-vendedor" name="form-vendedor" method="post" action="BLL/seller.php">
                            <div class="box-body">
                                <div class="form-group">
                                    <span class="text-danger text-uppercase">*</span><label for="codigo">Código de
                                        Vendedor</label>
                                    <input type="text" class="form-control" id="codigo-vendedor" name="codigo-vendedor"
                                        placeholder="Escribe el código del vendedor" value="<?php echo $seller['sellerCode']; ?>"
                                        autofocus>
                                </div>
                                <div class="form-group">
                                    <span class="text-danger text-uppercase">*</span><label for="nombre">Nombre</label>
                                    <input type="text" class="form-control" id="nombre-vendedor" name="nombre-vendedor"
                                        placeholder="Escribe el nombre del vendedor" value="<?php echo $seller['sellerFirstName']; ?>">
                                </div>
                                <div class="form-group">
                                    <span class="text-danger text-uppercase">*</span><label for="apellido">Apellido</label>
                                    <input type="text" class="form-control" id="apel-vendedor" name="apel-vendedor"
                                        placeholder="Escribe el apellido del vendedor" value="<?php echo $seller['sellerLastName']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="usuario">Dirección</label>
                                    <input type="text" class="form-control" id="direc-vendedor" name="direc-vendedor"
                                        placeholder="Escribe la dirección del vendedor" value="<?php echo $seller['sellerAddress']; ?>">
                                </div>
                                <div class="form-group">
                                    <span class="text-danger text-uppercase">*</span><label>Teléfono</label>
                                    <input type="text" class="form-control" id="tel-vendedor" name="tel-vendedor"
                                        placeholder="Escribe el teléfono del vendedor" value="<?php echo $seller['sellerMobile']; ?>">
                                </div>
                                <div class="form-group">
                                    <?php if ($seller['gender'] == '0') {?>
                                    <span class="text-danger text-uppercase">*</span><label>Masculino</label>
                                    <input type="radio" id="gen-vendedor" name="gen-vendedor" class="flat-red" value="0"
                                        checked>
                                    <span class="text-danger text-uppercase">*</span><label>Femenino</label>
                                    <input type="radio" id="gen-vendedor" name="gen-vendedor" class="flat-red" value="1">
                                    <?php } elseif ($seller['gender'] == '1') {?>
                                    <span class="text-danger text-uppercase">*</span><label>Masculino</label>
                                    <input type="radio" id="gen-vendedor" name="gen-vendedor" class="flat-red" value="0">
                                    <span class="text-danger text-uppercase">*</span><label>Femenino</label>
                                    <input type="radio" id="gen-vendedor" name="gen-vendedor" class="flat-red" value="1"
                                        checked>
                                    <?php }?>
                                </div>
                            </div>
                            <!-- /.box-body -->
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </section>
            <!-- /.content -->
        </div>
        <div class="col-md-6">
            <!-- Main content -->
            <section class="content">
                <!-- Default box -->
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title"></h3>
                    </div>
                    <div class="box-body">
                        <div class="box-body">
                            <div class="form-group">
                                <span class="text-danger text-uppercase">*</span><label>DPI</label>
                                <input type="text" class="form-control" id="dpi-vendedor" name="dpi-vendedor"
                                    placeholder="Escribe el dpi del vendendor" value="<?php echo $seller['DPI']; ?>">
                            </div>
                            <div class="form-group">
                                <label>Fecha de nacimiento</label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <?php $date = date_create($seller['birthDate']);?>
                                    <input type="text" class="form-control pull-right datepicker" id="datepicker" name="bday-vendedor"
                                        value="<?php echo date_format($date, 'd/m/Y'); ?>">
                                </div>
                            </div>
                            <h5 class="text-blue">Comisión de producto propio<small> (En días <span><i class="fa fa-calendar"></i></span>
                                    y porcentaje %)</small></h5>
                            <div class="form-group col-md-4">
                                <span class="text-danger text-uppercase">*</span><label for="codigo">#1</label>
                                <div class="input-group">
                                    <input type="number" min="0" step="1" value="<?php echo $seller['sd30']; ?>" class="form-control"
                                        id="sd30" name="sd30" placeholder="#Días">
                                    <span class="input-group-addon"> <i class="fa fa-calendar"></i></span>
                                </div>
                                <div class="input-group">
                                    <input type="number" min="0" step="1" max="100" value="<?php echo $seller['s30']; ?>"
                                        class="form-control" id="s30" name="s30" placeholder="Comisión a 30 días">
                                    <span class="input-group-addon">%</span>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <span class="text-danger text-uppercase">*</span><label for="codigo">#2</label>
                                <div class="input-group">
                                    <input type="number" min="0" step="1" value="<?php echo $seller['sd60']; ?>" class="form-control"
                                        id="sd60" name="sd60" placeholder="#Días">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                                <div class="input-group">
                                    <input type="number" min="0" step="1" max="100" value="<?php echo $seller['s60']; ?>"
                                        class="form-control" id="s60" name="s60" placeholder="Comisión a 60 días">
                                    <span class="input-group-addon">%</span>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <span class="text-danger text-uppercase">*</span><label for="codigo">#3</label>
                                <div class="input-group">
                                    <input type="number" min="0" step="1" value="<?php echo $seller['sd90']; ?>" class="form-control"
                                        id="sd90" name="sd90" placeholder="#Días">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                                <div class="input-group">
                                    <input type="number" min="0" step="1" max="100" value="<?php echo $seller['s90']; ?>"
                                        class="form-control" id="s90" name="s90" placeholder="Comisión a 90 días">
                                    <span class="input-group-addon">%</span>
                                </div>
                            </div>
                            <h5 class="text-blue">Comisión de otro producto<small> (En días <span><i class="fa fa-calendar"></i></span>
                                    y porcentaje %)</small></h5>
                            <div class="form-group col-md-4">
                                <span class="text-danger text-uppercase">*</span><label for="codigo">#1</label>
                                <div class="input-group">
                                    <input type="number" min="0" step="1" value="<?php echo $seller['od30']; ?>" class="form-control"
                                        id="od30" name="od30" placeholder="#Días">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                                <div class="input-group">
                                    <input type="number" min="0" step="1" max="100" value="<?php echo $seller['o30']; ?>"
                                        class="form-control" id="o30" name="o30" placeholder="Comisión a 30 días">
                                    <span class="input-group-addon">%</span>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <span class="text-danger text-uppercase">*</span><label for="codigo">#2</label>
                                <div class="input-group">
                                    <input type="number" min="0" step="1" value="<?php echo $seller['od60']; ?>" class="form-control"
                                        id="od60" name="od60" placeholder="#Días">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                                <div class="input-group">
                                    <input type="number" min="0" step="1" max="100" value="<?php echo $seller['o60']; ?>"
                                        class="form-control" id="o60" name="o60" placeholder="Comisión a 60 días">
                                    <span class="input-group-addon">%</span>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <input type="hidden" name="reg-vendedor" value="actualizar">
                            <input type="hidden" name="id-reg-vendedor" value="<?php echo $id; ?>">
                            <button type="submit" class="btn btn-info" id="crear-vendedor"><i class="fa fa-floppy-o"
                                    aria-hidden="true"></i> Guardar</button><span class="text-warning"> *Debe
                                llenar los campos obligatorios </span>
                        </div>
                        </form>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </section>
            <!-- /.content -->
        </div>
    </div>
</div>
<!-- /.content-wrapper -->

<?php
include_once 'templates/footer.php';

?>