<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/


$router->group(['prefix' => 'api'], function () use ($router) {

    $router->group(['prefix' => 'users'], function () use ($router) {

        $router->post('/login', 'AuthController@login');
        $router->post('/register', 'AuthController@register');

        $router->group(['prefix' => '/', 'middleware' => ['auth', 'admin']], function () use ($router) {
            $router->get('', 'UserController@index');
        });

        $router->group(['prefix' => '/{id}', 'middleware' => ['auth', 'owner']], function () use ($router) {
            $router->put('', 'UserController@update');
            $router->delete('', 'UserController@delete');
        });
    });

    $router->group(['prefix' => 'courses'], function () use ($router) {

        $router->group(['middleware' => ['auth', 'admin']], function () use ($router) {
            $router->post('/', 'CourseController@create');
        });

        $router->get('/', 'CourseController@index');
    });

    $router->post('course_users', ['middleware' => 'auth', 'uses' => 'CourseUserController@register']);

    $router->get('course_lessons', ['uses' => 'CourseLessonsController@index']);

    $router->put('course_lesson_users/{id}',
        ['middleware' => 'auth', 'uses' => 'CourseLessonUsersController@registration']);
});
