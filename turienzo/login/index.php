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
      <link rel="stylesheet" href="../css/bootstrap.min.css">
      <!-- style css -->
      <link rel="stylesheet" href="../css/style.css">
      <!-- Responsive-->
      <link rel="stylesheet" href="../css/responsive.css">
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="../css/jquery.mCustomScrollbar.min.css">
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
<?php
require_once 'DBconect.php';
session_start();
if(isset($_SESSION["admin_login"]))	//Condicion admin
{
	header("location: admin/admin_portada.php");	
}
if(isset($_SESSION["personal_login"]))	//Condicion personal
{
	header("location: personal/personal_portada.php"); 
}
if(isset($_SESSION["usuarios_login"]))	//Condicion Usuarios
{
	header("location: usuarios/usuarios_portada.php");
}

if(isset($_REQUEST['btn_login']))	
{
	$email		=$_REQUEST["txt_email"];	//textbox nombre "txt_email"
	$password	=$_REQUEST["txt_password"];	//textbox nombre "txt_password"
	$role		=$_REQUEST["txt_role"];		//select opcion nombre "txt_role"
		
	if(empty($email)){						
		$errorMsg[]="Por favor ingrese Email";	//Revisar email
	}
	else if(empty($password)){
		$errorMsg[]="Por favor ingrese Password";	//Revisar password vacio
	}
	else if(empty($role)){
		$errorMsg[]="Por favor seleccione rol ";	//Revisar rol vacio
	}
	else if($email AND $password AND $role)
	{
		try
		{
			$select_stmt=$db->prepare("SELECT email,password,role FROM mainlogin
										WHERE
										email=:uemail AND password=:upassword AND role=:urole"); 
			$select_stmt->bindParam(":uemail",$email);
         $encryptrd_password = md5($password."");
         //var_dump($encryptrd_password);
			$select_stmt->bindParam(":upassword",$encryptrd_password);
			$select_stmt->bindParam(":urole",$role);
			$select_stmt->execute();	//execute query
					
			while($row=$select_stmt->fetch(PDO::FETCH_ASSOC))	
			{
				$dbemail	=$row["email"];
				$dbpassword	=$row["password"];
				$dbrole		=$row["role"];
			}
			if($email!=null AND $password!=null AND $role!=null)	
			{
				if($select_stmt->rowCount()>0)
				{
					if($email==$dbemail and md5($password)==$dbpassword and $role==$dbrole)
					{
						switch($dbrole)		//inicio de sesión de usuario base de roles
						{
							case "admin":
								$_SESSION["admin_login"]=$email;			
								$loginMsg="Admin: Inicio sesión con éxito";	
								header("refresh:3;admin/admin_portada.php");	
								break;
								
							case "personal";
								$_SESSION["personal_login"]=$email;				
								$loginMsg="Personal: Inicio sesión con éxito";		
								header("refresh:3;personal/personal_portada.php");	
								break;
								
							case "usuarios":
								$_SESSION["usuarios_login"]=$email;				
								$loginMsg="Usuario: Inicio sesión con éxito";	
								header("refresh:3;usuarios/usuarios_portada.php");		
								break;
								
							default:
								$errorMsg[]="correo electrónico o contraseña o rol";
						}
					}
					else
					{
						$errorMsg[]="correo electrónico o contraseña o rol";
					}
				}
				else
				{
					$errorMsg[]="correo electrónico o contraseña o rol";
				}
			}
			else
			{
				$errorMsg[]="correo electrónico o contraseña o rol";
			}
		}
		catch(PDOException $e)
		{
			$e->getMessage();
		}		
	}
	else
	{
		$errorMsg[]="correo electrónico o contraseña o rol incorrectos";
	}
}
?>

<!-- header -->
<header>
         <!-- header inner -->
         <div class="header">
         <div class="container">
            <div class="row">
               <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                  <div class="full">
                     <div class="center-desk">
                        <div class="logo"> <a href="index.html"><img src="../images/escudo1.jpeg" alt="logo"/></a> </div>
                     </div>
                  </div>
               </div>
               <div class="col-xl-7 col-lg-7 col-md-9 col-sm-9">
                  <div class="menu-area">
                     <div class="limit-box">
                        <nav class="main-menu">
                           <ul class="menu-area-main">
                              <li class="active"> <a href="../index.html">Pagina Principal</a> </li>
                              <li> <a href="../historia.html">Historia</a> </li>
                              <li> <a href="../noticia.php">Noticias</a> </li>
                              <li> <a href="../product.html">Galeria de fotos</a> </li>
                              <li> <a href="index.php">Login</a> </li>
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
		
		<?php
		if(isset($errorMsg))
		{
			foreach($errorMsg as $error)
			{
			?>
				<div class="alert alert-danger">
					<strong><?php echo $error; ?></strong>
				</div>
            <?php
			}
		}
		if(isset($loginMsg))
		{
		?>
			<div class="alert alert-success">
				<strong>ÉXITO ! <?php echo $loginMsg; ?></strong>
			</div>
        <?php
		}
		?> 


<div class="login-form">
<center><h2>Iniciar sesión</h2></center>
<form method="post" class="form-horizontal">
  <div class="form-group">
  <label class="col-sm-6 text-left">Email</label>
  <div class="col-sm-12">
  <input type="text" name="txt_email" class="form-control" placeholder="Ingrese email" />
  </div>
  </div>
      
  <div class="form-group">
  <label class="col-sm-6 text-left">Password</label>
  <div class="col-sm-12">
  <input type="password" name="txt_password" class="form-control" placeholder="Ingrese passowrd" />
  </div>
  </div>
      
  <div class="form-group">
      <label class="col-sm-6 text-left">Seleccionar rol</label>
      <div class="col-sm-12">
      <select class="form-control" name="txt_role">
          <option value="" selected="selected"> - selecccionar rol - </option>
          <option value="admin">Admin</option>
          <option value="usuarios">Usuarios</option>
      </select>
      </div>
  </div>

  
  <div class="form-group">
  <div class="col-sm-12">
  <input type="submit" name="btn_login" class="btn btn-success btn-block" value="Iniciar Sesion">
  </div>
  </div>
  
  <div class="form-group">
  <div class="col-sm-12">
  ¿No tienes una cuenta? <a href="registro.php"><p class="text-info">Registrar Cuenta</p></a>		
  </div>
  </div>
      
</form>
</div>
<!--Cierra div login-->
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
                     <li> 	<a href="mailto:alejandro.mansilla.martinez@gmail.com">Contacto</a></li>
                     <li> <a href="login.php">Login</a></li>
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
      <script src="../js/jquery.min.js"></script> 
      <script src="../js/popper.min.js"></script> 
      <script src="../js/bootstrap.bundle.min.js"></script> 
      <script src="../js/jquery-3.0.0.min.js"></script> 
      <script src="../js/plugin.js"></script> 
      <!-- sidebar --> 
      <script src="../js/jquery.mCustomScrollbar.concat.min.js"></script> 
      <script src="../js/custom.js"></script>
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