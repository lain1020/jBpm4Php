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

	$service = $engine->get_deployment_service();
	
	echo "Select your choice".PHP_EOL;
	echo PHP_EOL;
	echo "1 - Deploy..............:".PHP_EOL;
	echo "2 - Undeploy............:".PHP_EOL;
	echo "3 - Get Deployed Units..:".PHP_EOL;
	echo "4 - Info................:".PHP_EOL;
	echo "5 - Exit................:".PHP_EOL;
	echo PHP_EOL;
	$choice = readline("Choice: ");

	switch ($choice) {
		case "1":
			$deployment_id = readline("Deployment ID: ");
			var_dump($service->deploy($deployment_id, array('runtime-strategy'=>'PER_PROCESS_INSTANCE')));
			break;
		case "2":
			$deployment_id = readline("Deployment ID: ");
			var_dump($service->undeploy($deployment_id));
			break;
		case "3":
			var_dump($service->get_deployed_units());
			break;
		case "4":
			$deployment_id = readline("Deployment ID: ");
			var_dump($service->get_deployment($deployment_id));
			break;
	}

	echo PHP_EOL."End".PHP_EOL;
?>