<?php

use PHPUnit\Framework\TestCase;
use farenas\AdodbConect\ClassAdodb\AdodbConect;
use farenas\Tests\FunctionGeneral;

class AdodbConectTest extends TestCase {

    public function test_adodbConect_getConnectionOracle()
    {

        $driver = 'oracle'; 
        $server = 'bdpruora03.intracoomeva.com.co';
        $puerto = '1574';
        $user   = 'PAC';
        $password = 'P4c*d3sar';
        $database = 'PRUORA03';

        $db = (new AdodbConect($driver, $server, $puerto, $user, $password, $database))->getConnection();

        $this->assertInstanceOf('ADODB_oci8po',$db);

        $db2 = (new AdodbConect($driver, $server, $puerto, $user, $password, $database))->getConnection();

        $this->assertInstanceOf('ADODB_oci8po',$db2);
    }

    public function test_adodbConect_getQueryPackageOracle()
    {

        $driver = 'oracle'; 
        $server = 'bdpruora03.intracoomeva.com.co';
        $puerto = '1574';
        $user   = 'PAC';
        $password = 'P4c*d3sar'; 
        $database = 'PRUORA03';
        $codUsuario = 3;
        $codEmpresa = 1;

        $paramAdoDb = [
			'cursor' => true,
			'plsql'  => 'Pac$_SndSeguridad.Fn_ConsultaMenu(:codUsuario, :codEmpresa);',
			'datos'  => [
				'codUsuario' => $codUsuario,
                'codEmpresa' => $codEmpresa
			]
        ];

        $resp = (new AdodbConect($driver, $server, $puerto, $user, $password, $database))->param($paramAdoDb)->run();

        $this->assertTrue((new FunctionGeneral)->isArray($resp,['resp','datos']));

        $paramAdoDb = [
			'cursor' => true,
			'plsql'  => 'Pac$_SndSeguridad.Fn_ConsultaMenu(:codUsuario, :codEmpresa, :datosss);',
			'datos'  => [
				'codUsuario' => $codUsuario,
                'codEmpresa' => $codEmpresa,
                'datosss' => 'ErrorDB',
			]
        ];

        $resp = (new AdodbConect($driver, $server, $puerto, $user, $password, $database))->param($paramAdoDb)->run();

        $this->assertTrue((new FunctionGeneral)->isArray($resp,['resp','errordb']));
    }

    public function test_adodbConect_getTransactionPackageOracle()
    {

        $driver = 'oracle'; 
        $server = 'bdpruora03.intracoomeva.com.co';
        $puerto = '1574';
        $user   = 'PAC';
        $password = 'P4c*d3sar'; 
        $database = 'PRUORA03';
        $codUsuario = 3;
        $codEmpresa = 1;

        $paramAdoDb = [
			'cursor' => true,
			'plsql'  => 'Pac$_SndSeguridad.Fn_ConsultaMenu(:codUsuario, :codEmpresa);',
			'datos'  => [
				'codUsuario' => $codUsuario,
                'codEmpresa' => $codEmpresa
			]
        ];

        $resp = (new AdodbConect($driver, $server, $puerto, $user, $password, $database))->param($paramAdoDb)->run();

        $this->assertTrue((new FunctionGeneral)->isArray($resp,['resp','datos']));
    }
}