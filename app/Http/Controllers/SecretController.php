<?php

namespace App\Http\Controllers;

use App\Models\Secret;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class SecretController extends Controller
{
    public function create()
    {
        return view('secrets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => ['required', 'string', 'min:1'],
        ]);

        $secret = Secret::create([
            'content' => encrypt($request->content),
            'token'      => Secret::generateToken(),
            'expires_at' => now()->addDay(),
        ]);

        $url = route('secrets.show', $secret->token);

        return view('secrets.created', compact('url'));
    }

    public function show(string $token)
    {
        $secret = Secret::where('token', $token)->first();

        if (!$secret || $secret->isExpired()) {
            abort(404, 'Секрет не найден или уже уничтожен.');
        }

        $decryptedContent = Crypt::decrypt($secret->content);

        $secret->delete();

        return view('secrets.show', compact('decryptedContent'));
    }
}
