<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function index() {
    $user_id = Auth::id();
    
    // Pastikan penulisannya: nama_kolom, isi_variabel
    $data = Transaksi::where('user_id', $user_id)->get();
    
    $total_masuk = Transaksi::where('user_id', $user_id)->where('jenis', 'masuk')->sum('jumlah');
    $total_keluar = Transaksi::where('user_id', $user_id)->where('jenis', 'keluar')->sum('jumlah');
    $saldo = $total_masuk - $total_keluar;

    return view('keuangan', compact('data', 'saldo'));
}

    public function store(Request $request) {
        // Simpan data dengan menyertakan user_id
        Transaksi::create([
            'keterangan' => $request->keterangan,
            'jenis' => $request->jenis,
            'jumlah' => $request->jumlah,
            'user_id' => Auth::id() 
        ]);

        return redirect('/keuangan');
    }

    public function destroy($id) {
        // Cari data yang ID-nya cocok DAN milik user yang sedang login (keamanan)
        $transaksi = Transaksi::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $transaksi->delete();

        return redirect('/keuangan');
    }
}