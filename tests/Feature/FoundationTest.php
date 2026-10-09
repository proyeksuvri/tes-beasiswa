<?php

namespace Tests\Feature;

use Tests\TestCase;

class FoundationTest extends TestCase
{
    public function test_home_route_returns_foundation_status(): void
    {
        $response = $this->get('/');

        $response->assertOk()
            ->assertJsonPath('module', 'Penetapan Beasiswa dari SK')
            ->assertJsonPath('status', 'foundation');
    }
}
