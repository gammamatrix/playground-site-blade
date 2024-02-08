# Playground Site Blade

[![Playground CI Workflow](https://github.com/gammamatrix/playground-site-blade/actions/workflows/ci.yml/badge.svg?branch=develop)](https://raw.githubusercontent.com/gammamatrix/playground-site-blade/testing/develop/testdox.txt)
[![Test Coverage](https://raw.githubusercontent.com/gammamatrix/playground-site-blade/testing/develop/coverage.svg)](tests)
[![PHPStan Level 9 src and tests](https://img.shields.io/badge/PHPStan-level%209-brightgreen)](.github/workflows/ci.yml#L120)

The Playground Site Blade package for [Laravel](https://laravel.com/docs/10.x) applications.

This package provides Controllers and Blade UI handling:
- Bootstrap Theme Handling
- Dashboard
- Home and Index
- Sitemap
- Welcome

More information is available [on the Playground Site Blade wiki.](https://github.com/gammamatrix/playground-site-blade/wiki)

## Installation

You can install the package via composer:

```bash
composer require gammamatrix/playground-site-blade
```

## Configuration

You can publish the config file with:
```bash
php artisan vendor:publish --provider="Playground\Site\Blade\ServiceProvider" --tag="playground-config"
```

See the contents of the published config file: [config/playground-site-blade.php](config/playground-site-blade.php)

You can publish the views file with:
```bash
php artisan vendor:publish --provider="Playground\Site\Blade\ServiceProvider" --tag="playground-view"
```

### Environment Variables

#### Loading

| env()                                | config()                             |
|--------------------------------------|--------------------------------------|
| `PLAYGROUND_SITE_BLADE_LOAD_VIEWS`  | `playground-site-blade.load.views`  |
| `PLAYGROUND_SITE_BLADE_LOAD_ROUTES` | `playground-site-blade.load.routes` |
- `PLAYGROUND_SITE_BLADE_LOAD_ROUTES` must be enabled to load the routes in the application (unless published to your app - the control for this is in the [ServiceProvider.php](src/ServiceProvider.php))

#### Routes

| env()                                    | config()                                 |
|------------------------------------------|------------------------------------------|
| `PLAYGROUND_SITE_BLADE_ROUTES_ABOUT`     | `playground-site-blade.routes.about`     |
| `PLAYGROUND_SITE_BLADE_ROUTES_BOOTSTRAP` | `playground-site-blade.routes.bootstrap` |
| `PLAYGROUND_SITE_BLADE_ROUTES_DASHBOARD` | `playground-site-blade.routes.dashboard` |
| `PLAYGROUND_SITE_BLADE_ROUTES_HOME`      | `playground-site-blade.routes.home`      |
| `PLAYGROUND_SITE_BLADE_ROUTES_INDEX`     | `playground-site-blade.routes.index`     |
| `PLAYGROUND_SITE_BLADE_ROUTES_SITEMAP`   | `playground-site-blade.routes.sitemap`   |
| `PLAYGROUND_SITE_BLADE_ROUTES_THEME`     | `playground-site-blade.routes.theme`     |
| `PLAYGROUND_SITE_BLADE_ROUTES_WELCOME`   | `playground-site-blade.routes.welcome`   |

#### Middleware

The middleware values can be customized. See the default values on the command line with: `artisan about`

| env()                                       | config()                              |
|---------------------------------------------|---------------------------------------|
| `PLAYGROUND_SITE_BLADE_MIDDLEWARE_AUTH`    | `playground-site-blade.routes.auth`    |
| `PLAYGROUND_SITE_BLADE_MIDDLEWARE_DEFAULT` | `playground-site-blade.routes.default` |
| `PLAYGROUND_SITE_BLADE_MIDDLEWARE_GUEST`   | `playground-site-blade.routes.guest`   |

#### Dashboard

| env()                                    | config()                                |
|------------------------------------------|-----------------------------------------|
| `PLAYGROUND_SITE_BLADE_DASHBOARD_ENABLE` | `playground-site-blade.dashboard.enable`|
| `PLAYGROUND_SITE_BLADE_DASHBOARD_GUEST`  | `playground-site-blade.dashboard.guest` |
| `PLAYGROUND_SITE_BLADE_DASHBOARD_USER`   | `playground-site-blade.dashboard.user`  |
| `PLAYGROUND_SITE_BLADE_DASHBOARD_VIEW`   | `playground-site-blade.dashboard.view`  |

#### Sitemap

| env()                                  | config()                               |
|----------------------------------------|----------------------------------------|
| `PLAYGROUND_SITE_BLADE_SITEMAP_ENABLE` | `playground-site-blade.sitemap.enable` |
| `PLAYGROUND_SITE_BLADE_SITEMAP_GUEST`  | `playground-site-blade.sitemap.guest`  |
| `PLAYGROUND_SITE_BLADE_SITEMAP_USER`   | `playground-site-blade.sitemap.user`   |
| `PLAYGROUND_SITE_BLADE_SITEMAP_VIEW`   | `playground-site-blade.sitemap.view`   |

#### UI

If `PLAYGROUND_SITE_BLADE_LAYOUT` is not set, it defaults to `PLAYGROUND_BLADE_LAYOUT` from the base [Playground Blade](https://github.com/gammamatrix/playground-blade) package.

| env()                          | config()                       |
|--------------------------------|--------------------------------|
| `PLAYGROUND_SITE_BLADE_LAYOUT` | `playground-site-blade.layout` |
| `PLAYGROUND_SITE_BLADE_VIEW`   | `playground-site-blade.view`   |

## Testing

```sh
composer test
```

## `artisan about`

Playground Site Blade provides information in the `artisan about` command.

<!-- <img src="resources/docs/artisan-about-playground-site-blade.png" alt="screenshot of artisan about command with Playground Site Blade."> -->

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Credits

- [Jeremy Postlethwaite](https://github.com/gammamatrix)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
