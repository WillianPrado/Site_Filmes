<?php 

$sql= "SELECT G.id, G.titulo, COUNT(*) AS qtd
		FROM generos AS G, filmes_generos FG
		WHERE G.id = FG.genero_id
		GROUP BY FG.genero_id
		ORDER BY titulo";


$sel = $con->query($sql);

?>

<h1>Gêneros disponíveis</h1>

<ul class="nav filme-tags">
	<?php while ($genero = $sel->fetch_assoc()) : ?>
		<li class="nav-item">
			<a class="nav-link btn btn-dark" href="index.php?sec=busca&assunto=genero&id=<?php echo $genero['id']; ?>">
				<?php echo $genero['titulo']; ?>
				<span class="badge badge-light"><?php echo $genero['qtd']; ?></span>

			</a>
		</li>
		<?php endwhile; ?>
	</ul>