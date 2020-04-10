<?php

class Abc {


	function m1() {
		echo 'called m1';
		echo PHP_EOL;

		return $this;
	}

	function m2() {
		echo 'called m2';
		echo PHP_EOL;
	}
}


$o = new Abc();

$o->m1()->m2();