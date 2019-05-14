<?php
  session_start();
  //Incluir la clase usuario
  //Incluir archivo de configuracion MySQL
  include("php/config.php");
  include("php/class_usuario.php");
  //Declaracion de variables
  $datosPost=array("nombre","apellido","email","direccion","telefono","telefonoPadres");
  $continue=true;
  //Ver si tenemos session iniciada
  if(!isset($_SESSION["user"])){
    //Mandar al usuario a la pagina de login
    header("Location: login.php");
    die();
  }
  //Conseguir el usuario de la session
  $myUser=unserialize($_SESSION["user"]);
  //Ver si tenemos datos post para cambiar la informacion de usuario
  for($i=0; $i<sizeof($datosPost) ; $i++){
    //ver si existe el dato POST
    if(!isset($_POST[$datosPost[$i]])){
      $continue=false;
    }
  }
  //ver si tenemos los datos post para proceder a cambiar la informacion de usuario
  if($continue){
    //actualizar los datos de nuestro usuario
    $myUser->setNombre($_POST["nombre"]);
    $myUser->setApellido($_POST["apellido"]);
    $myUser->setMail($_POST["email"]);
    $myUser->setDireccion($_POST["direccion"]);
    $myUser->setTelefono($_POST["telefono"]);
    $myUser->getTelefonoPadres($_POST["telefonoPadres"]);
    //Actualizar el usuario en la base de datos
    $myUser->updateUserDatatoDB();
    //Actualizamos el usuario de la session
    $_SESSION["user"]=serialize($myUser);
  }
  //Declaracion de las variables para el menu
  $opcionesAdministrador='
    <li class="menu-header">Administradores </li>
    <!-- .menu-item -->
    <li class="menu-item">
      <a href="tutores.php" class="menu-link"><span class="menu-icon fas fa-chalkboard-teacher"></span> <span class="menu-text">Tutores</span></a> 
    </li><!-- /.menu-item -->
    ';
  $opcionesAlumnos='                
    <li class="menu-header">Alumnos </li>
    <!-- .menu-item -->
    <li class="menu-item">
      <a href="avisos.php" class="menu-link"><span class="menu-icon fas fa-exclamation-triangle"></span> <span class="menu-text">Avisos</span></a> 
    </li><!-- /.menu-item -->
    <!-- .menu-item -->
    <li class="menu-item">
      <a href="sedes.php" class="menu-link"><span class="menu-icon fas fa-chalkboard-teacher"></span> <span class="menu-text">Sedes</span></a> 
    </li><!-- /.menu-item -->
    <!-- .menu-item -->
    <li class="menu-item">
      <a href="entregables.php" class="menu-link"><span class="menu-icon fas fa-file-upload"></span> <span class="menu-text">Entregables</span></a> 
    </li><!-- /.menu-item --> 
  ';
  $opcionesTutores='
    <li class="menu-header">Tutores </li>
    <!-- .menu-item -->
    <li class="menu-item">
      <a href="misede.php" class="menu-link"><span class="menu-icon fas fa-chalkboard-teacher"></span> <span class="menu-text">Mi Sede</span></a> 
    </li><!-- /.menu-item -->
  ';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags  -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"><!-- End Required meta tags -->
    <!-- Begin SEO tag -->
    <title> Profile | Patrones Hermosos </title>
    <meta property="og:title" content="Profile Settings">
    <meta name="author" content="Beni Arisandi">
    <meta property="og:locale" content="en_US">
    <meta name="description" content="Responsive admin theme build on top of Bootstrap 4">
    <meta property="og:description" content="Responsive admin theme build on top of Bootstrap 4">
    <link rel="canonical" href="http://uselooper.com">
    <meta property="og:url" content="http://uselooper.com">
    <meta property="og:site_name" content="Looper - Bootstrap 4 Admin Theme">
    <script type="application/ld+json">
      {
        "name": "Looper - Bootstrap 4 Admin Theme",
        "description": "Responsive admin theme build on top of Bootstrap 4",
        "author":
        {
          "@type": "Person",
          "name": "Beni Arisandi"
        },
        "@type": "WebSite",
        "url": "",
        "headline": "Profile Settings",
        "@context": "http://schema.org"
      }
    </script><!-- End SEO tag -->
    <!-- FAVICONS -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/apple-touch-icon.png">
    <link rel="shortcut icon" href="assets/favicon.ico">
    <meta name="theme-color" content="#3063A0"><!-- End FAVICONS -->
    <!-- GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,500,600" rel="stylesheet"><!-- End GOOGLE FONT -->
    <!-- BEGIN PLUGINS STYLES -->
    <link rel="stylesheet" href="assets/vendor/open-iconic/css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="assets/vendor/fontawesome/css/all.css"><!-- END PLUGINS STYLES -->
    <!-- BEGIN THEME STYLES -->
    <link rel="stylesheet" href="assets/stylesheets/theme.min.css" data-skin="default">
    <link rel="stylesheet" href="assets/stylesheets/theme-dark.min.css" data-skin="dark">
    <link rel="stylesheet" href="assets/stylesheets/custom.css"><!-- Disable unused skin immediately -->
    <script> var skin = localStorage.getItem('skin') || 'default';
    var unusedLink = document.querySelector('link[data-skin]:not([data-skin="'+ skin +'"])');

    unusedLink.setAttribute('rel', '');
    unusedLink.setAttribute('disabled', true);
    </script><!-- END THEME STYLES -->
  </head>
  <body>
    <!-- .app -->
    <div class="app">
      <!--[if lt IE 10]>
      <div class="page-message" role="alert">You are using an <strong>outdated</strong> browser. Please <a class="alert-link" href="http://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</div>
      <![endif]-->
      <!-- .app-header -->
      <header class="app-header app-header-dark">
        <!-- .top-bar -->
        <div class="top-bar">
          <!-- .top-bar-brand -->
          <div class="top-bar-brand">
            <a href="index.html"><img src="assets/images/brand-inverse.png" alt="" style="height: 32px;width: auto;"></a>
          </div><!-- /.top-bar-brand -->
          <!-- .top-bar-list -->
          <div class="top-bar-list">
            <!-- .top-bar-item -->
            <div class="top-bar-item px-2 d-md-none d-lg-none d-xl-none">
              <!-- toggle menu -->
              <button class="hamburger hamburger-squeeze" type="button" data-toggle="aside" aria-label="toggle menu"><span class="hamburger-box"><span class="hamburger-inner"></span></span></button> <!-- /toggle menu -->
            </div><!-- /.top-bar-item -->
            <!-- .top-bar-item -->
            <div class="top-bar-item top-bar-item-full">
            </div><!-- /.top-bar-item -->
            <!-- .top-bar-item -->
            <div class="top-bar-item top-bar-item-right px-0 d-none d-sm-flex">
              <!-- .nav -->
              <ul class="header-nav nav">
              </ul><!-- /.nav -->
              <!-- .btn-account -->
              <div class="dropdown">
                <button class="btn-account d-none d-md-flex" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="user-avatar user-avatar-md"><img src="assets/images/avatars/unknown-profile.jpg" alt=""></span> <span class="account-summary pr-lg-4 d-none d-lg-block"><span class="account-name"><?php echo $myUser->getUserFullName() ?></span> <span class="account-description"><?php echo $myUser->getRangoUsuario() ?></span></span></button>
                <div class="dropdown-arrow dropdown-arrow-left"></div><!-- .dropdown-menu -->
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="profile.php"><span class="dropdown-icon oi oi-person"></span> Profile</a> <a class="dropdown-item" href="logout.php"><span class="dropdown-icon oi oi-account-logout"></span> Logout</a>
                </div><!-- /.dropdown-menu -->
              </div><!-- /.btn-account -->
            </div><!-- /.top-bar-item -->
          </div><!-- /.top-bar-list -->
        </div><!-- /.top-bar -->
      </header><!-- /.app-header -->
      <!-- .app-aside -->
      <aside class="app-aside app-aside-expand-md app-aside-light">
        <!-- .aside-content -->
        <div class="aside-content">
          <!-- .aside-header -->
          <header class="aside-header d-block d-md-none">
            <!-- .btn-account -->
            <button class="btn-account" type="button" data-toggle="collapse" data-target="#dropdown-aside"><span class="user-avatar user-avatar-lg"><img src="assets/images/avatars/unknown-profile.jpg" alt=""></span> <span class="account-icon"><span class="fa fa-caret-down fa-lg"></span></span> <span class="account-summary"><span class="account-name"><?php echo $myUser->getUserFullName() ?></span> <span class="account-description"><?php echo $myUser->getRangoUsuario() ?></span></span></button> <!-- /.btn-account -->
            <!-- .dropdown-aside -->
            <div id="dropdown-aside" class="dropdown-aside collapse">
              <!-- dropdown-items -->
              <div class="pb-3">
                <a class="dropdown-item" href="user-profile.html"><span class="dropdown-icon oi oi-person"></span> Profile</a> <a class="dropdown-item" href="auth-signin-v1.html"><span class="dropdown-icon oi oi-account-logout"></span> Logout</a>
              </div><!-- /dropdown-items -->
            </div><!-- /.dropdown-aside -->
          </header><!-- /.aside-header -->
          <!-- .aside-menu -->
          <section class="aside-menu overflow-hidden">
            <!-- .stacked-menu -->
            <nav id="stacked-menu" class="stacked-menu">
              <!-- .menu -->
              <ul class="menu">
                <!-- .menu-item -->
                <li class="menu-item has-active">
                  <a href="profile.php" class="menu-link"><span class="menu-icon oi oi-person"></span> <span class="menu-text">Mi Cuenta</span></a> 
                </li><!-- /.menu-item -->
                <?php
                  //Si es administrador
                  if($myUser->getRangoUsuario()=="Administrador"){
                    echo $opcionesAdministrador;
                  }
                  elseif($myUser->getRangoUsuario()=="Alumno"){
                    echo $opcionesAlumnos;
                  }
                  elseif($myUser->getRangoUsuario()=="Tutor"){
                    echo $opcionesTutores;
                  }
                ?>
              </ul><!-- /.menu -->
            </nav><!-- /.stacked-menu -->
          </section><!-- /.aside-menu -->
          <!-- Skin changer -->
          <div class="aside-footer border-top p-3">
            <button class="btn btn-light btn-block" data-toggle="skin">Night mode <i class="fas fa-moon ml-1"></i></button>
          </div><!-- /Skin changer -->
        </div><!-- /.aside-content -->
      </aside><!-- /.app-aside -->
      <!-- .app-main -->
      <main class="app-main">
        <!-- .wrapper -->
        <div class="wrapper">
          <!-- .page -->
          <div class="page">
            <header class="page-cover">
                <div class="text-center">
                  <a href="user-profile.html" class="user-avatar user-avatar-xl"><img src="assets/images/avatars/unknown-profile.jpg" alt=""></a>
                  <h2 class="h4 mt-2 mb-0"> <?php echo $myUser->getUserFullName() ?> </h2>
                  <p class="text-muted"> <?php echo $myUser->getRangoUsuario() ?> </p>
                  <?php echo $myUser->getSede()->getNombre(); ?>
                  <p> Configuracion de la cuenta </p>
              </header>
              <div class="col-lg-12 mt-3">
                    <!-- .card -->
                    <div class="card card-fluid">
                      <h6 class="card-header"> Cuenta </h6><!-- .card-body -->
                      <div class="card-body">
                        <!-- form -->
                        <form method="post" action="profile.php">
                          <!-- form row -->
                          <div class="form-row">
                            <!-- form column -->
                            <div class="col-md-6 mb-3">
                              <label for="nombre">Nombre</label> <input type="text" class="form-control" id="nombre" value="<?php echo $myUser->getNombre() ?>" required="" name="nombre">
                            </div><!-- /form column -->
                            <!-- form column -->
                            <div class="col-md-6 mb-3">
                              <label for="apellido">Apellido</label> <input type="text" class="form-control" id="apellido" value="<?php echo $myUser->getApellido() ?>" required="" name="apellido">
                            </div><!-- /form column -->
                          </div><!-- /form row -->
                          <!-- .form-group -->
                          <div class="form-group">
                            <label for="correo">Correo Electronico</label> <input type="email" class="form-control" id="correo" value="<?php echo $myUser->getMail() ?>" required="" name="email">
                          </div><!-- /.form-group -->
                          <!-- form row -->
                          <div class="form-row">
                            <!-- form column -->
                            <div class="col-md-6 mb-3">
                              <label for="telefono">Telefono Personal</label> <input type="text" class="form-control" id="telefono" value="<?php echo $myUser->getTelefono() ?>" required="" name="telefono"> 
                            </div><!-- /form column -->
                            <!-- form column -->
                            <div class="col-md-6 mb-3">
                              <label for="telefonoPadre">Telefono Padre o Tutor</label> <input type="text" class="form-control" id="telefonoPadre" value="<?php echo $myUser->getTelefonoPadres() ?>" required="" name="telefonoPadres">
                            </div><!-- /form column -->
                          </div><!-- /form row -->
                          <div class="form-group">
                            <label for="direccion">Direccion</label> <input type="text" class="form-control" id="direccion" value="<?php echo $myUser->getDireccion() ?>" required="" name="direccion">
                          </div><!-- /.form-group -->
                          <hr>
                          <!-- .form-actions -->
                          <div class="form-actions">
                            <!-- enable submit btn when user type their current password -->
                            <button type="submit" class="btn btn-primary">Actualizar Cuenta</button>
                          </div><!-- /.form-actions -->
                        </form><!-- /form -->
                      </div><!-- /.card-body -->
                    </div><!-- /.card -->
                  </div>
          </div><!-- /.page -->
        </div><!-- .app-footer -->
        <footer class="app-footer">
          <ul class="list-inline">
            <li class="list-inline-item">
              <a class="text-muted" href="404.html">Soporte</a>
            </li>
            <li class="list-inline-item">
              <a class="text-muted" href="404.html">Centro de Ayuda</a>
            </li>
            <li class="list-inline-item">
              <a class="text-muted" href="404.html">Privacidad</a>
            </li>
            <li class="list-inline-item">
              <a class="text-muted" href="404.html">Terminos de uso</a>
            </li>
          </ul>
          <div class="copyright"> Copyright Patrones Hermosos AC © 2019. Todos los derechos reservados. </div>
        </footer><!-- /.app-footer -->
        <!-- /.wrapper -->
      </main><!-- /.app-main -->
    </div><!-- /.app -->
    <!-- BEGIN BASE JS -->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/popper.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script> <!-- END BASE JS -->
    <!-- BEGIN PLUGINS JS -->
    <script src="assets/vendor/pace/pace.min.js"></script>
    <script src="assets/vendor/stacked-menu/stacked-menu.min.js"></script>
    <script src="assets/vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/vendor/blueimp-file-upload/js/vendor/jquery.ui.widget.js"></script>
    <script src="assets/vendor/blueimp-load-image/load-image.all.min.js"></script>
    <script src="assets/vendor/blueimp-canvas-to-blob/canvas-to-blob.min.js"></script>
    <script src="assets/vendor/blueimp-file-upload/js/jquery.iframe-transport.js"></script>
    <script src="assets/vendor/blueimp-file-upload/js/jquery.fileupload.js"></script>
    <script src="assets/vendor/blueimp-file-upload/js/jquery.fileupload-process.js"></script>
    <script src="assets/vendor/blueimp-file-upload/js/jquery.fileupload-image.js"></script>
    <script src="assets/vendor/blueimp-file-upload/js/jquery.fileupload-validate.js"></script> <!-- END PLUGINS JS -->
    <!-- BEGIN THEME JS -->
    <script src="assets/javascript/theme.min.js"></script> <!-- END THEME JS -->
    <!-- BEGIN PAGE LEVEL JS -->
    <script src="assets/javascript/pages/user-settings-demo.js"></script> <!-- END PAGE LEVEL JS -->
  </body>
</html>
