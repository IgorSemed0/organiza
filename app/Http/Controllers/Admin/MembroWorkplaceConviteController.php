<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MembroWorkplaceConvite;
use App\Models\Workplace;
use App\Models\User;
use Inertia\Inertia;

class MembroWorkplaceConviteController extends Controller
{
    public function index(Request $request)
    {
        $query = MembroWorkplaceConvite::with(['workplace', 'userConvidado', 'userConvidador']);
        if ($search = $request->input('search')) {
            $query->where('vc_status', 'like', "%{$search}%")
                  ->orWhereHas('workplace', fn($q) => $q->where('vc_nome', 'like', "%{$search}%"))
                  ->orWhereHas('userConvidado', fn($q) => $q->where('vc_nome', 'like', "%{$search}%"))
                  ->orWhereHas('userConvidador', fn($q) => $q->where('vc_nome', 'like', "%{$search}%"));
        }
        $items = $query->latest()->paginate(10)->withQueryString();
        
        return Inertia::render('Admin/MembroWorkplaceConvite/Index', [
            'items' => $items,
            'filters' => $request->only(['search'])
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/MembroWorkplaceConvite/Create', [
            'workplaces' => Workplace::select('id', 'vc_nome')->get(),
            'users' => User::select('id', 'vc_nome')->get()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'it_id_workplace' => 'required|exists:workplaces,id',
            'it_id_user_convidado' => 'required|exists:users,id',
            'it_id_user_convidador' => 'required|exists:users,id',
            'vc_status' => 'required|string|max:255',
        ]);
    
        MembroWorkplaceConvite::create($validated);
    
        return redirect()->route('admin.membro_workplace_convites.index')
            ->with('success', 'Convite para espaço de trabalho criado com sucesso');
    }

    public function show(MembroWorkplaceConvite $membroWorkplaceConvite)
    {
        $membroWorkplaceConvite->load(['workplace', 'userConvidado', 'userConvidador']);
        return Inertia::render('Admin/MembroWorkplaceConvite/Show', [
            'item' => $membroWorkplaceConvite
        ]);
    }

    public function edit(MembroWorkplaceConvite $membroWorkplaceConvite)
    {
        $membroWorkplaceConvite->load(['workplace', 'userConvidado', 'userConvidador']);
        return Inertia::render('Admin/MembroWorkplaceConvite/Edit', [
            'item' => $membroWorkplaceConvite,
            'workplaces' => Workplace::select('id', 'vc_nome')->get(),
            'users' => User::select('id', 'vc_nome')->get()
        ]);
    }

    public function update(Request $request, MembroWorkplaceConvite $membroWorkplaceConvite)
    {
        $validated = $request->validate([
            'it_id_workplace' => 'required|exists:workplaces,id',
            'it_id_user_convidado' => 'required|exists:users,id',
            'it_id_user_convidador' => 'required|exists:users,id',
            'vc_status' => 'required|string|max:255',
        ]);
    
        $membroWorkplaceConvite->update($validated);
    
        return redirect()->route('admin.membro_workplace_convites.index')
            ->with('success', 'Convite para espaço de trabalho atualizado com sucesso');
    }

    public function destroy(MembroWorkplaceConvite $membroWorkplaceConvite)
    {
        $membroWorkplaceConvite->delete();
        return redirect()->route('admin.membro_workplace_convites.index')
            ->with('success', 'Convite para espaço de trabalho movido para o lixo com sucesso');
    }

    public function trash(Request $request)
    {
        $query = MembroWorkplaceConvite::onlyTrashed()->with(['workplace', 'userConvidado', 'userConvidador']);
        if ($search = $request->input('search')) {
            $query->where('vc_status', 'like', "%{$search}%")
                  ->orWhereHas('workplace', fn($q) => $q->where('vc_nome', 'like', "%{$search}%"))
                  ->orWhereHas('userConvidado', fn($q) => $q->where('vc_nome', 'like', "%{$search}%"))
                  ->orWhereHas('userConvidador', fn($q) => $q->where('vc_nome', 'like', "%{$search}%"));
        }
        $items = $query->latest()->paginate(10)->withQueryString();
        
        return Inertia::render('Admin/MembroWorkplaceConvite/Trash', [
            'items' => $items,
            'filters' => $request->only(['search'])
        ]);
    }

    public function restore($id)
    {
        $item = MembroWorkplaceConvite::onlyTrashed()->findOrFail($id);
        $item->restore();
        return redirect()->route('admin.membro_workplace_convites.trash')
            ->with('success', 'Convite para espaço de trabalho restaurado com sucesso');
    }

    public function purge($id)
    {
        $item = MembroWorkplaceConvite::onlyTrashed()->findOrFail($id);
        $item->forceDelete();
        return redirect()->route('admin.membro_workplace_convites.trash')
            ->with('success', 'Convite para espaço de trabalho eliminado permanentemente');
    }
}