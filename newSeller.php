<?php
  include_once 'funciones/sesiones.php';
  include_once 'templates/header.php';
  include_once 'templates/navBar.php';
  include_once 'templates/sideBar.php';
  include_once 'funciones/bd_conexion.php';
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Vendedores
        <small>llena el formulario para crear un vendedor</small>
      </h1>
    </section>

    <div class="row">
      <div class="col-md-8">
        <!-- Main content -->
        <section class="content">
          <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Crear Vendedores</h3>
            </div>
            <div class="box-body">
              <form role="form" id="form-vendedor" name="form-vendedor" method="post" action="BLL/seller.php">
                <div class="box-body">
                  <div class="form-group">
                    <span class="text-danger text-uppercase">*</span><label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre-vendedor" name="nombre-vendedor" placeholder="Escribe tu nombre" autofocus>
                  </div>
                  <div class="form-group">
                    <span class="text-danger text-uppercase">*</span><label for="apellido">Apellido</label>
                    <input type="text" class="form-control" id="apel-vendedor" name="apel-vendedor" placeholder="Escribe tu apellido">
                  </div>
                  <div class="form-group">
                    <label for="usuario">Dirección</label>
                    <input type="text" class="form-control" id="direc" name="direc" placeholder="Escribe la dirección del vendedor">
                  </div>
                  <div class="form-group">
                    <span class="text-danger text-uppercase">*</span><label>Teléfono</label>
                    <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Escribe el teléfono del vendedor">
                  </div>
                  <div class="form-group">
                    <span class="text-danger text-uppercase">*</span><label for="password">DPI</label>
                    <input type="password" class="form-control" id="dpi" name="dpi" placeholder="Escribe el dpi del vendendor">
                  </div>
                  <div class="form-group">
                    <label>Fecha de Nacimiento</label>
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="date" class="form-control pull-right" max="<?php echo date("Y").'-'.date("m").'-'.date("d") ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label>
                      <input type="checkbox" class="flat-red" checked>
                    </label>
                    <label>
                      <input type="checkbox" class="flat-red">
                    </label>
                    <label>
                      <input type="checkbox" class="flat-red" disabled>
                      Flat green skin checkbox
                    </label>
                  </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                  <input type="hidden" name="registro" value="nuevo">
                  <button type="submit" class="btn btn-info" id="crear-usuario"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button><span class="text-warning"> Debe llenar los campos obligatorios *</span>
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
