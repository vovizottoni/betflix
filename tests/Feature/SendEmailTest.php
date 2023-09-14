<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class SendEmailTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCanSendEmail()
    {
        try {
            Mail::raw('Its work!', function ($message) {
                $message->to('caiquemarcelinosouza@gmail.com')
                    ->from(env("MAIL_FROM_ADDRESS_NO_REPLY"));

            });
            $status = true;

        } catch (\Exception $exception) {
            $exception->getMessage();
            $status = false;

        }
        $this->assertTrue($status);

    }
}
