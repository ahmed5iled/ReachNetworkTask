<?php

namespace Tests\Feature\tags;

use App\Models\Category;
use App\Transformers\TagsTransformer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListTagsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function authenticatedUserCanListTags()
    {
        $this->actAsAuthorizedUser();

        $response = $this->json('get', route('tags.index'));

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function unauthenticatedUserCannotListTags()
    {
        Category::factory()->count(5)->create();

        $response = $this->json('get', route('tags.index'));

        $response->assertStatus(401);
    }
}
