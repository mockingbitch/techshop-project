<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Repositories\Contracts\RepositoryInterface\OrderDetailRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\OrderRepositoryInterface;
use App\Services\CustomerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use PDF;
use Illuminate\View\View;

class CustomerController extends Controller
{
    /**
     * @var $customerService
     */
    protected $customerService;

    /**
     * @var $orderRepo
     */
    protected $orderRepo;

    /**
     * @var $orderDetailRepo
     */
    protected $orderDetailRepo;

    /**
     * @param CustomerService $customerService
     * @param OrderRepositoryInterface $orderRepo
     * @param OrderDetailRepositoryInterface $orderDetailRepository
     */
    public function __construct(
        CustomerService $customerService,
        OrderRepositoryInterface $orderRepo,
        OrderDetailRepositoryInterface $orderDetailRepository
    )
    {
        $this->customerService = $customerService;
        $this->orderRepo = $orderRepo;
        $this->orderDetailRepo = $orderDetailRepository;
    }

    /**
     * @return View
     */
    public function index() : View
    {
        return view('home.customer.login');
    }

    /**
     * @return View
     */
    public function registerForm() : View
    {
        return view('home.customer.register');
    }

    /**
     * @param Request $request
     * 
     * @return [type]
     */
    public function register(Request $request)
    {
        $customer = $this->customerService->create($request);

        if ($customer) {
            Mail::send('home.mail.mail-register', compact('customer'), function ($email) use($customer){
                $email->subject('Techshop - Xác nhận tài khoản của bạn!!!');
                $email->to($customer->email, $customer->customerName);
            });

            return redirect()->route('customer-login');
        }

        return redirect()->back();
    }

    /**
     * @param Request $request
     * 
     * @return [type]
     */
    public function login(Request $request)
    {
        $credentials =  $request->only('email', 'password');
        if (Auth::guard('customer')->attempt($credentials)) {
            if (Auth::guard('customer')->user()->emailVerify==''){
                Auth::guard('customer')->logout();
                return redirect()->route('customer-login')->with('msg', 'Please <a href="https://gmail.com">verify</a> your account');
                }
            elseif (Auth::guard('customer')->user()->emailVerify=='1'){
                return redirect('/home');
            }
            else{
                Auth::guard('customer')->logout();
                return redirect()->route('customer-login')->with('msg', 'Something went wrong');
            }
        }
        else{
            return view('home.customer.login')->with('msg', 'Wrong username or password!!!');
        }
    }

    /**
     * @return [type]
     */
    public function logout()
    {
        Auth::guard('customer')->logout();
        return redirect('/');
    }

    /**
     * @param Customer $customer
     * @param string $token
     * 
     * @return [type]
     */
    public function verify(Customer $customer, string $token)
    {
        if ($customer->rememberToken === $token){
            $customer->update(['emailVerify'=>1, 'rememberToken'=>null]);

            return redirect()->route('home.customer.login')->with('msg', 'Verify Success');
        } else {
            return redirect()->route('home.customer.login')->with('msg', 'Can not verify your email!');
        }
    }

    /**
     * @return [type]
     */
    public function history()
    {
        $customer = Auth::guard('customer')->user();
        $id = $customer->id;

        if (isset($customer)) {
            $orders = $this->orderRepo->getCustomerOrder($id);

            return view('home.pages.history', compact('orders'));
        } else {
            return redirect()->route('home');
        }
    }

    /**
     * @param int $id
     * 
     * @return View
     */
    public function viewOrderHistory(int $id) : View 
    {
        $orderDetails = $this->orderDetailRepo->getDetail($id);
        $customer = Auth::guard('customer')->user();

        if (request('pdf', false)) {
            $pdf = PDF::loadView('home.pdf.order-detail', compact('orderDetails', 'customer'));

            return $pdf->stream();
        }

        return view('home.pages.history-detail', compact('orderDetails'));
    }
}
