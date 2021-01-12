<?php
//pages/principal.php

?>

<h1>Últimos lançamentos</h1>

<?php
$sql = "SELECT id, titulo, poster
		FROM filmes
		ORDER BY ano DESC
		LIMIT 4";

//executar um comando sql no bd
$sel = $con->query($sql);

if($sel->num_rows > 0){//achou resolt

	echo "<div class='row'>";

	while($filme = $sel -> fetch_assoc()){
		$id = $filme['id'];
		$titulo = $filme['titulo'];
		$poster = $filme['poster'];

		echo "<div class='col-md-3 poster'>"; 
		echo "<a href='index.php?sec=filme&id={$id}'>";
		echo "<img src='{$poster}' title='{$titulo}'>";
		echo "</a>";
		echo "</div>";
	}

	echo "</div>";
}
?>
<h1>Mais assistidos</h1>

<?php
$sql = "SELECT id, titulo, poster
		FROM filmes
		ORDER BY votos DESC
		LIMIT 4";

//executar um comando sql no bd
$sel = $con->query($sql);

if($sel->num_rows > 0){//achou resolt

	echo "<div class='row'>";

	while($filme = $sel -> fetch_assoc()){
		$id = $filme['id'];
		$titulo = $filme['titulo'];
		$poster = $filme['poster'];

		echo "<div class='col-md-3 poster'>"; 
		echo "<img src='{$poster}''>";
		echo "</div>";
	}

	echo "</div>";
}
?>