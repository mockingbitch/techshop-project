<?php

namespace App\Repositories\Contracts\Repository;

use App\Models\Brand;
use App\Repositories\Contracts\RepositoryInterface\BrandRepositoryInterface;
use App\Repositories\BaseRepository;

class BrandRepository extends BaseRepository implements BrandRepositoryInterface
{
    public function getModel()
    {
        return Brand::class;
    }
}
