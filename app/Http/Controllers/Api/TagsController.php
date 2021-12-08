<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\TagsRequest;
use App\Models\Tag;
use App\Transformers\TagsTransformer;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

/**
 *
 */
class TagsController extends Controller
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
        $tags = Tag::orderBy('id', 'DESC')->get();

        $tags = fractal($tags, new TagsTransformer());

        return response()->json(['code' => 200, 'message' => 'Data fetched successfully', 'item' => $tags], 200);

    }

    /**
     * @param TagsRequest $request
     * @return JsonResponse
     */
    public function store(TagsRequest $request):JsonResponse
    {
        $tag = Tag::create($request->all());

        $tag = fractal($tag, new TagsTransformer());

        return response()->json(['code' => 200, 'message' => 'Data stored successfully', 'item' => $tag], 200);

    }

    /**
     * @param Tag $tag
     * @param TagsRequest $request
     * @return JsonResponse
     */
    public function update(Tag $tag, TagsRequest $request):JsonResponse
    {
        $tag->update($request->all());

        $tag = fractal($tag, new TagsTransformer());

        return response()->json(['code' => 200, 'message' => 'Data updated successfully', 'item' => $tag], 200);

    }

    /**
     * @param Tag $tag
     * @return JsonResponse
     */
    public function destroy(Tag $tag):JsonResponse
    {
        $tag->delete();

        return response()->json(['code' => 200, 'message' => 'Data deleted successfully', 'item' => '',], 200);

    }
}
