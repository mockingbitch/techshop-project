<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\RepositoryInterface\OrderDetailRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\OrderRepositoryInterface;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderRepo;
    protected $orderDetailRepo;
    protected $orderService;
    public function __construct(OrderRepositoryInterface $orderRepository,
                                OrderDetailRepositoryInterface $orderDetailRepository,
                                OrderService $orderService){
        $this->orderRepo = $orderRepository;
        $this->orderDetailRepo = $orderDetailRepository;
        $this->orderService = $orderService;
    }
    public function index(){
        $orders = $this->orderRepo->getAll();
        return view('admin.order.list-order',compact('orders'));
    }
    public function confirm($id){
       $msg = $this->orderService->confirm($id);
        return redirect()->route('list-order.index')->with('msg',$msg);
    }
    public function shipping($id){
        $msg = $this->orderService->shipping($id);
        return redirect()->route('list-order.index')->with('msg',$msg);
    }
}
