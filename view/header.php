<?php
if (strlen(session_id()) < 1) 
  session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistema de Noticias</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/font-awesome.css">
    <link rel="stylesheet" href="../assets/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../assets/css/_all-skins.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="shortcut icon" href="../assets/img/favicon.ico">

    <link rel="stylesheet" type="text/css" href="../assets/datatables/jquery.dataTables.min.css">    
    <link href="../assets/datatables/buttons.dataTables.min.css" rel="stylesheet"/>
    <link href="../assets/datatables/responsive.dataTables.min.css" rel="stylesheet"/>

    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap-select.min.css">

  </head>
  <body class="hold-transition skin-black sidebar-mini">
    <div class="wrapper">
      <header class="main-header">
        <a href="index2.html" class="logo">
          <span class="logo-mini"><b>SN</b></span>
          <span class="logo-lg"><b>Sistema de Noticias</b></span>
        </a>
        <nav class="navbar navbar-static-top" role="navigation">
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="../assets/img/user.jpg" class="user-image" alt="<?php echo $_SESSION['nombre']; ?>">
                  <span class="hidden-xs"><?php echo $_SESSION['nombre']; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <li class="user-header">
                    <img src="../assets/img/user.jpg" class="img-circle" alt="User Image">
                    <p>
                      <?=$_SESSION['perfil']?>
                    </p>
                  </li>
                  <li class="user-footer">                    
                    <div class="pull-right">
                      <a href="../controller/usuario.php?op=salir" class="btn btn-default btn-flat">Cerrar</a>
                    </div>
                  </li>
                </ul>
              </li>              
            </ul>
          </div>
        </nav>
      </header>
      <aside class="main-sidebar">
        <section class="sidebar"> 
          <ul class="sidebar-menu">
            <li class="header"></li>
            <?php
            if($_SESSION['perfil'] == "Administrador"){?>
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-users"></i> <span>Usuarios</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="usuario.php"><i class="fa fa-circle-o"></i> Usuarios</a></li>
                  <li><a href="perfil.php"><i class="fa fa-circle-o"></i> Perfil</a></li>
                </ul>
              </li>  
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-files-o"></i>
                  <span>Noticias</span>
                   <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="categoria.php"><i class="fa fa-circle-o"></i> Categoría</a></li>
                  <li><a href="noticia.php"><i class="fa fa-circle-o"></i> Gestor de noticias</a></li>
                </ul>
              </li>
            <?php 
            }else{?>
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-files-o"></i>
                  <span>Noticias</span>
                   <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="categoria.php"><i class="fa fa-circle-o"></i> Categoría</a></li>
                  <li><a href="noticia.php"><i class="fa fa-circle-o"></i> Gestor de noticias</a></li>
                </ul>
              </li>
            <?php } ?>                   
          </ul>
        </section>
      </aside>
