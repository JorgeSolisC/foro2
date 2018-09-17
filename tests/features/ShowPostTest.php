<?php

use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ShowPostTest extends FeatureTestCase
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

        $post=$this->createPost([
            'title'=>'Este es el titulo del post',
            'content'=>'Este es el contenido del post',
            'user_id'=>$user->id,
        ]);

        //when
        $this->visit($post->url)
            ->seeInElement('h1',$post->title)
            ->see($post->content)
            ->see('Duilio Palacios');
    }
    function test_old_urls_are_redirected()
    {
        // Having
        $post = $this->createPost([
            'title' => 'Old title',
        ]);

        $url = $post->url;

        $post->update(['title' => 'New title']);

        $this->visit($url)
            ->seePageIs($post->url);
    }
}
