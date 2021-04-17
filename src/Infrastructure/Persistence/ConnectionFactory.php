<?php

namespace app\goed\gestor\processo\Infrasctruture\Persistence;
use PDO;
use PDOException;

/**
 * Criando uma conexão com o banco SQLite por meu de PDO
 * Posteriormente pode-se torcar a conexão para o banco que convier.
 * @dbPatch diretorio onde encontra-se o banco no SQLite
 */

class ConnectionFactory {

	public static function connection() {
		$dbPatch = '/Users/heitorbatistelazunta/Desktop/Projetos_php/app.goed.gestor.processo/Data/DataBase.sqlite';
		$dsn = 'sqlite:' . $dbPatch;

		try {
			$pdo = new PDO($dsn);

			$request = 'CREATE TABLE IF NOT EXISTS ATA (
				numero_ata VARCHAR(8) PRIMARY KEY NOT NULL, 
				pregao_ata VARCHAR(8) NOT NULL, 
				dtInicio_ata DATE NOT NULL, 
				vigencia_ata INTEGER NOT NULL, 
				valor_ata DECIMAL NOT NULL, 
				funcao_ata VARCHAR(255), 
				descricao_ata VARCHAR(255), 
				estado_ata INTEGER, 
				aditamento_ata INTEGER
				)';

			$pdo->exec($request);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $pdo;

		} catch (PDOException $e) {
			echo ('ERRO = ' . $e->getMessage());
		}
	}

}

?>