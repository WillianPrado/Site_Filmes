<?php
//incluir as config de conexao
include ('config.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Movieflix</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="lib/select2/css/select2.css">

<link rel="stylesheet" type="text/css" href="lib/alertifyjs/css/alertify.css">
</head>
<body>



<!-- Header -->
<header class="container-fluid site-header">
	<div class="container">
		<h1>MovieFlix</h1>
	</div>
</header>



<!-- Menu principal -->
<nav class="navbar navbar-expand-md bg-light navbar-light sticky-top">
	<!-- Toggler/collapsibe Button -->
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu">
		<span class="navbar-toggler-icon"></span>
	</button>

	<!-- Links -->
	<div class="collapse navbar-collapse" id="menu">
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link" href="index.php">Home</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="index.php?sec=generos">Gêneros</a>
			</li>
		</ul>
	</div>

	<!-- Busca -->
	<!-- 
	action: o endereço do arqruivo onde o formulario vai ser enviado
	method: forma de envio (get/post) 


	-->
	<form class="form-inline" action="index.php?" method="get">
		<input type="hidden" name="sec" value="busca">
		<input type="hidden" name="assunto" value="geral">
		<div class="input-group">
			
			<input type="text"  name="palavra" class="form-control" placeholder="Busca">
			<div class="input-group-append">
				<button class="btn btn-dark" type="submit">
					<i class="fas fa-search"></i>
				</button>
			</div>
		</div>
		
	</form>
</nav> 



<!-- Main/Principal -->
<section class="container-fluid site-main">
	<div class="container">
		<?php
		//verificando qual pag sera incluida no meio do site.
		if(isset($_GET['sec']) ){

			$secoes = ['filme', 'generos', 'busca'];
			$sec = $_GET['sec'];

			if(in_array($sec, $secoes) ) {
				include("pages/" . $sec . ".php");
			}else {
				include("pages/principal.php");
			}

		} else {
			include("pages/principal.php");
		}

		?>
	</div>
</section>




<!-- Footer -->
<footer class="container-fluid site-footer">
	<div class="container">
		
	</div>
</footer>



<!-- Javascripts -->
<script src="js/jquery-3.4.1.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="js/scripts.js"></script>
<script src="lib/select2/js/select2.js"></script>
<script src="lib/alertifyjs/alertify.js"></script>
</body>
</html> 