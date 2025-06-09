<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Workplace;
use App\Models\User;
use Inertia\Inertia;

class WorkplaceController extends Controller
{
    public function index(Request $request)
    {
        $query = Workplace::with('userCriador');
        if ($search = $request->input('search')) {
            $query->where('vc_nome', 'like', "%{$search}%")
                  ->orWhere('vc_descricao', 'like', "%{$search}%");
        }
        $items = $query->latest()->paginate(10)->withQueryString();
        
        return Inertia::render('Admin/Workplace/Index', [
            'items' => $items,
            'filters' => $request->only(['search'])
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Workplace/Create', [
            'users' => User::select('id', 'vc_nome')->get()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'vc_nome' => 'required|string|max:255',
            'vc_descricao' => 'nullable|string',
            'it_id_user_criador' => 'required|exists:users,id',
        ]);
    
        Workplace::create($validated);
    
        return redirect()->route('admin.workplaces.index')
            ->with('success', 'Espaço de trabalho criado com sucesso');
    }

    public function show(Workplace $workplace)
    {
        $workplace->load('userCriador');
        return Inertia::render('Admin/Workplace/Show', [
            'item' => $workplace
        ]);
    }

    public function edit(Workplace $workplace)
    {
        $workplace->load('userCriador');
        return Inertia::render('Admin/Workplace/Edit', [
            'item' => $workplace,
            'users' => User::select('id', 'vc_nome')->get()
        ]);
    }

    public function update(Request $request, Workplace $workplace)
    {
        $validated = $request->validate([
            'vc_nome' => 'required|string|max:255',
            'vc_descricao' => 'nullable|string',
            'it_id_user_criador' => 'required|exists:users,id',
        ]);
    
        $workplace->update($validated);
    
        return redirect()->route('admin.workplaces.index')
            ->with('success', 'Espaço de trabalho atualizado com sucesso');
    }

    public function destroy(Workplace $workplace)
    {
        $workplace->delete();
        return redirect()->route('admin.workplaces.index')
            ->with('success', 'Espaço de trabalho movido para o lixo com sucesso');
    }

    public function trash(Request $request)
    {
        $query = Workplace::onlyTrashed()->with('userCriador');
        if ($search = $request->input('search')) {
            $query->where('vc_nome', 'like', "%{$search}%")
                  ->orWhere('vc_descricao', 'like', "%{$search}%");
        }
        $items = $query->latest()->paginate(10)->withQueryString();
        
        return Inertia::render('Admin/Workplace/Trash', [
            'items' => $items,
            'filters' => $request->only(['search'])
        ]);
    }

    public function restore($id)
    {
        $item = Workplace::onlyTrashed()->findOrFail($id);
        $item->restore();
        return redirect()->route('admin.workplaces.trash')
            ->with('success', 'Espaço de trabalho restaurado com sucesso');
    }

    public function purge($id)
    {
        $item = Workplace::onlyTrashed()->findOrFail($id);
        $item->forceDelete();
        return redirect()->route('admin.workplaces.trash')
            ->with('success', 'Espaço de trabalho eliminado permanentemente');
    }
}