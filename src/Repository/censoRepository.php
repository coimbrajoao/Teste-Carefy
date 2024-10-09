<?php

namespace Carefy\Mvc\Repository;

use Carefy\Mvc\Entity\censo;
use PDO;
use PDOException;

class censoRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function Add(censo $censo)
    {
        $stmt = $this->pdo->prepare("INSERT INTO censos (nome, nascimento, codigo, guia, entrada, saida) VALUES (:nome, :nascimento, :codigo, :guia, :entrada, :saida)");
        $stmt->bindValue(':nome', $censo->getNome());
        $stmt->bindValue(':nascimento', $censo->getNascimento()->format('Y-m-d'));
        $stmt->bindValue(':codigo', $censo->getCodigo());
        $stmt->bindValue(':guia', $censo->getGuia());
        $stmt->bindValue(':entrada', $censo->getEntrada()->format('Y-m-d'));
        $stmt->bindValue(':saida', $censo->getSaida()->format('Y-m-d'));

        try {

            $stmt->execute();
        } catch (PDOException $e) {
            throw new \RuntimeException('Erro ao adicionar censo', 0, $e);
        }

        $id = intval($this->pdo->lastInsertId());

        return new censo(
            nome: $censo->getNome(),
            nascimento: $censo->getNascimento(),
            codigo: $censo->getCodigo(),
            guia: $censo->getGuia(),
            entrada: $censo->getEntrada(),
            saida: $censo->getSaida(),
            id: $id
        );
    }

    public function GetAll(int $page = 1, int $limit = 10): array
    {
        $offset = ($page - 1) * $limit;

        // Buscar os registros com limite e offset
        $stmt = $this->pdo->prepare("SELECT * FROM censos LIMIT :limit OFFSET :offset");
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        $censo = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $censo[] = new censo(
                nome: $row['nome'],
                nascimento: new \DateTime($row['nascimento']), // Converte string para DateTime
                codigo: $row['codigo'],
                guia: $row['guia'],
                entrada: new \DateTime($row['entrada']), // Converte string para DateTime
                saida: !empty($row['saida']) ? new \DateTime($row['saida']) : null, // Converte string para DateTime, se não estiver vazio
                id: $row['id']
            );
        }
        return $censo;
    }

    public function countAll(): int
    {
        $stmt = $this->pdo->query("SELECT COUNT(*) FROM censos");
        return (int) $stmt->fetchColumn();
    }
}