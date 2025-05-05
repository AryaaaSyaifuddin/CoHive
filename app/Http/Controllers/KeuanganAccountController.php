<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KeuanganAccount;
use Illuminate\Support\Facades\Auth;

class KeuanganAccountController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'balance' => 'required|numeric',
        ]);

        KeuanganAccount::create([
            'user_id' => Auth::id(), // Ambil ID user yang login
            'name' => $data['name'],
            'balance' => $data['balance'],
        ]);

        return redirect()->back()->with('success', 'Account berhasil ditambahkan!');
    }

    public function update(Request $request, KeuanganAccount $keuanganAccount)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:255',
            'balance' => 'required|numeric|min:0',
        ]);

        $keuanganAccount->update($data);

        return redirect()->back()->with('success', 'Account berhasil ditambahkan!');
    }
}
