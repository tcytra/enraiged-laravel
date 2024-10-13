<?php

namespace Tests\Feature\Auth;

use Enraiged\Profiles\Models\Profile;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class RegisterTest extends TestCase
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

        if (config('enraiged.auth.allow_registration') !== true) {
            $this->markTestSkipped('Not applicable.');
        }

        $this->seed();
    }

    /**
     *  Test whether the login page returns a successful response.
     *
     *  @return void
     */
    public function test_the_register_page_returns_a_successful_response(): void
    {
        $response = $this->get(route('register'));
        $response->assertStatus(200);
    }

    /**
     *  Test whether the login form contains the necessary fields.
     *
     *  @return void
     */
    public function test_the_login_form_contains_all_necessary_fields(): void
    {
        $this->get(route('register'))
            ->assertInertia(fn (Assert $page) => $page
                ->component('auth/Register')
                ->has('form.fields', fn (Assert $fields) => $fields
                    ->has('name')
                    ->has('email')
                    ->has('password')
                    ->has('password_confirmation')
                )
            );
    }

    /**
     *  Test whether a user can successfully register an account.
     *
     *  @return void
     */
    public function test_a_user_can_successfully_register_an_account(): void
    {
        $model = auth_model();
        $user = $model::factory()->make();
        $profile = Profile::factory()->make();

        $response = $this->post(route('register.store'), [
            'name' => $profile->name,
            'email' => $user->email,
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertStatus(302);

        if (config('enraiged.auth.must_verify_email' === true)) {
            $this->assertInstanceOf($user, MustVerifyEmail);
        } else
        if (config('enraiged.auth.automated_login') === true) {
            $this->assertAuthenticated();
        }
    }
}
