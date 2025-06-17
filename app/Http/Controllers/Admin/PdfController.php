<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Workplace;
use App\Models\Quadro;
use App\Models\TipoUser;
use Illuminate\Http\Request;
use Mpdf\Mpdf;

class PdfController extends Controller
{
    public function usersPdf(Request $request)
    {
        $query = User::with('tipo_user');

        // Existing filters
        if ($request->has('tipo_user_id') && $request->tipo_user_id) {
            $query->where('it_id_tipo_user', $request->tipo_user_id);
        }

        if ($request->has('data_registo_de') && $request->data_registo_de) {
            $query->whereDate('created_at', '>=', $request->data_registo_de);
        }

        if ($request->has('data_registo_ate') && $request->data_registo_ate) {
            $query->whereDate('created_at', '<=', $request->data_registo_ate);
        }

        // NEW FILTERS
        // Filter by email verification status
        if ($request->has('email_verified') && $request->email_verified !== '') {
            if ($request->email_verified === 'verified') {
                $query->whereNotNull('email_verified_at');
            } elseif ($request->email_verified === 'unverified') {
                $query->whereNull('email_verified_at');
            }
        }

        // Filter by name (partial match)
        if ($request->has('nome') && $request->nome) {
            $query->where('vc_nome', 'like', '%' . $request->nome . '%');
        }

        // Filter by email domain
        if ($request->has('dominio_email') && $request->dominio_email) {
            $query->where('email', 'like', '%@' . $request->dominio_email);
        }

        // Sort options
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $users = $query->get();
        $tipos_user = TipoUser::all();

        $html = view('admin.reports.users', compact('users', 'tipos_user'))->render();
        
        $mpdf = new Mpdf();
        $mpdf->WriteHTML($html);
        return $mpdf->Output('relatorio_utilizadores.pdf', 'D');
    }

    public function workplacesPdf(Request $request)
    {
        $query = Workplace::with('user_criador');

        // Existing filters
        if ($request->has('data_criacao_de') && $request->data_criacao_de) {
            $query->whereDate('created_at', '>=', $request->data_criacao_de);
        }

        if ($request->has('data_criacao_ate') && $request->data_criacao_ate) {
            $query->whereDate('created_at', '<=', $request->data_criacao_ate);
        }

        if ($request->has('visibilidade') && $request->visibilidade) {
            $query->where('vc_visibilidade', $request->visibilidade);
        }

        // NEW FILTERS
        // Filter by creator
        if ($request->has('criador_id') && $request->criador_id) {
            $query->where('it_id_user_criador', $request->criador_id);
        }

        // Filter by name (partial match)
        if ($request->has('nome') && $request->nome) {
            $query->where('vc_nome', 'like', '%' . $request->nome . '%');
        }

        // Filter by number of quadros (boards)
        if ($request->has('min_quadros') && $request->min_quadros) {
            $query->has('quadros', '>=', $request->min_quadros);
        }

        if ($request->has('max_quadros') && $request->max_quadros) {
            $query->has('quadros', '<=', $request->max_quadros);
        }

        // Filter by number of members
        if ($request->has('min_membros') && $request->min_membros) {
            $query->has('membros', '>=', $request->min_membros);
        }

        // Include workplaces with activity in last X days
        if ($request->has('atividade_dias') && $request->atividade_dias) {
            $days = $request->atividade_dias;
            $query->where(function($q) use ($days) {
                $q->whereHas('quadros', function($sq) use ($days) {
                    $sq->where('updated_at', '>=', now()->subDays($days));
                })->orWhere('updated_at', '>=', now()->subDays($days));
            });
        }

        // Sort options
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $workplaces = $query->get();
        $users = User::all(); // For creator filter dropdown

        $html = view('admin.reports.workplaces', compact('workplaces', 'users'))->render();
        
        $mpdf = new Mpdf();
        $mpdf->WriteHTML($html);
        return $mpdf->Output('relatorio_espacos_trabalho.pdf', 'D');
    }

    public function quadrosPdf(Request $request)
    {
        $query = Quadro::with(['workplace', 'user_criador']);

        // Existing filters
        if ($request->has('workplace_id') && $request->workplace_id) {
            $query->where('it_id_workplace', $request->workplace_id);
        }

        if ($request->has('data_criacao_de') && $request->data_criacao_de) {
            $query->whereDate('created_at', '>=', $request->data_criacao_de);
        }

        if ($request->has('data_criacao_ate') && $request->data_criacao_ate) {
            $query->whereDate('created_at', '<=', $request->data_criacao_ate);
        }

        // NEW FILTERS
        // Filter by creator
        if ($request->has('criador_id') && $request->criador_id) {
            $query->where('it_id_user_criador', $request->criador_id);
        }

        // Filter by visibility
        if ($request->has('visibilidade') && $request->visibilidade) {
            $query->where('vc_visibilidade', $request->visibilidade);
        }

        // Filter by name (partial match)
        if ($request->has('nome') && $request->nome) {
            $query->where('vc_nome', 'like', '%' . $request->nome . '%');
        }

        // Filter by number of lists
        if ($request->has('min_listas') && $request->min_listas) {
            $query->has('listas', '>=', $request->min_listas);
        }

        if ($request->has('max_listas') && $request->max_listas) {
            $query->has('listas', '<=', $request->max_listas);
        }

        // Filter by number of members
        if ($request->has('min_membros') && $request->min_membros) {
            $query->has('membros', '>=', $request->min_membros);
        }

        // Filter by activity (updated in last X days)
        if ($request->has('atividade_dias') && $request->atividade_dias) {
            $days = $request->atividade_dias;
            $query->where('updated_at', '>=', now()->subDays($days));
        }

        // Filter by quadros with chat activity
        if ($request->has('com_chat') && $request->com_chat === '1') {
            $query->has('chat_mensagens');
        }

        // Filter by quadros with tags/etiquetas
        if ($request->has('com_etiquetas') && $request->com_etiquetas === '1') {
            $query->has('etiquetas');
        }

        // Sort options
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $quadros = $query->get();
        $workplaces = Workplace::all();
        $users = User::all(); // For creator filter dropdown

        $html = view('admin.reports.quadros', compact('quadros', 'workplaces', 'users'))->render();
        
        $mpdf = new Mpdf();
        $mpdf->WriteHTML($html);
        return $mpdf->Output('relatorio_quadros.pdf', 'D');
    }

    // NEW METHOD: Combined activity report
    public function activityPdf(Request $request)
    {
        $dateFrom = $request->get('data_de', now()->subDays(30)->format('Y-m-d'));
        $dateTo = $request->get('data_ate', now()->format('Y-m-d'));

        // Get activity data
        $newUsers = User::whereDate('created_at', '>=', $dateFrom)
                       ->whereDate('created_at', '<=', $dateTo)
                       ->count();

        $newWorkplaces = Workplace::whereDate('created_at', '>=', $dateFrom)
                                ->whereDate('created_at', '<=', $dateTo)
                                ->count();

        $newQuadros = Quadro::whereDate('created_at', '>=', $dateFrom)
                           ->whereDate('created_at', '<=', $dateTo)
                           ->count();

        $activeUsers = User::whereHas('quadros', function($q) use ($dateFrom, $dateTo) {
                           $q->whereDate('updated_at', '>=', $dateFrom)
                             ->whereDate('updated_at', '<=', $dateTo);
                       })->count();

        $data = compact('newUsers', 'newWorkplaces', 'newQuadros', 'activeUsers', 'dateFrom', 'dateTo');

        $html = view('admin.reports.activity', $data)->render();
        
        $mpdf = new Mpdf();
        $mpdf->WriteHTML($html);
        return $mpdf->Output('relatorio_atividade.pdf', 'D');
    }
}