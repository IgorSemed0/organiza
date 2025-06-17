<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comentario;
use App\Models\Cartao;
use App\Models\User;
use Inertia\Inertia;

class ComentarioController extends Controller
{
    public function index(Request $request)
    {
        $query = Comentario::with(['cartao', 'userAutor']);
        if ($search = $request->input('search')) {
            $query->where('vc_texto', 'like', "%{$search}%")
                  ->orWhereHas('cartao', fn($q) => $q->where('vc_titulo', 'like', "%{$search}%"))
                  ->orWhereHas('userAutor', fn($q) => $q->where('vc_nome', 'like', "%{$search}%"));
        }
        $items = $query->latest()->paginate(10)->withQueryString();
        
        return Inertia::render('Admin/Comentario/Index', [
            'items' => $items,
            'filters' => $request->only(['search'])
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Comentario/Create', [
            'cartaos' => Cartao::select('id', 'vc_titulo')->get(),
            'users' => User::select('id', 'vc_nome')->get()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'it_id_cartao' => 'required|exists:cartaos,id',
            'it_id_user_autor' => 'required|exists:users,id',
            'vc_texto' => 'required|string',
        ]);
    
        Comentario::create($validated);
    
        return redirect()->route('admin.comentarios.index')
            ->with('success', 'Comentário criado com sucesso');
    }

    public function show(Comentario $comentario)
    {
        $comentario->load(['cartao', 'userAutor']);
        return Inertia::render('Admin/Comentario/Show', [
            'item' => $comentario
        ]);
    }

    public function edit(Comentario $comentario)
    {
        $comentario->load(['cartao', 'userAutor']);
        return Inertia::render('Admin/Comentario/Edit', [
            'item' => $comentario,
            'cartaos' => Cartao::select('id', 'vc_titulo')->get(),
            'users' => User::select('id', 'vc_nome')->get()
        ]);
    }

    public function update(Request $request, Comentario $comentario)
    {
        $validated = $request->validate([
            'it_id_cartao' => 'required|exists:cartaos,id',
            'it_id_user_autor' => 'required|exists:users,id',
            'vc_texto' => 'required|string',
        ]);
    
        $comentario->update($validated);
    
        return redirect()->route('admin.comentarios.index')
            ->with('success', 'Comentário atualizado com sucesso');
    }

    public function destroy(Comentario $comentario)
    {
        $comentario->delete();
        return redirect()->route('admin.comentarios.index')
            ->with('success', 'Comentário movido para o lixo com sucesso');
    }

    public function trash(Request $request)
    {
        $query = Comentario::onlyTrashed()->with(['cartao', 'userAutor']);
        if ($search = $request->input('search')) {
            $query->where('vc_texto', 'like', "%{$search}%")
                  ->orWhereHas('cartao', fn($q) => $q->where('vc_titulo', 'like', "%{$search}%"))
                  ->orWhereHas('userAutor', fn($q) => $q->where('vc_nome', 'like', "%{$search}%"));
        }
        $items = $query->latest()->paginate(10)->withQueryString();
        
        return Inertia::render('Admin/Comentario/Trash', [
            'items' => $items,
            'filters' => $request->only(['search'])
        ]);
    }

    public function restore($id)
    {
        $item = Comentario::onlyTrashed()->findOrFail($id);
        $item->restore();
        return redirect()->route('admin.comentarios.trash')
            ->with('success', 'Comentário restaurado com sucesso');
    }

    public function purge($id)
    {
        $item = Comentario::onlyTrashed()->findOrFail($id);
        $item->forceDelete();
        return redirect()->route('admin.comentarios.trash')
            ->with('success', 'Comentário eliminado permanentemente');
    }
}