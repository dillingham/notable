<?php

namespace StubKit\Tests;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\File;
use Orchestra\Testbench\TestCase;
use StubKit\Commands\ScaffoldMakeCommand;
use StubKit\Events\Rendered;
use StubKit\Events\Rendering;
use StubKit\Facades\StubKit;
use StubKit\Providers\StubKitProvider;

class CommandTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [StubKitProvider::class];
    }

    public function setUp(): void
    {
        parent::setUp();

        app()->setBasePath(__DIR__ . '/Fixtures/app');

        config()->set(['stubkit.scaffold-completed' => []]);

        config()->set(['stubkit-internal.delay' => 0]);

        File::deleteDirectory(__DIR__ . '/Fixtures/app');

        mkdir(__DIR__ . '/Fixtures/app');
    }

    public function tearDown(): void
    {
        File::deleteDirectory(__DIR__ . '/Fixtures/app');
    }
}
