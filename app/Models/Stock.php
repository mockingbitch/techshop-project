<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'stocks';

    /**
     * @var array
     */
    protected $fillable = [
        'productId',
        'quantity',
        'status',
        'productName',
        'productPrice',
        'productImage',
    ];
}
