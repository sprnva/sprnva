<?php

namespace App\Core\Database;

use PDO;
use Exception;

class QueryBuilder
{
	/**
	 * The PDO instance.
	 *
	 * @var PDO
	 */
	protected $pdo;

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
		$inject = ($params == '') ? "" : "WHERE $params";
		$statement = $this->pdo->prepare("SELECT {$columns} FROM {$table} {$inject}");
		$statement->execute();
		return $statement->fetch(PDO::FETCH_ASSOC);
	}

	/**
	 * Select all records from a database table.
	 *
	 * @param string $table
	 */
	public function selectLoop($table)
	{
		$statement = $this->pdo->prepare("select * from {$table}");
		$statement->execute();
		return $statement->fetchAll(PDO::FETCH_CLASS);
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
			die('something went wrong!');
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
			die('something went wrong!');
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
			die('something went wrong!');
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
		$statement = $this->pdo->prepare($query);
		$statement->execute();

		if ($fetch == "Y") {
			return $statement->fetchAll(PDO::FETCH_CLASS);
		}
	}
}
