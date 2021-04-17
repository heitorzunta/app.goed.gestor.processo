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

    $ata2 = new ATA(
        '6662021',
        '3332020',
        '2021-12-25',
        12,
        12345.00,
        'Transporte'
    );

    $ata3 = new ATA(
        '1234567',
        '1234567',
        '1900-01-01',
        10,
        10,
        'Esta é a funcao',
        0,
        '',
        1
    );

    $connection = ConnectionFactory::connection();

    $repositorio = new RepositoryATAs($connection);

    # INSERIR OBJETOS NO BANCO RELACIONAL
    // $repositorio->adicionar($ata);
    // $repositorio->adicionar($ata2);
    $repositorio->adicionar($ata3);


    #LISTAR OBJETOS DO BANCO RELACIONAL
    $lista = $repositorio->listarTodas();
    var_dump($lista);
    echo ('--------------------'). PHP_EOL;

    echo($repositorio->excluir($ata3));
    $lista = $repositorio->listarTodas();
    var_dump($lista);

} catch (DomainException $e){
    echo ("ERRO {$e->getMessage()}");
} finally {
    $connection = null;
}
?>