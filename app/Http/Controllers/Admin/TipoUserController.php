<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TipoUser;
use Inertia\Inertia;

class TipoUserController extends Controller
{
    public function index(Request $request)
    {
        $query = TipoUser::query();
        if ($search = $request->input('search')) {
            $query->where('vc_nome', 'like', "%{$search}%")
                  ->orWhere('vc_descricao', 'like', "%{$search}%");
        }
        $items = $query->latest()->paginate(10)->withQueryString();
        
        return Inertia::render('Admin/TipoUser/Index', [
            'items' => $items,
            'filters' => $request->only(['search'])
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/TipoUser/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'vc_nome' => 'required|string|max:255',
            'vc_descricao' => 'nullable|string|max:255',
        ]);
    
        TipoUser::create($validated);
    
        return redirect()->route('admin.tipo_users.index')
            ->with('success', 'Tipo de utilizador criado com sucesso');
    }

    public function show(TipoUser $tipoUser)
    {
        return Inertia::render('Admin/TipoUser/Show', [
            'tipo_user' => $tipo_user
        ]);
    }

    public function edit(TipoUser $tipoUser)
    {
        return Inertia::render('Admin/TipoUser/Edit', [
            'item' => $tipoUser
        ]);
    }

    public function update(Request $request, TipoUser $tipoUser)
    {
        $validated = $request->validate([
            'vc_nome' => 'required|string|max:255',
            'vc_descricao' => 'nullable|string|max:255',
        ]);
    
        $tipoUser->update($validated);
    
        return redirect()->route('admin.tipo_users.index')
            ->with('success', 'Tipo de utilizador atualizado com sucesso');
    }

    public function destroy(TipoUser $tipoUser)
    {
        $tipoUser->delete();
        return redirect()->route('admin.tipo_users.index')
            ->with('success', 'Tipo de utilizador movido para o lixo com sucesso');
    }

    public function trash(Request $request)
    {
        $query = TipoUser::onlyTrashed();
        if ($search = $request->input('search')) {
            $query->where('vc_nome', 'like', "%{$search}%")
                  ->orWhere('vc_descricao', 'like', "%{$search}%");
        }
        $items = $query->latest()->paginate(10)->withQueryString();
        
        return Inertia::render('Admin/TipoUser/Trash', [
            'items' => $items,
            'filters' => $request->only(['search'])
        ]);
    }

    public function restore($id)
    {
        $item = TipoUser::onlyTrashed()->findOrFail($id);
        $item->restore();
        return redirect()->route('admin.tipo_users.trash')
            ->with('success', 'Tipo de utilizador restaurado com sucesso');
    }

    public function purge($id)
    {
        $item = TipoUser::onlyTrashed()->findOrFail($id);
        $item->forceDelete();
        return redirect()->route('admin.tipo_users.trash')
            ->with('success', 'Tipo de utilizador eliminado permanentemente');
    }
}