<?php

namespace App\Core\Database;

use PDO;
use Exception;
use App\Core\Filesystem;

class QueryBuilder
{
	/**
	 * The PDO instance.
	 *
	 * @var PDO
	 */
	protected $pdo;

	/**
	 * The actual result of the statement.
	 *
	 */
	private $result;

	/**
	 * Create a new QueryBuilder instance.
	 *
	 * @param PDO $pdo
	 */
	public function __construct($pdo)
	{
		$this->pdo = $pdo;
	}

	/**
	 * Select a record from a database table.
	 *
	 * @param string $columns
	 * @param string $table
	 * @param string $params
	 */
	public function select($columns, $table, $params = '')
	{
		try {
			$inject = ($params == '') ? "" : "WHERE $params";
			$statement = $this->pdo->prepare("SELECT {$columns} FROM {$table} {$inject}");
			$statement->execute();
			$this->result = $statement->fetch(PDO::FETCH_ASSOC);
			return $this;
		} catch (Exception $e) {
			throwException("Whoops! error occurred.", $e);
		}
	}

	/**
	 * Select all records from a database table.
	 *
	 * @param string $table
	 */
	public function selectLoop($column, $table, $params = '')
	{
		try {
			$inject = ($params == '') ? "" : "WHERE $params";
			$statement = $this->pdo->prepare("select {$column} from {$table} {$inject}");
			$statement->execute();
			$this->result = $statement->fetchAll(PDO::FETCH_ASSOC);
			return $this;
		} catch (Exception $e) {
			throwException("Whoops! error occurred.", $e);
		}
	}

	/**
	 * GET the result of a query
	 * 
	 */
	public function get()
	{
		return $this->result;
	}

	/**
	 * this will solve n+1 problem
	 * will get the data of the foreign id in the current table
	 * 
	 */
	public function with($params = [])
	{
		$currentTableDatas = $this->result;

		$collectedIdFrom = [];
		foreach ($params as $relationTable => $param) {
			$foreignIdFromCurrentTable = [];
			foreach ($currentTableDatas as $key => $currentTableData) {
				if (is_array($currentTableData)) {
					$foreignIdFromCurrentTable[] = $currentTableData[$param[0]];
				} else {
					$foreignIdFromCurrentTable[] = $currentTableDatas[$param[0]];
				}
			}

			$collectedIdFrom[$relationTable] = $foreignIdFromCurrentTable;
		}

		$relationDatas = [];
		foreach ($params as $relationTable => $primaryColumn) {
			$relationPrimaryColumn = $primaryColumn[1];
			$implodedIds = implode("','", array_unique($collectedIdFrom[$relationTable]));

			$statement = $this->pdo->prepare("SELECT * FROM `{$relationTable}` WHERE `{$relationTable}`.`$relationPrimaryColumn` IN('$implodedIds')");
			$statement->execute();
			$relationDatas[$relationTable] = $statement->fetchAll(PDO::FETCH_ASSOC);
		}

		$newResultSet = [];
		foreach ($currentTableDatas as $currentTableData) {
			foreach ($params as $relationTable => $primaryColumn) {
				foreach ($relationDatas[$relationTable] as $key => $relationData) {
					if (is_array($currentTableData)) {
						if ($currentTableData[$primaryColumn[0]] == $relationData[$primaryColumn[1]]) {
							$currentTableData[$relationTable] = $relationData;
						}
					} else {
						if ($currentTableDatas[$primaryColumn[0]] == $relationData[$primaryColumn[1]]) {
							$currentTableDatas[$relationTable] = $relationData;
						}
					}
				}
			}

			if (is_array($currentTableData)) {
				$newResultSet[] = $currentTableData;
			} else {
				$newResultSet = $currentTableDatas;
			}
		}

		$this->result = $newResultSet;
		return $this;
	}

	/**
	 * insert record to a database table.
	 *
	 * @param string $table_name
	 * @param array $form_data
	 * @param string $last_id
	 */
	public function insert($table_name, $form_data, $last_id = 'N')
	{
		$fields = array_keys($form_data);

		$sql = "INSERT INTO " . $table_name . "(`" . implode('`,`', $fields) . "`) VALUES ('" . implode("','", $form_data) . "')";

		try {
			$statement = $this->pdo->prepare($sql);
			$statement->execute();

			$lastID = $this->pdo->lastInsertId();
			if ($last_id == 'Y') {
				if ($statement) {
					return $lastID;
				} else {
					return 0;
				}
			} else {
				if ($statement) {
					return 1;
				} else {
					return 0;
				}
			}
		} catch (Exception $e) {
			throwException("Whoops! error occurred.", $e);
		}
	}

	/**
	 * update a record from a database table.
	 *
	 * @param string $table_name
	 * @param array $form_data
	 * @param string $where_clause
	 */
	public function update($table_name, $form_data, $where_clause = '')
	{
		$whereSQL = '';
		if (!empty($where_clause)) {
			if (substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE') {
				$whereSQL = " WHERE " . $where_clause;
			} else {
				$whereSQL = " " . trim($where_clause);
			}
		}
		$sql = "UPDATE " . $table_name . " SET ";
		$sets = array();
		foreach ($form_data as $column => $value) {
			$sets[] = "`" . $column . "` = '" . $value . "'";
		}
		$sql .= implode(', ', $sets);
		$sql .= $whereSQL;

		try {
			$statement = $this->pdo->prepare($sql);
			$statement->execute();

			if ($statement) {
				return 1;
			} else {
				return 0;
			}
		} catch (Exception $e) {
			throwException("Whoops! error occurred.", $e);
		}
	}

	/**
	 * delete a record from a database table.
	 *
	 * @param string $table_name
	 * @param string $where_clause
	 */
	public function delete($table_name, $where_clause = '')
	{
		$whereSQL = '';
		if (!empty($where_clause)) {
			if (substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE') {
				$whereSQL = " WHERE " . $where_clause;
			} else {
				$whereSQL = " " . trim($where_clause);
			}
		}

		$sql = "DELETE FROM " . $table_name . $whereSQL;

		try {
			$statement = $this->pdo->prepare($sql);
			$statement->execute();

			if ($statement) {
				return 1;
			} else {
				return 0;
			}
		} catch (Exception $e) {
			throwException("Whoops! error occurred.", $e);
		}
	}

	/**
	 * query a record from a database.
	 *
	 * @param string $query
	 * @param string $fetch (optional)
	 */
	public function query($query, $fetch = "N")
	{
		try {
			$statement = $this->pdo->prepare($query);
			$statement->execute();

			if ($fetch == "Y") {
				$this->result = $statement->fetchAll(PDO::FETCH_ASSOC);
				return $this;
			} else {
				if ($statement) {
					return 1;
				} else {
					return 0;
				}
			}
		} catch (Exception $e) {
			throwException("Whoops! error occurred.", $e);
		}
	}

	/**
	 * seed a record/s into the database.
	 *
	 */
	public function seeder($table, $length, $tableColumns = [])
	{
		Filesystem::noMemoryLimit();
		$start_time = microtime(TRUE);

		$iterate = function ($tableColumns, $length) {
			for ($x = 0; $x < $length; $x++) {
				yield $tableColumns;
			}
		};

		foreach (iterator_to_array($iterate($tableColumns, $length)) as $customerInfo) {
			DB()->insert($table, $customerInfo);
		}

		$end_time = microtime(TRUE);
		$time_taken = ($end_time - $start_time);
		$time_taken = round($time_taken, 5);
		$memoryUsage = (round(memory_get_peak_usage() / 1024 / 1024));

		return "Success seed! Page generated in {$time_taken} seconds using {$memoryUsage}MB.";
	}
}
