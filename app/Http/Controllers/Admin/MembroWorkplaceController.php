<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MembroWorkplace;
use App\Models\Workplace;
use App\Models\User;
use Inertia\Inertia;

class MembroWorkplaceController extends Controller
{
    public function index(Request $request)
    {
        $query = MembroWorkplace::with(['workplace', 'user']);
        if ($search = $request->input('search')) {
            $query->where('vc_funcao', 'like', "%{$search}%")
                  ->orWhereHas('user', fn($q) => $q->where('vc_nome', 'like', "%{$search}%"))
                  ->orWhereHas('workplace', fn($q) => $q->where('vc_nome', 'like', "%{$search}%"));
        }
        $items = $query->latest()->paginate(10)->withQueryString();
        
        return Inertia::render('Admin/MembroWorkplace/Index', [
            'items' => $items,
            'filters' => $request->only(['search'])
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/MembroWorkplace/Create', [
            'workplaces' => Workplace::select('id', 'vc_nome')->get(),
            'users' => User::select('id', 'vc_nome')->get()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'it_id_workplace' => 'required|exists:workplaces,id',
            'it_id_user' => 'required|exists:users,id',
            'vc_funcao' => 'required|string|max:255',
        ]);
    
        MembroWorkplace::create($validated);
    
        return redirect()->route('admin.membro_workplaces.index')
            ->with('success', 'Membro de espaço de trabalho criado com sucesso');
    }

    public function show(MembroWorkplace $membroWorkplace)
    {
        $membroWorkplace->load(['workplace', 'user']);
        return Inertia::render('Admin/MembroWorkplace/Show', [
            'item' => $membroWorkplace
        ]);
    }

    public function edit(MembroWorkplace $membroWorkplace)
    {
        $membroWorkplace->load(['workplace', 'user']);
        return Inertia::render('Admin/MembroWorkplace/Edit', [
            'item' => $membroWorkplace,
            'workplaces' => Workplace::select('id', 'vc_nome')->get(),
            'users' => User::select('id', 'vc_nome')->get()
        ]);
    }

    public function update(Request $request, MembroWorkplace $membroWorkplace)
    {
        $validated = $request->validate([
            'it_id_workplace' => 'required|exists:workplaces,id',
            'it_id_user' => 'required|exists:users,id',
            'vc_funcao' => 'required|string|max:255',
        ]);
    
        $membroWorkplace->update($validated);
    
        return redirect()->route('admin.membro_workplaces.index')
            ->with('success', 'Membro de espaço de trabalho atualizado com sucesso');
    }

    public function destroy(MembroWorkplace $membroWorkplace)
    {
        $membroWorkplace->delete();
        return redirect()->route('admin.membro_workplaces.index')
            ->with('success', 'Membro de espaço de trabalho movido para o lixo com sucesso');
    }

    public function trash(Request $request)
    {
        $query = MembroWorkplace::onlyTrashed()->with(['workplace', 'user']);
        if ($search = $request->input('search')) {
            $query->where('vc_funcao', 'like', "%{$search}%")
                  ->orWhereHas('user', fn($q) => $q->where('vc_nome', 'like', "%{$search}%"))
                  ->orWhereHas('workplace', fn($q) => $q->where('vc_nome', 'like', "%{$search}%"));
        }
        $items = $query->latest()->paginate(10)->withQueryString();
        
        return Inertia::render('Admin/MembroWorkplace/Trash', [
            'items' => $items,
            'filters' => $request->only(['search'])
        ]);
    }

    public function restore($id)
    {
        $item = MembroWorkplace::onlyTrashed()->findOrFail($id);
        $item->restore();
        return redirect()->route('admin.membro_workplaces.trash')
            ->with('success', 'Membro de espaço de trabalho restaurado com sucesso');
    }

    public function purge($id)
    {
        $item = MembroWorkplace::onlyTrashed()->findOrFail($id);
        $item->forceDelete();
        return redirect()->route('admin.membro_workplaces.trash')
            ->with('success', 'Membro de espaço de trabalho eliminado permanentemente');
    }
}