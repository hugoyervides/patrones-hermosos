<?php
    //Incluir clase usuario
    include("php/config.php");
    include("php/class_usuario.php");
    //Ver si tenemos datos POST para crear la cuenta
    $datosPOST=array("username","nombre","apellido","mail","telefono","password","telefonoPadres","direccion","fechaNacimiento","rango");
    $registrar=true;
    $usuarioRegistradoConExito=false;
    //iterar por los datos post para ver que tengamos todos
    for($i=0; $i<sizeof($datosPOST); $i++){
        if(!isset($_POST[$datosPOST[$i]])){
            $registrar=false;}
    }
    //COntinuar con el registro si tenemos datos POST
    if($registrar){
        //Creamos un nuevo objeto de la clase Usuario para mandarla a la base de datos
        $newUser = new Usuario($_POST["username"],$_POST["nombre"],$_POST["apellido"],$_POST["mail"],$_POST["telefono"],$_POST["password"],$_POST["telefonoPadres"],$_POST["direccion"],$_POST["fechaNacimiento"],$_POST["rango"]);
        //mandamos los datos a la base de datos para registrarlo
        $newUser->writeUserToDb();
        $usuarioRegistradoConExito=true;
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"><!-- End Required meta tags -->
    <!-- Begin SEO tag -->
    <title> Sign Up | Patrones Hermosos </title>
    <meta property="og:title" content="Sign Up">
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
        "headline": "Sign Up",
        "@context": "http://schema.org"
      }
    </script><!-- End SEO tag -->
    <!-- Favicons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/apple-touch-icon.png">
    <link rel="shortcut icon" href="assets/favicon.ico">
    <meta name="theme-color" content="#3063A0"><!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,500,600" rel="stylesheet"><!-- End Google font -->
    <!-- BEGIN PLUGINS STYLES -->
    <link rel="stylesheet" href="assets/vendor/fontawesome/css/all.css">
    <link rel="stylesheet" href="assets/vendor/flatpickr/flatpickr.min.css">
    <link rel="stylesheet" href="assets/vendor/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
    <link rel="stylesheet" href="assets/vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css">
    <link rel="stylesheet" href="assets/vendor/nouislider/nouislider.min.css"><!-- END PLUGINS STYLES -->
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
    <!--[if lt IE 10]>
    <div class="page-message" role="alert">You are using an <strong>outdated</strong> browser. Please <a class="alert-link" href="http://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</div>
    <![endif]-->
    <!-- .auth -->
    <main class="auth">
      <header id="auth-header" class="auth-header" style="background-image: url(assets/images/illustration/img-1.png);">
        <h1>
          <img src="assets/images/brand-inverse.png" alt="" height="72"> <span class="sr-only">Sign Up</span>
        </h1>
        <p> ¿Ya tienes una cuenta? <a href="login.php">Sign In</a>
        </p>
      </header><!-- form -->
      <form class="auth-form" action="register.php" method="post">
        <?php
            //Ver si se registro con exito y desplegar el mensaje
            if($usuarioRegistradoConExito){
                echo '<div class="alert alert-success" role="alert">Usuario registrado con exito!</div>';
            }
        ?>
        <!-- .form-group -->
        <div class="form-group">
          <div class="form-label-group">
            <input type="text" id="inputUsername" class="form-control" placeholder="Username" required="" autofocus="" name="username"> <label for="inputUsername">Username</label>
          </div>
        </div><!-- /.form-group -->
        <!-- .form-group -->
        <div class="form-group">
          <div class="form-label-group">
            <input type="email" id="inputEmail" class="form-control" placeholder="Email" required="" autofocus="" name="mail"> <label for="inputEmail">Email</label>
          </div>
        </div><!-- /.form-group -->
        <!-- .form-group -->
        <div class="form-group">
          <div class="form-label-group">
            <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="" name="password"> <label for="inputPassword">Contraseña</label>
          </div>
        </div><!-- /.form-group -->
        <!-- .form-group -->
        <div class="form-group">
          <div class="form-label-group">
            <input type="text" id="inputNombre" class="form-control" placeholder="Nombre" required="" name="nombre"> <label for="inputNombre">Nombre</label>
          </div>
        </div><!-- /.form-group -->
        <!-- .form-group -->
        <div class="form-group">
          <div class="form-label-group">
            <input type="text" id="inputApellido" class="form-control" placeholder="Apellido" required="" name="apellido"> <label for="inputApellido">Apellido</label>
          </div>
        </div><!-- /.form-group -->
        <!-- .form-group -->
        <div class="form-group">
          <div class="form-label-group">
            <input type="text" id="inputTelefono" class="form-control" placeholder="Telefono" required="" name="telefono"> <label for="inputTelefono">Telefono</label>
          </div>
        </div><!-- /.form-group -->
        <!-- .form-group -->
        <div class="form-group">
          <div class="form-label-group">
            <input type="text" id="inputDireccion" class="form-control" placeholder="Direccion" required="" name="direccion"> <label for="inputDireccion">Direccion</label>
          </div>
        </div><!-- /.form-group -->
        <!-- .form-group -->
        <div class="form-group">
          <div class="form-label-group">
            <input type="text" id="inputTelefonoPadres" class="form-control" placeholder="Telfono Padres" required="" name="telefonoPadres"> <label for="inputTelefonoPadres">Telefono Padre o Tutor</label>
          </div>
        </div><!-- /.form-group -->
        <!-- .form-group -->
        <div class="form-group">
            <label class="control-label" for="fechaNacimiento">Fecha Nacimiento</label> <input id="fechaNacimiento" type="text" class="form-control" data-toggle="flatpickr" name="fechaNacimiento">
        </div><!-- /.form-group -->
        <!-- .form-group -->
        <div class="form-group">
                <label for="sel1"></label><select class="custom-select" id="sel1" required="" name="rango">
                        <option> Tipo usuario ... </option>
                        <option value="Alumno" > Estudiante </option>
                        <option value="Tutor" > Tutor </option>
                </select>
        </div><!-- /.form-group -->
        <!-- .form-group -->
        <div class="form-group">
          <button class="btn btn-lg btn-primary btn-block" type="submit">Sign Up</button>
        </div><!-- /.form-group -->
        <!-- .form-group -->
        <!-- <div class="form-group text-center">
          <div class="custom-control custom-control-inline custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="newsletter"> <label class="custom-control-label" for="newsletter">Sign me up for the newsletter</label>
          </div>
        </div> -->
        <!-- recovery links -->
        <p class="text-center text-muted mb-0"> Al crear una cuenta aceptas los <a href="#!">Terminos de Servicio</a> y las <a href="#!">Políticas de Privacidad</a>. </p><!-- /recovery links -->
      </form><!-- /.auth-form -->
      <!-- copyright -->
      <footer class="auth-footer"> © 2019 All Rights Reserved. </footer>
    </main><!-- /.auth -->
    <!-- BEGIN BASE JS -->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/popper.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script> <!-- END BASE JS -->
    <!-- BEGIN PLUGINS JS -->
    <script src="assets/vendor/particles.js/particles.min.js"></script>
    <script>
      /**
       * Keep in mind that your scripts may not always be executed after the theme is completely ready,
       * you might need to observe the `theme:load` event to make sure your scripts are executed after the theme is ready.
       */
      $(document).on('theme:init', () =>
      {
        /* particlesJS.load(@dom-id, @path-json, @callback (optional)); */
        particlesJS.load('auth-header', 'assets/javascript/pages/particles.json');
      })
    </script> <!-- END PLUGINS JS -->
    <!-- BEGIN THEME JS -->
    <script src="assets/vendor/flatpickr/flatpickr.min.js"></script>
    <script src="assets/javascript/theme.min.js"></script> <!-- END THEME JS -->
  </body>
</html>
