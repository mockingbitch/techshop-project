<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\RepositoryInterface\StockRepositoryInterface;
use App\Services\StockService;
use Illuminate\Http\Request;

class StockController extends Controller
{
    protected $stockRepo;
    protected $stockService;
    public function __construct(StockRepositoryInterface $stockRepository,
                                StockService $stockService){
        $this->stockRepo = $stockRepository;
        $this->stockService = $stockService;
    }
    public function index(){
        $products = $this->stockRepo->getAllProduct();
        return view('admin.stock.stock',compact('products'));
    }
    public function update($id){
        $product = $this->stockRepo->find($id);
        return view('admin.stock.update-stock',compact('product'));
    }
    public function confirmUpdate($id, Request $request){
       $update =  $this->stockService->update($id,$request);
       if ($update != false){
           return redirect()->route('stock.index')->with('msg','Cập nhật thành công!!!');
       }
       else{
           return view('admin.stock.update-stock')->with('msg','Something went wrong!!!');
       }
    }
}
