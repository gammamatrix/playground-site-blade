<?php
/**
 * Playground
 */
namespace Tests\Feature\Playground\Site\Blade\Http\Controllers;

use Playground\Test\Models\User;
use Playground\Test\Models\UserWithRole;
use Tests\Feature\Playground\Site\Blade\TestCase;

/**
 * \Tests\Feature\Playground\Http\Controllers\Index\PublicSitemapRouteTest
 */
class PublicSitemapRouteTest extends TestCase
{
    public function test_route_sitemap_as_guest_and_fail_when_disabled_for_guest_and_no_redirect(): void
    {
        config([
            'playground-site-blade.sitemap.enable' => true,
            'playground-site-blade.sitemap.guest' => false,
        ]);
        $response = $this->get('/sitemap?noredirect');
        $response->assertStatus(401);
    }

    public function test_route_sitemap_as_guest_and_redirect_when_disabled_for_all(): void
    {
        config([
            'playground-site-blade.sitemap.enable' => false,
        ]);
        $response = $this->get(route('sitemap'));
        $response->assertRedirect('/');
    }

    public function test_route_sitemap_as_guest_and_redirect_when_disabled_for_guest(): void
    {
        config([
            'playground-site-blade.sitemap.enable' => true,
            'playground-site-blade.sitemap.guest' => false,
        ]);
        $response = $this->get(route('sitemap'));
        $response->assertRedirect('/');
    }

    public function test_route_json_sitemap_as_guest_and_succeed(): void
    {
        config([
            'playground-site-blade.sitemap.enable' => true,
            'playground-site-blade.sitemap.guest' => true,
        ]);
        $response = $this->json('GET', route('sitemap'));
        $response->assertStatus(200);
    }

    public function test_route_sitemap_as_user_and_succeed(): void
    {
        config([
            'playground-site-blade.sitemap.enable' => true,
            'playground-site-blade.sitemap.guest' => false,
        ]);
        /**
         * @var User $user
         */
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('sitemap'));
        $response->assertStatus(200);
    }

    public function test_route_sitemap_as_support_and_fail_when_disabled_for_all(): void
    {
        config([
            'playground-site-blade.sitemap.enable' => false,
        ]);
        /**
         * @var User $user
         */
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('sitemap'));
        $response->assertRedirect('/');
    }

    public function test_route_sitemap_as_user_and_fail_when_disabled_for_all_and_no_redirect(): void
    {
        config([
            'playground-site-blade.sitemap.enable' => false,
        ]);
        /**
         * @var User $user
         */
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('sitemap', ['noredirect' => 1]));
        $response->assertStatus(404);
    }

    public function test_route_json_sitemap_as_admin_and_succeed(): void
    {
        config([
            'playground-site-blade.sitemap.enable' => true,
        ]);
        /**
         * @var UserWithRole $user
         */
        $user = UserWithRole::find(User::factory()->create()->getAttributeValue('id'));
        // The role is not saved since the column may not exist.
        $user->setAttribute('role', 'admin');
        $response = $this->actingAs($user)->getJson(route('sitemap'));
        $response->assertStatus(200);
    }

    public function test_route_sitemap_as_user_and_succeed_with_package_sitemaps(): void
    {
        config([
            'playground-site-blade.load.views' => true,
            'playground-site-blade.sitemap.enable' => true,
            'playground-site-blade.sitemap.guest' => false,
            'playground-site-blade.sitemap.packages' => 'playground-auth',
        ]);
        /**
         * @var User $user
         */
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('sitemap'));
        $response->assertStatus(200);
    }
}
