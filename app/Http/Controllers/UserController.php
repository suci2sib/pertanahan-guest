<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // Proteksi Ketat
        if (Auth::user()->role !== 'Super Admin') {
            return redirect()->route('dashboard.index')->with('error', 'Akses ditolak!');
        }
        
        $searchableColumns = ['name', 'email', 'role'];

        $data['dataUser'] = User::search($request, $searchableColumns)
            ->latest()
            ->paginate(9)
            ->withQueryString();

        return view('pages.user.index', $data);
    }

    public function create()
    {
        if (Auth::user()->role !== 'Super Admin') return redirect()->route('user.index');
        return view('pages.user.create');
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'Super Admin') return redirect()->route('user.index');

        $validated = $request->validate([
            'name' => 'required|string|max:20',
            'email' => 'required|string|email|max:100|unique:users',
            'role' => 'required|in:Super Admin,Admin,User',
            'password' => 'required|string|min:3|confirmed',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        User::create($validated);
        
        return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan!');
    }

    public function edit(string $id)
    {
        if (Auth::user()->role !== 'Super Admin') return redirect()->route('user.index');
        $data['dataUser'] = User::findOrFail($id);
        return view('pages.user.edit', $data);
    }

    public function update(Request $request, string $id)
    {
        if (Auth::user()->role !== 'Super Admin') return redirect()->route('user.index');

        $user = User::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:20',
            'email' => 'required|string|email|max:100|unique:users,email,' . $id,
            'role' => 'required|in:Super Admin,Admin,User',
            'password' => 'nullable|string|min:3|confirmed',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->role = $validated['role'];
        
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();
        return redirect()->route('user.index')->with('success', 'Data user berhasil diperbarui!');
    }

   public function destroy(string $id)
{
    // Pastikan logikanya: Jika BUKAN Admin DAN BUKAN Super Admin, maka tolak.
    if (Auth::user()->role !== 'Admin' && Auth::user()->role !== 'Super Admin') {
        return back()->with('error', 'Akses ditolak! Anda tidak memiliki izin.');
    }
        // Cegah menghapus diri sendiri
        if (Auth::id() == $id) {
            return redirect()->route('user.index')->with('error', 'Tidak bisa menghapus akun sendiri!');
        }

        $user = User::findOrFail($id);
        $user->delete();
        
        return redirect()->route('user.index')->with('success', 'Data user berhasil dihapus');
    }
}