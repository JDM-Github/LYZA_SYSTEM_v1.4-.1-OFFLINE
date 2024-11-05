<?php

class MySQLDatabase
{
	private $connection;

	public function __construct()
	{
		$this->open_connection();
	}

	public function __destruct()
	{
		$this->close_connection();
	}

	public function beginTransaction()
	{
		$this->connection->begin_transaction();
	}

	public function commit()
	{
		$this->connection->commit();
	}

	public function rollback()
	{
		$this->connection->rollback();
	}

	public function escape($value)
	{
		return mysqli_real_escape_string($this->connection, $value);
	}

	private function open_connection()
	{
		$this->connection = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
		if ($this->connection->connect_error) {
			die("Database connection failed: " . $this->connection->connect_error);
		}
	}

	public function getLastInsertedId()
	{
		return $this->connection->insert_id;
	}

	public function getConnection()
	{
		return $this->connection;
	}

	public function getType($param)
	{
		if (is_int($param))
			return 'i';
		elseif (is_float($param))
			return 'd';
		elseif (is_string($param))
			return 's';
		else
			return 'b';
	}
	public function getParamTypeStr(...$params)
	{
		$types = '';
		foreach ($params as $param)
			$types .= $this->getType($param);
		return $types;
	}

	public function prepare($query)
	{
		return $this->connection->prepare($query);
	}

	public function query($sql)
	{
		$result = $this->connection->query($sql);
		$this->confirm_query($result);
		return $result;
	}

	public function execute($statement, ...$params)
	{
		$statement->bind_param(
			$this->getParamTypeStr(...$params),
			...$params
		);
		$statement->execute();
		return $statement->get_result();
	}

	public function prepexec($query, ...$params)
	{
		$statement = $this->connection->prepare($query);
		return $this->execute($statement, ...$params);
	}

	public function fetch($query, ...$params)
	{
		$fetch_to_return = null;
		$statement = $this->connection->prepare($query);
		$statement->bind_param(
			$this->getParamTypeStr(...$params),
			...$params
		);
		$statement->execute();
		$statement->bind_result($fetch_to_return);
		$statement->fetch();
		$statement->close();
		return $fetch_to_return;
	}

	public function confirm_query($result)
	{
		if (!$result) {
			die("Database query failed: " . $this->connection->error);
		}
	}

	public function escape_value($value)
	{
		return $this->connection->real_escape_string($value);
	}

	public function fetch_array($result)
	{
		return $result->fetch_assoc();
	}

	public function num_rows($result)
	{
		return $result->num_rows;
	}

	public function affected_rows()
	{
		return $this->connection->affected_rows;
	}

	public function insert_id()
	{
		return $this->connection->insert_id;
	}

	public function close_connection()
	{
		if (isset($this->connection)) {
			$this->connection->close();
			unset($this->connection);
		}
	}
}

// class SQLFunction
// {
// public static function addHotel(...$params)
// {
// 	$database = new MySQLDatabase();
// 	$database->prepexec("INSERT INTO Hotel (img_url, name, location, description) VALUES (?, ?, ?, ?)", ...$params);
// }

// public static function addRoom(...$params)
// {
// 	$database = new MySQLDatabase();
// 	$database->prepexec("INSERT INTO Rooms (room_number, type, price, status, hotel_id) VALUES (?, ?, ?, ?, ?)", ...$params);
// }

// public static function removeHotel(...$params)
// {
// 	$database = new MySQLDatabase();
// 	$database->prepexec("DELETE FROM Hotel WHERE hotel_id = ?", ...$params);
// }

// public static function removeRoom(...$params)
// {
// 	$database = new MySQLDatabase();
// 	$database->prepexec("DELETE FROM Rooms WHERE room_id = ?", ...$params);
// }

// public static function updHotel(...$params)
// {
// 	$database = new MySQLDatabase();
// 	$database->prepexec("
// 		UPDATE Hotel
// 		SET img_url = ?, name = ?, location = ?, description = ?
// 		WHERE hotel_id = ?", ...$params);
// }

// public static function updRoom(...$params)
// {
// 	$database = new MySQLDatabase();
// 	$database->prepexec("
// 		UPDATE Rooms 
// 		SET room_number = ?, type = ?, price = ?, status = ?, hotel_id = ?
// 		WHERE room_id = ?", ...$params);
// }

// public static function bookRoom(...$params)
// {
// 	$database = new MySQLDatabase();
// 	$database->prepexec("INSERT INTO Reservations (user_id, room_id, check_in, check_out) VALUES (?, ?, ?, ?)", ...$params);
// 	$database->prepexec("UPDATE Rooms SET status = ? WHERE room_id = ?", "Booked", $params[1]);
// }
// public static function unBookRoom(...$params)
// {
// 	$database = new MySQLDatabase();
// 	$database->prepexec("DELETE FROM Reservations WHERE reservation_id = ?", $params[0]);
// 	$database->prepexec("UPDATE Rooms  SET status = ? WHERE room_id = ?", "Available", $params[1]);
// }
// }

?>