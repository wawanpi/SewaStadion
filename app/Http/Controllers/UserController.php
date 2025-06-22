<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $search = request('search');
        if ($search) {
            $users = User::where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            })
            ->orderBy('name')
            ->paginate(20)
            ->withQueryString();
        } else {
            $users = User::orderBy('name')->paginate(20);
        }
        return view('user.index', compact('users'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'is_admin' => $request->has('is_admin'),
        ]);

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil ditambahkan');
    }

    public function toggleAdmin(User $user)
    {
        $user->update(['is_admin' => !$user->is_admin]);
        
        $message = $user->is_admin 
            ? 'Pengguna berhasil dijadikan Admin' 
            : 'Pengguna berhasil diturunkan menjadi User';
            
        return back()->with('success', $message);
    }

    public function toggleActive(User $user)
    {
        $user->update(['is_active' => !$user->is_active]);
        
        $message = $user->is_active 
            ? 'Pengguna berhasil diaktifkan' 
            : 'Pengguna berhasil dinonaktifkan';
            
        return back()->with('success', $message);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'Pengguna berhasil dihapus');
    }
}