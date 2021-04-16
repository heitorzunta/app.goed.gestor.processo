<?php

use app\goed\gestor\processo\Infrasctruture\Persistence\ConnectionFactory;
use Infrastructure\Persistence\Repository\RepositoryATAs;
use Model\Classes\ATA;
require_once '/Users/heitorbatistelazunta/Desktop/Projetos_php/app.goed.gestor.processo/src/Model/Classes/ATA.php';
require_once '/Users/heitorbatistelazunta/Desktop/Projetos_php/app.goed.gestor.processo/src/Infrastructure/Repository/RepositoryATAs.php';
require_once '/Users/heitorbatistelazunta/Desktop/Projetos_php/app.goed.gestor.processo/src/Infrastructure/Persistence/ConnectionFactory.php';

try {
    $ata = new ATA(
        '094/2020',
        '055/2019',
        '2020-04-08',
        6,
        '1254',
        'Aquisição de gêneros alimentícios'
    );    


$connection = ConnectionFactory::connection();

$repositorio = new RepositoryATAs($connection);

var_dump($ata);
echo $ata->getValor() . PHP_EOL;
// die();

$repositorio->adicionar($ata);
//$repositorio->listarTodas();

} catch (DomainException $e){
    echo ("ERRO {$e->getMessage()}");
}
?>