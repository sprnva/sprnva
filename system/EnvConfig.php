<?php

return [
	'database' => [
		'name' => $config["name"],
		'username' => $config["username"],
		'password' => $config["password"],
		'connection' => $config["connection"],
		'options' => [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
		]
	],

	'app' => [
		'base_url' => $config["base_url"],
		'name' => $config["app_name"],

		// choices: development, production
		'environment' => $config["environment"],

		// EMAIL
		'smtp_host' => $config["smtp_host"],
		'smtp_sender' => $config["smtp_sender"],
		'smtp_password' => $config["smtp_password"],
		'smtp_port' => $config["smtp_port"]
	]
];
