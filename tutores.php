<?php
  session_start();
  //INlcuir la configuracion de base de datos
  include("php/config.php");
  //Incluir la clase usuario
  include("php/class_usuario.php");
  //Ver si tenemos session iniciada
  if(!isset($_SESSION["user"])){
    //Mandar al usuario a la pagina de login
    header("Location: login.php");
    die();
  }
  //Conseguir el usuario de la session
  $myUser=unserialize($_SESSION["user"]);
  //Declaracion de las variables para el menu
  $opcionesAdministrador='
    <li class="menu-header">Administradores </li>
    <!-- .menu-item -->
    <li class="menu-item has-active">
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
    <title> Tutores | Patrones Hermosos </title>
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
                <li class="menu-item">
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
          <div class="tab-content pt-4 m-4" id="clientDetailsTabs">
                  <!-- .tab-pane -->
                  <div class="tab-pane fade" id="client-billing-contact" role="tabpanel" aria-labelledby="client-billing-contact-tab">
                    <!-- .card -->
                    <section class="card">
                      <!-- .card-body -->
                      <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                          <h2 class="card-title"> Billing Address </h2><button type="button" class="btn btn-link" data-toggle="modal" data-target="#clientBillingEditModal">Edit</button>
                        </div>
                        <address> 280 Suzanne Throughway, Breannabury<br> San Francisco, 45801<br> United States </address>
                      </div><!-- /.card-body -->
                    </section><!-- /.card -->
                    <!-- .card -->
                    <section class="card mt-4">
                      <!-- .card-body -->
                      <div class="card-body">
                        <h2 class="card-title"> Contacts </h2><!-- .table-responsive -->
                        <div class="table-responsive">
                          <table class="table table-hover" style="min-width: 678px">
                            <thead>
                              <tr>
                                <th> Name </th>
                                <th> Email </th>
                                <th> Phone </th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td class="align-middle"> Alexane Collins </td>
                                <td class="align-middle"> fhauck@gmail.com </td>
                                <td class="align-middle"> (062) 109-9222 </td>
                                <td class="align-middle text-right">
                                  <button type="button" class="btn btn-sm btn-icon btn-secondary" data-toggle="modal" data-target="#clientContactEditModal"><i class="fa fa-pencil-alt"></i> <span class="sr-only">Edit</span></button> <button type="button" class="btn btn-sm btn-icon btn-secondary"><i class="far fa-trash-alt"></i> <span class="sr-only">Remove</span></button>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div><!-- /.table-responsive -->
                      </div><!-- /.card-body -->
                      <!-- .card-footer -->
                      <div class="card-footer">
                        <a href="#clientContactNewModal" class="card-footer-item" data-toggle="modal"><i class="fa fa-plus-circle mr-1"></i> Add contact</a>
                      </div><!-- /.card-footer -->
                    </section><!-- /.card -->
                  </div><!-- /.tab-pane -->
                  <!-- .tab-pane -->
                  <div class="tab-pane fade" id="client-tasks" role="tabpanel" aria-labelledby="client-tasks-tab">
                    <!-- .card -->
                    <section class="card">
                      <!-- .card-body -->
                      <div class="card-body">
                        <div class="d-flex justify-content-between">
                          <h3 class="card-title"> To do </h3>
                          <div class="card-title-control">
                            <div class="dropdown">
                              <button type="button" class="btn btn-icon btn-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></button>
                              <div class="dropdown-arrow"></div>
                              <div class="dropdown-menu dropdown-menu-right">
                                <h6 class="dropdown-header"> Sort by </h6><label class="custom-control custom-radio stop-propagation"><input type="radio" class="custom-control-input" name="todoSorting" value="0" checked=""> <span class="custom-control-label">My order</span></label> <label class="custom-control custom-radio stop-propagation"><input type="radio" class="custom-control-input" name="todoSorting" value="1"> <span class="custom-control-label">Due date</span></label>
                                <div class="dropdown-divider"></div><button type="button" class="dropdown-item">Rename list</button> <button type="button" class="dropdown-item">Delete completed todos</button>
                              </div>
                            </div>
                          </div>
                      </div><!-- /.card-body -->
                      <!-- .card-footer -->
                      <div class="card-footer">
                        <a href="#!" class="card-footer-item"><i class="fa fa-plus-circle mr-1"></i> Add todo</a>
                      </div><!-- /.card-footer -->
                    </section><!-- /.card -->
                  </div><!-- /.tab-pane -->
                  <!-- .tab-pane -->
                  <div class="tab-pane fade active show" id="client-projects" role="tabpanel" aria-labelledby="client-projects-tab">
                    <!-- .card -->
                    <section class="card">
                      <!-- .card-header -->
                      <header class="card-header d-flex">
                      </header><!-- /.card-header -->
                      <!-- .table-responsive -->
                      <div class="table-responsive">
                        <!-- .table -->
                        <table class="table">
                          <!-- thead -->
                          <thead>
                            <tr>
                              <th style="min-width:260px"> Tutor </th>
                              <th> Email </th>
                              <th> Telefono </th>
                              <th> Status </th>
                              <th></th>
                            </tr>
                          </thead><!-- /thead -->
                          <!-- tbody -->
                          <tbody>
                            <?php
                                //Conseguir la lista de tutores
                                $arrayTutores=Usuario::getUsersFilteredByRango("Tutor");
                                //Ciclo for para despelgar todos los tutores
                                for($i=0; $i < sizeof($arrayTutores) ; $i++){
                                    //Despelgar el dato
                                    echo '
                                        <!-- tr -->
                                        <tr>
                                        <td class="align-middle text-truncate">
                                            <a href="#!" class="tile bg-pink text-white mr-2"'.($arrayTutores[$i]->getUserFullName())[1].'</a> <a href="#!">'.$arrayTutores[$i]->getUserFullName().'</a>
                                        </td>
                                        <td class="align-middle"> '.$arrayTutores[$i]->getMail().' </td>
                                        <td class="align-middle"> '.$arrayTutores[$i]->getTelefono().' </td>
                                        <td class="align-middle">
                                            <span class="badge badge-warning">'.$arrayTutores[$i]->getEstado().'</span>
                                        </td>
                                        <td class="align-middle text-right">
                                            <div class="dropdown">
                                            <button type="button" class="btn btn-sm btn-icon btn-secondary" data-toggle="dropdown" aria-expanded="false" aria-haspopup="true"><i class="fa fa-ellipsis-h"></i> <span class="sr-only">Actions</span></button>
                                            <div class="dropdown-arrow"></div>
                                            <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: top, left; top: 29px; left: 47px;">
                                                <a href="php/aceptar.php?username='.$arrayTutores[$i]->getUsername().'"><button class="dropdown-item" type="button" >Aceptar</button> </a>
                                                <a href="php/rechazar.php?username='.$arrayTutores[$i]->getUsername().'"><button class="dropdown-item" type="button">Rechazar</button> </a>
                                            </div>
                                            </div>
                                        </td>
                                        </tr><!-- /tr -->
                                    ';
                                }
                            ?>
                          </tbody><!-- /tbody -->
                        </table><!-- /.table -->
                      </div><!-- /.table-responsive -->
                    </section><!-- /.card -->
                  </div><!-- /.tab-pane -->
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
