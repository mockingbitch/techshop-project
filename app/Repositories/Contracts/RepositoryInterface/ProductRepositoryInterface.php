<?php


namespace App\Repositories\Contracts\RepositoryInterface;

use App\Repositories\BaseRepositoryInterface;

interface ProductRepositoryInterface extends BaseRepositoryInterface
{
    public function findByCategoryId($id);
    public function showRelatedProduct($id);
    public function search($request);
    public function getAllProduct();
}
