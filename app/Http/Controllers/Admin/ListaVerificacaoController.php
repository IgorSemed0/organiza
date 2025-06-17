<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ListaVerificacao;
use App\Models\Cartao;
use Inertia\Inertia;

class ListaVerificacaoController extends Controller
{
    public function index(Request $request)
    {
        $query = ListaVerificacao::with(['cartao']);
        if ($search = $request->input('search')) {
            $query->where('vc_nome', 'like', "%{$search}%")
                  ->orWhereHas('cartao', fn($q) => $q->where('vc_titulo', 'like', "%{$search}%"));
        }
        $items = $query->latest()->paginate(10)->withQueryString();
        
        return Inertia::render('Admin/ListaVerificacao/Index', [
            'items' => $items,
            'filters' => $request->only(['search'])
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/ListaVerificacao/Create', [
            'cartaos' => Cartao::select('id', 'vc_titulo')->get()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'it_id_cartao' => 'required|exists:cartaos,id',
            'vc_nome' => 'required|string|max:255',
        ]);
    
        ListaVerificacao::create($validated);
    
        return redirect()->route('admin.listas_verificacaos.index')
            ->with('success', 'Lista de verificação criada com sucesso');
    }

    public function show(ListaVerificacao $listaVerificacao)
    {
        $listaVerificacao->load(['cartao']);
        return Inertia::render('Admin/ListaVerificacao/Show', [
            'item' => $listaVerificacao
        ]);
    }

    public function edit(ListaVerificacao $listaVerificacao)
    {
        $listaVerificacao->load(['cartao']);
        return Inertia::render('Admin/ListaVerificacao/Edit', [
            'item' => $listaVerificacao,
            'cartaos' => Cartao::select('id', 'vc_titulo')->get()
        ]);
    }

    public function update(Request $request, ListaVerificacao $listaVerificacao)
    {
        $validated = $request->validate([
            'it_id_cartao' => 'required|exists:cartaos,id',
            'vc_nome' => 'required|string|max:255',
        ]);
    
        $listaVerificacao->update($validated);
    
        return redirect()->route('admin.listas_verificacaos.index')
            ->with('success', 'Lista de verificação atualizada com sucesso');
    }

    public function destroy(ListaVerificacao $listaVerificacao)
    {
        $listaVerificacao->delete();
        return redirect()->route('admin.listas_verificacaos.index')
            ->with('success', 'Lista de verificação movida para o lixo com sucesso');
    }

    public function trash(Request $request)
    {
        $query = ListaVerificacao::onlyTrashed()->with(['cartao']);
        if ($search = $request->input('search')) {
            $query->where('vc_nome', 'like', "%{$search}%")
                  ->orWhereHas('cartao', fn($q) => $q->where('vc_titulo', 'like', "%{$search}%"));
        }
        $items = $query->latest()->paginate(10)->withQueryString();
        
        return Inertia::render('Admin/ListaVerificacao/Trash', [
            'items' => $items,
            'filters' => $request->only(['search'])
        ]);
    }

    public function restore($id)
    {
        $item = ListaVerificacao::onlyTrashed()->findOrFail($id);
        $item->restore();
        return redirect()->route('admin.listas_verificacaos.trash')
            ->with('success', 'Lista de verificação restaurada com sucesso');
    }

    public function purge($id)
    {
        $item = ListaVerificacao::onlyTrashed()->findOrFail($id);
        $item->forceDelete();
        return redirect()->route('admin.listas_verificacaos.trash')
            ->with('success', 'Lista de verificação eliminada permanentemente');
    }
}