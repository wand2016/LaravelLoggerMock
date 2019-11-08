<?php

namespace Tests\Feature;

use App\Util\LoggerFake;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * @test
     * @dataProvider dataProvider_アクセスログの日時
     */
    public function root_GETでアクセスするとアクセス日時がnoticeでロギングされる(
        Carbon $testNow
    ) {
        // ----------------------------------------
        // 1. setup
        // ----------------------------------------
        Carbon::setTestNow($testNow);

        $loggerFake = new LoggerFake;
        Log::swap($loggerFake);

        // ----------------------------------------
        // 2. action
        // ----------------------------------------
        $this->get('/');

        // ----------------------------------------
        // 3. assertion
        // ----------------------------------------
        $this->assertTrue(
            $loggerFake->contains(
                'notice',
                'アクセス',
                [
                    'datetime' => $testNow
                ]
            )
        );
    }

    /**
     * @test
     * @dataProvider dataProvider_アクセスログの日時
     */
    public function root_GETでアクセスするとアクセス日時がnoticeでロギングされる_NG(
        Carbon $testNow
    ) {
        // ----------------------------------------
        // 1. setup and expectation
        // ----------------------------------------
        Carbon::setTestNow($testNow);

        Log::shouldReceive('notice')
            ->once()
            ->with(
                'アクセス',
                [
                    'datetime' => $testNow
                ]
            );
        Log::makePartial();

        // ----------------------------------------
        // 2. action
        // ----------------------------------------
        $this->get('/');
    }


    // ----------------------------------------
    // dataProviders
    // ----------------------------------------

    public function dataProvider_アクセスログの日時(): iterable
    {
        yield [
            Carbon::create(2019, 12, 7, 23, 59, 59),
        ];
    }
}
