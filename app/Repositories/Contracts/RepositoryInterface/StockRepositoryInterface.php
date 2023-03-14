<?php


namespace App\Repositories\Contracts\RepositoryInterface;

use App\Repositories\BaseRepositoryInterface;

interface StockRepositoryInterface extends BaseRepositoryInterface
{
    public function getAllProduct();
}
