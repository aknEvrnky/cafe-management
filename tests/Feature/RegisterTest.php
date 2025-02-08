<?php

use App\Models\Cafe;
use Inertia\Testing\AssertableInertia as Assert;
use function Pest\Laravel\assertDatabaseHas;

test('user can view register page', function () {
    $response = $this->get('/register')
        ->assertOk()
        ->assertInertia(fn(Assert $page) => $page->component('Register/Create'));
});

test('user can register', function () {
    $response = $this->post('/register', [
        'name' => 'John',
        'surname' => 'Doe',
        'email' => 'johndoe@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $response->assertRedirect('/dashboard');

    assertDatabaseHas('users', [
        'name' => 'John',
        'surname' => 'Doe',
        'email' => 'johndoe@example.com',
        'current_cafe_id' => 1
    ]);

    assertDatabaseHas('cafes', [
        'title' => 'John Doe Kafesi',
        'slug' => 'john-doe-kafesi',
        'user_id' => 1
    ]);
});

test('unique cafe slug will be generated automatically', function () {
    $otherCafe = Cafe::factory()->create([
        'title' => 'John Doe Kafesi',
        'slug' => 'john-doe-kafesi',
    ]);

    $response = $this->post('/register', [
        'name' => 'John',
        'surname' => 'Doe',
        'email' => 'johndoe@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $response->assertRedirect('/dashboard');

    assertDatabaseHas('cafes', [
        'title' => 'John Doe Kafesi',
        'slug' => 'john-doe-kafesi-1',
        'user_id' => 2
    ]);
});
