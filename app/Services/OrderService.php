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
    protected $productRepo;
    protected $orderRepo;
    protected $stockService;
    public function __construct(ProductRepositoryInterface $productRepository ,
                                OrderRepositoryInterface $orderRepository,
                                StockService $stockService)
    {
        $this->productRepo = $productRepository;
        $this->orderRepo = $orderRepository;
        $this->stockService = $stockService;
    }
    public function add($request,$subTotal,$code,$carts,$customerId){
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
       foreach ($carts as $cart){
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
//           dd($orderDetail);
           $order = $this->stockService->subtractOrder($orderDetail['productId'],$orderDetail['quantity']);
           if ($order!=false){
                OrderDetail::create($orderDetail);
           }

       }
    }
    public function subTotal($carts){
        $subTotal = 0;
        foreach ($carts as $cart){
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
    public function handle($id,$request){
        $order = $this->orderRepo->find($id);
        if($order){
            $result = $this->orderRepo->update($id,$request);
            return $result;
        }
        return false;
    }
    public function getOrders($id){
        $orderDetails = OrderDetail::where('orderId',$id)->get();
        return $orderDetails;
    }
    public function confirm($id){
        $data = ['status'=>1];
        $order = $this->orderRepo->find($id);
        if ($order['status']==1 || $order['status']==2){
            $msg = '*Đơn hàng đã được xử lý';
            return $msg;
        }else{
            $this->orderRepo->update($id,$data);
            $msg = 'Done';
            return $msg;
        }
    }
    public function shipping($id){
        $data = ['status'=>2];
        $order = $this->orderRepo->find($id);
        if ($order['status']==0 || $order['status']==2){
            $msg = '*Đơn hàng chưa được xử lý';
            return $msg;

        }else{
            $this->orderRepo->update($id,$data);
            $msg = 'Done';
            return $msg;
        }
    }
}
