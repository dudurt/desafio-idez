<?php

namespace Tests\Unit;
use Tests\TestCase;
use Illuminate\Support\Facades\Redis;

class VerifyRedisServerTest extends TestCase
{
    /** @test */
    public function verifyReturnRedisServer(): void
    {
        Redis::set('test', 'success');
        $this->assertEquals(Redis::get('test'), 'success');
    }
}
