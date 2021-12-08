<?php

namespace Tests\Feature\ads;

use App\Models\Ad;
use App\Models\Category;
use App\Transformers\AdsTransformer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListAdsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function authenticatedUserCanListAds()
    {
        $this->actAsAuthorizedUser();

        $ads = Ad::factory()->count(5)->create();

        $ads = fractal($ads, new AdsTransformer())->toArray();

        $response = $this->json('get', route('ads.index'));

        $response->assertStatus(200);

        $this->assertEquals($ads, $response->decodeResponseJson()['item']);
    }

    /**
     * @test
     */
    public function unauthenticatedUserCannotListAds()
    {
        Ad::factory()->count(5)->create();

        $response = $this->json('get', route('ads.index'));

        $response->assertStatus(401);
    }
}
