

<?php
$termo = ['campo' => '', 'assunto' => '']; // oque está sendo buscado


if(
	isset($_GET['assunto']) && 
	( isset($_GET['id']) || isset($_GET['palavra']))){
	//buscar por um assunto específico

	$assunto = $_GET['assunto'];
	$id      = $_GET['id'];

	switch($assunto){
		case 'genero':
			$sql = "SELECT F.id, F.titulo, F.poster, G.titulo AS gTitulo
					FROM generos G, filmes_generos FG, filmes F 
					WHERE G.id = FG.genero_id
					AND FG.filme_id = F.id
					AND G.id = {$id}";

			$termo['assunto'] = 'Gênero';
			$termo['campo']   = 'gTitulo';		
			break;

		case 'ator' :
			$sql = "SELECT F.id, F.titulo, F.poster, A.titulo AS aTitulo
					FROM atores A, atores_filmes FA, filmes F 
					WHERE A.id = FA.ator_id
					AND FA.filme_id = F.id
					AND A.id = {$id}";
			
			$termo['assunto'] = 'ator';
			$termo['campo']   = 'aTitulo';		
			break;

		case 'diretor' :
			$sql = "SELECT F.id, F.titulo, F.poster, D.titulo dTitulo
					FROM diretores D, diretores_filmes FA, filmes F 
					WHERE D.id = DF.ator_id
					AND FD.filme_id = F.id
					AND D.id = {$id}";
			
			$termo['assunto'] = 'Diretor';
			$termo['campo']   = 'dTitulo';		
			break;	

	
	}

	$direc = 'ASC';
	if (isset($_GET['ordem'])){
		$ordem = $_GET['ordem'];
		switch ($ordem) {
			case 'nome': $campoOrdem = 'F.titulo';break;
			case 'data': $campoOrdem = 'F.ano';break;
			case 'nota': $campoOrdem = 'F.nota';break;
			default    : $campoOrdem = 'F.id';
			
		}

		

		
		if (isset($_GET['direc']) ){
			$direc = $_GET['direc'];
			// Se $direct for DESC, se não recevve ASC
			// ISTO É TIPO UM IF DE UMA LINHA SÓ
			$direc = ( $direc == "DESC")? "DESC" : "ASC"; 
		}

		$sql = $sql. " ORDER BY {$campoOrdem} {$direc}";
		// Trocando o ASC pelo Desc e vice-versa
		if(isset($_GET['direc']) ){
			$direc = ( $direc == "DESC")? "DESC" : "ASC";

		}
	}

	$pp = 13;
	$pg = 24;
	$pg = isset($_GET['pg'])? $_GET['pg']: 1;

	$pgReal = $pg -1;
	$sql = $sql." LIMIT {$pgReal},{$pp}";

	echo $sql;
	$sel = $con -> query($sql);

}else {
	//busca o form
}

echo "       |||| o pg = $pg, a pp = $pp, a paReal = $pgReal";
?>


<h1>Resultados</h1>

<?php if($sel -> num_rows == 0): ?>
	<?php echo $sql; ?>
	<div class="alert alert-secondary">
		Nenhum resultado encontrado!
	</div>

<?php else : ?>
	<div class="row">
		<div class="col-lg-8">
			<!-- pelo que o usuário realizou a busca -->
			<h4>
				Busca em
				<?php echo $termo['assunto'];?>:
				<?php echo $sel->fetch_assoc()[ $termo['campo']]; ?>
			</h4>
		</div>

		<div class="col-lg-4 text-right">
			<a href="index.php?sec=busca&assunto=<?php echo $assunto; ?>&id=<?php echo $id; ?>&ordem=nome&direc=<?php echo $direc; ?>" class="btn btn-outline-primary btn-sm"><i class="fas fa-sort"></i>  Nome</a>
			<a href="index.php?sec=busca&assunto=<?php echo $assunto; ?>&id=<?php echo $id; ?>&ordem=data&direc=<?php echo $direc; ?>" class="btn btn-outline-primary btn-sm"></i>  Data</a>
			<a href="index.php?sec=busca&assunto=<?php echo $assunto; ?>&id=<?php echo $id; ?>&ordem=nota&direc=<?php echo $direc; ?>" class="btn btn-outline-primary btn-sm"></i>  Nota</a>
			
		</div>
		
	</div>
		

	<div class="row">
		
	
		<?php
		$cont = 0;

		$pgReal = 14;
		$sel->data_seek(0);//volta para o primeiro registro
		while ($filme = $sel->fetch_assoc()) : ?>

				<div class='col-lg-3 poster text-center'>
					<a href="index.php?sec=filme&id=<?php echo $filme['id'];?>">
					<img src="<?php echo $filme['poster']; ?>" title="<?php echo $filme['titulo']; ?>">
					</a>
				</div>
			<?php 
				if(++$cont % 4 == 0){
					echo "</div>";
					echo "<div class='row'>";
				}
			endwhile; ?>
	</div>
<ul class="pagination">







	<?php 
		if ($pg > 1){
			$pgReal = $pgReal + 1;

			
		}	  
 	 ?>
  <li class="page-item"><a class="page-link" href="$pgReal=2;">1</a></li>
  <li class="page-item"><a class="page-link" href="#">2</a></li>
  <li class="page-item"><a class="page-link" href="
  

  <?php 
		if ($pg < 10){
			echo '{$pg}= {$pg} + 1';
		}	  
 	 ?>
 	 ">3</a></li>
</ul>
	

	<?php endif; ?>