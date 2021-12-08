<?php

namespace Tests\Feature\Categories;

use App\Models\Category;
use App\Transformers\CategoriesTransformer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListCategoriesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function authenticatedUserCanListCategories()
    {
        $this->actAsAuthorizedUser();

        $categories = Category::factory()->count(5)->create();

        $categories = fractal($categories, new CategoriesTransformer())->toArray();

        $response = $this->json('get', route('categories.index'));

        $response->assertStatus(200);

        $this->assertEquals($categories, $response->decodeResponseJson()['item']);
    }

    /**
     * @test
     */
    public function unauthenticatedUserCannotListCategories()
    {
        Category::factory()->count(5)->create();

        $response = $this->json('get', route('categories.index'));

        $response->assertStatus(401);
    }
}
