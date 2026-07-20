<?php

namespace App\Models;

use App\Traits\HasInvoice;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasInvoice;

    protected $table = 'transaksis';

    protected $fillable = [
        'invoice',
        'user_id',
        'total',
        'paid',
        'change',
        'status',
    ];

    protected $casts = [
        'total'  => 'integer',
        'paid'   => 'integer',
        'change' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function details()
    {
        return $this->hasMany(TransactionDetail::class, 'transaction_id');
    }
}