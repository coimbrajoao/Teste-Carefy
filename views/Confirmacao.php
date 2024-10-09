<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmação de Gravação</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center text-success">Gravação Concluída</h1>
        <p class="text-center">Os dados foram gravados com sucesso!</p>
        <p class="text-center">Número de registros gravados: <strong><?php echo htmlspecialchars($numRegistros); ?></strong></p>
        <div class="text-center mt-4">
            <a href="/" class="btn btn-primary">Voltar para Visualizar</a>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>