<?php

namespace Tests\Feature\Categories;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class UpdateCategoriesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function authenticatedUserCannotUpdateCategoriesWithoutTitle()
    {
        $this->actAsAuthorizedUser();

        $category = Category::factory()->create();

        $newCategory = Category::factory()->make(['name' => null])->toArray();

        $response = $this->sendPostRequestToUpdateCategories($category, $newCategory);

        $response->assertStatus(422);
    }

    /**
     * @test
     */
    public function authenticatedUserCanUpdateCategories()
    {
        $this->actAsAuthorizedUser();

        $category = Category::factory()->create();

        $newCategory = Category::factory()->make()->toArray();

        $response = $this->sendPostRequestToUpdateCategories($category, $newCategory);

        $response->assertStatus(200);

        unset($newCategory['name']);

        $this->assertDatabaseMissing('categories', $category->toArray());

        $this->assertDatabaseHas('categories', $newCategory);

    }

    public function sendPostRequestToUpdateCategories($category, $newCategory): TestResponse
    {
        $response = $this->json('post',route('categories.update', ['category' => $category->id]), $newCategory);

        return $response;
    }
}
