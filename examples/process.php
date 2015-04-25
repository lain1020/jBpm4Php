<?php
	
	require '../vendor/autoload.php';

	use \jBpm4Php\Services\Runtime_Engine;
	use \jBpm4Php\Services\Authentication_Type;

	$url ="http://localhost:8080/jbpm-console";
	$deployment_id = 'org.jbpm:HR:1.0';
	$user = 'admin';
	$pass = 'admin';

	$engine = new Runtime_Engine($url, $deployment_id, Authentication_Type::BASIC, $user, $pass);

	$runtime = $engine->get_runtime_service();
	
	echo "Press 1, 2, 3 or 4 to select your task, or 5 to exit".PHP_EOL;
	echo "----------------------------------------------------".PHP_EOL;
	echo "1 - Start.........:".PHP_EOL;
	echo "2 - Abort.........:".PHP_EOL;
	echo "3 - Get Instance..:".PHP_EOL;
	echo "4 - Send a Signal.:".PHP_EOL;
	echo "5 - Exit..........:".PHP_EOL;
	echo PHP_EOL;
	$choice = readline("Choice: ");

	switch ($choice) {
		case "1":
			var_dump($runtime->start_process('hiring'));
			break;
		case "2":
			$id = readline("Process Instance ID: ");
			var_dump($runtime->abort_process($id));
			break;
		case "3":
			$id = readline("Process Instance ID: ");
			var_dump($runtime->get_process_instance($id));
			break;
		case "4":
			$signal = readline("Signal: ");
			$value = readline("Value: ");
			var_dump($runtime->signal($id, array($signal=>$value)));
			break;
	}

	echo PHP_EOL."End".PHP_EOL;
?>