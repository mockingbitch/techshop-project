<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Brand;
class Product extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'products';

    /**
     * @var array
     */
    protected $fillable = [
        'productName',
        'productDescription',
        'productContent',
        'productPrice',
        'productImage',
        'categoryId',
        'brandId',
        'productQuantity',
    ];

    /**
     * @return void
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'categoryId');
    }

    /**
     * @return void
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brandId');
    }

    /**
     * @return void
     */
    public function stock(){
        return $this->hasOne(Stock::class, 'productId');
    }
}
