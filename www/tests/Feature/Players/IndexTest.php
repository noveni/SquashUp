<?php

namespace Tests\Feature;

use App\User;
use App\Role;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PlayerIndexTest extends TestCase
{
    use RefreshDatabase;


    /** @test */
    public function a_player_can_see_list_of_player()
    {
        $this->seed('RoleTableSeeder');
        $player = factory(User::class)->create();
        $players = factory(User::class,8)->create()->each(function ($user) {
            $user->roles()->attach(Role::where('name', 'player')->first());
        });
        $response = $this->actingAs($player)
                        ->get(route('player.index'));

        $response->assertSuccessful()
                ->assertViewIs('player.index')
                ->assertViewHas('players', User::players()->get())
                ->assertSee('List of players');
    }
}
