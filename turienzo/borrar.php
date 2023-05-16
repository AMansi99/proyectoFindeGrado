<?php

	session_start();
	include_once('connection.php');

	if(isset($_GET['id'])){
		$database = new Connection();
		$db = $database->open();
		try{
			$sql = "DELETE FROM noticias WHERE id = '".$_GET['id']."'";

			$_SESSION['message'] = ( $db->exec($sql) ) ? 'Noticia eliminada correctamente' : 'Ocurrió un error. No se pudo eliminar la noticia';
		}
		catch(PDOException $e){
			$_SESSION['message'] = $e->getMessage();
		}


		$database->close();

	}
	else{
		$_SESSION['message'] = 'Seleccione noticia para eliminar';
	}

	header('location: noticias.php');

?>