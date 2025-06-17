<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Espaços de Trabalho</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Relatório de Espaços de Trabalho</h1>
    <p>Data do relatório: {{ now()->format('d/m/Y') }}</p>
    
    <!-- Display applied filters -->
    @if (request('data_criacao_de'))
        <p>Filtrado por Data de Criação a partir de: {{ request('data_criacao_de') }}</p>
    @endif
    @if (request('data_criacao_ate'))
        <p>Filtrado por Data de Criação até: {{ request('data_criacao_ate') }}</p>
    @endif
    @if (request('visibilidade') && request('visibilidade') !== 'all')
        <p>Filtrado por Visibilidade: {{ request('visibilidade') }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Criador</th>
                <th>Data de Criação</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($workplaces as $workplace)
                <tr>
                    <td>{{ $workplace->id }}</td>
                    <td>{{ $workplace->vc_nome ?? 'N/A' }}</td>
                    <td>{{ $workplace->user_criador->vc_nome ?? 'N/A' }}</td>
                    <td>{{ $workplace->created_at ? $workplace->created_at->format('d/m/Y H:i') : 'N/A' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>