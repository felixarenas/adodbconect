<?php
namespace farenas\AdodbConect\classAdodb;

use Exception as ExceptionAdodb;

trait TraitAdodbConnect
{

	public function getAdodbConect(){

		try {

			$nameInclude = 'adodb';

			if ($this -> includeClass($this -> getPathLocal(), $nameInclude)) {

				$nameInclude = 'adodb-active-record';

				if(!$this -> includeClass($this -> getPathLocal(), $nameInclude)){

					throw new ExceptionAdodb('No se pudo conectar a la Base de Datos por que el paquete de conexion es invalida');			
				}
			} else {

				throw new ExceptionAdodb('No se pudo conectar a la Base de Datos por que el paquete de conexion es invalida');
			}

			if (is_object($this -> getInstanceADO())) {

				$this -> conectDB();
				
				return $this -> getDbConection();
			} else {

				throw new ExceptionAdodb('No se pudo conectar a la Base de Datos por que el driver de conecion es invalido (' . $this->getDriver() . ' - '. $this->getUserConect() .' - ' . $this->getDataBaseConect() . ')');
			}
		} catch (ExceptionAdodb $e) {

			echo 'Excepción capturada: ',  $e->getMessage(), "\n";
		}
	}

	private function conectDB()
	{

		try {

			$db = null;

			if (array_key_exists('gblConection',$GLOBALS)) {

				$db = $GLOBALS['gblConection'];
			}

			if (!is_object($db)) {

				$dbConect = $this -> getConect();

				if ($this -> getDriver() === 'oci8po') {

					$server = $this -> getServerConect().':'.$this -> getPuerto();
				} else {

					$server = $this -> getServerConect();
				}

				$dbConect->charSet = $this -> getCharSet();

				$resp = $dbConect->Connect(
					$server,
					$this -> getUserConect(),
					$this -> getPassConect(),
					$this -> getDataBaseConect());

				if (!$resp) {

					throw new ExceptionAdodb('Fallo en la conexion a la base de datos ');
				} else {

					$dbConect->setFetchMode(ADODB_FETCH_ASSOC);

					$this -> setDbConection($dbConect);
				}
			} else {

				$this -> setDbConection($db);
			}
		} catch (ExceptionAdodb $e) {
		
			echo 'Excepción capturada: ',  $e->getMessage(), "\n";
		}
	}

	private function getInstanceADO()
    {

        if (!is_object($this -> getConect())) {

        	$this -> setConect(ADONewConnection($this -> getDriver()));
        }

        return $this -> getConect();
    }

	private function includeClass($path, $name)
	{

		$ret = false;

		$extensions = ['.inc.php', '.inc', '.php', '.class', '.class.php'];

		foreach ($extensions as $ext) {

			$fileName = $path . '/' . $name . $ext;

			if(file_exists($fileName)){

				$ret = true;

				require_once($fileName);

				break;
			}
		}

		return $ret;
	}

	public function procesarError($db) {

		$dbMsg = $db->ErrorMsg();

		$arrDBMsg = explode(':', $dbMsg);

		$error[0] = trim($arrDBMsg[0]);

		$errors['codigo'] = $error[0];

		$arrAppMsg = explode("ORA", $arrDBMsg[1]);

		$error[1] = trim(addcslashes(str_replace("\n", "\\n", $arrAppMsg[0]), "'"));

		$errors['mensaje'] = $error[1];

		$errors['mensajeCompleto'] = addcslashes(str_replace("\n", "\\n", $dbMsg), "'");

		return $errors;
	}
}