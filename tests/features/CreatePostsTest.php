<?php
/**
 * Created by PhpStorm.
 * User: mxeng
 * Date: 16/09/2018
 * Time: 07:17 PM
 */

class CreatePostsTest extends FeatureTestCase
{
    public function test_a_user_create_a_post()
    {
        // Having o teniendo: condiciones iniciales necesarias para poder reproducir el feature.
        $title = 'Esta es una pregunta';
        $content = 'Este es el contenido';

        $this->actingAs($user = $this->defaultUser());

        //When o cuando: acciones que el usuario va a realizar con este feature.
        $this->visit(route('posts.create'))
            ->type($title, 'title')
            ->type($content, 'content')
            ->press('Publicar');

        // Then o entonces: resultados esperados del feature luego de ser ejecutado,
        // tales como: cambios en la base de datos, redirección a una ruta, si existen
        // elementos en una vista, notificaciones emitidas, correos enviados, etc.
        $this->seeInDatabase('posts', [
            'title' => $title,
            'content' => $content,
            'pending' => true,
            'user_id' => $user->id,
        ]);
        // Test a user is redirected to the posts details after creating it.
        $this->see($title);
    }
    function test_creating_a_post_requires_authentication()
    {
        $this->visit(route('posts.create'))
            ->seePageIs(route('login'));
    }
    function test_create_post_form_validation()
    {
        $this->actingAs($this->defaultUser())
            ->visit(route('posts.create'))
            ->press('Publicar')
            ->seePageIs(route('posts.create'))
            ->seeInElement('#field_title.has-error .help-block', 'El campo título es obligatorio')
            ->seeInElement('#field_content.has-error .help-block', 'El campo contenido es obligatorio');
    }
}