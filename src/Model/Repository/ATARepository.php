<?php
namespace Model\Repository;
use Model\Classes\ATA;

/* 
 * Interface de modelo padrao para Repositorio de ATAS
 * trazendo com salvar, deletar, editar e pesquisar
 */


interface ATARepository
{
    public function adicionar(ATA $ata);
    public function excluir(ATA $ata);
    public function editar(ATA $ata);
    public function vencimentosMes(int $mes);
    public function listarTodas();
    public function listarTodasAtivas();
}
?>