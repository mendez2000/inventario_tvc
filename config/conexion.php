<?php

	error_reporting(E_ERROR | E_WARNING | E_PARSE);
	date_default_timezone_set('America/Los_Angeles');
	$dbhost="localhost";
	$dbname="bdinventario";
	$dbuser="root";
	$dbpass="";

	$mysqli = new mysqli($dbhost,$dbuser,$dbpass,$dbname);
	if ($mysqli->connect_errno) {
		die ("<h1>Fallo al conectar al servidor: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error."</h1>");
	}

	$mysqli->query("SET NAMES 'UTF8'");

	if(!isset($home)){
	$home = "..";
	}
?>
