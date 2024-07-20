<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class CategoryController extends Controller
{

    public function index(Request $request)
    {
        $categories = QueryBuilder::for(Category::class)
            ->allowedFilters([
                'name',
                'description'
            ])
            ->paginate($request->get('per_page'));

        return CategoryResource::collection($categories);
    }


    public function store(StoreCategoryRequest $request)
    {
        $validate = $request->validated();

        $category = Category::create($validate);

        return new CategoryResource($category);
    }


    public function show(Category $category)
    {
        return new CategoryResource($category);
    }


    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $validate = $request->validated();

        $category->update($validate);

        return new CategoryResource($category);
    }


    public function destroy(Category $category)
    {
        $category->delete();

        return response()->noContent();
    }
}
