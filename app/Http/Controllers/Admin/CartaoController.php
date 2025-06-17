<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cartao;
use App\Models\Lista;
use App\Models\User;
use App\Models\Etiqueta;
use Inertia\Inertia;

class CartaoController extends Controller
{
    public function index(Request $request)
    {
        $query = Cartao::with(['lista', 'userCriador']);
        if ($search = $request->input('search')) {
            $query->where('vc_titulo', 'like', "%{$search}%")
                  ->orWhere('vc_descricao', 'like', "%{$search}%")
                  ->orWhereHas('lista', fn($q) => $q->where('vc_nome', 'like', "%{$search}%"))
                  ->orWhereHas('userCriador', fn($q) => $q->where('vc_nome', 'like', "%{$search}%"));
        }
        $items = $query->latest()->paginate(10)->withQueryString();
        
        return Inertia::render('Admin/Cartao/Index', [
            'items' => $items,
            'filters' => $request->only(['search'])
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Cartao/Create', [
            'listas' => Lista::select('id', 'vc_nome')->get(),
            'users' => User::select('id', 'vc_nome')->get(),
            'etiquetas' => Etiqueta::select('id', 'vc_nome')->get()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'it_id_lista' => 'required|exists:listas,id',
            'it_id_user_criador' => 'required|exists:users,id',
            'vc_titulo' => 'required|string|max:255',
            'vc_descricao' => 'nullable|string',
            'dt_data_vencimento' => 'nullable|date',
            'it_ordem' => 'nullable|integer',
            'etiquetas' => 'nullable|array',
            'etiquetas.*' => 'exists:etiquetas,id'
        ]);

        $cartao = Cartao::create($validated);
        if (!empty($validated['etiquetas'])) {
            $cartao->etiquetas()->sync($validated['etiquetas']);
        }
    
        return redirect()->route('admin.cartaos.index')
            ->with('success', 'Cartão criado com sucesso');
    }

    public function show(Cartao $cartao)
    {
        $cartao->load(['lista', 'userCriador', 'anexos', 'comentarios', 'etiquetas', 'membros', 'listasVerificacaos']);
        return Inertia::render('Admin/Cartao/Show', [
            'item' => $cartao
        ]);
    }

    public function edit(Cartao $cartao)
    {
        $cartao->load(['etiquetas']);
        return Inertia::render('Admin/Cartao/Edit', [
            'item' => $cartao,
            'listas' => Lista::select('id', 'vc_nome')->get(),
            'users' => User::select('id', 'vc_nome')->get(),
            'etiquetas' => Etiqueta::select('id', 'vc_nome')->get()
        ]);
    }

    public function update(Request $request, Cartao $cartao)
    {
        $validated = $request->validate([
            'it_id_lista' => 'required|exists:listas,id',
            'it_id_user_criador' => 'required|exists:users,id',
            'vc_titulo' => 'required|string|max:255',
            'vc_descricao' => 'nullable|string',
            'dt_data_vencimento' => 'nullable|date',
            'it_ordem' => 'nullable|integer',
            'etiquetas' => 'nullable|array',
            'etiquetas.*' => 'exists:etiquetas,id'
        ]);

        $cartao->update($validated);
        $cartao->etiquetas()->sync($validated['etiquetas'] ?? []);
    
        return redirect()->route('admin.cartaos.index')
                        ->with('success', 'Cartão atualizado com sucesso');
    }

    public function destroy(Cartao $cartao)
    {
        $cartao->delete();
        return redirect()->route('admin.cartaos.index')
                        ->with('success', 'Cartão movido para o lixo com sucesso');
    }

    public function trash(Request $request)
    {
        $query = Cartao::onlyTrashed()->with(['lista', 'userCriador']);
        if ($search = $request->input('search')) {
            $query->where('vc_titulo', 'like', "%{$search}%")
                  ->orWhere('vc_descricao', 'like', "%{$search}%")
                  ->orWhereHas('lista', fn($q) => $q->where('vc_nome', 'like', "%{$search}%"))
                  ->orWhereHas('userCriador', fn($q) => $q->where('vc_nome', 'like', "%{$search}%"));
        }
        $items = $query->latest()->paginate(10)->withQueryString();
        
        return Inertia::render('Admin/Cartao/Trash', [
            'items' => $items,
            'filters' => $request->only(['search'])
        ]);
    }

    public function restore($id)
    {
        $item = Cartao::onlyTrashed()->findOrFail($id);
        $item->restore();
        return redirect()->route('admin.cartaos.trash')
                        ->with('success', 'Cartão restaurado com sucesso');
    }

    public function purge($id)
    {
        $item = Cartao::onlyTrashed()->findOrFail($id);
        $item->forceDelete();
        return redirect()->route('admin.cartaos.trash')
                        ->with('success', 'Cartão eliminado permanentemente');
    }
}