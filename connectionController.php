<?php

class mysqlConnection
{
	const host = "localhost";
	const user = "root";
	const pass = "test1234";
	const db = "user";

	public function setConnection() {
		try {
			$pdo = new PDO("mysql:dbname=".self::db.";host=".self::host, self::user, self::pass);
		} catch (PDOException $e) {
			$pdo = "Error". $e->getMessage();
		}

		return $pdo;
	}
}