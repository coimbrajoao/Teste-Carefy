<?php 

require_once __DIR__ . '/vendor/autoload.php';

use Alura\Mvc\Entity\Video;
use Alura\Mvc\Repository\VideoRepository;

$host = 'localhost';
$port = '3306';
$dbname = 'CarefyTeste';
$user = 'root';
$pass = '36634497';

try {
    $dsn = "mysql:host=$host;port=$port;charset=utf8mb4";
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbname`");
    echo "Banco de dados `$dbname` verificado/criado com sucesso!<br>";

    
    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexão com o banco de dados `$dbname` estabelecida com sucesso!<br>";

    
    $pdo->exec('CREATE TABLE IF NOT EXISTS Censos (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(255) NOT NULL,
        nascimento DATE NOT NULL,
        codigo VARCHAR(255) NOT NULL,
        entrada DATE NOT NULL,
        saida DATE,
        guia VARCHAR(255) NOT NULL
    )');
    echo "Tabela `Censos` verificada/criada com sucesso!";
} catch (PDOException $e) {
    die('Erro na operação com o banco de dados: ' . $e->getMessage());
}
