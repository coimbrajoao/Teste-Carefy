<?php

declare(strict_types=1);

namespace Carefy\Mvc\Controller;

use Carefy\Mvc\Entity\censo;
use DateTimeImmutable;
use Carefy\Mvc\Repository\censoRepository;

class CensoController implements Controller
{
    private censoRepository $repository;

    public function __construct(censoRepository $repository)
    {
        $this->repository = $repository;
    }
    public function processaRequisicao(): void
    {

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            if ($uri === '/importar') {
                $this->exibirFormulario();
            } elseif ($uri === '/visualizar') {
                $this->visualizarDados();
            } elseif ($uri === '/confirmacao') {
                $this->confirmarGravacao(); // Novo método para a tela de confirmação
            } else {
                header("HTTP/1.0 404 Not Found");
                echo "Página não encontrada";
            }
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) === '/importar') {
                $this->importarCsv();
            } elseif (parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) === '/gravar') {
                $this->gravarDados();
            } else {
                header("HTTP/1.0 404 Not Found");
                echo "Página não encontrada";
            }
        } else {
            header("HTTP/1.0 405 Method Not Allowed");
            echo "Método não permitido";
        }
    }

    private function exibirFormulario(): void
    {
        include __DIR__ . '/../../views/importar.php';
    }

    private function visualizarDados(): void
    {

        $dados = $_SESSION['dados_importados'] ?? [];
        include __DIR__ . '/../../views/visualizar.php';
    }

    private function importarCsv(): void
    {
        if (isset($_FILES['csvFile'])) {
            $file = $_FILES['csvFile']['tmp_name'];

            if (($handle = fopen($file, 'r')) !== false) {
                $data = [];
                $header = true;

                while (($row = fgetcsv($handle, 1000, ',')) !== false) {
                    if ($header) {
                        $header = false;
                        continue;
                    }
                    $data[] = [
                        'nome' => $row[0] ?? '',
                        'nascimento' => $row[1] ?? '',
                        'codigo' => $row[2] ?? '',
                        'guia' => $row[3] ?? '',
                        'entrada' => $row[4] ?? '',
                        'saida' => $row[5] ?? '',
                    ];
                }
                fclose($handle);

                $_SESSION['dados_importados'] = $data;

                header('Location: /visualizar');
            } else {
                header('Location: /importar');
            }
        } else {
            header('Location: /importar');
        }
        exit();
    }

    private function gravarDados(): void
    {
        if (!empty($_SESSION['dados_importados'])) {
            $numRegistros = 0;
            foreach ($_SESSION['dados_importados'] as $row) {

                $nascimento = \DateTime::createFromFormat('d/m/Y', $row['nascimento']);
                $entrada =\DateTime::createFromFormat('d/m/Y', $row['entrada']);
                $saida = !empty($row['saida']) ? \DateTime::createFromFormat('d/m/Y', $row['saida']) : null;

                // Verifica se a conversão foi bem-sucedida
                if (!$nascimento || !$entrada || ($saida && !$saida)) {
                    throw new \Exception('Erro ao converter data.');
                }
                $censoEntity = new censo(
                    nome: $row['nome'],
                    nascimento: $nascimento,
                    codigo: $row['codigo'],
                    guia: $row['guia'],
                    entrada: $entrada,
                    saida: $saida // Trocar para `saidapublic` se necessário
                );
                // Adiciona o censo ao repositório
                $this->repository->Add($censoEntity);
                $numRegistros++ ;
            }
            $_SESSION['num_registros'] = $numRegistros;
            unset($_SESSION['dados_importados']); // Limpa os dados importados da sessão
            header('Location: /confirmacao'); // Redireciona ou para onde desejar
            exit();
        } else {
            header("HTTP/1.0 400 Bad Request");
            echo "Não há dados para gravar.";
            exit();
        }
    }

    private function confirmarGravacao(): void
    {
        $numRegistros = $_SESSION['num_registros'] ?? 0;
        
        unset($_SESSION['num_registros']); // Limpa o número de registros da sessão

        include __DIR__ . '/../../views/confirmacao.php'; // Exibe a tela de confirmação
    }

}
