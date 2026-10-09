<?php

namespace Tests\Feature;

use Tests\TestCase;

class FoundationTest extends TestCase
{
    public function test_home_route_renders_the_foundation_page(): void
    {
        $response = $this->get('/');

        $response->assertOk();
        $response->assertInertia(fn ($page) => $page
            ->component('Home')
            ->where('module', 'Penetapan Beasiswa dari SK')
            ->where('status', 'foundation')
        );
    }
}
