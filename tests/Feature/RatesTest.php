<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class RatesTest extends TestCase
{
    /**
     * A basic feature test for getting rates.
     *
     * @return void
     */
    public function test_get_rates()
    {
        $response = $this->post('api/rates', [
            'currency_code' => Config::get('rates.base_currency_code'),
            'date' => Carbon::now()->toString()
        ]);

        $response->assertStatus(200);
        $this->assertEquals(2000, json_decode($response->getContent(), true)['code']);
    }
}
