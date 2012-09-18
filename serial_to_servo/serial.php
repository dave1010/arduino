#!/usr/bin/php
<?php

// find tweets matching "setservo [\d]{1,3}", then move the servo

ini_set('display_errors', -1);

define('SERIAL', '/dev/ttyACM0');

$f = fopen(SERIAL, 'w+');
$lastDegrees = 0;

function setServo($degrees) {
	global $f;

	$degrees = (int) abs($degrees);
	if ($degrees > 170) {
		$degrees = 170;
	}

	if ($degrees === $GLOBALS['lastDegrees']) {
		return;
	}

	echo $degrees."\n";
	fwrite($f, $degrees."\n");
}


while(true) {
	$tweets = @json_decode(file_get_contents('http://search.twitter.com/search.json?q=setservo&result_type=recent'));

	if (@$tweets->results[0]->text) {
		$tweet = @$tweets->results[0]->text;
		
		$degrees = preg_match('/setservo ([\d]{1,3})/', $tweet, $matches);
		if ($matches[1]) {
			setServo($matches[1]);
		}
	}
	
	usleep(5*1000*1000);
}



