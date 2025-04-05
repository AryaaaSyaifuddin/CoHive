<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{

    public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Validasi input dari form
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'birthdate' => 'nullable|date',
            'gender'    => 'nullable|in:male,female,other',
            'phone'     => 'nullable|string|max:20',
            'address'   => 'nullable|string|max:255',
            'photo'     => 'nullable|image|max:2048', // maksimal 2MB
        ]);

        // Update nama pada tabel users
        $user->name = $validatedData['full_name'];
        $user->save();

        // Persiapkan data untuk profile
        $profileData = [
            'birth_date' => $validatedData['birthdate'] ?? null,
            'gender'     => $validatedData['gender'] ?? null,
            'phone'      => $validatedData['phone'] ?? null,
            'address'    => $validatedData['address'] ?? null,
        ];

        // Jika ada file foto, simpan file dan set path-nya
        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            $profile = Profile::firstOrNew(['user_id' => $user->id]);
            if ($profile->photo && Storage::disk('public')->exists($profile->photo)) {
                Storage::disk('public')->delete($profile->photo);
            }
            // Simpan file baru di folder 'profiles'
            $path = $request->file('photo')->store('profiles', 'public');
            $profileData['photo'] = $path;
        }

        // Update atau buat data profile
        Profile::updateOrCreate(
            ['user_id' => $user->id],
            $profileData
        );

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }
}
