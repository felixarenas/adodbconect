<?php
namespace farenas\AdodbConect\ClassAdodb;

use Carbon\Carbon;
use Cache\Adapter\PHPArray\ArrayCachePool;
use farenas\AdodbConect\ClassAdodb\TraitAdodbConnect;
use farenas\AdodbConect\ClassAdodb\seterGeterAdodbConectClass;

class AdodbConect extends seterGeterAdodbConectClass
{

	use TraitAdodbConnect;

	public function __construct()
	{

		$driver = config('dbConfig.DB_DRIVER');
        $server = config('dbConfig.DB_HOST');
        $puerto = config('dbConfig.DB_PORT');
        $user = config('dbConfig.DB_USERNAME');
        $password = config('dbConfig.DB_PASSWORD');
        $database = config('dbConfig.DB_DATABASE');

		$this->setParameter($driver, $server, $puerto, $user, $password, $database);
	}

	private function setParameter($driver, $server, $puerto, $user, $password, $database)
	{

		if ($driver == 'oracle' || $driver == 'ORACLE') {

			$driver = 'oci8po';
		}

		parent::__construct($driver, $server, $puerto, $user, $password, $database);
	}

	public function param($paramExecute)
	{

		$this -> setParamExecute($paramExecute);

		if ($this -> getClassAdDb() instanceof AdodbConect) {

			return $this -> getClassAdDb();
		}

		$this -> setClassAdDb($this);

		return $this -> getClassAdDb();
	}

	public function run()
	{

		$indTrans = false;

		$Cache = new ArrayCachePool();

		if ($Cache->hasItem('dbConect') == true) {

			$indTrans = true;
		}

		$db = $this -> getAdodbConect();

		$paramExecute = $this -> getParamExecute();

		if (array_key_exists('paramError' , $paramExecute) === true) {

			if (array_key_exists('paramTransaction' , $paramExecute) === true) {

				$paramTrasn = $paramExecute['paramTransaction'];

				if ($paramTrasn === 'inicio') {

					$flagTrans = true;

					$item = $Cache->getItem('dbConect')->set($flagTrans);

					$Cache->save($item);

					if ($db->IsConnected()) {

						$db -> StartTrans();
					} else {

						throw new \Exception('No está conectado a la base de datos');
					}
				}
			}else{

				if (!$indTrans ) {

					if (!$db->IsConnected()) {
			
						throw new \Exception('No está conectado a la base de datos');
					} else {

						$db -> StartTrans();
					}
				}

			}
		}

        $codError = null;

        $msgError = null;

        $cur_tipo = null;

		if (array_key_exists('datos' , $paramExecute) === false) {

			throw new \Exception('AdodbConnect Necesita del parámetro datos para funcionar correctamente');
		}
		
		$resp['resp'] = true;

		$plsql = '';

		$jsonIn = '';

		$jsonOut = '';

		if (array_key_exists('cursor' , $paramExecute) === true) {

			if ($paramExecute['cursor'] === true) {

				$plsql .= 'begin :datos := ' . $paramExecute['plsql'] . ' end;';
			} else {

				$plsql .= 'begin ' . $paramExecute['plsql'] . ' end;';
			}
		}

		$param = $paramExecute['datos'];

		if (!is_array($param)) {

			$resp['resp'] = false;

			return $resp;
		}

		if (array_key_exists('jsonIn' , $paramExecute) === true) {

			$jsonIn = $paramExecute['jsonIn'];
		}

		if (array_key_exists('jsonOut' , $paramExecute) === true) {
			
			$jsonOut = $paramExecute['jsonOut'];
		}

		$stmt = $db->PrepareSP($plsql);

		foreach ($param as $key => $item) {

			if (strpos($plsql, $key) != false) {

				eval('$'.$key.' = $item;');

				if ($key == $jsonIn) {

					$cadParam = '$db->Parameter($stmt, $'.$key.', "'.$key.'",false, 300000, OCI_B_CLOB);';
				} else if ($key == $jsonOut) {

					$cadParam = '$db->Parameter($stmt, $'.$key.', "'.$key.'",true, 300000, OCI_B_CLOB);';
				} else {

					$cadParam = '$db->Parameter($stmt, $'.$key.', "'.$key.'");';
				}

				eval($cadParam);
			} else {

				throw new \Exception("El parámetro (".$key.") no se pudo determinar en el PLSQL ".$paramExecute['plsql']);
			}
		}

		if (array_key_exists('cursor' , $paramExecute) === true) {

			if ($paramExecute['cursor'] === true) {

				$db->Parameter($stmt, $cur_tipo, "datos", false, -1, OCI_B_CURSOR);
			}
		}

		if (array_key_exists('paramOut' , $paramExecute) === true) {

			$paramOut = $paramExecute['paramOut'];

			foreach ($paramOut as $key => $item) {

				$cadParam = '$db->Parameter($stmt, $'.$item.', "'.$item.'");';

				eval($cadParam);
			}
		}

		if (array_key_exists('paramError' , $paramExecute) === true) {

			if ($paramExecute['paramError'] === true) {

				$db->Parameter($stmt, $codError, "numError");

				$db->Parameter($stmt, $msgError, "msgError");
			}
		}

		$rs = $db->Execute($stmt);

		$errorTrans = true;

		if (!$rs) {

			$resp['resp'] = false;

			$resp['errordb'] = $this -> procesarError($db);

			if (array_key_exists('paramError' , $paramExecute) === true){

				$db -> RollbackTrans();

				if (Cache::has('dbConect') == true) {

					Cache::forget('dbConect');
				}

			}

			return $resp;
		}

		if (array_key_exists('cursor' , $paramExecute) === true) {

			$resp['datos'] = $rs->getRows();
		}

		if (array_key_exists('paramOut' , $paramExecute) === true) {

			$paramOut = $paramExecute['paramOut'];

			$paramSalida = [];

			foreach ($paramOut as $key => $item) {

				$paramSalida[$item] = $$item;
			}

			$resp['respOut'] = $paramSalida;			
		}

		if (array_key_exists('paramError' , $paramExecute) === true) {

			if ($paramExecute['paramError'] === true) {

				if (!is_null($msgError)) {

					$resp['errordb'] = "[Código: " . $codError . "] " . $msgError;

					$db -> RollbackTrans();

					$errorTrans = false;

					if (Cache::has('dbConect') == true) {
					
						Cache::forget('dbConect');
					}
				}
			}
		}

		if (array_key_exists('paramError' , $paramExecute) === true && $errorTrans === true) {

			if (Cache::has('dbConect') == true) {

				if (array_key_exists('paramTransaction' , $paramExecute) === true) {

					$paramTrasn = $paramExecute['paramTransaction'];

					if($paramTrasn === 'fin'){

						if (!$db->IsConnected()) {
				
							throw new \Exception('No está conectado a la base de datos');
						} else {

							$db -> CompleteTrans();

							Cache::forget('dbConect');
						}
					}
				}
			} else {

				if (!$db->IsConnected()) {
		
					throw new \Exception('No está conectado a la base de datos');
				} else {

					$db -> CompleteTrans();
				} 
			}	
		}

		return $resp;
	}

	public function getConnection()
	{

		return $this -> getAdodbConect();
	}
}