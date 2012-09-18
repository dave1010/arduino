#!/usr/bin/php
<?php

ini_set('display_errors', -1);

define('SERIAL', '/dev/ttyACM0');

$f = fopen(SERIAL, 'w+');

function setServo($degrees) {
	global $f;

	$degrees = (int) abs($degrees);
	if ($degrees > 170) {
		$degrees = 170;
	}

	echo $degrees."\n";
	fwrite($f, $degrees."\n");

}

while(true) {
	$v = rand(1,170)."\n";
	setServo($v);
	usleep(500*1000);
}



