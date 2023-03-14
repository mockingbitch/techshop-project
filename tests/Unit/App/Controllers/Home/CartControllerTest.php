<?php

namespace Tests\Unit\App\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\RepositoryInterface\CategoryRepositoryInterface;
use App\Services\CartService;
use App\Services\OrderService;
use Illuminate\Http\Request;
use App\Http\Requests\CheckOutRequest;
use Illuminate\Support\Facades\Auth;
use Mail;
use Str;
use Mockery;
use Mockery\LegacyMockInterface;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;

class CartControllerTest extends TestCase
{
    protected $cartService;
    protected $categoryRepo;
    protected $orderService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->cartService = Mockery::mock(CartService::class);
        $this->categoryRepo = Mockery::mock(CategoryRepositoryInterface::class);
        $this->orderService = Mockery::mock(OrderService::class);
    }

    public function testAdd()
    {
        $request = Mockery::mock(Request::class);
        $cart = $this->cart();

        $request->shouldReceive('query')->andReturn(1);
        $this->cartService->shouldReceive('add')->andReturnSelf();
        $result = $this->cartService->add($cart['id']);
        $this->assertEquals($request, $result);
    }

    public function cart()
    {
        return [
            'id'=>1,
            'productName'=>'asdsa',
            'productPrice'=> 123,
            'quantity'=>3,
            'productImage'=>'dadas.jpg'
        ];
    }


}
