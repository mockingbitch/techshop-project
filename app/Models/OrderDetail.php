<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
class OrderDetail extends Model
{
    use HasFactory;
    protected $table = 'orderdetails';

    protected $fillable = [
        'orderId',
        'productId',
        'productName',
        'quantity',
        'productPrice',
        'total',
        'productImage',
        'code',
    ];
    public function order()
    {
        return $this->belongsTo(Order::class, 'orderId');
    }
}
