@extends($package_config_site_blade['layout'])
@section('title', __('Bootstrap Components'))
@section('breadcrumbs')
    <nav aria-label="breadcrumb" class="m-3">
        <ol class="breadcrumb">
            @if (Route::has('home'))
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">{{ __('Home') }}</a>
                </li>
            @endif
            @if (Route::has('bootstrap'))
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="{{ route('bootstrap') }}">{{ __('Bootstrap Components') }}</a>
                </li>
            @endif
        </ol>
    </nav>
@endsection

@section('content')

    <h1>{{ __('Components') }}</h1>

    @include(sprintf('%1$sbootstrap/index-buttons', $package_config_site_blade['view']))

    @include(sprintf('%1$sbootstrap/index-cards', $package_config_site_blade['view']))

@endsection
