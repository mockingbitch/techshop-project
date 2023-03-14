<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddProductRequestForm;
use App\Repositories\Contracts\RepositoryInterface\BrandRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\CategoryRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\ProductRepositoryInterface;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $categoryRepo;
    protected $brandRepo;
    protected $productRepo;
    protected $productService;

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

    public function index()
    {
        $products = $this->productRepo->getAllProduct();
        return view('admin.product.list-product', compact('products'));
    }

    public function destroy($id)
    {
        $this->productService->delete($id);

        return redirect()->back();
    }

    public function edit($id)
    {
        $product = $this->productRepo->find($id);

        return view('admin.product.edit-product',compact('product'));
    }

    public function update($id, Request $request)
    {
        $this->productService->update($id, $request);

        return redirect()->route('list-product.index');
    }
    public function create()
    {
        $categories = $this->categoryRepo->getAll();
        $brands = $this->brandRepo->getAll();
        return view('admin.product.add-product',compact('categories','brands'));
    }
    public function store(AddProductRequestForm $request){
        $categories = $this->categoryRepo->getAll();
        $brands = $this->brandRepo->getAll();
        $data = $request->validated();
        $this->productService->add($data);
        return view('admin.product.add-product',compact('categories','brands'))->with('msg','*Thêm thành công');

    }
    public function show($id)
    {
        $categories = $this->categoryRepo->getAll();
        $brands = $this->brandRepo->getAll();
        $product = $this->productRepo->find($id);
        $product->load('category');
        return view('admin.product.edit-product',compact('product','categories','brands'));
    }
    public function viewDetail(Request $request)
    {
        $id = $request->query('id');
        $product = $this->productRepo->find($id);
        return response()->json($product);
    }
    public function export(){

    }
}
