<?php
/** @var \Carefy\Mvc\Entity\censo[] $censos   */
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Importar CSV</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Sistema de Internações</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/importar">Importar CSV</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h2>Dados já importados</h2>

        <!-- Grid de dados -->
        <table class="table table-striped" id="dataTable">
            <thead>
                <tr>
                    <th>Paciente</th>
                    <th>Data de Nascimento</th>
                    <th>Codigo</th>
                    <th>Guia</th>
                    <th>Data de Entrada</th>
                    <th>Data de Saida</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($censos as $linha): ?>
                    <tr>
                        <td><?= htmlspecialchars($linha->getNome()) ?></td>
                        <td><?= htmlspecialchars($linha->getNascimento()->format('d/m/Y')) ?></td>
                        <!-- Supondo que nascimento seja um objeto DateTime -->
                        <td><?= htmlspecialchars($linha->getCodigo()) ?></td>
                        <td><?= htmlspecialchars($linha->getGuia()) ?></td>
                        <td><?= htmlspecialchars($linha->getEntrada()->format('d/m/Y')) ?></td>
                        <!-- Supondo que entrada seja um objeto DateTime -->
                        <td><?= htmlspecialchars($linha->getSaida() ? $linha->getSaida()->format('d/m/Y') : 'N/A') ?></td>
                        <!-- Verifica se saida é nulo -->
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="pagination">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?page=<?= $i ?>" class="btn btn-secondary <?= $i === $page ? 'active' : '' ?>"><?= $i ?></a>
            <?php endfor; ?>
        </div>
    </div>
</body>

</html>