<?php

namespace App\Http\Controllers\Admin\Reference;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Referensi\CategoryRequest;
use App\Http\Resources\Admin\Referensi\CategoryResource;
use App\Models\Reference\Category;
use App\Services\Admin\Reference\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $category_service)
    {
        $this->categoryService = $category_service;
    }

    public function index()
    {
        return view('pages.admin.reference.category.index');
    }

    public function get(Request $request)
    {
        $result = Category::where('name', 'ILIKE', "%$request->search%")->paginate(20);
        return ResponseHelper::responseWithMeta((bool) $result, CategoryResource::collection($result));
    }

    public function store(CategoryRequest $request)
    {
        $result = $this->categoryService->create($request);
        return ResponseHelper::sendResponse((bool) $result, "tambahkan", "Kategori");
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $result = $this->categoryService->update($request, $category);
        return ResponseHelper::sendResponse((bool) $result, "update", "Kategori");
    }

    public function destroy(Category $category)
    {
        $result = $this->categoryService->delete($category);
        return ResponseHelper::sendResponse((bool) $result, "hapus", "Kategori");
    }
}
