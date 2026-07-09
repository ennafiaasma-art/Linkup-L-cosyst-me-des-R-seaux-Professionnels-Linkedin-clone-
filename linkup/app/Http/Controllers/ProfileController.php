<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //
    public function edit()
    {
        return view('profile.edit');
    }
    public function update(Request $request)
    {
        $request->validate([
            'headline' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'image_url' => 'nullable|url|max:500',
        ]);
         auth()->user()->update([
            'headline' => $request->headline,
            'company' => $request->company,
            'image_url' => $request->image_url,
        ]);

        return redirect()
            ->route('feed')
            ->with('success', 'Profil mis à jour avec succès.');
    }

}
