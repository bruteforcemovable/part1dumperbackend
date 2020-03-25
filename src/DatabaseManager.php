<?php
namespace BruteforceMovable;

use Swoole\Coroutine as co;

class DatabaseManager
{
	protected static $connectionHandle;

	public static function getHandle() {
		$db = new co\MySQL();
        $server = array(
            'host' => getenv('DB_HOSTNAME'),
            'user' => getenv('DB_USERNAME'),
            'password' => getenv('DB_PASSWORD'),
            'database' => getenv('DB_DATABASE')
        );

		$connection = $db->connect($server);
		self::$connectionHandle = $connection;
        return $db;
	}
}
