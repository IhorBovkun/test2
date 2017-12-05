<?php

/**
	*	Функция отладки. Останавливает работу программы выводя начение переменной
	*	$value 
	*	
	*	@param variant $value переменная для вывода ее на страницу 
	*/ 
	function ds($value, $die = 1){
		
		echo 'debug:';
		echo '<pre>';
		print_r($value);
		echo'</pre>';

		if ($die) exit;
	}

	function db($value, $die = 1){
		function debugOut($a){

			echo '<br><b>'.basename($a['file']).'</b>'
			. "&nbsp;<font color='red'>({$a['line']})</font>"
			. "&nbsp;<font color='green'>{$a['function']}()</font>"
			. "&nbsp; -- "
			. dirname($a['file']);
		}

		echo '<pre>';
			$trace = debug_backtrace();
			array_walk($trace, 'debugOut');
			echo "\n\n";
			var_dump($value);
		echo'</pre>';

		if ($die) exit;
	}