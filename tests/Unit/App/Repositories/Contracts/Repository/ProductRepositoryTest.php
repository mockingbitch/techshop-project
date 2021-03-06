<?php
namespace Tests\Unit\App\Repositories\Contracts\Repository;
use Mockery;
use Mockery\LegacyMockInterface;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;

use App\Models\Product;
use App\Repositories\Contracts\RepositoryInterface\ProductRepositoryInterface;
use App\Repositories\BaseRepository;

class ProductRepositoryTest extends TestCase{
    protected $model;

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->model = Mockery::mock(App\Models\Product::class);

    }

    public function testFindByCategoryId()
    {
        $result = Mockery::mock(App\Repositories\BaseRepository::class);

        $this->model->shouldReceive('where')->andReturn($result);



    }
}
