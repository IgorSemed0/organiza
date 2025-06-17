<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lista;
use App\Models\Quadro;
use Inertia\Inertia;

class ListaController extends Controller
{
    public function index(Request $request)
    {
        $query = Lista::with(['quadro']);
        if ($search = $request->input('search')) {
            $query->where('vc_nome', 'like', "%{$search}%")
                  ->orWhere('it_ordem', 'like', "%{$search}%")
                  ->orWhereHas('quadro', fn($q) => $q->where('vc_nome', 'like', "%{$search}%"));
        }
        $items = $query->latest()->paginate(10)->withQueryString();
        
        return Inertia::render('Admin/Lista/Index', [
            'items' => $items,
            'filters' => $request->only(['search'])
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Lista/Create', [
            'quadros' => Quadro::select('id', 'vc_nome')->get()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'it_id_quadro' => 'required|exists:quadros,id',
            'vc_nome' => 'required|string|max:255',
            'it_ordem' => 'required|integer',
        ]);
    
        Lista::create($validated);
    
        return redirect()->route('admin.listas.index')
            ->with('success', 'Lista criada com sucesso');
    }

    public function show(Lista $lista)
    {
        $lista->load(['quadro']);
        return Inertia::render('Admin/Lista/Show', [
            'item' => $lista
        ]);
    }

    public function edit(Lista $lista)
    {
        $lista->load(['quadro']);
        return Inertia::render('Admin/Lista/Edit', [
            'item' => $lista,
            'quadros' => Quadro::select('id', 'vc_nome')->get()
        ]);
    }

    public function update(Request $request, Lista $lista)
    {
        $validated = $request->validate([
            'it_id_quadro' => 'required|exists:quadros,id',
            'vc_nome' => 'required|string|max:255',
            'it_ordem' => 'required|integer',
        ]);
    
        $lista->update($validated);
    
        return redirect()->route('admin.listas.index')
            ->with('success', 'Lista atualizada com sucesso');
    }

    public function destroy(Lista $lista)
    {
        $lista->delete();
        return redirect()->route('admin.listas.index')
            ->with('success', 'Lista movida para o lixo com sucesso');
    }

    public function trash(Request $request)
    {
        $query = Lista::onlyTrashed()->with(['quadro']);
        if ($search = $request->input('search')) {
            $query->where('vc_nome', 'like', "%{$search}%")
                  ->orWhere('it_ordem', 'like', "%{$search}%")
                  ->orWhereHas('quadro', fn($q) => $q->where('vc_nome', 'like', "%{$search}%"));
        }
        $items = $query->latest()->paginate(10)->withQueryString();
        
        return Inertia::render('Admin/Lista/Trash', [
            'items' => $items,
            'filters' => $request->only(['search'])
        ]);
    }

    public function restore($id)
    {
        $item = Lista::onlyTrashed()->findOrFail($id);
        $item->restore();
        return redirect()->route('admin.listas.trash')
            ->with('success', 'Lista restaurada com sucesso');
    }

    public function purge($id)
    {
        $item = Lista::onlyTrashed()->findOrFail($id);
        $item->forceDelete();
        return redirect()->route('admin.listas.trash')
            ->with('success', 'Lista eliminada permanentemente');
    }
}