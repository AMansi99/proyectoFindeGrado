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

require_once "DBconect.php";

if(isset($_REQUEST['btn_register'])) //compruebe el nombre del botón "btn_register" y configúrelo
{
	$username	= $_REQUEST['txt_username'];	//input nombre "txt_username"
	$email		= $_REQUEST['txt_email'];	//input nombre "txt_email"
	$password	= $_REQUEST['txt_password'];	//input nombre "txt_password"
	$role		= $_REQUEST['txt_role'];	//seleccion nombre "txt_role"
		
	if(empty($username)){
		$errorMsg[]="Ingrese nombre de usuario";	//Compruebe input nombre de usuario no vacío
	}
	else if(empty($email)){
		$errorMsg[]="Ingrese email";	//Revisar email input no vacio
	}
	else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		$errorMsg[]="Ingrese email valido";	//Verificar formato de email
	}
	else if(empty($password)){
		$errorMsg[]="Ingrese password";	//Revisar password vacio o nulo
	}
	else if(strlen($password) < 6){
		$errorMsg[] = "Password minimo 6 caracteres";	//Revisar password 6 caracteres
	}
	else if(empty($role)){
		$errorMsg[]="Seleccione rol";	//Revisar etiqueta select vacio
	}
	else
	{	
		try
		{	
			$select_stmt=$db->prepare("SELECT username, email FROM mainlogin 
										WHERE username=:uname OR email=:uemail"); // consulta sql
			$select_stmt->bindParam(":uname",$username);   
			$select_stmt->bindParam(":uemail",$email);      //parámetros de enlace
			$select_stmt->execute();
			$row=$select_stmt->fetch(PDO::FETCH_ASSOC);	
			if($row["username"]==$username){
				$errorMsg[]="Usuario ya existe";	//Verificar usuario existente
			}
			else if($row["email"]==$email){
				$errorMsg[]="Email ya existe";	//Verificar email existente
			}
			
			else if(!isset($errorMsg))
			{
				$insert_stmt=$db->prepare("INSERT INTO mainlogin(username,email,password,role) VALUES(:uname,:uemail,:upassword,:urole)"); //Consulta sql de insertar			
				$insert_stmt->bindParam(":uname",$username);	
				$insert_stmt->bindParam(":uemail",$email);	  		//parámetros de enlace 
				$insert_stmt->bindParam(":upassword",md5($password));
				$insert_stmt->bindParam(":urole",$role);
				
				if($insert_stmt->execute())
				{
					$registerMsg="Registro exitoso: Esperar página de inicio de sesión"; //Ejecuta consultas 
					header("refresh:2;index.php"); //Actualizar despues de 2 segundo a la portada
				}
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
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
					<strong>INCORRECTO ! <?php echo $error; ?></strong>
				</div>
            <?php
			}
		}
		if(isset($registerMsg))
		{
		?>
			<div class="alert alert-success">
				<strong>EXITO ! <?php echo $registerMsg; ?></strong>
			</div>
        <?php
		}
		?> 
<div class="login-form">  
<center><h2>Registrar</h2></center>
<form method="post" class="form-horizontal">
    
<div class="form-group">
<label class="col-sm-9 text-left">Usuario</label>
<div class="col-sm-12">
<input type="text" name="txt_username" class="form-control" placeholder="Ingrese usuario" />
</div>
</div>

<div class="form-group">
<label class="col-sm-9 text-left">Email</label>
<div class="col-sm-12">
<input type="text" name="txt_email" class="form-control" placeholder="Ingrese email" />
</div>
</div>
    
<div class="form-group">
<label class="col-sm-9 text-left">Password</label>
<div class="col-sm-12">
<input type="password" name="txt_password" class="form-control" placeholder="Ingrese password" />
</div>
</div>
    
<div class="form-group">
    <label class="col-sm-9 text-left">Seleccione tipo</label>
    <div class="col-sm-12">
    <select class="form-control" name="txt_role">
        <option value="" selected="selected"> - seleccione rol - </option>
		<!-- <option value="admin">Admin</option> -->
        <option value="usuarios">Usuarios</option>
    </select>
    </div>
</div>

<div class="form-group">
<div class="col-sm-12">
<input type="submit" name="btn_register" class="btn btn-primary btn-block" value="Registro">
<!--<a href="index.php" class="btn btn-danger">Cancel</a>-->
</div>
</div>

<div class="form-group">
<div class="col-sm-12">
¿Tienes una cuenta? <a href="index.php"><p class="text-info">Inicio de sesión</p></a>		
</div>
</div>
    
</form>
</div><!--Cierra div login-->
		</div>
		
	</div>
			
	</div>
										
	</body>
</html>