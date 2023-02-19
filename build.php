#!/bin/bash
<?php

$mode = $argv[1] ?? null;

$dockerCommandRun = "docker-compose up --build -d";
$dockerCommandStop = "docker-compose down";

$availableEnvs = [
    'all',
    'content',
    'customer',
    //    'notification', //@todo While it is not support
];

$serviceFolders = [
    'content'  => 'content-service',
    'customer' => 'customer-service',
    //    'notification' => 'notification-service',
];

if ($mode !== 'stop') {
	showViewEnvironment("What is docker environment do you want launch", $availableEnvs);
	$customerEnv = readline();

	if (!in_array($customerEnv, $availableEnvs, true)) {
		echo "Env {{$customerEnv}} is not exists";
        exit();
	}

	if ($customerEnv !== 'all') {
		exec("cd {$serviceFolders[$customerEnv]}; $dockerCommandRun");
	} else {
		foreach ($availableEnvs as $env) {
			if ($env !== 'all') {
				exec("cd {$serviceFolders[$env]}; $dockerCommandRun");
			}
		}
	}

	echo PHP_EOL;
	echo "--------------------------------------------------------" . PHP_EOL;
	echo "Success! See you :)" . PHP_EOL;
	echo "--------------------------------------------------------" . PHP_EOL;
} else {
	showViewEnvironment("What is docker environment do you want stop", $availableEnvs);
	$customerEnv = readline();

	if (!in_array($customerEnv, $availableEnvs, true)) {
		echo "Env {{$customerEnv}} is not exists";
		exit();
	}

	if ($customerEnv !== 'all') {
		exec("cd {$serviceFolders[$customerEnv]}; $dockerCommandStop");
	} else {
		foreach ($availableEnvs as $env) {
			if ($env !== 'all') {
				exec("cd {$serviceFolders[$env]}; $dockerCommandStop");
			}
		}
	}
}

/**
 * @param string $text
 * @param array $availableEnvs
 * @return void
 */
function showViewEnvironment(
        string $text,
        array $availableEnvs
): void  {
	echo "--------------------------------------------------------" . PHP_EOL;
	echo $text . PHP_EOL;
	echo "--------------------------------------------------------" . PHP_EOL;
	echo "Available environments:" . PHP_EOL;
	echo "###############################" . PHP_EOL;
	foreach ($availableEnvs as $env) {
		echo $env . PHP_EOL;
	}
	echo "###############################" . PHP_EOL;
}