<?php
namespace App\Services;

use App\Repositories\Contracts\RepositoryInterface\ProductRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Mail;
use App\Models\Cart;
class CartService
{
    /**
     * @var $productRepo
     */
    protected $productRepo;

    /**
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepo = $productRepository;
    }

    /**
     * @param int $id
     * 
     * @return [type]
     */
    public function add(int $id)
    {
        $products = $this->productRepo->find($id);
        $cart = session()->get('cart');

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $cart[$id]['quantity'] + 1;
        } else {
            $cart[$id]=[
                'id'=>$products->id,
                'productName'=>$products->productName,
                'productPrice'=> $products->productPrice,
                'quantity'=>3,
                'productImage'=>$products->productImage
            ];
        }

        session()->put('cart', $cart);
    }

    /**
     * @param int $id
     * @param int $quantity
     * 
     * @return [type]
     */
    public function addMany(int $id, int $quantity){
        $products = $this->productRepo->find($id);
        $cart = session()->get('cart');

        if (isset($cart[$id]))
        {
            $cart[$id]['quantity'] = $cart[$id]['quantity'] + $quantity;
        } else {
            $cart[$id]=[
                'id'=>$products->id,
                'productName'=>$products->productName,
                'productPrice'=> $products->productPrice,
                'quantity'=>$quantity,
                'productImage'=>$products->productImage
            ];
        }

        session()->put('cart', $cart);
    }

    /**
     * @param int $id
     * @param int $quantity
     * 
     * @return [type]
     */
    public function update(int $id, int $quantity)
    {
        if ($id && $quantity) {
            $cart = session()->get('cart');
            $cart[$id]['quantity'] = (int)$quantity ;
        }

        session()->put('cart', $cart);
    }
    /**
     * @param int $id
     * 
     * @return [type]
     */
    public function delete(int $id)
    {
        if ($id) {
            $cart = session()->get('cart');
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
    }

    /**
     * @param mixed $carts
     * @param mixed $request
     * 
     * @return [type]
     */
    public function checkOut($carts, $request)
    {
            $customer = Auth::guard('customer')->user();

            if (isset($customer)) {
                $mail = $customer['email'];
                $name = $customer['name'];
            } else {
                $mail = $request['email'];
                $name = $request['name'];
            }

            $order = $request;
            Mail::send('home.mail.mail-cart', compact('name', 'carts', 'order'), function($email) use($mail, $name){
                $email->subject('Techshop - Xác nhận đơn hàng');
                $email->to($mail, $name);
            });
    }
}
