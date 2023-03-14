<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\RepositoryInterface\BrandRepositoryInterface;
use Illuminate\Http\Request;

class BrandController extends Controller
{

    protected $brandRepo;

    public function __construct(BrandRepositoryInterface $brandRepository)
    {
        $this->brandRepo = $brandRepository;
    }

    public function index()
    {
        $brands = $this->brandRepo->getAll();
        return view('admin.brand.list-brand', compact('brands'));
    }

    public function create(Request $request)
    {
        return view('admin.brand.add-brand');
    }

    public function store(Request $request)
    {
        $this->brandRepo->create($request->toArray());
        return redirect(route('list-brand.index'));
    }

    public function show($id)
    {
        $brand = $this->brandRepo->find($id);
        return view('admin.brand.edit-brand',compact('brand'));
    }

    public function update(Request $request, $id)
    {
        $this->brandRepo->update($id, $request->toArray());
        return redirect(route('list-brand.index'));
    }

    public function destroy($id)
    {
        $this->brandRepo->delete($id);
        return redirect()->back();
    }
}
