<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnggotaController extends Controller
{
    public function update(Request $request, User $user)
    {
        // Validasi — pastikan option value di <select> sesuai ini
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'birth_date'  => 'nullable|date',
            'gender'      => 'nullable|in:male,female,other',
            'phone'       => 'nullable|string|max:20',
            'address'     => 'nullable|string|max:255',
            'role'        => 'required|in:Admin,Karyawan',
            'photo'       => 'nullable|image|max:2048',
        ]);

        // Update kolom role di users
        $user->role = $data['role'];
        $user->save();

        // Siapkan data profile
        $profileData = [
            'name'        => $data['name'],
            'birth_date'  => $data['birth_date'] ?? null,
            'gender'      => $data['gender']     ?? null,
            'phone'       => $data['phone']      ?? null,
            'address'     => $data['address']    ?? null,
        ];

        // Handle foto
        if ($request->hasFile('photo')) {
            if ($user->profile && $user->profile->photo) {
                Storage::disk('public')->delete($user->profile->photo);
            }
            $profileData['photo'] = $request->file('photo')
                                         ->store('profiles','public');
        }

        // Simpan profile
        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            $profileData
        );

        return back()->with('success','Profil berhasil diperbarui.');
    }
}
