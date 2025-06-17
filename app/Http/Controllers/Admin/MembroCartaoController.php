<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MembroCartao;
use App\Models\Cartao;
use App\Models\User;
use Inertia\Inertia;

class MembroCartaoController extends Controller
{
    public function index(Request $request)
    {
        $query = MembroCartao::with(['cartao', 'user']);
        if ($search = $request->input('search')) {
            $query->orWhereHas('cartao', fn($q) => $q->where('vc_titulo', 'like', "%{$search}%"))
                  ->orWhereHas('user', fn($q) => $q->where('vc_nome', 'like', "%{$search}%"));
        }
        $items = $query->latest()->paginate(10)->withQueryString();
        
        return Inertia::render('Admin/MembroCartao/Index', [
            'items' => $items,
            'filters' => $request->only(['search'])
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/MembroCartao/Create', [
            'cartaos' => Cartao::select('id', 'vc_titulo')->get(),
            'users' => User::select('id', 'vc_nome')->get()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'it_id_cartao' => 'required|exists:cartaos,id',
            'it_id_user' => 'required|exists:users,id',
        ]);
    
        MembroCartao::create($validated);
    
        return redirect()->route('admin.membro_cartaos.index')
            ->with('success', 'Membro de cartão criado com sucesso');
    }

    public function show(MembroCartao $membroCartao)
    {
        $membroCartao->load(['cartao', 'user']);
        return Inertia::render('Admin/MembroCartao/Show', [
            'item' => $membroCartao
        ]);
    }

    public function edit(MembroCartao $membroCartao)
    {
        $membroCartao->load(['cartao', 'user']);
        return Inertia::render('Admin/MembroCartao/Edit', [
            'item' => $membroCartao,
            'cartaos' => Cartao::select('id', 'vc_titulo')->get(),
            'users' => User::select('id', 'vc_nome')->get()
        ]);
    }

    public function update(Request $request, MembroCartao $membroCartao)
    {
        $validated = $request->validate([
            'it_id_cartao' => 'required|exists:cartaos,id',
            'it_id_user' => 'required|exists:users,id',
        ]);
    
        $membroCartao->update($validated);
    
        return redirect()->route('admin.membro_cartaos.index')
            ->with('success', 'Membro de cartão atualizado com sucesso');
    }

    public function destroy(MembroCartao $membroCartao)
    {
        $membroCartao->delete();
        return redirect()->route('admin.membro_cartaos.index')
            ->with('success', 'Membro de cartão movido para o lixo com sucesso');
    }

    public function trash(Request $request)
    {
        $query = MembroCartao::onlyTrashed()->with(['cartao', 'user']);
        if ($search = $request->input('search')) {
            $query->orWhereHas('cartao', fn($q) => $q->where('vc_titulo', 'like', "%{$search}%"))
                  ->orWhereHas('user', fn($q) => $q->where('vc_nome', 'like', "%{$search}%"));
        }
        $items = $query->latest()->paginate(10)->withQueryString();
        
        return Inertia::render('Admin/MembroCartao/Trash', [
            'items' => $items,
            'filters' => $request->only(['search'])
        ]);
    }

    public function restore($id)
    {
        $item = MembroCartao::onlyTrashed()->findOrFail($id);
        $item->restore();
        return redirect()->route('admin.membro_cartaos.trash')
            ->with('success', 'Membro de cartão restaurado com sucesso');
    }

    public function purge($id)
    {
        $item = MembroCartao::onlyTrashed()->findOrFail($id);
        $item->forceDelete();
        return redirect()->route('admin.membro_cartaos.trash')
            ->with('success', 'Membro de cartão eliminado permanentemente');
    }
}