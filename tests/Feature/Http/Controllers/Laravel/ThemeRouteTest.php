<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Tests\Feature\Playground\Site\Blade\Http\Controllers\Laravel;

use Playground\Test\Models\User;
use Tests\Feature\Playground\Site\Blade\TestCase;

/**
 * \Tests\Feature\Playground\Http\Controllers\Index\ThemeRouteTest
 */
class ThemeRouteTest extends TestCase
{
    use TestTrait;

    protected bool $load_migrations_cms = true;

    protected bool $load_migrations_laravel = true;

    public function test_as_guest_and_succeed(): void
    {
        $response = $this->get(route('theme'));
        $response->assertRedirect('/');
    }

    public function test_as_guest_with_preview_and_succeed(): void
    {
        $response = $this->json('GET', route('theme', ['preview' => true]));
        $response->assertStatus(200);
    }

    public function test_as_user_and_succeed(): void
    {
        /**
         * @var User $user
         */
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('theme', [
            'appTheme' => 'dark',
        ]));
        $response->assertRedirect('/');
    }

    public function test_as_admin_and_succeed_with_theme_and_redirect(): void
    {
        /**
         * @var User $user
         */
        $user = User::factory()->admin()->create();
        $response = $this->actingAs($user)->get(route('theme', [
            'appTheme' => 'dark',
            '_return_url' => route('sitemap'),
        ]));
        $response->assertRedirect(route('sitemap'));
    }
}
