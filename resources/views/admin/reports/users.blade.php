<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Utilizadores</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Relatório de Utilizadores</h1>
    <p>Data do relatório: {{ now()->format('d/m/Y') }}</p>
    
    <!-- Display applied filters -->
    @if (request('tipo_user_id'))
        <p>Filtrado por Tipo de Utilizador: {{ $tipos_user->find(request('tipo_user_id'))->vc_nome }}</p>
    @endif
    @if (request('data_registo_de'))
        <p>Filtrado por Data de Registo a partir de: {{ request('data_registo_de') }}</p>
    @endif
    @if (request('data_registo_ate'))
        <p>Filtrado por Data de Registo até: {{ request('data_registo_ate') }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Tipo de Utilizador</th>
                <th>Data de Criação</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->vc_nome }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->tipo_user->vc_nome ?? 'N/A' }}</td>
                    <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>