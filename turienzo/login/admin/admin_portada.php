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
      <link rel="stylesheet" href="../../css/bootstrap.min.css">
      <!-- style css -->
      <link rel="stylesheet" href="../../css/style.css">
      <!-- Responsive-->
      <link rel="stylesheet" href="../../css/responsive.css">
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="../../css/jquery.mCustomScrollbar.min.css">
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="/https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <link rel="stylesheet" href="/https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">

<style type="text/css">
	.login-form {
		width: 340px;
    	margin: 20px auto;
	}
    .login-form form {
    	margin-bottom: 15px;
        background: #f7f7f7;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
    }
    .login-form h2 {
        margin: 0 0 15px;
    }
    .form-control, .btn {
        min-height: 38px;
        border-radius: 2px;
    }
    .btn {        
        font-size: 15px;
        font-weight: bold;
    }
</style>

</head>
	<body>

	<!-- header -->
	<header>
         <!-- header inner -->
         <div class="header">
         <div class="container">
            <div class="row">
               <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                  <div class="full">
                     <div class="center-desk">
                        <div class="logo"> <a href="../../index.html"><img src="../../images/escudo1.jpeg" alt="logo"/></a> </div>
                     </div>
                  </div>
               </div>
               <div class="col-xl-7 col-lg-7 col-md-9 col-sm-9">
                  <div class="menu-area">
                     <div class="limit-box">
                        <nav class="main-menu">
                           <ul class="menu-area-main">
                              <li> <a href="../../index.html">Pagina Principal</a> </li>
                              <li> <a href="../../historia.html">Historia</a> </li>
                              <li> <a href="../../noticia.php">Noticias</a> </li>
                              <li> <a href="../../product.html">Galeria de fotos</a> </li>
                              <!--<li> <a href="../index.php">Login</a> </li>-->
							         <li> <a href="../../noticias.php">Administrar Noticias</a> </li>
							         <li class="active"> <a href="admin_portada.php">Administrar Usuarios</a> </li>
                              <!-- <li> <a href="noticias.php">Insertar Noticia</a> </li> -->
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
	
	<div class="wrapper">
	
	<div class="container">
			
		<div class="col-lg-12">
		 
			<center>
				<h1>Pagina Administrativa</h1>
				
				<h3>
				<?php
				session_start();

				if(!isset($_SESSION['admin_login']))	
				{
					header("location: ../index.php");  
				}

				if(isset($_SESSION['personal_login']))	
				{
					header("location: ../personal/personal_portada.php");	
				}

				if(isset($_SESSION['usuarios_login']))	
				{
					header("location: ../usuarios/usuarios_portada.php");
				}
				
				if(isset($_SESSION['admin_login']))
				{
				?>
					Bienvenido,
				<?php
						echo $_SESSION['admin_login'];
				}
				?>
				</h3>
					
			</center>
			<a href="../cerrar_sesion.php"><button class="btn btn-danger text-left"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cerrar Sesion</button></a>
            <hr>
		</div>
		
		<br><br><br>
		<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th width="4%">ID</th>
                                            <th width="18%">Usuario</th>
                                            <th width="24%">Email</th>
                                            <th width="19%">Rol</th>
                                            <th width="24%">Password</th>
											           <th colspan="2">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>

									<?php
									require_once 'DBconect.php';
									$select_stmt=$db->prepare("SELECT id,username,email,role,password FROM mainlogin");
									$select_stmt->execute();
									while($row=$select_stmt->fetch(PDO::FETCH_ASSOC))
									{
									?>
                                        <tr>
                                            <td><?php echo $row["id"]; ?></td>
                                            <td><?php echo $row["username"]; ?></td>
                                            <td><?php echo $row["email"]; ?></td>
                                            <td><?php echo $row["role"]; ?></td>
                                            <td><?php echo $row["password"]; ?></td>
											
						    			
											<td>
						    			<a href="#edit_<?php echo $row['id']; ?>" class="btn btn-success btn-sm" data-toggle="modal"><span class="fa fa-edit"></span> Editar</a>
						    			<a href="#delete_<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" data-toggle="modal"><span class="fa fa-trash"></span> Eliminar</a>
                              <?php include('editar_borrar_modelo.php'); ?>
						    		</td>
                           </tr>
									<?php 
									}
									?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
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
                     <li> <a href="../../historia.html">Sobre Nosotros</a></li>
                     <li> <a href="#">Terminos y Condiciones</a></li>
                     <li> <a href="#">Politica de Privacidad</a></li>
                     <li> 	<a href="mailto:alejandro.mansilla.martinez@gmail.com">Contacto</a></li>
                     <li> <a href="admin_portada.php">Login</a></li>
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
      <script src="../../js/jquery.min.js"></script> 
      <script src="../../js/popper.min.js"></script> 
      <script src="../../js/bootstrap.bundle.min.js"></script> 
      <script src="../../js/jquery-3.0.0.min.js"></script> 
      <script src="../../js/plugin.js"></script> 
      <!-- sidebar --> 
      <script src="../../js/jquery.mCustomScrollbar.concat.min.js"></script> 
      <script src="../../js/custom.js"></script>
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