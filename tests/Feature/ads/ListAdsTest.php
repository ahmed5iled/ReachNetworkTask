<?php

namespace Tests\Feature\ads;

use App\Models\Ad;
use App\Models\Advertiser;
use App\Models\Category;
use App\Models\Tag;
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

        Ad::factory()->count(5)->for(Category::factory())
            ->for(Advertiser::factory())->has(Tag::factory()->count(3))->create();

        $response = $this->json('get', route('ads.index'));

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function unauthenticatedUserCannotListAds()
    {
        Ad::factory()->count(5)->for(Category::factory())
            ->for(Advertiser::factory())->has(Tag::factory()->count(3))->create();

        $response = $this->json('get', route('ads.index'));

        $response->assertStatus(401);
    }
}
