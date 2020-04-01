<?php

use CreatvStudio\Itexmo\Itexmo;
use Orchestra\Testbench\TestCase;
use CreatvStudio\Itexmo\Laravel\ItexmoServiceProvider;

class LaravelTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [ItexmoServiceProvider::class];
    }

    protected function getPackageAliases($app)
    {
        return [
            'Itexmo' => \CreatvStudio\Itexmo\Laravel\Facades\Itexmo::class,
        ];
    }

    /** @test */
    public function app_loads_a_configured_itexmo_class()
    {
        $itexmo = app('itexmo');

        $this->assertInstanceOf(Itexmo::class, $itexmo);
        $this->assertEquals($itexmo->getMessageRequestParams()['3'], 'MY-CODE');
        $this->assertEquals($itexmo->getMessageRequestParams()['passwd'], 'MY-PASSWORD');
    }

    /** @test */
    public function facade_loads_itexmo_class()
    {
        $itexmo = \Itexmo::content('test');

        $this->assertInstanceOf(Itexmo::class, $itexmo);
    }
}
