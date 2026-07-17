<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaksi extends Model
{
    protected $fillable = [
        'kode_invoice',
        'user_id',
        'total_harga',
        'bayar',
        'kembalian',
        'status'
    ];

    protected $casts = [
        'total_harga' => 'integer',
        'bayar'       => 'integer',
        'kembalian'   => 'integer'
    ];

    public function detail(): HasMany
    {
        return $this->hasMany(DetailTransaksi::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}