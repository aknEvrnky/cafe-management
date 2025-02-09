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

test('user can view current cafe edit page', function () {
    $otherCafe = Cafe::factory()->create();
    $user = $otherCafe->owner;

    $currentCafe = Cafe::factory()->create([
        'user_id' => $user->id,
    ]);

    $user->switchCafe($currentCafe);

    $this->actingAs($user);

    $this->get('/dashboard/cafes/edit-current-cafe')
        ->assertOk()
        ->assertInertia(fn(Assert $page) => $page
            ->component('Cafe/EditCurrentCafe')
        );
});

test('user can update current cafe settings', function () {
    $defaultCafe = Cafe::factory()->create();
    $user = $defaultCafe->owner;

    $this->actingAs($user);

    $cafe = Cafe::factory()->create([
        'user_id' => $user->id,
    ]);

    $user->switchCafe($cafe);

    $this->post('/dashboard/cafes/update-current-cafe', [
        'title' => 'The Coffee Shop',
        'slug' => 'the-coffee-shop',
    ])->assertRedirect('/dashboard/cafes/edit-current-cafe');

    assertDatabaseHas('cafes', [
        'id' => $cafe->id,
        'title' => 'The Coffee Shop',
        'slug' => 'the-coffee-shop',
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
