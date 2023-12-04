<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;

    protected $table = 'sales';
    protected $fillable = [
        'code',
        'trx_date',
        'sub_amount',
        'amount_total',
        'total_products',
        'customer_id',
        'description',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
