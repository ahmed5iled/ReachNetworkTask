<?php

namespace Tests\Feature\Categories;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteCategoriesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function authenticatedUserCanDestroyCategories()
    {
        $this->actAsAuthorizedUser();

        $category = Category::factory()->create();

        $response = $this->json('delete', route('categories.destroy', ['category' => $category->id]));

        $response->assertStatus(200);

        $this->assertDatabaseMissing('categories', $category->toArray());
    }
}
