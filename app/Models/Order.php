<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';

    protected $fillable = [
        'customerId',
        'customerName',
        'email',
        'address',
        'phone',
        'note',
        'status',
        'subTotal',
        'code',
    ];
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customerId');
    }
}
