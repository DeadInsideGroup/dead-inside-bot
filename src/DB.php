<?php

use PDO;
use System\Hub\Singleton;

class DB
{
	
	use Singleton;

	/**
	 * @var \PDO
	 */
	private $pdo;

	/**
	 * Constructor.
	 */
	public function __construct()
	{
		$this->pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";port=".DB_PORT, DB_USER, DB_PASS);
	}

	/**
	 * Call static pdo.
	 *
	 * @param string $method
	 * @param array  $param
	 * @return mixed
	 */
	public function __callStatic($method, $param)
	{
		return self::getInstance()->pdo->{$method}(...$param);
	}
}