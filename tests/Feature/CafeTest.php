<?php

use App\Models\Cafe;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;
use function Pest\Laravel\assertDatabaseHas;

test('user can view create cafe page', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $this->get('/dashboard/cafes/create')
        ->assertOk()
        ->assertInertia(fn(Assert $page) => $page->component('Cafe/Create'));
});

test('user can create a new cafe', function () {
    $defaultCafe = Cafe::factory()->create();
    $user = $defaultCafe->owner;

    $this->actingAs($user);

    $this->post('/dashboard/cafes', [
        'user_id' => $user->id,
        'title' => 'The Coffee Shop',
        'slug' => 'the-coffee-shop',
    ])->assertRedirect('/dashboard');

    assertDatabaseHas('cafes', [
        'user_id' => $user->id,
        'title' => 'The Coffee Shop',
        'slug' => 'the-coffee-shop',
    ]);

    assertDatabaseHas('users', [
        'id' => $user->id,
        'current_cafe_id' => 2,
    ]);
});

test('user can switch to other cafe', function () {
    $defaultCafe = Cafe::factory()->create();
    $user = $defaultCafe->owner;

    $this->actingAs($user);

    $cafe = Cafe::factory()->create([
        'user_id' => $user->id,
    ]);

    $this->put('/dashboard/cafes/switch', [
        'cafe_id' => $cafe->id,
    ])->assertRedirect('/dashboard');

    assertDatabaseHas('users', [
        'id' => $user->id,
        'current_cafe_id' => $cafe->id,
    ]);
});

test('slug generate service works expectedly', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $this->post('/dashboard/cafes/unique-slug', [
        'title' => 'The Coffee Shop',
    ])->assertJson([
        'slug' => 'the-coffee-shop',
    ]);

});
