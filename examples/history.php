<?php
	
	require '../vendor/autoload.php';

	use \jBpm4Php\Services\Runtime_Engine;
	use \jBpm4Php\Services\Authentication_Type;
	use \jBpm4Php\REST\Remote\Deployment\Deployment_Service;

	$url ="http://localhost:8080/jbpm-console";
	$deployment_id = 'org.jbpm:HR:1.0';
	$user = 'admin';
	$pass = 'admin';

	$engine = new Runtime_Engine($url, $deployment_id, Authentication_Type::BASIC, $user, $pass);

	$service = $engine->get_history_service();
	
	echo "Select your choice".PHP_EOL;
	echo PHP_EOL;
	echo "1 - Clear..............:".PHP_EOL;
	echo "2 - Processes..........:".PHP_EOL;
	echo "3 - Variables..........:".PHP_EOL;
	echo "4 - Exit...............:".PHP_EOL;
	echo PHP_EOL;
	$choice = readline("Choice: ");

	switch ($choice) {
		case "1":
			$service->clear();
			break;
		case "2":
			var_dump($service->get_processes());
			break;
		case "3":
			$process_id = readline("Process ID: ");
			var_dump($service->get_variables($process_id));
			break;
	}

	echo PHP_EOL."End".PHP_EOL;
?>