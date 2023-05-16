<?php

	session_start();
	include_once('connection.php');

	if(isset($_POST['add'])){
		$database = new Connection();
		$db = $database->open();
		try{

			$stmt = $db->prepare("INSERT INTO noticias (titulo, noticia) VALUES (:titulo, :noticia)");

			$_SESSION['message'] = ( $stmt->execute(array(':titulo' => $_POST['titulo'] , ':noticia' => $_POST['noticia'])) ) ? 'Noticia insertada con exito' : 'Un error ha ocurrido';
	    
		}
		catch(PDOException $e){
			$_SESSION['message'] = $e->getMessage();
		}


		$database->close();
	}

	else{
		$_SESSION['message'] = 'Se ha añadido correctamente';
	}

	header('location: noticias.php');
	
?>