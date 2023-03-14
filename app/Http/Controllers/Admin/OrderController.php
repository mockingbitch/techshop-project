<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\RepositoryInterface\OrderDetailRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\OrderRepositoryInterface;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    /**
     * @var $orderRepo
     */
    protected $orderRepo;

    /**
     * @var $orderDetailRepo
     */
    protected $orderDetailRepo;

    /**
     * @var $orderService
     */
    protected $orderService;

    /**     
     * @param OrderRepositoryInterface $orderRepository
     * @param OrderDetailRepositoryInterface $orderDetailRepository
     * @param OrderService $orderService
     */
    public function __construct(
        OrderRepositoryInterface $orderRepository,
        OrderDetailRepositoryInterface $orderDetailRepository,
        OrderService $orderService)
    {
        $this->orderRepo = $orderRepository;
        $this->orderDetailRepo = $orderDetailRepository;
        $this->orderService = $orderService;
    }

    /**
     * @return View
     */
    public function index() : View
    {
        $orders = $this->orderRepo->getAll();

        return view('admin.order.list-order', compact('orders'));
    }


    /**
     * @param int $id
     * 
     * @return void
     */
    public function confirm(int $id) 
    {
        $msg = $this->orderService->confirm($id);

        return redirect()->route('list-order.index')->with('msg', $msg);
    }

    /**
     * @param int $id
     * 
     * @return void
     */
    public function shipping(int $id) 
    {
        $msg = $this->orderService->shipping($id);

        return redirect()->route('list-order.index')->with('msg', $msg);
    }
}
