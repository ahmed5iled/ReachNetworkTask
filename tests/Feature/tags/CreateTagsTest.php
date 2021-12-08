<?php

namespace Tests\Feature\tags;

use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class CreateTagsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function authenticatedUserCannotAddTagsWithoutName()
    {
        // authenticated user
        $this->actAsAuthorizedUser();

        $tags = Tag::factory()->make(['name' => null]);

        $response = $this->sendPostRequestToAddTags($tags);

        $response->assertStatus(422);
    }

    /**
     * @test
     */
    public function authenticatedUserCanAddTags()
    {
        // authenticated user
        $this->actAsAuthorizedUser();

        $tags = Tag::factory()->make();

        $response = $this->sendPostRequestToAddTags($tags);

        $response->assertStatus(200);

        // assert database has organization
        $tagsInDB = Tag::first();

        $this->assertNotNull($tagsInDB);

    }

    /**
     * @param $tags
     * @return
     */
    public function sendPostRequestToAddTags($tags): TestResponse
    {
        $response = $this->json('POST', route('tags.store'), $tags->toArray());

        return $response;
    }
}
