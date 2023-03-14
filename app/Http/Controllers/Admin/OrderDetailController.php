<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\RepositoryInterface\OrderRepositoryInterface;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    /**
     * @var $orderService
     */
    protected $orderService;

    /**
     * @var $orderRepo
     */
    protected $orderRepo;

    /**
     * @param OrderService $orderService
     * @param OrderRepositoryInterface $orderRepository
     */
    public function __construct(
        OrderService $orderService, 
        OrderRepositoryInterface $orderRepository
    )
    {
        $this->orderService = $orderService;
        $this->orderRepo = $orderRepository;
    }

    /**
     * @param int $id
     * 
     * @return View
     */
    public function index(int $id) : View
    {
        $order = $this->orderRepo->find($id);
        $orderDetails = $this->orderService->getOrders($id);

        if (isset($orderDetails)) {
            return view('admin.order.view-order', compact('order', 'orderDetails'));
        }
//        else{
//            return redirect()->route('list-order.index');
//        }
    }

    /**
     * @param int $id
     * @param Request $request
     * 
     * @return void
     */
    public function handleOrder(int $id, Request $request) : void
    {
        $this->orderService->handle($id, $request);
    }
}
