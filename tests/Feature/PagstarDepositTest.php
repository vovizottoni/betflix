<?php

namespace Tests\Feature;

use Tests\TestCase;
use Tests\Traits\UserTestTrait;

class PagstarDepositTest extends TestCase
{
    use UserTestTrait;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_deposit()
    {
        $user = $this->generateRandomUser();
        $this->assertTrue(isset($user['id']));

    }
}
