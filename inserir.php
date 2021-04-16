<?php

use app\goed\gestor\processo\Infrasctruture\Persistence\ConnectionFactory;
use Model\Classes\ATA;
require_once '/Users/heitorbatistelazunta/Desktop/Projetos_php/app.goed.gestor.processo/src/Infrastructure/Persistence/ConnectionFactory.php';
require_once '/Users/heitorbatistelazunta/Desktop/Projetos_php/app.goed.gestor.processo/src/Model/Classes/ATA.php';

$conn = ConnectionFactory::connection();


$ata = new ATA(
    '094/2020',
    '055/2019',
    '2020-04-08',
    6,
    '1254',
    'Aquisição de gêneros alimentícios'
);


var_dump($ata);


// $sqlInsert = 'INSERT INTO ATA (
//     numero_ata, 
//     pregao_ata, 
//     dtInicio_ata, 
//     vigencia_ata, 
//     valor_ata, 
//     funcao_ata, 
//     descricao_ata, 
//     estado_ata, 
//     aditamento_ata) VALUES (
//     :numero, 
//     :pregao,
//     :dataInicio,
//     :vigencia,
//     :valor, 
//     :funcao,
//     :descricao,  
//     :estado, 
//     :aditamento)
//     ';

$sqlInsert = 'INSERT INTO ATA (
    numero_ata, 
    pregao_ata, 
    dtInicio_ata, 
    vigencia_ata, 
    valor_ata, 
    funcao_ata, 
    descricao_ata, 
    estado_ata, 
    aditamento_ata) VALUES (
    ?, 
    ?,
    ?,
    ?,
    ?, 
    ?,
    ?,  
    ?, 
    ?)
    ';

 $sttm = $conn->prepare($sqlInsert);
 $sttm->bindParam('s', $ata->getNumero());    
// $sttm->bindValue(':numero', $ata->getNumero());
// $sttm->bindValue(':pregao', $ata->getPregao());
// $sttm->bindValue(':dataInicio', $ata->getDataInicio()->format('Y-m-d'));
// $sttm->bindValue(':vigencia', $ata->getVigencia());
// $sttm->bindValue(':valor', $ata->getValor());
// $sttm->bindValue(':descricao', $ata->getDescricao());
// $sttm->bindValue(':estado', $ata->getEstado());
// $sttm->bindValue(':aditamento', $ata->getAditamento());

?>