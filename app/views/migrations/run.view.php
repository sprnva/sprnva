<?php

use App\Core\Database\Migration\Migration;

$migration = new Migration();
$commandType = $request["command"];
$migrationName = $request["migrationName"];

switch ($commandType) {
	case 'migration:make':
		echo $migration->make($migrationName);
		break;

	case 'migration:migrate':
		echo $migration->migrate();
		break;

	case 'migration:fresh':
		echo $migration->fresh();
		break;

	case 'schema:dump':
		echo $migration->dump();
		break;

	case 'schema:dump-prune':
		echo $migration->dump('prune');
		break;

	case 'migration:rollback':
		echo $migration->rollback();
		break;

	default:
		break;
}
