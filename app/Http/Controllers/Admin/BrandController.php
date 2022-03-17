<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\RepositoryInterface\BrandRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class BrandController extends Controller
{

    /**
     * @var BrandRepositoryInterface
     */
    protected $brandRepo;

    /**
     * @param BrandRepositoryInterface $brandRepository
     */
    public function __construct(BrandRepositoryInterface $brandRepository)
    {
        $this->brandRepo = $brandRepository;
    }

    /**
     * @return View
     */
    public function index() : View
    {
        $brands = $this->brandRepo->getAll();

        return view('admin.brand.list-brand', compact('brands'));
    }

    /**
     * @param Request $request
     *
     * @return View
     */
    public function create(Request $request) : View
    {
        return view('admin.brand.add-brand');
    }

    /**
     * @param Request $request
     * 
     * @return Redirect
     */
    public function store(Request $request) : Redirect
    {
        $this->brandRepo->create($request->toArray());

        return redirect(route('list-brand.index'));
    }

    /**
     * @param integer $id
     * 
     * @return View
     */
    public function show(int $id) : View
    {
        $brand = $this->brandRepo->find($id);
        
        return view('admin.brand.edit-brand', compact('brand'));
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @param integer $id
     * 
     * @return Redirect
     */
    public function update(Request $request, int $id) : Redirect
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
