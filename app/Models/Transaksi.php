<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    // Tambahkan baris ini untuk "izin" input data
    protected $fillable = ['keterangan', 'jenis', 'jumlah', 'user_id'];
}