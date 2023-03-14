<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\RepositoryInterface\BrandRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\CategoryRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\ProductRepositoryInterface;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * @var $productRepo
     */
    protected $productRepo;
    
    /**
     * @var $categoryRepo
     */
    protected $categoryRepo;

    /**
     * @var $brandRepo
     */
    protected $brandRepo;
    
    /**
     * @var $productService
     */
    protected $productService;

    /**
     * @param ProductRepositoryInterface $productRepository
     * @param CategoryRepositoryInterface $categoryRepository
     * @param BrandRepositoryInterface $brandRepository
     * @param ProductService $productService
     */
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

    /**
     * @return View
     */
    public function index() : View
    {
        // session()->flush();
        $products = $this->productRepo->getAll();
        $brands = $this->brandRepo->getAll();
        $categories = $this->categoryRepo->getAll();

        if (isset($carts)) {
            $cartQuantity = count($carts);
        }

        return view('home.pages.home',compact('products','brands','categories'));
    }

    /**
     * @param int $id
     * 
     * @return View
     */
    public function productDetail(int $id) : View
    {
        $product = $this->productRepo->find($id);
        $related_products = $this->productRepo->showRelatedProduct($id);

        return view('home.pages.view-product-detail', compact('product', 'related_products'));
    }

    /**
     * @param int $id
     * 
     * @return View
     */
    public function showCategoryItems(int $id) : View
    {
        $products = $this->productRepo->findByCategoryId($id);
        $categories = $this->categoryRepo->getAll();

        return view('home.pages.list-product', compact('products', 'categories'));
    }

    /**
     * @param Request $request
     * 
     * @return View
     */
    public function search(Request $request) : View
    {
        $products = $this->productRepo->search($request);
        $categories = $this->categoryRepo->getAll();

        return view('home.pages.list-product', compact('products', 'categories'));
    }

    /**
     * @return View
     */
    public function getAll() : View
    {
        $categories = $this->categoryRepo->getAll();
        $products = $this->productRepo->getAllProduct();

        return view('home.pages.list-product', compact('products', 'categories'));
    }

    /**
     * @param Request $request
     * 
     * @return View
     */
    public function searchByPrice(Request $request) : View
    {
        $products = $this->productService->searchByPrice($request);

        return view('home.pages.search-by-price', compact('products'));
    }
}
