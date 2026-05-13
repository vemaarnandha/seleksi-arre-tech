<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AkunController extends Controller
{
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password ? bcrypt($request->password) : $user->password;

        if ($request->hasFile('profil')) {
            $file = $request->file('profil');
            $path = $file->store('profil', 'public');
            $user->profil = $path;
        }

        $user->save();

        return redirect()->route('postingan.index')->with('success', 'Profil berhasil diperbarui!');
    }

    public function destroyProfil($id)
    {
        $user = Auth::user();
        $user->profil = null;
        $user->save();

        return redirect()->route('postingan.index')->with('success', 'Foto profil berhasil dihapus!');
    }
}
