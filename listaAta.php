<?php

use app\goed\gestor\processo\Infrasctruture\Persistence\ConnectionFactory;
use Model\Classes\ATA;
require_once '/Users/heitorbatistelazunta/Desktop/Projetos_php/app.goed.gestor.processo/src/Infrastructure/Persistence/ConnectionFactory.php';
require_once '/Users/heitorbatistelazunta/Desktop/Projetos_php/app.goed.gestor.processo/src/Model/Classes/ATA.php';

$conn = ConnectionFactory::connection();


$sqlListAll = 'SELECT * FROM ATA';
$listAll = $conn->query($sqlListAll);
$atas = $listAll->fetchAll(PDO::FETCH_ASSOC);

foreach($atas as $ata){
    // echo ($ata['numero_ata']) . PHP_EOL;
    // echo ($ata['pregao_ata']) . PHP_EOL;
    // echo ($ata['dtInicio_ata']) . PHP_EOL;
    // echo ($ata['vigencia_ata']) . PHP_EOL;
    // echo ($ata['valor_ata']) . PHP_EOL;
    // echo ($ata['funcao_ata']) . PHP_EOL;
    // echo ($ata['descricao_ata']) . PHP_EOL;
    // echo ($ata['estado_ata']) . PHP_EOL;
    // echo ($ata['aditamento_ata']) . PHP_EOL;
    var_dump($ata);
}

?>