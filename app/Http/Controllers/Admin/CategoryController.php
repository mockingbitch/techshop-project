<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Repositories\Contracts\RepositoryInterface\CategoryRepositoryInterface;
use Illuminate\View\View;

class CategoryController extends Controller
{

    /**
     * @var $categoryRepo
     */
    protected $categoryRepo;
 
    /**
     * @param CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepo = $categoryRepository;
    }

    /**
     * @return View
     */
    public function index() : View
    {
        $categories = $this->categoryRepo->getAll();

        return view('admin.category.list-category', compact('categories'));
    }

    /**
     * @param Request $request
     * 
     * @return View
     */
    public function create(Request $request) : View
    {
        return view('admin.category.add-category');
    }

    /**
     * @param Request $request
     * 
     * @return void
     */
    public function store(Request $request)
    {
        $this->categoryRepo->create($request->toArray());

        return redirect(route('list-category.index'));
    }

    /**
     * @param int $id
     * 
     * @return View
     */
    public function show(int $id) : View
    {
        $category = $this->categoryRepo->find($id);

        return view('admin.category.edit-category', compact('category'));
    }

    /**
     * @param Request $request
     * @param integer $id
     * 
     * @return void
     */
    public function update(Request $request, int $id)  
    {
        $this->categoryRepo->update($id, $request->toArray());

        return redirect(route('list-category.index'));
    }

    /**
     * @param int $id
     * 
     * @return void
     */
    public function destroy(int $id)
    {
        $this->categoryRepo->delete($id);

        return redirect()->back();
    }
}
