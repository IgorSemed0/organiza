<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChatMensagem;
use App\Models\Quadro;
use App\Models\User;
use Inertia\Inertia;

class ChatMensagemController extends Controller
{
    public function index(Request $request)
    {
        $query = ChatMensagem::with(['quadro', 'userAutor']);
        if ($search = $request->input('search')) {
            $query->where('vc_texto_mensagem', 'like', "%{$search}%")
                  ->orWhereHas('quadro', fn($q) => $q->where('vc_nome', 'like', "%{$search}%"))
                  ->orWhereHas('userAutor', fn($q) => $q->where('vc_nome', 'like', "%{$search}%"));
        }
        $items = $query->latest()->paginate(10)->withQueryString();
        
        return Inertia::render('Admin/ChatMensagem/Index', [
            'items' => $items,
            'filters' => $request->only(['search'])
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/ChatMensagem/Create', [
            'quadros' => Quadro::select('id', 'vc_nome')->get(),
            'users' => User::select('id', 'vc_nome')->get()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'it_id_quadro' => 'required|exists:quadros,id',
            'it_id_user_autor' => 'required|exists:users,id',
            'vc_texto_mensagem' => 'required|string',
        ]);
    
        ChatMensagem::create($validated);
    
        return redirect()->route('admin.chat_mensagems.index')
            ->with('success', 'Mensagem de chat criada com sucesso');
    }

    public function show(ChatMensagem $chatMensagem)
    {
        $chatMensagem->load(['quadro', 'userAutor', 'anexos']);
        return Inertia::render('Admin/ChatMensagem/Show', [
            'item' => $chatMensagem
        ]);
    }

    public function edit(ChatMensagem $chatMensagem)
    {
        $chatMensagem->load(['quadro', 'userAutor']);
        return Inertia::render('Admin/ChatMensagem/Edit', [
            'item' => $chatMensagem,
            'quadros' => Quadro::select('id', 'vc_nome')->get(),
            'users' => User::select('id', 'vc_nome')->get()
        ]);
    }

    public function update(Request $request, ChatMensagem $chatMensagem)
    {
        $validated = $request->validate([
            'it_id_quadro' => 'required|exists:quadros,id',
            'it_id_user_autor' => 'required|exists:users,id',
            'vc_texto_mensagem' => 'required|string',
        ]);
    
        $chatMensagem->update($validated);
    
        return redirect()->route('admin.chat_mensagems.index')
            ->with('success', 'Mensagem de chat atualizada com sucesso');
    }

    public function destroy(ChatMensagem $chatMensagem)
    {
        $chatMensagem->delete();
        return redirect()->route('admin.chat_mensagems.index')
            ->with('success', 'Mensagem de chat movida para o lixo com sucesso');
    }

    public function trash(Request $request)
    {
        $query = ChatMensagem::onlyTrashed()->with(['quadro', 'userAutor']);
        if ($search = $request->input('search')) {
            $query->where('vc_texto_mensagem', 'like', "%{$search}%")
                  ->orWhereHas('quadro', fn($q) => $q->where('vc_nome', 'like', "%{$search}%"))
                  ->orWhereHas('userAutor', fn($q) => $q->where('vc_nome', 'like', "%{$search}%"));
        }
        $items = $query->latest()->paginate(10)->withQueryString();
        
        return Inertia::render('Admin/ChatMensagem/Trash', [
            'items' => $items,
            'filters' => $request->only(['search'])
        ]);
    }

    public function restore($id)
    {
        $item = ChatMensagem::onlyTrashed()->findOrFail($id);
        $item->restore();
        return redirect()->route('admin.chat_mensagems.trash')
            ->with('success', 'Mensagem de chat restaurada com sucesso');
    }

    public function purge($id)
    {
        $item = ChatMensagem::onlyTrashed()->findOrFail($id);
        $item->forceDelete();
        return redirect()->route('admin.chat_mensagems.trash')
            ->with('success', 'Mensagem de chat eliminada permanentemente');
    }
}