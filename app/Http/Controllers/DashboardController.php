<?php

namespace App\Http\Controllers;

use App\Models\Secret;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $secrets = Secret::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('dashboard', compact('secrets'));
    }
}
