<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quadro;
use App\Models\Workplace;
use App\Models\User;
use Inertia\Inertia;

class QuadroController extends Controller
{
    public function index(Request $request)
    {
        $query = Quadro::with(['workplace', 'userCriador']);
        if ($search = $request->input('search')) {
            $query->where('vc_nome', 'like', "%{$search}%")
                  ->orWhere('vc_descricao', 'like', "%{$search}%")
                  ->orWhere('vc_visibilidade', 'like', "%{$search}%")
                  ->orWhereHas('workplace', fn($q) => $q->where('vc_nome', 'like', "%{$search}%"))
                  ->orWhereHas('userCriador', fn($q) => $q->where('vc_nome', 'like', "%{$search}%"));
        }
        $items = $query->latest()->paginate(10)->withQueryString();
        
        return Inertia::render('Admin/Quadro/Index', [
            'items' => $items,
            'filters' => $request->only(['search'])
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Quadro/Create', [
            'workplaces' => Workplace::select('id', 'vc_nome')->get(),
            'users' => User::select('id', 'vc_nome')->get()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'it_id_workplace' => 'required|exists:workplaces,id',
            'it_id_user_criador' => 'required|exists:users,id',
            'vc_nome' => 'required|string|max:255',
            'vc_descricao' => 'nullable|string',
            'vc_visibilidade' => 'required|string|max:255',
        ]);
    
        Quadro::create($validated);
    
        return redirect()->route('admin.quadros.index')
            ->with('success', 'Quadro criado com sucesso');
    }

    public function show(Quadro $quadro)
    {
        $quadro->load(['workplace', 'userCriador']);
        return Inertia::render('Admin/Quadro/Show', [
            'item' => $quadro
        ]);
    }

    public function edit(Quadro $quadro)
    {
        $quadro->load(['workplace', 'userCriador']);
        return Inertia::render('Admin/Quadro/Edit', [
            'item' => $quadro,
            'workplaces' => Workplace::select('id', 'vc_nome')->get(),
            'users' => User::select('id', 'vc_nome')->get()
        ]);
    }

    public function update(Request $request, Quadro $quadro)
    {
        $validated = $request->validate([
            'it_id_workplace' => 'required|exists:workplaces,id',
            'it_id_user_criador' => 'required|exists:users,id',
            'vc_nome' => 'required|string|max:255',
            'vc_descricao' => 'nullable|string',
            'vc_visibilidade' => 'required|string|max:255',
        ]);
    
        $quadro->update($validated);
    
        return redirect()->route('admin.quadros.index')
            ->with('success', 'Quadro atualizado com sucesso');
    }

    public function destroy(Quadro $quadro)
    {
        $quadro->delete();
        return redirect()->route('admin.quadros.index')
            ->with('success', 'Quadro movido para o lixo com sucesso');
    }

    public function trash(Request $request)
    {
        $query = Quadro::onlyTrashed()->with(['workplace', 'userCriador']);
        if ($search = $request->input('search')) {
            $query->where('vc_nome', 'like', "%{$search}%")
                  ->orWhere('vc_descricao', 'like', "%{$search}%")
                  ->orWhere('vc_visibilidade', 'like', "%{$search}%")
                  ->orWhereHas('workplace', fn($q) => $q->where('vc_nome', 'like', "%{$search}%"))
                  ->orWhereHas('userCriador', fn($q) => $q->where('vc_nome', 'like', "%{$search}%"));
        }
        $items = $query->latest()->paginate(10)->withQueryString();
        
        return Inertia::render('Admin/Quadro/Trash', [
            'items' => $items,
            'filters' => $request->only(['search'])
        ]);
    }

    public function restore($id)
    {
        $item = Quadro::onlyTrashed()->findOrFail($id);
        $item->restore();
        return redirect()->route('admin.quadros.trash')
            ->with('success', 'Quadro restaurado com sucesso');
    }

    public function purge($id)
    {
        $item = Quadro::onlyTrashed()->findOrFail($id);
        $item->forceDelete();
        return redirect()->route('admin.quadros.trash')
            ->with('success', 'Quadro eliminado permanentemente');
    }
}