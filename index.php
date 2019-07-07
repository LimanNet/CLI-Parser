<?php
use Parser\main;

require_once  __DIR__ .'\main.php';

	$parse = new main("https://lovestory.od.ua");
	$parse->reportDisplay();
	$parse->reportFile();

?>