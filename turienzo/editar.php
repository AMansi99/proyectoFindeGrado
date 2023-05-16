<?php

	session_start();
	include_once('connection.php');

	if(isset($_POST['edit'])){
		$database = new Connection();
		$db = $database->open();
		try{
			$id = $_GET['id'];
			$titulo = $_POST['titulo'];
			$noticia = $_POST['noticia'];

			$sql = "UPDATE noticias SET titulo = '$titulo', noticia = '$noticia' WHERE id = '$id'";

			$_SESSION['message'] = ( $db->exec($sql) ) ? 'Los datos se actualizaron correctamente' : 'Ocurrio un error. No se pudo actualizar';

		}
		catch(PDOException $e){
			$_SESSION['message'] = $e->getMessage();
		}


		$database->close();
	}
	else{
		$_SESSION['message'] = 'Primero debe llenar el formulario';
	}

	header('location: noticias.php');

?>