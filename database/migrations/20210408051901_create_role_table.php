<?php

$create_role_table = [
	"mode" => "NEW",
	"table"	=> "role",
	"primary_key" => "id",
	"up" => [
		"id" => "INT(11) unsigned NOT NULL AUTO_INCREMENT",
		"role" => "varchar(200) DEFAULT NULL",
		"created_at" => "datetime DEFAULT NULL",
	],
	"down" => [
		"" => ""
	]
];