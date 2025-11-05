<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {
        return view('profile.edit', ['user' => $request->user()]);
    }

    public function update(Request $request)
    {
        $user = $request->user();





        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'birth_date' => ['nullable', 'date'],
            'password' => ['nullable', 'confirmed', 'min:8'],
        ]);

        if (blank($data['password'] ?? null)) {
            unset($data['password']);
        }

        $user->update($data);

        if ($user->roles()->first()->name === 'author' || $user->roles()->first()->name === 'admin') {
            $authorData = $request->only([
                'site',
                'instagram',
                'phone',
                'about',
                'title',
            ]);

            $authorData = array_merge($authorData, [
                'name' => $user->name,
                'email' => $user->email,
            ]);

            $author = $user->author->update($authorData);
        }

        return back()->with('success', 'Perfil atualizado com sucesso!');
    }
}
