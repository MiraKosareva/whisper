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
            'max_views' => ['required', 'integer', 'in:1,3,5,10'],
        ]);

        $secret = Secret::create([
            'content' => encrypt($request->content),
            'token'      => Secret::generateToken(),
            'expires_at' => now()->addDay(),
            'user_id' => auth()->id(),
            'max_views'    => $request->max_views,
            'current_views' => 0,
        ]);

        $url = route('secrets.show', $secret->token);

        return view('secrets.created', compact('url'));
    }

    public function show(string $token)
    {
        $secret = Secret::where('token', $token)->first();

        if (!$secret || !$secret->canBeViewed()) {
            abort(404, 'Секрет не найден или уже недоступен.');
        }

        $decryptedContent = Crypt::decrypt($secret->content);

        $remainingViews = $secret->max_views - $secret->current_views - 1;

        $secret->incrementViews();

        $wasDestroyed = !Secret::where('token', $token)->exists();

        return view('secrets.show', compact('decryptedContent', 'wasDestroyed', 'remainingViews'));
    }
}
