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
        // $workplacesByVisibility = Workplace::all();

        // Quadros by workplace
        $quadrosByWorkplace = Workplace::withCount('quadros')->take(5)->get()->map(function ($workplace) {
            return [
                'label' => $workplace->vc_nome,
                'count' => $workplace->quadros_count,
            ];
        });

        return Inertia::render('dashboard', [
            'usersByType' => $usersByType,
            'quadrosByWorkplace' => $quadrosByWorkplace,
        ]);
    }
}