<?php

return [
	'database' => [
		'name' => 'sprnva',
		'username' => 'root',
		'password' => '',
		'connection' => '127.0.0.1',
		'options' => [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
		]
	],

	'app' => [
		'base_url' => 'gpn',
		'name' => 'SPRNVA'
	]
];
