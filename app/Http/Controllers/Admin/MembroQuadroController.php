<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MembroQuadro;
use App\Models\Quadro;
use App\Models\User;
use Inertia\Inertia;

class MembroQuadroController extends Controller
{
    public function index(Request $request)
    {
        $query = MembroQuadro::with(['quadro', 'user']);
        if ($search = $request->input('search')) {
            $query->where('vc_funcao', 'like', "%{$search}%")
                  ->orWhereHas('quadro', fn($q) => $q->where('vc_nome', 'like', "%{$search}%"))
                  ->orWhereHas('user', fn($q) => $q->where('vc_nome', 'like', "%{$search}%"));
        }
        $items = $query->latest()->paginate(10)->withQueryString();
        
        return Inertia::render('Admin/MembroQuadro/Index', [
            'items' => $items,
            'filters' => $request->only(['search'])
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/MembroQuadro/Create', [
            'quadros' => Quadro::select('id', 'vc_nome')->get(),
            'users' => User::select('id', 'vc_nome')->get()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'it_id_quadro' => 'required|exists:quadros,id',
            'it_id_user' => 'required|exists:users,id',
            'vc_funcao' => 'required|string|max:255',
        ]);
    
        MembroQuadro::create($validated);
    
        return redirect()->route('admin.membro_quadros.index')
            ->with('success', 'Membro de quadro criado com sucesso');
    }

    public function show(MembroQuadro $membroQuadro)
    {
        $membroQuadro->load(['quadro', 'user']);
        return Inertia::render('Admin/MembroQuadro/Show', [
            'item' => $membroQuadro
        ]);
    }

    public function edit(MembroQuadro $membroQuadro)
    {
        $membroQuadro->load(['quadro', 'user']);
        return Inertia::render('Admin/MembroQuadro/Edit', [
            'item' => $membroQuadro,
            'quadros' => Quadro::select('id', 'vc_nome')->get(),
            'users' => User::select('id', 'vc_nome')->get()
        ]);
    }

    public function update(Request $request, MembroQuadro $membroQuadro)
    {
        $validated = $request->validate([
            'it_id_quadro' => 'required|exists:quadros,id',
            'it_id_user' => 'required|exists:users,id',
            'vc_funcao' => 'required|string|max:255',
        ]);
    
        $membroQuadro->update($validated);
    
        return redirect()->route('admin.membro_quadros.index')
            ->with('success', 'Membro de quadro atualizado com sucesso');
    }

    public function destroy(MembroQuadro $membroQuadro)
    {
        $membroQuadro->delete();
        return redirect()->route('admin.membro_quadros.index')
            ->with('success', 'Membro de quadro movido para o lixo com sucesso');
    }

    public function trash(Request $request)
    {
        $query = MembroQuadro::onlyTrashed()->with(['quadro', 'user']);
        if ($search = $request->input('search')) {
            $query->where('vc_funcao', 'like', "%{$search}%")
                  ->orWhereHas('quadro', fn($q) => $q->where('vc_nome', 'like', "%{$search}%"))
                  ->orWhereHas('user', fn($q) => $q->where('vc_nome', 'like', "%{$search}%"));
        }
        $items = $query->latest()->paginate(10)->withQueryString();
        
        return Inertia::render('Admin/MembroQuadro/Trash', [
            'items' => $items,
            'filters' => $request->only(['search'])
        ]);
    }

    public function restore($id)
    {
        $item = MembroQuadro::onlyTrashed()->findOrFail($id);
        $item->restore();
        return redirect()->route('admin.membro_quadros.trash')
            ->with('success', 'Membro de quadro restaurado com sucesso');
    }

    public function purge($id)
    {
        $item = MembroQuadro::onlyTrashed()->findOrFail($id);
        $item->forceDelete();
        return redirect()->route('admin.membro_quadros.trash')
            ->with('success', 'Membro de quadro eliminado permanentemente');
    }
}