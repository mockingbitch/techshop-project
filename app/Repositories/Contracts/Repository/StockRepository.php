<?php

namespace App\Repositories\Contracts\Repository;

use App\Models\Stock;
use App\Repositories\Contracts\RepositoryInterface\StockRepositoryInterface;
use App\Repositories\BaseRepository;

class StockRepository extends BaseRepository implements StockRepositoryInterface
{
    public function getModel()
    {
        return Stock::class;
    }
    public function getAllProduct()
    {
        $result = $this->model->orderBy('id','DESC')->paginate(10);
        return $result;
    }
}
