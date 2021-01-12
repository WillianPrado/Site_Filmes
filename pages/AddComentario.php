<?php


require_once '../config.php';

$data = date("Y-m-d H:i:s");

$idFilme    = $_POST['id'];
$nome       = $_POST['nome'];
$comentario = $_POST['comentario'];

$sqlComentario = "INSERT INTO comentario (autor,
								texto,
								filme_id,
								data)
							 VALUES 
							 ('$nome',
							  '$comentario',
							  '$idFilme',
							  '$data')";


	 $con -> query($sqlComentario);		

	 header("Location: ../index.php?sec=filme&id={$idFilme}");


?>