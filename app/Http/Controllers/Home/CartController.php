<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\RepositoryInterface\CategoryRepositoryInterface;
use App\Services\CartService;
use App\Services\OrderService;
use Illuminate\Http\Request;
use App\Http\Requests\CheckOutRequest;
use Illuminate\Support\Facades\Auth;
use Mail;
use Str;
class CartController extends Controller
{
    protected $cartService;
    protected $categoryRepo;
    protected $orderService;
    public function __construct(CartService $cartService, CategoryRepositoryInterface $categoryRepository, OrderService $orderService)
    {
        $this->cartService = $cartService;
        $this->categoryRepo = $categoryRepository;
        $this->orderService = $orderService;
    }

    public function add(Request $request){
        $id = $request->query('id');
       
        $this->cartService->add($id);
    }
    public function addMany(Request $request){
        $id = $request->query('id');
        $quantity = $request->query('quantity');
        $this->cartService->addMany($id,$quantity);
    }
    public function index(){
        $carts = session()->get('cart');
        $categories = $this->categoryRepo->getAll();
        return view('home.pages.view-cart',compact('carts','categories'));
    }
    public function update(Request $request){
        $id = $request->query('id');
        $quantity = $request->query('quantity');
        $this->cartService->update($id,$quantity);
    }
    public function delete(Request $request){
        $id = $request->query('id');
        $this->cartService->delete($id);
    }
    public function checkOut(){
        $carts = session()->get('cart');
        $customer = Auth::guard('customer')->user();
        return view('home.pages.checkout',compact('carts','customer'));
    }
    public function addOrder(CheckOutRequest $request){
        $carts = session()->get('cart');
        $customer = Auth::guard('customer')->user();
        if(isset($customer)){
            $customerId = $customer->id;
        }
        else{
            $customerId = 2;
        }
        if (isset($carts)){
            $checkOut = $this->cartService->checkOut($carts,$request);
            $code = strtoupper(Str::random(10));
            $subTotal = $this->orderService->subTotal($carts);
            $this->orderService->add($request,$subTotal,$code,$carts,$customerId);
            session()->forget('cart');
        }
        return view('home.pages.thank-you');
    }
}
