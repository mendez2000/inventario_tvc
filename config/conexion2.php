<?php 
class DB{
	private static $dbName = 'bdinventario' ;
	private static $dbHost = 'localhost' ;
	//192.168.20.216
	private static $dbUsername = 'root';
	private static $dbUserPassword = '';

	private static $cont  = null;

	public function __construct() {
		exit('Init function is not allowed');
	}

	public static function connect(){
		if ( null == self::$cont ) {
			try {
				self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword);

			}
			catch(PDOException $e) {
				die($e->getMessage());
			}
		}
		return self::$cont;
	}

	public static function disconnect(){
		self::$cont = null;
	}
}