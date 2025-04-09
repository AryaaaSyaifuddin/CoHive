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
        $users = Auth::user();

        // Validasi input dari form
        $validatedData = $request->validate([
            'name'      => 'required|string|max:255',
            'birthdate' => 'nullable|date',
            'gender'    => 'nullable|in:male,female,other',
            'phone'     => 'nullable|string|max:20',
            'address'   => 'nullable|string|max:255',
            'photo'     => 'nullable|image|max:2048', // maksimal 2MB
        ]);

        // Ambil atau buat data profile
        $profile = Profile::firstOrNew(['user_id' => $users->id]);

        // Persiapkan data untuk profile
        $profileData = [
            'name'       => $validatedData['name'] ?? null,
            'birth_date' => $validatedData['birthdate'] ?? null,
            'gender'     => $validatedData['gender'] ?? null,
            'phone'      => $validatedData['phone'] ?? null,
            'address'    => $validatedData['address'] ?? null,
        ];


        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($profile->photo && Storage::disk('public')->exists($profile->photo)) {
                Storage::disk('public')->delete($profile->photo);
            }
            // Simpan file baru di folder 'profiles'
            $path = $request->file('photo')->store('profiles', 'public');
            $profileData['photo'] = $path;
        }

        $profile->fill($profileData);
        $profile->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }

}
