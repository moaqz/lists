<?php

namespace Tests\Feature;

use App\Models\Group;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class GroupTest extends TestCase
{
    use RefreshDatabase;

    private string $table = 'groups';

    public function test_group_creation_fails_when_color_is_missing(): void
    {
        $user = User::factory()->create();
        $group = ['title' => 'Group #1'];

        $response = $this
            ->actingAs($user)
            ->postJson(route('group.store'), $group);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_unauthenticated_user_cannot_create_a_group(): void
    {
        $group = Group::factory()->make()->toArray();

        $response = $this->postJson(route('group.store'), $group);

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    public function test_successful_group_creation(): void
    {
        $user = User::factory()->create();
        $group = Group::factory()->make()->toArray();

        $response = $this
            ->actingAs($user)
            ->postJson(route('group.store'), $group);

        $response->assertStatus(Response::HTTP_CREATED);

        $lastGroup = Group::latest()->first();
        
        $this->assertDatabaseCount($this->table, 1);
        $this->assertEquals($group['color'], $lastGroup->color->value);
        $this->assertEquals($group['title'], $lastGroup->title);
    }

    public function test_successful_group_deletion(): void
    {
        $user = User::factory()->create();
        $group = Group::factory()->create(['user_id' => $user->id]);

        $response = $this
            ->actingAs($user)
            ->delete(route(
                'group.destroy',
                ['id' => $group->id]
            ));

        $response->assertStatus(Response::HTTP_NO_CONTENT);
        $this->assertDatabaseCount($this->table, 0);
        $this->assertDatabaseMissing($this->table, $group->toArray());
    }
}
