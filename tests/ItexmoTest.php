<?php

namespace CreatvStudio\Itexmo\Tests;

use PHPUnit\Framework\TestCase;
use CreatvStudio\Itexmo\Itexmo;

class ItexmoTest extends TestCase
{
    protected $itexmo;
    protected $smsReceiver;

    public function setUp() : void
    {
        parent::setUp();

        $this->itexmo = new Itexmo(getenv('ITEXMO_CODE'), getenv('ITEXMO_PASSWORD'));
        $this->smsReceiver = getenv('TEST_SMS_RECEIVER') ?: '09171234567';
    }

    /** @test */
    public function sends_sms_message()
    {
        $response = $this->itexmo->to($this->smsReceiver)
            ->content('Hello to all humans!')
            ->send();

        $this->assertEquals([
            "to" => $this->smsReceiver,
            "content" => "Hello to all humans!",
        ], $this->itexmo->message());
    }

    /** @test */
    public function get_server_status()
    {
        $response = $this->itexmo->status();

        $this->assertEquals([
            'result' => [
                'APIStatus' => 'ONLINE',
                'DedicatedServer' => 'DIRECT',
                'GatewayNumber' => '',
                'SMSServerStatus' => '',
            ]
        ], $response);
    }

    /** @test */
    public function get_message_array_using_message_function()
    {
        $itexmo = $this->itexmo->to($this->smsReceiver)
            ->content('Hello to all humans!');

        $this->assertEquals($itexmo->message(), [
            'to' => $this->smsReceiver,
            'content' => 'Hello to all humans!',
        ]);
    }

    /** @test */
    public function get_message_value_by_key()
    {
        $itexmo = $this->itexmo->to($this->smsReceiver)
            ->content('Hello to all humans!');

        $this->assertEquals($itexmo->message('to'), $this->smsReceiver);
    }

    /** @test */
    public function it_has_a_password_request_param()
    {
        $itexmo = new Itexmo('APICODE', 'MY-PASSWORD');

        $this->assertEquals($itexmo->getMessageRequestParams()['passwd'], 'MY-PASSWORD');
    }

    /** @test */
    public function it_ignores_passwd_param_if_password_is_not_provided()
    {
        $itexmo = new Itexmo('APICODE');

        $this->assertEquals(isset($itexmo->getMessageRequestParams()['passwd']), false);
    }

    /** @test */
    public function it_ignores_passwd_param_if_password_is_an_empty_string()
    {
        $itexmo = new Itexmo('APICODE', '');

        $this->assertEquals(isset($itexmo->getMessageRequestParams()['passwd']), false);
    }

    /** @test */
    public function get_message_default_value()
    {
        $itexmo = $this->itexmo->content('Hello to all humans!');

        $this->assertEquals($itexmo->message('to', 'DEFAULT-VALUE'), 'DEFAULT-VALUE');
    }

    /** @test */
    public function cleans_url()
    {
        $this->assertEquals($this->itexmo->url('test'), 'https://www.itexmo.com/php_api/test');
        $this->assertEquals($this->itexmo->url('/test'), 'https://www.itexmo.com/php_api/test');
        $this->assertEquals($this->itexmo->url('test/'), 'https://www.itexmo.com/php_api/test');
    }
}
