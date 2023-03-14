<?php

namespace App\Services;

use App\Repositories\Contracts\RepositoryInterface\StockRepositoryInterface;
use http\Env\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Stock;
use Illuminate\Support\Facades\Hash;
use phpDocumentor\Reflection\Types\False_;


class StockService
{
    /**
     * @var $stockRepo
     */
    protected $stockRepo;

    public function __construct(StockRepositoryInterface $stockRepository){
        $this->stockRepo = $stockRepository;
    }

    /**
     * @param integer $id
     * @param integer $quantity
     * 
     * @return boolean
     */
    public function subtractOrder(int $id, int $quantity) : boolean
    {
        $product = Stock::where('productId', $id)->get();
        $result = $product[0]['quantity'] - $quantity;
        if ($result >=0) {
            $product[0]->update(['quantity'=>$result]);

            return true;
        } else {
            return false;
        }
    }

    /**
     * @param int $id
     * @param int $request
     * 
     * @return boolean
     */
    public function update(int $id, int $request) : boolean
    {
        $product = $this->stockRepo->find($id);
        $quantity = $product->quantity;

        if (isset($request['import']) || isset($request['export'])) {
            if ($request['export']<=$quantity) {
                $newQuantity = $quantity + $request['import'] - $request['export'];
                $this->stockRepo->update($id, ['quantity'=>$newQuantity]);
                $after = $this->stockRepo->find($id);
                $quantityAfter = $after->quantity;

                if ($quantityAfter==0) { 
                    $this->stockRepo->update($id, ['status'=>0]);
                } else {
                    $this->stockRepo->update($id, ['status'=>1]);
                }

                return true;
            }

            return false;
        } 
        
        return false;
    }
}
