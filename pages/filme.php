<?php

$id = $_GET['id'];

$sql = "SELECT * FROM filmes WHERE id = {$id}";

$sel = $con -> query($sql);

$filme = $sel -> fetch_assoc();

//print_r
//atores...
$sqlAtores = "SELECT A.id, A.titulo
			FROM atores A, atores_filmes AF
			WHERE AF.filme_id = {$id} AND A.id = AF.ator_id";
$selAtores = $con -> query($sqlAtores);

$atores = [];

while($ator = $selAtores -> fetch_assoc()){
	$atores[] = $ator;
}

//direçao
$sqlDiretores = "SELECT D.id, D.titulo
			FROM diretores D, diretores_filmes DF
			WHERE DF.filme_id = {$id} AND D.id = DF.diretor_id";
$selDiretores = $con -> query($sqlDiretores);

$diretores = [];

while($diretor = $selDiretores -> fetch_assoc()){
	$diretores[] = $diretor;
}

//genero 
$sqlGeneros = "SELECT G.id, G.titulo
			FROM generos G, filmes_generos FG
			WHERE FG.filme_id = {$id} AND G.id = FG.genero_id";
$selGeneros = $con -> query($sqlGeneros);

$generos = [];

while($genero = $selGeneros->fetch_assoc()){
	$generos[] = $genero['titulo'];
}

//comentrio
$sqlComentario = "SELECT C.autor, C.data , C.texto  
				  FROM comentario C
				  WHERE C.filme_id = {$id}" ;
$selComentarios = $con -> query($sqlComentario);

$comentarios = [];

			  

?>


<h1>
	<?php echo $filme['titulo']; ?>
	<small>
		(<?php echo $filme['ano']; ?>)
		<?php echo $filme['duracao']; ?> min /
		<?php echo implode(" | ", $generos); ?>	
	</small>	
	</h1>

<div class="row">
	<div class="col-lg-4">
		<img src="<?php echo $filme['poster']; ?>">
	</div>
	<div class="col-lg-3">
		<h3>Atores</h3>
		<?php foreach ($atores as $ator) : ?>
			<a  href="index.php?sec=busca&assunto=ator&id=<?php echo $ator['id']; ?>">
				<?php echo $ator['titulo'].'<br>';?>
			</a>
		<?php endforeach; ?>
		<br>
	
		<h3>Direção</h3>
		<?php 
		foreach($diretores as $diretor){
			echo $diretor['titulo'] . '<br>';
		}
		?>
	</div>
	<div class="col-lg-5">
		<div class="filme-avaliacao">
			<span class="filme-nota">

			</span>
			 <?php echo $filme['nota']; ?>
			<span class="filme-stars">
				<?php
			for($i = 1; $i <= 10; $i++){
				if($filme['nota'] >= $i){
					echo "<i class='fas fa-star'></i>"; //cheia
				}else {
					if($i - $filme['nota'] < 1){
						echo "<i class='fas fa-star-half-alt'></i>";//metade
					}
					else{
						echo "<i class='far fa-star'></i>";//metade
					}
				}
			} ?>
			</span>
		</div>
		<h3>Sinopse</h3>
		<p align="justify"><?php echo $filme['sinopse']; ?></p>
	</div>
</div>
<div class="row">
	<div class="col-sm-4">
		<form id="frmComentario" action="pages/AddComentario.php" method="post">

			<label>nome:</label>
			<input type="text" class="form-control input-sm" id="nome" name="nome">
			<label>comentario:</label>
			<input type="text" class="form-control input-sm" id="comentario" name="comentario"> <br>
			<input type="hidden" name="id" value="<?php echo $id; ?>">
			<input type="submit" name="Enviar" class="btn btn-primary">
			
		</form>
		<h3>Comentarios</h3>
		<?php 
		foreach($comentarios as $comentario){
			echo "----------------------- <br>";
			echo $comentario['data']. '<br>';
			echo "Autor:     ";
			echo $comentario['autor'] . '<br>';
			echo "Comentario:  ";
			echo $comentario['texto'] . '<br>'. '<br>';
		}
		?>
	</div>
</div>


