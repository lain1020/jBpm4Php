<?php
	
	require '../vendor/autoload.php';

	use \jBpm4Php\Services\Runtime_Engine;
	use \jBpm4Php\Services\Authentication_Type;
	use \jBpm4Php\REST\Remote\Task\Task_Service;

	$url ="http://localhost:8080/jbpm-console";
	$deployment_id = 'org.jbpm:HR:1.0';

	$user = readline("User: ");
	$pass = readline("Password: ");

	$engine = new Runtime_Engine($url, $deployment_id, Authentication_Type::BASIC, $user, $pass);

	$runtime = $engine->get_runtime_service();
	$service = $engine->get_task_service();
	
	echo "Select your choice".PHP_EOL;
	echo PHP_EOL;
	echo "1 - Start Process.......:".PHP_EOL;
	echo "2 - Claim...............:".PHP_EOL;
	echo "3 - Start...............:".PHP_EOL;
	echo "4 - Complete............:".PHP_EOL;
	echo "5 - Get task list.......:".PHP_EOL;
	echo "6 - Exit(sample)........:".PHP_EOL;
	echo PHP_EOL;
	$choice = readline("Choice: ");

	switch ($choice) {
		case "1":
			var_dump($runtime->start_process('hiring'));
			break;
		case "2":
			$task_id = readline("Task ID: ");
			var_dump($service->claim($task_id));
			break;
		case "3":
			$task_id = readline("Task ID: ");
			var_dump($service->start($task_id));
			break;
		case "4":
			$task_id = readline("Task ID: ");
			$parameters = readline("Variables ('key1'=>'value1','key2'=>'value2'): ");
			eval(sprintf("$map = array(%s);", $parameters));
			var_dump($service->complete($task_id, $map));
			break;
		case "5":
			$map = array('potentialOwner'=>$user);
			$tasks = $service->query($map)->taskSummaryList;
			foreach ($tasks as $obj) {
				printf("ID: %d, Name: %s, Description: %s", $obj->id, $obj->name, $obj->description);
				echo PHP_EOL;
			}
			break;
	}

	echo PHP_EOL."End".PHP_EOL;
?>