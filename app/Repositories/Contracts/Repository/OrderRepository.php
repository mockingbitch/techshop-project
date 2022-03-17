<?php

namespace App\Repositories\Contracts\Repository;

use App\Models\Order;
use App\Repositories\Contracts\RepositoryInterface\OrderRepositoryInterface;
use App\Repositories\BaseRepository;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    public function getModel()
    {
        return Order::class;
    }

    public function getCustomerOrder($id)
    {
       return $this->model->where('customerId', $id)->get();
    }
}
