<!DOCTYPE html>
<html lang="es">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>Turienzo</title>
      <meta name="keywords" content="castropodame">
      <meta name="description" content="pagina web de castropodame">
      <meta name="author" content="Alejandro Mansilla Martínez">
      <!-- bootstrap css -->
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <!-- style css -->
      <link rel="stylesheet" href="css/style.css">
      <!-- Responsive-->
      <link rel="stylesheet" href="css/responsive.css">
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">

   </head>
<!-- body -->
<body class="main-layout">
      <!-- loader  -->
      <div class="loader_bg">
         <div class="loader"><img src="images/loading.gif" alt="#" /></div>
      </div>
      <!-- end loader --> 
      <!-- header -->
      <header>
         <!-- header inner -->
         <div class="header">
         <div class="container">
            <div class="row">
               <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                  <div class="full">
                     <div class="center-desk">
                        <div class="logo"> <a href="index.html"><img src="images/escudo1.jpeg" alt="logo"/></a> </div>
                     </div>
                  </div>
               </div>
               <div class="col-xl-7 col-lg-7 col-md-9 col-sm-9">
                  <div class="menu-area">
                     <div class="limit-box">
                        <nav class="main-menu">
                           <ul class="menu-area-main">
                              <li> <a href="index.html">Pagina Principal</a> </li>
                              <li> <a href="historia.html">Historia</a> </li>
                              <li class="active"> <a href="noticia.php">Noticias</a> </li>
                              <li> <a href="product.html">Galeria de Fotos</a> </li>
                              <li> <a href="login/index.php">Login</a> </li>
                           </ul>
                        </nav>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- end header inner --> 
      </header>
      <!-- end header -->
      <div class="brand_color">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage">
                        <h2>Noticias</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="product">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="title">
                     <center><span>Estas son las principales noticias de nuestro pueblo</span></center>
                  </div>
               </div>
            </div>
         </div>
      </div>
    </div>
	<div class="row">
		<div class="col-sm-12">
            <?php 
                session_start();
                if(isset($_SESSION['message'])){
                    ?>
                    <div class="alert alert-dismissible alert-success" style="margin-top:20px;">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <?php echo $_SESSION['message']; ?>
                    </div>
                    <?php

                    unset($_SESSION['message']);
                }
            ?>
			
	<body>
    <?php
    // incluye la conexión
    include_once('connection.php');

    $database = new Connection();
    $db = $database->open();
    try{	
        $sql = 'SELECT * FROM noticias';
        foreach ($db->query($sql) as $row) {
        ?>
    <!-- our noticies -->
      
      <div class="product-bg">
         <div class="product-bg-white">
            <div class="container">
               <div class="row">
                  <div class="col-md-12">
                     <div class="product-box">
                        <h3><?php echo $row['titulo']; ?></h3>
                        <p><?php echo $row['noticia']; ?></p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
       <?php
       
	   }
	}
	catch(PDOException $e){
		echo "Tenemos algunos problemas con la conexion: " . $e->getMessage();
	}
	//cerrar conexión
	$database->close();
    ?>
	</body>
	</div>
	</div>
</div>
<!--  footer -->
<footr>
         <div class="footer">
            <div class="container">
               <div class="row">
                  <div class="col-md-6 offset-md-3">
                     <ul class="sociel">
                         <li> <a href="#"><i class="fa fa-twitter"></i></a></li>
                         <li> <a href="#"><i class="fa fa-instagram"></i></a></li>
                     </ul>
                  </div>
            </div>
            <div class="row">
               <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                  <div class="contact">
                     <h3>Localizacion</h3>
                     <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5876.024429680311!2d-6.437265423034278!3d42.57626321669161!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd30b317605690f9%3A0x531a17d76504bf38!2s24316%20Turienzo%20Casta%C3%B1ero%2C%20Le%C3%B3n!5e0!3m2!1ses!2ses!4v1681464774467!5m2!1ses!2ses" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                     </div>
               </div>
               <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
               </div>
                  <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                  <div class="contact">
                     <h3>Links</h3>
                     <ul class="lik">
                        <li> <a href="historia.html">Sobre Nosotros</a></li>
                        <li> <a href="#">Terminos y Condiciones</a></li>
                        <li> <a href="#">Politica de Privacidad</a></li>
                        <li> <a href="mailto:alejandro.mansilla.martinez@gmail.com">Contacto</a></li>
                        <li> <a href="login/index.php">Login</a> </li>
                     </ul>
                  </div>
               </div>
                 <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                  <div class="contact">
                     <h3>Información de Contacto</h3>
                     <span>
                        987 51 94 35 <br>
                        ayuntamiento@aytocastropodame.com
                     </span>
                  </div>
               </div>
            </div>
         </div>
            <div class="copyright">
            <p>Turienzo Castañero es un pueblo que pertenece al municipio de Castropodame, en la comarca de El Bierzo perteneciente a la provincia de León.</p>
         </div>
         
      </div>
      </footr>
      <!-- end footer -->
      <!-- Javascript files--> 
      <script src="js/jquery.min.js"></script> 
      <script src="js/popper.min.js"></script> 
      <script src="js/bootstrap.bundle.min.js"></script> 
      <script src="js/jquery-3.0.0.min.js"></script> 
      <script src="js/plugin.js"></script> 
      <!-- sidebar --> 
      <script src="js/jquery.mCustomScrollbar.concat.min.js"></script> 
      <script src="js/custom.js"></script>
      <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
      <script>
         $(document).ready(function(){
         $(".fancybox").fancybox({
         openEffect: "none",
         closeEffect: "none"
         });
         
         $(".zoom").hover(function(){
         
         $(this).addClass('transition');
         }, function(){
         
         $(this).removeClass('transition');
         });
         });
         
      </script> 
   </body>
</html>