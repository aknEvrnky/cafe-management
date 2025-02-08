<?php

use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;
use function PHPUnit\Framework\assertEquals;

test('user can view login page', function () {
    $response = $this->get('/login')
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page->component('Auth/Create'));
});

test('user can login', function () {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ])->assertRedirect('/dashboard');

        assertEquals($user->id, auth()->id());
});

test('user can logout', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->post('/logout')
        ->assertRedirect('/');

    assertEquals(null, auth()->id());
});
