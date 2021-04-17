<?php

use app\goed\gestor\processo\Infrasctruture\Persistence\ConnectionFactory;
use Infrastructure\Persistence\Repository\RepositoryATAs;
use Model\Classes\ATA;
require_once '/Users/heitorbatistelazunta/Desktop/Projetos_php/app.goed.gestor.processo/src/Model/Classes/ATA.php';
require_once '/Users/heitorbatistelazunta/Desktop/Projetos_php/app.goed.gestor.processo/src/Infrastructure/Repository/RepositoryATAs.php';
require_once '/Users/heitorbatistelazunta/Desktop/Projetos_php/app.goed.gestor.processo/src/Infrastructure/Persistence/ConnectionFactory.php';

try {
    $ata = new ATA(
        '0942020',
        '0552019',
        '2020-04-08',
        6,
        1254.04,
        'Aquisição de gêneros alimentícios'
    );

    $connection = ConnectionFactory::connection();

    $repositorio = new RepositoryATAs($connection);

    // $ata->setAditivo(3);
    // $repositorio->adicionar($ata);
    $lista = $repositorio->listarTodas();
    var_dump($lista);

} catch (DomainException $e){
    echo ("ERRO {$e->getMessage()}");
} finally {
    $connection = null;
}
?>