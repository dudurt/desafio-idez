<?php

namespace Tests\Unit;
use Tests\TestCase;

class VerifyMandatoryStateAcronymTest extends TestCase
{
    /** @test */
    public function verifyReturnWithoutStateAcronym(): void
    {
        $response = $this->get('/api/city/list/');
        $response->assertStatus(500);
    }
}
