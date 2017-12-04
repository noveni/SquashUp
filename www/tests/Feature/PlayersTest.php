<?php

namespace Tests\Feature;

use App\User;
use App\Role;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PlayersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_superadmin_can_view_the_add_player_page()
    {
        $this->seed('RoleTableSeeder');
        $superadmin = factory(User::class)->create();
        $superadmin->roles()->attach(Role::where('name', 'superadmin')->first());

        $response = $this->actingAs($superadmin)
                        ->get(route('player.create'));

        $response->assertViewIs('player.create')
                ->assertSee('Add a player');
    }

    /** @test */
    public function an_admin_cannot_view_the_add_player_page()
    {
        $this->seed('RoleTableSeeder');
        $admin = factory(User::class)->create();
        $admin->roles()->attach(Role::where('name', 'admin')->first());

        $response = $this->actingAs($admin)
                        ->get(route('player.create'));

        $response->assertStatus(302)
                ->assertRedirect(route('player.index'));
    }

    /** @test */
    public function a_player_cannot_view_the_add_player_page()
    {
        $this->seed('RoleTableSeeder');
        $player = factory(User::class)->create();
        $player->roles()->attach(Role::where('name', 'player')->first());

        $response = $this->actingAs($player)
                        ->get(route('player.create'));

        $response->assertStatus(302)
                ->assertRedirect(route('player.index'));
    }


}
