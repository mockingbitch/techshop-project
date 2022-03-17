<?php

namespace App\Repositories\Contracts\Repository;

use App\Models\Product;
use App\Repositories\Contracts\RepositoryInterface\ProductRepositoryInterface;
use App\Repositories\BaseRepository;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function getModel()
    {
        return Product::class;
    }

    public function findByCategoryId($id){
        $result = $this->model->where('categoryId', $id)->paginate(9);
        
        return $result;
    }

    public function showRelatedProduct($id){
        $product = $this->model->find($id);
        $result = $this->model->where('brandId', $product->brandId)->get();

        return $result;
    }

    public function search($request){
        $textSearch = $request->input('textSearch');
        $result = $this->model->where('productName', 'LIKE', '%' . $textSearch . '%')->get();

        return $result;
    }

    public function getAllProduct()
    {
        $result = $this->model->orderBy('id', 'DESC')->paginate(9);

        return $result;
    }
}
