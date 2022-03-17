<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Stock;
use App\Repositories\Contracts\RepositoryInterface\ProductRepositoryInterface;
class ProductService
{
    /**
     * @var ProductRepositoryInterface
     */
    protected $productRepo;

    /**
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepo = $productRepository;
    }

    /**
     * @param $request array
     */
    public function add($request)
    {
        $request['productImage'] = $this->imageProcessing($request['productImage']);
        $product=$this->productRepo->create($request);

        if ($product->productQuantity >= 1) {
            $status = 1;
        } else {
            $status = 0;
        }

        $data = [
            'productId'=>$product->id,
            'quantity'=>$product->productQuantity,
            'status'=>$status,
            'productName'=>$product->productName,
            'productPrice'=>$product->productPrice,
            'productImage'=>$product->productImage,
        ];
        Stock::create($data);
    }

    /**
     * @param $id int
     * @param $request array
     */
    public function update(int $id, $request)
    {

        $product = [
            'productName' => $request->productName,
            'productDescription' => $request->productDescription,
            'productContent' => $request->productContent,
            'productPrice'=> $request->productPrice,
            'categoryId'=>$request->categoryId,
            'brandId'=>$request->brandId,
        ];

        if ($request->hasFile('productImage')) {
            $product['productImage'] = $this->imageProcessing($request->productImage);
        }

        $updateProduct = $this->productRepo->update($id, $product);

        if ($updateProduct->productQuantity >= 1) {
            $status = 1;
        } else {
            $status = 0;
        }

        $data = [
            'productId'=>$updateProduct->id,
            'quantity'=>$updateProduct->productQuantity,
            'status'=>$status,
            'productName'=>$updateProduct->productName,
            'productPrice'=>$updateProduct->productPrice,
            'productImage'=>$updateProduct->productImage,
        ];
        $stockId = Stock::where('productId',$id)->get();
        $a = $stockId->toArray();
        Stock::where('id', $a[0]['id'])->update($data);
    }

    /**
     * @param $request array
     * @return mixed
     */
    public function imageProcessing($file)
    {
        $productImage = uniqid('', true) . $file->getClientOriginalName();
        $file->move('uploads/product', $productImage);

        return $productImage;
    }

    /**
     * @param int $id
     * 
     * @return [type]
     */
    public function delete(int $id)
    {
        $product = Product::where('id', $id);
        $stock = Stock::where('productId', $id);


        if ($product && $stock) {
            $product->delete();
            $stock->delete();

            return true;
        }

        return false;
    }

    /**
     * @param mixed $request
     * 
     * @return [type]
     */
    public function searchByPrice($request)
    {
        $minPrice = $request->priceMin * 1000000 ;
        $maxPrice = $request->priceMax * 1000000;
        $products = Product::where('productPrice', '>=', $minPrice)->where('productPrice', '<=', $maxPrice)->get();

        return $products;
    }
}
