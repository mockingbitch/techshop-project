<?php


namespace App\Repositories\Contracts\Repository;

use App\Models\OrderDetail;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\RepositoryInterface\OrderDetailRepositoryInterface;

class OrderDetailRepository extends BaseRepository implements OrderDetailRepositoryInterface
{
    public function getModel()
    {
        return OrderDetail::class;
    }

    public function getDetail($id)
    {
        return $this->model->where('orderId', $id)->get();
    }
}
