<?php

use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class ExampleTest extends FeatureTestCase
{

    /**
     * A basic test example.
     *
     * @return void
     */
    function test_basic_test()
    {
        $user = factory(User::class)->create([
            'name' => 'Duilio Palacios',
            'email'=> 'admin@styde.net',
        ]);

        $this -> actingAs($user, 'api')
            ->visit('api/user')
            ->see('Duilio Palacios')
            ->see('admin@styde.net');
    }
}
