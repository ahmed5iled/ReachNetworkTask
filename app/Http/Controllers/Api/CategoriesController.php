<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoriesRequest;
use App\Models\Category;
use App\Transformers\CategoriesTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 *
 */
class CategoriesController extends Controller
{
    /**
     *
     */
    public function __construct()
    {
        return $this->middleware('auth:api');
    }

    /**
     * @return JsonResponse
     */
    public function index():JsonResponse
    {
        $categories = Category::orderBy('id', 'DESC')->get();

        $categories = fractal($categories, new CategoriesTransformer());

        return response()->json(['code' => 200, 'message' => 'Data fetched successfully', 'item' => $categories], 200);

    }

    /**
     * @param CategoriesRequest $request
     * @return JsonResponse
     */
    public function store(CategoriesRequest $request):JsonResponse
    {
        $category = Category::create($request->all());

        $category = fractal($category, new CategoriesTransformer());

        return response()->json(['code' => 200, 'message' => 'Data stored successfully', 'item' => $category], 200);

    }

    /**
     * @param Category $category
     * @param CategoriesRequest $request
     * @return JsonResponse
     */
    public function update(Category $category, CategoriesRequest $request):JsonResponse
    {
        $category->update($request->all());

        $category = fractal($category, new CategoriesTransformer());

        return response()->json(['code' => 200, 'message' => 'Data updated successfully', 'item' => $category], 200);

    }

    /**
     * @param Category $category
     * @return JsonResponse
     */
    public function destroy(Category $category):JsonResponse
    {
        $category->delete();

        return response()->json(['code' => 200, 'message' => 'Data deleted successfully', 'item' => '',], 200);

    }
}
