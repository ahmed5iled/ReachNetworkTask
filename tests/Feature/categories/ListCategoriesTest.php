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

        Category::factory()->count(5)->create();

        $response = $this->json('get', route('categories.index'));

        $response->assertStatus(200);

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
