<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     *  Run the preliminary testing setup.
     *
     *  @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        if (config('enraiged.auth.allow_login') !== true) {
            $this->markTestSkipped('Not applicable.');
        }

        $this->seed();
    }

    /**
     *  Test whether the login page returns a successful response.
     *
     *  @return void
     */
    public function test_the_login_page_returns_a_successful_response(): void
    {
        $response = $this->get(route('login'));
        $response->assertStatus(200);
    }

    /**
     *  Test whether the login form contains the necessary fields.
     *
     *  @return void
     */
    public function test_the_login_form_contains_all_necessary_fields(): void
    {
        $this->get(route('login'))
            ->assertInertia(fn (Assert $page) => $page
                ->component('auth/Login')
                ->has('form.fields', fn (Assert $fields) => $fields
                    ->has('email')
                    ->has('password')
                    ->has('remember')
                )
            );
    }

    /**
     *  Test whether a valid user can successfully log in.
     *
     *  @return void
     */
    public function test_a_valid_user_can_login(): void
    {
        $model = auth_model();
        $user = $model::factory()->create();

        $response = $this->post(route('login.store'), [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertStatus(302);

        $this->assertAuthenticatedAs($user);
    }
}
