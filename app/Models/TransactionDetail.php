<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransactionDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'product_id',
        'price',
        'qty',
        'subtotal',
    ];

    protected $casts = [
        'price' => 'integer',
        'qty' => 'integer',
        'subtotal' => 'integer',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}