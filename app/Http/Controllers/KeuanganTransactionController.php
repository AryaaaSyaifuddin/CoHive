<?php

namespace App\Http\Controllers;

use App\Models\keuanganAccount;
use App\Models\KeuanganCategory;
use App\Models\KeuanganTransaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class KeuanganTransactionController extends Controller
{
    public function store(Request $request)
    {
        // 1) Validasi input
        $data = $request->validate([
            'account_id'          => 'required|exists:keuangan_accounts,id',
            'category_select'     => 'required',
            'new_category_name'   => 'required_if:category_select,new|string|max:255',
            'new_category_type'   => 'required_if:category_select,new|in:income,expense',
            'amount'              => 'required|numeric',
            'transaction_date'    => 'required|date',
            'description'         => 'nullable|string',
        ]);

        $userId = Auth::id();

        // 2) Buat kategori baru jika dipilih
        if ($data['category_select'] === 'new') {
            $category = KeuanganCategory::create([
                'user_id' => $userId,
                'name'    => $data['new_category_name'],
                'type'    => $data['new_category_type'],
            ]);
            $categoryId = $category->id;
            $categoryType = $data['new_category_type'];
        } else {
            $categoryId = (int) $data['category_select'];
            // ambil tipe dari kategori existing
            $categoryType = KeuanganCategory::findOrFail($categoryId)->type;
        }

        // 3) Simpan Transaksi
        $transaction = KeuanganTransaction::create([
            'user_id'          => $userId,
            'account_id'       => $data['account_id'],
            'category_id'      => $categoryId,
            'amount'           => $data['amount'],
            'transaction_date' => $data['transaction_date'],
            'description'      => $data['description'],
        ]);

        // 4) Update balance di keuangan_accounts
        $account = keuanganAccount::findOrFail($data['account_id']);
        if ($categoryType === 'income') {
            $account->increment('balance', $data['amount']);
        } else {
            $account->decrement('balance', $data['amount']);
        }

        return redirect()->back()->with('success', 'Transaksi berhasil ditambahkan!');
    }
}
