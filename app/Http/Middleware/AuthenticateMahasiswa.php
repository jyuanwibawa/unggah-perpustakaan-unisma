<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;

class AuthenticateMahasiswa
{
    public function handle(Request $request, callable $next): mixed
    {
        if (! $request->user('mahasiswa')) {
            return redirect()->route('mahasiswa.login');
        }

        return $next($request);
    }
}
