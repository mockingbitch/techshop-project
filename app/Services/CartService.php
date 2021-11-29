<?php
namespace App\Services;

use App\Repositories\Contracts\RepositoryInterface\ProductRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Mail;
use App\Models\Cart;
class CartService
{
    protected $productRepo;
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepo = $productRepository;
    }
    public function add($id){
        $products = $this->productRepo->find($id);
        $cart = session()->get('cart');
        if(isset($cart[$id])){
            $cart[$id]['quantity'] = $cart[$id]['quantity'] + 1;
        }else{
            $cart[$id]=[
                'id'=>$products->id,
                'productName'=>$products->productName,
                'productPrice'=> $products->productPrice,
                'quantity'=>1,
                'productImage'=>$products->productImage
            ];
        }
        session()->put('cart',$cart);
    }
    public function update($id,$quantity){
        if($id && $quantity){
            $cart = session()->get('cart');
            $cart[$id]['quantity'] = (int)$quantity ;
        }
        session()->put('cart',$cart);
    }
    public function delete($id){
        if($id){
            $cart = session()->get('cart');
            unset($cart[$id]);
            session()->put('cart',$cart);
        }
    }
    public function checkOut($carts,$request){
            $customer = Auth::guard('customer')->user();
            if(isset($customer)){
                $mail = $customer['email'];
                $name = $customer['name'];
            }
            else{
                $mail = $request['email'];
                $name = $request['name'];
            }
            $order = $request;
            Mail::send('home.mail.mail-cart',compact('name','carts','order'),function($email) use($mail,$name){
                $email->subject('Techshop - Xác nhận đơn hàng');
                $email->to($mail,$name);
            });
    }
}
