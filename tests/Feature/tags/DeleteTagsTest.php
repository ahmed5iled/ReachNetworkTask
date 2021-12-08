<?php

namespace Tests\Feature\tags;

use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteTagsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function authenticatedUserCanDestroyTags()
    {
        $this->actAsAuthorizedUser();

        $tag = Tag::factory()->create();

        $response = $this->json('delete', route('tags.destroy', ['tag' => $tag->id]));

        $response->assertStatus(200);

        $this->assertDatabaseMissing('tags', $tag->toArray());
    }
}
