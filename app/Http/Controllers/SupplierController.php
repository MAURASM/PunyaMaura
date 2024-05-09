<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\UserInfo;

class SupplierController extends Controller
{
    /**
     * Menampilkan daftar sumber daya.
     */
    public function index()
    {
        return view('supplier.dashboard');
    }

    /**
     * Menampilkan formulir untuk mengedit sumber daya yang ditentukan.
     *
     * @param  string  $id
     */
    public function edit(string $id)
    {
        $user = User::where('user_type_id', '2')
            ->where('id', $id)
            ->first();

        return view('supplier.profile', compact('user'));
    }

    /**
     * Memperbarui sumber daya yang ditentukan dalam penyimpanan.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, string $id)
    {
        // Memvalidasi data yang diterima dari permintaan
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'address' => 'required|max:255',
            'phone' => 'required|numeric',
            'bio' => 'required|max:255',
            'avatar' => 'nullable|image|max:5120', // 5MB
        ]);

        // Menemukan user dan info pengguna terkait
        $user = User::findOrFail($id);

        // Jika terdapat file avatar yang diunggah, simpan ke direktori publik
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $avatar->move($destinationPath, $filename);
            $user->avatar = $filename;
        }

        // Memperbarui data pengguna dan info pengguna
        $user->name = $request->name;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->bio = $request->bio;

        // Menyimpan perubahan
        $user->save();

        // Mengarahkan kembali ke halaman edit dengan pesan sukses
        return redirect()->route('supplier.edit', $id)->with('success', 'Profil berhasil diperbarui');
    }
}
