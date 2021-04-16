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


			$request = 'CREATE IF NOT EXISTS TABLE ATA (numero_ata TEXT PRIMARY KEY,
							pregao_ata TEXT, 
							dtInicio_ata TEXT, 
							vigencia_ata INTEGER, 
							valor_ata TEXT, 
							funcao_ata TEXT, 
							descricao_ata TEXT, 
							estado_ata INTEGER, 
							aditamento_ata INTEGER)';

			$pdo->exec($request);

			return $pdo;

		} catch (PDOException $e) {
			echo ('ERRO = ' . $e->getMessage());
		}
	}

}

?>