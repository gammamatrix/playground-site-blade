<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Tests\Feature\Playground\Site\Blade\Http\Controllers\Laravel;

use Playground\Test\Models\User;
use Tests\Feature\Playground\Site\Blade\TestCase;

/**
 * \Tests\Feature\Playground\Http\Controllers\Index\PublicSitemapRouteTest
 */
class PublicSitemapRouteTest extends TestCase
{
    use TestTrait;

    protected bool $load_migrations_cms = true;

    protected bool $load_migrations_laravel = true;

    public function test_as_guest_and_fail_when_disabled_for_guest_and_no_redirect(): void
    {
        config([
            'playground-site-blade.sitemap.enable' => true,
            'playground-site-blade.sitemap.guest' => false,
        ]);
        $response = $this->get('/sitemap?noredirect');
        $response->assertStatus(401);
    }

    public function test_as_guest_and_redirect_when_disabled_for_all(): void
    {
        config([
            'playground-site-blade.sitemap.enable' => false,
        ]);
        $response = $this->get(route('sitemap'));
        $response->assertRedirect('/');
    }

    public function test_as_guest_and_redirect_when_disabled_for_guest(): void
    {
        config([
            'playground-site-blade.sitemap.enable' => true,
            'playground-site-blade.sitemap.guest' => false,
        ]);
        $response = $this->get(route('sitemap'));
        $response->assertRedirect('/');
    }

    public function test_as_guest_and_succeed(): void
    {
        config([
            'playground-site-blade.sitemap.enable' => true,
            'playground-site-blade.sitemap.guest' => true,
        ]);
        $response = $this->json('GET', route('sitemap'));
        $response->assertStatus(200);
    }

    public function test_as_user_and_succeed(): void
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

    public function test_as_support_and_fail_when_disabled_for_all(): void
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

    public function test_as_user_and_fail_when_disabled_for_all_and_no_redirect(): void
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

    public function test_as_admin_and_succeed(): void
    {
        config([
            'playground-site-blade.sitemap.enable' => true,
        ]);
        /**
         * @var User $user
         */
        $user = User::factory()->admin()->create();
        $response = $this->actingAs($user)->getJson(route('sitemap'));
        $response->assertStatus(200);
    }

    public function test_as_user_and_succeed_with_package_sitemaps(): void
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
