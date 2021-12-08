<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdsRequest;
use App\Models\Ad;
use App\Transformers\AdsTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 *
 */
class AdsController extends Controller
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
    public function index(Request $request): JsonResponse
    {
        $ads = Auth::user()->ads()->orderBy('id', 'DESC');

        if ($request->category_id) {
            $ads = $ads->where('category_id', $request->category_id);
        }

        if ($request->tag) {
            $ads = $ads->whereHas('tags', function ($query) use ($request) {
                $query->where('name', 'like', '%%' . $request->tag . '%%');
            });
        }

        $ads = $ads->get();

        $ads = fractal($ads, new AdsTransformer());

        return response()->json(['code' => 200, 'message' => 'Data fetched successfully', 'item' => $ads], 200);

    }

    /**
     * @param AdsRequest $request
     * @return JsonResponse
     */
    public function store(AdsRequest $request): JsonResponse
    {
        $ad = Auth::user()->ads()->create($request->all());

        $ad->tags()->attach($request->tag_id);

        $ad = fractal($ad, new AdsTransformer());

        return response()->json(['code' => 200, 'message' => 'Data stored successfully', 'item' => $ad], 200);

    }

    /**
     * @param Ad $ad
     * @param AdsRequest $request
     * @return JsonResponse
     */
    public function update(Ad $ad, AdsRequest $request): JsonResponse
    {
        $ad->update($request->all());

        $ad->tags()->sync($request->tag_id);

        $ad = fractal($ad, new AdsTransformer());

        return response()->json(['code' => 200, 'message' => 'Data updated successfully', 'item' => $ad], 200);

    }

    /**
     * @param Ad $ad
     * @return JsonResponse
     */
    public function destroy(Ad $ad): JsonResponse
    {
        $ad->tags()->detach();

        $ad->delete();

        return response()->json(['code' => 200, 'message' => 'Data deleted successfully', 'item' => '',], 200);

    }
}
