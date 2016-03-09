<?php

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginTest extends TestCase
{
//    use DatabaseTransactions;
    use DatabaseMigrations;

    public function test_login_page_renders_properly()
    {
        $this->visit('/login')
            ->seePageIs('/login')
            ->see('Login')
            ->see('Email')
            ->see('Password')
            ->see('Remember Me')
            ->seeLink('Forgot Your Password?')
            ->seeLink('Login');
    }

    public function test_it_logs_in_an_exisiting_user()
    {
        $user = $this->getUser(['email' => 'foo.bar@example.com', 'password' => bcrypt('RightPassword')]);

        $this->visit('/login')
            ->type($user->email, 'email')
            ->type('RightPassword', 'password')
            ->press('Login')
            ->seePageIs('/tasks')
            ->see($user->name);
    }

    public function test_it_validates_input()
    {
        $response = $this->post('login', [
            'email' => '',
            'password' => '',
        ]);

        $this->assertSessionHasErrors(['email', 'password']);
    }

    public function test_it_does_not_login_a_user_with_invalid_credentials()
    {
        $user = $this->getUser(['email' => 'foo.bar@example.com', 'password' => bcrypt('RightPassword')]);

        $response = $this->post('login', [
            'email' => 'foo.bar@example.com',
            'password' => 'WrongPassword',
        ]);

        $this->assertSessionHasErrors(['email']);
    }

    public function test_it_redirects_if_user_is_already_logged_in()
    {
        $user = $this->getUser();

        $this->actingAs($user)
            ->visit('/login')
            ->seePageIs('/tasks');
    }
}
