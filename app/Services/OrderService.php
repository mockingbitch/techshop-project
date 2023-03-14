<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Repositories\Contracts\RepositoryInterface\OrderRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\ProductRepositoryInterface;
use App\Services\StockService;
use Illuminate\Support\Facades\Auth;
use Mail;
use App\Models\Cart;

class OrderService
{
    /**
     * @var $productRepo
     */
    protected $productRepo;
    
    /**
     * @var $orderRepo
     */
    protected $orderRepo;

    /**
     * @var $stockService
     */
    protected $stockService;

    /**
     * @param ProductRepositoryInterface $productRepository
     * @param OrderRepositoryInterface $orderRepository
     * @param StockService $stockService
     */
    public function __construct(
        ProductRepositoryInterface $productRepository ,
        OrderRepositoryInterface $orderRepository,
        StockService $stockService
    )
    {
        $this->productRepo = $productRepository;
        $this->orderRepo = $orderRepository;
        $this->stockService = $stockService;
    }

    /**
     * @param mixed $request
     * @param int $subTotal
     * @param mixed $code
     * @param mixed $carts
     * @param int $customerId
     * 
     * @return [type]
     */
    public function add($request, int $subTotal, $code, $carts, int $customerId)
    {
        $order=[
            'customerId'=>$customerId,
            'customerName'=>$request->customerName,
            'email'=>$request->email,
            'address'=>$request->address,
            'phone'=>$request->phone,
            'note'=>$request->note,
            'status'=>0,
            'subTotal'=> $subTotal,
            'code'=>$code
        ];
       $addOrder = Order::create($order);

       foreach ($carts as $cart) {
           $orderDetail = [
               'orderId'=>$addOrder->id,
               'productId'=>$cart['id'],
               'productName'=>$cart['productName'],
               'quantity'=>$cart['quantity'],
               'productPrice'=>$cart['productPrice'],
               'total'=> $cart['quantity']*$cart['productPrice'],
               'productImage'=>$cart['productImage'],
               'code'=>$code,
           ];
           $order = $this->stockService->subtractOrder($orderDetail['productId'], $orderDetail['quantity']);

           if ($order!=false) {
                OrderDetail::create($orderDetail);
           }

       }
    }

    /**
     * @param mixed $carts
     * 
     * @return [type]
     */
    public function subTotal($carts)
    {
        $subTotal = 0;

        foreach ($carts as $cart) {
            $orderDetail = [
                'quantity'=>$cart['quantity'],
                'productPrice'=>$cart['productPrice'],
                'total'=> $cart['quantity']*$cart['productPrice'],
            ];
            $total = $orderDetail['total'];
            $subTotal += $total;
        }

        return $subTotal;
    }

    /**
     * @param int $id
     * @param mixed $request
     * 
     * @return [type]
     */
    public function handle(int $id, $request) 
    {
        $order = $this->orderRepo->find($id);

        if ($order) {
            $result = $this->orderRepo->update($id, $request);

            return $result;
        }

        return false;
    }

    /**
     * @param int $id
     * 
     * @return [type]
     */
    public function getOrders(int $id) 
    {
        $orderDetails = OrderDetail::where('orderId', $id)->get();

        return $orderDetails;
    }

    /**
     * @param int $id
     * 
     * @return [type]
     */
    public function confirm(int $id) 
    {
        $data = ['status'=>1];
        $order = $this->orderRepo->find($id);
        if ($order['status']==1 || $order['status']==2) {
            $msg = '*Đơn hàng đã được xử lý';

            return false;
        } else {
            $this->orderRepo->update($id, $data);
        }
    }

    /**
     * @param int $id
     * 
     * @return [type]
     */
    public function shipping(int $id)
    {
        $data = ['status'=>2];
        $order = $this->orderRepo->find($id);
        if ($order['status']==0 || $order['status']==2) {
            return false;
        } else {
            $this->orderRepo->update($id, $data);
        }
    }
}
