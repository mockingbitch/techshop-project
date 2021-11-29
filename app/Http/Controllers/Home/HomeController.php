<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\RepositoryInterface\BrandRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\CategoryRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\ProductRepositoryInterface;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    protected $productRepo;
    protected $categoryRepo;
    protected $brandRepo;
    protected $productService;
    public function __construct(
        ProductRepositoryInterface $productRepository,
        CategoryRepositoryInterface $categoryRepository,
        BrandRepositoryInterface $brandRepository,
        ProductService $productService
    )
    {
        $this->productService = $productService;
        $this->productRepo = $productRepository;
        $this->categoryRepo = $categoryRepository;
        $this->brandRepo = $brandRepository;
    }
    public function index(){
        // session()->flush();
        $products = $this->productRepo->getAll();
        $brands = $this->brandRepo->getAll();
        $categories = $this->categoryRepo->getAll();
        if (isset($carts)){
            $cartQuantity = count($carts);
        }
        return view('home.pages.home',compact('products','brands','categories'));
    }
    public function productDetail($id){
        $product = $this->productRepo->find($id);
        $related_products = $this->productRepo->showRelatedProduct($id);
        return view('home.pages.view-product-detail',compact('product','related_products'));
    }
    public function showCategoryItems($id){
        $products = $this->productRepo->findByCategoryId($id);
        $categories = $this->categoryRepo->getAll();
        return view('home.pages.list-product',compact('products','categories'));
    }
    public function logout()
    {
        Auth::guard('customer')->logout();
        return redirect('/');
    }
    public function search(Request $request){
        $products = $this->productRepo->search($request);
        return view('home.pages.search',compact('products'));
    }
    public function getAll(){
        $categories = $this->categoryRepo->getAll();
        $products = $this->productRepo->getAllProduct();
        return view('home.pages.list-product',compact('products','categories'));
    }
    public function searchByPrice(Request $request){
        $products = $this->productService->searchByPrice($request);
        return view('home.pages.search-by-price',compact('products'));
    }
}
