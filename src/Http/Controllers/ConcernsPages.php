<?php

declare(strict_types=1);
/**
 * Playground
 */
namespace Playground\Site\Blade\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Playground\Cms\Models\Page;

/**
 * \Playground\Site\Blade\Http\Controllers\ConcernsPages
 */
trait ConcernsPages
{
    protected bool $page_available = false;

    protected mixed $page_owned_by_id = null;

    protected int $page_cache_ttl = 0;

    protected string $page_domain_default = 'www';

    protected ?string $page_slug_domain = null;

    protected string $page_slug_domain_key = '';

    protected bool $page_cache = false;

    protected function pageBySlug(Request $request, string $slug): ?Page
    {
        if (! $this->page_available()) {
            return null;
        }

        $user = $request->user();

        if ($user) {
            if ($this->page_cache) {
                $key = sprintf(
                    'page:%1$s:user:%2$s',
                    $this->page_slug_domain ? $this->page_slug_domain : $this->page_domain_default,
                    $slug
                );
                $page = Cache::remember($key, $this->page_cache_ttl, function () use ($slug) {
                    return $this->pageBySlugForUser($slug);
                });
            } else {
                $page = $this->pageBySlugForUser($slug);
            }
        } else {
            if ($this->page_cache) {
                $key = sprintf(
                    'page:%1$s:guest:%2$s',
                    $this->page_slug_domain ? $this->page_slug_domain : $this->page_domain_default,
                    $slug
                );
                $page = Cache::remember($key, $this->page_cache_ttl, function () use ($slug) {
                    return $this->pageBySlugForGuest($slug);
                });
            } else {
                $page = $this->pageBySlugForGuest($slug);
            }
        }

        return $page;
    }

    protected function page_available(): bool
    {
        // dump([
        //     '__METHOD__' => __METHOD__,
        //     'config' => config('playground-site-blade'),
        // ]);
        if (empty(config('playground-site-blade.cms.enable'))) {
            return false;
        }

        /**
         * @var class-string $page_class
         */
        $page_class = config('playground-site-blade.cms.page');

        if (! is_string($page_class) || ! class_exists($page_class)) {
            return false;
        }

        if (empty(config('playground-site-blade.cms.pages'))) {
            return false;
        }

        if (! empty(config('playground-site-blade.domain.enable'))) {

            $page_slug_domain_key = config('playground-site-blade.domain.key');

            if (is_string($page_slug_domain_key)
                && $page_slug_domain_key
            ) {
                $this->page_slug_domain_key = $page_slug_domain_key;
            }
        }

        if (! empty(config('playground-site-blade.domain.default'))
            && is_string(config('playground-site-blade.domain.default'))
        ) {
            $this->page_domain_default = config('playground-site-blade.domain.default');
        }

        if (! empty(config('playground-site-blade.cache.enable'))
            && ! empty(config('playground-site-blade.cache.page'))
        ) {
            $this->page_cache = true;
        }

        if ($this->page_cache
            && ! empty(config('playground-site-blade.cache.page_ttl'))
            && is_numeric(config('playground-site-blade.cache.page_ttl'))
            && config('playground-site-blade.cache.page_ttl') > 0
        ) {
            $this->page_cache_ttl = intval(config('playground-site-blade.cache.page_ttl'));
        }

        $this->page_available = true;

        return $this->page_available;
    }

    protected function page_query_user(Builder $query): void
    {
        if (! empty(config('playground-site-blade.cms.pages_user'))) {
            if (empty($this->page_owned_by_id)) {
                $query->whereNull('owned_by_id');
            } else {
                $query->where('owned_by_id', $this->page_owned_by_id);
            }
        }
    }

    protected function pageBySlugForUser(string $slug): ?Page
    {
        $query = Page::where('slug', $slug);

        $query->where('active', true);
        $query->where('published', true);
        $query->where('only_guest', false);

        $this->page_query_user($query);

        $query->orderBy('rank');

        $page = $query->first();

        return $page;
    }

    protected function pageBySlugForGuest(string $slug): ?Page
    {
        $query = Page::where('slug', $slug);

        $query->where('active', true);
        $query->where('published', true);
        $query->where('only_admin', false);
        $query->where('only_user', false);
        $query->where('allow_public', true);

        $this->page_query_user($query);

        $query->orderBy('rank');

        $page = $query->first();

        return $page;
    }
}
