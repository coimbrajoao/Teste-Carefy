<?php
$dados = $_SESSION['dados_importados'] ?? [];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Dados Importados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Dados Importados</h1>
        <?php if (!empty($dados)): ?>
            <table class="table table-striped" id="dataTable">
                <thead>
                    <tr>
                        <th>Paciente</th>
                        <th>Data de Nascimento</th>
                        <th>Código</th>
                        <th>Guia</th>
                        <th>Data de Entrada</th>
                        <th>Data de Saída</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dados as $linha): ?>
                        <tr>
                            <td><?= htmlspecialchars($linha['nome']) ?></td>
                            <td><?= htmlspecialchars($linha['nascimento']) ?></td>
                            <td><?= htmlspecialchars($linha['codigo']) ?></td>
                            <td><?= htmlspecialchars($linha['guia']) ?></td>
                            <td><?= htmlspecialchars($linha['entrada']) ?></td>
                            <td><?= htmlspecialchars($linha['saida']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="text-center mt-4">
                <form action="/gravar" method="POST">
                    <button type="submit" class="btn btn-primary">Gravar</button>
                </form>
            </div>
        <?php else: ?>
            <p class="text-center mt-4">Nenhum dado importado.</p>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
