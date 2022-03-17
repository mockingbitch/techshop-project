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
use Illuminate\View\View;

class CartController extends Controller
{
    /**
     * @var CartService
     */
    protected $cartService;

    /**
     * @var CategoryRepositoryInterface
     */
    protected $categoryRepo;

    /**
     * @var OrderService
     */
    protected $orderService;

    /**
     * @param CartService $cartService
     * @param CategoryRepositoryInterface $categoryRepository
     * @param OrderService $orderService
     */
    public function __construct(
        CartService $cartService, 
        CategoryRepositoryInterface $categoryRepository, 
        OrderService $orderService
    )
    {
        $this->cartService = $cartService;
        $this->categoryRepo = $categoryRepository;
        $this->orderService = $orderService;
    }

    /**
     * @param Request $request
     * 
     * @return void
     */
    public function add(Request $request) : void
    {
        $id = $request->query('id');

        $this->cartService->add($id);
    }

    /**
     * @param Request $request
     * 
     * @return void
     */
    public function addMany(Request $request) : void
    {
        $id = $request->query('id');
        $quantity = $request->query('quantity');
        $this->cartService->addMany($id, $quantity);
    }

    /**
     * @return View
     */
    public function index() : View
    {
        $carts = session()->get('cart');
        $categories = $this->categoryRepo->getAll();

        return view('home.pages.view-cart', compact('carts', 'categories'));
    }

    /**
     * @param Request $request
     * 
     * @return void
     */
    public function update(Request $request) : void
    {
        $id = $request->query('id');
        $quantity = $request->query('quantity');
        $this->cartService->update($id, $quantity);
    }

    /**
     * @param Request $request
     * 
     * @return void
     */
    public function delete(Request $request) : void
    {
        $id = $request->query('id');
        $this->cartService->delete($id);
    }

    /**
     * @return View
     */
    public function checkOut() : View
    {
        $carts = session()->get('cart');
        $customer = Auth::guard('customer')->user();

        return view('home.pages.checkout', compact('carts', 'customer'));
    }

    /**
     * @param Request $request
     * 
     * @return View
     */
    public function addOrder(Request $request) : View
    {
        $carts = session()->get('cart');
        $customer = Auth::guard('customer')->user();

        if (isset($customer)) {
            $customerId = $customer->id;
        } else {
            $customerId = 2;
        }

        if (isset($carts)) {
            $checkOut = $this->cartService->checkOut($carts, $request);
            $code = strtoupper(Str::random(10));
            $subTotal = $this->orderService->subTotal($carts);
            $this->orderService->add($request, $subTotal, $code, $carts, $customerId);
            session()->forget('cart');
        }

        return view('home.pages.thank-you');
    }
}
