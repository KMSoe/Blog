<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostsTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/api/posts');

        $response->assertJson(["success" => true]);

       
        // $response = $this->get('/api/posts/' . $post->id);
        // $response->assertStatus(["meta" => ["id" => $post->id]]);
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function get_single_post()
    {
    }
}
