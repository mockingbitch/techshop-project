<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
class OrderDetail extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'orderdetails';

    /**
     * @var array
     */
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
    /**
     * @return void
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'orderId');
    }
}
