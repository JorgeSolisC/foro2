<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Post;
class ShowPostTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    function test_a_user_can_see_the_post_details()
    {
        //Having
        $user=$this->defaultUser([
            'name'=>'Duilio Palacios',
        ]);

        $post=factory(Post::class)->make([
            'title'=>'Este es el titulo del post',
            'content'=>'Este es el contenido del post',
        ]);

        $user->posts()->save($post);

        //when
        $this->visit(route('posts.show',$post))
            ->seeInElement('h1',$post->title)
            ->see($post->content)
            ->see($user->name);
    }
}
