<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Brand;
class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
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
    public function category()
    {
        return $this->belongsTo(Category::class, 'categoryId');
    }
    public function brand(){
        return $this->belongsTo(Brand::class,'brandId');
    }
    public function stock(){
        return $this->hasOne(Stock::class,'productId');
    }
}
