<?php 

declare(strict_types=1);

namespace Carefy\Mvc\Entity;

use DateTime;
use DateTimeImmutable;

class censo
{
    private readonly ?int $id;
    private readonly string $nome;
    private readonly DateTime $nascimento;
    private readonly string $codigo;
    private readonly string $guia;
    private readonly DateTime $entrada;
    private readonly ?DateTime $saida;

    public function __construct(
        string $nome,
        DateTime $nascimento,
        string $codigo,
        string $guia,
        DateTime $entrada,
        ?DateTime $saida = null, 
        ?int $id = null
    )
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->nascimento = $nascimento;
        $this->codigo = $codigo;
        $this->guia = $guia;
        $this->entrada = $entrada;
        $this->saida = $saida; 
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getNascimento(): DateTime
    {
        return $this->nascimento;
    }

    public function getCodigo(): string
    {
        return $this->codigo;
    }

    public function getGuia(): string
    {
        return $this->guia;
    }

    public function getEntrada(): DateTime
    {
        return $this->entrada;
    }

    public function getSaida(): ?DateTime // Corrigido para "getSaida"
    {
        return $this->saida;
    }
}
