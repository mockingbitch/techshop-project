<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
// use App\Models\Product;
class ProductServiceTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function setUp(){
        parent::setUp();
        $this->artisan('passport:install');
        Product::factory()->create();
    }
    public function test_example()
    {
        $this->assertTrue(true);
    }
    public function testSearchByPrice(){
       

    }
}
