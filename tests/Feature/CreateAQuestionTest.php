<?php

use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;

it('should create a question bigger than 255 characters', function () {

    //Arrange
    $user = User::factory()->create();
    actingAs($user);

    //Act
    $request = Pest\Laravel\post(route(name: 'question.store'), [
        'question' => str_repeat(string: '*', times: 260).'?',
    ]);

    //Assert
    $request->assertRedirect(route('dashboard'));
    assertDatabaseCount(table: 'questions', count: 1);
    assertDatabaseHas('questions', ['question' => str_repeat(string: '*', times: 260).'?']);
});

it('does the question mark in the end?', function () {
    //Arrange
    $user = User::factory()->create();
    actingAs($user);

    //Act
    $request = Pest\Laravel\post(route(name: 'question.store'), [
        'question' => str_repeat(string: '*', times: 10),
    ]);

    //Assert
    $request->assertSessionHasErrors(['question' => 'Are you sure that is a question? It is missing the question mark in the end.']);
    assertDatabaseCount('questions', count: 0);
});

it('has to be at least 10 characters', function () {
    //Arrange
    $user = User::factory()->create();
    actingAs($user);

    //Act
    $request = Pest\Laravel\post(route(name: 'question.store'), [
        'question' => str_repeat(string: '*', times: 8).'?',
    ]);

    //Assert
    $request->assertSessionHasErrors(['question' => __('validation.min.string', ['min' => 10, 'attribute' => 'question'])]);
    assertDatabaseCount('questions', count: 0);
});
