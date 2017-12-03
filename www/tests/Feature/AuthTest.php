<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_guest_cannot_register()
    {
        $response = $this->get('/register');

        $response->assertRedirect('/login');
    }

    /** @test */
    public function a_guest_cannot_access_home()
    {
        $response = $this->get('/home');

        $response->assertRedirect('/login');
    }

    /** @test */
    public function a_guest_can_access_presentation_page()
    {
        $response = $this->get('/');

        $response->assertSee('Welcome');
    }

    /** @test */
    public function a_guest_can_see_login_page()
    {
        $response = $this->get('/login');

        $response->assertSee('Login');
    }

    /** @test */
    public function a_user_can_login()
    {
        $user = factory(User::class)->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'secret',
        ]);

        $response->assertRedirect('/home');
    }

    public function a_logged_user_can_see_home()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
                        ->get('/home');

        $response->assertSee('You are logged in!');
    }
}
