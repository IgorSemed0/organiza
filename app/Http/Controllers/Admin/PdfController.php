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

        if ($request->has('tipo_user_id') && $request->tipo_user_id) {
            $query->where('it_id_tipo_user', $request->tipo_user_id);
        }

        if ($request->has('data_registo_de') && $request->data_registo_de) {
            $query->whereDate('created_at', '>=', $request->data_registo_de);
        }

        if ($request->has('data_registo_ate') && $request->data_registo_ate) {
            $query->whereDate('created_at', '<=', $request->data_registo_ate);
        }

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

        if ($request->has('data_criacao_de') && $request->data_criacao_de) {
            $query->whereDate('created_at', '>=', $request->data_criacao_de);
        }

        if ($request->has('data_criacao_ate') && $request->data_criacao_ate) {
            $query->whereDate('created_at', '<=', $request->data_criacao_ate);
        }

        if ($request->has('visibilidade') && $request->visibilidade) {
            $query->where('vc_visibilidade', $request->visibilidade);
        }

        $workplaces = $query->get();
        $html = view('admin.reports.workplaces', compact('workplaces'))->render();
        
        $mpdf = new Mpdf();
        $mpdf->WriteHTML($html);
        return $mpdf->Output('relatorio_espacos_trabalho.pdf', 'D');
    }

    public function quadrosPdf(Request $request)
    {
        $query = Quadro::with(['workplace', 'user_criador']);

        if ($request->has('workplace_id') && $request->workplace_id) {
            $query->where('it_id_workplace', $request->workplace_id);
        }

        if ($request->has('data_criacao_de') && $request->data_criacao_de) {
            $query->whereDate('created_at', '>=', $request->data_criacao_de);
        }

        if ($request->has('data_criacao_ate') && $request->data_criacao_ate) {
            $query->whereDate('created_at', '<=', $request->data_criacao_ate);
        }

        $quadros = $query->get();
        $workplaces = Workplace::all();

        $html = view('admin.reports.quadros', compact('quadros', 'workplaces'))->render();
        
        $mpdf = new Mpdf();
        $mpdf->WriteHTML($html);
        return $mpdf->Output('relatorio_quadros.pdf', 'D');
    }
}