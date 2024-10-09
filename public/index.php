<?php

declare(strict_types=1);

// Habilitar exibição de erros durante o desenvolvimento
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

use Carefy\Mvc\Controller\{CensoListController, CensoController};
use Carefy\Mvc\Repository\censoRepository;

// Autoload do Composer
require_once __DIR__ . '/../vendor/autoload.php';

$host = 'localhost'; // ou o host do seu servidor MySQL
$port = '3306'; // porta padrão do MySQL
$dbname = 'carefyteste'; // substitua pelo nome do seu banco de dados
$user = 'root'; // substitua pelo seu usuário do MySQL
$pass = '36634497'; // substitua pela sua senha do MySQL

try {
    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";
    $pdo = new PDO($dsn, $user, $pass);
    // Configura o modo de erro do PDO para exceções
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //echo "Conexão com o banco de dados estabelecida com sucesso!";
} catch (PDOException $e) {
    die('Erro na conexão com o banco de dados: ' . $e->getMessage());
}

$censoRepo = new CensoRepository($pdo);
// Iniciar a sessão
session_start();

// Carregar as rotas
$routes = require_once __DIR__ . '/../config/routes.php';

// Obter o método e URI atual
$method = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);


// Remove o prefixo, se houver (ajuste conforme necessário)
$basePath = ''; // Se estiver em uma subpasta, ajuste aqui
if (strpos($uri, $basePath) === 0) {
    $uri = substr($uri, strlen($basePath));
}

// Buscar a rota correspondente
$key = "$method|$uri"; // Corrigido para usar as variáveis corretas

if (array_key_exists($key, $routes)) {
    $controllerClass = $routes[$key];

    switch ($controllerClass) {
        case CensoController::class:
            $controller = new $controllerClass($censoRepo);
            break;
        case CensoListController::class:
            $controller = new $controllerClass($censoRepo);
            break;
        default:
            header("HTTP/1.0 404 Not Found");
            echo "404 Not Found";
            exit();
    }

    /** @var Controller $controller */
    $controller->processaRequisicao();
} else {
    header("HTTP/1.0 404 Not Found");
    echo "404 Not Found"; // Adicionando resposta para rota não encontrada
    exit();
}
