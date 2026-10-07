<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class MahasiswaLoginController extends Controller
{
    public function show(): View
    {
        return view('auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nim' => ['required', 'numeric', 'digits:11'],
            'password' => ['required', 'string'],
        ]);

        $mahasiswa = Mahasiswa::where('nim', $validated['nim'])
            ->where('status', 'AKTIF')
            ->first();
        $user = $mahasiswa?->user;

        if (! $user || ! Hash::check($validated['password'], $user->password)) {
            return back()->withErrors([
                'password' => 'NIM atau kata sandi yang salah.',
            ])->onlyInput('nim');
        }

        $request->session()->regenerate();
        Auth::guard('mahasiswa')->login($user);

        return redirect()->intended(route('mahasiswa.dashboard'));
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('mahasiswa')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('mahasiswa.login');
    }
}
