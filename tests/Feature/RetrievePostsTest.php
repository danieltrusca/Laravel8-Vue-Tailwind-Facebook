<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Post;
use App\Models\User;

class RetrievePostsTest extends TestCase
{
   use RefreshDatabase;

   /** @test */
   public function a_user_can_retrieve_posts()
   {
    $this->withoutExceptionHandling();
    $this->actingAs($user = User::factory()->create(), 'api');

    $posts = Post::factory()->count(2)->create(['user_id'=>$user->id]);

    $response = $this->get('/api/posts');

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    [
                        'data' => [
                            'type' => 'posts',
                            'post_id' => $posts->last()->id,
                            'attributes' => [
                                'body' => $posts->last()->body,
                                'image'=>$posts->last()->image,
                                'posted_at'=>$posts->last()->created_at->diffForHumans(),

                            ]
                        ]
                    ],
                    [
                        'data' => [
                            'type' => 'posts',
                            'post_id' => $posts->first()->id,
                            'attributes' => [
                                'body' => $posts->first()->body,
                                'image'=>$posts->last()->image,
                                'posted_at'=>$posts->first()->created_at->diffForHumans(),

                            ]
                        ]
                    ]
                ],
                'links' => [
                    'self' => url('/posts'),
                ]
            ]);
   }


       /** @test */
       public function a_user_can_only_retrieve_their_posts(){
        $this->withoutExceptionHandling();
        $this->actingAs($user = User::factory()->create(), 'api');

        $posts = Post::factory()->count(1)->create();

        $response = $this->get('/api/posts');

        $response->assertStatus(200)
            ->assertExactJson([
                'data' => [],
                'links' => [
                    'self' => url('/posts'),
                ]
            ]);
       }
}
