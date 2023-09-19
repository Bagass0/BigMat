<?php

$v1 = 2;
$v2 = 8;
$v3 = 32;
$v4 = 128;
$v5 = 512;

class Database{

	public static function getMysqli(){
		$env = 'dev';

		$db_dev = array("host" => "localhost", "port" => "3306", "dbname" => "AbeilleAssurances", "login" => "root", "password" => "root");

		$db_preprod = array("host" => "51.75.128.122", "port" => "3306", "dbname" => "AbeilleAssurances", "login" => "AbeilleAssurances", "password" => "Rg15Rt6_lrh4Er");

		$db_prod = array("host" => "51.75.128.122", "port" => "3306", "dbname" => "AbeilleAssurances", "login" => "AbeilleAssurances", "password" => "Rg15Rt6_lrh4Er");

		switch($env){
			case 'dev':
				$connection = $db_dev;
				break;

			case 'preprod':
				$connection = $db_preprod;
				break;

			case 'prod':
				$connection = $db_prod;
				break;
			default:
				die("Erreur de configuration de la base de données");
		}

		$db = new mysqli($connection['host'], $connection['login'], $connection['password'], $connection["dbname"], $connection['port']);

		mysqli_query($db, "SET NAMES 'utf8'");
		mysqli_query($db, "SET CHARACTER SET utf8");
		mysqli_query($db, "SET SESSION collation_connection = 'utf8_unicode_ci'");
        mysqli_query($db, "SET time_zone = '+01:00'");

		if ($db->connect_error) {
			die("Erreur de configuration de la base de données");
		}

		return $db;
	}
}

?>