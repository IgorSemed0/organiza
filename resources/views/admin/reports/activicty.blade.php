<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Atividade</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 30px; }
        .stats-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin: 20px 0; }
        .stat-card { border: 1px solid #ddd; padding: 20px; text-align: center; background-color: #f9f9f9; }
        .stat-number { font-size: 24px; font-weight: bold; color: #007cba; }
        .stat-label { font-size: 14px; color: #666; margin-top: 5px; }
        .period { background-color: #e3f2fd; padding: 10px; margin: 15px 0; border-left: 4px solid #2196f3; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; font-weight: bold; }
        .summary-section { margin: 20px 0; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Relatório de Atividade do Sistema</h1>
        <p><strong>Data do relatório:</strong> {{ now()->format('d/m/Y H:i') }}</p>
    </div>
    
    <div class="period">
        <strong>Período analisado:</strong> 
        {{ \Carbon\Carbon::parse($dateFrom)->format('d/m/Y') }} até {{ \Carbon\Carbon::parse($dateTo)->format('d/m/Y') }}
        ({{ \Carbon\Carbon::parse($dateFrom)->diffInDays($dateTo) + 1 }} dias)
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-number">{{ $newUsers }}</div>
            <div class="stat-label">Novos Utilizadores</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-number">{{ $activeUsers }}</div>
            <div class="stat-label">Utilizadores Ativos</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-number">{{ $newWorkplaces }}</div>
            <div class="stat-label">Novos Espaços de Trabalho</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-number">{{ $newQuadros }}</div>
            <div class="stat-label">Novos Quadros</div>
        </div>
    </div>

    <div class="summary-section">
        <h3>Resumo de Crescimento</h3>
        <table>
            <thead>
                <tr>
                    <th>Métrica</th>
                    <th>Quantidade</th>
                    <th>Média por Dia</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Novos Utilizadores</td>
                    <td>{{ $newUsers }}</td>
                    <td>{{ round($newUsers / (\Carbon\Carbon::parse($dateFrom)->diffInDays($dateTo) + 1), 1) }}</td>
                </tr>
                <tr>
                    <td>Novos Espaços de Trabalho</td>
                    <td>{{ $newWorkplaces }}</td>
                    <td>{{ round($newWorkplaces / (\Carbon\Carbon::parse($dateFrom)->diffInDays($dateTo) + 1), 1) }}</td>
                </tr>
                <tr>
                    <td>Novos Quadros</td>
                    <td>{{ $newQuadros }}</td>
                    <td>{{ round($newQuadros / (\Carbon\Carbon::parse($dateFrom)->diffInDays($dateTo) + 1), 1) }}</td>
                </tr>
                <tr>
                    <td>Utilizadores Ativos</td>
                    <td>{{ $activeUsers }}</td>
                    <td>-</td>
                </tr>
            </tbody>
        </table>
    </div>

    @if ($newUsers > 0)
        <div class="summary-section">
            <h3>Observações</h3>
            <ul>
                @if ($newUsers > 10)
                    <li>Alto volume de registos de novos utilizadores ({{ $newUsers }})</li>
                @endif
                @if ($activeUsers > 0)
                    <li>Taxa de atividade: {{ round(($activeUsers / \App\<!DOCTYPE html>
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
                    </html>Models\User::count()) * 100, 1) }}% dos utilizadores totais</li>
                @endif
                @if ($newWorkplaces > 0)
                    <li>Média de {{ round($newQuadros / max($newWorkplaces, 1), 1) }} quadros por novo espaço de trabalho</li>
                @endif
            </ul>
        </div>
    @endif
</body>
</html>