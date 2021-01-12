<?php

//definir fuso horário
date_default_timezone_set("America/Sao_Paulo");

//servidor do bd, usuário, senha, nome do bd
$con = new mysqli("127.0.0.1", "root", "", "iftm_filmes");

//caso haja erro na coneção, interrompe o site
if($con->connect_error){
	die('Erro na conexão: ' . $con->connect_error);
}

?>