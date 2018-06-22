<footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2018 <a href="#">Applitech Solutions</a>.</strong> All rights
    reserved.
</footer>


</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="js/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="js/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="js/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="js/demo.js"></script>
<script src="js/sweetalert2.min.js"></script>
<script src="js/ajax/user-ajax.js"></script>
<script src="js/ajax/login.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>


<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()

    $('#registros').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
      'language'    : {
        paginate: {
          next:     'Siguiente',
          previous: 'Anterior',
          first:    'Primero',
          last:     'Último'
        },
        info: 'Mostrando _START_ a _END_ de _TOTAL_ registros',
        empyTable:  'No hay registros',
        infoEmpty:  '0 registros',
        lengthChange: 'Mostrar ',
        infoFiltered: "(Filtrado de _MAX_ total de registros)",
        lengthMenu: "Mostrar _MENU_ registros",
        loadingRecords: "Cargando...",
        processing: "Procesando...",
        search: "Buscar:",
        zeroRecords: "Sin resultados encontrados"
      }
    });
  })
</script>
</body>
</html>
