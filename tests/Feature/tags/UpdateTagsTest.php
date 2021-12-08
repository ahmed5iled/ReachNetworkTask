<?php

namespace Tests\Feature\tags;

use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class UpdateTagsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function authenticatedUserCannotUpdateTagsWithoutTitle()
    {
        $this->actAsAuthorizedUser();

        $tag = Tag::factory()->create();

        $newTag = Tag::factory()->make(['name' => null])->toArray();

        $response = $this->sendPostRequestToUpdateTags($tag, $newTag);

        $response->assertStatus(422);
    }

    /**
     * @test
     */
    public function authenticatedUserCanUpdateTags()
    {
        $this->actAsAuthorizedUser();

        $tag = Tag::factory()->create();

        $newTag = Tag::factory()->make()->toArray();

        $response = $this->sendPostRequestToUpdateTags($tag, $newTag);

        $response->assertStatus(200);

        unset($newTag['name']);

        $this->assertDatabaseMissing('tags', $tag->toArray());

        $this->assertDatabaseHas('tags', $newTag);

    }

    public function sendPostRequestToUpdateTags($tag, $newTag): TestResponse
    {
        $response = $this->json('post', route('tags.update', ['tag' => $tag->id]), $newTag);

        return $response;
    }
}
