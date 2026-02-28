<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Debt extends Model
{
    // Tambahkan ini:
    protected $fillable = ['nama_peminjam', 'nomor_wa', 'jumlah_utang', 'keterangan', 'status', 'user_id'];
}