<?php

namespace Tests\Feature\Categories;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class CreateCategoriesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function authenticatedUserCannotAddCategoriesWithoutName()
    {
        // authenticated user
        $this->actAsAuthorizedUser();

        $categories = Category::factory()->make(['name' => null]);

        $response = $this->sendPostRequestToAddCategories($categories);

        $response->assertStatus(422);
    }

    /**
     * @test
     */
    public function authenticatedUserCanAddCategories()
    {
        // authenticated user
        $this->actAsAuthorizedUser();

        $categories = Category::factory()->make();

        $response = $this->sendPostRequestToAddCategories($categories);

        $response->assertStatus(200);

        // assert database has organization
        $categoriesInDB = Category::first();

        $this->assertNotNull($categoriesInDB);

    }

    /**
     * @param $categories
     * @return
     */
    public function sendPostRequestToAddCategories($categories): TestResponse
    {
        $response = $this->json('POST',route('categories.store'), $categories->toArray());

        return $response;
    }
}
