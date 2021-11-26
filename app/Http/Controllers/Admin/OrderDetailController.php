<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\RepositoryInterface\OrderRepositoryInterface;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    protected $orderService;
    protected $orderRepo;
    public function __construct(OrderService $orderService, OrderRepositoryInterface $orderRepository){
        $this->orderService = $orderService;
        $this->orderRepo = $orderRepository;
    }
    public function index($id){
        $order = $this->orderRepo->find($id);
        $orderDetails = $this->orderService->getOrders($id);
        if (isset($orderDetails)){
            return view('admin.order.view-order',compact('order','orderDetails'));
        }
//        else{
//            return redirect()->route('list-order.index');
//        }
    }
    public function handleOrder($id, Request $request){
        $this->orderService->handle($id,$request);
    }
}
