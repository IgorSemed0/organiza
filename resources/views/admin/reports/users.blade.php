<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Utilizadores</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; font-weight: bold; }
        .header { margin-bottom: 20px; }
        .filters { background-color: #f9f9f9; padding: 10px; margin: 10px 0; border-left: 4px solid #007cba; }
        .filters h3 { margin: 0 0 10px 0; color: #007cba; }
        .filter-item { margin: 3px 0; }
        .summary { display: flex; justify-content: space-between; margin: 15px 0; }
        .summary-item { text-align: center; }
        .verified { color: green; font-weight: bold; }
        .unverified { color: red; font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Relatório de Utilizadores</h1>
        <p><strong>Data do relatório:</strong> {{ now()->format('d/m/Y H:i') }}</p>
        <p><strong>Total de registos:</strong> {{ count($users) }}</p>
    </div>
    
    <!-- Display applied filters -->
    @if (request()->hasAny(['tipo_user_id', 'data_registo_de', 'data_registo_ate', 'email_verified', 'nome', 'dominio_email', 'sort_by']))
        <div class="filters">
            <h3>Filtros Aplicados:</h3>
            
            @if (request('tipo_user_id') && request('tipo_user_id') !== 'all')
                <div class="filter-item">
                    <strong>Tipo de Utilizador:</strong> {{ $tipos_user->find(request('tipo_user_id'))->vc_nome ?? 'N/A' }}
                </div>
            @endif
            
            @if (request('data_registo_de'))
                <div class="filter-item">
                    <strong>Data de Registo a partir de:</strong> {{ \Carbon\Carbon::parse(request('data_registo_de'))->format('d/m/Y') }}
                </div>
            @endif
            
            @if (request('data_registo_ate'))
                <div class="filter-item">
                    <strong>Data de Registo até:</strong> {{ \Carbon\Carbon::parse(request('data_registo_ate'))->format('d/m/Y') }}
                </div>
            @endif
            
            @if (request('email_verified') !== '')
                <div class="filter-item">
                    <strong>Status de Verificação:</strong> 
                    @if (request('email_verified') === 'verified')
                        Email Verificado
                    @elseif (request('email_verified') === 'unverified')
                        Email Não Verificado
                    @endif
                </div>
            @endif
            
            @if (request('nome'))
                <div class="filter-item">
                    <strong>Nome contém:</strong> "{{ request('nome') }}"
                </div>
            @endif
            
            @if (request('dominio_email'))
                <div class="filter-item">
                    <strong>Domínio de Email:</strong> @{{ request('dominio_email') }}
                </div>
            @endif
            
            @if (request('sort_by'))
                <div class="filter-item">
                    <strong>Ordenado por:</strong> 
                    @switch(request('sort_by'))
                        @case('vc_nome') Nome @break
                        @case('email') Email @break
                        @case('created_at') Data de Criação @break
                        @default {{ request('sort_by') }}
                    @endswitch
                    ({{ request('sort_order', 'desc') === 'desc' ? 'Decrescente' : 'Crescente' }})
                </div>
            @endif
        </div>
    @endif

    <!-- Summary Statistics -->
    <div class="summary">
        <div class="summary-item">
            <strong>{{ $users->where('email_verified_at', '!=', null)->count() }}</strong><br>
            <small>Emails Verificados</small>
        </div>
        <div class="summary-item">
            <strong>{{ $users->where('email_verified_at', null)->count() }}</strong><br>
            <small>Emails Não Verificados</small>
        </div>
        <div class="summary-item">
            <strong>{{ $users->where('created_at', '>=', now()->subDays(30))->count() }}</strong><br>
            <small>Registos (30 dias)</small>
        </div>
        <div class="summary-item">
            <strong>{{ $users->where('created_at', '>=', now()->subDays(7))->count() }}</strong><br>
            <small>Registos (7 dias)</small>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Tipo de Utilizador</th>
                <th>Status Email</th>
                <th>Data de Criação</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->vc_nome ?? 'N/A' }}</td>
                    <td>{{ $user->email ?? 'N/A' }}</td>
                    <td>{{ $user->tipo_user->vc_nome ?? 'N/A' }}</td>
                    <td>
                        @if ($user->email_verified_at)
                            <span class="verified">✓ Verificado</span>
                        @else
                            <span class="unverified">✗ Não Verificado</span>
                        @endif
                    </td>
                    <td>{{ $user->created_at ? $user->created_at->format('d/m/Y H:i') : 'N/A' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>