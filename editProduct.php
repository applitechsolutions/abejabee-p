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
      <i class="fa fa-th"></i>
        Productos
        <small>Aquí puede editar el producto</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Editar Producto</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <?php
$sql = "SELECT idProduct, productName, productCode, cost, minStock, description, picture, _idMake, _idCategory, _idUnity,
(select price from priceSale where _idProduct = idProduct and _idPrice = 1) as public,
(select price from priceSale where _idProduct = idProduct and _idPrice = 11) as pharma,
(select price from priceSale where _idProduct = idProduct and _idPrice = 21) as business,
(select price from priceSale where _idProduct = idProduct and _idPrice = 31) as bonus
FROM product P WHERE idProduct = $id ";
$resultado = $conn->query($sql);
$product = $resultado->fetch_assoc();
?>
            <!-- MODAL CATEGORIA -->
            <div class="modal fade" id="modal-category">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Nueva Categoría</h4>
                  </div>
                  <div class="modal-body">
                    <form role="form" id="form-category" name="form-category" method="post" action="BLL/category.php">
                      <div class="form-group">
                        <span class="text-danger text-uppercase">*</span>
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Escriba un nombre" autofocus>
                      </div>
                      <div class="modal-footer">
                        <input type="hidden" name="categoria" value="nueva">
                        <button id="catClose" type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                        <span class="text-warning">  *Debe llenar los campos obligatorios</span>
                        <button type="submit" class="btn btn-info" id="crear-categoria">
                          <i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
                      </div>
                  </div>
                  </form>
                </div>
              </div>
              <!-- /.modal-content -->
            </div>

            <!-- MODAL UNIDAD -->
            <div class="modal fade" id="modal-unity">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Nueva Unidad</h4>
                  </div>
                  <div class="modal-body">
                    <form role="form" id="form-unity" name="form-unity" method="post" action="BLL/unity.php">
                      <div class="form-group">
                        <span class="text-danger text-uppercase">*</span>
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Escriba una unidad" autofocus>
                      </div>
                      <div class="modal-footer">
                        <input type="hidden" name="unidad" value="nueva">
                        <button id="uniClose" type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                        <span class="text-warning"> Debe llenar los campos obligatorios *</span>
                        <button type="submit" class="btn btn-info" id="crear-unidad">
                          <i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
                      </div>
                  </div>
                  </form>
                </div>
              </div>
              <!-- /.modal-content -->
            </div>

            <!-- MODAL MARCA -->
            <div class="modal fade" id="modal-make">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Nueva Marca</h4>
                  </div>
                  <div class="modal-body">
                    <form role="form" id="form-make" name="form-make" method="post" action="BLL/make.php">
                      <div class="form-group">
                        <span class="text-danger text-uppercase">*</span>
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Escriba un nombre" autofocus>
                      </div>
                      <div class="modal-footer">
                        <input type="hidden" name="marca" value="nueva">
                        <button id="makeClose" type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                        <span class="text-warning"> Debe llenar los campos obligatorios *</span>
                        <button type="submit" class="btn btn-info" id="crear-marca">
                          <i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
                      </div>
                  </div>
                  </form>
                </div>
              </div>
              <!-- /.modal-content -->
            </div>

            <div class="row">
              <div class="col-md-6">
                <form role="form" id="form-product" name="form-product-file" method="post" action="BLL/product.php" enctype="multipart/form-data">
                  <div class="box-body">
                  <div class="form-group">
                      <span class="text-danger text-uppercase">*</span>
                      <label for="codigo">Código</label>
                      <input type="text" class="form-control" id="code" name="code" placeholder="Escriba un código" value="<?php echo $product['productCode'] ?>">
                    </div>
                    <div class="form-group">
                      <span class="text-danger text-uppercase">*</span>
                      <label for="nombre">Nombre</label>
                      <input type="text" class="form-control" id="name" name="name" placeholder="Escriba un nombre" autofocus value="<?php echo $product['productName'] ?>">
                    </div>
                    <div class="form-group">
                    <span class="text-danger text-uppercase">*</span>
                    <label>Marca</label>
                    <button type="button" class="btn btn-Normal bg-teal-active btn-xs pull-right" data-toggle="modal" data-target="#modal-make">+ Crear Nueva</button>
                    <select id="make" name="make" class="form-control select2" style="width: 100%;">
                      <option value="" disabled selected>Seleccione una marca</option>
                      <?php
try {
    $marca_actual = $product['_idMake'];
    $sql = "SELECT * FROM make";
    $resultado = $conn->query($sql);
    while ($make_product = $resultado->fetch_assoc()) {
        if ($make_product['idMake'] == $marca_actual) {?>
                        <option value="<?php echo $make_product['idMake']; ?>" selected>
                          <?php echo $make_product['makeName']; ?>
                        </option>
                        <?php
} else {?>
                        <option value="<?php echo $make_product['idMake']; ?>">
                          <?php echo $make_product['makeName']; ?>
                        </option>
                        <?php
}
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
                    </select>
                  </div>
                  <br>
                  <div class="form-group">
                    <span class="text-danger text-uppercase">*</span>
                    <label>Categoría</label>
                    <button type="button" class="btn btn-Normal bg-teal-active btn-xs pull-right" data-toggle="modal" data-target="#modal-category">+ Crear Nueva</button>
                    <select id="category" name="category" class="form-control select2" style="width: 100%;">
                      <option value="" disabled selected>Seleccione una categoría</option>
                      <?php
try {
    $category_actual = $product['_idCategory'];
    $sql = "SELECT * FROM category";
    $resultado = $conn->query($sql);
    while ($cat_product = $resultado->fetch_assoc()) {
        if ($cat_product['idCategory'] == $category_actual) {?>
                        <option value="<?php echo $cat_product['idCategory']; ?>" selected>
                          <?php echo $cat_product['catName']; ?>
                        </option>
                        <?php
} else {?>
                        <option value="<?php echo $cat_product['idCategory']; ?>">
                          <?php echo $cat_product['catName']; ?>
                        </option>
                        <?php
}
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
                    </select>
                  </div>
                  <br>
                  <div class="form-group">
                    <span class="text-danger text-uppercase">*</span>
                    <label>Unidad</label>
                    <button type="button" class="btn btn-Normal bg-teal-active btn-xs pull-right" data-toggle="modal" data-target="#modal-unity">+ Crear Nueva</button>
                    <select id="unity" name="unity" class="form-control select2" style="width: 100%;">
                      <option value="" disabled selected>Seleccione una unidad</option>
                      <?php
try {
    $unidad_actual = $product['_idUnity'];
    $sql = "SELECT * FROM unity";
    $resultado = $conn->query($sql);
    while ($unity_product = $resultado->fetch_assoc()) {
        if ($unity_product['idUnity'] == $unidad_actual) {?>
                        <option value="<?php echo $unity_product['idUnity']; ?>" selected>
                          <?php echo $unity_product['unityName']; ?>
                        </option>
                        <?php
} else {?>
                        <option value="<?php echo $unity_product['idUnity']; ?>">
                          <?php echo $unity_product['unityName']; ?>
                        </option>
                        <?php
}
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
                    </select>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <span class="text-danger text-uppercase">*</span>
                        <label for="costo">Costo</label>
                        <div class="input-group">
                          <span class="input-group-addon">
                            <i class="fa fa-money"></i>
                          </span>
                          <input type="number" id="cost" name="cost" placeholder="0.00" min="0.00" step="0.01" class="form-control" value="<?php echo $product['cost']; ?>">
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <span class="text-danger text-uppercase">*</span>
                        <label for="costo">Existencia mínima</label>
                        <div class="input-group">
                          <span class="input-group-addon">
                            <i class="fa fa-warning"></i>
                          </span>
                          <input type="number" id="minStock" name="minStock" placeholder="0" min="0" step="1" class="form-control" value="<?php echo $product['minStock']; ?>">
                        </div>
                      </div>
                    </div>
                  </div>
                  </div>
              </div>
              <!-- /.form-group -->
              <!-- /.col -->
              <div class="col-md-6">
                <div class="box-body">
                  <div class="form-group pull-right">
                    <label for="imagen_actual">Imagen actual:</label>
                    <br>
                    <img src="img/products/<?php echo $product['picture']; ?>" width="100" onerror="this.src='img/products/notfound.jpg';">
                  </div>
                  <br>
                  <div class="form-group">
                    <label for="picture">Imagen</label>
                    <input type="file" id="picture" name="file">
                    <p class="help-block">Ingrese la imagen del producto aquí.</p>
                  </div>
                  <div class="form-group">
                      <label for="descripcion">Descripción</label>
                      <textarea class="form-control" rows="3" id="description" name="description" placeholder="Escriba la descripción del producto... "><?php echo $product['description']; ?></textarea>
                    </div>
                    <br>
                <div class="panel box box-primary">
                  <div class="box-header with-border">
                    <h4 class="box-title">Precios de venta</h4>
                  </div>
                  <div class="box-body">
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <span class="text-danger text-uppercase">*</span>
                          <label for="costo">Público</label>
                          <div class="input-group">
                            <span class="input-group-addon">
                              <i>Q.</i>
                            </span>
                            <input type="number" id="public" name="public" placeholder="0.00" min="0.00" step="0.01" class="form-control" value="<?php echo $product['public']; ?>">
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <span class="text-danger text-uppercase">*</span>
                          <label for="costo">Farmacia</label>
                          <div class="input-group">
                            <span class="input-group-addon">
                              <i>Q.</i>
                            </span>
                            <input type="number" id="pharma" name="pharma" placeholder="0.00" min="0.00" step="0.01" class="form-control" value="<?php echo $product['pharma']; ?>">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <span class="text-danger text-uppercase">*</span>
                          <label for="costo">Negocio</label>
                          <div class="input-group">
                            <span class="input-group-addon">
                              <i>Q.</i>
                            </span>
                            <input type="number" id="business" name="business" placeholder="0.00" min="0.00" step="0.01" class="form-control" value="<?php echo $product['business']; ?>">
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <span class="text-danger text-uppercase">*</span>
                          <label for="costo">Bono</label>
                          <div class="input-group">
                            <span class="input-group-addon">
                              <i>Q.</i>
                            </span>
                            <input type="number" id="bonus" name="bonus" placeholder="0.00" min="0.00" step="0.01" class="form-control" value="<?php echo $product['bonus']; ?>">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                  <input type="hidden" name="producto" value="actualizar">
                  <input type="hidden" name="id_producto" value="<?php echo $id; ?>">
                  <button type="submit" class="btn btn-primary" id="crear-producto">
                    <i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
                  <span class="text-warning"> Debe llenar los campos obligatorios *</span>
                </div>
              </div>
              </form>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.box-body -->
      <!-- /.box -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php
include_once 'templates/footer.php';
?>