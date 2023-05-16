<?php

	session_start();
	include_once('DBconect.php');

	if(isset($_POST['edit'])){
		//$database = new Connection();
		//$db = $database->open();
		try{
			$id = $_GET['id'];
			$username = $_POST['username'];
			$email = $_POST['email'];
            $role = $_POST['role'];
            $password = $_POST['password'];

			$sql = "UPDATE mainlogin SET username = '$username', email = '$email', role = '$role', password = md5('$password') WHERE id = '$id'";

			$_SESSION['message'] = ( $db->exec($sql) ) ? 'Los datos se actualizaron correctamente' : 'Ocurrio un error. No se pudo actualizar';

		}
		catch(PDOException $e){
			$_SESSION['message'] = $e->getMessage();
		}


		//$database->close();
	}
	else{
		$_SESSION['message'] = 'Primero debe llenar el formulario';
	}

	header('location: admin_portada.php');

?>