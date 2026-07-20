<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transaksis';

    protected $fillable = [
        'invoice',
        'user_id',
        'total',
        'paid',
        'change',
    ];

    protected $casts = [
        'total' => 'integer',
        'paid' => 'integer',
        'change' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function details()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}