<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;


class PostToTimelineTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('public');
    }

     /** @test */
     public function a_user_can_post_a_text_post(){

        //$this->withoutExceptionHandling();

        $this->actingAs($user = User::factory()->create(), 'api');

        $response = $this->post('/api/posts', [
            'body' => 'Testing Body',
        ]);

        $post = Post::first();

        $this->assertCount(1, Post::all());
        $this->assertEquals($user->id, $post->user_id);
        $this->assertEquals('Testing Body', $post->body);
        $response->assertStatus(201)
        ->assertJson([
            'data' => [
                'type' => 'posts',
                'post_id' => $post->id,
                'attributes' => [
                    'posted_by' => [
                        'data' => [
                            'attributes' => [
                                'name' => $user->name,
                            ]
                        ]
                    ],
                    'body' => 'Testing Body',
                ]
            ],
            'links' => [
                'self' => url('/posts/'.$post->id),
            ]
        ]);;
     }

     /** @test */
     public function a_user_can_post_a_text_post_with_an_image(){

        $this->withoutExceptionHandling();

        $this->actingAs($user = User::factory()->create(), 'api');

        $file=UploadedFile::fake()->image('user-post.jpg');

        $response = $this->post('/api/posts', [
            'body' => 'Testing Body',
            'image'=>$file,
            'height'=>100,
            'width'=>100
        ]);

        $post = Post::first();

        Storage::disk('public')->assertExists('post-images/'.$file->hashName());


        $response->assertStatus(201)
        ->assertJson([
            'data' => [
                'attributes' => [
                    'body' => 'Testing Body',
                    'image' => url('post-images/'.$file->hashName()),
                ]
            ]
        ]);
     }
}
