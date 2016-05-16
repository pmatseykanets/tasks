<?php

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RegisterTest extends TestCase
{
    use DatabaseMigrations;
//    use DatabaseTransactions;
//    use InteractsWithEmails;

    public function test_register_page_renders_properly()
    {
        $this->visit('/register')
            ->seePageIs('/register')
            ->see('Register')
            ->see('Name')
            ->see('Email')
            ->see('Password')
            ->see('Confirm Password')
            ->seeLink('Register');
    }

    public function test_it_registers_new_user()
    {
//        $this->expectEmails();

        $email = 'john.doe@example.com';

        $this->visit('/register')
            ->type('John Doe', 'name')
            ->type('john.doe@example.com', 'email')
            ->type('password', 'password')
            ->type('password', 'password_confirmation')
            ->press('Register')
            ->seePageIs('/tasks')
            ->see('John Doe');

        $user = User::where('email', '=', $email)->first();
        $this->assertNotNull($user);

//        $this->seeEmailsSent(1);
    }
}
