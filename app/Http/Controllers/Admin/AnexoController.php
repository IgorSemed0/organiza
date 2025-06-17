<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anexo;
use App\Models\Cartao;
use App\Models\User;
use Inertia\Inertia;

class AnexoController extends Controller
{
    public function index(Request $request)
    {
        $query = Anexo::with(['cartao', 'userUpload']);
        if ($search = $request->input('search')) {
            $query->where('vc_nome_arquivo', 'like', "%{$search}%")
                  ->orWhereHas('cartao', fn($q) => $q->where('vc_titulo', 'like', "%{$search}%"))
                  ->orWhereHas('userUpload', fn($q) => $q->where('vc_nome', 'like', "%{$search}%"));
        }
        $items = $query->latest()->paginate(10)->withQueryString();
        
        return Inertia::render('Admin/Anexo/Index', [
            'items' => $items,
            'filters' => $request->only(['search'])
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Anexo/Create', [
            'cartaos' => Cartao::select('id', 'vc_titulo')->get(),
            'users' => User::select('id', 'vc_nome')->get()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'it_id_cartao' => 'required|exists:cartaos,id',
            'it_id_user_upload' => 'required|exists:users,id',
            'vc_nome_arquivo' => 'required|string|max:255',
            'vc_caminho_arquivo' => 'required|string|max:255',
        ]);
    
        Anexo::create($validated);
    
        return redirect()->route('admin.anexos.index')
            ->with('success', 'Anexo criado com sucesso');
    }

    public function show(Anexo $anexo)
    {
        $anexo->load(['cartao', 'userUpload']);
        return Inertia::render('Admin/Anexo/Show', [
            'item' => $anexo
        ]);
    }

    public function edit(Anexo $anexo)
    {
        $anexo->load(['cartao', 'userUpload']);
        return Inertia::render('Admin/Anexo/Edit', [
            'item' => $anexo,
            'cartaos' => Cartao::select('id', 'vc_titulo')->get(),
            'users' => User::select('id', 'vc_nome')->get()
        ]);
    }

    public function update(Request $request, Anexo $anexo)
    {
        $validated = $request->validate([
            'it_id_cartao' => 'required|exists:cartaos,id',
            'it_id_user_upload' => 'required|exists:users,id',
            'vc_nome_arquivo' => 'required|string|max:255',
            'vc_caminho_arquivo' => 'required|string|max:255',
        ]);
    
        $anexo->update($validated);
    
        return redirect()->route('admin.anexos.index')
            ->with('success', 'Anexo atualizado com sucesso');
    }

    public function destroy(Anexo $anexo)
    {
        $anexo->delete();
        return redirect()->route('admin.anexos.index')
            ->with('success', 'Anexo movido para o lixo com sucesso');
    }

    public function trash(Request $request)
    {
        $query = Anexo::onlyTrashed()->with(['cartao', 'userUpload']);
        if ($search = $request->input('search')) {
            $query->where('vc_nome_arquivo', 'like', "%{$search}%")
                  ->orWhereHas('cartao', fn($q) => $q->where('vc_titulo', 'like', "%{$search}%"))
                  ->orWhereHas('userUpload', fn($q) => $q->where('vc_nome', 'like', "%{$search}%"));
        }
        $items = $query->latest()->paginate(10)->withQueryString();
        
        return Inertia::render('Admin/Anexo/Trash', [
            'items' => $items,
            'filters' => $request->only(['search'])
        ]);
    }

    public function restore($id)
    {
        $item = Anexo::onlyTrashed()->findOrFail($id);
        $item->restore();
        return redirect()->route('admin.anexos.trash')
            ->with('success', 'Anexo restaurado com sucesso');
    }

    public function purge($id)
    {
        $item = Anexo::onlyTrashed()->findOrFail($id);
        $item->forceDelete();
        return redirect()->route('admin.anexos.trash')
            ->with('success', 'Anexo eliminado permanentemente');
    }
}