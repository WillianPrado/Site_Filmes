<?php

$id = $_GET['id'];

$sql = "SELECT * FROM filmes WHERE id = {$id}";

$sel = $con -> query($sql);

$filme = $sel -> apc_fetch();

//print_r

?>

<h1><?php echo $filme['titulo']; ?></h1>

<div class="row">
	<div class="col-lg-4">
		<img src="<?php echo $filme['poster']; ?>">
	</div>
	<div class="col-lg-3">
		<h3>Atores</h3>
	</div>
	<div class="col-lg-5">
		<h3>Sinopse</h3>
		<p align="justify"><?php echo $filme['sinopse']; ?></p>
	</div>
</div>



