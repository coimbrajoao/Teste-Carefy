<?php 

require_once __DIR__ . '/vendor/autoload.php';

use Alura\Mvc\Entity\Video;
use Alura\Mvc\Repository\VideoRepository;

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

    echo "Conexão com o banco de dados estabelecida com sucesso!";
} catch (PDOException $e) {
    die('Erro na conexão com o banco de dados: ' . $e->getMessage());
}

$pdo->exec('ALTER TABLE censo ADD COLUMN guia VARCHAR(255) NOT NULL;');
