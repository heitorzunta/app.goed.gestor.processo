<?php
/**
 * Classe que implementa a Interface da regra de negócios ATARepository
 */

namespace Infrastructure\Persistence\Repository;

use Model\Classes\ATA;
use Model\Repository\ATARepository;
use PDO;
use PDOStatement;

class RepositoryATAs
{

    private PDO $conn;

    public function __construct(PDO $connection)
    {
        $this->conn = $connection;
    }

    //Funcao de adicao ao banco
    public function adicionar(ATA $ata): bool
    {
        $sqlInsert = 'INSERT INTO ATA (
            numero_ata, 
            pregao_ata, 
            dtInicio_ata, 
            vigencia_ata, 
            valor_ata, 
            funcao_ata, 
            descricao_ata, 
            estado_ata, 
            aditamento_ata
            ) VALUES (
                :numero, 
                :pregao, 
                :dataInicio, 
                :vigencia, 
                :valor, 
                :funcao, 
                :descricao, 
                :estado, 
                :aditamento
            );';
        $sttm = $this->conn->prepare($sqlInsert);
        $sttm->bindValue(':numero', $ata->getNumero());
        $sttm->bindValue(':pregao', $ata->getPregao());
        $sttm->bindValue(':dataInicio', $ata->getDataInicio()->format('Y-m-d'));
        $sttm->bindValue(':vigencia', $ata->getVigencia());
        $sttm->bindValue(':valor', $ata->getValor());
        $sttm->bindValue(':funcao', $ata->getFuncao());
        $sttm->bindValue(':descricao', $ata->getDescricao());
        $sttm->bindValue(':estado', $ata->getEstado());
        $sttm->bindValue(':aditamento', $ata->getAditamento());
        return $sttm->execute();
    }

    //Excluir Ata listada do Bando de Dados
    public function excluir(ATA $ata): bool{
        $sqlDelete = 'DELETE FROM ATA 
        WHERE numero_ata LIKE :numeroAta';

        $sttm = $this->conn->prepare($sqlDelete);
        $sttm->bindValue('numeroAta', $ata->getNumero());
        return $sttm->execute();

    }

    //funcao de listar todos no banco
    public function listarTodas(): array
    {
        $sqlListAll = 'SELECT * FROM ATA';
        $sttm = $this->conn->query($sqlListAll);
        return $this->hydratateATAList($sttm);
    }

    //Listar todas as ATAS ATIVAS
    public function listarTodasAtivas(): array
    {
        $sqlAtiva = 'SELECT * FROM ATA 
        WHERE estado_ata = 1';

        $sttm = $this->conn->query($sqlAtiva);
        return $this->hydratateATAList($sttm);
    }

    //Funcao de hidratacao de elementos do banco para objetos
    public function hydratateATAList(PDOStatement $sttm): array
    {
        $listaATA  = [];
        while ($ATADado = $sttm->fetch(PDO::FETCH_ASSOC)){
            $listaATA[] = new ATA (
            $ATADado['numero_ata'],
            $ATADado['pregao_ata'],
            $ATADado['dtInicio_ata'],
            $ATADado['vigencia_ata'],
            $ATADado['valor_ata'],
            $ATADado['funcao_ata'],
            $ATADado['estado_ata'],
            $ATADado['descricao_ata'],
            $ATADado['aditamento_ata']
            );
        }
        return $listaATA;
    }

}

?>