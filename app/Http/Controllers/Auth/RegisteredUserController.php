<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'alamat' => 'required',
            'no_telp' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $newUserId = $user->id;

        $pasien = Pasien::create([
            'user_id' => $newUserId,
            'nama_pasien' => $request->name,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
        ]);

        event(new Registered($user));

        Auth::login($user);

        $hak_akses = auth()->user()->hak_akses;

        if ($hak_akses === 'admin') {
            return redirect(route('index.admin', absolute: false));
            
        } else {
            return redirect(route('index', absolute: false));
        }
    }
}
