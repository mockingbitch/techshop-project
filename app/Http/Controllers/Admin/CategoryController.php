<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Repositories\Contracts\RepositoryInterface\CategoryRepositoryInterface;
class CategoryController extends Controller
{
    protected $categoryRepo;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepo = $categoryRepository;
    }

    public function index()
    {
        $categories = $this->categoryRepo->getAll();
        return view('admin.category.list-category', compact('categories'));
    }

    public function create(Request $request)
    {
        return view('admin.category.add-category');
    }

    public function store(Request $request)
    {
        $this->categoryRepo->create($request->toArray());
        return redirect(route('list-category.index'));
    }

    public function show($id)
    {
        $category = $this->categoryRepo->find($id);
        return view('admin.category.edit-category',compact('category'));
    }

    public function update(Request $request, $id)
    {
        $this->categoryRepo->update($id, $request->toArray());
        return redirect(route('list-category.index'));
    }

    public function destroy($id)
    {
        $this->categoryRepo->delete($id);
        return redirect()->back();
    }
}
