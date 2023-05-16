<?php

	session_start();
	include_once('Dbconect.php');

	if(isset($_GET['id'])){
		//$database = new Connection();
		//$db = $database->open();
		try{
			$sql = "DELETE FROM mainlogin WHERE id = '".$_GET['id']."'";

			$_SESSION['message'] = ( $db->exec($sql) ) ? 'Usuario eliminado correctamente' : 'Ocurrió un error. No se pudo eliminar la noticia';
		}
		catch(PDOException $e){
			$_SESSION['message'] = $e->getMessage();
		}


		//$database->close();

	}
	else{
		$_SESSION['message'] = 'Seleccione usuario para eliminar';
	}

	header('location: admin_portada.php');

?>