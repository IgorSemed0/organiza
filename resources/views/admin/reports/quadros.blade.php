<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Quadros</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Relatório de Quadros</h1>
    <p>Data do relatório: {{ now()->format('d/m/Y') }}</p>
    
    <!-- Display applied filters -->
    @if (request('workplace_id'))
        <p>Filtrado por Espaço de Trabalho: {{ $workplaces->find(request('workplace_id'))->vc_nome }}</p>
    @endif
    @if (request('data_criacao_de'))
        <p>Filtrado por Data de Criação a partir de: {{ request('data_criacao_de') }}</p>
    @endif
    @if (request('data_criacao_ate'))
        <p>Filtrado por Data de Criação até: {{ request('data_criacao_ate') }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Espaço de Trabalho</th>
                <th>Criador</th>
                <th>Data de Criação</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($quadros as $quadro)
                <tr>
                    <td>{{ $quadro->id }}</td>
                    <td>{{ $quadro->vc_nome }}</td>
                    <td>{{ $quadro->workplace->vc_nome ?? 'N/A' }}</td>
                    <td>{{ $quadro->user_criador->vc_nome ?? 'N/A' }}</td>
                    <td>{{ $quadro->created_at->format('d/m/Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>