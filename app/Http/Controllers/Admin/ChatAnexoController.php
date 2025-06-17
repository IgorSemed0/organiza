<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChatAnexo;
use App\Models\ChatMensagem;
use App\Models\User;
use Inertia\Inertia;

class ChatAnexoController extends Controller
{
    public function index(Request $request)
    {
        $query = ChatAnexo::with(['chatMensagem', 'userUpload']);
        if ($search = $request->input('search')) {
            $query->where('vc_nome_arquivo', 'like', "%{$search}%")
                  ->orWhereHas('chatMensagem', fn($q) => $q->where('vc_texto_mensagem', 'like', "%{$search}%"))
                  ->orWhereHas('userUpload', fn($q) => $q->where('vc_nome', 'like', "%{$search}%"));
        }
        $items = $query->latest()->paginate(10)->withQueryString();
        
        return Inertia::render('Admin/ChatAnexo/Index', [
            'items' => $items,
            'filters' => $request->only(['search'])
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/ChatAnexo/Create', [
            'chatMensagens' => ChatMensagem::select('id', 'vc_texto_mensagem')->get(),
            'users' => User::select('id', 'vc_nome')->get()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'it_id_chat_mensagem' => 'required|exists:chat_mensagems,id',
            'it_id_user_upload' => 'required|exists:users,id',
            'vc_nome_arquivo' => 'required|string|max:255',
            'vc_caminho_arquivo' => 'required|string|max:255',
        ]);
    
        ChatAnexo::create($validated);
    
        return redirect()->route('admin.chat_anexos.index')
            ->with('success', 'Anexo de chat criado com sucesso');
    }

    public function show(ChatAnexo $chatAnexo)
    {
        $chatAnexo->load(['chatMensagem', 'userUpload']);
        return Inertia::render('Admin/ChatAnexo/Show', [
            'item' => $chatAnexo
        ]);
    }

    public function edit(ChatAnexo $chatAnexo)
    {
        $chatAnexo->load(['chatMensagem', 'userUpload']);
        return Inertia::render('Admin/ChatAnexo/Edit', [
            'item' => $chatAnexo,
            'chatMensagens' => ChatMensagem::select('id', 'vc_texto_mensagem')->get(),
            'users' => User::select('id', 'vc_nome')->get()
        ]);
    }

    public function update(Request $request, ChatAnexo $chatAnexo)
    {
        $validated = $request->validate([
            'it_id_chat_mensagem' => 'required|exists:chat_mensagems,id',
            'it_id_user_upload' => 'required|exists:users,id',
            'vc_nome_arquivo' => 'required|string|max:255',
            'vc_caminho_arquivo' => 'required|string|max:255',
        ]);
    
        $chatAnexo->update($validated);
    
        return redirect()->route('admin.chat_anexos.index')
            ->with('success', 'Anexo de chat atualizado com sucesso');
    }

    public function destroy(ChatAnexo $chatAnexo)
    {
        $chatAnexo->delete();
        return redirect()->route('admin.chat_anexos.index')
            ->with('success', 'Anexo de chat movido para o lixo com sucesso');
    }

    public function trash(Request $request)
    {
        $query = ChatAnexo::onlyTrashed()->with(['chatMensagem', 'userUpload']);
        if ($search = $request->input('search')) {
            $query->where('vc_nome_arquivo', 'like', "%{$search}%")
                  ->orWhereHas('chatMensagem', fn($q) => $q->where('vc_texto_mensagem', 'like', "%{$search}%"))
                  ->orWhereHas('userUpload', fn($q) => $q->where('vc_nome', 'like', "%{$search}%"));
        }
        $items = $query->latest()->paginate(10)->withQueryString();
        
        return Inertia::render('Admin/ChatAnexo/Trash', [
            'items' => $items,
            'filters' => $request->only(['search'])
        ]);
    }

    public function restore($id)
    {
        $item = ChatAnexo::onlyTrashed()->findOrFail($id);
        $item->restore();
        return redirect()->route('admin.chat_anexos.trash')
            ->with('success', 'Anexo de chat restaurado com sucesso');
    }

    public function purge($id)
    {
        $item = ChatAnexo::onlyTrashed()->findOrFail($id);
        $item->forceDelete();
        return redirect()->route('admin.chat_anexos.trash')
            ->with('success', 'Anexo de chat eliminado permanentemente');
    }
}