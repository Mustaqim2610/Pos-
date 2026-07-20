<?php

namespace App\Models;

use App\Traits\HasInvoice;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasInvoice;
}