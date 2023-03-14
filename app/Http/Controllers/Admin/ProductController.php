<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddProductRequestForm;
use App\Repositories\Contracts\RepositoryInterface\BrandRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\CategoryRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\ProductRepositoryInterface;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * @var $categoryRepo
     */
    protected $categoryRepo;

    /**
     * @var $brandRepo
     */
    protected $brandRepo;
    
    /**
     * @var $productRepo
     */
    protected $productRepo;

    /**
     * @var $productService
     */
    protected $productService;

    /**
     * @param ProductRepositoryInterface $productRepository
     * @param ProductService $productService
     * @param CategoryRepositoryInterface $categoryRepotory
     * @param BrandRepositoryInterface $brandRepository
     */
    public function __construct(
        ProductRepositoryInterface $productRepository,
        ProductService $productService,
        CategoryRepositoryInterface $categoryRepotory,
        BrandRepositoryInterface $brandRepository
    )
    {
        $this->productRepo = $productRepository;
        $this->productService = $productService;
        $this->categoryRepo = $categoryRepotory;
        $this->brandRepo = $brandRepository;
    }

    public function index() : View
    {
        $products = $this->productRepo->getAllProduct();

        return view('admin.product.list-product', compact('products'));
    }

    /**
     * @param int $id
     * 
     * @return void
     */
    public function destroy(int $id) 
    {
        $this->productService->delete($id);

        return redirect()->back();
    }

    /**
     * @param int $id
     * 
     * @return View
     */
    public function edit(int $id) : View
    {
        $product = $this->productRepo->find($id);

        return view('admin.product.edit-product', compact('product'));
    }

    /**
     * @param int $id
     * @param Request $request
     * 
     * @return void
     */
    public function update(int $id, Request $request)
    {
        $this->productService->update($id, $request);

        return redirect()->route('list-product.index');
    }

    /**
     * @return View
     */
    public function create() : View
    {
        $categories = $this->categoryRepo->getAll();
        $brands = $this->brandRepo->getAll();

        return view('admin.product.add-product', compact('categories', 'brands'));
    }

    /**
     * @param AddProductRequestForm $request
     * 
     * @return View
     */
    public function store(AddProductRequestForm $request) : View
    {
        $categories = $this->categoryRepo->getAll();
        $brands = $this->brandRepo->getAll();
        $data = $request->validated();
        $this->productService->add($data);

        return view('admin.product.add-product', compact('categories', 'brands'))->with('msg', '*Thêm thành công');

    }

    /**
     * @param int $id
     * 
     * @return View
     */
    public function show(int $id) : View
    {
        $categories = $this->categoryRepo->getAll();
        $brands = $this->brandRepo->getAll();
        $product = $this->productRepo->find($id);
        $product->load('category');
        
        return view('admin.product.edit-product', compact('product', 'categories', 'brands'));
    }

    /**
     * @param Request $request
     * 
     * @return void
     */
    public function viewDetail(Request $request) 
    {
        $id = $request->query('id');
        $product = $this->productRepo->find($id);

        return response()->json($product);
    }
}
