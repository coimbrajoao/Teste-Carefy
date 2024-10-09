<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Importar CSV</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Importar Arquivo CSV</h1>
        <!-- Formulário para envio do arquivo CSV -->
        <form action="/importar" method="post" enctype="multipart/form-data" class="mt-4">
            <div class="mb-3">
                <label for="csvFile" class="form-label">Escolha um arquivo CSV:</label>
                <input type="file" id="csvFile" name="csvFile" accept=".csv" required class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Importar</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
