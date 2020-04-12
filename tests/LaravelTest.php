<?php

use CreatvStudio\Itexmo\Itexmo;
use Orchestra\Testbench\TestCase;
use CreatvStudio\Itexmo\ItexmoServiceProvider;

class LaravelTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [ItexmoServiceProvider::class];
    }

    protected function getPackageAliases($app)
    {
        return [
            'Itexmo' => \CreatvStudio\Itexmo\Facades\Itexmo::class,
        ];
    }

    /** @test */
    public function app_loads_a_configured_itexmo_class()
    {
        $itexmo = app('itexmo');

        $params = $itexmo->getMessageRequestParams();

        $this->assertInstanceOf(Itexmo::class, $itexmo);
        $this->assertEquals($params['3'], getenv('ITEXMO_CODE'));
        $this->assertEquals($params['passwd'], getenv('ITEXMO_PASSWORD'));
    }

    /** @test */
    public function facade_loads_itexmo_class()
    {
        $itexmo = \Itexmo::getFacadeRoot();

        $this->assertInstanceOf(Itexmo::class, $itexmo);
    }
}
