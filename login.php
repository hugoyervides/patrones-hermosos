<?php
    //Iniciamos la session
    session_start();
    //Incluir archivo de configuracion MySQL
    include("php/config.php");
    //Incluir clase usuario
    include("php/class_usuario.php");
    //Ver si tenemos session iniciada
    if(isset($_SESSION["user"])){
        //Mandar al usuario a la pagina de login
        header("Location: profile.php");
        die();
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"><!-- End Required meta tags -->
    <!-- Begin SEO tag -->
    <title> Iniciar Sesion | Patrones Hermosos </title>
    <meta property="og:title" content="Sign In">
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
        "headline": "Sign In",
        "@context": "http://schema.org"
      }
    </script><!-- End SEO tag -->
    <!-- Favicons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/apple-touch-icon.png">
    <link rel="shortcut icon" href="assets/favicon.ico">
    <meta name="theme-color" content="#3063A0"><!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,500,600" rel="stylesheet"><!-- End Google font -->
    <!-- BEGIN PLUGINS STYLES -->
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
    <!--[if lt IE 10]>
    <div class="page-message" role="alert">You are using an <strong>outdated</strong> browser. Please <a class="alert-link" href="http://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</div>
    <![endif]-->
    <!-- .auth -->
    <main class="auth auth-floated">
      <!-- form -->
      <form class="auth-form" action="login.php" method="post">
        <div class="mb-4">
          <div class="mb-3">
            <img class="rounded" src="assets/apple-touch-icon.png" alt="" height="72">
          </div>
          <h1 class="h3"> Sign In </h1>
        </div>
        <?php
            //Ver si tenemos parametros POST de username y password
            if(isset($_POST["username"])&&isset($_POST["password"])){
                //conseguir datos del usuario
                $newUser= new Usuario(null,null,null,null,null,null,null,null,null,null);
                if($newUser->fetchUserInfoFromDB($_POST["username"])){
                    //ver si los datos son correctos
                    if($newUser->verifyPassword($_POST["password"])){
                        //Mandar al usuario a la pagina de login
                        $_SESSION["user"]=serialize($newUser);
                        header("Location: profile.php");
                        die();
                    }
                    else{
                        echo '<div class="alert alert-danger" role="alert">Contrasenia incorrecta!</div>';
                    }
                }
                else{
                    //Desplegar mensaje de error
                    echo '<div class="alert alert-danger" role="alert">Usuario no encontrado!</div>';
                }
            }
        ?>
        <p class="text-left mb-4"> ¿Eres un usuario nuevo? <a href="register.php">Crear cuenta</a>
        </p><!-- .form-group -->
        <div class="form-group mb-4">
          <label class="d-block text-left" for="inputUser">Usuario</label> <input type="text" id="inputUser" class="form-control form-control-lg" required="" autofocus="" name="username">
        </div><!-- /.form-group -->
        <!-- .form-group -->
        <div class="form-group mb-4">
          <label class="d-block text-left" for="inputPassword">Contraseña</label> <input type="password" id="inputPassword" class="form-control form-control-lg" required="" name="password">
        </div><!-- /.form-group -->
        <!-- .form-group -->
        <div class="form-group mb-4">
          <button class="btn btn-lg btn-primary btn-block" type="submit">Sign In</button>
        </div><!-- /.form-group -->
        <!-- .form-group -->
        <div class="form-group text-center">
          <div class="custom-control custom-control-inline custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="remember-me"> <label class="custom-control-label" for="remember-me">Manten la sesión</label>
          </div>
        </div><!-- /.form-group -->
        <!-- recovery links -->
        <p class="py-2">
          <a href="404.html" class="link">¿Olvidaste tu usuario?</a> <span class="mx-2">·</span> <a href="404.html" class="link">¿Olvidaste tu contraseña?</a>
        </p><!-- /recovery links -->
        <!-- copyright -->
        <p class="mb-0 px-3 text-muted text-center"> © 2019 Todos los derechos reservados.
        </p>
      </form><!-- /.auth-form -->
      <!-- .auth-announcement -->
      <section id="announcement" class="auth-announcement" style="background-image: url(assets/images/illustration/img-1.png);">
        <div class="announcement-body">
          <h2 class="announcement-title"> Prepárate para una experiencia inigualable. </h2><a href="https://www.patroneshermososmexico.org" class="btn btn-warning"><i class="fa fa-fw fa-angle-right"></i> Descúbrelo!</a>
        </div>
      </section><!-- /.auth-announcement -->
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
        particlesJS.load('announcement', 'assets/javascript/pages/particles.json');
      })
    </script> <!-- END PLUGINS JS -->
    <!-- BEGIN THEME JS -->
    <script src="assets/javascript/theme.min.js"></script> <!-- END THEME JS -->
  </body>
</html>
