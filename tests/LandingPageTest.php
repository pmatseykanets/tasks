<?php


class LandingPageTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->visit('/')
            ->see('Tasks')
            ->see('Login')
            ->see('Register');
    }
}
