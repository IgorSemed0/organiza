<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TipoUser;
use App\Models\Workplace;
use App\Models\Quadro;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        // Users by type
        $usersByType = TipoUser::withCount('users')->get()->map(function ($tipo) {
            return [
                'label' => $tipo->vc_nome,
                'count' => $tipo->users_count,
            ];
        });

        // Workplaces by visibility
        $workplacesByVisibility = Workplace::selectRaw('vc_visibilidade, COUNT(*) as count')
            ->groupBy('vc_visibilidade')
            ->get()
            ->map(function ($item) {
                return [
                    'label' => ucfirst($item->vc_visibilidade),
                    'count' => $item->count,
                ];
            });

        // Quadros by workplace
        $quadrosByWorkplace = Workplace::withCount('quadros')->take(5)->get()->map(function ($workplace) {
            return [
                'label' => $workplace->vc_nome,
                'count' => $workplace->quadros_count,
            ];
        });

        return Inertia::render('Admin/Dashboard/Index', [
            'usersByType' => $usersByType,
            'workplacesByVisibility' => $workplacesByVisibility,
            'quadrosByWorkplace' => $quadrosByWorkplace,
        ]);
    }
}