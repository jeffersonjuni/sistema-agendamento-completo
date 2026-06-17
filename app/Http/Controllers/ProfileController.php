<?php

namespace App\Http\Controllers;

use App\Http\Requests\Profile\UpdateProfileRequest;
use App\Http\Requests\Profile\UpdatePasswordRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index(Request $request): View
    {
        return view('profile.index', [
            'user' => $request->user(),
        ]);
    }

    public function updateProfile(
        UpdateProfileRequest $request
    ): RedirectResponse {

        $user = $request->user();

        $data = $request->validated();

        if ($request->hasFile('avatar')) {

            if (
                $user->avatar &&
                Storage::disk('public')->exists($user->avatar)
            ) {
                Storage::disk('public')->delete($user->avatar);
            }

            $data['avatar'] = $request
                ->file('avatar')
                ->store('avatars', 'public');
        }

        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'avatar' => $data['avatar'] ?? $user->avatar,
        ]);

        return back()->with(
            'success',
            'Perfil atualizado com sucesso.'
        );
    }

    public function updatePassword(
        UpdatePasswordRequest $request
    ): RedirectResponse {

        $request->user()->update([
            'password' => Hash::make(
                $request->password
            ),
        ]);

        return back()->with(
            'success',
            'Senha atualizada com sucesso.'
        );
    }
}
