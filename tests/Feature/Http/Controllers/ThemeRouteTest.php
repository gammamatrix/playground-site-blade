<?php
/**
 * Playground
 */
namespace Tests\Feature\Playground\Site\Blade\Http\Controllers;

use Playground\Test\Models\User;
use Playground\Test\Models\UserWithRole;
use Tests\Feature\Playground\Site\Blade\TestCase;

/**
 * \Tests\Feature\Playground\Http\Controllers\Index\ThemeRouteTest
 */
class ThemeRouteTest extends TestCase
{
    public function test_route_theme_as_guest_and_succeed(): void
    {
        $response = $this->get(route('theme'));
        $response->assertRedirect('/');
    }

    public function test_route_theme_as_guest_with_preview_and_succeed(): void
    {
        $response = $this->json('GET', route('theme', ['preview' => true]));
        $response->assertStatus(200);
    }

    public function test_route_theme_as_partner_and_succeed(): void
    {
        /**
         * @var UserWithRole $user
         */
        $user = UserWithRole::find(User::factory()->create()->getAttributeValue('id'));
        $user->setAttribute('role', 'partner');
        $response = $this->actingAs($user)->get(route('theme', [
            'appTheme' => 'dark',
        ]));
        $response->assertRedirect('/');
    }

    public function test_route_theme_as_sales_and_succeed_with_theme_and_redirect(): void
    {
        /**
         * @var UserWithRole $user
         */
        $user = UserWithRole::find(User::factory()->create()->getAttributeValue('id'));
        $user->setAttribute('role', 'sales');
        $response = $this->actingAs($user)->get(route('theme', [
            'appTheme' => 'dark',
            '_return_url' => route('sitemap'),
        ]));
        $response->assertRedirect(route('sitemap'));
    }
}
