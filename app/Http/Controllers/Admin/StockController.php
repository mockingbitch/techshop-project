<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\RepositoryInterface\StockRepositoryInterface;
use App\Services\StockService;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * @var $stockRepo
     */
    protected $stockRepo;

    /**
     * @var $stockService
     */
    protected $stockService;

    /**
     * @param StockRepositoryInterface $stockRepository
     * @param StockService $stockService
     */
    public function __construct(
        StockRepositoryInterface $stockRepository,
        StockService $stockService
    )
    {
        $this->stockRepo = $stockRepository;
        $this->stockService = $stockService;
    }

    /**
     * @return View
     */
    public function index() : View
    {
        $products = $this->stockRepo->getAllProduct();

        return view('admin.stock.stock', compact('products'));
    }

    /**
     * @param int $id
     * 
     * @return View
     */
    public function update(int $id) : View
    {
        $product = $this->stockRepo->find($id);

        return view('admin.stock.update-stock', compact('product'));
    }

    /**
     * @param int $id
     * @param Request $request
     * 
     * @return [type]
     */
    public function confirmUpdate(int $id, Request $request) 
    {
       $update =  $this->stockService->update($id, $request);
       if ($update != false) {
           return redirect()->route('stock.index')->with('msg', 'Cập nhật thành công!!!');
       } else {
           return view('admin.stock.update-stock')->with('msg', 'Something went wrong!!!');
       }
    }
}
