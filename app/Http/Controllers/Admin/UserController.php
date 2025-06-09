<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TipoUser;
use Inertia\Inertia;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with('tipoUser');
        if ($search = $request->input('search')) {
            $query->where('vc_nome', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
        }
        $items = $query->latest()->paginate(10)->withQueryString();
        
        return Inertia::render('Admin/User/Index', [
            'items' => $items,
            'filters' => $request->only(['search'])
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/User/Create', [
            'tipoUsers' => TipoUser::select('id', 'vc_nome')->get()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'vc_nome' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'it_id_tipo_user' => 'required|exists:tipo_users,id',
        ]);
    
        User::create([
            'vc_nome' => $validated['vc_nome'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'it_id_tipo_user' => $validated['it_id_tipo_user'],
        ]);
    
        return redirect()->route('admin.users.index')
            ->with('success', 'User created successfully');
    }

    public function show(User $user)
    {
        $user->load('tipoUser');
        return Inertia::render('Admin/User/Show', [
            'item' => $user
        ]);
    }

    public function edit(User $user)
    {
        $user->load('tipoUser');
        return Inertia::render('Admin/User/Edit', [
            'item' => $user,
            'tipoUsers' => TipoUser::select('id', 'vc_nome')->get()
        ]);
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'vc_nome' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'it_id_tipo_user' => 'required|exists:tipo_users,id',
        ]);
    
        $user->update(array_filter([
            'vc_nome' => $validated['vc_nome'],
            'email' => $validated['email'],
            'password' => $validated['password'] ? Hash::make($validated['password']) : null,
            'it_id_tipo_user' => $validated['it_id_tipo_user'],
        ]));
    
        return redirect()->route('admin.users.index')
            ->with('success', 'User updated successfully');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')
            ->with('success', 'User moved to trash successfully');
    }

    public function trash(Request $request)
    {
        $query = User::onlyTrashed()->with('tipoUser');
        if ($search = $request->input('search')) {
            $query->where('vc_nome', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
        }
        $items = $query->latest()->paginate(10)->withQueryString();
        
        return Inertia::render('Admin/User/Trash', [
            'items' => $items,
            'filters' => $request->only(['search'])
        ]);
    }

    public function restore($id)
    {
        $item = User::onlyTrashed()->findOrFail($id);
        $item->restore();
        return redirect()->route('admin.users.trash')
            ->with('success', 'User restored successfully');
    }

    public function purge($id)
    {
        $item = User::onlyTrashed()->findOrFail($id);
        $item->forceDelete();
        return redirect()->route('admin.users.trash')
            ->with('success', 'User permanently deleted');
    }
}