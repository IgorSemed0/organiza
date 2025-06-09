<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MembroQuadroConvite;
use App\Models\Quadro;
use App\Models\User;
use Inertia\Inertia;

class MembroQuadroConviteController extends Controller
{
    public function index(Request $request)
    {
        $query = MembroQuadroConvite::with(['quadro', 'userConvidado', 'userConvidador']);
        if ($search = $request->input('search')) {
            $query->where('vc_status', 'like', "%{$search}%")
                  ->orWhereHas('quadro', fn($q) => $q->where('vc_nome', 'like', "%{$search}%"))
                  ->orWhereHas('userConvidado', fn($q) => $q->where('vc_nome', 'like', "%{$search}%"))
                  ->orWhereHas('userConvidador', fn($q) => $q->where('vc_nome', 'like', "%{$search}%"));
        }
        $items = $query->latest()->paginate(10)->withQueryString();
        
        return Inertia::render('Admin/MembroQuadroConvite/Index', [
            'items' => $items,
            'filters' => $request->only(['search'])
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/MembroQuadroConvite/Create', [
            'quadros' => Quadro::select('id', 'vc_nome')->get(),
            'users' => User::select('id', 'vc_nome')->get()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'it_id_quadro' => 'required|exists:quadros,id',
            'it_id_user_convidado' => 'required|exists:users,id',
            'it_id_user_convidador' => 'required|exists:users,id',
            'vc_status' => 'required|string|max:255',
        ]);
    
        MembroQuadroConvite::create($validated);
    
        return redirect()->route('admin.membro_quadro_convites.index')
            ->with('success', 'Convite para quadro criado com sucesso');
    }

    public function show(MembroQuadroConvite $membroQuadroConvite)
    {
        $membroQuadroConvite->load(['quadro', 'userConvidado', 'userConvidador']);
        return Inertia::render('Admin/MembroQuadroConvite/Show', [
            'item' => $membroQuadroConvite
        ]);
    }

    public function edit(MembroQuadroConvite $membroQuadroConvite)
    {
        $membroQuadroConvite->load(['quadro', 'userConvidado', 'userConvidador']);
        return Inertia::render('Admin/MembroQuadroConvite/Edit', [
            'item' => $membroQuadroConvite,
            'quadros' => Quadro::select('id', 'vc_nome')->get(),
            'users' => User::select('id', 'vc_nome')->get()
        ]);
    }

    public function update(Request $request, MembroQuadroConvite $membroQuadroConvite)
    {
        $validated = $request->validate([
            'it_id_quadro' => 'required|exists:quadros,id',
            'it_id_user_convidado' => 'required|exists:users,id',
            'it_id_user_convidador' => 'required|exists:users,id',
            'vc_status' => 'required|string|max:255',
        ]);
    
        $membroQuadroConvite->update($validated);
    
        return redirect()->route('admin.membro_quadro_convites.index')
            ->with('success', 'Convite para quadro atualizado com sucesso');
    }

    public function destroy(MembroQuadroConvite $membroQuadroConvite)
    {
        $membroQuadroConvite->delete();
        return redirect()->route('admin.membro_quadro_convites.index')
            ->with('success', 'Convite para quadro movido para o lixo com sucesso');
    }

    public function trash(Request $request)
    {
        $query = MembroQuadroConvite::onlyTrashed()->with(['quadro', 'userConvidado', 'userConvidador']);
        if ($search = $request->input('search')) {
            $query->where('vc_status', 'like', "%{$search}%")
                  ->orWhereHas('quadro', fn($q) => $q->where('vc_nome', 'like', "%{$search}%"))
                  ->orWhereHas('userConvidado', fn($q) => $q->where('vc_nome', 'like', "%{$search}%"))
                  ->orWhereHas('userConvidador', fn($q) => $q->where('vc_nome', 'like', "%{$search}%"));
        }
        $items = $query->latest()->paginate(10)->withQueryString();
        
        return Inertia::render('Admin/MembroQuadroConvite/Trash', [
            'items' => $items,
            'filters' => $request->only(['search'])
        ]);
    }

    public function restore($id)
    {
        $item = MembroQuadroConvite::onlyTrashed()->findOrFail($id);
        $item->restore();
        return redirect()->route('admin.membro_quadro_convites.trash')
            ->with('success', 'Convite para quadro restaurado com sucesso');
    }

    public function purge($id)
    {
        $item = MembroQuadroConvite::onlyTrashed()->findOrFail($id);
        $item->forceDelete();
        return redirect()->route('admin.membro_quadro_convites.trash')
            ->with('success', 'Convite para quadro eliminado permanentemente');
    }
}