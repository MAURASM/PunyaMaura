<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Menampilkan halaman registrasi.
     * Metode ini mengembalikan view untuk halaman registrasi.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Menangani permintaan registrasi yang masuk.
     * Metode ini memvalidasi data permintaan, membuat user baru dan info user,
     * memicu event registered, melakukan login user, dan kemudian mengarahkan ke dashboard.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi data permintaan. Jika validasi gagal, akan dilempar exception
        // dan user akan diarahkan kembali ke form registrasi.
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'address' => ['required', 'string', 'max:225'],
            'phone' => ['required', 'numeric'],
        ]);

        // Membuat user baru dengan data yang telah divalidasi.
        User::create([
            'name' => $request->name,
            'user_type_id' => $request->user_type_id,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'address' => $request->address,
            'phone' => $request->phone,
            'bio' => '',
        ]);

        // Setelah registrasi berhasil
        session()->flash('register-success', 'Registrasi berhasil!');

        // Mengarahkan user ke dashboard.
        return redirect(route('login', absolute: false));
    }
}
