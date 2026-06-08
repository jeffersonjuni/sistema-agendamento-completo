<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(): View
    {
        return view('profile.edit');
    }

    public function update(Request $request): RedirectResponse
    {
        return back()->with('success', 'Perfil atualizado.');
    }

    public function destroy(Request $request): RedirectResponse
    {
        return redirect('/');
    }
}
