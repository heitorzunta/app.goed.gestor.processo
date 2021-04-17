<?php

namespace Model\Classes;

use DateInterval;
use DateTime;
use DateTimeImmutable;
use DomainException;
use Exception;

class ATA {

	# Atributo
	private string $numero;
	private string $pregao;
	private DateTimeImmutable $dataInicio;
	private int $vigencia;
	private float $valor;
	private string $funcao; //indica para que serve a ATA
	private string $descricao;
	private bool $estado;
	private int $aditamento;

	# construtor

	public function __construct(
		string $numero,
		string $pregao,
		string $dataInicio,
		int $vigencia,
		float $valor,
		string $funcao,
		?string $descricao = '',
		?int $estado = 1,
		?int $aditamento = 0
	) {
		$this->setNumero($numero);
		$this->setPregao($pregao);
		$this->setDataInicio($dataInicio);
		$this->setVigencia($vigencia);
		$this->setValor($valor);
		$this->setFuncao($funcao);
		$this->setEstado($estado);
		$this->aditamento = $aditamento;
		$this->setDescricao($descricao);
	}

	# Métodos de acesso e encapsulamento

	public function setFuncao(string $funcao): void{
		$this->funcao = $funcao;
	}

	public function getFuncao(): string {
		return $this->funcao;
	}

	public function setNumero(string $numero): void {
		if (strlen($numero) != 7) {
			throw new Exception('Número de ATA incorreto!');
		}
		$this->numero = $numero;
	}

	public function getNumero(): string{
		return $this->numero;
	}

	public function setPregao(string $pregao): void {
		if (strlen($pregao) != 7) {
			throw new DomainException('Número de Pregão incorreto!');
		}
		$this->pregao = $pregao;
	}

	public function getPregao(): string{
		return $this->pregao;
	}

	public function setDataInicio(string $dataInicio): void{
		#ajustar timezone
		$dataInicio = new DateTimeImmutable($dataInicio);

		$this->dataInicio = $dataInicio;
	}

	public function getDataInicio(): DateTimeImmutable {
		return $this->dataInicio;
	}

	public function setVigencia(int $vigencia): void{
		$this->vigencia = $vigencia;
	}

	public function getVigencia(): int {
		return $this->vigencia;
	}

	public function setValor(float $valor): void{
		$this->valor = $valor;
	}

	public function getValor(): float{
		return $this->valor;
	}

	public function setDescricao(string $descricao): void{
		if($descricao == ''){
			$this->descricao = '';
		} else {
			$this->descricao = $this->descricao . $descricao;
		}
	}

	public function getDescricao(): string {
		return $this->descricao;
	}

	public function setEstado(int $estado): void{
		$this->estado = $estado;
	}

	public function getEstado(): bool {
		return $this->estado;

	}

	// Aditivos podes ser de tempo e valor
	public function setAditivo(int $aditivo): void{
		$tempoTotal = $this->getVigencia() + $aditivo;

		if ($tempoTotal > 12) {
			throw new DomainException('PRAZO DE ADICAO SUPERIOR AO PERMITIDO');
		}

		$vigenciaNova = $this->getVigencia() + $aditivo;
		$this->setVigencia($vigenciaNova);
		$this->aditamento++;

		$descricao = "{$this->getAditamento()}-TERMO ADITIVO - ADICAO DE {$aditivo} MESES, ";
		$this->setDescricao($descricao);

	}

	public function getAditamento(): int {
		return $this->aditamento;
	}

	public function dtTermino(): string{
		$interval = new DateInterval("P{$this->getVigencia()}M");
		$date = new DateTime($this->getDataInicio());
		$date->add($interval);
		return $date->format('d-m-Y');
	}

	public function __toString(): string {
		return "
        ATA\n
        NUMERO = {$this->getNumero()}\t
        PREGAO = {$this->getPregao()}\t
        FUNCAO DA ATA = {$this->getFuncao()}\t
        VALOR = {$this->getValor()}\t
        VIGENCIA TOTAL = {$this->getVigencia()} MESES\t
        VENCIMENTO = {$this->dtTermino()}\t
        ESTADO = {$this->getEstado()}\t
        DESCRIÇÃO = {$this->getDescricao()}\t
        ATUAL TERMO ADITIVO = {$this->getAditamento()} TERMO\n
        ";
	}
}

?>