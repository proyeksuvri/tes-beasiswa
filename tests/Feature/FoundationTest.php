<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class FoundationTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_to_login(): void
    {
        $this->get('/')->assertRedirect(route('login'));
    }

    public function test_user_can_view_dashboard_after_login(): void
    {
        $user = User::query()->create([
            'name' => 'Operator Uji',
            'email' => 'operator@example.test',
            'password' => 'password',
            'roles' => ['operator'],
        ]);

        $this->actingAs($user)->get('/dashboard')
            ->assertOk()
            ->assertInertia(fn (Assert $page) => $page
                ->component('Dashboard')
                ->where('auth.user.email', 'operator@example.test')
                ->where('auth.user.roles.0', 'operator')
            );
    }

    public function test_role_middleware_forbids_unpermitted_role(): void
    {
        $user = User::query()->create([
            'name' => 'Auditor Uji',
            'email' => 'auditor@example.test',
            'password' => 'password',
            'roles' => ['auditor'],
        ]);

        $this->actingAs($user)->get('/akses/operasional')->assertForbidden();
        $this->actingAs($user)->get('/akses/audit')->assertOk();
    }
}
