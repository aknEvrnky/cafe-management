<?php

use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

test('user can view dashboard', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $response = $this->get('/dashboard')
        ->assertOk()
        ->assertInertia(fn(Assert $page) => $page
            ->component('Dashboard')
        );
});
