<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <?php 
            if ($_SESSION['rol'] == 1) {?>
              <a href="dashboard.php" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>S</b>Ph</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>Schlenker</b>Pharma</span>
              </a>
        <?php
        }else {?>
           <a href="index.php" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>S</b>Ph</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>Schlenker</b>Pharma</span>
            </a>
      <?php
        }
        ?>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="img/user.png" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $_SESSION['usuario']?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="img/user.png" class="img-circle" alt="User Image">
                <p>
                  <?php if ($_SESSION['rol'] == 1) {
                    echo $_SESSION['nombre']. " - Administrador";
                  }else if ($_SESSION['rol'] == 2) {
                    echo $_SESSION['nombre']. " - Consultor";
                  }?>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="editLogued.php?id=<?php echo $_SESSION['idusuario'] ?>" class="w3-btn w3-green w3-round-medium">Editar</a>
                </div>
                <div class="pull-right">
                  <a href="login.php?cerrar_sesion=true" class="w3-btn w3-red w3-round-medium">Cerrar Sesión</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->