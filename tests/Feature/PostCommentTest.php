<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostCommentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_comment_on_a_post()
    {
        $this->withoutExceptionHandling();

        $this->actingAs($user = User::factory()->create(), 'api');

        $post = Post::factory()->create(['id'=>123]);

        $response = $this->post('/api/posts/'.$post->id.'/comment', [
            'body'=>'a great comment here'
        ])
            ->assertStatus(200);

        $comment = Comment::first();

        $this->assertCount(1, Comment::all());
        $this->assertEquals($user->id, $comment->user_id);
        $this->assertEquals($post->id, $comment->post_id);
        $this->assertEquals($comment->body, 'a great comment here');

            $response->assertJson([
                'data' => [
                    [
                        'data' => [
                            'type' => 'comments',
                            'comment_id' => 1,
                            'attributes' => [
                                'commented_by'=>[
                                    'data'=>[
                                        'user_id' => $user->id,
                                        'attributes' => [
                                            'name' => $user->name,
                                        ]
                                    ]
                                ],
                                'body' => 'a great comment here',
                                'commented_at' => $comment->created_at->diffForHumans(),
                            ]
                        ],
                        'links' => [
                            'self' => url('/posts/123'),
                        ]
                    ]
                ],
                'links' => [
                    'self' => url('/posts'),
                ]
            ]);
    }
}
