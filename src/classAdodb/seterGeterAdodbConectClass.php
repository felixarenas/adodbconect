<?php
namespace farenas\AdodbConect\classAdodb;

class seterGeterAdodbConectClass 
{

	protected $server;

	protected $user;

	protected $password;

	protected $database;

	protected $db;

	protected $dbConect;

	protected $pathLocal;

	protected $driver;

	protected $puerto;

	protected $classAdoDb;

	protected $paramExcecute;

	protected $charset;

	protected $strip_tags;

	protected $excep_tags;

	public function __construct($driver, $server, $puerto, $user, $password, $database, $charset = 'AL32UTF8', $str_tags, $excp_tags)
	{
		$this -> setServer($server);

		$this -> setUser($user);

		$this -> setPass($password);

		$this -> setDataBase($database);

		$this -> pathLocal = dirname(__FILE__)  . '/../../../../../vendor/adodb/adodb-php';

		$this -> setDriver($driver);

		$this -> setPuerto($puerto);

		$this -> setCharSet($charset);

		$this -> setStrip_tags($str_tags);

		$this -> setExcep_tags($excp_tags);
	}

	private function setPuerto($puerto)
	{
		$this -> puerto = $puerto;
	}

	protected function getPuerto()
	{
		return $this -> puerto;
	}

	private function setDriver($driver)
	{
		$this -> driver = $driver;
	}

	protected function getDriver()
	{
		return $this -> driver;
	}

	protected function getPathLocal()
	{
		return $this -> pathLocal;
	}

	protected function getServerConect()
	{
		return $this -> getServer();
	}

	private function setServer($server)
	{
		$this -> server = $server;
	}

	protected function getServer()
	{
		return $this -> server;
	}

	private function setUser($user)
	{
		$this -> user = $user;
	}

	protected function getUser()
	{
		return $this -> user;
	}

	protected function getUserConect()
	{
		return $this -> getUser();
	}

	private function setPass($password)
	{
		$this -> password = $password;
	}

	private function getPass()
	{
		return $this -> password;
	}

	protected function getPassConect()
	{
		return $this -> getPass();
	}

	private function setDataBase($dataBase)
	{
		$this -> database = $dataBase;
	}

	protected function getDataBase()
	{
		return $this -> database;
	}

	protected function getDataBaseConect()
	{
		return $this -> getDataBase();
	}

	private function setDb($dbConection)
	{
		$this -> db = $dbConection;
	}

	private function getDb()
	{
		return $this -> db;
	}

	private function setDbConect($conection)
	{
		$this -> dbConect = $conection;
		//Se crea la variable de conexion a nivel Global para la peticion actual.
		Global $gblConection;

		$gblConection = $conection;
	}

	protected function getDbConect()
	{
		return $this -> dbConect;
	}

	public function getConect()
	{
		return $this -> getDb();
	}

	public function setConect($dbConection)
	{
		$this -> setDb($dbConection);
	}

	public function setDbConection($conection)
	{
		$this -> setDbConect($conection);
	}

	public function getDbConection()
	{
		return $this -> getDbConect();
	}

	public function setClassAdDb($classAdoDb)
	{

		$this -> classAdoDb = $classAdoDb;
	}

	protected function getClassAdDb()
	{

		return $this -> classAdoDb;
	}

	protected function setParamExecute($paramExcecute)
	{

		$this -> paramExcecute = $paramExcecute;
	}

	protected function getParamExecute()
	{

		return $this -> paramExcecute;
	}

	protected function setCharSet($charSet)
	{

		$this -> charset = $charSet;
	}

	protected function getCharSet()
	{

		return $this -> charset;
	}

	protected function setStrip_tags($strip_tags)
	{

		$this -> strip_tags = $strip_tags;
	}

	protected function getStrip_tags()
	{

		return $this -> strip_tags;
	}

	protected function setExcep_tags($except_tags)
	{

		$this -> excep_tags = $except_tags;
	}

	protected function getExcep_tags()
	{

		return $this -> excep_tags;
	}
}