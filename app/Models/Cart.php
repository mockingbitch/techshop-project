<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'carts';

    /**
     * @var array
     */
    protected $fillable = [
        'customerId',
        'productId',
        'quantity',
        'sessionId',
        'status',
        'productPrice',
        'productImage',
    ];
}
