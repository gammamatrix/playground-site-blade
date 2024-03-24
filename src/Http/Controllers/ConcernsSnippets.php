<?php

declare(strict_types=1);
/**
 * Playground
 */
namespace Playground\Site\Blade\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Playground\Cms\Models\Snippet;

/**
 * \Playground\Site\Blade\Http\Controllers\ConcernsSnippets
 */
trait ConcernsSnippets
{
    protected string $snippet_slug = '';

    protected ?string $snippet_slug_domain = null;

    protected string $snippet_domain_default = 'www';

    protected mixed $snippet_owned_by_id = null;

    protected string $snippet_slug_domain_key = '';

    protected bool $snippets_available = false;

    protected bool $snippets_wildcard = true;

    protected bool $snippets_cache = false;

    protected int $snippets_cache_ttl = 0;

    /**
     * @param array<string, mixed> $options
     * @return array<int, array<string, mixed>>
     */
    public function snippetsForRoute(Request $request, array $options = []): array
    {
        if (! $this->snippets_available($options)) {
            return [];
        }

        $this->snippet_slug_domain = null;
        if ($this->snippet_slug_domain_key) {
            $snippet_slug_domain = $request->input($this->snippet_slug_domain_key);
            if (is_string($snippet_slug_domain) && $snippet_slug_domain) {
                $this->snippet_slug_domain = $snippet_slug_domain;
            }
        }

        $route = $request->route()?->getName();

        $this->snippet_slug = $this->snippet_slug_key($route ?? '');

        return $this->snippetsBySlug($this->snippet_slug, $request);
    }

    protected function snippet_slug_key(string $route): string
    {
        return ! $this->snippet_slug ? '' : sprintf('%1$s:%2$s', $this->snippet_slug, $route);
    }

    /**
     * @param array<string, mixed> $options
     */
    protected function snippets_available(array $options = []): bool
    {
        // dump([
        //     '__METHOD__' => __METHOD__,
        //     'config' => config('playground-site-blade'),
        // ]);
        if (empty(config('playground-site-blade.cms.enable'))) {
            return false;
        }

        /**
         * @var class-string $snippet_class
         */
        $snippet_class = config('playground-site-blade.cms.snippet');

        if (! is_string($snippet_class) || ! class_exists($snippet_class)) {
            return false;
        }

        if (empty(config('playground-site-blade.cms.snippets'))) {
            return false;
        }

        if (! empty(config('playground-site-blade.domain.enable'))) {

            $snippet_slug_domain_key = config('playground-site-blade.domain.key');

            if (is_string($snippet_slug_domain_key)
                && $snippet_slug_domain_key
            ) {
                $this->snippet_slug_domain_key = $snippet_slug_domain_key;
            }
        }

        if (! empty(config('playground-site-blade.domain.default'))
            && is_string(config('playground-site-blade.domain.default'))
        ) {

            $this->snippet_domain_default = config('playground-site-blade.domain.default');
        }

        if (! empty(config('playground-site-blade.cache.enable'))
            && ! empty(config('playground-site-blade.cache.snippet'))
        ) {
            $this->snippets_cache = true;
        }

        if ($this->snippets_cache
            && ! empty(config('playground-site-blade.cache.snippet_ttl'))
            && is_numeric(config('playground-site-blade.cache.snippet_ttl'))
            && config('playground-site-blade.cache.snippet_ttl') > 0
        ) {
            $this->snippets_cache_ttl = intval(config('playground-site-blade.cache.snippet_ttl'));
        }

        if (array_key_exists('wildcard', $options)) {
            $this->snippets_wildcard = ! empty($options['wildcard']);
        }

        $this->snippets_available = true;

        return $this->snippets_available;
    }

    protected function snippets_query(string $slug): Builder
    {
        if (empty($this->snippets_wildcard)) {
            return Snippet::where('slug', 'LIKE', $slug);
        } elseif (empty($slug)) {
            return Snippet::where('slug', '*');
        }

        return Snippet::where(function (Builder $q) use ($slug) {
            $q->where('slug', 'LIKE', $slug)->orWhere('slug', '*');
        });
    }

    protected function snippets_query_user(Builder $query): void
    {
        if (! empty(config('playground-site-blade.cms.snippets_user'))) {
            if (empty($this->snippet_owned_by_id)) {
                $query->whereNull('owned_by_id');
            } else {
                $query->where('owned_by_id', $this->snippet_owned_by_id);
            }
        }
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    protected function snippetsBySlugForUser(string $slug): array
    {
        $query = $this->snippets_query($slug);

        $query->where('active', true);
        $query->where('published', true);
        $query->where('only_guest', false);

        $this->snippets_query_user($query);

        $query->orderBy('rank');

        /**
         * @var array<int, array<string, mixed>> $snippets
         */
        $snippets = $query->get()->toArray();

        return $snippets;
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    protected function snippetsBySlugForGuest(string $slug): array
    {
        $query = $this->snippets_query($slug);

        $query->where('active', true);
        $query->where('published', true);
        $query->where('only_admin', false);
        $query->where('only_user', false);
        $query->where('allow_public', true);

        $this->snippets_query_user($query);

        $query->orderBy('rank');

        /**
         * @var array<int, array<string, mixed>> $snippets
         */
        $snippets = $query->get()->toArray();

        return $snippets;
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    protected function snippetsBySlug(string $slug, Request $request): array
    {
        /**
         * @var array<int, array<string, mixed>> $snippets
         */
        $snippets = [];

        // Check if the CMS is enabled for the page.
        if (! $this->snippets_available || (
            empty($this->snippets_wildcard)
            && empty($slug)
        )) {
            return $snippets;
        }

        $user = $request->user();

        if ($user) {
            if ($this->snippets_cache) {
                $key = sprintf(
                    'snippets:%1$s:user:%2$s',
                    $this->snippet_slug_domain ? $this->snippet_slug_domain : $this->snippet_domain_default,
                    $slug
                );
                $snippets = Cache::remember($key, $this->snippets_cache_ttl, function () use ($slug) {
                    return $this->snippetsBySlugForUser($slug);
                });
            } else {
                $snippets = $this->snippetsBySlugForUser($slug);
            }
        } else {
            if ($this->snippets_cache) {
                $key = sprintf(
                    'snippets:%1$s:guest:%2$s',
                    $this->snippet_slug_domain ? $this->snippet_slug_domain : $this->snippet_domain_default,
                    $slug
                );
                $snippets = Cache::remember($key, $this->snippets_cache_ttl, function () use ($slug) {
                    return $this->snippetsBySlugForGuest($slug);
                });
            } else {
                $snippets = $this->snippetsBySlugForGuest($slug);
            }
        }
        // dd([
        //     '__METHOD__' => __METHOD__,
        //     'config' => config('playground-site-blade'),
        //     '$snippets' => $snippets,
        // ]);

        return $snippets;
    }
}
